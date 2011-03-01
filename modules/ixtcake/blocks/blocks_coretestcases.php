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
 	
include_once XOOPS_ROOT_PATH."/modules/ixtcake/include/functions.php";
	
function b_ixtcake_coretestcases($options) {
include_once XOOPS_ROOT_PATH."/modules/ixtcake/class/coretestcases.php";
$myts =& MyTextSanitizer::getInstance();

$coretestcases = array();
$type_block = $options[0];
$nb_coretestcases = $options[1];
$lenght_title = $options[2];

$coretestcasesHandler =& xoops_getModuleHandler("ixtcake_coretestcases", "ixtcake");
$criteria = new CriteriaCompo();
array_shift($options);
array_shift($options);
array_shift($options);

switch ($type_block) 
{
	case "list":
		$criteria->add(new Criteria("coretestcases_online", 1));
		$criteria->setSort("coretestcases_date_created");
		$criteria->setOrder("ASC");
	break;
}


$criteria->setLimit($nb_coretestcases);
if (class_exists("XoopsPersistableObjectHandler")) {
 $coretestcases_arr = $coretestcasesHandler->getAll($criteria);
} else {
 // algalochkin : this need for support icms1.2 ONLY
 $coretestcases_arr = $coretestcasesHandler->getObjects($criteria, false, true);
}

	foreach (array_keys($coretestcases_arr) as $i) 
	{
	 	$coretestcases[$i]["coretestcases_id"] = $coretestcases_arr[$i]->getVar("coretestcases_id");
		$coretestcases[$i]["coretestcases_name"] = $coretestcases_arr[$i]->getVar("coretestcases_name");
		$coretestcases[$i]["coretestcases_path"] = $coretestcases_arr[$i]->getVar("coretestcases_path");
		$coretestcases[$i]["coretestcases_submitter"] = $coretestcases_arr[$i]->getVar("coretestcases_submitter");
		$coretestcases[$i]["coretestcases_date_created"] = $coretestcases_arr[$i]->getVar("coretestcases_date_created");
		$coretestcases[$i]["coretestcases_online"] = $coretestcases_arr[$i]->getVar("coretestcases_online");
		
	}
return $coretestcases;
}

function b_ixtcake_coretestcases_edit($options) {
	$form = ""._MB_IXTCAKE_CORETESTCASES_DISPLAY."\n";
	$form .= "<input type=\"hidden\" name=\"options[0]\" value=\"".$options[0]."\" />";
	$form .= "<input name=\"options[1]\" size=\"5\" maxlength=\"255\" value=\"".$options[1]."\" type=\"text\" />&nbsp;<br />";
	$form .= ""._MB_IXTCAKE_CORETESTCASES_TITLELENGTH." : <input name=\"options[2]\" size=\"5\" maxlength=\"255\" value=\"".$options[2]."\" type=\"text\" /><br /><br />";
	array_shift($options);
	array_shift($options);
	array_shift($options);
	return $form;
}
	
?>