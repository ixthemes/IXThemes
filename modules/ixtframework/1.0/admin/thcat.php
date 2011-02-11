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

include_once('header.php');

xoops_cp_header();

if (isset($_REQUEST["op"])) {
	$op = $_REQUEST["op"];
} else {
	@$op = "default";
}

if (ixtframework_isrmcommon()) {
echo "
<link rel=\"stylesheet\" href=\"../css/prettyPhoto.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\" />
<link rel=\"stylesheet\" href=\"../css/jgrowl.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\" />
<link rel=\"stylesheet\" href=\"../css/tooltip.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\" />
<link rel=\"stylesheet\" href=\"../css/thcat.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\" />
<script type=\"text/javascript\" src=\"../js/jquery.prettyPhoto.js\" charset=\"utf-8\"></script>
<script type=\"text/javascript\" src=\"../js/jquery.jgrowl.js\" charset=\"utf-8\"></script>
<script type=\"text/javascript\" src=\"../js/tooltip.js\" charset=\"utf-8\"></script>
";

echo "<script type=\"text/javascript\" charset=\"utf-8\">
	$(document).ready(function(){
		$(\"a[rel^=prettyPhoto]\").prettyPhoto({
			animationSpeed: \"normal\",
			padding: 40,
			opacity: 0.35,
			showTitle: true,
			allowresize: true,
			counter_separator_label: \"/\",
			theme: \"light_rounded\"
		});
	});
</script>";

echo "<style>
/* Correction RMCommon GUI for required elements in XOOPS form */
div.xoops-form-element-caption .caption-marker { display:none; }
div.xoops-form-element-caption-required .caption-marker {	background-color:inherit;	padding-left:2px;	color:#ff0000; }
</style>
";
} else {
	if (class_exists('XoopsPreload')) {
		// since XOOPS 2.4.x
		$xoopsPreload =& XoopsPreload::getInstance();
		$xoopsPreload->triggerEvent('ixtframework.admin');
  $xoopsPreload->triggerEvent('ixtframework.jgrowlredirect');
	}
}

if (!($op == "not_supported")) {

if (!ixtframework_isrmcommon()) {
	// algalochkin: Admin menu with support old CMS version or icms
	if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
	ixtframework_adminmenu(15, _AM_IXTFRAMEWORK_MANAGER_THEMESCAT);
	} else {
	include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
	loadModuleAdminMenu (15, _AM_IXTFRAMEWORK_MANAGER_THEMESCAT);
	}
} else {
 define('RMCLOCATION','thcat'); // for menubar item hover
 ixtframework_rmtoolbar();
}

