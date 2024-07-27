<?php

// Ajouter un menu d'administration
add_action('admin_menu', 'vtc_reservation_admin_menu');

function vtc_reservation_admin_menu() {
    add_menu_page(
        'Réservations VTC',
        'Réservations VTC',
        'manage_options',
        'vtc-reservation',
        'vtc_reservation_admin_page',
        'dashicons-admin-generic'
    );
    
    add_submenu_page(
        'vtc-reservation',
        'Paramètres API',
        'Paramètres API',
        'manage_options',
        'vtc-reservation-settings',
        'vtc_reservation_settings_page'
    );
}

function vtc_reservation_admin_page() {
    echo '<h1>Gestion des Réservations VTC</h1>';
    // Code pour afficher et gérer les chauffeurs et commandes
}

function vtc_reservation_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    // Enregistrer les paramètres
    if (isset($_POST['vtc_google_maps_api_key'])) {
        update_option('vtc_google_maps_api_key', sanitize_text_field($_POST['vtc_google_maps_api_key']));
        echo '<div class="updated"><p>Clé API mise à jour</p></div>';
    }

    $api_key = get_option('vtc_google_maps_api_key', '');
    ?>
    <div class="wrap">
        <h1>Paramètres de l'API Google Maps</h1>
        <form method="post" action="">
            <label for="vtc_google_maps_api_key">Clé API Google Maps:</label>
            <input type="text" id="vtc_google_maps_api_key" name="vtc_google_maps_api_key" value="<?php echo esc_attr($api_key); ?>" class="regular-text">
            <br>
            <input type="submit" value="Enregistrer" class="button button-primary">
        </form>
    </div>
    <?php
}
?>
