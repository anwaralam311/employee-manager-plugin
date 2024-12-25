<?php
/*
Plugin Name: Employee Salary Manager 
Description: A plugin to manage employee data and calculate average salary.
Version: 1.0
Author: Anwar Alam Gilani
*/


function emp_register_employee_post_type() { // create custom post type 'Employee'
    $args = array(
        'labels' => array(
            'name' => 'Employees',
            'singular_name' => 'Employee',
        ),
        'public' => false,
        'show_ui' => true,
        'supports' => array('title', 'custom-fields'),
        'capability_type' => 'post',
        'has_archive' => false,
    );
    register_post_type('employee', $args);
}
add_action('init', 'emp_register_employee_post_type');

function emp_add_employee_meta_boxes() {
    add_meta_box('emp_employee_meta_box', 'Employee Details', 'emp_render_employee_meta_box', 'employee', 'normal', 'high');
}
add_action('add_meta_boxes', 'emp_add_employee_meta_boxes');





function emp_render_employee_meta_box($post) {
    wp_nonce_field(basename(__FILE__), 'emp_employee_nonce');
    
    $name = get_post_meta($post->ID, '_emp_name', true);
    $position = get_post_meta($post->ID, '_emp_position', true);
    $email = get_post_meta($post->ID, '_emp_email', true);
    $date_of_hire = get_post_meta($post->ID, '_emp_date_of_hire', true);
    $salary = get_post_meta($post->ID, '_emp_salary', true);
    
    echo '<table style="width: 100%; max-width: 600px; border:1px">';
    echo '<tr>';
    echo '<td style="padding: 8px; text-align: right;"><label for="emp_name">Name:</label></td>';
    echo '<td><input type="text" name="emp_name" value="' . esc_attr($name) . '" style="width: 100%; padding: 6px;"/></td>';
    echo '</tr>';
    
    echo '<tr>';
    echo '<td style="padding: 8px; text-align: right;"><label for="emp_position">Position:</label></td>';
    echo '<td><input type="text" name="emp_position" value="' . esc_attr($position) . '" style="width: 100%; padding: 6px;"/></td>';
    echo '</tr>';
    
    echo '<tr>';
    echo '<td style="padding: 8px; text-align: right;"><label for="emp_email">Email:</label></td>';
    echo '<td><input type="email" name="emp_email" value="' . esc_attr($email) . '" style="width: 100%; padding: 6px;"/></td>';
    echo '</tr>';
    
    echo '<tr>';
    echo '<td style="padding: 8px; text-align: right;"><label for="emp_date_of_hire">Date of Hire:</label></td>';
    echo '<td><input type="date" name="emp_date_of_hire" value="' . esc_attr($date_of_hire) . '" style="width: 100%; padding: 6px;"/></td>';
    echo '</tr>';
    
    echo '<tr>';
    echo '<td style="padding: 8px; text-align: right;"><label for="emp_salary">Salary:</label></td>';
    echo '<td><input type="number" name="emp_salary" value="' . esc_attr($salary) . '" style="width: 100%; padding: 6px;"/></td>';
    echo '</tr>';
    echo '</table>';
    
}

function emp_save_employee_meta($post_id) {
    if (!isset($_POST['emp_employee_nonce']) || !wp_verify_nonce($_POST['emp_employee_nonce'], basename(__FILE__))) return;
    
    update_post_meta($post_id, '_emp_name', sanitize_text_field($_POST['emp_name']));
    update_post_meta($post_id, '_emp_position', sanitize_text_field($_POST['emp_position']));
    update_post_meta($post_id, '_emp_email', sanitize_email($_POST['emp_email']));
    update_post_meta($post_id, '_emp_date_of_hire', sanitize_text_field($_POST['emp_date_of_hire']));
    update_post_meta($post_id, '_emp_salary', sanitize_text_field($_POST['emp_salary']));
}
add_action('save_post', 'emp_save_employee_meta');


function emp_enqueue_average_salary_script() {
    wp_enqueue_script('average-salary-script', plugin_dir_url(__FILE__) . 'js/average-salary.js', array('jquery'), null, true);
    wp_localize_script('average-salary-script', 'emp_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('admin_enqueue_scripts', 'emp_enqueue_average_salary_script');




require_once plugin_dir_path(__FILE__) . 'average-salary.php';
require_once plugin_dir_path(__FILE__) . 'employee-list.php';
require_once plugin_dir_path(__FILE__) . 'export-csv.php';

