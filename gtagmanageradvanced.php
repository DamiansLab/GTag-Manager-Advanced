<?php

// Βεβαιωθείτε ότι το αρχείο εκτελείται μόνο από το PrestaShop περιβάλλον
if (!defined('_PS_VERSION_')) {
    exit;
}

// Κύρια κλάση του module
class GtagManagerAdvanced extends Module
{
    public function __construct()
    {
        // Ορισμός βασικών πληροφοριών module
        $this->name = 'gtagmanageradvanced'; // Όνομα του module (folder name)
        $this->version = '1.1.0';
        $this->author = 'Damian';
        $this->need_instance = 0;
        $this->bootstrap = true; // Χρήση Bootstrap για admin UI

        parent::__construct();

        // Εμφανιζόμενες πληροφορίες στο Back Office
        $this->displayName = $this->l('GTag Manager Advanced');
        $this->description = $this->l('Υποστήριξη για Google Consent Mode (Advanced) με multilingual banner συγκατάθεσης.');
    }

    // Εκτελείται κατά την εγκατάσταση του module
    public function install()
    {
        return parent::install()
            // Δήλωση hooks όπου θα εισαχθεί ο κώδικας
            && $this->registerHook('displayHeader')
            && $this->registerHook('displayFooter')
            // Αρχικοποίηση default τιμών ρυθμίσεων
            && Configuration::updateValue('GTAG_ADVANCED_ID', 'G-XXXXXXXXXX')
            && Configuration::updateValue('GTAG_ADVANCED_BANNER_TEXT_EL', 'Χρησιμοποιούμε cookies για καλύτερη εμπειρία και αναλύσεις.')
            && Configuration::updateValue('GTAG_ADVANCED_BANNER_TEXT_EN', 'We use cookies for better experience and analytics.');
    }

    // Εκτελείται κατά την απεγκατάσταση του module
    public function uninstall()
    {
        return parent::uninstall()
            // Διαγραφή όλων των τιμών configuration
            && Configuration::deleteByName('GTAG_ADVANCED_ID')
            && Configuration::deleteByName('GTAG_ADVANCED_BANNER_TEXT_EL')
            && Configuration::deleteByName('GTAG_ADVANCED_BANNER_TEXT_EN');
    }

    // Εμφάνιση της σελίδας ρυθμίσεων στο Back Office
    public function getContent()
    {
        $output = '';

        // Αν υποβλήθηκε η φόρμα, αποθηκεύουμε τις τιμές
        if (Tools::isSubmit('submit_gtagmanageradvanced')) {
            Configuration::updateValue('GTAG_ADVANCED_ID', Tools::getValue('GTAG_ADVANCED_ID'));
            Configuration::updateValue('GTAG_ADVANCED_BANNER_TEXT_EL', Tools::getValue('GTAG_ADVANCED_BANNER_TEXT_EL'));
            Configuration::updateValue('GTAG_ADVANCED_BANNER_TEXT_EN', Tools::getValue('GTAG_ADVANCED_BANNER_TEXT_EN'));
            $output .= $this->displayConfirmation($this->l('Settings updated successfully.'));
        }

        // Επιστροφή μηνύματος + εμφάνιση της φόρμας
        return $output . $this->renderForm();
    }

    // Κατασκευή της φόρμας ρυθμίσεων
    protected function renderForm()
    {
        $defaultLang = (int)Configuration::get('PS_LANG_DEFAULT');

        // Ορισμός πεδίων της φόρμας
        $fieldsForm = [
            'form' => [
                'legend' => [
                    'title' => $this->l('GTag Manager Advanced Settings'),
                    'icon' => 'icon-cogs'
                ],
                'input' => [
                    [
                        'type' => 'text',
                        'label' => $this->l('GA4 Measurement ID'),
                        'name' => 'GTAG_ADVANCED_ID',
                        'required' => true
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Cookie Banner Text (Greek)'),
                        'name' => 'GTAG_ADVANCED_BANNER_TEXT_EL'
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Cookie Banner Text (English)'),
                        'name' => 'GTAG_ADVANCED_BANNER_TEXT_EN'
                    ]
                ],
                'submit' => [
                    'title' => $this->l('Save'),
                    'class' => 'btn btn-default pull-right'
                ]
            ]
        ];

        // Χρήση του HelperForm για κατασκευή HTML
        $helper = new HelperForm();
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->identifier = $this->identifier;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
        $helper->default_form_language = $defaultLang;
        $helper->allow_employee_form_lang = true;
        $helper->submit_action = 'submit_' . $this->name;

        // Ανάθεση τιμών από τη βάση για τα πεδία
        $helper->fields_value['GTAG_ADVANCED_ID'] = Configuration::get('GTAG_ADVANCED_ID');
        $helper->fields_value['GTAG_ADVANCED_BANNER_TEXT_EL'] = Configuration::get('GTAG_ADVANCED_BANNER_TEXT_EL');
        $helper->fields_value['GTAG_ADVANCED_BANNER_TEXT_EN'] = Configuration::get('GTAG_ADVANCED_BANNER_TEXT_EN');

        return $helper->generateForm([$fieldsForm]);
    }

    // Hook στο <head> (π.χ. για gtag.js script)
    public function hookDisplayHeader($params)
    {
        // Στέλνουμε το GA ID στο Smarty για χρήση στο header.tpl
        $this->context->smarty->assign([
            'gtag_id' => Configuration::get('GTAG_ADVANCED_ID')
        ]);
        return $this->display(__FILE__, 'header.tpl');
    }

    // Hook στο footer (π.χ. για εμφάνιση banner συγκατάθεσης)
    public function hookDisplayFooter($params)
    {
        // Ανάθεση τιμών στο template για το banner
        $this->context->smarty->assign([
            'gtag_id' => Configuration::get('GTAG_ADVANCED_ID'),
            'banner_text_el' => Configuration::get('GTAG_ADVANCED_BANNER_TEXT_EL'),
            'banner_text_en' => Configuration::get('GTAG_ADVANCED_BANNER_TEXT_EN'),
        ]);
        return $this->display(__FILE__, 'displayFooter.tpl');
    }
}
