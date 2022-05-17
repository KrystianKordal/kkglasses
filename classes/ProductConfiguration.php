<?php

class ProductConfiguration
{   
    protected static string $table = 'kkglasses_product';
    protected static string $prefix_table = _DB_PREFIX_ . 'kkglasses_product';

    public static function save(int $id_product, array $form)
    {
        $db = Db::getInstance();

        $exists = $db->getValue('SELECT COUNT(*) FROM ' . self::$prefix_table . ' WHERE id_product = ' . $id_product);

        $id_creator_product = self::saveCreatorProduct($id_product, $form);

        if($exists) {
            $db->update(self::$table, [
                'id_creator_product' => $id_creator_product,
                'type_data' => self::getDataToSave($form, 'KKGLASSES_ATTR_TYPE'),
                'thin_data' => self::getDataToSave($form, 'KKGLASSES_ATTR_THIN')
            ], "id_product = $id_product");
            
        } else {
            $db->insert(self::$table, [
                'id_product' => $id_product,
                'id_creator_product' => $id_creator_product,
                'type_data' => self::getDataToSave($form, 'KKGLASSES_ATTR_TYPE'),
                'thin_data' => self::getDataToSave($form, 'KKGLASSES_ATTR_THIN')
            ]);
        }
    }

    protected static function getDataToSave(array $form, $data_type) : string
    {
        $id = Configuration::get($data_type);

        $data = array();

        if($id && isset($form[$id])) {
            foreach($form[$id] as $id_attribute => $attribute) {
                $data[$id_attribute] = array(
                    'price' => $attribute['price'],
                    'active' => isset($attribute['active'])
                );
            }
        }

        return serialize($data);
    }

    public static function saveCreatorProduct(int $id_product, array $form) : int
    {
        $id_creator_product = self::getCreatorProductId($id_product);

        if($id_creator_product) {
            $id_creator_product = self::updateCreatorProduct($id_product, $form);
        } else {
            $id_creator_product = self::newCreatorProduct($id_product, $form);
        }

        return $id_creator_product;
    }

    public static function getCreatorProductId(int $id_product) : int
    {
        $db = Db::getInstance();

        $id_creator_product = $db->getValue("SELECT id_creator_product FROM " . self::$prefix_table . " WHERE id_product = $id_product");
        $product = new Product($id_creator_product);
        return Validate::isLoadedObject($product) ? $id_creator_product : 0;
    }

    public static function getCreatorProductData(int $id_product) : array
    {
        $db = Db::getInstance();
        $data = $db->getRow("SELECT type_data, thin_data FROM " . self::$prefix_table . " WHERE id_product = $id_product");
        
        return array(
            'type_data' => unserialize($data['type_data']),
            'thin_data' => unserialize($data['thin_data'])
        );
    }

    protected static function newCreatorProduct(int $id_product, array $form) : int
    {
        $product = new Product($id_product);
        $id_product_old = $product->id;
        $product->id = null;

        if(is_array($product->name)) {
            foreach($product->name as $key => $name) {
                $product->name[$key] .= " + soczewki";
            }
        } else {
            $product->name .= " + soczewki";
        }

        $product->visibility = 'none';

        $product->save();

        Image::duplicateProductImages($id_product_old, $product->id, null);
        return self::createAllCombinations($product, $form);
    }

    protected static function createAllCombinations(Product $product, array $form)
    {
        $id_type = Configuration::get('KKGLASSES_ATTR_TYPE');
        $id_thin = Configuration::get('KKGLASSES_ATTR_THIN');
        foreach($form[$id_type] as $id_type_attribute => $type_value) {
            foreach($form[$id_thin] as $id_thin_attribute => $thin_value) {
                if(isset($type_value['active']) && isset($thin_value['active'])) {
                    $combinationAttributes = array($id_type_attribute, $id_thin_attribute);
                    
                    if(!$type_value['price'] || !$thin_value['price'])
                        continue;

                    if(!$product->productAttributeExists($combinationAttributes))
                    {
                        $price = $type_value['price'] + $thin_value['price'];
                        $weight = 0;
                        $ecotax = 0;
                        $unit_price_impact="";
                        $reference = "";
                        $ean13 = "";
                        $default = false;
            
                        $idProductAttribute = $product->addAttribute((float)$price, (float)$weight, $unit_price_impact, (float)$ecotax, "", strval($reference), strval($ean13), $default, NULL, NULL);
            
                        $combination = new Combination((int) $idProductAttribute);
            
                        $combination->setAttributes($combinationAttributes);
                    }
                }

            }
        }

        return $product->id;
    }

    protected static function updateCreatorProduct(int $id_product, array $form) : int
    {
        $id_creator_product = self::getCreatorProductId($id_product); 
        $product = new Product($id_creator_product);
        $product->deleteProductAttributes();
        self::createAllCombinations($product, $form);

        return $id_creator_product;
    }
}