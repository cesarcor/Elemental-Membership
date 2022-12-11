<?php
namespace ElementalMembership\Widgets\Forms\Classes;

if ( ! defined( 'ABSPATH' ) ) exit;

class Form_Message{

    private $error;

    public function store_message($error){
        $this->error = $error;
    }

    public function fetch_message(){
        return $this->error;
    }

    public function send(){
        return "This is where the error goes";
    }

}