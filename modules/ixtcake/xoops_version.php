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
 
 $modversion = array();
	$modversion["name"] = _MI_IXTCAKE_NAME;
	$modversion["version"] = 1.06;
	$modversion["description"] = _MI_IXTCAKE_DESC;
	$modversion["author"] = "IXThemes Project";
	$modversion["author_website_url"] = "http://ixthemes.org";
	$modversion["author_website_name"] = "IXThemes Project";
	$modversion["credits"] = "algalochkin";
	$modversion["license"] = "GPL 3.0";
	$modversion["release_info"] = "Release";
	$modversion["release_file"] = "none";
	$modversion["manual"] = "Manual";
	$modversion["manual_file"] = "none";
	$modversion["image"] = "images/ixtcake_slogo.png";
	$modversion["dirname"] = "ixtcake";

	//rmcommon support
 $modversion['icon16'] = "images/icons/icon16.png";
 $modversion['icon24'] = 'images/icons/icon24.png';
 $modversion['icon32'] = 'images/icons/icon32.png';
 $modversion['icon48'] = 'images/icons/icon48.png';

	// About
	$modversion["demo_site_url"] = "http://xoops250demo.ixthemes.org";
	$modversion["demo_site_name"] = "IXThemes Demo";
	$modversion["module_website_url"] = "http://ixthemes.com";
	$modversion["module_website_name"] = "IXThemes Modules";
	$modversion["release"] = "2010/12/20";
	$modversion["module_status"] = "final";
	
	// Admin
	$modversion["hasAdmin"] = 1;
	
	$modversion["adminindex"] = "admin/index.php";
	$modversion["adminmenu"] = "admin/menu.php";
	
	// Mysql
	$modversion["sqlfile"]["mysql"] = "sql/mysql.sql";

	// Tables
	$modversion["tables"][0] = "ixtcake_apptestgroups";
	$modversion["tables"][1] = "ixtcake_coretestgroups";
	$modversion["tables"][2] = "ixtcake_apptestcases";
	$modversion["tables"][3] = "ixtcake_coretestcases";
	
	//Addon tables for testing
	$i = 4;
	$modversion["tables"][$i] = "ixtcake_articles";
	$i++;
	$modversion["tables"][$i] = "ixtcake_another_i18n";
	$i++;
	$modversion["tables"][$i] = "ixtcake_articles_tags";
	$i++;
	$modversion["tables"][$i] = "ixtcake_article_i18n";
	$i++;
	$modversion["tables"][$i] = "ixtcake_authors";
	$i++;
	$modversion["tables"][$i] = "ixtcake_auth_users";
	$i++;
	$modversion["tables"][$i] = "ixtcake_category_threads";
	$i++;
	$modversion["tables"][$i] = "ixtcake_comments";
	$i++;
	$modversion["tables"][$i] = "ixtcake_datatypes";
	$i++;
	$modversion["tables"][$i] = "ixtcake_i18n";
	$i++;
	$modversion["tables"][$i] = "ixtcake_i18n_translate_with_prefixes";
	$i++;
	$modversion["tables"][$i] = "ixtcake_posts";
	$i++;
	$modversion["tables"][$i] = "ixtcake_posts_tags";
	$i++;
	$modversion["tables"][$i] = "ixtcake_sessions";
	$i++;
	$modversion["tables"][$i] = "ixtcake_tags";
	$i++;
	$modversion["tables"][$i] = "ixtcake_test_plugin_articles";
	$i++;
	$modversion["tables"][$i] = "ixtcake_test_plugin_comments";
	$i++;
	$modversion["tables"][$i] = "ixtcake_translated_articles";
	$i++;
	$modversion["tables"][$i] = "ixtcake_translated_items";
	$i++;
	$modversion["tables"][$i] = "ixtcake_users";
	
	// Scripts to run upon installation or update
	$modversion["onInstall"] = "include/install.php";
	//$modversion["onUpdate"] = "include/update.php";
	
		// Menu
	$modversion["hasMain"] = 1;
