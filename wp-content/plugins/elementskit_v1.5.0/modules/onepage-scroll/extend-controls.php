<?php

namespace Elementor;

use \ElementsKit\Modules\Onepage_Scroll\Init;

class ElementsKit_Extend_Onepage_Scroll {
    public function __construct() {
        /**
         * Page Controls
         */
        add_action( 'elementor/documents/register_controls', [$this, 'register_page_controls'] );

        /**
         * Section Controls
         */
        add_action( 'elementor/element/section/section_advanced/after_section_end', [$this, 'register_section_controls'] );


        /**
         * Navigation Markup
         */
        add_action( 'wp_footer', [$this, 'generate_navigation_markup'] );
        add_action( 'wp_ajax_generate_navigation_markup', [$this, 'generate_navigation_markup'] );


        /**
         * Pro Notice
         */
        if ( \ElementsKit::PACKAGE_TYPE === 'free' ) {
            add_action( 'elementor/element/post/ekit_page_settings/before_section_end', [$this, 'pro_panel_notice'], 99 );
            add_action( 'elementor/element/section/ekit_onepagescroll_section/before_section_end', [$this, 'pro_panel_notice'], 99 );
        }
    }


    /**
     * Pro Panel Notice
     */
    public function pro_panel_notice($element) {
        $element->add_control(
            'ekit_control_get_pro',
            [
                'label'         => esc_html__('Unlock more possibilities', 'elementskit'),
                'type'          => \Elementor\Controls_Manager::CHOOSE,
                'options'       => [
                    '1' => [
                        'icon'  => 'fa fa-unlock-alt',
                    ],
                ],
                'default'       => '1',
                'toggle'        => false,
                'separator'     => 'before',
                'description'   => sprintf( __('%s Get the %s Pro version %s for more awesome elements and powerful modules. %s', 'elementskit'), '<span class="ekit-widget-pro-feature">', '<a href="http://go.wpmet.com/ekit-pro-widget-message" target="_blank">', '</a>', '</span>' ),
            ]
        );
    }


    /**
     * Page Controls
     */
    public function register_page_controls( Controls_Stack $element ) {
        $element->start_controls_section(
            'ekit_page_settings',
            [
                'label' => esc_html__( 'ElementsKit Settings', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_SETTINGS,
            ]
        );
            $element->add_control(
                'ekit_onepagescroll',
                [
                    'label'                 => esc_html__( 'Enable Onepage Scroll', 'elementskit' ),
                    'type'                  => Controls_Manager::SWITCHER,
                    'return_value'          => 'block',
                    'frontend_available'    => true,
                    'selectors'             => [
                        '.onepage_scroll_nav'   => 'display: {{VALUE}};',
                    ],
                ]
            );
        $element->end_controls_section();
    }


    /**
     * Section Controls
     */
    public function register_section_controls( Controls_Stack $element ) {
        $element->start_controls_section(
            'ekit_onepagescroll_section',
            [
                'label'         => esc_html__( 'ElementsKit Onepage Scroll', 'elementskit' ),
                'tab'           => Controls_Manager::TAB_ADVANCED,
                'hide_in_inner' => true,
            ]
        );
            $element->add_control(
                'ekit_has_onepagescroll',
                [
                    'label'                 => esc_html__( 'Enable Section', 'elementskit' ),
                    'type'                  => Controls_Manager::SWITCHER,
                    'frontend_available'    => true,
                    'return_value'          => 'section',
                    'prefix_class'          => 'ops-',
                ]
            );
        $element->end_controls_section();
    }


    /**
     * Navigation Markup
     */
    public function generate_navigation_markup() {
        $is_active = Init::get_page_setting('ekit_onepagescroll');
        $is_nav = $nav_style = Init::get_page_setting('ekit_onepagescroll_nav');
        $is_pro = \ElementsKit::PACKAGE_TYPE === 'pro';
        $is_editor = \Elementor\Plugin::$instance->preview->is_preview_mode();
        $nav_pos = Init::get_page_setting('ekit_onepagescroll_nav_pos');
        $nav_icon = Init::get_page_setting('ekit_onepagescroll_nav_icon');

        $is_ajax = isset( $_POST['navStyle'] ) && sanitize_text_field( $_POST['navStyle'] );
        if ( $is_ajax ):
            $is_active = 'yes';
            $is_nav = $nav_style = sanitize_text_field( $_POST['navStyle'] );
            $nav_pos = sanitize_text_field( $_POST['navPos'] );
            $nav_icon = [ 'value' => sanitize_text_field( $_POST['navIcon']['value'] ) ];
        endif;

        if ( !($is_pro && $is_active && $is_nav) ) {
            echo '</div>';
            return;
        } elseif ( !$is_ajax && $is_editor ) {
            echo '<div id="onepage_scroll_nav_wrap">';
        }

        $classlist = array(
            'wrapper'   => 'nav-style-'. $nav_style .' met_d--none met_pos--fixed ',
            'ul'        => 'met_list--none met_m--0 met_p--0 met_lh--0 ',
            'li'        => 'met_not_last_mb--20 ',
            'link'      => '',
            'tooltip'   => '',
            'arrow'     => '',
        );

        switch ( $nav_pos ) {
            case 'top':
                $classlist['wrapper']   .= 'met-'. $nav_pos .' met_top--0 met_left--50p met_translateLeft--m50p met_my--20 ';
                $classlist['ul']        .= 'met_d--flex ';
                $classlist['li']        = 'met_not_last_mr--20 ';

                $classlist['tooltip']   .= 'met_top--100p ';
                $classlist['arrow']     .= 'met_bdb_color--current met_top--100p ';
                break;
            
            case 'bottom':
                $classlist['wrapper']   .= 'met-'. $nav_pos .' met_bottom--0 met_left--50p met_translateLeft--m50p met_my--20 ';
                $classlist['ul']        .= 'met_d--flex ';
                $classlist['li']        = 'met_not_last_mr--20 ';

                $classlist['tooltip']   .= 'met_bottom--100p ';
                $classlist['arrow']     .= 'met_bdt_color--current met_bottom--100p ';
                break;

            case 'left':
                $classlist['wrapper']   .= 'met-'. $nav_pos .' met_top--50p met_left--0 met_translateTop--m50p met_mx--20 ';

                $classlist['tooltip']   .= 'met_left--100p ';
                $classlist['arrow']     .= 'met_bdr_color--current met_left--100p ';
                break;
            
            case 'right':
                $classlist['wrapper']   .= 'met-'. $nav_pos .' met_top--50p met_right--0 met_translateTop--m50p met_mx--20 ';

                $classlist['tooltip']   .= 'met_right--100p ';
                $classlist['arrow']     .= 'met_bdl_color--current met_right--100p ';
                break;
        }

        include_once( 'nav-styles/' . $nav_style . '.php' );

        if ( $is_ajax ):
            wp_die();
        elseif ( !$is_ajax && $is_editor ):
            echo '</div>';
        endif;
    }
}