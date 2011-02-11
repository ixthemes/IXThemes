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
 
include_once("./header.php");

xoops_cp_header();

global $xoopsModule;

//Apelle du menu admin
if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
IXTFrameWork_adminmenu(0, _AM_IXTFRAMEWORK_MANAGER_INDEX);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (0, _AM_IXTFRAMEWORK_MANAGER_INDEX);
}

	//compte "total"
	$count_pagelayout = $pagelayoutHandler->getCount();
	//compte "attente"
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("pagelayout_online", 1));
	$pagelayout_online = $pagelayoutHandler->getCount($criteria);
	
	//compte "total"
	$count_slides = $slidesHandler->getCount();
	//compte "attente"
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("slides_online", 1));
	$slides_online = $slidesHandler->getCount($criteria);
	
	//compte "total"
	$count_topic = $topicHandler->getCount();
	//compte "attente"
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("topic_online", 1));
	$topic_online = $topicHandler->getCount($criteria);
	
	//compte "total"
	$count_assigns = $assignsHandler->getCount();
	//compte "attente"
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("assigns_online", 1));
	$assigns_online = $assignsHandler->getCount($criteria);
	
	//compte "total"
	$count_wigets = $wigetsHandler->getCount();
	//compte "attente"
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("wigets_online", 1));
	$wigets_online = $wigetsHandler->getCount($criteria);
	
	//compte "total"
	$count_globalnav = $globalnavHandler->getCount();
	//compte "attente"
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("globalnav_online", 1));
	$globalnav_online = $globalnavHandler->getCount($criteria);
	
	//compte "total"
	$count_preheader = $preheaderHandler->getCount();
	//compte "attente"
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("preheader_online", 1));
	$preheader_online = $preheaderHandler->getCount($criteria);
	
	//compte "total"
	$count_uitheme = $uithemeHandler->getCount();
	//compte "attente"
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("uitheme_online", 1));
	$uitheme_online = $uithemeHandler->getCount($criteria);
	
	//compte "total"
	$count_fixskin = $fixskinHandler->getCount();
	//compte "attente"
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("fixskin_online", 1));
	$fixskin_online = $fixskinHandler->getCount($criteria);
	
	//compte "total"
	$count_toplayout = $toplayoutHandler->getCount();
	//compte "attente"
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("toplayout_online", 1));
	$toplayout_online = $toplayoutHandler->getCount($criteria);
	
	//compte "total"
	$count_botlayout = $botlayoutHandler->getCount();
	//compte "attente"
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("botlayout_online", 1));
	$botlayout_online = $botlayoutHandler->getCount($criteria);
	
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/menu.php";

	$menu = new IXTFrameWorkMenu();
/*
 $menu->addItem("pagelayout", "pagelayout.php", "../images/deco/assigns.png", _AM_IXTFRAMEWORK_MANAGER_PAGELAYOUT);
	$menu->addItem("slides", "slides.php", "../images/deco/assigns.png", _AM_IXTFRAMEWORK_MANAGER_SLIDES);
	$menu->addItem("topic", "topic.php", "../images/deco/topic.png", _AM_IXTFRAMEWORK_MANAGER_TOPIC);
*/
 $menu->addItem("assigns", "assigns.php", "../images/deco/assigns.png", _AM_IXTFRAMEWORK_MANAGER_ASSIGNS);
/*
 $menu->addItem("wigets", "wigets.php", "../images/deco/assigns.png", _AM_IXTFRAMEWORK_MANAGER_WIGETS);
	$menu->addItem("globalnav", "globalnav.php", "../images/deco/assigns.png", _AM_IXTFRAMEWORK_MANAGER_GLOBALNAV);
	$menu->addItem("preheader", "preheader.php", "../images/deco/assigns.png", _AM_IXTFRAMEWORK_MANAGER_PREHEADER);
	$menu->addItem("uitheme", "uitheme.php", "../images/deco/assigns.png", _AM_IXTFRAMEWORK_MANAGER_UITHEME);
	$menu->addItem("fixskin", "fixskin.php", "../images/deco/assigns.png", _AM_IXTFRAMEWORK_MANAGER_FIXSKIN);
	$menu->addItem("toplayout", "toplayout.php", "../images/deco/assigns.png", _AM_IXTFRAMEWORK_MANAGER_TOPLAYOUT);
	$menu->addItem("botlayout", "botlayout.php", "../images/deco/assigns.png", _AM_IXTFRAMEWORK_MANAGER_BOTLAYOUT);
*/
 $menu->addItem("update", "../../system/admin.php?fct=modulesadmin&op=update&module=IXTFrameWork", "../images/deco/update.png",  _AM_IXTFRAMEWORK_MANAGER_UPDATE);	
//	$menu->addItem("permissions", "permissions.php", "../images/deco/permissions.png", _AM_IXTFRAMEWORK_MANAGER_PERMISSIONS);
	$menu->addItem("preference", "../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule->getVar("mid")."&amp;&confcat_id=1", "../images/deco/pref.png", _AM_IXTFRAMEWORK_MANAGER_PREFERENCES);
	$menu->addItem("about", "about.php", "../images/deco/about.png", _AM_IXTFRAMEWORK_MANAGER_ABOUT);
	
	echo $menu->getCSS();
	
	
$curtheme = $GLOBALS['xoopsConfig']['theme_set'];
if (!(is_file(XOOPS_ROOT_PATH . '/themes/'.$curtheme.'/tpl/assigns.html'))) {
    xoops_error(sprintf(_AM_IXTFRAMEWORK_WARNINGNOTIXTTHEME, $curtheme));
    echo '<br />';
} elseif (!(is_file(XOOPS_ROOT_PATH . '/themes/'.$curtheme.'/xoplugins/ixt09.php'))) {
    xoops_error(sprintf(_AM_IXTFRAMEWORK_WARNINGNOTIXTTHEME4, $curtheme));
    echo '<br />';
}

echo "<div class=\"CPbigTitle\" style=\"background-image: url(../images/deco/index.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\"><strong>"._AM_IXTFRAMEWORK_MANAGER_INDEX."</strong></div><br />
		<table width=\"100%\" border=\"0\" cellspacing=\"10\" cellpadding=\"4\">
			<tr>
				<td valign=\"top\">".$menu->render()."</td>
				<td valign=\"top\" width=\"60%\">";
				
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
						<legend class=\"CPmediumTitle\">"._AM_IXTFRAMEWORK_MANAGER_TOPIC."</legend>
						<br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_TOPIC, $count_topic);
						echo "<br /><br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_TOPIC_ONLINE, $topic_online);
						echo "<br />
					</fieldset><br /><br />";
					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">"._AM_IXTFRAMEWORK_MANAGER_WIGETS."</legend>
						<br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_WIGETS, $count_wigets);
						echo "<br /><br />";
						printf(_AM_IXTFRAMEWORK_THEREARE_WIGETS_ONLINE, $wigets_online);
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
					
				echo "</td>
			</tr>
		</table>
<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();

?>