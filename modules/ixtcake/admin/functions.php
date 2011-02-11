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
 * Version : 1.03:
 * ****************************************************************************
 */
 
function ixtcake_adminmenu ($currentoption = 0, $breadcrumb = "") 
{   
	global $xoopsModule, $xoopsConfig; 

	echo "
    	<style type=\"text/css\">
    	#buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }
    	#buttonbar { float:left; width:100%; background: #e7e7e7 url(".XOOPS_URL."/modules/ixtcake/images/menu/bg.png) repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px; }
    	#buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
		#buttonbar li { display:inline; margin:0; padding:0; }
		#buttonbar a { float:left; background:url(".XOOPS_URL."/modules/ixtcake/images/deco/left_both.png) no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; }
		#buttonbar a span { float:left; display:block; background:url(".XOOPS_URL."/modules/ixtcake/images/deco/right_both.png) no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
		#buttonbar a span {float:none;}
		#buttonbar a:hover span { color:#333; }
		#buttonbar #current a { background-position:0 -150px; border-width:0; }
		#buttonbar #current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
		#buttonbar a:hover { background-position:0% -150px; }
		#buttonbar a:hover span { background-position:100% -150px; }
		</style>
    ";
		
	$tblColors = Array();
	$tblColors[0] = $tblColors[1] = $tblColors[2] = $tblColors[3] = $tblColors[4] = $tblColors[5] = $tblColors[6] = $tblColors[7] = $tblColors[8] = "";
	$tblColors[$currentoption] = "current";
	if (file_exists("".XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar("dirname")."/language/".$xoopsConfig["language"]."/modinfo.php")) {
		include_once("".XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar("dirname")."/language/".$xoopsConfig["language"]."/modinfo.php");
	} else {
		include_once("".XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar("dirname")."/english/modinfo.php");
	}
	
	echo "<div id=\"buttontop\">
			<table style=\"width: 100%; padding: 0;\" cellspacing=\"0\">
				<tr>
					<td style=\"font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;\">
					  <a class=\"nobutton\" href=\"".XOOPS_URL."/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$myts->displayTarea($xoopsModule->getVar("mid"))."\">_AM_IXTCAKE_GENERALSET</a> 
					| <a href=\"".XOOPS_URL."/modules/ixtcake/index.php\">_AM_IXTCAKE_GOINDEX</a> 
					| <a href=\"".XOOPS_URL."/modules/ixtcake/admin/upgrade.php\">_AM_IXTCAKE_UPGRADE</a> 
					</td>
					<td style=\"font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;\"><b>".$myts->displayTarea($xoopsModule->name())."</b></td>
				</tr>
			</table>
		  </div>
	
		  <div id=\"buttonbar\">
			<ul><li id=\"$tblColors[0]\"><a href=\"".XOOPS_URL."/modules/ixtcake/admin/index.php\"><span>_MI_IXTCAKE_MANAGER_INDEX</span></a></li>
				<li id=\"$tblColors[1]\"><a href=\"".XOOPS_URL."/modules/ixtcake/admin/apptestgroups.php\"><span>_MI_IXTCAKE_MANAGER_APPTESTGROUPS</span></a></li>
				<li id=\"$tblColors[2]\"><a href=\"".XOOPS_URL."/modules/ixtcake/admin/coretestgroups.php\"><span>_MI_IXTCAKE_MANAGER_CORETESTGROUPS</span></a></li>
				
				<li id=\"$tblColors[3]\"><a href=\"".XOOPS_URL."/modules/ixtcake/admin/permissions.php\"><span>_MI_IXTCAKE_MANAGER_PERMISSIONS</span></a></li>
				<li id=\"$tblColors[4]\"><a href=\"".XOOPS_URL."/modules/ixtcake/admin/about.php\"><span>_MI_IXTCAKE_MANAGER_ABOUT</span></a></li>
			</ul></div>";
}


?>