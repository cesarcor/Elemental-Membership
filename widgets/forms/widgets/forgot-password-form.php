<?php

namespace ElementalMembership\Widgets\Forms;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

class Forgot_Password_Form extends Widget_Base{

    public function get_name() {
        return 'forgot-password-form';
    }

	public function get_title() {
        return __('Forgot Password Form', 'elemental-membership');
    }

	public function get_icon() {
        return '';
    }

	public function get_categories() {
        return ['elemental-membership-category'];
    }

	protected function register_controls() {
        $this->start_controls_section(
            'fields_section',
            [
                'label' => __( 'Fields', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_labels',
            [
                'label' => __('Show Label', 'elemental-membership'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
		);
		
		$this->add_control(
			'custom_labels',
			[
				'label' => __( 'Custom Label', 'elemental-membership' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'email_label',
			[
				'label' => __( 'Email Label', 'elemental-membership' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Your Email', 'elemental-membership' ),
				'condition' => [
					'show_labels' => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'email_placeholder',
			[
				'label' => __( 'Email Placeholder', 'elemental-membership' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Email', 'elemental-membership' ),
				'condition' => [
					'custom_labels' => 'yes',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => __( 'Submit Button', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Submit',
                'placeholder' => ''
            ]
		);

		$this->add_control(
			'button_size',
			[
				'label' => __( 'Size', 'elemental-membership' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'xs' => __( 'Extra Small', 'elemental-membership' ),
					'sm' => __( 'Small', 'elemental-membership' ),
					'md' => __( 'Medium', 'elemental-membership' ),
					'lg' => __( 'Large', 'elemental-membership' ),
					'xl' => __( 'Extra Large', 'elemental-membership' ),
				],
				'default' => 'sm',
			]
        );
        
        $this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'elemental-membership' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => __( 'Left', 'elemental-membership' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elemental-membership' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __( 'Right', 'elemental-membership' ),
						'icon' => 'eicon-text-align-right',
					],
					'stretch' => [
						'title' => __( 'Justified', 'elemental-membership' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-button-align-',
				'default' => '',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'links_section',
            [
                'label' => __( 'Links', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'register_link_text',
			[
				'label' => __( 'Register Link Text', 'elemental-membership' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Register', 'elemental-membership' )
			]
        );
        
        $this->add_control(
			'login_link_text',
			[
				'label' => __( 'Login Link Text', 'elemental-membership' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Login', 'elemental-membership' )
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'em_form_style',
            [
                'label' => __( 'Form', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'row_gap',
			[
				'label' => __( 'Rows Gap', 'elemental-membership' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '10',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-field-group' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
        );
        
        $this->add_control(
			'links_color',
			[
				'label' => __( 'Links Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-field-group > a' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);

		$this->add_control(
			'links_hover_color',
			[
				'label' => __( 'Links Hover Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-field-group > a:hover' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_4,
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'em_form_label_style',
			[
				'label' => __( 'Label', 'elemental-membership' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_labels!' => '',
				],
			]
        );
        
        $this->add_control(
			'label_spacing',
			[
				'label' => __( 'Spacing', 'elemental-membership' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '0',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'selectors' => [
					'body {{WRAPPER}} .elementor-field-group > label' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					// for the label position = above option
				],
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => __( 'Text Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-field-group label' => 'color: {{VALUE}};',
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
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} .elementor-field-group label',
				'scheme' => Schemes\Typography::TYPOGRAPHY_3,
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'em_form_field_style',
            [
                'label' => __( 'Fields', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'field_text_color',
			[
				'label' => __( 'Text Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-field-group .elementor-field' => 'color: {{VALUE}};',
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
				'name' => 'field_typography',
				'selector' => '{{WRAPPER}} .elementor-field-group .elementor-field, {{WRAPPER}} .elementor-field-subgroup label',
				'scheme' => Schemes\Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_control(
			'field_background_color',
			[
				'label' => __( 'Background Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .elementor-field-group .elementor-field:not(.elementor-select-wrapper)' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'field_border_color',
			[
				'label' => __( 'Border Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-field-group .elementor-field:not(.elementor-select-wrapper)' => 'border-color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'field_border_width',
			[
				'label' => __( 'Border Width', 'elemental-membership' ),
				'type' => Controls_Manager::DIMENSIONS,
				'placeholder' => '1',
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-field-group .elementor-field:not(.elementor-select-wrapper)' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'field_border_radius',
			[
				'label' => __( 'Border Radius', 'elemental-membership' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-field-group .elementor-field:not(.elementor-select-wrapper)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();


        $this->start_controls_section(
            'em_form_button_style',
            [
                'label' => __( 'Button', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
			'button_text_color',
			[
				'label' => __( 'Text Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .em-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'scheme' => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .em-button',
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => __( 'Background Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .em-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .em-button',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'elemental-membership' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .em-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_text_padding',
			[
				'label' => __( 'Text Padding', 'elemental-membership' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .em-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label' => __( 'Text Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .em-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .em-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .em-button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_border_border!' => '',
				],
			]
		);

		$this->add_control(
			'button_hover_animation',
			[
				'label' => __( 'Animation', 'elemental-membership' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();

    }

	protected function render() {
        $settings = $this->get_settings();
    ?>

        <form class="em-forgot-password-form elementor-form">

                <div class="elementor-field-group elementor-column elementor-col-100">
                    <?php if('yes' === $settings['show_labels']): ?>
                      <label for="forgot-pw-email">
                        <?php echo 'yes' === $settings['custom_labels'] ? $settings['email_label'] : __('Your Email', 'elemental-membership'); ?>
                      </label>
                    <?php endif; ?>
                    <input type="email" id="forgot-pw-email" class="elementor-field" placeholder="<?php echo $settings['custom_labels'] == 'yes' ? $settings['email_placeholder'] : __('Email', 'elemental-membership'); ?>"/>
                </div>

                <div <?php echo $this->get_render_attribute_string( 'submit-group' ); ?>>
                    <button type="submit" class="em-button elementor-button elementor-size-<?php echo $settings['button_size']; ?>">
                        <?php echo $settings['button_text']; ?>
                    </button>
                </div>

                <div class="elementor-field-group elementor-column elementor-col-100">
                    <div><a href="#"><?php echo $settings['register_link_text']; ?></a></div>
                    <div><a href="#"><?php echo $settings['login_link_text']; ?></a></div>
                </div>

                <input type="hidden" name="action" value="em_forgot_pwd" />
                <?php wp_nonce_field( 'em_forgot_pwd_nonce' ); ?>

        </form>

    <?php

    }

	protected function _content_template() {
    ?>

        <div class="elementor-form">

                <div class="elementor-field-group elementor-column elementor-col-100">
                    <# if('yes' === settings.show_labels){ #>
                        <label for="forgot-pw-email">
                            <#
                                if('yes' === settings.custom_labels){
                                    {{{ settings.email_label }}}
                                }else{
                                #>
                                    <?php echo __('Your Email', 'elemental-membership'); ?>
                                <#
                                } 
                            #>
                        </label>
                    <# } #>
                        <input type="email" id="forgot-pw-email" class="elementor-field" placeholder="{{{ settings.email_placeholder }}}"/>
                </div>
                
                <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100">
                    <button type="submit" class="em-button elementor-button elementor-size-{{ settings.button_size }}">
                        {{{ settings.button_text }}}
                    </button>
                </div>

                <div class="elementor-field-group elementor-column elementor-col-100">
                    <div class="em-form-footer-link"><a href="#">{{{ settings.login_link_text }}}</a></div>
                    <div class="em-form-footer-link"><a href="#">{{{ settings.register_link_text }}}</a></div>
                </div>
                        
        </div>

        
    <?php
    }

}