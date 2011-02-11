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
 * Version : 1.03:
 * ****************************************************************************
 */
 
	
	$modversion["name"] = "ixtframework";
	$modversion["version"] = 1.03;
	$modversion["description"] = "Engine for management the XOOPS Themes by IXThemes. IXThemes is an implementation of innovative methods in the development of qualitative universality modules and themes for CMS based on the XOOPS.";
	$modversion["author"] = "IXThemes Project";
	$modversion["author_website_url"] = "http://ixthemes.org";
	$modversion["author_website_name"] = "IXThemes Project";
	$modversion["credits"] = "algalochkin, ixthemes, ixtdev, etc.";
	$modversion["license"] = "GPL 2.0";
	$modversion["release_info"] = "Release";
	$modversion["release_file"] = "none";
	$modversion["manual"] = "Manual";
	$modversion["manual_file"] = "none";
	$modversion["image"] = "images/ixtrfamework_slogo.png";
	$modversion["dirname"] = "ixtframework";
	
	//rmcommon support
 $modversion['icon16'] = "images/icons/icon16.png";
 $modversion['icon24'] = 'images/icons/icon24.png';
 $modversion['icon32'] = 'images/icons/icon32.png';
 $modversion['icon48'] = 'images/icons/icon48.png';

	//about
	$modversion["demo_site_url"] = "http://xoops245demo.ixthemes.org";
	$modversion["demo_site_name"] = "IXThemes Demo";
	$modversion["module_website_url"] = "http://ixthemes.com";
	$modversion["module_website_name"] = "IXThemes Modules";
	$modversion["release"] = "10-10-2010";
	$modversion["module_status"] = "Final";
	
	// Admin things
	$modversion["hasAdmin"] = 1;
	
	$modversion["adminindex"] = "admin/index.php";
	$modversion["adminmenu"] = "admin/menu.php";
	
	
	// Mysql file
	$modversion["sqlfile"]["mysql"] = "sql/mysql.sql";

	// Tables
	$modversion["tables"][0] = "ixtframework_pagelayout";
	$modversion["tables"][1] = "ixtframework_slides";
	$modversion["tables"][2] = "ixtframework_topic";
	$modversion["tables"][3] = "ixtframework_assigns";
	$modversion["tables"][4] = "ixtframework_widgets";
	$modversion["tables"][5] = "ixtframework_globalnav";
	$modversion["tables"][6] = "ixtframework_preheader";
	$modversion["tables"][7] = "ixtframework_uitheme";
	$modversion["tables"][8] = "ixtframework_fixskin";
	$modversion["tables"][9] = "ixtframework_toplayout";
	$modversion["tables"][10] = "ixtframework_botlayout";
	$modversion["tables"][11] = "ixtframework_themes";
	
	
	// Scripts to run upon installation or update
	$modversion["onInstall"] = "include/install.php";
	//$modversion["onUpdate"] = "include/update.php";
	$i = 1;
	include_once XOOPS_ROOT_PATH . "/class/xoopslists.php";
	$modversion["config"][$i]["name"]        = "ixtframework_editor";
	$modversion["config"][$i]["title"]       = "_MI_IXTFRAMEWORK_EDITOR";
	$modversion["config"][$i]["description"] = "";
	$modversion["config"][$i]["formtype"]    = "select";
	$modversion["config"][$i]["valuetype"]   = "text";
	$modversion["config"][$i]["default"]     = "dhtmltextarea";
	$modversion["config"][$i]["options"]     = XoopsLists::getDirListAsArray(XOOPS_ROOT_PATH . "/class/xoopseditor");
	$modversion["config"][$i]["category"]    = "global";
	$i++;
	
	//Uploads : size topic_img
	/*
	$modversion["config"][$i]["name"] = "topic_img_size";
	$modversion["config"][$i]["title"] = "_MI_IXTFRAMEWORK_TOPIC_IMG_SIZE";
	$modversion["config"][$i]["description"] = "";
	$modversion["config"][$i]["formtype"] = "textbox";
	$modversion["config"][$i]["valuetype"] = "int";
	$modversion["config"][$i]["default"] = "10485760";
	$i++;
	*/
	//Uploads : mimetypes topic_img
	/*
	$modversion["config"][$i]["name"] = "topic_img_mimetypes";
	$modversion["config"][$i]["title"] = "_MI_IXTFRAMEWORK_TOPIC_IMG_MIMETYPES";
	$modversion["config"][$i]["description"] = "";
	$modversion["config"][$i]["formtype"] = "select_multi";
	$modversion["config"][$i]["valuetype"] = "array";
	$modversion["config"][$i]["default"] = array("image/gif", "image/jpeg", "image/png");
	$modversion["config"][$i]["options"] = array(			
										"bmp" => "image/bmp",
										"gif" => "image/gif",
										"jpeg" => "image/pjpeg",
										"jpeg" => "image/jpeg",
										"jpg" => "image/jpeg",
										"jpe" => "image/jpeg",
										"png" => "image/png");
	$i++;
	*/				
	//Uploads : size assigns_logos
	$modversion["config"][$i]["name"] = "assigns_logos_size";
	$modversion["config"][$i]["title"] = "_MI_IXTFRAMEWORK_ASSIGNS_LOGOS_SIZE";
	$modversion["config"][$i]["description"] = "";
	$modversion["config"][$i]["formtype"] = "textbox";
	$modversion["config"][$i]["valuetype"] = "int";
	$modversion["config"][$i]["default"] = "10485760";
	$i++;
	
	//Uploads : mimetypes assigns_logos
	$modversion["config"][$i]["name"] = "assigns_logos_mimetypes";
	$modversion["config"][$i]["title"] = "_MI_IXTFRAMEWORK_ASSIGNS_LOGOS_MIMETYPES";
	$modversion["config"][$i]["description"] = "";
	$modversion["config"][$i]["formtype"] = "select_multi";
	$modversion["config"][$i]["valuetype"] = "array";
	$modversion["config"][$i]["default"] = array("image/gif", "image/jpeg", "image/png");
	$modversion["config"][$i]["options"] = array(			
										"bmp" => "image/bmp",
										"gif" => "image/gif",
										"jpeg" => "image/pjpeg",
										"jpeg" => "image/jpeg",
										"jpg" => "image/jpeg",
										"jpe" => "image/jpeg",
										"png" => "image/png");
	$i++;
					
	//Uploads : size themes_screenshot
	$modversion["config"][$i]["name"] = "themes_screenshot_size";
	$modversion["config"][$i]["title"] = "_MI_IXTFRAMEWORK_THEMES_SCREENSHOT_SIZE";
	$modversion["config"][$i]["description"] = "";
	$modversion["config"][$i]["formtype"] = "textbox";
	$modversion["config"][$i]["valuetype"] = "int";
	$modversion["config"][$i]["default"] = "10485760";
	$i++;
	
	//Uploads : mimetypes themes_screenshot
	$modversion["config"][$i]["name"] = "themes_screenshot_mimetypes";
	$modversion["config"][$i]["title"] = "_MI_IXTFRAMEWORK_THEMES_SCREENSHOT_MIMETYPES";
	$modversion["config"][$i]["description"] = "";
	$modversion["config"][$i]["formtype"] = "select_multi";
	$modversion["config"][$i]["valuetype"] = "array";
	$modversion["config"][$i]["default"] = array("image/gif", "image/jpeg", "image/png");
	$modversion["config"][$i]["options"] = array(			
										"bmp" => "image/bmp",
										"gif" => "image/gif",
										"jpeg" => "image/pjpeg",
										"jpeg" => "image/jpeg",
										"jpg" => "image/jpeg",
										"jpe" => "image/jpeg",
										"png" => "image/png");
	$i++;
					
	//Blocs
	/*
	$i = 1;
	$modversion["blocks"][$i]["file"] = "blocks_assigns.php";
	$modversion["blocks"][$i]["name"] = _MI_IXTFRAMEWORK_ASSIGNS_BLOCK_RECENT;
	$modversion["blocks"][$i]["description"] = "";
	$modversion["blocks"][$i]["show_func"] = "b_ixtframework_assigns";
	$modversion["blocks"][$i]["edit_func"] = "b_ixtframework_assigns_edit";
	$modversion["blocks"][$i]["options"] = "recent|5|25|0";
	$modversion["blocks"][$i]["template"] = "ixtframework_assigns_block_recent.html";
	$i++;
	$modversion["blocks"][$i]["file"] = "blocks_assigns.php";
	$modversion["blocks"][$i]["name"] = _MI_IXTFRAMEWORK_ASSIGNS_BLOCK_DAY;
	$modversion["blocks"][$i]["description"] = "";
	$modversion["blocks"][$i]["show_func"] = "b_ixtframework_assigns";
	$modversion["blocks"][$i]["edit_func"] = "b_ixtframework_assigns_edit";
	$modversion["blocks"][$i]["options"] = "day|5|25|0";
	$modversion["blocks"][$i]["template"] = "ixtframework_assigns_block_day.html";
	$i++;
	$modversion["blocks"][$i]["file"] = "blocks_assigns.php";
	$modversion["blocks"][$i]["name"] = _MI_IXTFRAMEWORK_ASSIGNS_BLOCK_RANDOM;
	$modversion["blocks"][$i]["description"] = "";
	$modversion["blocks"][$i]["show_func"] = "b_ixtframework_assigns";
	$modversion["blocks"][$i]["edit_func"] = "b_ixtframework_assigns_edit";
	$modversion["blocks"][$i]["options"] = "random|5|25|0";
	$modversion["blocks"][$i]["template"] = "ixtframework_assigns_block_random.html";
	$i++;		
	*/
?>