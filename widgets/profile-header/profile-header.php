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
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name' => 'profile_header_typography',
                'label' => __('Typography', 'elemental-membership'),
				'selector' => '{{WRAPPER}} .em-profile-identifier',
				'scheme' => Schemes\Typography::TYPOGRAPHY_3,
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
				'label' => __( 'Image Radius', 'elemental-membership' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
					'unit' => 'px',
					'size' => 150,
				],
				'selectors' => [
					'{{WRAPPER}} .em-user-avatar img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

                            <ul class="em-list">
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