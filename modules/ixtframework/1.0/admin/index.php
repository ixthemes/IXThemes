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
 
include_once("./header.php");

xoops_cp_header();

global $xoopsModule;

$module_handler =& xoops_gethandler('module');
$installed_mods = $module_handler->getObjects();
foreach ($installed_mods as $module) {if ($module->getVar('dirname') == 'rmcommon' && $module->getVar('isactive') == 1) {$rmisactive = 1;}}
if (isset($rmisactive) && ($rmisactive)) {
echo "
<link rel=\"stylesheet\" href=\"../css/prettyPhoto.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\" />
<link rel=\"stylesheet\" href=\"../css/jgrowl.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\" />
<link rel=\"stylesheet\" href=\"../css/tooltip.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\" />
<script type=\"text/javascript\" src=\"../js/jquery.prettyPhoto.js\" charset=\"utf-8\"></script>
<script type=\"text/javascript\" src=\"../js/jquery.jgrowl.js\" charset=\"utf-8\"></script>
<script type=\"text/javascript\" src=\"../js/tooltip.js\" charset=\"utf-8\"></script>
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
} else {
	if (class_exists('XoopsPreload')) {
		// since XOOPS 2.4.x
		$xoopsPreload =& XoopsPreload::getInstance();
		$xoopsPreload->triggerEvent('ixtframework.admin');
  $xoopsPreload->triggerEvent('ixtframework.jgrowlredirect');
	}
}

// algalochkin: Admin menu with support old CMS version or icms
if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
ixtframework_adminmenu(0, _AM_IXTFRAMEWORK_MANAGER_INDEX);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (0, _AM_IXTFRAMEWORK_MANAGER_INDEX);
}

	$count_themes = count(XoopsLists::getThemesList());
	$themes_online = count($GLOBALS["xoopsConfig"]["theme_set_allowed"]);
