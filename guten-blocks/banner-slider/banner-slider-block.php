<?php
    use BuddyBossApp\Admin\GutenbergBlockAbstract;
 
    /**
     * Class Banner
     * @package BuddyBossApp\Menus
     */
    class BannerBlock extends GutenbergBlockAbstract {
        private static $instance;
     
        /**
         * Get the instance of the class.
         *
         * @return Banner
         */
        public static function instance() {
            if ( ! isset( self::$instance ) ) {
                $class          = __CLASS__;
                self::$instance = new $class;
            }
     
            return self::$instance;
        }
     
        public function __construct() {
            $this->set_namespace( 'bbapp/banner-slider' );
            $this->set_title( "Slider de Banners" );
            $this->set_description( "Banners" );
            $this->set_icon( 'gallery' );
            $this->set_keywords( array( 'banner' ) );
     
            $attributes = $this->get_attributes();
            $this->set_attributes( $attributes );
     
            $preview = $this->get_preview();
            $this->set_preview( $preview );
     
            $this->init();
        }
     
        public function init() {
            parent::init();
            add_filter( 'bbapp_custom_block_data', array( $this, 'update_block_data' ), 10, 2 );
        }
     
        function get_attributes() {
            return array(
                array(
                    'name'      => 'title',
                    'fieldtype' => 'text',
                    'default'   => '',
                    'label'     => 'Enter Title',
                )
            )
        }
     
        function get_preview(  ) {
            $query = new WP_Query($args);
                if ($query->have_posts()) {

            ?>           


            <div id="bannerHome" uk-slideshow="animation: fade; autoplay: true">

                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">

                    <ul class="uk-slideshow-items">


                    <?php
                    while ($query->have_posts()) {
                        $query->the_post();
                        //$link = (get_field('link')) ? get_field('link') : '';
                        //$destinoLink = get_field('destino_link');
                    ?>

                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>


                        <li>
                            <a href="<?php the_field('url'); ?>" 
                    <?php if (get_field('abrir_em_outra_aba') == 'Sim') { ?>
                        target="_blank"
                    <?php } elseif (get_field('abrir_em_outra_aba') == 'Nao') { ?>
                        target="_self"
                    <?php } ?>
                                >
                                <div style="background: url('<?php echo $image[0]; ?>')" class="bannerThumb"></div>
                            </a>
                        </li>
                    <?php
                    }
                    wp_reset_postdata();
                    ?>             

                        
                    </ul>

                    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

                </div>

                <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin"></ul>

            </div>

            <?php
                }
        }
     
        function get_results( $attributes ) {
            return ob_get_clean();
        }
     
        function update_block_data( $app_page_data, $block_data ) {
     
            $data_source = array(
                'type'           => 'fetch',
                'request_params' => array(
                    'per_page' => 5,
                ),
            );
     
            $app_page_data['data']['data_source'] = $data_source;
     
            return $app_page_data;
        }
    }
?>