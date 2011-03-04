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
 
include("./header.php");

xoops_cp_header();

if( !empty($_POST["submit"]) ) 
{
	ixt_redirect( XOOPS_URL."/modules/".$xoopsModule->dirname()."/admin/permissions.php" , 1 , _MP_GPERMUPDATED );
}

global $xoopsDB;

// algalochkin: Admin menu with support old CMS version or icms
if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
ixtframework_adminmenu(13,_AM_IXTFRAMEWORK_MANAGER_PERMISSIONS);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (13,_AM_IXTFRAMEWORK_MANAGER_PERMISSIONS);
}

echo "<style>
.cpbigtitle{ float:left; width:95%; font-size: 20px; color: #1E90FF; background: no-repeat left top; font-weight: bold; height: 50px; vertical-align: middle; padding: 10px 0 0 50px; border-bottom: 3px solid #1E90FF; }
.cleared { float: none; clear: both; margin: 0; padding: 0; border: none; font-size: 1px; }
fieldset {margin: .5em;padding: 1em;border: 1px solid #333;color: #000;background-color: #f0f0f0;-moz-border-radius: 6px;-webkit-border-radius: 6px;-khtml-border-radius: 6px;border-radius: 6px;}
legend {padding: .5em;font-size: 1.1em;font-weight: bolder;}
label, .caption-text {margin-bottom: .5em;padding-right: .5em;font-weight: bold;}
</style>";
echo "<div class=\"cpbigtitle\" style=\"background-image: url(../images/deco/permissions.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTFRAMEWORK_MANAGER_PERMISSIONS."</strong>
	</div><div class=\"cleared\"></div><br /><br />";

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
			$perm_name = "ixtframework_access";
			$perm_desc = "";
			break;
		case 2:
			$title_of_form = _AM_IXTFRAMEWORK_PERMISSIONS_SUBMIT;
			$perm_name = "ixtframework_submit";
			$perm_desc = "";
			break;
	}
	
	$permform = new XoopsGroupPermForm($title_of_form, $module_id, $perm_name, $perm_desc, "admin/permissions.php");
	$xt = new XoopsTopic( $xoopsDB -> prefix("ixtframework_topic") );
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