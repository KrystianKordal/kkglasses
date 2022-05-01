<?php

class ProductTools
{
    public static function getTemplateProduct(int $id_product) : array
    {
        $context = Context::getContext();
        $product = new Product($id_product);
        
        $template_product = array(
            'name' => Product::getProductName($product->id),
            'image' => $context->link->getImageLink(isset($product->link_rewrite) ? $product->link_rewrite : $product->name, $product->getCover($product->id)['id_image'], 'home_default'),
            'attributes' => self::getAttributes($product)
        );

        return $template_product;
    }

    public static function getAttributes(Product $product) : array
    {
        $context = Context::getContext();
        $attributes = array();

        $attributes_groups = $product->getAttributesGroups($context->language->id);

        foreach($attributes_groups as $attribute_group) {
            if(!isset($attributes[$attribute_group['id_attribute_group']])) {
                $attributes[$attribute_group['id_attribute_group']] = array();
            }
            $attributes[$attribute_group['id_attribute_group']]['name'] = $attribute_group['group_name'];
            $attributes[$attribute_group['id_attribute_group']]['values'][$attribute_group['id_attribute']] = array(
                'name' => $attribute_group['attribute_name']
            );
        }

        return $attributes;
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