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

        <a href="<?php echo wp_logout_url(); ?>"><?php echo $settings['em_logout_link_text']; ?></a>

    <?php

    }

    public function _content_template(){
    ?>

        <a href="#">{{{ settings.em_logout_link_text }}}</a>

    <?php
    }

}