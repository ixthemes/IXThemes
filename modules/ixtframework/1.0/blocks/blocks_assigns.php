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
 	
include_once XOOPS_ROOT_PATH."/modules/ixtframework/include/functions.php";
	
function b_ixtframework_assigns($options) {
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/assigns.php";
$myts =& MyTextSanitizer::getInstance();

$assigns = array();
$type_block = $options[0];
$nb_assigns = $options[1];
$lenght_title = $options[2];

/* ixtSTART handlers added */
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/pagelayout.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/slides.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/topic.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/assigns.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/widgets.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/globalnav.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/preheader.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/uitheme.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/fixskin.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/toplayout.php";
include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/botlayout.php";

$pagelayoutHandler =& xoops_getModuleHandler("ixtframework_pagelayout", "ixtframework");
$slidesHandler =& xoops_getModuleHandler("ixtframework_slides", "ixtframework");
$topicHandler =& xoops_getModuleHandler("ixtframework_topic", "ixtframework");
$widgetsHandler =& xoops_getModuleHandler("ixtframework_widgets", "ixtframework");
$globalnavHandler =& xoops_getModuleHandler("ixtframework_globalnav", "ixtframework");
$preheaderHandler =& xoops_getModuleHandler("ixtframework_preheader", "ixtframework");
$uithemeHandler =& xoops_getModuleHandler("ixtframework_uitheme", "ixtframework");
$fixskinHandler =& xoops_getModuleHandler("ixtframework_fixskin", "ixtframework");
$toplayoutHandler =& xoops_getModuleHandler("ixtframework_toplayout", "ixtframework");
$botlayoutHandler =& xoops_getModuleHandler("ixtframework_botlayout", "ixtframework");
/* ixtFINISH handlers added */

$assignsHandler =& xoops_getModuleHandler("ixtframework_assigns", "ixtframework");

$criteria = new CriteriaCompo();
array_shift($options);
array_shift($options);
array_shift($options);

/* ixtSTART topic not supported now */
/*
if (!(count($options) == 1 && $options[0] == 0)) {
$criteria->add(new Criteria("assigns_topic", block_addCatSelect($options),"IN"));
}
*/
/* ixtFINISH topic not supported now */

switch ($type_block) 
{
	case "recent":
		$criteria->add(new Criteria("assigns_online", 1));
		$criteria->setSort("assigns_date_created");
		$criteria->setOrder("DESC");
	break;
	case "day":	
		$criteria->add(new Criteria("assigns_online", 1));
		$criteria->add(new Criteria("assigns_date_created", strtotime(date("Y/m/d")), ">="));
		$criteria->add(new Criteria("assigns_date_created", strtotime(date("Y/m/d"))+86400, "<="));
		$criteria->setSort("assigns_date_created");
		$criteria->setOrder("ASC");
	break;
	case "random":
		$criteria->add(new Criteria("assigns_online", 1));
		$criteria->setSort("RAND()");
	break;
}

$criteria->setLimit($nb_assigns);
if (class_exists("XoopsPersistableObjectHandler")) {
 $assigns_arr = $assignsHandler->getall($criteria);
} else {
 // algalochkin : this need for support icms1.2 ONLY
 $assigns_arr = $assignsHandler->getObjects($criteria, false, true);
}
$k=0; // algalochkin: new index variable

	foreach (array_keys($assigns_arr) as $i) 
	{
		 $k++;
		 $assigns[$k]["assigns_id"] = $assigns_arr[$i]->getVar("assigns_id");
			$assigns[$k]["assigns_name"] = $assigns_arr[$i]->getVar("assigns_name");
			
$assigns[$k]["assigns_scrolblocks"] = explode(',',$assigns_arr[$i]->getVar("assigns_scrolblocks"));

$assigns[$k]["assigns_slblocks"] = explode(',',$assigns_arr[$i]->getVar("assigns_slblocks"));
			
$verif_assigns_jsenable = ( $assigns_arr[$i]->getVar("assigns_jsenable") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_jsenable"] = $verif_assigns_jsenable;

$globalnav =& $globalnavHandler->get($assigns_arr[$i]->getVar("assigns_globalnav"));
$title_globalnav = $globalnav->getVar("globalnav_name");	
$assigns[$k]["assigns_globalnav"] = $title_globalnav;

$verif_assigns_widecontent = ( $assigns_arr[$i]->getVar("assigns_widecontent") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_widecontent"] = $verif_assigns_widecontent;

$preheader =& $preheaderHandler->get($assigns_arr[$i]->getVar("assigns_preheader"));
$title_preheader = $preheader->getVar("preheader_name");	
$assigns[$k]["assigns_preheader"] = $title_preheader;
			
$verif_assigns_extheader = ( $assigns_arr[$i]->getVar("assigns_extheader") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_extheader"] = $verif_assigns_extheader;

$verif_assigns_headerrss = ( $assigns_arr[$i]->getVar("assigns_headerrss") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_headerrss"] = $verif_assigns_headerrss;

$slides =& $slidesHandler->get($assigns_arr[$i]->getVar("assigns_slides"));
$title_slides = $slides->getVar("slides_name");	
$assigns[$k]["assigns_slides"] = $title_slides;

$pagelayout =& $pagelayoutHandler->get($assigns_arr[$i]->getVar("assigns_layout"));
$title_pagelayout = $pagelayout->getVar("pagelayout_name");	
$assigns[$k]["assigns_layout"] = $title_pagelayout;
			
$assigns[$k]["assigns_w0"] = $assigns_arr[$i]->getVar("assigns_w0")."%";
$assigns[$k]["assigns_w1"] = $assigns_arr[$i]->getVar("assigns_w1")."%";
$assigns[$k]["assigns_w2"] = $assigns_arr[$i]->getVar("assigns_w2")."%";
$assigns[$k]["assigns_logos"] = "/uploads/ixtframework/assigns/assigns_logos/".$assigns_arr[$i]->getVar("assigns_logos");
$assigns[$k]["assigns_logow"] = $assigns_arr[$i]->getVar("assigns_logow")."px";
$assigns[$k]["assigns_logoh"] = $assigns_arr[$i]->getVar("assigns_logoh")."px";

$verif_assigns_ctrl0 = ( $assigns_arr[$i]->getVar("assigns_ctrl0") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_ctrl0"] = $verif_assigns_ctrl0;

$verif_assigns_ctrl1 = ( $assigns_arr[$i]->getVar("assigns_ctrl1") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_ctrl1"] = $verif_assigns_ctrl1;

$verif_assigns_ctrl2 = ( $assigns_arr[$i]->getVar("assigns_ctrl2") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_ctrl2"] = $verif_assigns_ctrl2;

$verif_assigns_ctrl3 = ( $assigns_arr[$i]->getVar("assigns_ctrl3") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_ctrl3"] = $verif_assigns_ctrl3;

$verif_assigns_extfooter = ( $assigns_arr[$i]->getVar("assigns_extfooter") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_extfooter"] = $verif_assigns_extfooter;

$assigns[$k]["assigns_ehblock"] = $assigns_arr[$i]->getVar("assigns_ehblock");
$assigns[$k]["assigns_efblocks0"] = explode(',',$assigns_arr[$i]->getVar("assigns_efblocks0"));
$assigns[$k]["assigns_efblocks1"] = explode(',',$assigns_arr[$i]->getVar("assigns_efblocks1"));
$assigns[$k]["assigns_efblocks2"] = explode(',',$assigns_arr[$i]->getVar("assigns_efblocks2"));
$assigns[$k]["assigns_efblocks3"] = explode(',',$assigns_arr[$i]->getVar("assigns_efblocks3"));
$assigns[$k]["assigns_wblocks1"] = explode(',',$assigns_arr[$i]->getVar("assigns_wblocks1"));
$assigns[$k]["assigns_wblocks2"] = explode(',',$assigns_arr[$i]->getVar("assigns_wblocks2"));

$verif_assigns_footerrss = ( $assigns_arr[$i]->getVar("assigns_footerrss") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_footerrss"] = $verif_assigns_footerrss;

$uitheme =& $uithemeHandler->get($assigns_arr[$i]->getVar("assigns_uitheme"));
$title_uitheme = $uitheme->getVar("uitheme_name");	
$assigns[$k]["assigns_uitheme"] = $title_uitheme;
			
$verif_assigns_multiskin = ( $assigns_arr[$i]->getVar("assigns_multiskin") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_multiskin"] = $verif_assigns_multiskin;

$fixskin =& $fixskinHandler->get($assigns_arr[$i]->getVar("assigns_fixskin"));
$title_fixskin = $fixskin->getVar("fixskin_name");	
$assigns[$k]["assigns_fixskin"] = $title_fixskin;
			
$verif_assigns_blconcat = ( $assigns_arr[$i]->getVar("assigns_blconcat") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_blconcat"] = $verif_assigns_blconcat;

$verif_assigns_sb1style = ( $assigns_arr[$i]->getVar("assigns_sb1style") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_sb1style"] = $verif_assigns_sb1style;

$verif_assigns_sb2style = ( $assigns_arr[$i]->getVar("assigns_sb2style") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_sb2style"] = $verif_assigns_sb2style;

$verif_assigns_eftstyle = ( $assigns_arr[$i]->getVar("assigns_eftstyle") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_eftstyle"] = $verif_assigns_eftstyle;

$verif_assigns_sysbstyle = ( $assigns_arr[$i]->getVar("assigns_sysbstyle") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_sysbstyle"] = $verif_assigns_sysbstyle;

$verif_assigns_wide1style = ( $assigns_arr[$i]->getVar("assigns_wide1style") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_wide1style"] = $verif_assigns_wide1style;

$verif_assigns_wide2style = ( $assigns_arr[$i]->getVar("assigns_wide2style") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_wide2style"] = $verif_assigns_wide2style;

$verif_assigns_rtl = ( $assigns_arr[$i]->getVar("assigns_rtl") == 1 ) ? "yes" : "no";
$assigns[$k]["assigns_rtl"] = $verif_assigns_rtl;

$toplayout =& $toplayoutHandler->get($assigns_arr[$i]->getVar("assigns_content_top_order"));
$title_toplayout = $toplayout->getVar("toplayout_name");	
$assigns[$k]["assigns_content_top_order"] = $title_toplayout;

$botlayout =& $botlayoutHandler->get($assigns_arr[$i]->getVar("assigns_content_bottom_order"));
$title_botlayout = $botlayout->getVar("botlayout_name");	
$assigns[$k]["assigns_content_bottom_order"] = $title_botlayout;
			
			
			$assigns[$k]["assigns_submitter"] = $assigns_arr[$i]->getVar("assigns_submitter");
			$assigns[$k]["assigns_date_created"] = $assigns_arr[$i]->getVar("assigns_date_created");
			$assigns[$k]["assigns_online"] = $assigns_arr[$i]->getVar("assigns_online");
	}
return $assigns;
}

function b_ixtframework_assigns_edit($options) {
	include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/topic.php";
	
	$topicHandler =& xoops_getModuleHandler("ixtframework_topic", "ixtframework");
	$criteria = new CriteriaCompo();
	$criteria->setSort("topic_title");
	$criteria->setOrder("ASC");
	$topic_arr = $topicHandler->getall($criteria);
	
	$form = ""._MB_IXTFRAMEWORK_ASSIGNS_DISPLAY."\n";
	$form .= "<input type=\"hidden\" name=\"options[0]\" value=\"".$options[0]."\" />";
	$form .= "<input name=\"options[1]\" size=\"5\" maxlength=\"255\" value=\"".$options[1]."\" type=\"text\" />&nbsp;<br />";
	$form .= ""._MB_IXTFRAMEWORK_ASSIGNS_TITLELENGTH." : <input name=\"options[2]\" size=\"5\" maxlength=\"255\" value=\"".$options[2]."\" type=\"text\" /><br /><br />";
	array_shift($options);
	array_shift($options);
	array_shift($options);
	$form .= ""._MB_IXTFRAMEWORK_ASSIGNS_CATTODISPLAY."<br /><select name=\"options[]\" multiple=\"multiple\" size=\"5\">";
	$form .= "<option value=\"0\" " . (array_search(0, $options) === false ? "" : "selected=\"selected\"") . ">" ._MB_IXTFRAMEWORK_ASSIGNS_ALLCAT . "</option>";
	foreach (array_keys($topic_arr) as $i) {
		$form .= "<option value=\"" . $topic_arr[$i]->getVar("topic_id") . "\" " . (array_search($topic_arr[$i]->getVar("topic_id"), $options) === false ? "" : "selected=\"selected\"") . ">".$topic_arr[$i]->getVar("topic_title")."</option>";
	}
	$form .= "</select>";

	return $form;
}
	
?>