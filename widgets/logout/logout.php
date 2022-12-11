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
        return 'icon-em-logout';
    }

    public function get_categories(){
        return ['elemental-membership-category'];
    }

    public function register_controls(){

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

        $this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'elemental-membership' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'elemental-membership' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elemental-membership' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elemental-membership' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'elemental-membership' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default' => '',
			]
        );
        
        $this->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'elemental-membership' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' => __( 'Icon Position', 'elemental-membership' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => __( 'Before', 'elemental-membership' ),
					'right' => __( 'After', 'elemental-membership' ),
				],
				'condition' => [
					'selected_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' => __( 'Icon Spacing', 'elemental-membership' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
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
			'logout_button_normal',
			[
				'label' => __( 'Normal', 'elemental-membership' ),
			]
        );

        $this->add_control(
			'logout_button_text_color',
			[
				'label' => __( 'Text Color', 'elemental-membership' ),
                'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
                ],
                'selectors' => [
					'{{WRAPPER}} .em-logout-btn' => 'color: {{VALUE}};',
				],
				'default' => '#FFFFFF',
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
				'default' => '#ff3232',
			]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
			'logout_button_hover',
			[
				'label' => __( 'Hover', 'elemental-membership' ),
			]
        );

        $this->add_control(
			'button_hover_color',
			[
				'label' => __( 'Text Color', 'elemental-membership' ),
                'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .em-logout-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'elemental-membership' ),
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
				'label' => __( 'Border Radius', 'elemental-membership' ),
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
				'label' => __( 'Text Padding', 'elemental-membership' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default' => [
                    'top' => 12,
                    'right' => 24,
                    'bottom' => 12,
                    'left' => 24
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
		
		$this->add_render_attribute( 'wrapper', 'class', 'elementor-button-wrapper' );

		$this->add_render_attribute( 'button', 'class', 'elementor-button em-link-btn em-logout-btn elementor-button-link' );
		$this->add_render_attribute( 'button', 'role', 'button' );

		?>

		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<a href="<?php echo wp_logout_url($settings['em_logout_redirect_url']); ?>" <?php echo $this->get_render_attribute_string( 'button' ); ?>>
				<?php $this->render_logout_text(); ?>
			</a>
		</div>

    	<?php

    }

    public function content_template(){
    ?>

	<# 
	view.addRenderAttribute( 'text', 'class', 'elementor-button-text' );
	var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' ); 
	#>

        <div class="elementor-button-wrapper">
			<a href="#" class="em-link-btn em-logout-btn elementor-button">
				<span class="elementor-button-content-wrapper">
						<# if ( settings.selected_icon ) { #>
							<span class="elementor-button-icon elementor-align-icon-{{ settings.icon_align }}">
									{{{ iconHTML.value }}}
							</span>
						<# } #>
						<span {{{ view.getRenderAttributeString( 'text' ) }}}>{{{ settings.em_logout_link_text }}}</span>
				</span>
			</a>
        </div>

    <?php
    }

    public function render_logout_text(){
        $settings = $this->get_settings_for_display();

		$this->add_render_attribute( [
			'content-wrapper' => [
				'class' => 'elementor-button-content-wrapper',
			],
			'icon-align' => [
				'class' => [
					'elementor-button-icon',
					'elementor-align-icon-' . $settings['icon_align'],
				],
			],
			'text' => [
				'class' => 'elementor-button-text',
			],
		] );

		$this->add_inline_editing_attributes( 'text', 'none' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if (! empty( $settings['selected_icon']['value'] ) ){ ?>
			<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
				<i class="<?php echo esc_attr( $settings['selected_icon']['value'] ); ?>" aria-hidden="true"></i>
			</span>
			<?php } ?>
			<span <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo $settings['em_logout_link_text']; ?></span>
		</span>
		<?php
    }

}