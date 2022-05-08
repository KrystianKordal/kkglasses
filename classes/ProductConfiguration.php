<?php

class ProductConfiguration
{   
    protected static string $table = 'kkglasses_product';
    public static function save(int $id_product, int $id_creator_product, array $form)
    {
        $db = Db::getInstance();
        print_r($form);
        die();
        $db->update(self::$table, [
            'id_creator_product' => $id_creator_product,
            'type_data' => serialize(""),
            'thin_data' => serialize("")
        ], "WHERE id_product = $id_product");
    }
}