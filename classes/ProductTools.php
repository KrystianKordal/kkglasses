<?php

class ProductTools
{
    protected static $table = 'kkglasses_product';
    protected static $prefix_table = _DB_PREFIX_ . 'kkglasses_product';

    public static function getTemplateProduct(int $id_product) : array
    {
        $context = Context::getContext();
        $product = new Product($id_product);

        $cover = $product->getCover($product->id);
        if($cover) {
            $link_rewrite = '';
            if(isset($product->link_rewrite)) {
                $link_rewrite = is_array($product->link_rewrite) ? array_shift($product->link_rewrite) : $product->link_rewrite;
            } else {
                $link_rewrite = $product->name;
            }
            
            $image = $context->link->getImageLink(
                $link_rewrite, 
                $cover['id_image'], 
                'large_default'  
            );
        } else {
            $image = '';
        }

        $name = Product::getProductName($product->id);
        $name = str_replace('+ soczewki', '', $name);

        
        $template_product = array(
            'id_product' => $product->id,
            'name' => $name,
            'image' => $image,
            'attributes' => self::getAttributes($product),
            'price' => self::formatPrice($product->price),
            'price_amount' => $product->price
        );

        return $template_product;
    }

    public static function getCreatorProductData(int $id_product) : array
    {
        $db = Db::getInstance();
        $data = $db->getRow("SELECT type_data, thin_data FROM " . self::$prefix_table . " WHERE id_creator_product = $id_product");
        
        return array(
            'type_data' => unserialize($data['type_data']),
            'thin_data' => unserialize($data['thin_data'])
        );
    }

    public static function getAttributes(Product $product) : array
    {
        $id_use = Configuration::get('KKGLASSES_ATTR_USE', 0);
        $id_type = Configuration::get('KKGLASSES_ATTR_TYPE', 0);
        $id_thin = Configuration::get('KKGLASSES_ATTR_THIN', 0);

        $context = Context::getContext();
        $attributes = array();

        $attributes_groups = $product->getAttributesGroups($context->language->id);

        $product_data = ProductTools::getCreatorProductData($product->id);

        $data = array(
            $id_type => $product_data['type_data'],
            $id_thin => $product_data['thin_data']
        );

        foreach($attributes_groups as $attribute_group) {

            $id_group = $attribute_group['id_attribute_group'];
            if(!in_array($id_group, [
                $id_use,
                $id_thin,
                $id_type,
            ])) {
                continue;
            }

            if(isset($data[$id_group]) && !$data[$id_group][$attribute_group['id_attribute']]['active']) {
                continue;
            }

            if(!isset($attributes[$id_group])) {
                $attributes[$id_group] = array();
            }

            $price = isset($data[$id_group]) ? $data[$id_group][$attribute_group['id_attribute']]['price'] : 0;
            $formatted_price = self::formatPrice($price);
            $attributes[$id_group]['name'] = $attribute_group['group_name'];
            $attributes[$id_group]['values'][$attribute_group['id_attribute']] = array(
                'name' => $attribute_group['attribute_name'],
                'price' => $formatted_price,
                'price_amount' => $price
            );
        }



        return $attributes;
    }

    protected static function formatPrice($price)
    {
        $context = Context::getContext();
        $locale = Tools::getContextLocale($context);
        $currency = $context->currency;
        $currency_code = is_array($currency) ? $currency['iso_code'] : $currency->iso_code;
   
        return $locale->formatPrice($price, $currency_code);
    }

    public static function getProductAttributes(int $id_product) : array
    {
        $context = Context::getContext();
        $product = new Product($id_product);
        $product_attributes = array();

        $attributes_groups = $product->getAttributesGroups($context->language->id);
        foreach($attributes_groups as $attribute_group) {
            if(!isset($product_attributes[$attribute_group['id_product_attribute']])) {
                $product_attributes[$attribute_group['id_product_attribute']] = array();
            }
            $product_attributes[$attribute_group['id_product_attribute']][] = $attribute_group['id_attribute'];
        }   

        return $product_attributes;
    }

    public static function getCustomizationFields($id_product)
    {
        $product = new Product($id_product);
        $id_lang = Context::getContext()->language->id;
        
        $customization_fields = $product->getCustomizationFields();
        if(!$customization_fields) {
            return array();
        }
        $customization_fields = array_shift($customization_fields);

        $result = array();

        $indexes = ['correction', 'spacing'];
        $current_index = 0;
        foreach($customization_fields as $id_field => $field) {
            $result[$indexes[$current_index]] = $field[$id_lang]['id_customization_field'];

            $current_index++;
            if($current_index > count($indexes) - 1) {
                break;
            }
        }

        return $result;
    }
}