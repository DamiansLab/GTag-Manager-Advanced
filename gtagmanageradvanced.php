<?php
/**
 * GTag Manager Advanced - Google Consent Mode, GA4 and Google Ads conversion tracking for PrestaShop.
 *
 * @author    DamiansLab <https://damianslab.gr>
 * @copyright 2025 DamiansLab (Ηλίας Δαμιανίδης)
 * @license   Proprietary, see license.txt (DamiansLab End User License Agreement)
 */

// Βεβαιωθείτε ότι το αρχείο εκτελείται μόνο από το PrestaShop περιβάλλον
if (!defined('_PS_VERSION_')) {
    exit;
}

// Κύρια κλάση του module
class GtagManagerAdvanced extends Module
{
    /** Year of the first release, printed in the footer. */
    const COPYRIGHT_YEAR = '2025';

    public function __construct()
    {
        // Ορισμός βασικών πληροφοριών module
        $this->name = 'gtagmanageradvanced'; // Όνομα του module (folder name)
        $this->version = '1.2.0';
        $this->author = 'DamiansLab';
        $this->author_uri = 'https://damianslab.gr';
        $this->tab = 'analytics_stats';
        $this->need_instance = 0;
        $this->bootstrap = true; // Χρήση Bootstrap για admin UI

        parent::__construct();

        // Εμφανιζόμενες πληροφορίες στο Back Office
        $this->displayName = $this->l('GTag Manager Advanced');
        $this->description = $this->l('Υποστήριξη για Google Consent Mode (Advanced) με multilingual banner συγκατάθεσης. GA4 ecommerce purchase + Google Ads conversion tracking με πραγματικές αξίες παραγγελιών.');
    }

    /**
     * Shared DamiansLab header ('header') and footer ('footer') of every back office page of the module.
     * See DAMIANSLAB-MODULE-STANDARD.md.
     */
    public function renderChrome($part, array $vars = array())
    {
        $this->context->smarty->assign(array_merge(array(
            'dl_logo' => $this->_path . 'logo.png',
            'dl_name' => $this->displayName,
            'dl_version' => $this->version,
            'dl_year' => self::COPYRIGHT_YEAR,
            'dl_tagline' => '',
            'dl_button' => null,
            'dl_links' => array(),
            'dl_disclaimer' => '',
        ), $vars));

        return $this->display(__FILE__, 'module_' . $part . '.tpl');
    }

    // Εκτελείται κατά την εγκατάσταση του module
    public function install()
    {
        return parent::install()
            // Δήλωση hooks όπου θα εισαχθεί ο κώδικας
            && $this->registerHook('displayHeader')
            && $this->registerHook('displayFooter')
            && $this->registerHook('displayOrderConfirmation')
            // Αρχικοποίηση default τιμών ρυθμίσεων
            && Configuration::updateValue('GTAG_ADVANCED_ID', 'G-XXXXXXXXXX')
            && Configuration::updateValue('GTAG_ADVANCED_BANNER_TEXT_EL', 'Χρησιμοποιούμε cookies για καλύτερη εμπειρία και αναλύσεις.')
            && Configuration::updateValue('GTAG_ADVANCED_BANNER_TEXT_EN', 'We use cookies for better experience and analytics.')
            && Configuration::updateValue('GTAG_ADVANCED_AW_ID', '')
            && Configuration::updateValue('GTAG_ADVANCED_AW_LABEL', '');
    }

    // Εκτελείται κατά την απεγκατάσταση του module
    public function uninstall()
    {
        return parent::uninstall()
            // Διαγραφή όλων των τιμών configuration
            && Configuration::deleteByName('GTAG_ADVANCED_ID')
            && Configuration::deleteByName('GTAG_ADVANCED_BANNER_TEXT_EL')
            && Configuration::deleteByName('GTAG_ADVANCED_BANNER_TEXT_EN')
            && Configuration::deleteByName('GTAG_ADVANCED_AW_ID')
            && Configuration::deleteByName('GTAG_ADVANCED_AW_LABEL');
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
            Configuration::updateValue('GTAG_ADVANCED_AW_ID', trim(Tools::getValue('GTAG_ADVANCED_AW_ID')));
            Configuration::updateValue('GTAG_ADVANCED_AW_LABEL', trim(Tools::getValue('GTAG_ADVANCED_AW_LABEL')));
            $output .= $this->displayConfirmation($this->l('Settings updated successfully.'));
        }

        // Κοινό header και footer της DamiansLab (DAMIANSLAB-MODULE-STANDARD.md)
        $this->context->controller->addCSS($this->_path . 'views/css/dl-chrome.css');

