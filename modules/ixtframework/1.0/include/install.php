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
 
$indexFile = XOOPS_ROOT_PATH."/modules/IXTFrameWork/include/index.html";
$blankFile = XOOPS_ROOT_PATH."/modules/IXTFrameWork/images/deco/blank.gif";
$logoFile = XOOPS_ROOT_PATH."/modules/IXTFrameWork/images/logo.png";

//Creation du dossier "uploads" pour le module à la racine du site
$module_uploads = XOOPS_ROOT_PATH."/uploads/IXTFrameWork";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/index.html");

//Creation du fichier pagelayout dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/IXTFrameWork/pagelayout";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/pagelayout/index.html");
				
//Creation du fichier slides dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/IXTFrameWork/slides";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/slides/index.html");
				
//Creation du fichier topic dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/IXTFrameWork/topic";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/topic/index.html");
				
//Creation du dossier "uploads" pour le module à la racine du site
$module_uploads = XOOPS_ROOT_PATH."/uploads/IXTFrameWork/topic/topic_img";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/topic/topic_img/index.html");
copy($blankFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/topic/topic_img/blank.gif");

//Creation du fichier assigns dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/IXTFrameWork/assigns";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/assigns/index.html");
				
//Creation du dossier "uploads" pour le module à la racine du site
$module_uploads = XOOPS_ROOT_PATH."/uploads/IXTFrameWork/assigns/assigns_logos";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/assigns/assigns_logos/index.html");
copy($blankFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/assigns/assigns_logos/blank.gif");
copy($logoFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/assigns/assigns_logos/logo.png");

//Creation du fichier wigets dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/IXTFrameWork/wigets";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/wigets/index.html");
				
//Creation du fichier globalnav dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/IXTFrameWork/globalnav";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/globalnav/index.html");
				
//Creation du fichier preheader dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/IXTFrameWork/preheader";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/preheader/index.html");
				
//Creation du fichier uitheme dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/IXTFrameWork/uitheme";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/uitheme/index.html");
				
//Creation du fichier fixskin dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/IXTFrameWork/fixskin";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/fixskin/index.html");
				
//Creation du fichier toplayout dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/IXTFrameWork/toplayout";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/toplayout/index.html");
				
//Creation du fichier botlayout dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/IXTFrameWork/botlayout";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/IXTFrameWork/botlayout/index.html");
				
?>