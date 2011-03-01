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
include_once(XOOPS_ROOT_PATH.'/modules/ixtcake/admin/functions.php');
//global $xoopsModule;

$adminmenu = array(); 

if (ixtcake_isrmcommon()) {
	
$adminmenu[0]["title"] = _MI_IXTCAKE_MANAGER_DASHBOARD;
$adminmenu[0]["link"] = "admin/index.php";
$adminmenu[0]["icon"] = "../images/deco/icon_index_16.png";
$adminmenu[0]["location"] = "dashboard";

$adminmenu[1]["title"] = _MI_IXTCAKE_MANAGER_APPTESTGROUPS;
$adminmenu[1]["link"] = "admin/apptestgroups.php";
$adminmenu[1]["icon"] = "../images/deco/icon_apptestgroups_16.png";
$adminmenu[1]["location"] = "apptestgroups";

$adminmenu[2]["title"] = _MI_IXTCAKE_MANAGER_CORETESTGROUPS;
$adminmenu[2]["link"] = "admin/coretestgroups.php";
$adminmenu[2]["icon"] = "../images/deco/icon_coretestgroups_16.png";
$adminmenu[2]["location"] = "coretestgroups";

$adminmenu[3]["title"] = _MI_IXTCAKE_MANAGER_APPTESTCASES;
$adminmenu[3]["link"] = "admin/apptestcases.php";
$adminmenu[3]["icon"] = "../images/deco/icon_apptestcases_16.png";
$adminmenu[3]["location"] = "apptestcases";

$adminmenu[4]["title"] = _MI_IXTCAKE_MANAGER_CORETESTCASES;
$adminmenu[4]["link"] = "admin/coretestcases.php";
$adminmenu[4]["icon"] = "../images/deco/icon_coretestcases_16.png";
$adminmenu[4]["location"] = "coretestcases";

$adminmenu[6]["title"] = _MI_IXTCAKE_MANAGER_ABOUT;
$adminmenu[6]["link"] = "admin/about.php";
$adminmenu[6]["icon"] = "../images/deco/icon_about_16.png";
$adminmenu[6]["location"] = "about";

} else {
	
$adminmenu[0]["title"] = _MI_IXTCAKE_MANAGER_INDEX;
$adminmenu[0]["link"] = "admin/index.php";
$adminmenu[0]["icon"] = "images/deco/icon_index.png";

$adminmenu[1]["title"] = _MI_IXTCAKE_MANAGER_APPTESTGROUPS;
$adminmenu[1]["link"] = "admin/apptestgroups.php";
$adminmenu[1]["icon"] = "images/deco/icon_apptestgroups.png";

$adminmenu[2]["title"] = _MI_IXTCAKE_MANAGER_CORETESTGROUPS;
$adminmenu[2]["link"] = "admin/coretestgroups.php";
$adminmenu[2]["icon"] = "images/deco/icon_coretestgroups.png";

$adminmenu[3]["title"] = _MI_IXTCAKE_MANAGER_APPTESTCASES;
$adminmenu[3]["link"] = "admin/apptestcases.php";
$adminmenu[3]["icon"] = "images/deco/icon_apptestcases.png";

$adminmenu[4]["title"] = _MI_IXTCAKE_MANAGER_CORETESTCASES;
$adminmenu[4]["link"] = "admin/coretestcases.php";
$adminmenu[4]["icon"] = "images/deco/icon_coretestcases.png";

$adminmenu[6]["title"] = _MI_IXTCAKE_MANAGER_ABOUT;
$adminmenu[6]["link"] = "admin/about.php";
$adminmenu[6]["icon"] = "images/deco/icon_about.png";

}

?>