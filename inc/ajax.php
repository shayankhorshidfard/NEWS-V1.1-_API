<?php
add_action('wp_ajax_calculate_operation', 'wp_apis_handle_ajax_operation');

function wp_apis_handle_ajax_operation()
{
    $numberOne = $_POST['numberOne'];
    $numberTwo = $_POST['numberTwo'];

    $current_user = wp_get_current_user();
    wp_send_json([
        'success' => true,
        'result' => $numberOne + $numberTwo,
        'ID' => $current_user->ID
    ]);
}