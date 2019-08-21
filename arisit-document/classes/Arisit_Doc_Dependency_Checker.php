<?php
if (!class_exists('Arisit_Doc_Dependency_Checker')) {
    class Arisit_Doc_Dependency_Checker
    {
        /**
         * Define the required plugins
         */

        const REQUIRED_PLUGINS = array(
            'Woocommerce' => 'woocommerce/woocommerce.php',
            'Advanced Custom Field' => 'advanced-custom-fields/acf.php'
        );


        /**
         * Check if all required plugins are active, otherwise throw an exception.
         *
         * @throws Arisit_Doc_Missing_Dependencies_Exception
         */
        public function check()
        {
            $missing_plugins = $this->get_missing_plugins_list();
            if (!empty($missing_plugins)) {
                $msg = implode(' ,', $missing_plugins) . " plugins are required for this plugin to be active";
                throw new Exception($msg);
            }
        }

        /**
         * @return string[] Names of plugins that we require, but that are inactive.
         */
        private function get_missing_plugins_list()
        {
            $missing_plugins = array();
            foreach (self::REQUIRED_PLUGINS as $plugin_name => $main_file_path) {
                if (!$this->is_plugin_active($main_file_path)) {
                    $missing_plugins[] = $plugin_name;
                }
            }
            return $missing_plugins;
        }


        /**
         * @param string $main_file_path Path to main plugin file, as defined in self::REQUIRED_PLUGINS.
         *
         * @return bool
         */
        private function is_plugin_active($main_file_path)
        {
            return in_array($main_file_path, apply_filters('active_plugins', get_option('active_plugins')));
        }
    }
}
