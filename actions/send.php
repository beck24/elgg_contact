<?php

elgg_make_sticky_form('contact');

$email = get_input('email');
$subject = get_input('subject');
$message = get_input('message');

if (empty($message) || empty($subject) || empty($email)) {
    register_error(elgg_echo('contact:error:fields'));
    forward(REFERER);
}

if (!is_email_address($email)) {
    register_error(elgg_echo('contact:error:email'));
    forward(REFERER);
}

// we're clear
elgg_clear_sticky_form('contact');

$message = elgg_echo('contact:from', array($email)) . $message;

// get our admin-defined recipients
$recipient_list = elgg_get_plugin_setting('recipients', 'contact');

$recipient_array = explode("\n", $recipient_list);

foreach ($recipient_array as $recipient) {
    $to = trim($recipient);
    
    if (is_email_address($to)) {
        elgg_send_email(elgg_get_site_entity()->email, $to, $subject, $message);
    }
}

forward('contact/received');
