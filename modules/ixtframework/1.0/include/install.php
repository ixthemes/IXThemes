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
 * Version : 1.04:
 * ****************************************************************************
 */
 
$indexFile = XOOPS_ROOT_PATH."/modules/ixtframework/include/index.html";
$blankFile = XOOPS_ROOT_PATH."/modules/ixtframework/images/deco/blank.gif";
$logoFile = XOOPS_ROOT_PATH."/modules/ixtframework/images/samples/logo.png";
$biglogoFile = XOOPS_ROOT_PATH."/modules/ixtframework/images/samples/logo_490.png";

$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/index.html");

$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework/pagelayout";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/pagelayout/index.html");
				
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework/slides";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/slides/index.html");
				
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework/topic";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/topic/index.html");
				
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework/topic/topic_img";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/topic/topic_img/index.html");
copy($blankFile, XOOPS_ROOT_PATH."/uploads/ixtframework/topic/topic_img/blank.gif");
//copy($logoFile, XOOPS_ROOT_PATH."/uploads/ixtframework/topic/topic_img/logo.png");

$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework/assigns";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/assigns/index.html");
				
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework/assigns/assigns_logos";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/assigns/assigns_logos/index.html");
copy($blankFile, XOOPS_ROOT_PATH."/uploads/ixtframework/assigns/assigns_logos/blank.gif");
copy($logoFile, XOOPS_ROOT_PATH."/uploads/ixtframework/assigns/assigns_logos/logo.png");
copy($biglogoFile, XOOPS_ROOT_PATH."/uploads/ixtframework/assigns/assigns_logos/logo_490.png");

$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework/widgets";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/widgets/index.html");
				
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework/globalnav";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/globalnav/index.html");
				
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework/preheader";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/preheader/index.html");
				
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework/uitheme";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/uitheme/index.html");
				
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework/fixskin";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/fixskin/index.html");
				
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework/toplayout";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/toplayout/index.html");
				
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework/botlayout";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/botlayout/index.html");
				
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework/themes";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/themes/index.html");
				
$module_uploads = XOOPS_ROOT_PATH."/uploads/ixtframework/themes/themes_screenshot";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/ixtframework/themes/themes_screenshot/index.html");
copy($blankFile, XOOPS_ROOT_PATH."/uploads/ixtframework/themes/themes_screenshot/blank.gif");
//copy($logoFile, XOOPS_ROOT_PATH."/uploads/ixtframework/themes/themes_screenshot/logo.png");

?>