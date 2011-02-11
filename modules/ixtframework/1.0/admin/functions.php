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

define('IXTPATH', XOOPS_ROOT_PATH.'/modules/ixtframework');
//define('IXTURL', XOOPS_URL.'/modules/ixtframework');

/**
* Checks if a theme is valid.
* If thame is valid then returns the prefix for functions names
* 
* @param string $theme
* @return bool|string
*/
function &ixt_is_valid($theme) {
	global $xoopsConfig;

 $object = false;
	if (is_file(XOOPS_THEME_PATH.'/'.$theme.'/config/theme.php')) {
		// release 5.x
		include_once XOOPS_THEME_PATH.'/'.$theme.'/config/theme.php';
		$ixttheme = preg_replace('/\s+/', '', strtolower($theme));
		$ixttheme = str_replace('-','',$ixttheme);
		$class ='IXTheme'.ucfirst($ixttheme);
		if (class_exists($class)) {
			$object = new $class();
  }
	} else {
		if (is_file(XOOPS_THEME_PATH.'/'.$theme.'/tpl/assigns.html')) {
//		if (is_file(XOOPS_THEME_PATH.'/'.$theme.'/xo-info.php')) {
			// releases 3.x, 4.x
   $object = true;
		}
	}
	return $object;
}

function values_decode(&$value, $key){
	$value = utf8_decode($value);
}

/**
* Redirect with a message
*/

function ixt_redirect($url, $time = 3, $message) {
	
	if (ixtframework_isrmcommon()) {
  redirectMsg($url, $message, $level=0);
	} else {
		redirect_header($url, $time, $message);
	}
	exit();
}

/**
* Gets the current theme config
*/
function ixt_get_current_config($element='', $edit = false){
//	$ret = array();
	$db = Database::getInstance();
	$sql = "SELECT * FROM ".$db->prefix("ixtframework_thconfig").($element != '' ? " WHERE element='$element'" : '');
	$result = $db->query($sql);
	while ($row = $db->fetchArray($result)){
		$ret[$row['name']] = $row['type']=='array' ? unserialize($row['value']) : $row['value'];
	}
	
	array_walk_recursive($ret, 'decode_entities');
	
	if ($edit){
		array_walk_recursive($ret, 'special_chars');
	}
	
	return $ret;
}

function decode_entities(&$value, $key){
	$value = html_entity_decode($value, ENT_QUOTES, 'UTF-8');
}

