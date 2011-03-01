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
 * Version : 1.07:
 * ****************************************************************************
 */
 
include_once("./header.php");

xoops_cp_header();

if (!ixtcake_isrmcommon()) {
	// algalochkin: Admin menu with support old CMS version or icms
	if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
	ixtcake_adminmenu(5, _AM_IXTCAKE_MANAGER_ABOUT);
	} else {
	include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
	loadModuleAdminMenu (5, _AM_IXTCAKE_MANAGER_ABOUT);
	}
	if (class_exists('XoopsPreload')) {
		// since XOOPS 2.4.x
		$xoopsPreload =& XoopsPreload::getInstance();
		$xoopsPreload->triggerEvent('ixtcake.admin');
  $xoopsPreload->triggerEvent('ixtcake.jgrowlredirect');
	}
} else {
 define('RMCLOCATION','about'); // for menubar item hover
 ixtcake_rmtoolbar();
	echo "
	<link rel=\"stylesheet\" href=\"../css/prettyPhoto.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\" />
	<script type=\"text/javascript\" src=\"../js/jquery.prettyPhoto.js\" charset=\"utf-8\"></script>
	";
	echo "<script type=\"text/javascript\" charset=\"utf-8\">
		$(document).ready(function(){
			$(\"a[rel^=prettyPhoto]\").prettyPhoto({
				animationSpeed: \"normal\",
				padding: 40,
				opacity: 0.35,
				showTitle: true,
				allowresize: true,
				counter_separator_label: \"/\",
				theme: \"light_rounded\"
			});
		});
	</script>";
	echo "<style>
	/* Correction RMCommon GUI for required elements in XOOPS form */
	div.xoops-form-element-caption .caption-marker { display:none; }
	div.xoops-form-element-caption-required .caption-marker {	background-color:inherit;	padding-left:2px;	color:#ff0000; }
	</style>
	";
}

echo "<style>
.cpbigtitle{ float:left; width:95%; font-size: 20px; color: #1E90FF; background: no-repeat left top; font-weight: bold; height: 50px; vertical-align: middle; padding: 10px 0 0 50px; border-bottom: 3px solid #1E90FF; }
.cleared { float: none; clear: both; margin: 0; padding: 0; border: none; font-size: 1px; }
fieldset {margin: .5em;padding: 1em;border: 1px solid #333;color: #000;background-color: #f0f0f0;-moz-border-radius: 6px;-webkit-border-radius: 6px;-khtml-border-radius: 6px;border-radius: 6px;}
legend {padding: .5em;font-size: 1.1em;font-weight: bolder;}
label, .caption-text {margin-bottom: .5em;padding-right: .5em;font-weight: bold;}
</style>";
echo "<div class=\"cpbigtitle\" style=\"background-image: url(../images/deco/about.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\"><strong>"._AM_IXTCAKE_MANAGER_ABOUT."</strong>
</div><div class=\"cleared\"></div><br /><br />";

$versioninfo =& $module_handler->get( $xoopsModule->getVar("mid") );

echo "<style type=\"text/css\">
label,text { display: block; float: left; margin-bottom: 2px; }
label { text-align: right; width: 150px; padding-right: 20px; }
br { clear: left; }
</style>

	<fieldset>
		<legend style=\"font-weight: bold; color: #900;\">".$xoopsModule->getVar("name")."</legend>
			<div style=\"padding: 8px;\">
				<img src=\"".XOOPS_URL."/modules/".$xoopsModule->getVar("dirname")."/".$versioninfo->getInfo("image")."\" alt=\"\" hspace=\"10\" vspace=\"0\" /></a>\n
				<div style=\"padding: 5px;\"><strong>".$versioninfo->getInfo("name")." version ".$versioninfo->getInfo("version")."</strong></div>\n
				<label>"._AM_IXTCAKE_ABOUT_DESC.":</label><text>".$versioninfo->getInfo("description")."</text><br />
				<label>"._AM_IXTCAKE_ABOUT_RELEASEDATE.":</label><text>".$versioninfo->getInfo("release")."</text><br />
				<label>"._AM_IXTCAKE_ABOUT_AUTHOR.":</label><text>".$versioninfo->getInfo("author")."</text><br />
				<label>"._AM_IXTCAKE_ABOUT_CREDITS.":</label><text>".$versioninfo->getInfo("credits")."</text><br />
				<label>"._AM_IXTCAKE_ABOUT_LICENSE.":</label><text><a href=\"".$versioninfo->getInfo("license_file")."\" target=\"_blank\" >".$versioninfo->getInfo("license")."</a></text>\n
			</div>
	</fieldset>
<br clear=\"all\"/>

	<fieldset>
		<legend style=\"font-weight: bold; color: #900;\">"._AM_IXTCAKE_ABOUT_MODULE_INFO."</legend>
			<div style=\"padding: 8px;\">
				<label>"._AM_IXTCAKE_ABOUT_MODULE_STATUS.":</label><text>".$versioninfo->getInfo("module_status")."</text><br />
				<label>"._AM_IXTCAKE_ABOUT_WEBSITE.":</label><text><a href=\"".$versioninfo->getInfo("module_website_url")."\" target=\"_blank\">".$versioninfo->getInfo("module_website_name")."</a></text><br />
			</div>
	</fieldset>
<br clear=\"all\" />

	<fieldset>
		<legend style=\"font-weight: bold; color: #900;\">"._AM_IXTCAKE_ABOUT_AUTHOR_INFO."</legend>
			<div style=\"padding: 8px;\">
				<label>"._AM_IXTCAKE_ABOUT_AUTHOR_NAME.":</label><text>".$versioninfo->getInfo("author")."</text><br />
				<label>"._AM_IXTCAKE_ABOUT_WEBSITE.":</label><text><a href=\"".$versioninfo->getInfo("author_website_url")."\" target=\"_blank\">".$versioninfo->getInfo("author_website_name")."</a></text><br />
			</div>
	</fieldset>
<br clear=\"all\" />";

$file = XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar("dirname")."/doc/changelog.txt";

if ( is_readable( $file ) ){
echo "<fieldset>
		<legend style=\"font-weight: bold; color: #900;\">"._AM_IXTCAKE_ABOUT_CHANGELOG."</legend>
			<div style=\"padding: 8px;\">
				<div>".implode("<br />", file( $file ))."</div>
			</div>
	</fieldset>
	<br clear=\"all\" />";

}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
?>