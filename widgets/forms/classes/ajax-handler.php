<?php
namespace ElementalMembership\Widgets\Forms\Classes;

class Ajax_Handler {

    const ACTION = 'elemental_membership';
    const NONCE = 'elemental_membership_ajax';

    public static function register(){

        $handler = new self();

        add_action('wp_ajax_' . self::ACTION, array($handler, 'handle'));
        add_action('wp_ajax_nopriv_' . self::ACTION, array($handler, 'handle') );
        add_action('wp_loaded', array($handler, 'register_script'));

    }

    public function register_script(){

        wp_register_script('em_ajax', EM_ASSETS . 'js/em.js');
        wp_localize_script('em_ajax', 'em_ajax_data', $this->get_ajax_data());
        wp_enqueue_script('em_ajax');

    }

    public function handle(){
        check_ajax_referer(self::NONCE);
        die();
    }

    private function get_ajax_data(){
        return array(
            'action' => self::ACTION,
            'nonce' => wp_create_nonce(Ajax_Handler::NONCE)
        );
    }

}