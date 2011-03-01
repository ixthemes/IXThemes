<?php
/**
 * IXTCake - MODULE FOR XOOPS CONTENT MANAGEMENT SYSTEM
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
 * @package         
 * @author          IXThemes Project (http://ixthemes.org)
 *
 * Version : 1.06:
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
include_once XOOPS_ROOT_PATH."/modules/ixtcake/class/apptestgroups.php";
include_once XOOPS_ROOT_PATH."/modules/ixtcake/class/coretestgroups.php";
include_once XOOPS_ROOT_PATH."/modules/ixtcake/class/apptestcases.php";
include_once XOOPS_ROOT_PATH."/modules/ixtcake/class/coretestcases.php";

if ( $xoopsUser ) {
	$xoopsModule = XoopsModule::getByDirname("ixtcake");
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

$apptestgroupsHandler =& xoops_getModuleHandler("ixtcake_apptestgroups", "ixtcake");
$coretestgroupsHandler =& xoops_getModuleHandler("ixtcake_coretestgroups", "ixtcake");
$apptestcasesHandler =& xoops_getModuleHandler("ixtcake_apptestcases", "ixtcake");
$coretestcasesHandler =& xoops_getModuleHandler("ixtcake_coretestcases", "ixtcake");

?>