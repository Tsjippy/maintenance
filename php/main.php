<?php
namespace TSJIPPY\MAINTENANCE;
use TSJIPPY;

add_action('wp_body_open', __NAMESPACE__.'\header');
function header(){
    if(!is_user_logged_in() || !current_user_can('administrator')){
        $title      = SETTINGS['title'] ?? false;
        $message    = SETTINGS['message'] ?? false;
        if(!$message){
            $message	= 'This website is currently unavailable, but will be available again soon';
        }
        $url        = wp_get_attachment_url(SETTINGS['picture-ids'] ?? [] ['image']);
        wp_die("<h1>$title</h1><br><img src='$url' alt='' width='400' height='150' style='margin-left:auto;margin-right:auto;display:block;'><br>$message");
    }
}