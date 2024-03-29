<?php
   /*
   Plugin Name: Wordpress Cleanup
   Plugin URI: 
   description: Files cleanup plugin by Sujit
   Version: 1.0
   Author: Sujit Joshi
   Author URI: 
   License: GPL2
   */


   // list loaded assets by our theme and plugins so we know what we're dealing with. This is viewed by admin users only.
   add_action('wp_print_footer_scripts', 'wra_list_assets', 900000);
   function wra_list_assets(){
       if ( !current_user_can('delete_users') ){
           return;
       }

       echo '<h2>List of all scripts loaded on this particular page.</h2>';
       echo '<p>This can differ from page to page depending of what is loaded in that particular page.</p>';
   
       // Print all loaded Scripts (JS)
       global $wp_scripts;
       wra_print_assets($wp_scripts);
   
       echo '<h2>List of all css styles loaded on this particular page.</h2>';
       echo '<p>This can differ from page to page depending of what is loaded in that particular page.</p>';
       // Print all loaded Styles (CSS)
       global $wp_styles;
       wra_print_assets($wp_styles);
   }


   // both $wp_styles and $wp_scripts are objects and store loaded CSS/JS files in $wp_styles->queue
   function wra_print_assets($wp_asset){
   $nb_of_asset = 0;
   foreach( $wp_asset->queue as $asset ) :
       $nb_of_asset ++;
       $asset_obj = $wp_asset->registered[$asset];
       wra_asset_template($asset_obj, $nb_of_asset);
   endforeach;
   }

   // we're using inline css since this is only for admins to see and it's ok if it's a bit messy 
   function wra_asset_template($asset_obj, $nb_of_asset){
       if( is_object( $asset_obj )){
           echo '<div class="wra_asset" style="padding: 2rem; font-size: 0.8rem; border-bottom: 1px solid #ccc;">';
   
           echo '<div class="wra_asset_nb"><span style="width: 150px; display: inline-block">Number:</span>';
           echo $nb_of_asset . '</div>';
   
   
           echo '<div class="wra_asset_handle"><span style="width: 150px; display: inline-block">Handle:</span>';
           echo $asset_obj->handle . '</div>';
   
           echo '<div class="wra_asset_src"><span style="width: 150px; display: inline-block">Source:</span>';
           echo $asset_obj->src . '</div>';
   
           echo '<div class="wra_asset_deps"><span style="width: 150px; display: inline-block">Dependencies:</span>';
           foreach( $asset_obj->deps as $deps){
               echo $deps . ' / ';
           }
           echo '</div>';
   
           echo '<div class="wra_asset_ver"><span style="width: 150px; display: inline-block">Version:</span>';
           echo $asset_obj->ver . '</div>';
   
           echo '</div>';
       }
   }
?>