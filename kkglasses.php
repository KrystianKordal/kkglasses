<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

class Kkglasses extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'kkglasses';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Krystian Kordal';
        $this->need_instance = 0;

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Konfigurator okularów');
        $this->description = $this->l('Pozwala na proste dostosowanie soczewek do oprawek');

        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
    }

    public function isUsingNewTranslationSystem() { return true; }

    public function install()
    {
        require_once __DIR__ . '/sql/install.php';
        return parent::install() &&
        
            $this->registerHook('displayProductActions') &&
            $this->registerHook('displayAdminProductsExtra') &&
            $this->registerHook('actionProductSave') &&
            $this->registerHook('header');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function getContent()
    {
        if (((bool)Tools::isSubmit('submitKkglassesModule')) == true) {
            $this->postProcess();
        }

        return $this->renderForm();
    }

    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitKkglassesModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    protected function getConfigForm()
    {
        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Ustawienia atrybutów'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'col' => 2,
                        'type' => 'text',
                        'name' => 'KKGLASSES_ATTR_USE',
                        'label' => $this->l('ID atrybutu dla zastosowania soczewek'),
                    ),
                    array(
                        'col' => 2,
                        'type' => 'text',
                        'name' => 'KKGLASSES_ATTR_TYPE',
                        'label' => $this->l('ID atrybutu dla typu soczewek'),
                    ),
                    array(
                        'col' => 2,
                        'type' => 'text',
                        'name' => 'KKGLASSES_ATTR_THIN',
                        'label' => $this->l('ID atrybutu dla przycienienia soczewek'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    protected function getConfigFormValues()
    {
        return array(
            'KKGLASSES_ATTR_USE' => Configuration::get('KKGLASSES_ATTR_USE', ''),
            'KKGLASSES_ATTR_TYPE' => Configuration::get('KKGLASSES_ATTR_TYPE', ''),
            'KKGLASSES_ATTR_THIN' => Configuration::get('KKGLASSES_ATTR_THIN', ''),
        );
    }

    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }

    public function hookDisplayAdminProductsExtra($params)
    {
        $id_use = Configuration::get('KKGLASSES_ATTR_USE', 0);
        $id_type = Configuration::get('KKGLASSES_ATTR_TYPE', 0);
        $id_thin = Configuration::get('KKGLASSES_ATTR_THIN', 0);

        if(!$id_use || !$id_type || !$id_thin) {
            return;
        }

        $attributes = array(
            $id_use => AttributeGroup::getAttributes($this->context->language->id, $id_use),
            $id_type => AttributeGroup::getAttributes($this->context->language->id, $id_type),
            $id_thin => AttributeGroup::getAttributes($this->context->language->id, $id_thin),
        );

        $configuration = ProductConfiguration::getCreatorProductData($params['id_product']);

        $this->context->smarty->assign([
            'attributes' => $attributes,
            'id_use' => $id_use,
            'id_type' => $id_type,
            'id_thin' => $id_thin,
            'type_data' => $configuration['type_data'],
            'thin_data' => $configuration['thin_data'],
            'id_product' => $params['id_product'],
            'is_configurable' => ProductConfiguration::getCreatorProductId($params['id_product'])
        ]);

        return $this->display(__FILE__, 'product_configure.tpl');
    }

    public function hookActionProductSave($params)
    {
        if (Tools::getIsset('kkglasses') && isset(Tools::getValue('kkglasses')['is_configurable'])) {
            $form = Tools::getValue('kkglasses');
            unset($_POST['kkglasses']);
            $id_product = Tools::getValue('form')['id_product'];

            ProductConfiguration::save($id_product, $form);
        }
    }

    public function hookDisplayProductActions($params)
    {
        $id_creator_product = ProductConfiguration::getCreatorProductId($params['product']->id);
        $this->context->smarty->assign([
            'button_url' => $this->context->link->getModuleLink('kkglasses', 'creator', ['id_product' => $id_creator_product])
        ]);
        return $this->display(__FILE__, 'action_button.tpl');
    }

    public function hookHeader()
    {
        if(
            get_class($this->context->controller) == "KkGlassesCreatorModuleFrontController" &&
            Tools::getIsset('id_product')
        ) {
            $id_product = Tools::getValue('id_product');

            Media::addJsDef([
                'product_attributes' => ProductTools::getProductAttributes($id_product),
                'id_product' => $id_product,
                'customization_fields' => ProductTools::getCustomizationFields($id_product),
                'customization_ajax' => $this->context->link->getModuleLink($this->name, 'customization', ['ajax' => true])
            ]);

            $this->context->controller->addJS($this->_path.'/views/js/addtocart.js');
            $this->context->controller->addJS($this->_path.'/views/js/creator.js');
            $this->context->controller->addCSS($this->_path.'/views/css/creator.css');
        }
    }
}
