<?php

namespace ElementalMembership\Widgets\ProfileHeader;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Profile_Banner extends Widget_Base {
    public function get_name() {
        return 'em-profile-banner';
    }

    public function get_title() {
        return __('Profile Banner', 'elemental-membership');
    }

    public function get_icon() {
        return '';
    }

    public function get_categories() {
        return ['elemental-membership-category'];
    }

    public function get_keywords() {
        return ['banner'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'em_profile_banner_section',
            [
                'label' => __('Profile Banner', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'default_banner_image',
				'label' => __( 'Default Banner Image', 'elemental-membership' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .em-profile-banner__bg',
			]
		);

        $this->add_control(
            'profile_banner_height',
            [
                'label' => __('Banner Height', 'elemental-membership'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
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
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} .em-profile-banner__bg' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'profile_banner_radius',
            [
                'label' => __('Profile Banner Radius', 'elemental-membership'),
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
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .em-profile-banner__bg' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'banner_button_section',
            [
                'label' => __('Button', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'banner_button_link',
            [
                'label' => __('Banner Button Link', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('Choose Popup', 'elemental-membership'),
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'banner_button_icon',
            [
                'label' => __('Banner Button Icon', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-image',
                    'library' => 'solid',
                ],
                'separator' => 'after'
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'button_style',
            [
                'label' => __('Button', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'banner_widget_button_typography',
                'label' => __('Banner Btn Typography', 'elemental-membership'),
                'selector' => '{{WRAPPER}} .em-profile-btn-text',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
            'change_banner_btn_bg_color',
            [
                'label' => __('Button Background', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'default' => '#e5e5e5',
                'selectors' => [
                    '{{WRAPPER}} .em-profile-btn' => 'background-color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display(); ?>
        <div class="em-profile-banner">
            <div class="em-profile-banner__bg"></div>
            <div class="em-profile-banner__change">
            <?php if (is_user_logged_in()): ?>
                <div class="em-profile-btn">
                    <a <?php echo $this->get_render_attribute_string('banner_button'); ?>>
                        <?php \Elementor\Icons_Manager::render_icon($settings['banner_button_icon'], ['aria-hidden' => 'true']); ?>
                        <span class="em-profile-btn-text"><?php echo __('Change Image', 'elemental-membership'); ?></span>
                    </a>
                </div>
            <?php endif; ?>
        </div>

    <?php
    }

    protected function _content_template() {
        ?>

        <# 
            var banner_btn_icon = elementor.helpers.renderIcon( view, settings.banner_button_icon, { 'aria-hidden': true }, 'i' , 'object' );  
        #>

        <div class="em-profile-banner">
            <div class="em-profile-banner__bg"></div>
            <div class="em-profile-banner__change">
            <div class="em-profile-btn">
                <a <?php echo $this->get_render_attribute_string('banner_button'); ?>>
                    {{{ banner_btn_icon.value }}}
                    <?php echo __('Change Image', 'elemental-membership'); ?>
                </a>
            </div>
        </div>

    <?php
    }
}
