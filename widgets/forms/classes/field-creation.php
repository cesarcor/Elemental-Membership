<?php
namespace ElementalMembership\Widgets\Forms\Classes;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Field_Creation{

    function create_input_field($field_name, $field_type){
        echo '<input type='. $field_type .' />';
    }

    function create_textarea_field(){
        echo '<textarea></textarea>';
    }

    function create_checkbox_field(){
        echo '<input type="checkbox" value="Checkbox!"/>';
    }


}