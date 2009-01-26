<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2008 Manuel Rego Casasnovas <mrego@igalia.com>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Class with useful function to get news depending on page category.
 *
 * @author	Manuel Rego Casasnovas <mrego@igalia.com>
 * @package	TYPO3
 * @subpackage	tx_glpagescat
 */
class tx_glpagescat_div {

	/**
	 * Returns news with the some category that match with the categories of
	 * the current page.
	 *
	 * @param	boolean		$recursive	[false] If it's true it
	 * could match with any page category or subcaterories of these
	 * categories.
	 * @return	array		Array with news uid
	 */
	function getNewsCategorized($recursive = false) {
		$categories = tx_glpagescat_div::getPageCategories($recursive);

		if (!$categories) {
			return;
		}

		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid_local',
			'tt_news_cat_mm',
			'uid_foreign IN (' . implode(',', $categories) . ')'
		);

		foreach ($rows as $row) {
			$news[] = $row['uid_local'];
		}

		return $news;
	}

	/**
	 * Returns the categories of the current page.
	 *
	 * @param	boolean		$recursive	[false] If it's true it
	 * returns the page categories and subcaterories of these categories.
	 * @return	array		Array with categories uid
	 */
	function getPageCategories($recursive = false) {
		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'DISTINCT uid_foreign',
			'pages_cat_mm',
			'uid_local="' . $GLOBALS['TSFE']->id . '"'
		);

		$categories = array();

		foreach ($rows as $row) {
			$categories[] = $row['uid_foreign'];
			if ($recursive) {
				$categories = array_merge($categories,
						tx_glpagescat_div::getSubCategories($row['uid_foreign']));
			}
		}

		return $categories;
	}

	/**
	 * Returns subcateroires of a category given.
	 *
	 * @param	integer		$categoryUid	Category identifier
	 * @return	array		Array with categories uid
	 */
	function getSubCategories($categoryUid) {
		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid',
			'tt_news_cat',
			'parent_category="' . $categoryUid . '"' .
			$GLOBALS['TSFE']->sys_page->enableFields('tt_news_cat')
		);

		$categories = array();

		foreach ($rows as $row) {
			$categories[] = $row['uid'];
			$categories = array_merge($categories,
					tx_glpagescat_div::getSubCategories($row['uid']));
		}

		return $categories;
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/gl_pages_cat/class.tx_glpagescat_div.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/gl_pages_cat/class.tx_glpagescat_div.php']);
}

?>
