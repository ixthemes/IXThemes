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
 	
include_once XOOPS_ROOT_PATH."/modules/ixtcake/include/functions.php";
	
function b_ixtcake_coretestgroups($options) {
include_once XOOPS_ROOT_PATH."/modules/ixtcake/class/coretestgroups.php";
$myts =& MyTextSanitizer::getInstance();

$coretestgroups = array();
$type_block = $options[0];
$nb_coretestgroups = $options[1];
$lenght_title = $options[2];

$coretestgroupsHandler =& xoops_getModuleHandler("ixtcake_coretestgroups", "ixtcake");
$criteria = new CriteriaCompo();
array_shift($options);
array_shift($options);
array_shift($options);

switch ($type_block) 
{
	case "list":
		$criteria->add(new Criteria("coretestgroups_online", 1));
		$criteria->setSort("coretestgroups_date_created");
		$criteria->setOrder("ASC");
	break;
}


$criteria->setLimit($nb_coretestgroups);
$coretestgroups_arr = $coretestgroupsHandler->getall($criteria);
	foreach (array_keys($coretestgroups_arr) as $i) 
	{
	 	$coretestgroups[$i]["coretestgroups_id"] = $coretestgroups_arr[$i]->getVar("coretestgroups_id");
			$coretestgroups[$i]["coretestgroups_name"] = $coretestgroups_arr[$i]->getVar("coretestgroups_name");
			$coretestgroups[$i]["coretestgroups_path"] = $coretestgroups_arr[$i]->getVar("coretestgroups_path");
			$coretestgroups[$i]["coretestgroups_submitter"] = $coretestgroups_arr[$i]->getVar("coretestgroups_submitter");
			$coretestgroups[$i]["coretestgroups_date_created"] = $coretestgroups_arr[$i]->getVar("coretestgroups_date_created");
			$coretestgroups[$i]["coretestgroups_online"] = $coretestgroups_arr[$i]->getVar("coretestgroups_online");
		
	}
return $coretestgroups;
}

function b_ixtcake_coretestgroups_edit($options) {
	$form = ""._MB_IXTCAKE_CORETESTGROUPS_DISPLAY."\n";
	$form .= "<input type=\"hidden\" name=\"options[0]\" value=\"".$options[0]."\" />";
	$form .= "<input name=\"options[1]\" size=\"5\" maxlength=\"255\" value=\"".$options[1]."\" type=\"text\" />&nbsp;<br />";
	$form .= ""._MB_IXTCAKE_CORETESTGROUPS_TITLELENGTH." : <input name=\"options[2]\" size=\"5\" maxlength=\"255\" value=\"".$options[2]."\" type=\"text\" /><br /><br />";
	array_shift($options);
	array_shift($options);
	array_shift($options);
	return $form;
}
	
?>