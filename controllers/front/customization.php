<?php

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

class KkGlassesCustomizationModuleFrontController extends ModuleFrontController
{
    public function displayAjax()
    {
        $id_product = Tools::getValue('id_product');
        $texts = $this->context->cart->getProductCustomization($id_product, Product::CUSTOMIZE_TEXTFIELD);
        $id_customization = 0;

        foreach($texts as $text) {
            $id_customization = $text['id_customization'];
        }
        
        echo json_encode(array(
            'id_customization' => $id_customization
        ));
    }
}