//	$themes_default = $GLOBALS["xoopsConfig"]["theme_set"];
	$themes_selected = $GLOBALS["xoopsConfig"]["theme_set"];

	$count_pagelayout = $pagelayoutHandler->getCount();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("pagelayout_online", 1));
	$pagelayout_online = $pagelayoutHandler->getCount($criteria);
	
	$count_slides = $slidesHandler->getCount();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("slides_online", 1));
	$slides_online = $slidesHandler->getCount($criteria);
	
	$count_topic = $topicHandler->getCount();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("topic_online", 1));
	$topic_online = $topicHandler->getCount($criteria);
	
	$count_assigns = $assignsHandler->getCount();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("assigns_online", 1));
	$assigns_online = $assignsHandler->getCount($criteria);
	
	$count_widgets = $widgetsHandler->getCount();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("widgets_online", 1));
	$widgets_online = $widgetsHandler->getCount($criteria);
	
	$count_globalnav = $globalnavHandler->getCount();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("globalnav_online", 1));
	$globalnav_online = $globalnavHandler->getCount($criteria);
	
	$count_preheader = $preheaderHandler->getCount();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("preheader_online", 1));
	$preheader_online = $preheaderHandler->getCount($criteria);
	
	$count_uitheme = $uithemeHandler->getCount();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("uitheme_online", 1));
	$uitheme_online = $uithemeHandler->getCount($criteria);
	
	$count_fixskin = $fixskinHandler->getCount();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("fixskin_online", 1));
	$fixskin_online = $fixskinHandler->getCount($criteria);
	
	$count_toplayout = $toplayoutHandler->getCount();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("toplayout_online", 1));
	$toplayout_online = $toplayoutHandler->getCount($criteria);
	
	$count_botlayout = $botlayoutHandler->getCount();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("botlayout_online", 1));
	$botlayout_online = $botlayoutHandler->getCount($criteria);
	
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/menu.php";

	$menu = new ixtframeworkMenu();
 $menu->addItem("buythemes", "http://shop.ixthemes.com", "../images/deco/shop.png", _AM_IXTFRAMEWORK_MANAGER_BUYTHEMES);
	$menu->addItem("about", "about.php", "../images/deco/about.png", _AM_IXTFRAMEWORK_MANAGER_ABOUT);
	$menu->addItem("preference", "../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule->getVar("mid")."&amp;&confcat_id=1", "../images/deco/pref.png", _AM_IXTFRAMEWORK_MANAGER_PREFERENCES);
	$menu->addItem("update", "../../system/admin.php?fct=modulesadmin&op=update&module=ixtframework", "../images/deco/update.png",  _AM_IXTFRAMEWORK_MANAGER_UPDATE);	
 $menu->addItem("assigns", "assigns.php", "../images/deco/assigns.png", _AM_IXTFRAMEWORK_MANAGER_ASSIGNS);
	$menu->addItem("themes", "themes.php", "../images/deco/themes.png", _AM_IXTFRAMEWORK_MANAGER_THEMES);
 $menu->addItem("pagelayout", "pagelayout.php", "../images/deco/pagelayout.png", _AM_IXTFRAMEWORK_MANAGER_PAGELAYOUT);
	$menu->addItem("slides", "slides.php", "../images/deco/slides.png", _AM_IXTFRAMEWORK_MANAGER_SLIDES);
//	$menu->addItem("topic", "topic.php", "../images/deco/topic.png", _AM_IXTFRAMEWORK_MANAGER_TOPIC);
	$menu->addItem("widgets", "widgets.php", "../images/deco/widgets.png", _AM_IXTFRAMEWORK_MANAGER_WIDGETS);
	$menu->addItem("globalnav", "globalnav.php", "../images/deco/globalnav.png", _AM_IXTFRAMEWORK_MANAGER_GLOBALNAV);
	$menu->addItem("preheader", "preheader.php", "../images/deco/preheader.png", _AM_IXTFRAMEWORK_MANAGER_PREHEADER);
//	$menu->addItem("uitheme", "uitheme.php", "../images/deco/uitheme.png", _AM_IXTFRAMEWORK_MANAGER_UITHEME);
// $menu->addItem("fixskin", "fixskin.php", "../images/deco/fixskin.png", _AM_IXTFRAMEWORK_MANAGER_FIXSKIN);
	$menu->addItem("toplayout", "toplayout.php", "../images/deco/toplayout.png", _AM_IXTFRAMEWORK_MANAGER_TOPLAYOUT);
	$menu->addItem("botlayout", "botlayout.php", "../images/deco/botlayout.png", _AM_IXTFRAMEWORK_MANAGER_BOTLAYOUT);
//	$menu->addItem("permissions", "permissions.php", "../images/deco/permissions.png", _AM_IXTFRAMEWORK_MANAGER_PERMISSIONS);
	$menu->addItem("whoisusing", "http://ixthemes.org/modules/wflinks/viewcat.php?cid=3", "../images/deco/whoisusing.png", _AM_IXTFRAMEWORK_MANAGER_WHOISUSING);
	$menu->addItem("findthebesttheme", "http://downloads.ixthemes.com/xoops", "../images/deco/findtheme.png", _AM_IXTFRAMEWORK_MANAGER_FINDTHEBESTTHEME);
	$menu->addItem("subscriberss", "http://ixthemes.com/headlines/feed.rss", "../images/deco/subscriberss.png", _AM_IXTFRAMEWORK_MANAGER_SUBSCRIBERSS);
	$menu->addItem("followus", "http://twitter.com/ixthemes", "../images/deco/followus.png", _AM_IXTFRAMEWORK_MANAGER_FOLLOWUS);
	$menu->addItem("anyquestions", "http://ixthemes.org/modules/liaise/index.php?form_id=1", "../images/deco/help.png", _AM_IXTFRAMEWORK_MANAGER_ANYQUESTIONS);
	$menu->addItem("iuseit", "http://www.ohloh.net/stack_entries/new?project_id=ixthemes&ref=WidgetProjectUsersLogo", "../images/deco/iuseit.png", _AM_IXTFRAMEWORK_MANAGER_IUSEIT);
	$menu->addItem("xoops233demo", "http://xoops233demo.ixthemes.org", "../images/deco/xoopsdemo.png", _AM_IXTFRAMEWORK_MANAGER_XOOPS233DEMO);
	$menu->addItem("xoops245demo", "http://xoops245demo.ixthemes.org", "../images/deco/xoopsdemo.png", _AM_IXTFRAMEWORK_MANAGER_XOOPS245DEMO);
	$menu->addItem("xoops250demo", "http://xoops250demo.ixthemes.org", "../images/deco/xoopsdemo.png", _AM_IXTFRAMEWORK_MANAGER_XOOPS250DEMO);

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
	
/* current selected theme on user side */
$curtheme = $GLOBALS["xoopsConfig"]["theme_set"];

xoops_error(sprintf(_AM_IXTFRAMEWORK_MANAGER_WARNINGFREE, ""));
echo "<br />";

/* list only allowed themes */
$themesallowed = $GLOBALS["xoopsConfig"]["theme_set_allowed"];
if (!(is_file(XOOPS_THEME_PATH . "/" . $curtheme . "/tpl/assigns.html"))) {
    xoops_error(sprintf(_AM_IXTFRAMEWORK_MANAGER_WARNINGNOTIXTTHEME, $curtheme));
    echo "<br />";
} elseif (!(is_file(XOOPS_THEME_PATH . "/" . $curtheme."/xoplugins/ixt09.php"))) {
    xoops_error(sprintf(_AM_IXTFRAMEWORK_MANAGER_WARNINGNOTIXTTHEME4, $curtheme));
    echo "<br />";
} else {
    xoops_error(sprintf(_AM_IXTFRAMEWORK_MANAGER_WARNINGDEFTHEME1, $curtheme));
    echo "<br />";
}

echo "<div class=\"cpbigtitle\" style=\"background-image: url(../images/deco/index.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\"><strong>"._AM_IXTFRAMEWORK_MANAGER_INDEX."</strong></div><br />
		<table width=\"100%\" border=\"0\" cellspacing=\"10\" cellpadding=\"4\">
			<tr>
				<td valign=\"top\">".$menu->render()."</td>
				<td valign=\"top\" width=\"60%\">";
				
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">"._AM_IXTFRAMEWORK_MANAGER_THEMES."</legend>
						<br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_THEMES, $count_themes);
						echo "<br /><br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_THEMES_ONLINE, $themes_online);
						echo "<br /><br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_THEMES_SELECTED, $themes_selected);
