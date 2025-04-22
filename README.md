
=== Employee Manage Plugin ===
Contributors: Anwar Alam Gilani
Modules: employee, custom post type, admin panel, csv export, ajax, salary, WordPress plugin

License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A WordPress plugin to manage employees via a custom post type, including salary, CSV export and AJAX average salary calculation.

== Description ==

Employee Manage Plugin allows administrators to manage employee data via a custom post type. 

The plugin provides the following features:

- Custom "Employee" post type with fields: Name, Position, Email, Date of Hire, and Salary.
- A custom admin page listing all employees with salary and filter options.
- Export employee data as a CSV file.
- AJAX functionality to calculate and display the average employee salary without page reload.

== Installation ==

1. Download the plugin ZIP file.
2. Upload the contents to the /wp-content/plugins/employee-manage-plugin/ directory.
3. Activate the plugin through the Plugins menu in WordPress.
4. Navigate to the "Employees" menu in your WordPress admin panel to start managing employees.

== Usage ==

1. Go to Employees > Add New to create a new employee record.
2. On Employees > Employee List, you can view all employee records, filter them, and export data.
3. The Average Salary will be shown on the same page via AJAX (no page refresh required).

== Development Approach ==

Task 1: Plugin Customization  
Created a custom post type `employee` with custom fields using `register_post_type`.  
Used `add_meta_boxes` and `save_post` to manage custom fields.  
Built a custom admin submenu page that displays all employees with sorting/filtering options.

Task 2: Database Security  
Used `$wpdb` to securely query employee data for CSV export.  
Export feature implemented as a secure admin action with nonce validation.  
All inputs are sanitized and outputs are escaped to follow best practices.

Task 3: AJAX & JavaScript Integration  
Enqueued a custom JS file on the admin employee list page.  
Used `wp_ajax` hooks to handle AJAX request on the backend.  
Server calculates average salary and returns JSON which is shown in the admin UI.

== Changelog ==

= 1.0.0 =  
Initial release with custom post type, admin view, CSV export, and AJAX salary calculation.

== Upgrade Notice ==

= 1.0.0 =  
Initial release. No upgrade issues.

== License ==

This plugin is licensed under the GPLv2 or later.

Thanks : Anwar Alam Gilani
