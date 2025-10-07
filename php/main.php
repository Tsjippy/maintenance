<?php
namespace SIM\MAINTENANCE;
use SIM;

add_action('get_header', __NAMESPACE__.'\header');
function header(){
    if(!is_user_logged_in() || !current_user_can('administrator')){
        $title      = SIM\getModuleOption('maintenance', 'title');
        $message    = SIM\getModuleOption('maintenance', 'message');
        if(!$message){
            $message	= 'This website is currently unavailable, but will be available again soon';
        }
        $url        = wp_get_attachment_url(SIM\getModuleOption('maintenance', 'picture-ids')['image']);
        wp_die("<h1>$title</h1><br><img src='$url' alt='' width='400' height='150' style='margin-left:auto;margin-right:auto;display:block;'><br>$message");
    }
}