echo "<style>
.cpbigtitle{
	font-size: 20px;
	color: #1E90FF;
	background: no-repeat left top;
	font-weight: bold;
	height: 50px;
	vertical-align: middle;
	padding: 10px 0 0 50px;
	border-bottom: 3px solid #1E90FF;
}
/* ixtSTART colors */
.red { background-color:transparent; color:#ff0000; }
.blue { background-color:transparent; color:#0000ff; }
.black { background-color:transparent; color:#000; }
.white { background-color:transparent; color:#fff; }
.yellow { background-color:transparent; color:#ffff00; }
.orange { background-color:transparent; color:#ffa500; }
.green { background-color:transparent; color:#008000; }
.silver { background-color:transparent; color:#c0c0c0; }
/* ixtFINISH colors */
/* ixtSTART mark and table */
.mark {	background-color: #91EF88; }
.mark td {	padding:10px 0 10px 0; }
td { vertical-align:top; )
/* ixtFINISH mark and table */
</style>";

/* current selected theme on user side */
$curtheme = $GLOBALS["xoopsConfig"]["theme_set"];

//xoops_error(sprintf(_AM_IXTFRAMEWORK_MANAGER_WARNINGFREE, ""));
//echo "<br />";

/* list only allowed themes */
/*
$themesallowed = $GLOBALS["xoopsConfig"]["theme_set_allowed"];
if (!(is_file(XOOPS_THEME_PATH . "/" . $curtheme . "/tpl/assigns.html"))) {
    xoops_error(sprintf(_AM_IXTFRAMEWORK_MANAGER_WARNINGNOTIXTTHEME, $curtheme));
    echo "<br />";
} elseif (!(is_file(XOOPS_THEME_PATH . "/" . $curtheme."/xoplugins/ixt09.php"))) {
    xoops_error(sprintf(_AM_IXTFRAMEWORK_MANAGER_WARNINGNOTIXTTHEME4, $curtheme));
    echo "<br />";
} else {
    xoops_error(sprintf(_AM_IXTFRAMEWORK_MANAGER_WARNINGDEFTHEME1, $curtheme));
    echo "<br />";
}
*/
// since 2.4.0 release jQuery included in xoops and load in HTML-header
// ixtSTART ifjQuery
if ((is_file(XOOPS_TRUST_PATH . "/Frameworks/jquery/jquery.js"))) {
	$ifjquery = 1;
}
// ixtFINISH ifjQuery

echo "<div class=\"cpbigtitle\" style=\"background-image: url(../images/deco/themes.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTFRAMEWORK_MANAGER_THEMESCAT."</strong>
	</div><br /><br>";
}

function ixt_show_init(){
	global $xoopsConfig;
	
	$theme_info = array();
	$curtheme = $xoopsConfig['theme_set'];
	// Check if installed theme is a valid IXTheme theme
	$theme_path = XOOPS_THEME_PATH.'/'.$curtheme;
	$theme_url = XOOPS_THEME_URL.'/'.$curtheme;
	
	if (false===($theme = ixt_is_valid($curtheme))){
		// Not a IXThemes theme
		$not_valid = true;
		if(is_file($theme_path.'/screenshot.png')){
			$file = '/screenshot.png';
		} elseif(is_file($theme_path.'/screenshot.jpg')){
			$file = '/screenshot.jpg';
		} elseif(is_file($theme_path.'/screenshot.gif')){
			$file = '/screenshot.gif';
		} elseif(is_file($theme_path.'/shot.gif')){
			$file = '/shot.gif';
		} else {
			$file = '';
		}

 	// Check if installed theme is a valid XOOPS theme
		$hasinfo = is_readable($theme_path.'/xo-info.php');
		if ($hasinfo) {
			$theme_info = include_once($theme_path.'/xo-info.php');
			// if not full xo-info
			if (!isset($theme_info['name'])) {$theme_info['name'] = $curtheme;}
			if (!isset($theme_info['description'])) {$theme_info['description'] = _AM_IXTFRAMEWORK_THCAT_STANDARD;}
			if (!isset($theme_info['version'])) {$theme_info['version'] = strtolower(_AM_IXTFRAMEWORK_THCAT_UNKNOWN);}
			if (!isset($theme_info['author'])) {$theme_info['author'] = _AM_IXTFRAMEWORK_THCAT_UNKNOWN;}
			if (!isset($theme_info['email'])) {$theme_info['email'] = strtolower(_AM_IXTFRAMEWORK_THCAT_UNKNOWN);}
			if (!isset($theme_info['url'])) {$theme_info['url'] = strtolower(_AM_IXTFRAMEWORK_THCAT_UNKNOWN);}
			if (!isset($theme_info['copyright'])) {$theme_info['copyright'] = strtolower(_AM_IXTFRAMEWORK_THCAT_UNKNOWN);}
			if (!isset($theme_info['license'])) {$theme_info['license'] = strtolower(_AM_IXTFRAMEWORK_THCAT_UNKNOWN);}
			if (!isset($theme_info['screenshot'])) {$theme_info['screenshot'] = $file;}
			if (!isset($theme_info['dir'])) {$theme_info['dir'] = $curtheme;}
		} else {
			$theme_info = array(
				'name'			=>	$curtheme,
				'description'	=>	_AM_IXTFRAMEWORK_THCAT_STANDARD,
				'version'		=>	strtolower(_AM_IXTFRAMEWORK_THCAT_UNKNOWN),
				'author'		=>	_AM_IXTFRAMEWORK_THCAT_UNKNOWN,
				'email'			=>	strtolower(_AM_IXTFRAMEWORK_THCAT_UNKNOWN),
				'url'			=>	'',
				'demo'			=>	'',
				'copyright'			=>	strtolower(_AM_IXTFRAMEWORK_THCAT_UNKNOWN),
				'license'			=>	strtolower(_AM_IXTFRAMEWORK_THCAT_UNKNOWN),
				'screenshot'	=>	$file,
				'dir'			=>	$curtheme
			);
		}
	} else {
		$not_valid = false;
		if (is_object($theme)) {
			// release 5.x
	 	$theme_info = $theme->get_info();
		} else {
			// releases 3.x,4.x
			$theme_info = include_once($theme_path.'/xo-info.php');
			// currect BUG in IXThemes xo-info
			if (!isset($theme_info['license'])) {$theme_info['license'] = $theme_info['licence'];}
		}
	}
	
	//Search other available themes
	$themes = array();
	$themesallowed = array();
	$i = 0; // Counter
	$tpath = XOOPS_ROOT_PATH.'/themes';
	$dir_themes = opendir(XOOPS_ROOT_PATH.'/themes');
	$themesallowed = $GLOBALS["xoopsConfig"]["theme_set_allowed"];

 foreach ($themesallowed as $t){
		if (!($t == $curtheme)) {
 	if (false===($ttheme = ixt_is_valid($t))) {
			$valid = false;
			if(is_file($tpath."/$t/screenshot.png")){
				$file = "screenshot.png";
			} elseif(is_file($tpath."/$t/screenshot.jpg")){
				$file = "screenshot.jpg";
			} elseif(is_file($tpath."/$t/screenshot.gif")){
				$file = "screenshot.gif";
			} elseif(is_file($tpath."/$t/shot.gif")){
				$file = "shot.gif";
			} else {
			$file = '';
			}
			
			$themes[$i]['valid'] = false;
			$themes[$i]['info'] = array(
				'name'			=>	$t,
				'description'	=>	_AM_IXTFRAMEWORK_THCAT_NOTVALIDIXTHEME,
				'version'		=>	strtolower(_AM_IXTFRAMEWORK_THCAT_UNKNOWN),
				'author'		=>	_AM_IXTFRAMEWORK_THCAT_UNKNOWN,
				'email'			=>	strtolower(_AM_IXTFRAMEWORK_THCAT_UNKNOWN),
				'url'			=>	'',
				'demo'			=>	'',
				'copyright'			=>	strtolower(_AM_IXTFRAMEWORK_THCAT_UNKNOWN),
				'license'			=>	strtolower(_AM_IXTFRAMEWORK_THCAT_UNKNOWN),
				'screenshot'	=>	$file,
				'dir'			=> $t
			);
		} else {
			$valid = true;
			if (is_object($ttheme)) {
				// release 5.x
				$themes[$i]['info'] = $ttheme->get_info();
			} else {
				// releases 3.x,4.x
				$themes[$i]['info'] = include_once(XOOPS_ROOT_PATH.'/themes/'.$t.'/xo-info.php');
			}
			$themes[$i]['info']['dir'] = $t;
			$themes[$i]['valid'] = true;
		}
		$i++;
		}
	}
	
//	$xoTheme = $GLOBALS['xoTheme'];
//	$xoTheme->addMeta('stylesheet', 'thcat.css', array('href'=>'css/thcat.css','type'=>'text/css'));
// include_once $GLOBALS['xoops']->path('class/template.php');
// $GLOBALS['xoopsTpl'] = new XoopsTpl();
	$GLOBALS['xoopsTpl']->assign('theme_url', $theme_url);
	$GLOBALS['xoopsTpl']->assign('theme_info', $theme_info);
	$GLOBALS['xoopsTpl']->assign('themes', $themes);
	$GLOBALS['xoopsTpl']->assign('not_valid', $not_valid);
 $GLOBALS['xoopsTpl']->display("db:admin/ixtframework_thcat_index.html");
	
}

/**
* Configure theme settings
* 
* @var string
*/
function ixt_configure_show() {
	global $xoopsConfig, $xoopsTpl;
	
	$curtheme = $xoopsConfig['theme_set'];
	
	if (false === ($theme = ixt_is_valid($curtheme)))
		ixt_redirect('thcat.php', 3, _AM_IXTFRAMEWORK_THCAT_CANTBECONF);

	if (!method_exists($theme, 'get_config')) {
//		ixt_redirect('thcat.php', 3, _AM_IXTFRAMEWORK_THCAT_NOTCONFOPT);
  // IXThemes rel. 3.x, 4.x
		$element = $curtheme;
		$element_info = include_once(XOOPS_ROOT_PATH.'/themes/'.$element.'/xo-info.php');
		$current_settings = ixt_get_current_config($element, true);
	} else {
		// IXThemes rel.5.x
		$element = $curtheme;
		$element_info = $element->get_info();
		$current_settings = ixt_get_current_config($element, true);
	}
	
	$ixt_show = 'theme';
// include_once $GLOBALS['xoops']->path('class/template.php');
// $GLOBALS['xoopsTpl'] = new XoopsTpl();
	$GLOBALS['xoopsTpl']->assign('ixt_show', $ixt_show);
	$GLOBALS['xoopsTpl']->assign('element_info', $element_info);
	$GLOBALS['xoopsTpl']->assign('element', $element);
	$GLOBALS['xoopsTpl']->assign('theme', $theme);
	$GLOBALS['xoopsTpl']->assign('current_settings', $current_settings);
 $GLOBALS['xoopsTpl']->display("db:admin/ixtframework_thcat_config.html");
}

/**
* This funtion redirect to theme url owner
*/
function ixt_goto_url(){
	global $xoopsConfig;
	
	$curtheme = $xoopsConfig['theme_set'];
	// Check if installed theme is a valid IXTheme theme
	$theme_path = XOOPS_THEME_PATH.'/'.$curtheme;
//	$theme_url = XOOPS_THEME_URL.'/'.$curtheme;
	
	if (false === ($theme = ixt_is_valid($curtheme)))
		ixt_redirect('thcat.php', 3, _AM_IXTFRAMEWORK_THCAT_CANTBECONF);

	if (is_object($theme)) {
		// release 5.x
	 $element_info = $theme->get_info();
 } else {
 	// Check if installed theme is a valid XOOPS theme
		$hasinfo = is_readable($theme_path.'/xo-info.php');
		if ($hasinfo) {
			$element_info = include_once($theme_path.'/xo-info.php');
		}
	}
	
	if ($element_info['url']!=''){
		header('location: '.$element_info['url']);
		die();
	} else {
		header('location: themes.php');
		die();
	}
}

/**
* Activate a theme
*/
function ixt_install_theme(){
    global $xoopsConfig;
    
    $previous = $xoopsConfig['theme_set'];
    
    $dir = isset($_GET['theme']) ? $_GET['theme'] : '';
    
    $pdir = XOOPS_THEME_PATH.'/'.$dir;
   
    if (!is_file($pdir.'/config/theme.php'))
    	ixt_redirect('thcat.php', 3, sprintf(_AM_IXTFRAMEWORK_THCAT_THEMENOTEXIST, $dir));
    
    if (false===($theme = ixt_is_valid($dir)))
   		ixt_redirect('thcat.php', 3, sprintf(_AM_IXTFRAMEWORK_THCAT_THEMENOTVALID, $dir));
    
    include_once $pdir.'/config/theme.php';
    $rtheme = preg_replace('/\s+/', '', strtolower($dir));
	   $rtheme = str_replace('-','',$rtheme);
	   $class = "IXTheme".ucfirst($rtheme);
    if (!class_exists($class))
    	ixt_redirect('thcat.php', 3, sprintf(_AM_IXTFRAMEWORK_THCAT_THEMENOTVALID, $dir));
    
    $db = Database::getInstance();
    //$theme = new $class();
    
    // Check requirements
    if (method_exists($theme, 'check_requirements')){
    	if (!$theme->check_requirements())
    		ixt_redirect('thcat.php', 3, sprintf(_AM_IXTFRAMEWORK_THCAT_THEMERETERRORS, $theme->name()).'<br /><br />'.implode("<br />", $theme->errors()));
	   }

    // Insert theme data
    if (!$db->queryF("UPDATE ".$db->prefix("config")." SET `conf_value`='$dir' WHERE `conf_name`='theme_set' AND conf_modid='0'"))
        ixt_redirect('thcat.php', 3, _AM_IXTFRAMEWORK_THCAT_THEMENOTINST.'<br />'.$db->error());
        
    $_SESSION['xoopsUserTheme'] = $dir;
    // Delete previous data if valid
    if (false !== ($previous = ixt_is_valid($previous))){
					if (method_exists($previous, 'uninstall')){
						$messages = array();
						if (!$previous->uninstall()) $messages = $previous->errors();
					}
				}
    
    // Run install method from plugin.
    // This method allows insertion on several data for plugin
    if (method_exists($theme, 'install'))
    	$theme->install();

    ixt_redirect('thcat.php', 3, _AM_IXTFRAMEWORK_THCAT_THEMEINSTSUC.(count($messages)>0 ? " "._AM_IXTFRAMEWORK_THCAT_BUTSOMEERRORS."<br />".implode("<br />".$messages) : ''));
}

/**
* Install a normal theme
*/
function ixt_install_normal(){
    global $xoopsConfig;
    
    $previous = $xoopsConfig['theme_set'];
				$messages = array();
    
    $dir = isset($_GET['theme']) ? $_GET['theme'] : '';
    
    $pdir = XOOPS_THEME_PATH.'/'.$dir;
   
    if (is_file($pdir.'/config/theme.php'))
    	ixt_redirect('thcat.php', 3, sprintf(_AM_IXTFRAMEWORK_THCAT_ISIXTTHEME, $dir));
    
//    if (ixt_is_valid($dir))
//   		ixt_redirect('thcat.php', 3, sprintf(_AM_IXTFRAMEWORK_THCAT_ISIXTTHEME, $dir));
		
	   $db = Database::getInstance();
    // Insert theme data
    if (!$db->queryF("UPDATE ".$db->prefix("config")." SET `conf_value`='$dir' WHERE `conf_name`='theme_set' AND conf_modid='0'"))
        ixt_redirect('thcat.php', 3, _AM_IXTFRAMEWORK_THCAT_THEMENOTINST.'<br />'.$db->error());
    $_SESSION['xoopsUserTheme'] = $dir;
    // Delete previous data if valid
    if (false !== ($previous = ixt_is_valid($previous))){
					if (method_exists($previous, 'uninstall')){
						$messages = array();
						if (!$previous->uninstall()) $messages = $previous->errors();
					}
				}

    ixt_redirect('thcat.php', 3, _AM_IXTFRAMEWORK_THCAT_THEMEINSTSUC.(count($messages)>0 ? " "._AM_IXTFRAMEWORK_THCAT_BUTSOMEERRORS."<br />".implode("<br />".$messages) : ''));
}

/**
* Check the settings and save data
*/
function ixt_save_settings(){
	global $xoopsConfig;

	$myts = MyTextSanitizer::getInstance();
	
	if (false === ($theme = ixt_is_valid($xoopsConfig['theme_set'])))
		ixt_redirect('index.php', 3, _AM_IXTFRAMEWORK_THCAT_NOTVALIDTHEME);
	
	$ixt_to_save = array();
	
	$element = $_POST['element'];
	
	foreach ($_POST as $id => $v){
		if(substr($id, 0, 7)!='ixtconf_') continue;
		
		if (method_exists($theme, 'verify_settings')){
			$ixt_to_save[substr($id, 7)] = $theme->verify_settings($v);
		} else {
			$ixt_to_save[substr($id, 7)] = $v;
		}		
	}
	
	$db = Database::getInstance();

	// Delete current config
	$db->queryF("DELETE FROM ".$db->prefix("ixtframework_thconfig")." WHERE `element`='$element'");
	
	// Save data
	$sql = "INSERT INTO ".$db->prefix("ixtframework_thconfig")." (`name`,`value`,`type`,`element`) VALUES ('%s','%s','%s','$element')";
	$errors = array();
	array_walk_recursive($ixt_to_save, 'clean_values');
	foreach ($ixt_to_save as $id => $value){
		
		if (is_array($value)){
			$value = serialize($value);
			$type = 'array';
		} else {
			$value = $myts->addSlashes($value);
			$type = '';
		}
		
		if (!$db->queryF(sprintf($sql, $id, $value, $type)))
			$errors[] = $db->error();
		
	}
	if (!empty($errors)){
		ixt_redirect('thcat.php?op=config', 3, _AM_IXTFRAMEWORK_THCAT_ERRORSOPERATION.'<br />'.implode('<br />', $errors));
	} else {
		ixt_redirect('thcat.php?op=config', 3, _AM_IXTFRAMEWORK_THCAT_SETTINGSUPDATED);
	}
	
}

function clean_values(&$value, $key) {
	$value = htmlentities($value, ENT_QUOTES, 'UTF-8');
}

//$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : '';
switch($op){
	case 'install-theme':
//		ixt_install_theme();
		ixt_install_normal();
		break;
	case 'install-normal':
		ixt_install_normal();
		break;
	case 'config':
		ixt_configure_show();
		break;
	case 'save_settings':
		ixt_save_settings();
		break;
	case 'plugins':
		ixt_show_plugins();
		break;
 case 'activate-plugin':
  ixt_activate_plugin();
  break;
 case 'config-plugin':
 	ixt_configure_plugin();
 	break;
 case 'url':
 	ixt_goto_url();
 	break;
	case "default":
	default:
		ixt_show_init();
		break;
}

echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" rel=\"external\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" /></a></div>
";

	xoops_cp_footer();
	
?>