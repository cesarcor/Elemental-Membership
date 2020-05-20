<?php

namespace ElementalMembership\Widgets\ProfileHeader;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;

class Profile_Header extends Widget_Base{

    public function get_name(){
        return 'em-profile-header';
    }

    public function get_title(){
        return __('EM Profile Header', 'elemental-membership');
    }

    public function get_icon(){
        return 'fa fa-form';
    }

    public function get_categories(){
        return ['elemental-membership-category'];
    }

    protected function _register_controls(){

        $this->start_controls_section(
            'em_profile_header_section',
            [
                'label' => __( 'Profile Header', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'show_profile_action_menu',
			[
				'label' => __( 'Show Action Menu', 'elemental-membership' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elemental-membership' ),
				'label_off' => __( 'Hide', 'elemental-membership' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'em_profile_banner_section',
            [
                'label' => __( 'Profile Banner', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'profile_banner_image',
			[
				'label' => __( 'Choose Image', 'elemental-membership' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
        );

        $this->add_control(
			'profile_banner_height',
			[
				'label' => __( 'Banner Height', 'elemental-membership' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
        
        $this->end_controls_section();

        $this->start_controls_section(
            'profile_image',
            [
                'label' => __( 'Profile Image', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'profile_user_image_width',
			[
				'label' => __( 'Profile Image Width', 'elemental-membership' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
					'{{WRAPPER}} .em-user-avatar img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_control(
			'profile_user_image_radius',
			[
				'label' => __( 'Profile Image Radius', 'elemental-membership' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
					'{{WRAPPER}} .em-user-avatar img' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
        );
        
        $this->add_control(
			'profile_user_image_padding',
			[
				'label' => __( 'Image Padding', 'elemental-membership' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => 'px',
                    'top' => '0',
                    'right' => '20',
                    'bottom' => '0',
                    'left' => '20'
				],
				'selectors' => [
					'{{WRAPPER}} .em-user-avatar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
            'em_profile_header_text_style',
            [
                'label' => __( 'Header Text', 'elemental-membership' ),
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
                'label' => __( 'Profile Image', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            'em_profile_header_logout_style',
            [
                'label' => __( 'Logout Link', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name' => 'profile_header_logout_typography',
                'label' => __('Logout Link Typography', 'elemental-membership'),
				'selector' => '{{WRAPPER}} .em-logout-btn',
				'scheme' => Schemes\Typography::TYPOGRAPHY_3,
			]
		);
		
		$this->add_control(
			'profile_header_logout_color',
			[
				'label' => __( 'Logout Link Color', 'elemental-membership' ),
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

		$this->end_controls_section();

    }

    protected function render(){
        $settings = $this -> get_settings_for_display();
        $current_user = wp_get_current_user();
    ?>

        <div class="em-profile-header">

            <div class="em-profile-banner">
                <div class="em-profile-banner__bg" style="background-image: url(<?php echo $settings['profile_banner_image']['url']; ?>)"></div>
            </div>

            <div class="em-profile-header-wrapper">

                <div class="em-profile-header-user">

                    <div class="elementor-row em-row">

                        <div class="em-user-avatar">
                            <?php echo get_avatar( get_the_author_meta('email'), '60' );  ?>
                        </div>
                        
                        <div class="em-profile-modifier-actions">

                            <h2 class="em-profile-identifier">
                                <?php printf(esc_html($current_user->user_firstname . " " . $current_user->user_lastname)); ?>
                            </h2>

                            <ul class="em-list em-header-actions">
                                <li><a href="#">Edit Profile</a></li>
                                <li><a href="#">Settings</a></li>
                            </ul>
                        </div>

                        <div class="em-profile-header-nav">
                            <ul class="em-list">
                                <li><a href="#">Profile</a></li>
                                <li><a href="#">Posts</a></li>
                            </ul>

                            <a href="<?php echo wp_logout_url(); ?>" class="em-link-btn em-logout-btn">
                            Logout
                            </a>
                        </div>
                    
                    </div>

                </div>

            </div>
        
        </div>

    <?php
    }

    protected function _content_template(){
        
    }


}