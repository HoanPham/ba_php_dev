<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// section default
$template['default']['template'] = 'default_template';
$template['default']['regions'] = array(
    'navbar',
	'sidebar',
	'content'
);
$template['default']['parser'] = 'parser';
$template['default']['parser_method'] = 'parse';
$template['default']['parse_template'] = FALSE;

?>