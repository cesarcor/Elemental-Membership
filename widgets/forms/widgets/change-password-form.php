<?php

namespace ElementalMembership\Widgets\Forms;

use Elementor\Widget_Base;

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

	protected function _register_controls() {}

	protected function render() {

        $settings = $this->get_settings_for_display();

    ?>

        <form class="em-form">
            <div class="elementor-field-group">
                <label for="old-pwd"><?php echo __('Old Passsword', 'elemental-membership'); ?></label>
                <input type="password" id="old-pwd"/>
            </div>

            <div class="elementor-field-group">
                <label for="new-pwd"><?php echo __('New Password', 'elemental-membership'); ?></label>
                <input type="password" id="new-pwd"/>
            </div>

            <div class="elementor-field-group">
                <label for="new-pwd-confirm"><?php echo __('Confirm New Password', 'elemental-membership'); ?></label>
                <input type="password" id="new-pwd-confirm"/>
            </div>

            <div class="elementor-field-group">
                <button type="submit"><?php echo __('Update', 'elemental-membership'); ?></button>
            </div>

        </form>

    <?php
    }

    protected function _content_template() {
    ?>
        
        <div class="em-form">
            <div class="elementor-field-group">
                <label for="old-pwd"><?php echo __('Old Passsword', 'elemental-membership'); ?></label>
                <input type="password" id="old-pwd"/>
            </div>

            <div class="elementor-field-group">
                <label for="new-pwd"><?php echo __('New Password', 'elemental-membership'); ?></label>
                <input type="password" id="new-pwd"/>
            </div>

            <div class="elementor-field-group">
                <label for="new-pwd-confirm"><?php echo __('Confirm New Password', 'elemental-membership'); ?></label>
                <input type="password" id="new-pwd-confirm"/>
            </div>

            <div class="elementor-field-group">
                <button type="submit"><?php echo __('Update', 'elemental-membership'); ?></button>
            </div>

        </div>

    <?php
    }
    
}