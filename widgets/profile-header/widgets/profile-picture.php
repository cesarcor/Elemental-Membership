<?php

namespace ElementalMembership\Widgets\ProfileHeader;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Profile_Picture extends Widget_Base{

    public function get_name(){
        return 'em-profile-picture';
    }

    public function get_title(){
        return __('EM Profile Picture', 'elemental-membership');
    }

    public function get_icon(){
        return '';
    }

    public function get_categories(){
        return ['elemental-membership-category'];
    }

    protected function _register_controls(){

        $this->start_controls_section(
            'profile_picture',
            [
                'label' => __('Picture', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'profile_picture_radius',
            [
                'label' => __('Profile Image Radius', 'elemental-membership'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 15,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],
                'selectors' => [
                    '{{WRAPPER}} .em-profile-picture img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render(){
        $settings = $this->get_settings_for_display();
    ?>

        <div class="em-profile-picture">
            <?php echo get_avatar(get_the_author_meta('email'), '60'); ?>
            <?php if(is_user_logged_in()): ?>
                <div class="em-user-picture__change">
                    <div class="em-profile-btn">
                        <span class="dashicons dashicons-camera"></span>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    <?php    
    }

    protected function _content_template(){}

}