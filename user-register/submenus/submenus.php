<?php

class subMenu {
    public function __construct() {
        add_action( 'admin_menu', array(&$this, 'register_sub_menu') );
    }
    public function register_sub_menu() {
        add_menu_page(  'register-menu', 'Register User', 'manage_options', 'register-user',array(&$this, 'submenu_page_callback'), 'dashicons-admin-users', 10 );
    }

    public function submenu_page_callback() {
        require_once PLUGINPATH.'submenus/users.php';
    }
 
}
 
new subMenu();