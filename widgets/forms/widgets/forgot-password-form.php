<?php

namespace ElementalMembership\Widgets\Forms;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

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

	protected function _register_controls() {
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

    }

	protected function render() {
        $settings = $this->get_settings();
    ?>

        <form class="em-forgot-password-form elementor-form">
            <div class="elementor-form-fields-wrapper">
                <div class="elementor-field-group elementor-column elementor-col-100">
                    <?php if('yes' === $settings['show_labels']): ?>
                      <label for="forgot-pw-email">
                        <?php echo 'yes' === $settings['custom_labels'] ? $settings['email_label'] : __('Your Email', 'elemental-membership'); ?>
                      </label>
                    <?php endif; ?>
                    <input type="email" id="forgot-pw-email" placeholder="<?php echo $settings['custom_labels'] == 'yes' ? $settings['email_placeholder'] : __('Email', 'elemental-membership'); ?>"/>
                </div>

                <div <?php echo $this->get_render_attribute_string( 'submit-group' ); ?>>
                    <button type="submit" class="em-button elementor-button elementor-size-<?php echo $settings['button_size']; ?>">
                        <?php echo $settings['button_text']; ?>
                    </button>
                </div>
            <div>
        </form>

    <?php

    }

	protected function _content_template() {
    ?>

        <div class="elementor-form">

            <div class="elementor-form-fields-wrapper">
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
                        <input type="email" id="forgot-pw-email" placeholder="{{{ settings.email_placeholder }}}"/>
                </div>
                
                <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100">
                    <button type="submit" class="em-button elementor-button elementor-size-{{ settings.button_size }}">
                        {{{ settings.button_text }}}
                    </button>
                </div>
            </div>
        
        </div>

        
    <?php
    }

}