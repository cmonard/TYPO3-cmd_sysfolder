<?php

namespace CMD\CmdSysfolder;

if (!defined('TYPO3_MODE')) die('Access denied.');

class IconSet {

        function create_iconSetFile() {
                $accent = utf8_decode('ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ');
                $noaccent = 'AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn';
                $icon_set = array();
                $icons = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('tables, name, icon', 'tx_cmdsysfolder_icon', '1');
                foreach ($icons as $icon) {
                        $name = $icon['name'];
                        $name = addslashes($name);
                        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('cmd_api') && method_exists('CMD\CmdApi\Api', 'stripAccentsAndSpaces_doTransform'))
                                $lname = \CMD\CmdApi\Api::stripAccentsAndSpaces_doTransform($name, '_', 'lower');
                        else {
                                $lname = strtr(utf8_decode($name), $accent, $noaccent);
                                $lname = strtolower($lname);
                                $lname = str_replace(' ', '_', $lname);
                        }
                        $lname = str_replace(array('?', '!'), '', $lname); // ! & ? not support in TYPO3
                        if (strlen($lname) > 10)
                                $lname = \TYPO3\CMS\Core\Utility\GeneralUtility::shortMD5($lname, 10); // 10 char max (need uniq key)
                        $iconName = 'icon_' . $icon['icon'];
                        // icon resized
                        if (!file_exists('../uploads/tx_cmdsysfolder/' . $iconName)) {
                                $ori = PATH_site . 'uploads/tx_cmdsysfolder/' . $icon['icon'];
                                $ico = PATH_site . 'uploads/tx_cmdsysfolder/' . $iconName;
                                list($width, $height) = getimagesize($ori);
                                if ($width > 16 || $height > 16) { // if bigger than necessary, resize
                                        $newRes = imagecreatetruecolor(16, 16); // make a new image, smaller ico sized
                                        $oriRes = \TYPO3\CMS\Backend\Utility\IconUtility::imagecreatefrom($ori); // original file
                                        imagecopyresampled($newRes, $oriRes, 0, 0, 0, 0, 16, 16, $width, $height); // make smaller icon
                                        \TYPO3\CMS\Backend\Utility\IconUtility::imagemake($newRes, $ico);
                                        \TYPO3\CMS\Core\Utility\GeneralUtility::gif_compress($ico, 'IM');
                                        ImageDestroy($newRes);
                                        $iconURL = '../uploads/tx_cmdsysfolder/' . $iconName;
                                } else
                                        $iconURL = '../uploads/tx_cmdsysfolder/' . $icon['icon'];
                        } else
                                $iconURL = '../uploads/tx_cmdsysfolder/' . $iconName;
                        // pull new value
                        $icon_set[] = '$GLOBALS[\'TCA\'][\'pages\'][\'columns\'][\'module\'][\'config\'][\'items\'][] = Array(\'' . $name . '\', \'' . $lname . '\', \'' . $iconURL . '\');';
                        // Sprite manager exist
                        if (method_exists('TYPO3\CMS\Backend\Sprite\SpriteManager', 'addTcaTypeIcon'))
                                $icon_set[] = '\TYPO3\CMS\Backend\Sprite\SpriteManager::addTcaTypeIcon(\'' . $icon['tables'] . '\', \'contains-' . $lname . '\', \'' . $iconURL . '\');';
                        else
                                $icon_set[] = '$ICON_TYPES[\'' . $lname . '\'] = array(\'icon\' => \'' . $iconURL . '\');'; // Old method
                }
                if (count($icon_set) > 0) {
                        $content = chr(60) . '?php' . "\n" .
                                implode("\n", $icon_set) .
                                "\n" . '?' . chr(62);
                        file_put_contents(PATH_typo3conf . 'temp_CACHED_icon_set.php', $content);
                }
        }

}

?>