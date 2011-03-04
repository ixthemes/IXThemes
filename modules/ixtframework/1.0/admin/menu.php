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
 * Version : 1.05:
 * ****************************************************************************
 */
include_once(XOOPS_ROOT_PATH.'/modules/ixtframework/admin/functions.php');
//global $xoopsModule;

$adminmenu = array(); 

if (function_exists('ixtframework_isrmcommon') && ixtframework_isrmcommon()) {
	
$adminmenu[0]["title"] = _MI_IXTFRAMEWORK_MANAGER_DASHBOARD;
$adminmenu[0]["link"] = "admin/index.php";
$adminmenu[0]["icon"] = "../images/deco/icon_index_16.png";
$adminmenu[0]["location"] = "dashboard";

$adminmenu[1]["title"] = _MI_IXTFRAMEWORK_MANAGER_ASSIGNS;
$adminmenu[1]["link"] = "admin/assigns.php";
$adminmenu[1]["icon"] = "../images/deco/icon_assigns_16.png";
$adminmenu[1]["location"] = "assigns";

$adminmenu[2]["title"] = _MI_IXTFRAMEWORK_MANAGER_THEMES;
$adminmenu[2]["link"] = "admin/themes.php";
$adminmenu[2]["icon"] = "../images/deco/icon_themes_16.png";
$adminmenu[2]["location"] = "themes";

$adminmenu[3]["title"] = _MI_IXTFRAMEWORK_MANAGER_THEMESCAT;
$adminmenu[3]["link"] = "admin/thcat.php";
$adminmenu[3]["icon"] = "../images/deco/icon_themes_16.png";
$adminmenu[3]["location"] = "thcat";

$adminmenu[4]["title"] = _MI_IXTFRAMEWORK_MANAGER_PAGELAYOUT;
$adminmenu[4]["link"] = "admin/pagelayout.php";
$adminmenu[4]["icon"] = "../images/deco/icon_pagelayout_16.png";
$adminmenu[4]["location"] = "pagelayout";

$adminmenu[5]["title"] = _MI_IXTFRAMEWORK_MANAGER_SLIDES;
$adminmenu[5]["link"] = "admin/slides.php";
$adminmenu[5]["icon"] = "../images/deco/icon_slides_16.png";
$adminmenu[5]["location"] = "slides";

//$adminmenu[6]["title"] = _MI_IXTFRAMEWORK_MANAGER_WIDGETS;
//$adminmenu[6]["link"] = "admin/widgets.php";
//$adminmenu[6]["icon"] = "../images/deco/icon_widgets_16.png";
//$adminmenu[6]["location"] = "widgets";

$adminmenu[7]["title"] = _MI_IXTFRAMEWORK_MANAGER_GLOBALNAV;
$adminmenu[7]["link"] = "admin/globalnav.php";
$adminmenu[7]["icon"] = "../images/deco/icon_globalnav_16.png";
$adminmenu[7]["location"] = "globalnav";

$adminmenu[8]["title"] = _MI_IXTFRAMEWORK_MANAGER_PREHEADER;
$adminmenu[8]["link"] = "admin/preheader.php";
$adminmenu[8]["icon"] = "../images/deco/icon_preheader_16.png";
$adminmenu[8]["location"] = "preheader";

$adminmenu[9]["title"] = _MI_IXTFRAMEWORK_MANAGER_TOPLAYOUT;
$adminmenu[9]["link"] = "admin/toplayout.php";
$adminmenu[9]["icon"] = "../images/deco/icon_toplayout_16.png";
$adminmenu[9]["location"] = "toplayout";

$adminmenu[10]["title"] = _MI_IXTFRAMEWORK_MANAGER_BOTLAYOUT;
$adminmenu[10]["link"] = "admin/botlayout.php";
$adminmenu[10]["icon"] = "../images/deco/icon_botlayout_16.png";
$adminmenu[10]["location"] = "botlayout";

$adminmenu[11]["title"] = _MI_IXTFRAMEWORK_MANAGER_ABOUT;
$adminmenu[11]["link"] = "admin/about.php";
$adminmenu[11]["icon"] = "../images/deco/icon_about_16.png";
$adminmenu[11]["location"] = "about";

} else {
	
$adminmenu[0]["title"] = _MI_IXTFRAMEWORK_MANAGER_INDEX;
$adminmenu[0]["link"] = "admin/index.php";
$adminmenu[0]["icon"] = "images/deco/icon_index.png";

$adminmenu[1]["title"] = _MI_IXTFRAMEWORK_MANAGER_ASSIGNS;
$adminmenu[1]["link"] = "admin/assigns.php";
$adminmenu[1]["icon"] = "images/deco/icon_assigns.png";

$adminmenu[2]["title"] = _MI_IXTFRAMEWORK_MANAGER_THEMES;
$adminmenu[2]["link"] = "admin/themes.php";
$adminmenu[2]["icon"] = "images/deco/icon_themes.png";

$adminmenu[3]["title"] = _MI_IXTFRAMEWORK_MANAGER_THEMESCAT;
$adminmenu[3]["link"] = "admin/thcat.php";
$adminmenu[3]["icon"] = "images/deco/icon_themes.png";

$adminmenu[4]["title"] = _MI_IXTFRAMEWORK_MANAGER_PAGELAYOUT;
$adminmenu[4]["link"] = "admin/pagelayout.php";
$adminmenu[4]["icon"] = "images/deco/icon_pagelayout.png";

$adminmenu[5]["title"] = _MI_IXTFRAMEWORK_MANAGER_SLIDES;
$adminmenu[5]["link"] = "admin/slides.php";
$adminmenu[5]["icon"] = "images/deco/icon_slides.png";

//$adminmenu[6]["title"] = _MI_IXTFRAMEWORK_MANAGER_WIDGETS;
//$adminmenu[6]["link"] = "admin/widgets.php";
//$adminmenu[6]["icon"] = "images/deco/icon_widgets.png";

$adminmenu[7]["title"] = _MI_IXTFRAMEWORK_MANAGER_GLOBALNAV;
$adminmenu[7]["link"] = "admin/globalnav.php";
$adminmenu[7]["icon"] = "images/deco/icon_globalnav.png";

$adminmenu[8]["title"] = _MI_IXTFRAMEWORK_MANAGER_PREHEADER;
$adminmenu[8]["link"] = "admin/preheader.php";
$adminmenu[8]["icon"] = "images/deco/icon_preheader.png";

$adminmenu[9]["title"] = _MI_IXTFRAMEWORK_MANAGER_TOPLAYOUT;
$adminmenu[9]["link"] = "admin/toplayout.php";
$adminmenu[9]["icon"] = "images/deco/icon_toplayout.png";

$adminmenu[10]["title"] = _MI_IXTFRAMEWORK_MANAGER_BOTLAYOUT;
$adminmenu[10]["link"] = "admin/botlayout.php";
$adminmenu[10]["icon"] = "images/deco/icon_botlayout.png";

$adminmenu[11]["title"] = _MI_IXTFRAMEWORK_MANAGER_ABOUT;
$adminmenu[11]["link"] = "admin/about.php";
$adminmenu[11]["icon"] = "images/deco/icon_about.png";

}
?>