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
 
include("./header.php");

if( !empty($_POST["submit"]) ) 
{
	redirect_header( XOOPS_URL."/modules/".$xoopsModule->dirname()."/admin/permissions.php" , 1 , _MP_GPERMUPDATED );
}

xoops_cp_header();

global $xoopsDB;

if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
IXTFrameWork_adminmenu(12,_AM_IXTFRAMEWORK_MANAGER_PERMISSIONS);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (12,_AM_IXTFRAMEWORK_MANAGER_PERMISSIONS);
}

//menu
echo "<div class=\"CPbigTitle\" style=\"background-image: url(../images/deco/permissions.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTFRAMEWORK_MANAGER_PERMISSIONS."</strong>
	</div><br />";

	$permtoset= isset($_POST["permtoset"]) ? intval($_POST["permtoset"]) : 1;
	$selected=array("","","");
	$selected[$permtoset-1]=" selected";
	
echo "
<form method=\"post\" name=\"fselperm\" action=\"permissions.php\">
	<table border=0>
		<tr>
			<td>
				<select name=\"permtoset\" onChange=\"javascript: document.fselperm.submit()\">
					<option value=\"1\"".$selected[0].">"._AM_IXTFRAMEWORK_PERMISSIONS_ACCESS."</option>
					<option value=\"2\"".$selected[1].">"._AM_IXTFRAMEWORK_PERMISSIONS_SUBMIT."</option>
				</select>
			</td>
		</tr>
	</table>
</form>";

$module_id = $xoopsModule->getVar("mid");

	switch($permtoset)
	{
		case 1:
			$title_of_form = _AM_IXTFRAMEWORK_PERMISSIONS_ACCESS;
			$perm_name = "IXTFrameWork_access";
			$perm_desc = "";
			break;
		case 2:
			$title_of_form = _AM_IXTFRAMEWORK_PERMISSIONS_SUBMIT;
			$perm_name = "IXTFrameWork_submit";
			$perm_desc = "";
			break;
	}
	
	$permform = new XoopsGroupPermForm($title_of_form, $module_id, $perm_name, $perm_desc, "admin/permissions.php");
	$xt = new XoopsTopic( $xoopsDB -> prefix("IXTFrameWork_topic") );
	$alltopics =& $xt->getTopicsList();
	
	foreach ($alltopics as $topic_id => $topic) 
	{
		$permform->addItem($topic_id, $topic["title"], $topic["pid"]);
	}
	echo $permform->render();
	echo "<br /><br /><br /><br />\n";
	unset ($permform);

echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
?>