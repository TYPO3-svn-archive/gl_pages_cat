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
			'userFunc' => 'tx_ttnews_treeview->displayCategoryTree',
			'treeView' => 1,
			'foreign_table' => 'tt_news_cat',
			'size' => 3,
			'autoSizeMax' => $confArr['categoryTreeHeigth'],
			'minitems' => $confArr['requireCategories'] ? 1 : 0,
			'maxitems' => 500,
			'MM' => 'pages_cat_mm',
			'wizards' => Array(
				'_PADDING' => 2,
				'_VERTICAL' => 1,
				'add' => Array(
					'type' => 'script',
					'title' => 'LLL:EXT:tt_news/locallang_tca.php:tt_news.createNewCategory',
					'icon' => 'EXT:tt_news/res/add_cat.gif',
					'params' => Array(
						'table'=>'tt_news_cat',
						'pid' => $sPid,
						'setValue' => 'set'
					),
					'script' => 'wizard_add.php',
				),
				'edit' => Array(
					'type' => 'popup',
					'title' => 'LLL:EXT:tt_news/locallang_tca.php:tt_news.editCategory',
					'script' => 'wizard_edit.php',
					'popup_onlyOpenIfSelected' => 1,
					'icon' => 'edit2.gif',
					'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
				),
			),
		),
	),
);


t3lib_div::loadTCA('pages');
t3lib_extMgm::addTCAcolumns('pages',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('pages','tx_glpagescat_category;;;;1-1-1');
?>
