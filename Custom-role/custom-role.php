<?php
/**
* Plugin Name: Custom Role
* Plugin URI: #
* Description: Custom Plugin created to remove unwanted capabilities for custom role
* Version: 1.0
* Author: Arisit - Sujit
* Author URI: #
**/

function ui_new_role() { 
    global $wp_roles;

    $admin = $wp_roles->get_role('administrator');

    add_role('arisit_admin','Admin',$admin->capabilities);
    
    $new_role = $wp_roles->get_role('arisit_admin');
    
    $remove_caps = ['switch_themes','edit_themes','install_themes','delete_themes','update_themes','edit_plugins','update_plugins','delete_plugins','edit_users','delete_users','create_users','list_users','remove_users','promote_users','update_core'];

    foreach($remove_caps as $cap ){
        $new_role->remove_cap($cap);
    }
    /* Delete Roles
    *
        
    
    if($wp_roles->get_role('admin2') ){
        echo "<script>console.log('YES')</script>";
     if($wp_roles->remove_role('admin2')){
         echo "<script>console.log('YESssss')</script>";
     }else{
         echo "<script>console.log('Nnnnnnnn')</script>";
     }
      
    }else{
        echo "<script>console.log('NOP')</script>";
    }*/
}

add_action('admin_init', 'ui_new_role');
