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
        $id_creator_product = self::getCreatorProduct($id_product);
        if($id_creator_product) {

        } else {
            $product = new Product($id_product);
            $product->id = null;
            $product->save();
        }

        return $id_creator_product;
    }

    public static function getCreatorProduct(int $id_product) : int
    {
        $db = Db::getInstance();

        $id_creator_product = $db->getValue("SELECT id_creator_product FROM " . self::$prefix_table . " WHERE id_product = $id_product");
        return $id_creator_product;
    }
}