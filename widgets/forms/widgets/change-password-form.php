<?php

namespace ElementalMembership\Widgets\Forms;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use ElementalMembership\Widgets\Forms\Traits\Password_Change;
use Elementor\Plugin;

//Exit if accessed directly
if (!defined('ABSPATH')){
    exit;
}

class Change_Password_Form extends Widget_Base {

    use Password_Change;

    public function get_name() {
        return 'change-password-form';
    }

    public function get_title() {
        return __('Change Password Form', 'elemental-membership');
    }

    public function get_icon() {
        return 'icon-em-change-password';
    }

    public function get_categories() {
        return ['elemental-membership-category'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'fields',
            [
                'label' => __('Fields', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_labels',
            [
                'label' => __('Show Labels', 'elemental-membership'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => __('Submit Button', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Submit',
                'placeholder' => ''
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => __('Size', 'elemental-membership'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'xs' => __('Extra Small', 'elemental-membership'),
                    'sm' => __('Small', 'elemental-membership'),
                    'md' => __('Medium', 'elemental-membership'),
                    'lg' => __('Large', 'elemental-membership'),
                    'xl' => __('Extra Large', 'elemental-membership'),
                ],
                'default' => 'sm',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'elemental-membership'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => __('Left', 'elemental-membership'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'elemental-membership'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => __('Right', 'elemental-membership'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'stretch' => [
                        'title' => __('Justified', 'elemental-membership'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'prefix_class' => 'elementor%s-button-align-',
                'default' => '',
            ]
        );

		$this->end_controls_section();
		
		$this->start_controls_section(
            'user_logged_out_section',
            [
                'label' => __('Logged Out Users', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		
		$this->add_control(
            'change_password_form_view',
            [
                'label' => __('View As', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'logged_in_view' => 'User is logged in',
                    'not_logged_in_view' => 'User is logged out'
                ],
                'default' => 'logged_in_view'
            ]
        );
		
		$this->add_control(
            'logged_out_user_text',
            [
                'label' => __('Logged Out User Text', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => __('You must be logged in to change your password', 'elemental-membership')
            ]
		);
		
		$this->end_controls_section();

        $this->start_controls_section(
            'validation_messages',
            [
                'label' => __('Validation Messages', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

        $this->add_control(
			'vm_current_pass',
			[
				'label' => __( 'Current password not correct', 'elemental-membership' ),
                'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Failed, current password is incorrect', 'elemental-membership' ),
			]
		);

        $this->add_control(
			'vm_passwords_mismatch',
			[
				'label' => __( 'Passwords don\'t match', 'elemental-membership' ),
                'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Failed, password confirmation has to match new password', 'elemental-membership' ),
			]
		);

        $this->end_controls_section();
		
        $this->start_controls_section(
            'em_form_style',
            [
                'label' => __('Form', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'row_gap',
            [
                'label' => __('Rows Gap', 'elemental-membership'),
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

        $this->end_controls_section();

        $this->start_controls_section(
            'em_form_label_style',
            [
                'label' => __('Label', 'elemental-membership'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_labels!' => '',
                ],
            ]
        );

        $this->add_control(
            'label_spacing',
            [
                'label' => __('Spacing', 'elemental-membership'),
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
                ],
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => __('Text Color', 'elemental-membership'),
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
                'label' => __('Fields', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'field_text_color',
            [
                'label' => __('Text Color', 'elemental-membership'),
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
                'label' => __('Background Color', 'elemental-membership'),
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
                'label' => __('Border Color', 'elemental-membership'),
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
                'label' => __('Border Width', 'elemental-membership'),
                'type' => Controls_Manager::DIMENSIONS,
                'placeholder' => '1',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-field-group .elementor-field:not(.elementor-select-wrapper)' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'field_border_radius',
            [
                'label' => __('Border Radius', 'elemental-membership'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-field-group .elementor-field:not(.elementor-select-wrapper)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'em_form_button_style',
            [
                'label' => __('Button', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __('Normal', 'elemental-membership'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Text Color', 'elemental-membership'),
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
                'label' => __('Background Color', 'elemental-membership'),
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
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .em-button',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'elemental-membership'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .em-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_text_padding',
            [
                'label' => __('Text Padding', 'elemental-membership'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .em-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __('Hover', 'elemental-membership'),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __('Text Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .em-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label' => __('Background Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .em-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __('Border Color', 'elemental-membership'),
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
                'label' => __('Animation', 'elemental-membership'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'validation_message_styling',
            [
                'label' => __('Validation Messages', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'error_message_color',
            [
                'label' => __('Validation Errors', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .em-form-error' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
                'default' => '#ed2828'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'error_message_typography',
                'selector' => '{{WRAPPER}} .em-form-error',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
            ]
        );
        
        $this->add_control(
            'success_message_color',
            [
                'label' => __('Validation Success', 'elemental-membership'),
                'separator' => 'before',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .em-form-success' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
                'default' => '#10b766'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'success_message_typography',
                'selector' => '{{WRAPPER}} .em-form-success',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

		if ($this->em_user_is_in_editor()){
			$this->render_user_loggedout_message(); 
		} else{
			$this->render_form();
		} 
    }

    protected function content_template() {
        ?>

		<# if(settings.change_password_form_view == 'not_logged_in_view') { #>

			<div class="em-user-registered-msg">
                  {{{ settings.logged_out_user_text }}}
            </div>

		<# } else { #>
        
        <div class="em-form elementor-form">
            <div class="elementor-field-group elementor-column elementor-col-100">
                <# if('yes' === settings.show_labels){ #>
                <label for="old-pwd"><?php echo __('Old Passsword', 'elemental-membership'); ?></label>
                <# } #>
                <input type="password" class="elementor-field" id="old-pwd"/>
            </div>

            <div class="elementor-field-group elementor-column elementor-col-100">
                <# if('yes' === settings.show_labels){ #>
                <label for="new-pwd"><?php echo __('New Password', 'elemental-membership'); ?></label>
                <# } #>
                <input type="password" class="elementor-field" id="new-pwd"/>
            </div>

            <div class="elementor-field-group elementor-column elementor-col-100">
                <# if('yes' === settings.show_labels){ #>
                <label for="new-pwd-confirm"><?php echo __('Confirm New Password', 'elemental-membership'); ?></label>
                <# } #>
                <input type="password" class="elementor-field" id="new-pwd-confirm"/>
            </div>

            <div class="elementor-field-group elementor-field-type-submit elementor-column">
                <button type="submit" class="em-button elementor-button elementor-size-{{ settings.button_size }}">{{ settings.button_text }}</button>
            </div>

        </div>

		<# } #>

    <?php
    }

	/**
     *
     * Renders change password form on the front-end
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render_form() {
        $settings = $this->get_settings_for_display(); 

        if (Plugin::$instance->documents->get_current()){
            $this->page_id = Plugin::$instance->documents->get_current()->get_main_id();
        } ?>
        
		<form class="em-form em-change-password-form elementor-form" method="post">
				<div class="elementor-field-group elementor-column elementor-col-100">
					<?php if ('yes' === $settings['show_labels']){ ?>
					<label for="old-pwd"><?php echo __('Current Passsword', 'elemental-membership'); ?></label>
					<?php } ?>
					<input type="password" name="pwd_change_form_fields[current_password]" class="elementor-field" id="old-pwd" required/>
				</div>

				<div class="elementor-field-group elementor-column elementor-col-100">
					<?php if ('yes' === $settings['show_labels']){ ?>
					<label for="new-pwd"><?php echo __('New Password', 'elemental-membership'); ?></label>
					<?php } ?>
					<input type="password" name="pwd_change_form_fields[new_password]" class="elementor-field" id="new-pwd" required/>
				</div>

				<div class="elementor-field-group elementor-column elementor-col-100">
					<?php if ('yes' === $settings['show_labels']){ ?>
					<label for="new-pwd-confirm"><?php echo __('Confirm New Password', 'elemental-membership'); ?></label>
					<?php } ?>
					<input type="password" name="pwd_change_form_fields[new_password_confirm]" class="elementor-field" id="new-pwd-confirm"/>
				</div>

                <div class="em-form-error elementor-field-group"></div>
                <div class="em-form-success elementor-field-group"></div>

				<div class="elementor-field-group elementor-field-type-submit elementor-column elementor-col-100">
					<button type="submit" class="em-button elementor-button elementor-size-<?php echo $settings['button_size']; ?>"><?php echo $settings['button_text']; ?></button>
				</div>

                <input type="hidden" name="action" value="em_change_password" />
                <?php wp_nonce_field('em_change_password', 'em_change_password_nonce'); ?>
                <input type="hidden" name="page_id" value="<?php echo esc_attr($this->page_id); ?>">
                <input type="hidden" name="widget_id" value="<?php echo esc_attr($this->get_id()); ?>">

			</form>

	<?php
    }

	/**
     *
     * Renders message if the user accessing form is logged out 
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render_user_loggedout_message() {
		$settings = $this->get_settings_for_display();
	?>

		<div class="em-user-registered-msg">
			<?php echo $settings['logged_out_user_text']; ?>
		</div>

	<?php
	}
	
	/**
     *
     * Check if user is viewing the form in the Elementor editor
     *
     * @since 1.0.0
     * @access public
     */
	public function em_user_is_in_editor(){
		$settings = $this->get_settings_for_display();

		if((is_user_logged_in() && 
		!\Elementor\Plugin::$instance->editor->is_edit_mode()) ||
		(is_user_logged_in() &&
		$settings['change_password_form_view'] == 'logged_in_view')){
			return;
		} else{
			return true;
		}
	}
}