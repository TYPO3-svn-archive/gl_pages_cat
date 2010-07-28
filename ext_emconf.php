<?php

########################################################################
# Extension Manager/Repository config file for ext "gl_pages_cat".
#
# Auto generated 28-07-2010 10:45
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Pages categorization',
	'description' => 'Relate pages with tt_news categories.',
	'category' => 'be',
	'shy' => 0,
	'version' => '0.1.5',
	'dependencies' => 'tt_news',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => 'pages',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Manuel Rego Casasnovas [Igalia]',
	'author_email' => 'mrego@igalia.com',
	'author_company' => 'Igalia - http://www.igalia.com',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'tt_news' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:8:{s:9:"ChangeLog";s:4:"fe5e";s:27:"class.tx_glpagescat_div.php";s:4:"e6b3";s:21:"ext_conf_template.txt";s:4:"7f1e";s:12:"ext_icon.gif";s:4:"585d";s:14:"ext_tables.php";s:4:"a00e";s:14:"ext_tables.sql";s:4:"4eb9";s:16:"locallang_db.xml";s:4:"c33a";s:14:"doc/manual.sxw";s:4:"d687";}',
	'suggests' => array(
	),
);

?>