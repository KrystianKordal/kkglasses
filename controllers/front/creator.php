<?php

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

class KkGlassesCreatorModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        $id_use = Configuration::get('KKGLASSES_ATTR_USE', 0);
        $id_type = Configuration::get('KKGLASSES_ATTR_TYPE', 0);
        $id_thin = Configuration::get('KKGLASSES_ATTR_THIN', 0);

        if(!$id_use || !$id_type || !$id_thin) {
            Tools::redirect("/");
        }

        if(!Tools::getIsset('id_product')) {
            Tools::redirect('/');
        }

        if(!Product::existsInDatabase(Tools::getValue('id_product'), 'product')) {
            Tools::redirect('/');
        }

        $product = ProductTools::getTemplateProduct(Tools::getValue('id_product'));
        
        $index = 0;
        $texts = array(
            $this->module->l('Korekcja starczowzroczności'),
            $this->module->l('Korekcja krótkowzroczności lub nadwzroczności'),
            $this->module->l('Soczewki "zerówki" - bez korekcji, do noszenia jako modny dodatek')
        );

        foreach ($product['attributes'][$id_use]['values'] ?? array() as $id => $attribute) {
            $product['attributes'][$id_use]['values'][$id]['desc'] = $texts[$index];
            $index++;
        }

        $this->context->smarty->assign([
            'partials_dir' => _PS_MODULE_DIR_ . 'kkglasses/views/templates/front/_partials/',
            'product' => $product,
            'id_use' => $id_use,
            'id_type' => $id_type,
            'id_thin' => $id_thin
        ]);

        $this->setTemplate('module:kkglasses/views/templates/front/creator.tpl');
        parent::initContent();
    }
}