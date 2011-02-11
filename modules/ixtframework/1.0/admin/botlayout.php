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
	@$op = "show_list_botlayout";
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

if (!($op == "save_botlayout") && !($op == "update_online_botlayout") && !($op == "delete_botlayout")) {

if (!ixtframework_isrmcommon()) {
	// algalochkin: Admin menu with support old CMS version or icms
	if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
	ixtframework_adminmenu(11, _AM_IXTFRAMEWORK_MANAGER_BOTLAYOUT);
	} else {
	include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
	loadModuleAdminMenu (11, _AM_IXTFRAMEWORK_MANAGER_BOTLAYOUT);
	}
} else {
 define('RMCLOCATION','botlayout'); // for menubar item hover
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
echo "<div class=\"cpbigtitle\" style=\"background-image: url(../images/deco/botlayout.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTFRAMEWORK_MANAGER_BOTLAYOUT."</strong>
	</div><br /><br>";
}

switch ($op) 
{	
	case "save_botlayout":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           ixt_redirect("botlayout.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["botlayout_id"])) {
           $obj =& $botlayoutHandler->get($_REQUEST["botlayout_id"]);
        } else {
           $obj =& $botlayoutHandler->create();
        }
		
		//Form botlayout_name
		$obj->setVar("botlayout_name", $_REQUEST["botlayout_name"]);
		//Form botlayout_submitter
		$obj->setVar("botlayout_submitter", $_REQUEST["botlayout_submitter"]);
		//Form botlayout_date_created
		$obj->setVar("botlayout_date_created", strtotime($_REQUEST["botlayout_date_created"]));
		//Form botlayout_online
		$verif_botlayout_online = ($_REQUEST["botlayout_online"] == 1) ? "1" : "0";
		$obj->setVar("botlayout_online", $verif_botlayout_online);
		
		
        if ($botlayoutHandler->insert($obj)) {
           ixt_redirect("botlayout.php?op=show_list_botlayout", 2, _AM_IXTFRAMEWORK_FORMOK);
        }
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_botlayout":
		$obj = $botlayoutHandler->get($_REQUEST["botlayout_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_botlayout":
		$obj =& $botlayoutHandler->get($_REQUEST["botlayout_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				ixt_redirect("botlayout.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($botlayoutHandler->delete($obj)) {
				ixt_redirect("botlayout.php", 3, _AM_IXTFRAMEWORK_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "botlayout_id" => $_REQUEST["botlayout_id"], "op" => "delete_botlayout"), $_SERVER["REQUEST_URI"], sprintf(_AM_IXTFRAMEWORK_FORMSUREDEL, $obj->getVar("botlayout")));
		}
	break;
	
	case "update_online_botlayout":
		
	if (isset($_REQUEST["botlayout_id"])) {
		$obj =& $botlayoutHandler->get($_REQUEST["botlayout_id"]);
	} 
	$obj->setVar("botlayout_online", $_REQUEST["botlayout_online"]);

	if ($botlayoutHandler->insert($obj)) {
		ixt_redirect("botlayout.php", 3, _AM_IXTFRAMEWORK_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("botlayout_id");
		$criteria->setOrder("ASC");
		$numrows = $botlayoutHandler->getCount();
		$botlayout_arr = $botlayoutHandler->getall($criteria);
		
			//Affichage du tableau
			if ($numrows>0) 
			{			
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<th colspan=\"2\" align=\"center\">"._AM_IXTFRAMEWORK_BOTLAYOUT_NAME."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_BOTLAYOUT_SUBMITTER."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_BOTLAYOUT_DATE_CREATED."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_BOTLAYOUT_ONLINE."</th>
						
						<th align=\"center\" width=\"10%\">"._AM_IXTFRAMEWORK_FORMACTION."</th>
					</tr>";
						
				$class = "odd";
				
				foreach (array_keys($botlayout_arr) as $i) 
				{	
					if ( $botlayout_arr[$i]->getVar("topic_pid") == 0)
					{
						$class = ($class == "even") ? "odd" : "even";
						echo "<tr class=\"".$class."\">";

					echo "<td align=\"center\"><img src=\"../images/deco/c".$botlayout_arr[$i]->getVar("botlayout_name").".png\"></img></td>";	
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_BOTLAYOUT_NAME."\">".$botlayout_arr[$i]->getVar("botlayout_name")."</a></td>";	
					
					echo "<td align=\"center\">".XoopsUser::getUnameFromId($botlayout_arr[$i]->getVar("botlayout_submitter"),"S")."</td>";	
					echo "<td align=\"center\">".formatTimeStamp($botlayout_arr[$i]->getVar("botlayout_date_created"),"S")."</td>";	
					
					$online = $botlayout_arr[$i]->getVar("botlayout_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./botlayout.php?op=update_online_botlayout&botlayout_id=".$botlayout_arr[$i]->getVar("botlayout_id")."&botlayout_online=0\" title=\""._AM_IXTFRAMEWORK_ON."\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_ON."\" title=\""._AM_IXTFRAMEWORK_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./botlayout.php?op=update_online_botlayout&botlayout_id=".$botlayout_arr[$i]->getVar("botlayout_id")."&botlayout_online=1\" title=\""._AM_IXTFRAMEWORK_OFF."\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_OFF."\" title=\""._AM_IXTFRAMEWORK_OFF."\"></a></td>";
					}
									echo "<td align=\"center\" width=\"10%\">
										<a style=\"text-decoration:none\" class=\"tooltip\" href=\"botlayout.php?op=edit_botlayout&botlayout_id=".$botlayout_arr[$i]->getVar("botlayout_id")."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"><img src=\"../images/deco/edit.png\" alt=\""._AM_IXTFRAMEWORK_EDIT."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"></a>
										<a style=\"text-decoration:none\" class=\"tooltip\" href=\"botlayout.php?op=delete_botlayout&botlayout_id=".$botlayout_arr[$i]->getVar("botlayout_id")."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"><img src=\"../images/deco/delete.png\" alt=\""._AM_IXTFRAMEWORK_DELETE."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"></a>
									  </td>";
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		
    	$obj =& $botlayoutHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
	
?>