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
	
function b_ixtframework_wigets($options) {
include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/wigets.php";
$myts =& MyTextSanitizer::getInstance();

$wigets = array();
$type_block = $options[0];
$nb_wigets = $options[1];
$lenght_title = $options[2];

$wigetsHandler =& xoops_getModuleHandler("ixtframework_wigets", "IXTFrameWork");
$criteria = new CriteriaCompo();
array_shift($options);
array_shift($options);
array_shift($options);
if (!(count($options) == 1 && $options[0] == 0)) {
$criteria->add(new Criteria("wigets_topic", block_addCatSelect($options),"IN"));
}

switch ($type_block) 
{
	// pour le bloc: wigets recents
	case "recent":
		$criteria->add(new Criteria("wigets_online", 1));
		$criteria->setSort("wigets_date_created");
		$criteria->setOrder("DESC");
	break;
	// pour le bloc: wigets du jour
	case "day":	
		$criteria->add(new Criteria("wigets_online", 1));
		$criteria->add(new Criteria("wigets_date_created", strtotime(date("Y/m/d")), ">="));
		$criteria->add(new Criteria("wigets_date_created", strtotime(date("Y/m/d"))+86400, "<="));
		$criteria->setSort("wigets_date_created");
		$criteria->setOrder("ASC");
	break;
	// pour le bloc: wigets aléatoires
	case "random":
		$criteria->add(new Criteria("wigets_online", 1));
		$criteria->setSort("RAND()");
	break;
}


$criteria->setLimit($nb_wigets);
$wigets_arr = $wigetsHandler->getall($criteria);
	foreach (array_keys($wigets_arr) as $i) 
	{
		$wigets[$i]["wigets_id"] = $wigets_arr[$i]->getVar("wigets_id");
			$wigets[$i]["wigets_name"] = $wigets_arr[$i]->getVar("wigets_name");
			$wigets[$i]["wigets_title"] = $wigets_arr[$i]->getVar("wigets_title");
			$wigets[$i]["wigets_content"] = $wigets_arr[$i]->getVar("wigets_content");
			$wigets[$i]["wigets_submitter"] = $wigets_arr[$i]->getVar("wigets_submitter");
			$wigets[$i]["wigets_date_created"] = $wigets_arr[$i]->getVar("wigets_date_created");
			$wigets[$i]["wigets_online"] = $wigets_arr[$i]->getVar("wigets_online");
		
	}
return $wigets;
}

function b_ixtframework_wigets_edit($options) {
	include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/topic.php";
	
	$topicHandler =& xoops_getModuleHandler("IXTFrameWork_topic", "IXTFrameWork");
	$criteria = new CriteriaCompo();
	$criteria->setSort("topic_title");
	$criteria->setOrder("ASC");
	$topic_arr = $topicHandler->getall($criteria);
	
	$form = ""._MB_IXTFRAMEWORK_WIGETS_DISPLAY."\n";
	$form .= "<input type=\"hidden\" name=\"options[0]\" value=\"".$options[0]."\" />";
	$form .= "<input name=\"options[1]\" size=\"5\" maxlength=\"255\" value=\"".$options[1]."\" type=\"text\" />&nbsp;<br />";
	$form .= ""._MB_IXTFRAMEWORK_WIGETS_TITLELENGTH." : <input name=\"options[2]\" size=\"5\" maxlength=\"255\" value=\"".$options[2]."\" type=\"text\" /><br /><br />";
	array_shift($options);
	array_shift($options);
	array_shift($options);
	$form .= ""._MB_IXTFRAMEWORK_WIGETS_CATTODISPLAY."<br /><select name=\"options[]\" multiple=\"multiple\" size=\"5\">";
	$form .= "<option value=\"0\" " . (array_search(0, $options) === false ? "" : "selected=\"selected\"") . ">" ._MB_IXTFRAMEWORK_WIGETS_ALLCAT . "</option>";
	foreach (array_keys($topic_arr) as $i) {
		$form .= "<option value=\"" . $topic_arr[$i]->getVar("topic_id") . "\" " . (array_search($topic_arr[$i]->getVar("topic_id"), $options) === false ? "" : "selected=\"selected\"") . ">".$topic_arr[$i]->getVar("topic_title")."</option>";
	}
	$form .= "</select>";

	return $form;
}
	
?>