<?php
if (!defined('TYPO3_MODE')) die('Access denied.');

$TCA['tx_cmdsysfolder_icon'] = array (
    'ctrl' => $TCA['tx_cmdsysfolder_icon']['ctrl'],
    'interface' => array (
        'showRecordFieldList' => 'name,icon,tables'
    ),
    'feInterface' => $TCA['tx_cmdsysfolder_icon']['feInterface'],
    'columns' => array (
        'name' => array (
            'exclude' => 0,
            'label' => 'LLL:EXT:cmd_sysfolder/Resources/Private/Language/locallang_db.xlf:tx_cmdsysfolder_icon.name',
            'config' => array (
                'type' => 'input',
                'size' => '30',
                'eval' => 'required,trim',
            )
        ),
        'icon' => array (
            'exclude' => 0,
            'label' => 'LLL:EXT:cmd_sysfolder/Resources/Private/Language/locallang_db.xlf:tx_cmdsysfolder_icon.icon',
            'config' => array (
                'type' => 'group',
                'internal_type' => 'file',
                'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
                'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
                'uploadfolder' => 'uploads/tx_cmdsysfolder',
                'show_thumbs' => 1,
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            )
        ),
       'tables' => array (        
            'exclude' => 0,        
            'label' => 'LLL:EXT:cmd_sysfolder/Resources/Private/Language/locallang_db.xlf:tx_cmdsysfolder_icon.tables',
            'config' => array (
                'type' => 'select',
                'items' => array (
                    array('LLL:EXT:cmd_sysfolder/Resources/Private/Language/locallang_db.xlf:tx_cmdsysfolder_icon.tables.I.0', 'pages'),
                ),
                'size' => 1,    
                'maxitems' => 1,
            )
        ),
    ),
    'types' => array (
        '0' => array('showitem' => 'name;;;;1-1-1, icon, tables')
    ),
    'palettes' => array (
        '1' => array('showitem' => '')
    )
);
?>