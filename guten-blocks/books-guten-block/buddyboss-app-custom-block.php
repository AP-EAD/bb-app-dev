<?php
namespace BuddyBossApp\Custom;
 
use BuddyBossApp\Admin\GutenbergBlockAbstract;
 
/**
 * Class Book
 * @package BuddyBossApp\Menus
 */
class BookBlock extends GutenbergBlockAbstract {
    private static $instance;
 
    /**
     * Get the instance of the class.
     *
     * @return Book
     */
    public static function instance() {
        if ( ! isset( self::$instance ) ) {
            $class          = __CLASS__;
            self::$instance = new $class;
        }
 
        return self::$instance;
    }
 
    public function __construct() {
        $this->set_namespace( 'bbapp/books' );
        $this->set_title( "Books" );
        $this->set_description( "Book" );
        $this->set_icon( 'book' );
        $this->set_keywords( array( 'book' ) );
 
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
            ),
            array(
                'name'      => 'per_page',
                'fieldtype' => 'number',
                'default'   => 5,
                'label'     => 'show items',
            )
        );
    }
 
    function get_preview(  ) {
        return "<div>
                <h3>" . esc_html__('Books', '') . "</h3>
                <ul>
                    <li id='li_one'> <div className='appboss_div'>" . esc_html__('Book Name', '') . "</div></li>
                    <li id='li_two'> <div className='appboss_div' >" . esc_html__('Book Name', '') . "</div></li>
                    <li id='li_three'> <div className='appboss_div' >" . esc_html__('Book Name', '') . "</div></li>
                </ul>
            </div>";
    }
 
    function get_results( $attrs ) {
        return array();
    }
 
    function update_block_data( $app_page_data, $block_data ) {
        $per_page = 5;
 
        // Per Page.
        if ( isset( $block_data['attrs']['per_page'] ) && ! empty( $block_data['attrs']['per_page'] ) ) {
            $per_page = absint( $block_data['attrs']['per_page'] );
        }
 
        $data_source = array(
            'type'           => 'fetch',
            'request_params' => array(
                'per_page' => $per_page,
            ),
        );
 
        $app_page_data['data']['data_source'] = $data_source;
 
        return $app_page_data;
    }
 
}

?>