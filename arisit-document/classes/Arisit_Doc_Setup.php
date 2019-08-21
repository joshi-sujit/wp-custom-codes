<?php
if (!class_exists('Arisit_Doc_Setup')) {
    class Arisit_Doc_Setup
    {
        /**
         * Private dependency checker variable
         */

        private $dependency_checker;
        private $arisit_doc;

        public function init()
        {
            $this->load_classes();
            $this->create_instances();

            try {
                $this->dependency_checker->check();
            } catch (Exception $e) {
                add_action('admin_notices', array($this, 'bind_to_admin_notice'));
                return;
            }

            /**
             * Plugin functionality starts from here
             */
        }

        private function load_classes()
        {
            // Dependency checker
            require_once dirname(__FILE__) . '/Arisit_Doc_Dependency_Checker.php';
            require_once dirname(__FILE__) . '/Arisit_Doc.php';
        }

        private function create_instances()
        {
            $this->dependency_checker = new Arisit_Doc_Dependency_Checker();
            $this->arisit_doc = new Arisit_Doc();
        }

        public function bind_to_admin_notice()
        {
            $class = 'notice notice-error is-dismissible';
            $message = __('Arisit document plugin requires woocommerce and ACF installed and activated', 'arisit-document-domain');
            printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
        }
    }
}
