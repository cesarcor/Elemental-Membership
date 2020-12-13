<?php

namespace ElementalMembership\Widgets\Forms;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;

class Change_Password_Form extends Widget_Base {

    public function get_name() {
        return 'change-password-form';
    }

	public function get_title() {
        return __('Change Password Form', 'elemental-membership');
    }

	public function get_icon() {
        return '';
    }

	public function get_categories() {
        return ['elemental-membership-category'];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'fields',
            [
                'label' => __( 'Fields', 'elemental-membership' ),
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
            'em_form_style',
            [
                'label' => __( 'Form', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings_for_display();

    ?>

        <form class="em-form elementor-form">
            <div class="elementor-field-group elementor-column elementor-col-100">
                <?php if('yes' === $settings['show_labels']): ?>
                <label for="old-pwd"><?php echo __('Old Passsword', 'elemental-membership'); ?></label>
                <?php endif; ?>
                <input type="password" id="old-pwd"/>
            </div>

            <div class="elementor-field-group elementor-column elementor-col-100">
                <?php if('yes' === $settings['show_labels']): ?>
                <label for="new-pwd"><?php echo __('New Password', 'elemental-membership'); ?></label>
                <?php endif; ?>
                <input type="password" id="new-pwd"/>
            </div>

            <div class="elementor-field-group elementor-column elementor-col-100">
                <?php if('yes' === $settings['show_labels']): ?>
                <label for="new-pwd-confirm"><?php echo __('Confirm New Password', 'elemental-membership'); ?></label>
                <?php endif; ?>
                <input type="password" id="new-pwd-confirm"/>
            </div>

            <div class="elementor-field-group elementor-field-type-submit elementor-column elementor-col-100">
                <button type="submit" class="em-button elementor-button elementor-size-<?php echo $settings['button_size']; ?>"><?php echo $settings['button_text']; ?></button>
            </div>

        </form>

    <?php
    }

    protected function _content_template() {
    ?>
        
        <div class="em-form elementor-form">
            <div class="elementor-field-group elementor-column elementor-col-100">
                <# if('yes' === settings.show_labels){ #>
                <label for="old-pwd"><?php echo __('Old Passsword', 'elemental-membership'); ?></label>
                <# } #>
                <input type="password" id="old-pwd"/>
            </div>

            <div class="elementor-field-group elementor-column elementor-col-100">
                <# if('yes' === settings.show_labels){ #>
                <label for="new-pwd"><?php echo __('New Password', 'elemental-membership'); ?></label>
                <# } #>
                <input type="password" id="new-pwd"/>
            </div>

            <div class="elementor-field-group elementor-column elementor-col-100">
                <# if('yes' === settings.show_labels){ #>
                <label for="new-pwd-confirm"><?php echo __('Confirm New Password', 'elemental-membership'); ?></label>
                <# } #>
                <input type="password" id="new-pwd-confirm"/>
            </div>

            <div class="elementor-field-group elementor-field-type-submit elementor-column">
                <button type="submit" class="em-button elementor-button elementor-size-{{ settings.button_size }}">{{ settings.button_text }}</button>
            </div>

        </div>

    <?php
    }
    
}