<?php
/**
 * ixtframework - MODULE FOR XOOPS CONTENT MANAGEMENT SYSTEM
 * Copyright (c) IXThemes Project (http://ixthemes.org)
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       IXThemes Project (http://ixthemes.org)
 * @license         GPL 2.0
 * @package         ixtframework
 * @author          IXThemes Project (http://ixthemes.org)
 *
 * Version : 1.03:
 * ****************************************************************************
 */
 
include "../../../include/cp_header.php";

include_once(XOOPS_ROOT_PATH."/class/xoopsmodule.php");
include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";
include_once XOOPS_ROOT_PATH."/class/tree.php";
include_once XOOPS_ROOT_PATH."/class/xoopslists.php";
include_once XOOPS_ROOT_PATH."/class/pagenav.php";
include_once XOOPS_ROOT_PATH."/class/xoopstopic.php";
include_once XOOPS_ROOT_PATH."/class/xoopsform/grouppermform.php";

include_once("functions.php");
include_once("../include/functions.php");

$myts =& MyTextSanitizer::getInstance();
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/pagelayout.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/slides.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/topic.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/assigns.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/widgets.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/globalnav.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/preheader.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/uitheme.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/fixskin.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/toplayout.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/botlayout.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/themes.php";

if ( $xoopsUser ) {
	$xoopsModule = XoopsModule::getByDirname("ixtframework");
	if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) { 
		redirect_header(XOOPS_URL."/",3,_NOPERM);
		exit();
	}
} else {
	redirect_header(XOOPS_URL."/",3,_NOPERM);
	exit();
}

// Include language file
xoops_loadLanguage("admin", "system");
xoops_loadLanguage("admin", $xoopsModule->getVar("dirname", "e"));
xoops_loadLanguage("modinfo", $xoopsModule->getVar("dirname", "e"));

$pagelayoutHandler =& xoops_getModuleHandler("ixtframework_pagelayout", "ixtframework");
$slidesHandler =& xoops_getModuleHandler("ixtframework_slides", "ixtframework");
$topicHandler =& xoops_getModuleHandler("ixtframework_topic", "ixtframework");
$assignsHandler =& xoops_getModuleHandler("ixtframework_assigns", "ixtframework");
$widgetsHandler =& xoops_getModuleHandler("ixtframework_widgets", "ixtframework");
$globalnavHandler =& xoops_getModuleHandler("ixtframework_globalnav", "ixtframework");
$preheaderHandler =& xoops_getModuleHandler("ixtframework_preheader", "ixtframework");
$uithemeHandler =& xoops_getModuleHandler("ixtframework_uitheme", "ixtframework");
$fixskinHandler =& xoops_getModuleHandler("ixtframework_fixskin", "ixtframework");
$toplayoutHandler =& xoops_getModuleHandler("ixtframework_toplayout", "ixtframework");
$botlayoutHandler =& xoops_getModuleHandler("ixtframework_botlayout", "ixtframework");
$themesHandler =& xoops_getModuleHandler("ixtframework_themes", "ixtframework");

?>