function special_chars(&$value, $key){
	$value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
* Insert configuration in db
* @param array Array of configurations
* @param string Element type: theme or plugin
*/
function ixt_insert_configs($configs, $element){
	
	if (empty($configs)) return;
	
	$db = Database::getInstance();
	
	$db->queryF("DELETE FROM ".$db->prefix("ixtframework_thconfig")." WHERE element='$element'");
	
	$sql = "INSERT INTO ".$db->prefix("ixtframework_thconfig")." (`name`,`value`,`type`,`element`) VALUES ('%s','%s','%s','$element')";
	foreach ($configs as $name => $value){
		$type = '';
		if (is_array($value)){
			$value = json_encode($value);
			$type = 'array';
		}
		
		$db->queryF(sprintf($sql, $name, $value, $type));
		
	}
	
}

/**
* Check if a plugin is installed
* When plugin is installed then this function returns an array with
* all plugin info. This array can be used to check version or another
* things.
* 
* @param string Plugin name
* @return bool|array
*/
function ixt_plugin_installed($plugin){
	
	if ($plugin=='') return false;
	
	$db = Database::getInstance();
	$sql = "SELECT COUNT(*) FROM ".$db->prefix("ixtheme_plugins")." WHERE dir='".MyTextSanitizer::addSlashes($plugin)."'";
	list($num) = $db->fetchRow($db->query($sql));
	
	if ($num<=0) return;
	
	$path = IXTPATH.'/plugins/'.$plugin;
	
	if (!is_file($path.'/ixthemes_plugin_'.$plugin.'.php')) return false;
	
	include_once $path.'/ixthemes_plugin_'.$plugin.'.php';
	$class = "IXThemes".ucfirst($plugin);
	if (!class_exists($class)) return false;
	
	$plugin = new $class();
	return $plugin->get_info();
	
}

/**
* Check if a modules is installed
* @param string Module dirname
* @return bool
*/
function ixt_module_installed($dir){
	if ($dir=='') return;
	
	$db = Database::getInstance();
	$sql = "SELECT COUNT(*) FROM ".$db->prefix("modules")." WHERE dirname='".MyTextSanitizer::addSlashes($dir)."'";
	list($num) = $db->fetchRow($db->query($sql));
	
	if ($num<=0) return false;
	
	return true;
	
}

function ixtframework_isrmcommon() {
	$isrmc = false;
	
	$module_handler =& xoops_gethandler('module');
	$installed_mods = $module_handler->getObjects();
	foreach ($installed_mods as $module) {if ($module->getVar('dirname') == 'rmcommon' && $module->getVar('isactive') == 1) {$rmisactive = 1;}}
	if (isset($rmisactive) && ($rmisactive)) {
		$isrmc = true;
	}
	
	return $isrmc;
}

function ixtframework_adminmenu ($currentoption = 0, $breadcrumb = "") 
{   
	global $xoopsModule, $xoopsConfig; 

	echo "
		<style type=\"text/css\">
		#buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }
		#buttonbar { float:left; width:100%; background: #e7e7e7 url(".XOOPS_URL."/modules/ixtframework/images/menu/bg.png) repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px; }
		#buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
		#buttonbar li { display:inline; margin:0; padding:0; }
		#buttonbar a { float:left; background:url(".XOOPS_URL."/modules/ixtframework/images/deco/left_both.png) no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; }
		#buttonbar a span { float:left; display:block; background:url(".XOOPS_URL."/modules/ixtframework/images/deco/right_both.png) no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
		#buttonbar a span {float:none;}
		#buttonbar a:hover span { color:#333; }
		#buttonbar #current a { background-position:0 -150px; border-width:0; }
		#buttonbar #current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
		#buttonbar a:hover { background-position:0% -150px; }
		#buttonbar a:hover span { background-position:100% -150px; }
		</style>
    ";
		
	$tblColors = Array();
	$tblColors[0] = $tblColors[1] = $tblColors[2] = $tblColors[3] = $tblColors[4] = $tblColors[5] = $tblColors[6] = $tblColors[7] = $tblColors[8] = "";
	$tblColors[$currentoption] = "current";
	if (file_exists("".XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar("dirname")."/language/".$xoopsConfig["language"]."/modinfo.php")) {
		include_once("".XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar("dirname")."/language/".$xoopsConfig["language"]."/modinfo.php");
	} else {
		include_once("".XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar("dirname")."/english/modinfo.php");
	}
	
	echo "<div id=\"buttontop\">
			<table style=\"width: 100%; padding: 0;\" cellspacing=\"0\">
				<tr>
					<td style=\"font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;\">
					  <a class=\"nobutton\" href=\"".XOOPS_URL."/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$myts->displayTarea($xoopsModule->getVar("mid"))."\">_AM_IXTFRAMEWORK_GENERALSET</a> 
					| <a href=\"".XOOPS_URL."/modules/ixtframework/index.php\">_AM_IXTFRAMEWORK_GOINDEX</a> 
					| <a href=\"".XOOPS_URL."/modules/ixtframework/admin/upgrade.php\">_AM_IXTFRAMEWORK_UPGRADE</a> 
					</td>
					<td style=\"font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;\"><b>".$myts->displayTarea($xoopsModule->name())."</b></td>
				</tr>
			</table>
		  </div>
	
		  <div id=\"buttonbar\">
			<ul><li id=\"$tblColors[0]\"><a href=\"".XOOPS_URL."/modules/ixtframework/admin/index.php\"><span>_MI_IXTFRAMEWORK_MANAGER_INDEX</span></a></li>
				<li id=\"$tblColors[1]\"><a href=\"".XOOPS_URL."/modules/ixtframework/admin/pagelayout.php\"><span>_MI_IXTFRAMEWORK_MANAGER_PAGELAYOUT</span></a></li>
				<li id=\"$tblColors[2]\"><a href=\"".XOOPS_URL."/modules/ixtframework/admin/slides.php\"><span>_MI_IXTFRAMEWORK_MANAGER_SLIDES</span></a></li>
				<li id=\"$tblColors[3]\"><a href=\"".XOOPS_URL."/modules/ixtframework/admin/topic.php\"><span>_MI_IXTFRAMEWORK_MANAGER_TOPIC</span></a></li>
				<li id=\"$tblColors[4]\"><a href=\"".XOOPS_URL."/modules/ixtframework/admin/assigns.php\"><span>_MI_IXTFRAMEWORK_MANAGER_ASSIGNS</span></a></li>
				<li id=\"$tblColors[5]\"><a href=\"".XOOPS_URL."/modules/ixtframework/admin/widgets.php\"><span>_MI_IXTFRAMEWORK_MANAGER_WIDGETS</span></a></li>
				<li id=\"$tblColors[6]\"><a href=\"".XOOPS_URL."/modules/ixtframework/admin/globalnav.php\"><span>_MI_IXTFRAMEWORK_MANAGER_GLOBALNAV</span></a></li>
				<li id=\"$tblColors[7]\"><a href=\"".XOOPS_URL."/modules/ixtframework/admin/preheader.php\"><span>_MI_IXTFRAMEWORK_MANAGER_PREHEADER</span></a></li>
				<li id=\"$tblColors[8]\"><a href=\"".XOOPS_URL."/modules/ixtframework/admin/uitheme.php\"><span>_MI_IXTFRAMEWORK_MANAGER_UITHEME</span></a></li>
				<li id=\"$tblColors[9]\"><a href=\"".XOOPS_URL."/modules/ixtframework/admin/fixskin.php\"><span>_MI_IXTFRAMEWORK_MANAGER_FIXSKIN</span></a></li>
				<li id=\"$tblColors[10]\"><a href=\"".XOOPS_URL."/modules/ixtframework/admin/toplayout.php\"><span>_MI_IXTFRAMEWORK_MANAGER_TOPLAYOUT</span></a></li>
				<li id=\"$tblColors[11]\"><a href=\"".XOOPS_URL."/modules/ixtframework/admin/botlayout.php\"><span>_MI_IXTFRAMEWORK_MANAGER_BOTLAYOUT</span></a></li>
				<li id=\"$tblColors[12]\"><a href=\"".XOOPS_URL."/modules/ixtframework/admin/themes.php\"><span>_MI_IXTFRAMEWORK_MANAGER_THEMES</span></a></li>
				
				<li id=\"$tblColors[13]\"><a href=\"".XOOPS_URL."/modules/ixtframework/admin/permissions.php\"><span>_MI_IXTFRAMEWORK_MANAGER_PERMISSIONS</span></a></li>
				<li id=\"$tblColors[14]\"><a href=\"".XOOPS_URL."/modules/ixtframework/admin/about.php\"><span>_MI_IXTFRAMEWORK_MANAGER_ABOUT</span></a></li>
			</ul></div>";
}

// For RMCommon Utility
function ixtframework_rmtoolbar(){
	
	RMTemplate::get()->add_tool(_MI_IXTFRAMEWORK_MANAGER_DASHBOARD, './index.php', '../images/deco/icon_index_16.png', 'dashboard');
	RMTemplate::get()->add_tool(_MI_IXTFRAMEWORK_MANAGER_ASSIGNS, './assigns.php', '../images/deco/icon_assigns_16.png', 'assigns');
	RMTemplate::get()->add_tool(_MI_IXTFRAMEWORK_MANAGER_THEMES, './themes.php', '../images/deco/icon_themes_16.png', 'themes');
	RMTemplate::get()->add_tool(_MI_IXTFRAMEWORK_MANAGER_THEMESCAT, './thcat.php', '../images/deco/icon_themes_16.png', 'thcat');
 RMTemplate::get()->add_tool(_MI_IXTFRAMEWORK_MANAGER_PAGELAYOUT, './pagelayout.php', '../images/deco/icon_pagelayout_16.png', 'pagelayout');
	RMTemplate::get()->add_tool(_MI_IXTFRAMEWORK_MANAGER_SLIDES, './slides.php', '../images/deco/icon_slides_16.png', 'slides');
	RMTemplate::get()->add_tool(_MI_IXTFRAMEWORK_MANAGER_WIDGETS, './widgets.php', '../images/deco/icon_widgets_16.png', 'widgets');
	RMTemplate::get()->add_tool(_MI_IXTFRAMEWORK_MANAGER_GLOBALNAV, './globalnav.php', '../images/deco/icon_globalnav_16.png', 'globalnav');
	RMTemplate::get()->add_tool(_MI_IXTFRAMEWORK_MANAGER_PREHEADER, './preheader.php', '../images/deco/icon_preheader_16.png', 'preheader');
	RMTemplate::get()->add_tool(_MI_IXTFRAMEWORK_MANAGER_TOPLAYOUT, './toplayout.php', '../images/deco/icon_toplayout_16.png', 'toplayout');
	RMTemplate::get()->add_tool(_MI_IXTFRAMEWORK_MANAGER_BOTLAYOUT, './botlayout.php', '../images/deco/icon_botlayout_16.png', 'botlayout');
	RMTemplate::get()->add_tool(_MI_IXTFRAMEWORK_MANAGER_ABOUT, './about.php', '../images/deco/icon_about_16.png', 'about');
 
	RMTemplate::get()->set_help('http://ixthemes.org/modules/liaise/index.php?form_id=1');

}

?>