<?php
if (!class_exists('Arisit_Doc')) {
    class Arisit_Doc
    {
        public function __construct()
        {
            add_action('woocommerce_single_product_summary', array($this, 'arisit_add_usermanual_specsheet'), 25);
            add_shortcode('arisit_document', array($this, 'arisit_create_shortcode'));
        }

        /**
         * Adding Usermanual on the single product page
         * 
         */

        public function arisit_add_usermanual_specsheet()
        {
            $manual = get_field('user_manual');
            $specsheet = get_field('specification_sheet');

            $a = '<div class="product-downloads">';
            $a .= ($specsheet) ? '<a href="' . $specsheet . '" target="_blank" rel="noopener noreferrer" class="btn btn-variation"><i class="fa fa-print"></i> Specification Sheet</a>' : '';
            $a .= ($manual) ? '<a href="' . $manual . '" target="_blank" rel="noopener noreferrer" class="btn btn-variation"><i class="fa fa-file-pdf-o"></i> User Manual</a>' : '';

            $a .= '</div>';
            echo $a;
        }



        /**add_shortcode( 'arisit_document', 'arisit_test' ); */

        function arisit_create_shortcode($atts)
        {
            $content = '';
            $a = shortcode_atts(array(
                'category_title' => 'My Title',
                'category_slug' => '123',
                'type' => 'user_manual'
            ), $atts);

            $products = wc_get_products(array(
                'numberposts' => -1,
                'post_status' => 'published',
                'category' => array($a['category_slug']),
            ));

            if (!empty($products)) {
                $content .= '<h3 style="margin-top: 0.5em;">' . $a['category_title'] . '</h3> <hr /> <div class="specsheet-wrapper">';


                foreach ($products as $product) {

                    $product_id = $product->get_id();
                    $a_document = get_field($a['type'], $product_id);
                    if ($a_document) {
                        $content .= '<a href="' . $a_document . '" target="_blank" class="specsheet-link"><i class="fa fa-file-pdf-o"></i> ' . $product->get_title() . '</a><br>';
                    }
                }
                $content .= '</div>';
            }
            return $content;
        }
    }
}
