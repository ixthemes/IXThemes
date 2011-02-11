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
 	
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/include/functions.php";
	
function b_ixtframework_assigns($options) {
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/assigns.php";
$myts =& MyTextSanitizer::getInstance();

$assigns = array();
$type_block = $options[0];
$nb_assigns = $options[1];
$lenght_title = $options[2];

include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/pagelayout.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/slides.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/topic.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/assigns.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/wigets.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/globalnav.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/preheader.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/uitheme.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/fixskin.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/toplayout.php";
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/botlayout.php";

$pagelayoutHandler =& xoops_getModuleHandler("ixtframework_pagelayout", "IXTFrameWork");
$slidesHandler =& xoops_getModuleHandler("ixtframework_slides", "IXTFrameWork");
$topicHandler =& xoops_getModuleHandler("ixtframework_topic", "IXTFrameWork");
$assignsHandler =& xoops_getModuleHandler("ixtframework_assigns", "IXTFrameWork");
$wigetsHandler =& xoops_getModuleHandler("ixtframework_wigets", "IXTFrameWork");
$globalnavHandler =& xoops_getModuleHandler("ixtframework_globalnav", "IXTFrameWork");
$preheaderHandler =& xoops_getModuleHandler("ixtframework_preheader", "IXTFrameWork");
$uithemeHandler =& xoops_getModuleHandler("ixtframework_uitheme", "IXTFrameWork");
$fixskinHandler =& xoops_getModuleHandler("ixtframework_fixskin", "IXTFrameWork");
$toplayoutHandler =& xoops_getModuleHandler("ixtframework_toplayout", "IXTFrameWork");
$botlayoutHandler =& xoops_getModuleHandler("ixtframework_botlayout", "IXTFrameWork");

$criteria = new CriteriaCompo();
array_shift($options);
array_shift($options);
array_shift($options);

/*
if (!(count($options) == 1 && $options[0] == 0)) {
$criteria->add(new Criteria("assigns_topic", block_addCatSelect($options),"IN"));
}
*/
switch ($type_block) 
{
	// pour le bloc: assigns recents
	case "recent":
		$criteria->add(new Criteria("assigns_online", 1));
		$criteria->setSort("assigns_date_created");
		$criteria->setOrder("DESC");
	break;
	// pour le bloc: assigns du jour
	case "day":	
		$criteria->add(new Criteria("assigns_online", 1));
		$criteria->add(new Criteria("assigns_date_created", strtotime(date("Y/m/d")), ">="));
		$criteria->add(new Criteria("assigns_date_created", strtotime(date("Y/m/d"))+86400, "<="));
		$criteria->setSort("assigns_date_created");
		$criteria->setOrder("ASC");
	break;
	// pour le bloc: assigns aléatoires
	case "random":
		$criteria->add(new Criteria("assigns_online", 1));
		$criteria->setSort("RAND()");
	break;
}


$criteria->setLimit($nb_assigns);
$assigns_arr = $assignsHandler->getall($criteria);
	foreach (array_keys($assigns_arr) as $i) 
	{
		$assigns[$i]["assigns_id"] = $assigns_arr[$i]->getVar("assigns_id");
			$assigns[$i]["assigns_name"] = $assigns_arr[$i]->getVar("assigns_name");

$assigns[$i]["assigns_scrolblocks"] = explode(',',$assigns_arr[$i]->getVar("assigns_scrolblocks"));
			
$verif_assigns_jsenable = ( $assigns_arr[$i]->getVar("assigns_jsenable") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_jsenable"] = $verif_assigns_jsenable;

$globalnav =& $globalnavHandler->get($assigns_arr[$i]->getVar("assigns_globalnav"));
$title_globalnav = $globalnav->getVar("globalnav_name");	
$assigns[$i]["assigns_globalnav"] = $title_globalnav;

$verif_assigns_widecontent = ( $assigns_arr[$i]->getVar("assigns_widecontent") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_widecontent"] = $verif_assigns_widecontent;

$preheader =& $preheaderHandler->get($assigns_arr[$i]->getVar("assigns_preheader"));
$title_preheader = $preheader->getVar("preheader_name");	
$assigns[$i]["assigns_preheader"] = $title_preheader;
			
$verif_assigns_extheader = ( $assigns_arr[$i]->getVar("assigns_extheader") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_extheader"] = $verif_assigns_extheader;

$verif_assigns_headerrss = ( $assigns_arr[$i]->getVar("assigns_headerrss") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_headerrss"] = $verif_assigns_headerrss;

$slides =& $slidesHandler->get($assigns_arr[$i]->getVar("assigns_slides"));
$title_slides = $slides->getVar("slides_name");	
$assigns[$i]["assigns_slides"] = $title_slides;

$pagelayout =& $pagelayoutHandler->get($assigns_arr[$i]->getVar("assigns_layout"));
$title_pagelayout = $pagelayout->getVar("pagelayout_name");	
$assigns[$i]["assigns_layout"] = $title_pagelayout;
			
$assigns[$i]["assigns_w0"] = $assigns_arr[$i]->getVar("assigns_w0")."%";
$assigns[$i]["assigns_w1"] = $assigns_arr[$i]->getVar("assigns_w1")."%";
$assigns[$i]["assigns_w2"] = $assigns_arr[$i]->getVar("assigns_w2")."%";
$assigns[$i]["assigns_logos"] = "/uploads/ixtframework/assigns/assigns_logos/".$assigns_arr[$i]->getVar("assigns_logos");
$assigns[$i]["assigns_logow"] = $assigns_arr[$i]->getVar("assigns_logow")."px";
$assigns[$i]["assigns_logoh"] = $assigns_arr[$i]->getVar("assigns_logoh")."px";

$verif_assigns_ctrl0 = ( $assigns_arr[$i]->getVar("assigns_ctrl0") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_ctrl0"] = $verif_assigns_ctrl0;

$verif_assigns_ctrl1 = ( $assigns_arr[$i]->getVar("assigns_ctrl1") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_ctrl1"] = $verif_assigns_ctrl1;

$verif_assigns_ctrl2 = ( $assigns_arr[$i]->getVar("assigns_ctrl2") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_ctrl2"] = $verif_assigns_ctrl2;

$verif_assigns_extfooter = ( $assigns_arr[$i]->getVar("assigns_extfooter") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_extfooter"] = $verif_assigns_extfooter;

$assigns[$i]["assigns_ehblock"] = $assigns_arr[$i]->getVar("assigns_ehblock");
$assigns[$i]["assigns_efblocks0"] = explode(',',$assigns_arr[$i]->getVar("assigns_efblocks0"));
$assigns[$i]["assigns_efblocks1"] = explode(',',$assigns_arr[$i]->getVar("assigns_efblocks1"));
$assigns[$i]["assigns_efblocks2"] = explode(',',$assigns_arr[$i]->getVar("assigns_efblocks2"));
$assigns[$i]["assigns_efblocks3"] = explode(',',$assigns_arr[$i]->getVar("assigns_efblocks3"));
$assigns[$i]["assigns_wblocks1"] = explode(',',$assigns_arr[$i]->getVar("assigns_wblocks1"));
$assigns[$i]["assigns_wblocks2"] = explode(',',$assigns_arr[$i]->getVar("assigns_wblocks2"));

$verif_assigns_footerrss = ( $assigns_arr[$i]->getVar("assigns_footerrss") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_footerrss"] = $verif_assigns_footerrss;

$uitheme =& $uithemeHandler->get($assigns_arr[$i]->getVar("assigns_uitheme"));
$title_uitheme = $uitheme->getVar("uitheme_name");	
$assigns[$i]["assigns_uitheme"] = $title_uitheme;
			
$verif_assigns_multiskin = ( $assigns_arr[$i]->getVar("assigns_multiskin") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_multiskin"] = $verif_assigns_multiskin;

$fixskin =& $fixskinHandler->get($assigns_arr[$i]->getVar("assigns_fixskin"));
$title_fixskin = $fixskin->getVar("fixskin_name");	
$assigns[$i]["assigns_fixskin"] = $title_fixskin;
			
$verif_assigns_blconcat = ( $assigns_arr[$i]->getVar("assigns_blconcat") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_blconcat"] = $verif_assigns_blconcat;

$verif_assigns_sb1style = ( $assigns_arr[$i]->getVar("assigns_sb1style") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_sb1style"] = $verif_assigns_sb1style;

$verif_assigns_sb2style = ( $assigns_arr[$i]->getVar("assigns_sb2style") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_sb2style"] = $verif_assigns_sb2style;

$verif_assigns_eftstyle = ( $assigns_arr[$i]->getVar("assigns_eftstyle") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_eftstyle"] = $verif_assigns_eftstyle;

$verif_assigns_sysbstyle = ( $assigns_arr[$i]->getVar("assigns_sysbstyle") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_sysbstyle"] = $verif_assigns_sysbstyle;

$verif_assigns_wide1style = ( $assigns_arr[$i]->getVar("assigns_wide1style") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_wide1style"] = $verif_assigns_wide1style;

$verif_assigns_wide2style = ( $assigns_arr[$i]->getVar("assigns_wide2style") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_wide2style"] = $verif_assigns_wide2style;

$verif_assigns_rtl = ( $assigns_arr[$i]->getVar("assigns_rtl") == 1 ) ? "yes" : "no";
$assigns[$i]["assigns_rtl"] = $verif_assigns_rtl;

$toplayout =& $toplayoutHandler->get($assigns_arr[$i]->getVar("assigns_content_top_order"));
$title_toplayout = $toplayout->getVar("toplayout_name");	
$assigns[$i]["assigns_content_top_order"] = $title_toplayout;

$botlayout =& $botlayoutHandler->get($assigns_arr[$i]->getVar("assigns_content_bottom_order"));
$title_botlayout = $botlayout->getVar("botlayout_name");	
$assigns[$i]["assigns_content_bottom_order"] = $title_botlayout;
			
			$assigns[$i]["assigns_submitter"] = $assigns_arr[$i]->getVar("assigns_submitter");
			$assigns[$i]["assigns_date_created"] = $assigns_arr[$i]->getVar("assigns_date_created");
			$assigns[$i]["assigns_online"] = $assigns_arr[$i]->getVar("assigns_online");
		
	}
return $assigns;
}

function b_ixtframework_assigns_edit($options) {
	include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/topic.php";
	
	$topicHandler =& xoops_getModuleHandler("IXTFrameWork_topic", "IXTFrameWork");
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