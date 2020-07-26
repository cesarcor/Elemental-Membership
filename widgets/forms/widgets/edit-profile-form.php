<?php

namespace ElementalMembership\Widgets\Forms;

use Elementor\Widget_Base;

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

	protected function _register_controls() {}

	protected function render() {
		$settings = $this -> get_settings_for_display();
	?>

		<form class="em-form">

			<div class="elementor-field-group">
				<label><?php echo __('First Name', 'elemental-membership') ?></label>
				<input type="text"/>
			</div>

			<div class="elementor-field-group">
				<label><?php echo __('Last Name', 'elemental-membership') ?></label>
				<input type="text"/>
			</div>

			<div class="elementor-field-group">
				<label><?php echo __('Email', 'elemental-membership') ?></label>
				<input type="email"/>
			</div>

			<div class="elementor-field-group">
				<label><?php echo __('Bio', 'elemental-membership') ?></label>
				<textarea rows="3"></textarea>
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
					<label><?php echo __('First Name', 'elemental-membership') ?></label>
					<input type="text"/>
				</div>

				<div class="elementor-field-group">
					<label><?php echo __('Last Name', 'elemental-membership') ?></label>
					<input type="text"/>
				</div>

				<div class="elementor-field-group">
					<label><?php echo __('Email', 'elemental-membership') ?></label>
					<input type="email"/>
				</div>

				<div class="elementor-field-group">
					<label><?php echo __('Bio', 'elemental-membership') ?></label>
					<textarea rows="3"></textarea>
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