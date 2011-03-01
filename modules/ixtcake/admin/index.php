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
 
include_once("./header.php");
include_once(XOOPS_ROOT_PATH.'/modules/ixtcake/class/menu.php');

xoops_cp_header();

global $xoopsModule;

if (!ixtcake_isrmcommon()) {
	// algalochkin: Admin menu with support old CMS version or icms
	if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
	ixtcake_adminmenu(0, _AM_IXTCAKE_MANAGER_INDEX);
	} else {
	include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
	loadModuleAdminMenu (0, _AM_IXTCAKE_MANAGER_INDEX);
	}
	if (class_exists('XoopsPreload')) {
		// since XOOPS 2.4.x
		$xoopsPreload =& XoopsPreload::getInstance();
		$xoopsPreload->triggerEvent('ixtcake.admin');
  $xoopsPreload->triggerEvent('ixtcake.jgrowlredirect');
	}
} else {
 define('RMCLOCATION','dashboard'); // for menubar item hover
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

//	$count_themes = count(XoopsLists::getThemesList());
//	$themes_online = count($GLOBALS["xoopsConfig"]["theme_set_allowed"]);
//	$themes_default = $GLOBALS["xoopsConfig"]["theme_set"];

	$count_apptestgroups = $apptestgroupsHandler->getCount();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("apptestgroups_online", 1));
	$apptestgroups_online = $apptestgroupsHandler->getCount($criteria);
	
	$count_coretestgroups = $coretestgroupsHandler->getCount();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("coretestgroups_online", 1));
	$coretestgroups_online = $coretestgroupsHandler->getCount($criteria);
	
	$count_apptestcases = $apptestcasesHandler->getCount();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("apptestcases_online", 1));
	$apptestcases_online = $apptestcasesHandler->getCount($criteria);
	
	$count_coretestcases = $coretestcasesHandler->getCount();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("coretestcases_online", 1));
	$coretestcases_online = $coretestcasesHandler->getCount($criteria);
	
	$menu = new ixtcakeMenu();
	
 $menu->addItem("buythemes", "http://shop.ixthemes.com", "../images/deco/shop.png", _AM_IXTCAKE_MANAGER_BUYTHEMES);
	$menu->addItem("about", "about.php", "../images/deco/about.png", _AM_IXTCAKE_MANAGER_ABOUT);
	$menu->addItem("preference", "../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule->getVar("mid")."&amp;&confcat_id=1", "../images/deco/pref.png", _AM_IXTCAKE_MANAGER_PREFERENCES);
 $menu->addItem("update", "../../system/admin.php?fct=modulesadmin&op=update&module=ixtcake", "../images/deco/update.png",  _AM_IXTCAKE_MANAGER_UPDATE);	
 $menu->addItem("apptestgroups", "apptestgroups.php", "../images/deco/apptestgroups.png", _AM_IXTCAKE_MANAGER_APPTESTGROUPS);$menu->addItem("coretestgroups", "coretestgroups.php", "../images/deco/coretestgroups.png", _AM_IXTCAKE_MANAGER_CORETESTGROUPS);$menu->addItem("apptestcases", "apptestcases.php", "../images/deco/apptestcases.png", _AM_IXTCAKE_MANAGER_APPTESTCASES);$menu->addItem("coretestcases", "coretestcases.php", "../images/deco/coretestcases.png", _AM_IXTCAKE_MANAGER_CORETESTCASES);
	$menu->addItem("whoisusing", "http://ixthemes.org/modules/wflinks/viewcat.php?cid=3", "../images/deco/whoisusing.png", _AM_IXTCAKE_MANAGER_WHOISUSING);
	$menu->addItem("findthebesttheme", "http://downloads.ixthemes.com/xoops", "../images/deco/findtheme.png", _AM_IXTCAKE_MANAGER_FINDTHEBESTTHEME);
	$menu->addItem("subscriberss", "http://ixthemes.com/headlines/feed.rss", "../images/deco/subscriberss.png", _AM_IXTCAKE_MANAGER_SUBSCRIBERSS);
	$menu->addItem("followus", "http://twitter.com/ixthemes", "../images/deco/followus.png", _AM_IXTCAKE_MANAGER_FOLLOWUS);
	$menu->addItem("anyquestions", "http://ixthemes.org/modules/liaise/index.php?form_id=1", "../images/deco/help.png", _AM_IXTCAKE_MANAGER_ANYQUESTIONS);
	$menu->addItem("iuseit", "http://www.ohloh.net/stack_entries/new?project_id=ixthemes&ref=WidgetProjectUsersLogo", "../images/deco/iuseit.png", _AM_IXTCAKE_MANAGER_IUSEIT);
	$menu->addItem("xoops233demo", "http://xoops233demo.ixthemes.org", "../images/deco/xoopsdemo.png", _AM_IXTCAKE_MANAGER_XOOPS233DEMO);
	$menu->addItem("xoops245demo", "http://xoops245demo.ixthemes.org", "../images/deco/xoopsdemo.png", _AM_IXTCAKE_MANAGER_XOOPS245DEMO);
	$menu->addItem("xoops250demo", "http://xoops250demo.ixthemes.org", "../images/deco/xoopsdemo.png", _AM_IXTCAKE_MANAGER_XOOPS250DEMO);

	echo $menu->getCSS();
	
echo "<style>
.cpbigtitle{
	font-size: 20px;
	color: #1E90FF;
	background: no-repeat left top;
	font-weight: bold;
	height: 50px;
	vertical-align: middle;
	padding: 10px 0 0 50px;
	border-bottom: 3px solid #1E90FF;
}
/* ixtSTART colors */
.red { background-color:transparent; color:#ff0000; }
.blue { background-color:transparent; color:#0000ff; }
.black { background-color:transparent; color:#000; }
.white { background-color:transparent; color:#fff; }
.yellow { background-color:transparent; color:#ffff00; }
.orange { background-color:transparent; color:#ffa500; }
.green { background-color:transparent; color:#008000; }
.silver { background-color:transparent; color:#c0c0c0; }
/* ixtFINISH colors */
/* ixtSTART mark and table */
.mark {	background-color: #91EF88; }
.mark td {	padding:10px 0 10px 0; }
td { vertical-align:top; )
/* ixtFINISH mark and table */
</style>";

/*	
xoops_error(sprintf(_AM_IXTCAKE_MANAGER_WARNINGFREE, ""));
echo "<br />";
*/

echo "<div class=\"cpbigtitle\" style=\"background-image: url(../images/deco/index.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\"><strong>"._AM_IXTCAKE_MANAGER_INDEX."</strong></div><br />
		<table width=\"100%\" border=\"0\" cellspacing=\"10\" cellpadding=\"4\">
			<tr>
				<td valign=\"top\">".$menu->render()."</td>
				<td valign=\"top\" width=\"60%\">";
			
					echo "<fieldset>
						<legend class=\"CPmediumTitle\"><a href=\"apptestgroups.php\">"._AM_IXTCAKE_MANAGER_APPTESTGROUPS."</a></legend>
						<br />";
						printf(_AM_IXTCAKE_THEREARE_APPTESTGROUPS, $count_apptestgroups);
						echo "<br /><br />";
						printf(_AM_IXTCAKE_THEREARE_APPTESTGROUPS_ONLINE, $apptestgroups_online);
						echo "<br />
					</fieldset><br /><br />";
					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\"><a href=\"coretestgroups.php\">"._AM_IXTCAKE_MANAGER_CORETESTGROUPS."</a></legend>
						<br />";
						printf(_AM_IXTCAKE_THEREARE_CORETESTGROUPS, $count_coretestgroups);
						echo "<br /><br />";
						printf(_AM_IXTCAKE_THEREARE_CORETESTGROUPS_ONLINE, $coretestgroups_online);
						echo "<br />
					</fieldset><br /><br />";
					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\"><a href=\"apptestcases.php\">"._AM_IXTCAKE_MANAGER_APPTESTCASES."</a></legend>
						<br />";
						printf(_AM_IXTCAKE_THEREARE_APPTESTCASES, $count_apptestcases);
						echo "<br /><br />";
						printf(_AM_IXTCAKE_THEREARE_APPTESTCASES_ONLINE, $apptestcases_online);
						echo "<br />
					</fieldset><br /><br />";
					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\"><a href=\"coretestcases.php\">"._AM_IXTCAKE_MANAGER_CORETESTCASES."</a></legend>
						<br />";
						printf(_AM_IXTCAKE_THEREARE_CORETESTCASES, $count_coretestcases);
						echo "<br /><br />";
						printf(_AM_IXTCAKE_THEREARE_CORETESTCASES_ONLINE, $coretestcases_online);
						echo "<br />
					</fieldset><br /><br />";
					
				echo "</td>
			</tr>
		</table>
<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";

xoops_cp_footer();

?>