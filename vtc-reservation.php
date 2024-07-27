<?php
/*
Plugin Name: VTC Reservation
Description: Plugin pour la réservation des VTC en fonction de la distance et de la durée.
Version: 1.0
Author: Votre Nom
*/

// Sécuriser le fichier en empêchant l'accès direct
if (!defined('ABSPATH')) {
    exit;
}

// Inclure les fichiers nécessaires
include_once plugin_dir_path(__FILE__) . 'includes/vtc-reservation-functions.php';
include_once plugin_dir_path(__FILE__) . 'includes/vtc-reservation-shortcodes.php';
include_once plugin_dir_path(__FILE__) . 'includes/vtc-reservation-admin.php';
include_once plugin_dir_path(__FILE__) . 'includes/vtc-reservation-driver.php';

// Activation et désactivation du plugin
register_activation_hook(__FILE__, 'vtc_reservation_activate');
register_deactivation_hook(__FILE__, 'vtc_reservation_deactivate');

function vtc_reservation_activate() {
    // Code pour exécuter à l'activation du plugin
    add_option('vtc_google_maps_api_key', '');
}

function vtc_reservation_deactivate() {
    // Code pour exécuter à la désactivation du plugin
    delete_option('vtc_google_maps_api_key');
}
?>
