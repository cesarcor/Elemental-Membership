<?php

namespace ElementalMembership\Widgets\ProfileHeader;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use ElementalMembership\Includes\Classes\Profile;

class Profile_Name extends Widget_Base {
    public function get_name() {
        return 'em-profile-name';
    }

    public function get_title() {
        return __('Profile Name', 'elemental-membership');
    }

    public function get_icon() {
        return '';
    }

    public function get_categories() {
        return ['elemental-membership-category'];
    }

    public function get_keywords() {
        return ['profile name', 'heading'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'profile_name',
            [
                'label' => __('Profile Name', 'elemental-membership'),
            ]
        );

        $this->add_control(
            'size',
            [
                'label' => __('Size', 'elemental-membership'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __('Default', 'elemental-membership'),
                    'small' => __('Small', 'elemental-membership'),
                    'medium' => __('Medium', 'elemental-membership'),
                    'large' => __('Large', 'elemental-membership'),
                    'xl' => __('XL', 'elemental-membership'),
                    'xxl' => __('XXL', 'elemental-membership'),
                ],
            ]
        );

        $this->add_control(
            'name_tag',
            [
                'label' => __('HTML Tag', 'elemental-membership'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h2',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_profile_name_style',
            [
                'label' => __('Profile Name', 'elemental-membership'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Text Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .em-profile-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .em-profile-name',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $profile = new Profile();
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('name', 'class', 'em-profile-name elementor-heading-title');

        $profile_name = $profile->get_user_full_name();

        $profile_name_html = sprintf('<%1$s %2$s>%3$s</%1$s>', $settings['name_tag'], $this->get_render_attribute_string('name'), $profile_name);

        echo $profile_name_html;
    }

    protected function _content_template() {
    }
}