//						echo "<br /><br />";
//						printf(_AM_IXTFRAMEWORK_THEREARE_THEMES_DEFAULT, $themes_default);
						echo "<br />
					</fieldset><br /><br />";
					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">"._AM_IXTFRAMEWORK_MANAGER_ASSIGNS."</legend>
						<br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_ASSIGNS, $count_assigns);
						echo "<br /><br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_ASSIGNS_ONLINE, $assigns_online);
						echo "<br />
					</fieldset><br /><br />";
					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">"._AM_IXTFRAMEWORK_MANAGER_PAGELAYOUT."</legend>
						<br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_PAGELAYOUT, $count_pagelayout);
						echo "<br /><br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_PAGELAYOUT_ONLINE, $pagelayout_online);
						echo "<br />
					</fieldset><br /><br />";
					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">"._AM_IXTFRAMEWORK_MANAGER_SLIDES."</legend>
						<br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_SLIDES, $count_slides);
						echo "<br /><br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_SLIDES_ONLINE, $slides_online);
						echo "<br />
					</fieldset><br /><br />";
					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">"._AM_IXTFRAMEWORK_MANAGER_WIDGETS."</legend>
						<br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_WIDGETS, $count_widgets);
						echo "<br /><br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_WIDGETS_ONLINE, $widgets_online);
						echo "<br />
					</fieldset><br /><br />";
					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">"._AM_IXTFRAMEWORK_MANAGER_GLOBALNAV."</legend>
						<br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_GLOBALNAV, $count_globalnav);
						echo "<br /><br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_GLOBALNAV_ONLINE, $globalnav_online);
						echo "<br />
					</fieldset><br /><br />";
					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">"._AM_IXTFRAMEWORK_MANAGER_PREHEADER."</legend>
						<br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_PREHEADER, $count_preheader);
						echo "<br /><br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_PREHEADER_ONLINE, $preheader_online);
						echo "<br />
					</fieldset><br /><br />";
					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">"._AM_IXTFRAMEWORK_MANAGER_TOPLAYOUT."</legend>
						<br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_TOPLAYOUT, $count_toplayout);
						echo "<br /><br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_TOPLAYOUT_ONLINE, $toplayout_online);
						echo "<br />
					</fieldset><br /><br />";
					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">"._AM_IXTFRAMEWORK_MANAGER_BOTLAYOUT."</legend>
						<br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_BOTLAYOUT, $count_botlayout);
						echo "<br /><br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_BOTLAYOUT_ONLINE, $botlayout_online);
						echo "<br />
					</fieldset><br /><br />";
/*					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">"._AM_IXTFRAMEWORK_MANAGER_UITHEME."</legend>
						<br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_UITHEME, $count_uitheme);
						echo "<br /><br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_UITHEME_ONLINE, $uitheme_online);
						echo "<br />
					</fieldset><br /><br />";
					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">"._AM_IXTFRAMEWORK_MANAGER_FIXSKIN."</legend>
						<br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_FIXSKIN, $count_fixskin);
						echo "<br /><br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_FIXSKIN_ONLINE, $fixskin_online);
						echo "<br />
					</fieldset><br /><br />";
					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">"._AM_IXTFRAMEWORK_MANAGER_TOPIC."</legend>
						<br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_TOPIC, $count_topic);
						echo "<br /><br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_TOPIC_ONLINE, $topic_online);
						echo "<br />
					</fieldset><br /><br />";
*/					
					
				echo "</td>
			</tr>
		</table>
<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();

?>