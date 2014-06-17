<?php
if (!defined('TYPO3_MODE')) die('Access denied.');

$TCA['tx_cmdsysfolder_icon'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:cmd_sysfolder/Resources/Private/Language/locallang_db.xlf:tx_cmdsysfolder_icon',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY name',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY, 'Configuration/TCA/Icon.php'),
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_cmdsysfolder_icon.gif',
        'rootLevel' => 1,
    ),
);

// Add sysfolder icon
if (TYPO3_MODE == 'BE') {
        if (!is_file(PATH_typo3conf . 'temp_CACHED_icon_set.php'))
                \CMD\CmdSysfolder\IconSet::create_iconSetFile();
        if (@is_file(PATH_typo3conf . 'temp_CACHED_icon_set.php'))
                include_once(PATH_typo3conf . 'temp_CACHED_icon_set.php');
}
?>