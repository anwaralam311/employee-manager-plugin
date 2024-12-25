<?php
// employee-list.php

function emp_render_employee_list_page() {
    global $wpdb;
    
    echo '<h2>Employee List</h2>';
    echo '<button id="calculate_avg_salary">Calculate Average Salary</button>';
    echo '<p id="average_salary_display"></p>'; 

    $employees = new WP_Query(array('post_type' => 'employee', 'posts_per_page' => -1));
    echo '<table style="width: 100%; max-width: 600px; border: 1px solid black; border-collapse: collapse;">';
    echo '<tr><th>Name</th><th>Position</th><th>Email</th><th>Date of Hire</th><th>Salary</th></tr>';
    
    while ($employees->have_posts()) {
        $employees->the_post();
        $name = get_post_meta(get_the_ID(), '_emp_name', true);
        $position = get_post_meta(get_the_ID(), '_emp_position', true);
        $email = get_post_meta(get_the_ID(), '_emp_email', true);
        $date_of_hire = get_post_meta(get_the_ID(), '_emp_date_of_hire', true);
        $salary = get_post_meta(get_the_ID(), '_emp_salary', true);
        
        echo '<tr>';
        echo '<td>' . esc_html($name) . '</td>';
        echo '<td>' . esc_html($position) . '</td>';
        echo '<td>' . esc_html($email) . '</td>';
        echo '<td>' . esc_html($date_of_hire) . '</td>';
        echo '<td>' . esc_html($salary) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    wp_reset_postdata();
}
add_action('admin_menu', function() {
    add_submenu_page('edit.php?post_type=employee', 'Employee List', 'Employee List', 'manage_options', 'employee-list', 'emp_render_employee_list_page');
});
