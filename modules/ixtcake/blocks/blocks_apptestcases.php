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
	
function b_ixtcake_apptestcases($options) {
include_once XOOPS_ROOT_PATH."/modules/ixtcake/class/apptestcases.php";
$myts =& MyTextSanitizer::getInstance();

$apptestcases = array();
$type_block = $options[0];
$nb_apptestcases = $options[1];
$lenght_title = $options[2];

$apptestcasesHandler =& xoops_getModuleHandler("ixtcake_apptestcases", "ixtcake");
$criteria = new CriteriaCompo();
array_shift($options);
array_shift($options);
array_shift($options);

switch ($type_block) 
{
	case "list":
		$criteria->add(new Criteria("apptestcases_online", 1));
		$criteria->setSort("apptestcases_date_created");
		$criteria->setOrder("ASC");
	break;
}


$criteria->setLimit($nb_apptestcases);
if (class_exists("XoopsPersistableObjectHandler")) {
 $apptestcases_arr = $apptestcasesHandler->getAll($criteria);
} else {
 // algalochkin : this need for support icms1.2 ONLY
 $apptestcases_arr = $apptestcasesHandler->getObjects($criteria, false, true);
}

	foreach (array_keys($apptestcases_arr) as $i) 
	{
	 	$apptestcases[$i]["apptestcases_id"] = $apptestcases_arr[$i]->getVar("apptestcases_id");
		$apptestcases[$i]["apptestcases_name"] = $apptestcases_arr[$i]->getVar("apptestcases_name");
		$apptestcases[$i]["apptestcases_path"] = $apptestcases_arr[$i]->getVar("apptestcases_path");
		$apptestcases[$i]["apptestcases_submitter"] = $apptestcases_arr[$i]->getVar("apptestcases_submitter");
		$apptestcases[$i]["apptestcases_date_created"] = $apptestcases_arr[$i]->getVar("apptestcases_date_created");
		$apptestcases[$i]["apptestcases_online"] = $apptestcases_arr[$i]->getVar("apptestcases_online");
		
	}
return $apptestcases;
}

function b_ixtcake_apptestcases_edit($options) {
	$form = ""._MB_IXTCAKE_APPTESTCASES_DISPLAY."\n";
	$form .= "<input type=\"hidden\" name=\"options[0]\" value=\"".$options[0]."\" />";
	$form .= "<input name=\"options[1]\" size=\"5\" maxlength=\"255\" value=\"".$options[1]."\" type=\"text\" />&nbsp;<br />";
	$form .= ""._MB_IXTCAKE_APPTESTCASES_TITLELENGTH." : <input name=\"options[2]\" size=\"5\" maxlength=\"255\" value=\"".$options[2]."\" type=\"text\" /><br /><br />";
	array_shift($options);
	array_shift($options);
	array_shift($options);
	return $form;
}
	
?>