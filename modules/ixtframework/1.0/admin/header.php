<?php
/**
 * IXTFrameWork - MODULE FOR XOOPS AND IMPRESS CMS
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
 * @license         GPL 3.0
 * @package         IXTFrameWork
 * @author          IXThemes Project (http://ixthemes.org)
 *
 * Version : 1.00:
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
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/pagelayout.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/slides.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/topic.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/assigns.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/wigets.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/globalnav.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/preheader.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/uitheme.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/fixskin.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/toplayout.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/botlayout.php";

if ( $xoopsUser ) {
	$xoopsModule = XoopsModule::getByDirname("IXTFrameWork");
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

$pagelayoutHandler =& xoops_getModuleHandler("ixtframework_pagelayout", "IXTFrameWork");
$slidesHandler =& xoops_getModuleHandler("ixtframework_slides", "IXTFrameWork");
$topicHandler =& xoops_getModuleHandler("ixtframework_topic", "IXTFrameWork");
$assignsHandler =& xoops_getModuleHandler("ixtframework_assigns", "IXTFrameWork");
$wigetsHandler =& xoops_getModuleHandler("ixtframework_wigets", "IXTFrameWork");
$globalnavHandler =& xoops_getModuleHandler("ixtframework_globalnav", "IXTFrameWork");
$preheaderHandler =& xoops_getModuleHandler("ixtframework_preheader", "IXTFrameWork");
$uithemeHandler =& xoops_getModuleHandler("ixtframework_uitheme", "IXTFrameWork");
$fixskinHandler =& xoops_getModuleHandler("ixtframework_fixskin", "IXTFrameWork");
$toplayoutHandler =& xoops_getModuleHandler("ixtframework_toplayout", "IXTFrameWork");
$botlayoutHandler =& xoops_getModuleHandler("ixtframework_botlayout", "IXTFrameWork");

?>