        // Επιστροφή header + μηνύματος + φόρμας + footer
        return $this->renderChrome('header', array(
                'dl_tagline' => $this->l('Google Consent Mode, GA4 and Google Ads conversion tracking'),
            ))
            . $output . $this->renderForm()
            . $this->renderChrome('footer', array(
                'dl_disclaimer' => $this->l('It is an independent integration and is not affiliated with Google.'),
            ));
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
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Google Ads Conversion ID'),
                        'name' => 'GTAG_ADVANCED_AW_ID',
                        'desc' => $this->l('Μορφή: AW-XXXXXXXXXX. Άδειο = απενεργοποιημένο Google Ads conversion tracking.')
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Google Ads Conversion Label'),
                        'name' => 'GTAG_ADVANCED_AW_LABEL',
                        'desc' => $this->l('Το label του conversion action αγοράς από το Google Ads.')
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
        $helper->fields_value['GTAG_ADVANCED_AW_ID'] = Configuration::get('GTAG_ADVANCED_AW_ID');
        $helper->fields_value['GTAG_ADVANCED_AW_LABEL'] = Configuration::get('GTAG_ADVANCED_AW_LABEL');

        return $helper->generateForm([$fieldsForm]);
    }

    // Hook στο <head> (π.χ. για gtag.js script)
    public function hookDisplayHeader($params)
    {
        // Στέλνουμε το GA ID στο Smarty για χρήση στο header.tpl
        $this->context->smarty->assign([
            'gtag_id' => Configuration::get('GTAG_ADVANCED_ID'),
            'gtag_aw_id' => Configuration::get('GTAG_ADVANCED_AW_ID')
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

    // Hook στη σελίδα επιβεβαίωσης παραγγελίας:
    // Στέλνει GA4 ecommerce "purchase" + Google Ads "conversion" με πραγματική αξία,
    // νόμισμα και transaction_id (order reference) για deduplication.
    public function hookDisplayOrderConfirmation($params)
    {
        // Προστασία από διπλή εμφάνιση αν το theme καλέσει το hook 2 φορές
        static $done = false;
        if ($done) {
            return '';
        }
        $done = true;

        $order = isset($params['order']) ? $params['order'] : null;
        if (!Validate::isLoadedObject($order)) {
            return '';
        }

        $currency = new Currency((int)$order->id_currency);
        $isoCode = Validate::isLoadedObject($currency) ? $currency->iso_code : 'EUR';

        // Προϊόντα της παραγγελίας για το GA4 items array
        $items = [];
        foreach ($order->getProducts() as $p) {
            $items[] = [
                'item_id'   => !empty($p['product_reference']) ? $p['product_reference'] : (string)$p['product_id'],
                'item_name' => isset($p['product_name']) ? $p['product_name'] : '',
                'price'     => isset($p['unit_price_tax_incl']) ? round((float)$p['unit_price_tax_incl'], 2) : 0,
                'quantity'  => isset($p['product_quantity']) ? (int)$p['product_quantity'] : 1,
            ];
        }

        $value = round((float)$order->total_paid, 2); // Σύνολο με ΦΠΑ + μεταφορικά
        $tax = round((float)$order->total_paid_tax_incl - (float)$order->total_paid_tax_excl, 2);
        $shipping = round((float)$order->total_shipping_tax_incl, 2);

        // GA4 purchase event (deduplication μέσω transaction_id)
        $purchase = [
            'transaction_id' => $order->reference,
            'value'          => $value,
            'tax'            => $tax,
            'shipping'       => $shipping,
            'currency'       => $isoCode,
            'items'          => $items,
        ];

        // Google Ads conversion event (μόνο αν έχουν οριστεί ID + label στις ρυθμίσεις)
        $awId = trim((string)Configuration::get('GTAG_ADVANCED_AW_ID'));
        $awLabel = trim((string)Configuration::get('GTAG_ADVANCED_AW_LABEL'));
        $conversionJson = null;
        if ($awId !== '' && $awLabel !== '') {
            $conversionJson = json_encode([
                'send_to'        => $awId . '/' . $awLabel,
                'value'          => $value,
                'currency'       => $isoCode,
                'transaction_id' => $order->reference,
            ], JSON_UNESCAPED_UNICODE);
        }

        $this->context->smarty->assign([
            'gtag_purchase_json'   => json_encode($purchase, JSON_UNESCAPED_UNICODE),
            'gtag_conversion_json' => $conversionJson,
        ]);

        return $this->display(__FILE__, 'orderConfirmation.tpl');
    }
}
