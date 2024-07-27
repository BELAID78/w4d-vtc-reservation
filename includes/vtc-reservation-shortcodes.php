<?php

// Shortcode pour afficher le formulaire de réservation
function vtc_reservation_form_shortcode($atts) {
    $atts = shortcode_atts([
        'driver_id' => ''
    ], $atts);

    $api_key = get_option('vtc_google_maps_api_key', '');

    ob_start();
    ?>

    <form id="vtc-reservation-form" style="max-width: 600px; margin: 0 auto; padding: 20px; background: #f9f9f9; border: 1px solid #ccc; border-radius: 10px;">
        <label for="pickup_address">Adresse de prise en charge</label>
        <input type="text" id="pickup_address" name="pickup_address" placeholder="Adresse de prise en charge" class="regular-text" required>

        <label for="destination_address">Adresse de destination</label>
        <input type="text" id="destination_address" name="destination_address" placeholder="Adresse de destination" class="regular-text" required>

        <label for="pickup_datetime">Date et heure de prise en charge</label>
        <div id="react-datetime-picker"></div>

        <button type="button" onclick="useCurrentLocation()">Partir d'ici et maintenant</button>

        <input type="hidden" name="driver_id" value="<?php echo esc_attr($atts['driver_id']); ?>">

        <button type="submit" class="button button-primary">Suivant</button>
    </form>

    <script>
        function useCurrentLocation() {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                var apiKey = '<?php echo esc_js($api_key); ?>';
                var geocoder = new google.maps.Geocoder();

                geocoder.geocode({'location': {lat: lat, lng: lng}}, function(results, status) {
                    if (status === 'OK' && results[0]) {
                        document.getElementById('pickup_address').value = results[0].formatted_address;
                        document.getElementById('pickup_datetime').value = new Date().toISOString().slice(0, 16);
                    } else {
                        alert('Erreur de géolocalisation : ' + status);
                    }
                });
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_js($api_key); ?>&libraries=places"></script>
    <script src="<?php echo plugin_dir_url(__FILE__) . '../dist/bundle.js'; ?>"></script>

    <?php
    return ob_get_clean();
}

add_shortcode('vtc_reservation_form', 'vtc_reservation_form_shortcode');
?>
