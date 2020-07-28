<?php

namespace ElementalMembership\Widgets\Forms;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Edit_Profile_Form extends Widget_Base{

    public function get_name() {
		return 'profile-edit-form';
	}

	public function get_title() {
		return __('Edit Profile Form');
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
			'first_name_label',
			[
				'label' => __( 'First Name Label', 'elemental-membership' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'First Name', 'elemental-membership' ),
				'condition' => [
					'show_labels' => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'first_name_placeholder',
			[
				'label' => __( 'First Name Placeholder', 'elemental-membership' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'First Name', 'elemental-membership' ),
				'condition' => [
					'show_labels' => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'last_name_label',
			[
				'label' => __( 'Last Name Label', 'elemental-membership' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Last Name', 'elemental-membership' ),
				'condition' => [
					'show_labels' => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'last_name_placeholder',
			[
				'label' => __( 'Last Name Placeholder', 'elemental-membership' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Last Name', 'elemental-membership' ),
				'condition' => [
					'show_labels' => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'email_label',
			[
				'label' => __( 'Email Label', 'elemental-membership' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Email', 'elemental-membership' ),
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
					'show_labels' => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'bio_label',
			[
				'label' => __( 'Bio Label', 'elemental-membership' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Bio', 'elemental-membership' ),
				'condition' => [
					'custom_labels' => 'yes',
				],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
	?>

		<form class="em-form">

			<div class="elementor-field-group">
				<label><?php echo $settings['first_name_label']; ?></label>
				<input type="text" placeholder="<?php echo $settings['first_name_placeholder']; ?>"/>
			</div>

			<div class="elementor-field-group">
				<label><?php echo $settings['last_name_label']; ?></label>
				<input type="text" placeholder="<?php echo $settings['last_name_placeholder']; ?>"/>
			</div>

			<div class="elementor-field-group">
				<label><?php echo $settings['email_label']; ?></label>
				<input type="email" placeholder="<?php echo $settings['email_placeholder']; ?>"/>
			</div>

			<div class="elementor-field-group">
				<label><?php echo $settings['bio_label']; ?></label>
				<textarea rows="3" placeholder="<?php echo $settings['bio_placeholder']; ?>"></textarea>
			</div>

			<div class="elementor-field-group">
				<button type="submit">
					<?php echo __('Update Account', 'elemental-membership'); ?>
				</button>
			</div>
			
		</form>

	<?php
	}

	protected function _content_template() {
	?>

		<div class="em-form">

			<div class="elementor-field-group">
				<label>{{{ settings.first_name_label }}}</label>
				<input type="text" placeholder="{{{ settings.first_name_placeholder }}}"/>
			</div>

			<div class="elementor-field-group">
				<label>{{{ settings.last_name_label }}}</label>
				<input type="text" placeholder="{{{ settings.last_name_placeholder }}}"/>
			</div>

			<div class="elementor-field-group">
				<label>{{{ settings.email_label }}}</label>
				<input type="email" placeholder="{{{ settings.email_placeholder }}}"/>
			</div>

			<div class="elementor-field-group">
				<label>{{{ settings.bio_label }}}</label>
				<textarea rows="3" placeholder="{{{ settings.bio_placeholder }}}"></textarea>
			</div>

			<div class="elementor-field-group">
				<button type="submit">
					<?php echo __('Update Account', 'elemental-membership'); ?>
				</button>
			</div>

		</div>

	<?php
	}

}