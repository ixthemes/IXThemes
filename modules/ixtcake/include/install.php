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
 
$indexFile = XOOPS_ROOT_PATH."/modules/ixtcake/include/index.html";
$blankFile = XOOPS_ROOT_PATH."/modules/ixtcake/images/deco/blank.gif";
$logoFile = XOOPS_ROOT_PATH."/modules/ixtcake/images/logo.png";

//Creation du dossier "uploads" pour le module à la racine du site
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtcake";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtcake/index.html");

//Creation du fichier apptestgroups dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtcake/apptestgroups";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtcake/apptestgroups/index.html");
				
//Creation du fichier coretestgroups dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtcake/coretestgroups";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtcake/coretestgroups/index.html");
				
//Creation du fichier apptestcases dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtcake/apptestcases";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtcake/apptestcases/index.html");
				
//Creation du fichier coretestcases dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtcake/coretestcases";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtcake/coretestcases/index.html");
				
?>