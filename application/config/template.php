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

// section question
$template['question']['template'] = 'question_template';
$template['question']['regions'] = array(
    'navbar',
	'sidebar',
	'tab_question_type',
	'tab_multichoice_question_type',
	'multichoice_trad',
	'multichoice_fullpoint',
	'multichoice_partpoint',
	'short_answer',
	'cloze',
	'content'
);
$template['default']['parser'] = 'parser';
$template['default']['parser_method'] = 'parse';
$template['default']['parse_template'] = FALSE;
$template['question']['parser'] = 'parser';
$template['question']['parser_method'] = 'parse';
$template['question']['parse_template'] = FALSE;
?>