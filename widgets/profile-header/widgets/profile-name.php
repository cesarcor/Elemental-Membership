<?php

namespace ElementalMembership\Widgets\ProfileHeader;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
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

        $this->end_controls_section();
    }

    protected function render() {
        $profile = new Profile();
        $settings = $this->get_settings_for_display(); ?>

        <h2 <?php echo $this->get_render_attribute_string('name'); ?>>
                <?php echo $profile->get_user_full_name(); ?>
        </h2>

    <?php
    }

    protected function _content_template() {
    }
}
