<?php

namespace CMD\CmdSysfolder\CacheCtrl;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2007-2010 Christophe Monard <contact@cmonard.fr>
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
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */
/**
 * Extending class to render the menu for the cache clearing actions, and adding Clear Icon set cache option
 *
 * @author	Christophe Monard <contact@cmonard.fr>
 * @package	TYPO3
 */

class ClearCacheMenu implements \TYPO3\CMS\Backend\Toolbar\ClearCacheActionsHookInterface {

        /**
         * modifies CacheMenuItems array
         *
         * @param	array	array of CacheMenuItems
         * @param	array	array of AccessConfigurations-identifiers (typically  used by userTS with options.clearCache.identifier)
         * @return	void
         */
        public function manipulateCacheActions(&$cacheActions, &$optionValues) {
                if ($GLOBALS['BE_USER']->isAdmin() || $GLOBALS['BE_USER']->getTSConfigVal('options.clearCache.clearIconSetCache')) {
                        $iconPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('cmd_sysfolder') . 'Resources/Public/Icons/cleariconsetcache.png';
                        $icon = \TYPO3\CMS\Backend\Utility\IconUtility::skinImg($GLOBALS['BACK_PATH'], $iconPath, 'width="16" height="16"');
                        // Add new cache menu item
                        $title = $GLOBALS['LANG']->sL('LLL:EXT:cmd_sysfolder/Resources/Private/Language/locallang.xlf:title');
                        $cacheActions[] = array(
                            'id' => 'clearIconSetCache',
                            'title' => $title,
                            'href' => $GLOBALS['BACK_PATH'] . 'ajax.php?ajaxID=cmdsysfolder::clearIconSetCache',
                            'icon' => '<img' . $icon . ' title="' . $title . '" alt="' . $title . '" />'
                        );
                        $optionValues[] = 'clearIconSetCache';
                }
        }

}

?>