// if ($GLOBALS['xoopsUser']) {
		$modversion['sub'][1]['name'] = 'All Tests';
		$modversion['sub'][1]['url'] = "app/webroot/test.php#header";
		$modversion['sub'][2]['name'] = 'App Test Groups';
		$modversion['sub'][2]['url'] = "app/webroot/test.php?show=groups&app=true#header";
		$modversion['sub'][3]['name'] = 'App Test Cases';
		$modversion['sub'][3]['url'] = "app/webroot/test.php?show=cases&app=true#header";
		$modversion['sub'][4]['name'] = 'Core Test Groups';
		$modversion['sub'][4]['url'] = "app/webroot/test.php?show=groups#header";
		$modversion['sub'][5]['name'] = 'Core Test Cases';
		$modversion['sub'][5]['url'] = "app/webroot/test.php?show=cases#header";
// }
	
	$i = 1;
	include_once XOOPS_ROOT_PATH . "/class/xoopslists.php";
	$modversion["config"][$i]["name"]        = "ixtcake_editor";
	$modversion["config"][$i]["title"]       = "_MI_IXTCAKE_EDITOR";
	$modversion["config"][$i]["description"] = "";
	$modversion["config"][$i]["formtype"]    = "select";
	$modversion["config"][$i]["valuetype"]   = "text";
	$modversion["config"][$i]["default"]     = "dhtmltextarea";
	$modversion["config"][$i]["options"]     = XoopsLists::getDirListAsArray(XOOPS_ROOT_PATH . "/class/xoopseditor");
	$modversion["config"][$i]["category"]    = "global";
	$i++;
	
	// Blocks
	$i = 1;
	$modversion["blocks"][$i]["file"] = "blocks_apptestgroups.php";
	$modversion["blocks"][$i]["name"] = _MI_IXTCAKE_APPTESTGROUPS_BLOCK_LIST;
	$modversion["blocks"][$i]["description"] = "";
	$modversion["blocks"][$i]["show_func"] = "b_ixtcake_apptestgroups";
	$modversion["blocks"][$i]["edit_func"] = "b_ixtcake_apptestgroups_edit";
	$modversion["blocks"][$i]["options"] = "list|25|25|0";
	$modversion["blocks"][$i]["template"] = "ixtcake_apptestgroups_block_list.html";
	$i++;
	$modversion["blocks"][$i]["file"] = "blocks_coretestgroups.php";
	$modversion["blocks"][$i]["name"] = _MI_IXTCAKE_CORETESTGROUPS_BLOCK_LIST;
	$modversion["blocks"][$i]["description"] = "";
	$modversion["blocks"][$i]["show_func"] = "b_ixtcake_coretestgroups";
	$modversion["blocks"][$i]["edit_func"] = "b_ixtcake_coretestgroups_edit";
	$modversion["blocks"][$i]["options"] = "list|25|25|0";
	$modversion["blocks"][$i]["template"] = "ixtcake_coretestgroups_block_list.html";
	$i++;
	$modversion["blocks"][$i]["file"] = "blocks_apptestcases.php";
	$modversion["blocks"][$i]["name"] = _MI_IXTCAKE_APPTESTCASES_BLOCK_LIST;
	$modversion["blocks"][$i]["description"] = "";
	$modversion["blocks"][$i]["show_func"] = "b_ixtcake_apptestcases";
	$modversion["blocks"][$i]["edit_func"] = "b_ixtcake_apptestcases_edit";
	$modversion["blocks"][$i]["options"] = "list|25|25|0";
	$modversion["blocks"][$i]["template"] = "ixtcake_apptestcases_block_list.html";
	$i++;
	$modversion["blocks"][$i]["file"] = "blocks_coretestcases.php";
	$modversion["blocks"][$i]["name"] = _MI_IXTCAKE_CORETESTCASES_BLOCK_LIST;
	$modversion["blocks"][$i]["description"] = "";
	$modversion["blocks"][$i]["show_func"] = "b_ixtcake_coretestcases";
	$modversion["blocks"][$i]["edit_func"] = "b_ixtcake_coretestcases_edit";
	$modversion["blocks"][$i]["options"] = "list|120|25|0";
	$modversion["blocks"][$i]["template"] = "ixtcake_coretestcases_block_list.html";

?>