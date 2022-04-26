<?php

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

class KkGlassesCreatorModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();

        if(!Tools::getIsset('id_product')) {
            Tools::redirect('/');
        }

        $product = ProductTools::getTemplateProduct(Tools::getValue('id_product'));

        $this->context->smarty->assign([
            'product' => $product
        ]);

        $this->setTemplate('module:kkglasses/views/templates/front/creator.tpl');
    }
}