<?php
namespace ElementalMembership\Widgets\Forms;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use ElementalMembership\Widgets\Forms\Classes\Field_Creation;

class Login_Form extends Widget_Base{

    public function get_name(){
        return 'em-login-form';
    }

    public function get_title(){
        return __('EM Login Form', 'elemental-membership');
    }

    public function get_icon(){
        return 'fa fa-form';
    }

    public function get_categories(){
        return ['elemental-membership-category'];
    }

    protected function _register_controls(){

        $em_login_identifiers = [
            'username_email' => __('Username & Email', 'elemental-membership'),
            'username_only' => __('Username Only', 'elemental-membership'),
            'email_only' => __('Email Only', 'elemental-membership')
        ];

        $this->start_controls_section(
            'em_login_fields_section',
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
			'user_label',
			[
				'label' => __( 'Username Label', 'elemental-membership' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Username or Email Address', 'elemental-membership' ),
				'condition' => [
					'show_labels' => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'user_placeholder',
			[
				'label' => __( 'Username Placeholder', 'elemental-membership' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Username or Email Address', 'elemental-membership' ),
				'condition' => [
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'password_label',
			[
				'label' => __( 'Password Label', 'elemental-membership' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Password', 'elemental-membership' ),
				'condition' => [
					'show_labels' => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'password_placeholder',
			[
				'label' => __( 'Password Placeholder', 'elemental-membership' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Password', 'elemental-membership' ),
				'condition' => [
					'custom_labels' => 'yes',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'em_login_button_section',
            [
                'label' => __( 'Login Button', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'em_login_button_text',
            [
                'label' => __( 'Button Text', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Login',
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
            'em_login_options_section',
            [
                'label' => __( 'Login Options', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'em_login_identifier_opt',
            [
                'label' => __('Login Identifier', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'username_email',
                'options' => $em_login_identifiers
            ]
        );

        $this->add_control(
            'em_show_lost_pw_link',
            [
                'label' => __('Lost your Password?', 'elemental-membership'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'label_on' => __('Show', 'elemental-membership'),
                'label_off' => __('Hide', 'elemental-membership')
            ]
		);
		
		$this->add_control(
            'login_form_view',
            [
                'label' => __('View As', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [  
                    'not_loggedin_view' => 'User not logged in',
                    'is_loggedin_view' => 'User logged in'
                ],
                'default' => 'not_loggedin_view',
            ]
		);
		
		$this->add_control(
			'already_loggedin_message',
			[
				'label' => __( 'Already Logged in Text', 'elemental-membership' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 2,
				'default' => __( 'You are already logged in', 'elemental-membership' )
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'em_login_form_style',
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
					'{{WRAPPER}} .elementor-field-group' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-form-fields-wrapper' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
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
			'em_login_form_label_style',
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
					'{{WRAPPER}} .elementor-form-fields-wrapper label' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .elementor-form-fields-wrapper label',
				'scheme' => Schemes\Typography::TYPOGRAPHY_3,
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'em_login_form_field_style',
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
            'em_login_form_button_style',
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
	
	private function form_fields_render_attributes() {
		$settings = $this->get_settings();

		if ( ! empty( $settings['button_size'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['button_size'] );
		}

		if ( $settings['button_hover_animation'] ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
		}

		$this->add_render_attribute(
			[
				'wrapper' => [
					'class' => [
						'elementor-form-fields-wrapper',
					],
				],
				'field-group' => [
					'class' => [
						'elementor-field-type-text',
						'elementor-field-group',
						'elementor-column',
						'elementor-col-100',
					],
				],
				'submit-group' => [
					'class' => [
						'elementor-field-group',
						'elementor-column',
						'elementor-field-type-submit',
						'elementor-col-100',
					],
				],

				'button' => [
					'class' => [
						'elementor-button',
					],
					'name' => 'wp-submit',
				],
				'user_label' => [
					'for' => 'user',
				],
				'user_input' => [
					'type' => 'text',
					'name' => 'log',
					'id' => 'user',
					'placeholder' => $settings['user_placeholder'],
					'class' => [
						'elementor-field',
						'elementor-field-textual',
						// 'elementor-size-' . $settings['input_size'],
					],
				],
				'password_input' => [
					'type' => 'password',
					'name' => 'pwd',
					'id' => 'password',
					'placeholder' => $settings['password_placeholder'],
					'class' => [
						'elementor-field',
						'elementor-field-textual',
						// 'elementor-size-' . $settings['input_size'],
					],
				],
				//TODO: add unique ID
				'label_user' => [
					'for' => 'user',
					'class' => 'elementor-field-label',
				],

				'label_password' => [
					'for' => 'password',
					'class' => 'elementor-field-label',
				],
			]
		);

		if ( ! $settings['show_labels'] ) {
			$this->add_render_attribute( 'label', 'class', 'elementor-screen-only' );
		}

		$this->add_render_attribute( 'field-group', 'class', 'elementor-field-required' )
			 ->add_render_attribute( 'input', 'required', true )
			 ->add_render_attribute( 'input', 'aria-required', 'true' );

	}

    protected function render(){
        $settings = $this -> get_settings_for_display();
    ?>

	<?php
		if((is_user_logged_in() && !\Elementor\Plugin::$instance->editor->is_edit_mode())
		|| (is_user_logged_in() &&
		$settings['login_form_view'] == 'is_loggedin_view')
		):
	?>

		<div class="em-user-loggedin-msg">
	   		<?php echo $settings['already_loggedin_message']; ?>
		</div>

	<?php 
		else:

		$this->form_fields_render_attributes();
	?>

		<form class="em-user-login-form elementor-form">
			<div class="elementor-login elementor-form">

			<div class="elementor-form-fields-wrapper elementor-labels-above">

				<div class="elementor-field-group elementor-column elementor-col-100">

					<?php
					
						$login_with = "";

						switch($settings['em_login_identifier_opt']):
							case "username_only":
								$login_with = __("Username", "elemental-membership");
							break;
							case "username_email":
								$login_with = __("Username or Email", "elemental-membership");
							break;
							case "email_only":
								$login_with = __("Email", "elemental-membership");
							break;
						endswitch;
					
					?>

					<?php
						if('yes' === $settings['show_labels']):
					?>

						<label>
							<?php echo $settings['custom_labels'] == 'yes' ? $settings['user_label'] : $login_with; ?>
						</label>
					
					<?php endif; ?>

					<input type="text" name="login_fields[user_login]" placeholder="<?php echo $settings['custom_labels'] == 'yes' ? $settings['user_placeholder'] : $login_with; ?>" class="elementor-field"/>

				</div>

				<div class="elementor-field-group elementor-column elementor-col-100">
					
					<?php if('yes' === $settings['show_labels']): ?>
						<label><?php echo $settings['custom_labels'] == 'yes' ? $settings['password_label'] : __('Password', 'elemental-membership'); ?></label>
					<?php endif; ?>

					<input type="password" name="login_fields[user_login_pwd]" placeholder="<?php echo $settings['custom_labels'] == 'yes' ? $settings['password_placeholder'] : __('Password', 'elemental-membership'); ?>" class="elementor-field"/>
				</div>

				<div class="elementor-field-group elementor-column elementor-col-100">
					<label>
						<input type="checkbox" name="login_fields[user_remember_me]" value="yes"/>
						Remember Me
					</label>
				</div>

				<div <?php echo $this->get_render_attribute_string( 'submit-group' ); ?>>
					<button type="submit" class="em-button elementor-button elementor-size-<?php echo $settings['button_size']; ?>">
						<?php echo $settings['em_login_button_text']; ?>
					</button>
				</div>

				<div class="elementor-field-group elementor-column elementor-col-100">
					<a href="#">Lost your password?</a>
				</div>

				<input type="hidden" name="action" value="em_login_user" />
				<?php wp_nonce_field( 'em_login_nonce' ); ?>

				</div>
			</div>
		</form>


	<?php
		endif;
	?>

    <?php
    }

    protected function _content_template(){
    ?>

	<# if(settings.login_form_view == 'not_loggedin_view'){ #>

		<div class="em-user-login-form elementor-login elementor-form">

            <div class="elementor-form-fields-wrapper elementor-labels-above">

				<div class="elementor-field-group elementor-column elementor-col-100">
				<# 
					var login_with = 'Username or Email Address';
					
						switch(settings.em_login_identifier_opt){
							case 'email_only':
								login_with = 'Email Address';
							break;
							case 'username_only':
								login_with = 'Username';
							break;
						}

				#>

				<# if('yes' === settings.show_labels){ #>
					<label for="user-login">
						<# 
						 if('yes' === settings.custom_labels){
						 	{{{ settings.user_label }}}
						 }else{
							 {{{ login_with }}}
						 } 
						 #>
					</label>
				<# } #>
					<input type="text" id="user-login" placeholder="{{{ settings.custom_labels == 'yes' ? settings.user_placeholder : login_with }}}" class="em-form-field em-user-login elementor-field"/>
				</div>

				<div class="elementor-field-group elementor-column elementor-col-100">
				<# if('yes' === settings.show_labels){#>
					<label for="login-password">{{{ settings.password_label }}}</label>
				<# } #>
					<input type="password" id="login-password" placeholder="{{{ settings.password_placeholder }}}" class="em-form-field em-user-login-pw elementor-field"/>
				</div>

				<div class="elementor-field-group elementor-column elementor-col-100">
					<label for="">
						<input type="checkbox" />
						Remember Me
					</label>
				</div>

				<div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100">
					<button type="submit" class="em-button elementor-button elementor-size-{{ settings.button_size }}">
						{{{ settings.em_login_button_text }}}
					</button>
				</div>

				<# if(settings.em_show_lost_pw_link){ #>
					<div class="elementor-field-group elementor-column elementor-col-100">
						<a href="#">Lost your password?</a>
					</div>
				<# } #>

            </div>

        </div>

	<# } else{ #>

		<div class="em-user-loggedin-msg">
         {{{ settings.already_loggedin_message }}}
        </div>

	<# } #>

    <?php
    }

}