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
	
function b_ixtcake_apptestgroups($options) {
include_once XOOPS_ROOT_PATH."/modules/ixtcake/class/apptestgroups.php";
$myts =& MyTextSanitizer::getInstance();

$apptestgroups = array();
$type_block = $options[0];
$nb_apptestgroups = $options[1];
$lenght_title = $options[2];

$apptestgroupsHandler =& xoops_getModuleHandler("ixtcake_apptestgroups", "ixtcake");
$criteria = new CriteriaCompo();
array_shift($options);
array_shift($options);
array_shift($options);

switch ($type_block) 
{
	case "list":
		$criteria->add(new Criteria("apptestgroups_online", 1));
		$criteria->setSort("apptestgroups_date_created");
		$criteria->setOrder("ASC");
	break;
}


$criteria->setLimit($nb_apptestgroups);
if (class_exists("XoopsPersistableObjectHandler")) {
 $apptestgroups_arr = $apptestgroupsHandler->getAll($criteria);
} else {
 // algalochkin : this need for support icms1.2 ONLY
 $apptestgroups_arr = $apptestgroupsHandler->getObjects($criteria, false, true);
}

	foreach (array_keys($apptestgroups_arr) as $i) 
	{
	 	$apptestgroups[$i]["apptestgroups_id"] = $apptestgroups_arr[$i]->getVar("apptestgroups_id");
		$apptestgroups[$i]["apptestgroups_name"] = $apptestgroups_arr[$i]->getVar("apptestgroups_name");
		$apptestgroups[$i]["apptestgroups_path"] = $apptestgroups_arr[$i]->getVar("apptestgroups_path");
		$apptestgroups[$i]["apptestgroups_submitter"] = $apptestgroups_arr[$i]->getVar("apptestgroups_submitter");
		$apptestgroups[$i]["apptestgroups_date_created"] = $apptestgroups_arr[$i]->getVar("apptestgroups_date_created");
		$apptestgroups[$i]["apptestgroups_online"] = $apptestgroups_arr[$i]->getVar("apptestgroups_online");
		
	}
return $apptestgroups;
}

function b_ixtcake_apptestgroups_edit($options) {
	$form = ""._MB_IXTCAKE_APPTESTGROUPS_DISPLAY."\n";
	$form .= "<input type=\"hidden\" name=\"options[0]\" value=\"".$options[0]."\" />";
	$form .= "<input name=\"options[1]\" size=\"5\" maxlength=\"255\" value=\"".$options[1]."\" type=\"text\" />&nbsp;<br />";
	$form .= ""._MB_IXTCAKE_APPTESTGROUPS_TITLELENGTH." : <input name=\"options[2]\" size=\"5\" maxlength=\"255\" value=\"".$options[2]."\" type=\"text\" /><br /><br />";
	array_shift($options);
	array_shift($options);
	array_shift($options);
	return $form;
}
	
?>