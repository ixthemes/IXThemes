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
	@$op = "show_list_widgets";
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

if (!($op == "save_widgets") && !($op == "update_online_widgets") && !($op == "delete_widgets")) {

if (!ixtframework_isrmcommon()) {
	// algalochkin: Admin menu with support old CMS version or icms
	if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
	ixtframework_adminmenu(5, _AM_IXTFRAMEWORK_MANAGER_WIDGETS);
	} else {
	include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
	loadModuleAdminMenu (5, _AM_IXTFRAMEWORK_MANAGER_WIDGETS);
	}
} else {
 define('RMCLOCATION','widgets'); // for menubar item hover
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
echo "<div class=\"cpbigtitle\" style=\"background-image: url(../images/deco/widgets.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTFRAMEWORK_MANAGER_WIDGETS."</strong>
	</div><br /><br>";
}

switch ($op) 
{	
	case "save_widgets":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           ixt_redirect("widgets.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["widgets_id"])) {
           $obj =& $widgetsHandler->get($_REQUEST["widgets_id"]);
        } else {
           $obj =& $widgetsHandler->create();
        }
		
		//Form widgets_name
		$obj->setVar("widgets_name", $_REQUEST["widgets_name"]);
		//Form widgets_title
		$obj->setVar("widgets_title", $_REQUEST["widgets_title"]);
		//Form widgets_content
		$obj->setVar("widgets_content", $_REQUEST["widgets_content"]);
		//Form widgets_submitter
		$obj->setVar("widgets_submitter", $_REQUEST["widgets_submitter"]);
		//Form widgets_date_created
		$obj->setVar("widgets_date_created", strtotime($_REQUEST["widgets_date_created"]));
		//Form widgets_online
		$verif_widgets_online = ($_REQUEST["widgets_online"] == 1) ? "1" : "0";
		$obj->setVar("widgets_online", $verif_widgets_online);
		
		
        if ($widgetsHandler->insert($obj)) {
           ixt_redirect("widgets.php?op=show_list_widgets", 2, _AM_IXTFRAMEWORK_FORMOK);
        }
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_widgets":
		$obj = $widgetsHandler->get($_REQUEST["widgets_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_widgets":
		$obj =& $widgetsHandler->get($_REQUEST["widgets_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				ixt_redirect("widgets.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($widgetsHandler->delete($obj)) {
				ixt_redirect("widgets.php", 3, _AM_IXTFRAMEWORK_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "widgets_id" => $_REQUEST["widgets_id"], "op" => "delete_widgets"), $_SERVER["REQUEST_URI"], sprintf(_AM_IXTFRAMEWORK_FORMSUREDEL, $obj->getVar("widgets")));
		}
	break;
	
	case "update_online_widgets":
		
	if (isset($_REQUEST["widgets_id"])) {
		$obj =& $widgetsHandler->get($_REQUEST["widgets_id"]);
	} 
	$obj->setVar("widgets_online", $_REQUEST["widgets_online"]);

	if ($widgetsHandler->insert($obj)) {
		ixt_redirect("widgets.php", 3, _AM_IXTFRAMEWORK_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("widgets_id");
		$criteria->setOrder("ASC");
		$numrows = $widgetsHandler->getCount();
		$widgets_arr = $widgetsHandler->getall($criteria);
		
			//Affichage du tableau
			if ($numrows>0) 
			{			
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<th align=\"center\">"._AM_IXTFRAMEWORK_WIDGETS_NAME."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_WIDGETS_TITLE."</th>
						<!--
						<th align=\"center\">"._AM_IXTFRAMEWORK_WIDGETS_CONTENT."</th>
						-->
						<th align=\"center\">"._AM_IXTFRAMEWORK_WIDGETS_SUBMITTER."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_WIDGETS_DATE_CREATED."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_WIDGETS_ONLINE."</th>
						
						<th align=\"center\" width=\"10%\">"._AM_IXTFRAMEWORK_FORMACTION."</th>
					</tr>";
						
				$class = "odd";
				
				foreach (array_keys($widgets_arr) as $i) 
				{	
					if ( $widgets_arr[$i]->getVar("topic_pid") == 0)
					{
						$class = ($class == "even") ? "odd" : "even";
						echo "<tr class=\"".$class."\">";
						
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_WIDGETS_NAME."\">".$widgets_arr[$i]->getVar("widgets_name")."</a></td>";	
					
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_WIDGETS_TITLE."\">".$widgets_arr[$i]->getVar("widgets_title")."</a></td>";	
					
//					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_WIDGETS_CONTENT."\">".$widgets_arr[$i]->getVar("widgets_content")."</a></td>";	
					
					echo "<td align=\"center\">".XoopsUser::getUnameFromId($widgets_arr[$i]->getVar("widgets_submitter"),"S")."</td>";	
					echo "<td align=\"center\">".formatTimeStamp($widgets_arr[$i]->getVar("widgets_date_created"),"S")."</td>";	
					
					$online = $widgets_arr[$i]->getVar("widgets_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./widgets.php?op=update_online_widgets&widgets_id=".$widgets_arr[$i]->getVar("widgets_id")."&widgets_online=0\" title=\""._AM_IXTFRAMEWORK_ON."\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_ON."\" title=\""._AM_IXTFRAMEWORK_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./widgets.php?op=update_online_widgets&widgets_id=".$widgets_arr[$i]->getVar("widgets_id")."&widgets_online=1\" title=\""._AM_IXTFRAMEWORK_OFF."\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_OFF."\" title=\""._AM_IXTFRAMEWORK_OFF."\"></a></td>";
					}
									echo "<td align=\"center\" width=\"10%\">
										<a style=\"text-decoration:none\" class=\"tooltip\" href=\"widgets.php?op=edit_widgets&widgets_id=".$widgets_arr[$i]->getVar("widgets_id")."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"><img src=\"../images/deco/edit.png\" alt=\""._AM_IXTFRAMEWORK_EDIT."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"></a>
										<a style=\"text-decoration:none\" class=\"tooltip\" href=\"widgets.php?op=delete_widgets&widgets_id=".$widgets_arr[$i]->getVar("widgets_id")."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"><img src=\"../images/deco/delete.png\" alt=\""._AM_IXTFRAMEWORK_DELETE."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"></a>
									  </td>";
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		
    	$obj =& $widgetsHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
	
?>