<?php
if (!defined('TYPO3_MODE')) die('Access denied.');

// Sys folder icon
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('options.saveDocNew.tx_cmdsysfolder_sysfoldericon=1');
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['additionalBackendItems']['cacheActions']['clearIconSetCache'] = 'CMD\\CmdSysfolder\\CacheCtrl\\ClearCacheMenu';
$GLOBALS['TYPO3_CONF_VARS']['BE']['AJAX']['cmdsysfolder::clearIconSetCache'] = 'CMD\\CmdSysfolder\\CacheCtrl\\ClearIconsetCache->clearIconSetCache';

?>