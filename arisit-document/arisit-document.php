<?php

/**
 * Plugin Name:       Arisit Document
 * Plugin URI:        #
 * Description:       Creates a product usermanual/specification upload link
 * Version:           1.0
 * Author:            Arisit IT - Sujit 
 * Author URI:        #
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       arisit-document-domain
 */

defined('ABSPATH') || exit;

if (!class_exists('Arisit_Doc_Setup')) {
    require_once dirname(__FILE__) . '/classes/Arisit_Doc_Setup.php';
    $arisit_doc_setup = new Arisit_Doc_Setup();
    $arisit_doc_setup->init();
}
