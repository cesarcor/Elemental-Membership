<?php

namespace ElementalMembership\Widgets\ProfileHeader;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
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

        $this->start_controls_section(
            'picture_change_button',
            [
                'label' => __('Button', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'picture_button_icon',
			[
				'label' => __( 'Icon', 'elemental-membership' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-camera',
					'library' => 'solid',
                ],
			]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'change_picture_button',
            [
                'label' => __('Change Picture Button', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'change_picture_button_color',
            [
                'label' => __('Change Picture Button', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .em-user-picture__change .em-profile-btn' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->add_control(
            'change_picture_button_bg_color',
            [
                'label' => __('Picture Button Background', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'default' => '#e5e5e5',
                'selectors' => [
                    '{{WRAPPER}} .em-profile-picture .em-profile-btn' => 'background: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'elemental-membership' ),
                'selector' => '{{WRAPPER}} .em-profile-picture img',
                'separator' => 'before'
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
                        <?php \Elementor\Icons_Manager::render_icon( $settings['picture_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    <?php    
    }

    protected function _content_template(){}

}