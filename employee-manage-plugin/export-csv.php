<?php
// export-csv.php

function emp_export_csv() {
    if (isset($_GET['export_employee_csv']) && current_user_can('manage_options')) {
        ob_clean();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=employees.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, array('Name', 'Position', 'Email', 'Date of Hire', 'Salary'));

        $employees = new WP_Query(array(
            'post_type' => 'employee',
            'posts_per_page' => -1
        ));

        while ($employees->have_posts()) {
            $employees->the_post();
            $name = get_post_meta(get_the_ID(), '_emp_name', true);
            $position = get_post_meta(get_the_ID(), '_emp_position', true);
            $email = get_post_meta(get_the_ID(), '_emp_email', true);
            $date_of_hire = get_post_meta(get_the_ID(), '_emp_date_of_hire', true);
            $salary = get_post_meta(get_the_ID(), '_emp_salary', true);
            fputcsv($output, array($name, $position, $email, $date_of_hire, $salary));
        }

        fclose($output);
        wp_reset_postdata();
        exit;
    }
}
add_action('admin_init', 'emp_export_csv');

function add_export_csv_button() {
    global $typenow;

    if ($typenow == 'employee') {
        echo '<a href="' . esc_url(admin_url('edit.php?post_type=employee&export_employee_csv=1')) . '" class="button button-primary" style="margin-left: 10px;">Export Employees as CSV</a>';
    }
}
add_action('restrict_manage_posts', 'add_export_csv_button');
