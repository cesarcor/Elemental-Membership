<?php
namespace ElementalMembership\Widgets\Logout;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Logout extends Widget_Base{

    public function get_name(){
        return 'em-logout-link';
    }

    public function get_title(){
        return __('EM Logout Link', 'elemental-membership');
    }

    public function get_icon(){
        return 'fa fa-form';
    }

    public function get_categories(){
        return ['elemental-membership-category'];
    }

    public function _register_controls(){

        $logout_btn_types = [
            'button' => __('Button', 'elemental-membership'),
            'simple_link' => __('Simple Link', 'elemental-membership')
        ];

        $actions_logged_out = [
            'show_login_link' => __('Show login link', 'elemental-membership'),
            'display_nothing' => __('Display nothing', 'elemental-membership')
        ];

        $this->start_controls_section(
            'em_logout_link_section',
            [
                'label' => __( 'Logout Link', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'em_logout_link_text',
            [
                'label' => __( 'Logout Text', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Logout',
                'placeholder' => ''
            ]
        );

        $this->add_control(
            'em_logout_btn_type',
            [
                'label' => __('Logout Link Type', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'button',
                'options' => $logout_btn_types
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'em_logout_options_section',
            [
                'label' => __( 'Logout Options', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'em_logout_redirect_url',
            [
                'label' => __( 'Redirect to', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => 'https://your-link.com'
            ]
        );

        $this->add_control(
            'em_logout_after_display',
            [
                'label' => __('After Logout', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'show_login_link',
                'options' => $actions_logged_out
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'em_logout_link_style',
            [
                'label' => __( 'Logout Link Styles', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this-> end_controls_section();

    }

    public function render(){

        $settings = $this->get_settings_for_display();

    ?>

        <a href="<?php echo wp_logout_url($settings['em_logout_redirect_url']); ?>" class="em-link-btn em-logout-btn">
            <?php echo $settings['em_logout_link_text']; ?>
        </a>

    <?php

    }

    public function _content_template(){
    ?>

        <a href="#" class="em-link-btn em-logout-btn">{{{ settings.em_logout_link_text }}}</a>

    <?php
    }

}