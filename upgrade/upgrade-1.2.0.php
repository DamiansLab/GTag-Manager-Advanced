<?php
// Upgrade script 1.1.0 → 1.2.0
// Τρέχει αυτόματα όταν γίνει upload η νέα έκδοση πάνω από την παλιά.
// Δηλώνει το νέο hook (displayOrderConfirmation) και τα νέα configuration keys.

if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_1_2_0($module)
{
    // Νέα config keys (αν δεν υπάρχουν ήδη)
    if (Configuration::get('GTAG_ADVANCED_AW_ID') === false) {
        Configuration::updateValue('GTAG_ADVANCED_AW_ID', '');
    }
    if (Configuration::get('GTAG_ADVANCED_AW_LABEL') === false) {
        Configuration::updateValue('GTAG_ADVANCED_AW_LABEL', '');
    }

    // Δήλωση του νέου hook στη σελίδα επιβεβαίωσης παραγγελίας
    return $module->registerHook('displayOrderConfirmation');
}
