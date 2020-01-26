<?php
namespace ElementalMembership\Widgets\Logout;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;

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
                'label' => __( 'Logout Link', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography',
				'selector' => '{{WRAPPER}} .em-logout-btn',
				'scheme' => Schemes\Typography::TYPOGRAPHY_3,
			]
        );

        $this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'label' => __( 'Text Shadow', 'plugin-domain' ),
                'selector' => '{{WRAPPER}} .em-logout-btn',
                'separator' => 'after'
			]
        );
        
        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'elemental-membership' ),
			]
        );

        $this->add_control(
			'field_text_color',
			[
				'label' => __( 'Text Color', 'elementor-pro' ),
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
			'em_button_background_color',
			[
				'label' => __( 'Background Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .em-logout-btn' => 'background-color: {{VALUE}};',
				],
			]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'elemental-membership' ),
			]
        );

        $this->add_control(
			'button_hover_color',
			[
				'label' => __( 'Text Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .em-logout-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .em-logout-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
        );
        
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'link_border',
                'selector' => '{{WRAPPER}} .em-logout-btn',
                'separator' => 'before'
			]
        );

        $this->add_control(
			'link_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .em-logout-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .em-logout-btn',
			]
		);

        $this->add_control(
			'link_text_padding',
			[
				'label' => __( 'Text Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default' => [
                    'top' => 5,
                    'right' => 10,
                    'bottom' => 5,
                    'left' => 10
                ],
				'selectors' => [
					'{{WRAPPER}} .em-logout-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
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