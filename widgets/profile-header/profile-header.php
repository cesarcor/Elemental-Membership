<?php

namespace ElementalMembership\Widgets\ProfileHeader;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use ElementalMembership\Includes\Core\Profile;

class Profile_Header extends Widget_Base{

    public function get_name(){
        return 'em-profile-header';
    }

    public function get_title(){
        return __('EM Profile Header', 'elemental-membership');
    }

    public function get_icon(){
        return 'em-profile-header';
    }

    public function get_categories(){
        return ['elemental-membership-category'];
    }

    protected function register_controls(){

        $repeater = new Repeater();

        $this->start_controls_section(
            'em_profile_header_section',
            [
                'label' => __('Profile Header', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_profile_action_menu',
            [
                'label' => __('Show Action Menu', 'elemental-membership'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elemental-membership'),
                'label_off' => __('Hide', 'elemental-membership'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_logout_link',
            [
                'label' => __('Logout Link', 'elemental-membership'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elemental-membership'),
                'label_off' => __('Hide', 'elemental-membership'),
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'em_profile_name_section',
            [
                'label' => __('Profile Name', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'em_display_name',
			[
				'label' => __( 'Display Name', 'elemental-membership' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'full_name',
				'options' => [
					'full_name'  => __( 'Full Name', 'elemental-membership' ),
					'username' => __( 'Username', 'elemental-membership' ),
					'nickname' => __( 'Nickname', 'elemental-membership' ),
                    'fist_name'  => __( 'First Name', 'elemental-membership' ),
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'em_profile_menu_section',
            [
                'label' => __('Profile Menu', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater->add_control(
            'menu_item_text',
            [
                'label' => __('Link Text', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Item'
            ]
        );

        $repeater->add_control(
            'menu_item_url',
            [
                'label' => __('URL', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::URL
            ]
        );

        $repeater->add_control(
			'item_visible_to',
			[
				'label' => __( 'Visible To', 'elemental-membership' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'everyone' => __( 'Everyone', 'elemental-membership' ),
                    'logged_in_only' => __( 'Logged in user only', 'elemental-membership' ),
                    'profile_owner_only' => __( 'Profile owner only', 'elemental-membership' ),
				],
                'default' => 'everyone',
                'separator' => 'before',
			]
        );

        $this->add_control(
            'profile_menu_list',
            [
                'label' => __('Profile Menu', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'menu_item_text' => __('Menu Item One', 'elemental-membership')
                    ],

                    [
                        'menu_item_text' => __('Menu Item Two', 'elemental-membership')
                    ]
                ],
                'title_field' => '{{{ menu_item_text }}}',
            ]
        );

        $this->end_controls_section();

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
            'profile_image',
            [
                'label' => __('Profile Image', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'profile_user_image_width',
            [
                'label' => __('Profile Image Width', 'elemental-membership'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 80,
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
                    'size' => 150,
                ],
                'selectors' => [
                    '{{WRAPPER}} .em-user-avatar' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'profile_user_image_radius',
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
                    'size' => 150,
                ],
                'selectors' => [
                    '{{WRAPPER}} .em-user-avatar img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'profile_image_margin',
            [
                'label' => __('Profile Photo Margin', 'elemental-membership'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                    'top' => '0',
                    'right' => '20',
                    'bottom' => '80',
                    'left' => '20',
                ],
                'selectors' => [
                    '{{WRAPPER}} .em-user-avatar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'logout_link',
            [
                'label' => __('Logout Link', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'logout_link_text',
			[
				'label' => __( 'Logout Link Text', 'elemental-membership' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Logout', 'elemental-membership' )
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'header_buttons',
            [
                'label' => __('Buttons', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'banner_button_link',
			[
				'label' => __( 'Banner Button Link', 'elemental-membership' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'Choose Popup', 'elemental-membership' ),
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
				'label' => __( 'Banner Button Icon', 'elemental-membership' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-image',
					'library' => 'solid',
                ],
			]
        );

        $this->add_control(
			'banner_button_icon_spacing',
			[
				'label' => __( 'Banner Button Icon Spacing', 'elementor' ),
                'label_block' => true,
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button-link i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
                'separator' => 'after',
			]
		);

        $this->add_control(
			'image_button_link',
			[
				'label' => __( 'Image Button Link', 'elemental-membership' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'Choose Popup', 'elemental-membership' ),
                'dynamic' => [
                    'active' => true,
				],
				'default' => [
					'url' => '#',
				],
			]
		);

        
        $this->add_control(
			'image_button_icon',
			[
				'label' => __( 'Image Button Icon', 'elemental-membership' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-camera',
					'library' => 'solid',
                ],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'em_profile_header_text_style',
            [
                'label' => __('Header Text', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'profile_header_name_typography',
                'label' => __('Profile Name Typography', 'elemental-membership'),
                'selector' => '{{WRAPPER}} .em-profile-identifier',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
			'profile_header_name_color',
			[
				'label' => __( 'Profile Name Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .em-profile-identifier' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'profile_header_actions_typography',
                'label' => __('Profile Actions Typography', 'elemental-membership'),
                'selector' => '{{WRAPPER}} .em-header-actions li a',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'em_profile_header_image_style',
            [
                'label' => __('Profile Image', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'profile_menu_styles',
            [
                'label' => __('Menu', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'profile_menu_typography',
                'label' => __('Typography', 'elemental-membership'),
                'selector' => '{{WRAPPER}} .em-profile-menu-list li a',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
            ]
        );

        $this->start_controls_tabs( 'menu_item_color' );

        $this->start_controls_tab(
			'menu_item_color_normal',
			[
				'label' => __( 'Normal', 'elemental-membership' ),
			]
        );

        $this->add_control(
            'profile_menu_color',
            [
                'label' => __('Text Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .em-profile-menu-list li a' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
			'menu_item_color_hover',
			[
				'label' => __( 'Hover', 'elemental-membership' ),
			]
        );

        $this->add_control(
            'profile_menu_color_hover',
            [
                'label' => __('Text Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .em-profile-menu-list li a:hover' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'profile_header_buttons_styles',
            [
                'label' => __('Header Buttons', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'header_button_styles' );

        $this->start_controls_tab(
			'header_buttons_styles_normal',
			[
				'label' => __( 'Normal', 'elemental-membership' ),
			]
        );

        $this->add_control(
            'change_image_btn_color',
            [
                'label' => __('Image Button Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .em-user-avatar__change .em-profile-btn' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->add_control(
            'change_image_btn_bg_color',
            [
                'label' => __('Image Button Background', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'default' => '#e5e5e5',
                'selectors' => [
                    '{{WRAPPER}} .em-user-avatar__change .em-profile-btn' => 'background: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->add_control(
            'change_banner_btn_color',
            [
                'label' => __('Banner Button Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .em-profile-banner__change .em-profile-btn' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'change_banner_btn_bg_color',
            [
                'label' => __('Banner Button Background', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'default' => '#e5e5e5',
                'selectors' => [
                    '{{WRAPPER}} .em-profile-banner__change .em-profile-btn' => 'background-color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
			'header_buttons_styles_hover',
			[
				'label' => __( 'Hover', 'elemental-membership' ),
			]
        );

        $this->add_control(
            'change_image_btn_color_hover',
            [
                'label' => __('Image Button Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .em-user-avatar__change .em-profile-btn:hover' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->add_control(
            'change_image_btn_bg_color_hover',
            [
                'label' => __('Image Button Background', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'default' => '#e5e5e5',
                'selectors' => [
                    '{{WRAPPER}} .em-user-avatar__change .em-profile-btn:hover' => 'background: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->add_control(
            'change_banner_btn_color_hover',
            [
                'label' => __('Banner Button Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .em-profile-banner__change .em-profile-btn' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'change_banner_btn_bg_color_hover',
            [
                'label' => __('Banner Button Background', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'default' => '#e5e5e5',
                'selectors' => [
                    '{{WRAPPER}} .em-profile-banner__change .em-profile-btn:hover' => 'background-color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'banner_button_typography',
                'label' => __('Banner Btn Typography', 'elemental-membership'),
                'selector' => '{{WRAPPER}} .em-profile-btn-text',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'em_profile_header_logout_style',
            [
                'label' => __('Logout Link', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'profile_header_logout_typography',
                'label' => __('Link Typography', 'elemental-membership'),
                'selector' => '{{WRAPPER}} .em-logout-btn',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
            ]
        );

        $this->start_controls_tabs( 'logout_link_style' );

        $this->start_controls_tab(
			'logout_link_normal',
			[
				'label' => __( 'Normal', 'elemental-membership' ),
			]
        );

        $this->add_control(
            'profile_header_logout_color',
            [
                'label' => __('Link Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .em-logout-btn' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->add_control(
            'profile_header_logout_bg',
            [
                'label' => __('Link Background', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .em-logout-btn' => 'background-color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
                'default' => 'rgba(255, 255, 255, 0)'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
			'logout_link_hover',
			[
				'label' => __( 'Hover', 'elemental-membership' ),
			]
        );

        $this->add_control(
            'profile_header_logout_hover_color',
            [
                'label' => __('Link Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .em-logout-btn:hover' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->add_control(
            'profile_header_logout_hover_bg',
            [
                'label' => __('Link Background', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .em-logout-btn:hover' => 'background-color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
                'default' => 'rgba(255, 255, 255, 0)'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
			'profile_header_logout_padding',
			[
				'label' => __( 'Padding', 'elemental-membership' ),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .em-logout-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

    }

    protected function render(){
        $settings = $this->get_settings_for_display();
        $profile = new Profile();
        $display_name = "";

        if ( ! empty( $settings['banner_button_link']['url'] ) ):
			$this->add_link_attributes( 'banner_button', $settings['banner_button_link'] );
			$this->add_render_attribute( 'banner_button', 'class', 'elementor-button-link' );
            $this->add_render_attribute( 'banner_button', 'id', 'banner-button' );
        endif;
        
    ?>

        <div class="em-profile-header">

            <div class="em-profile-banner">
                <div class="em-profile-banner__bg"></div>
                <div class="em-profile-banner__change">
                <?php if(is_user_logged_in()): ?>
                    <div class="em-profile-btn">
                        <a <?php echo $this->get_render_attribute_string( 'banner_button' ); ?>>
                            <?php \Elementor\Icons_Manager::render_icon( $settings['banner_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            <span class="em-profile-btn-text"><?php echo __('Change Image', 'elemental-membership'); ?><span>
                        </a>
                    </div>
                <?php endif; ?>
                </div>
            </div>

            <div class="em-profile-header-wrapper">

                <div class="em-profile-header-user">

                    <div class="em-row">

                        <div class="em-col em-user-avatar">
                            <?php echo get_avatar(get_the_author_meta('email'), '60'); ?>
                            <?php if(is_user_logged_in()): ?>
                                <div class="em-user-avatar__change">
                                    <div class="em-profile-btn">
                                        <?php \Elementor\Icons_Manager::render_icon( $settings['image_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="em-col em-profile-modifier-actions">

                                <?php
                                    switch($settings['em_display_name']):
                                        case 'full_name':
                                            $display_name = $profile->get_user_full_name();
                                        break;
                                        case 'username':
                                            $display_name = $profile->em_get_username();
                                        break;
                                        case 'first_name':
                                            $display_name = $profile->get_user_first_name();
                                        break;
                                        case 'nickname':
                                            $display_name = $profile->em_get_user_nickname();
                                        break;
                                    endswitch;
                                ?>

                            <h2 class="em-profile-identifier">
                                <?php
                                    printf(esc_html($display_name));
                                ?>
                            </h2>

                            <?php if ('yes' === $settings['show_profile_action_menu'] && is_user_logged_in()): ?>
                                <ul class="em-list em-header-actions">
                                    <li><a href="#"><?php echo __("Edit Profile", "elemental-membership"); ?></a></li>
                                    <li><a href="#"><?php echo __("Settings", "elemental-membership"); ?></a></li>
                                </ul>
                            <?php endif;?>

                        </div>

                        <div class="em-col em-profile-header-nav">
                            <ul class="em-list em-profile-menu-list">
                                <?php 
                                    //elementor-hidden-tablet elementor-hidden-phone elementor-hidden-desktop
                                    if($settings['profile_menu_list']): 
                                        foreach($settings['profile_menu_list'] as $item):
                                            $target = $item['menu_item_url']['is_external'] ? ' target="_blank"' : '';
                                            $nofollow = $item['menu_item_url']['nofollow'] ? ' rel="nofollow"' : '';
                                            $item_logged_in_var = ('logged_in_only' === $item['item_visible_to']) ? is_user_logged_in() : true;

                                            if($item_logged_in_var):
                                                echo '<li><a href="' . $item['menu_item_url']['url'] . '"' . $target . $nofollow . '>' . $item['menu_item_text'] . '</a></li>';
                                            endif;
                                        endforeach;
                                    endif; 
                                 ?>
                            </ul>

							<?php if ('yes' === $settings['show_logout_link'] && is_user_logged_in()): ?>
								<a href="<?php echo wp_logout_url(); ?>" class="em-link-btn em-logout-btn">
									<?php echo esc_html($settings['logout_link_text']); ?>
								</a>
							<?php endif;?>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    <?php
}

}