<?php

namespace Beck24\Contact;

echo elgg_view_input('text', [
	'label' => elgg_echo('contact:subject'),
	'name' => 'subject',
	'value' => elgg_get_sticky_value('contact', 'subject')
]);



$email = '';
if (elgg_is_logged_in()) {
    $email = elgg_get_logged_in_user_entity()->email;
}

if (elgg_is_sticky_form('contact')) {
    $email = elgg_get_sticky_value('contact', 'email');
}

echo elgg_view_input('email', [
	'label' => elgg_echo('contact:email'),
	'name' => 'email',
	'value' => $email
]);


$inputtype = elgg_get_plugin_setting('inputtype', PLUGIN_ID);
if (!$inputtype) {
    $inputtype = 'plaintext';
}

echo elgg_view_input($inputtype, [
	'label' => elgg_echo('contact:message'),
	'name' => 'message',
	'value' => elgg_get_sticky_value('contact', 'message')
]);


if (!elgg_is_logged_in()) {
    echo elgg_view('input/captcha');
}

echo elgg_view_input('submit', array(
    'value' => elgg_echo('submit')
));


elgg_clear_sticky_form('contact');
