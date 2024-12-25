<?php


function emp_ajax_average_salary() {
    global $wpdb;
    $salary = $wpdb->get_var("SELECT AVG(CAST(meta_value AS UNSIGNED)) FROM {$wpdb->postmeta} WHERE meta_key = '_emp_salary'");
    echo json_encode(array('average_salary' => round($salary, 2)));
    wp_die();
}
add_action('wp_ajax_emp_average_salary', 'emp_ajax_average_salary');
