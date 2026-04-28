<?php
namespace TSJIPPY\MAINTENANCE;
use TSJIPPY;

use function TSJIPPY\addElement;
use function TSJIPPY\addRawHtml;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class AdminMenu extends \TSJIPPY\ADMIN\SubAdminMenu{

    public function __construct($settings, $name){
        parent::__construct($settings, $name);
    }

    public function settings($parent){
        $label  = addElement('label', $parent);
        addElement('h4', $label, [], 'Message title');
        addElement('input', $label, ['type' => 'text', 'name' => 'title', 'value' => $this->settings['title'] ?? '', 'style' => 'width:100%;']);

        addElement('h4', $parent, [], 'Picture for maintenance mode message<');

        $this->pictureSelector('image', 'Image', $parent);

        $label  = addElement('label', $parent);
        addElement('h4', $label, [], 'Maintenance mode message');

        ob_start();

        $tinyMceSettings = array(
            'wpautop' 					=> false,
            'media_buttons' 			=> false,
            'forced_root_block' 		=> true,
            'convert_newlines_to_brs'	=> true,
            'textarea_name' 			=> "message",
            'textarea_rows' 			=> 10
        );

        echo wp_editor(
            $this->settings["message"] ?? 'This website is currently unavailable, but will be available again soon',
            "message",
            $tinyMceSettings
        );

        addRawHtml(ob_get_clean(), $parent);

        return true;
    }

    public function emails($parent){
        return false;
    }

    public function data($parent=''){

        return false;
    }

    public function functions($parent){

        return false;
    }
}