<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

// get extension confArr
$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['gl_pages_cat']);
// switch the use of the "StoragePid"(general record Storage Page) for tt_news categories
$fTableWhere = ($confArr['useStoragePid']?'AND tt_news_cat.pid=###STORAGE_PID### ':'');
// page where records will be stored in that have been created with a wizard
$sPid = ($fTableWhere?'###STORAGE_PID###':'###CURRENT_PID###');

$tempColumns = Array (
	'tx_glpagescat_category' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:gl_pages_cat/locallang_db.xml:pages.tx_glpagescat_category',
		'config' => Array (
			'type' => 'select',
			'form_type' => 'user',
			'userFunc' => 'tx_ttnews_TCAform_selectTree->renderCategoryFields',
			'treeView' => 1,
			'foreign_table' => 'tt_news_cat',
			'autoSizeMax' => $confArr['categoryTreeHeigth'],
			'minitems' => $confArr['requireCategories'] ? 1 : 0,
			'maxitems' => 500,
			'MM' => 'pages_cat_mm',
		),
	),
);


t3lib_div::loadTCA('pages');
t3lib_extMgm::addTCAcolumns('pages',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('pages','tx_glpagescat_category;;;;1-1-1');
?>
