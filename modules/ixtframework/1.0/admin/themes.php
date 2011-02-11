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

include_once("./header.php");

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

if (!($op == "not_supported") && !($op == "edit_themes") && !($op == "save_themes") && !($op == "update_online_themes") && !($op == "delete_themes")) {

if (!ixtframework_isrmcommon()) {
	// algalochkin: Admin menu with support old CMS version or icms
	if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
	ixtframework_adminmenu(2, _AM_IXTFRAMEWORK_MANAGER_THEMES);
	} else {
	include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
	loadModuleAdminMenu (2, _AM_IXTFRAMEWORK_MANAGER_THEMES);
	}
} else {
 define('RMCLOCATION','themes'); // for menubar item hover
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

// since 2.4.0 release jQuery included in xoops and load in HTML-header
// ixtSTART ifjQuery
if ((is_file(XOOPS_TRUST_PATH . "/Frameworks/jquery/jquery.js"))) {
	$ifjquery = 1;
}
// ixtFINISH ifjQuery

echo "<div class=\"cpbigtitle\" style=\"background-image: url(../images/deco/themes.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTFRAMEWORK_MANAGER_THEMES."</strong>
	</div><br /><br>";
}

switch ($op) 
{	
	case "not_supported":
	/* not supported now for XOOPS 2.3.3 */
	ixt_redirect("themes.php?op=show_list_themes", 1, sprintf(_AM_IXTFRAMEWORK_MANAGER_NOTSUPPORTED,"This"));

	case "save_themes":
	/* not supported now for XOOPS 2.3.3 */
	ixt_redirect("themes.php?op=not_supported",0,'One moment, please...'); break;
	
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           ixt_redirect("themes.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["themes_id"])) {
           $obj =& $themesHandler->get($_REQUEST["themes_id"]);
        } else {
           $obj =& $themesHandler->create();
        }
		
		//Form themes_name
		$obj->setVar("themes_name", $_REQUEST["themes_name"]);
		//Form themes_screenshot	
		include_once XOOPS_ROOT_PATH."/class/uploader.php";
		$uploaddir_themes_screenshot = XOOPS_ROOT_PATH."/uploads/ixtframework/themes/themes_screenshot/";
		$uploader_themes_screenshot = new XoopsMediaUploader($uploaddir_themes_screenshot, $xoopsModuleConfig["themes_screenshot_mimetypes"], $xoopsModuleConfig["themes_screenshot_size"], null, null);

		if ($uploader_themes_screenshot->fetchMedia("themes_screenshot")) {
			$uploader_themes_screenshot->setPrefix("themes_screenshot_") ;
			$uploader_themes_screenshot->fetchMedia("themes_screenshot");
			if (!$uploader_themes_screenshot->upload()) {
				$errors = $uploader_themes_screenshot->getErrors();
				ixt_redirect("javascript:history.go(-1)",3, $errors);
			} else {
				$obj->setVar("themes_screenshot", $uploader_themes_screenshot->getSavedFileName());
			}
		} else {
			$obj->setVar("themes_screenshot", $_REQUEST["themes_screenshot"]);
		}
		//Form themes_release
		$obj->setVar("themes_release", $_REQUEST["themes_release"]);
		//Form themes_description
		$obj->setVar("themes_description", $_REQUEST["themes_description"]);
		//Form themes_author
		$obj->setVar("themes_author", $_REQUEST["themes_author"]);
		//Form themes_copyright
		$obj->setVar("themes_copyright", $_REQUEST["themes_copyright"]);
		//Form themes_submitter
		$obj->setVar("themes_submitter", $_REQUEST["themes_submitter"]);
		//Form themes_date_created
		$obj->setVar("themes_date_created", strtotime($_REQUEST["themes_date_created"]));
		//Form themes_online
		$verif_themes_online = ($_REQUEST["themes_online"] == 1) ? "1" : "0";
		$obj->setVar("themes_online", $verif_themes_online);
		
		if ($themesHandler->insert($obj)) {
					ixt_redirect("themes.php?op=show_list_themes", 2, _AM_IXTFRAMEWORK_FORMOK);
		}
		echo $obj->getHtmlErrors();
		$form =& $obj->getForm();
	break;
	
	case "edit_themes":
	/* not supported now for XOOPS 2.3.3 */
	ixt_redirect("themes.php?op=not_supported",0,'One moment, please...'); break;
	
		$obj = $themesHandler->get($_REQUEST["themes_id"]);
		$form = $obj->getForm();

	break;
	
	case "delete_themes":
	/* not supported now for XOOPS 2.3.3 */
	ixt_redirect("themes.php?op=not_supported",0,'One moment, please...'); break;
	
		$obj =& $themesHandler->get($_REQUEST["themes_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				ixt_redirect("themes.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($themesHandler->delete($obj)) {
				ixt_redirect("themes.php", 3, _AM_IXTFRAMEWORK_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "themes_id" => $_REQUEST["themes_id"], "op" => "delete_themes"), $_SERVER["REQUEST_URI"], sprintf(_AM_IXTFRAMEWORK_FORMSUREDEL, $obj->getVar("themes")));
		}
		
	break;
	
	case "update_online_themes":
	/* not supported now for XOOPS 2.3.3 */
	ixt_redirect("themes.php?op=not_supported",0,'One moment, please...'); break;
	
	if (isset($_REQUEST["themes_id"])) {
		$obj =& $themesHandler->get($_REQUEST["themes_id"]);
	} 
	$obj->setVar("themes_online", $_REQUEST["themes_online"]);

	if ($themesHandler->insert($obj)) {
		ixt_redirect("themes.php", 3, _AM_IXTFRAMEWORK_FORMOK);
	}
	echo $obj->getHtmlErrors();

	break;
	
	case "default":
	default:
  /* full list themes name from themes dir */
		$themes_arr = XoopsLists::getThemesList(); 
 	$numrows = count($themes_arr);
//		$themes_limit = xoops_getModuleOption('themes_limit', 'ixtframework');
//  $themes_limit = 5;
		
			if ($numrows>0) 
			{			
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<th align=\"center\">"._AM_IXTFRAMEWORK_THEMES_NAME."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_THEMES_SCREENSHOT."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_THEMES_RELEASE."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_THEMES_STRUCTURE."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_THEMES_DESCRIPTION."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_THEMES_AUTHOR."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_THEMES_COPYRIGHT."</th>
						<!--
						<th align=\"center\">"._AM_IXTFRAMEWORK_THEMES_SUBMITTER."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_THEMES_DATE_CREATED."</th>
						-->
						<th align=\"center\">"._AM_IXTFRAMEWORK_THEMES_ONLINE."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_THEMES_DEFAULT."</th>
						
						<th align=\"center\" width=\"10%\">"._AM_IXTFRAMEWORK_FORMACTION."</th>
					</tr>";
						
				$class = "odd";
				$k =0;
				
				foreach (array_keys($themes_arr) as $i) 
				{	
				 $k++;
				 $themename = $themes_arr[$i];
				 $isthemedir = is_readable(XOOPS_THEME_PATH . '/' .$themename."/theme.html");
					if ($isthemedir) {
		 		$hasinfo = is_readable(XOOPS_THEME_PATH . '/' .$themename."/xo-info.php");
					if ($hasinfo) {
						$info_arr = include_once(XOOPS_THEME_PATH . '/' .$themename."/xo-info.php");
					}
					$class = (($class == "even") || ($class == "mark")) ? "odd" : "even";
					if ($themename == $curtheme) {
						$class = "mark";
					}
						echo "<tr class=\"".$class."\">";
						if ($class == "mark") {
						echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\"Default Theme\">".$themename."</a></td>";	
						} else {
						echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_THEMES_NAME."\">".$themename."</a></td>";	
						}

						if ($hasinfo && isset($info_arr['thumbnail'])) {
							if (is_readable(XOOPS_THEME_PATH . '/' .$themename."/".$info_arr['thumbnail'])) {
					 	 echo "<td align=\"center\"><a rel=\"prettyPhoto\" style=\"text-decoration:none\" class=\"tooltip\" href=\"/themes/$themename/$info_arr[screenshot]\" title=\"Preview ".$themename."\"><img title=\"Theme ".$themename."\" src=\"".XOOPS_URL."/themes/".$themename."/".$info_arr['thumbnail']."\" width=\"80px\" /></a></td>";	
							} else {
								echo "<td align=\"center\">"._AM_IXTFRAMEWORK_THEMES_EMPTY."</td>";
       }
						} else {
 						if (is_readable(XOOPS_THEME_PATH . '/' .$themename."/shot.gif")) {
 						 echo "<td align=\"center\"><a rel=\"prettyPhoto\" style=\"text-decoration:none\" class=\"tooltip\" href=\"/themes/$themename/shot.gif\" title=\"Preview ".$themename."\"><img title=\"".$themename."\" src=\"".XOOPS_URL."/themes/".$themename."/shot.gif\" width=\"80px\" /></a></td>";	
				 		} else {
        echo "<td align=\"center\">"._AM_IXTFRAMEWORK_THEMES_EMPTY."</td>";
							}
						};	

      if ($hasinfo && isset($info_arr['version'])) {
						 echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_THEMES_RELEASE."&nbsp;".$info_arr['version']."\">".$info_arr['version']."</a></td>";	
						} else {
							echo "<td align=\"center\">"._AM_IXTFRAMEWORK_THEMES_EMPTY."</td>";
						};	

      if ($hasinfo) {
						 echo "<td align=\"center\" class=\"green\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\"".$themename.": Theme "._AM_IXTFRAMEWORK_THEMES_STRUCTURE." "._AM_IXTFRAMEWORK_THEMES_IS." "._AM_IXTFRAMEWORK_THEMES_GOOD."\">"._AM_IXTFRAMEWORK_THEMES_GOOD."</a></td>";	
						} else {
						 echo "<td align=\"center\" class=\"red\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\"".$themename.": Theme "._AM_IXTFRAMEWORK_THEMES_STRUCTURE." "._AM_IXTFRAMEWORK_THEMES_IS." "._AM_IXTFRAMEWORK_THEMES_NOTVALID."\">"._AM_IXTFRAMEWORK_THEMES_NOTVALID."</a></td>";	
						};	

						if ($hasinfo && isset($info_arr['description'])) {
						 echo "<td align=\"center\" style=\"width:150px;\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_THEMES_DESCRIPTION."\">".$info_arr['description']."</a></td>";	
						} else {
							echo "<td align=\"center\">"._AM_IXTFRAMEWORK_THEMES_EMPTY."</td>";
						};	

						if ($hasinfo && isset($info_arr['author'])) {
						 echo "<td align=\"center\" style=\"width:120px;\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_THEMES_AUTHOR."\">".$info_arr['author']."</a></td>";	
						} else {
							echo "<td align=\"center\">"._AM_IXTFRAMEWORK_THEMES_EMPTY."</td>";
						};	

						if ($hasinfo && isset($info_arr['copyright'])) {
						 echo "<td align=\"center\" style=\"width:120px;\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_THEMES_COPYRIGHT."\">".$info_arr['copyright']."</a></td>";	
						} else {
							echo "<td align=\"center\">"._AM_IXTFRAMEWORK_THEMES_EMPTY."</td>";
						};	

						$online = in_array($themename, $themesallowed);
						
						if ( isset($ifjquery) && ($ifjquery == 1) ) {
							if ( $online == 1 ) {
								echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" onclick=\"$.jGrowl('".sprintf(_AM_IXTFRAMEWORK_MANAGER_NOTSUPPORTED,_AM_IXTFRAMEWORK_ON)."');\" title=\""._AM_IXTFRAMEWORK_THEMES_SELECTABLE."\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_ON."\" title=\""._AM_IXTFRAMEWORK_ON."\" /></a></td>";	
							} else {
								echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" onclick=\"$.jGrowl('".sprintf(_AM_IXTFRAMEWORK_MANAGER_NOTSUPPORTED,_AM_IXTFRAMEWORK_OFF)."');\" title=\""._AM_IXTFRAMEWORK_THEMES_NOTSELECTABLE."\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_OFF."\" title=\""._AM_IXTFRAMEWORK_OFF."\" /></a></td>";
							}
							if ( $themename == $curtheme ) {
								echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_THEMES_THISISDEFAULT."\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_THEMES_THISISDEFAULT."\" title=\""._AM_IXTFRAMEWORK_THEMES_THISISDEFAULT."\" /></a></td>";	
							} else {
								echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./thcat.php?op=install-normal&theme=".$themename."\" title=\""._AM_IXTFRAMEWORK_THEMES_SETASDEFAULT."\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_THEMES_SETASDEFAULT."\" title=\""._AM_IXTFRAMEWORK_THEMES_SETASDEFAULT."\" /></a></td>";
							}
							echo "<td align=\"center\">
								<a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" onclick=\"$.jGrowl('".sprintf(_AM_IXTFRAMEWORK_MANAGER_NOTSUPPORTED,_AM_IXTFRAMEWORK_EDIT)."', {life:3000, position:'center', speed:'slow'});\" title=\""._AM_IXTFRAMEWORK_EDIT."\"><img src=\"../images/deco/edit.png\" alt=\""._AM_IXTFRAMEWORK_EDIT."\" title=\""._AM_IXTFRAMEWORK_EDIT."\" /></a><br />
								<a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" onclick=\"$.jGrowl('".sprintf(_AM_IXTFRAMEWORK_MANAGER_NOTSUPPORTED,_AM_IXTFRAMEWORK_DELETE)."', {life:3000, position:'center', speed:'slow'});\" title=\""._AM_IXTFRAMEWORK_DELETE."\"><img src=\"../images/deco/delete.png\" alt=\""._AM_IXTFRAMEWORK_DELETE."\" title=\""._AM_IXTFRAMEWORK_DELETE."\" /></a>
								</td>";
						} else {
							if ( $online == 1 ) {
								echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./themes.php?op=update_online_themes&themes_name=".$themename."&themes_online=0\" title=\""._AM_IXTFRAMEWORK_THEMES_SELECTABLE."\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_ON."\" title=\""._AM_IXTFRAMEWORK_ON."\" /></a></td>";	
							} else {
								echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./themes.php?op=update_online_themes&themes_name=".$themename."&themes_online=1\" title=\""._AM_IXTFRAMEWORK_THEMES_NOTSELECTABLE."\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_OFF."\" title=\""._AM_IXTFRAMEWORK_OFF."\" /></a></td>";
							}
							if ( $themename == $curtheme ) {
								echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_THEMES_THISISDEFAULT."\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_THEMES_THISISDEFAULT."\" title=\""._AM_IXTFRAMEWORK_THEMES_THISISDEFAULT."\" /></a></td>";	
							} else {
								echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./thcat.php?op=install-normal&theme=".$themename."\" title=\""._AM_IXTFRAMEWORK_THEMES_SETASDEFAULT."\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_THEMES_SETASDEFAULT."\" title=\""._AM_IXTFRAMEWORK_THEMES_SETASDEFAULT."\" /></a></td>";
							}
							echo "<td align=\"center\">
								<a style=\"text-decoration:none\" class=\"tooltip\" href=\"themes.php?op=edit_themes&themes_name=".$themename."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"><img src=\"../images/deco/edit.png\" alt=\""._AM_IXTFRAMEWORK_EDIT."\" title=\""._AM_IXTFRAMEWORK_EDIT."\" /></a><br />
								<a style=\"text-decoration:none\" class=\"tooltip\" href=\"themes.php?op=delete_themes&themes_name=".$themename."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"><img src=\"../images/deco/delete.png\" alt=\""._AM_IXTFRAMEWORK_DELETE."\" title=\""._AM_IXTFRAMEWORK_DELETE."\" /></a>
								</td>";
						}
						echo "</tr>";

//					if ($k == $themes_limit) {
//						break;
//					}
					
//					if ($numrows > $themes_limit) {
//						include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
//						$nav = new XoopsPageNav($numrows, $themes_limit, $start, 'start', 'op=show_list_themes');
//						$ixtframeworkTpl->assign( 'nav', $nav->renderNav() );
//					}
					
				}
				}
				echo "</table><br><br>";
			}

// not editable for this release
//    	$obj =& $themesHandler->create();
//    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" rel=\"external\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" /></a></div>
";
xoops_cp_footer();
	
?>