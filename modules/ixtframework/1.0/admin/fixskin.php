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
 * Version : 1.05:
 * ****************************************************************************
 */
 
include_once("./header.php");
	
xoops_cp_header();

if (isset($_REQUEST["op"])) {
	$op = $_REQUEST["op"];
} else {
	@$op = "show_list_fixskin";
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

if (!($op == "save_fixskin") && !($op == "update_online_fixskin") && !($op == "delete_fixskin")) {

if (!ixtframework_isrmcommon()) {
	// algalochkin: Admin menu with support old CMS version or icms
	if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
	ixtframework_adminmenu(9, _AM_IXTFRAMEWORK_MANAGER_FIXSKIN);
	} else {
	include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
	loadModuleAdminMenu (9, _AM_IXTFRAMEWORK_MANAGER_FIXSKIN);
 }
} else {
 define('RMCLOCATION','fixskin'); // for menubar item hover
 ixtframework_rmtoolbar();
}

echo "<style>
.cpbigtitle{ float:left; width:95%; font-size: 20px; color: #1E90FF; background: no-repeat left top; font-weight: bold; height: 50px; vertical-align: middle; padding: 10px 0 0 50px; border-bottom: 3px solid #1E90FF; }
.cleared { float: none; clear: both; margin: 0; padding: 0; border: none; font-size: 1px; }
fieldset {margin: .5em;padding: 1em;border: 1px solid #333;color: #000;background-color: #f0f0f0;-moz-border-radius: 6px;-webkit-border-radius: 6px;-khtml-border-radius: 6px;border-radius: 6px;}
legend {padding: .5em;font-size: 1.1em;font-weight: bolder;}
label, .caption-text {margin-bottom: .5em;padding-right: .5em;font-weight: bold;}
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
echo "<div class=\"cpbigtitle\" style=\"background-image: url(../images/deco/fixskin.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTFRAMEWORK_MANAGER_FIXSKIN."</strong>
	</div><div class=\"cleared\"></div><br /><br />";
}

switch ($op) 
{	
	case "save_fixskin":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           ixt_redirect("fixskin.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["fixskin_id"])) {
           $obj =& $fixskinHandler->get($_REQUEST["fixskin_id"]);
        } else {
           $obj =& $fixskinHandler->create();
        }
		
		//Form fixskin_name
		$obj->setVar("fixskin_name", $_REQUEST["fixskin_name"]);
		//Form fixskin_submitter
		$obj->setVar("fixskin_submitter", $_REQUEST["fixskin_submitter"]);
		//Form fixskin_date_created
		$obj->setVar("fixskin_date_created", strtotime($_REQUEST["fixskin_date_created"]));
		//Form fixskin_online
		$verif_fixskin_online = ($_REQUEST["fixskin_online"] == 1) ? "1" : "0";
		$obj->setVar("fixskin_online", $verif_fixskin_online);
		
		
        if ($fixskinHandler->insert($obj)) {
           ixt_redirect("fixskin.php?op=show_list_fixskin", 2, _AM_IXTFRAMEWORK_FORMOK);
        }
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_fixskin":
		$obj = $fixskinHandler->get($_REQUEST["fixskin_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_fixskin":
		$obj =& $fixskinHandler->get($_REQUEST["fixskin_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				ixt_redirect("fixskin.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($fixskinHandler->delete($obj)) {
				ixt_redirect("fixskin.php", 3, _AM_IXTFRAMEWORK_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "fixskin_id" => $_REQUEST["fixskin_id"], "op" => "delete_fixskin"), $_SERVER["REQUEST_URI"], sprintf(_AM_IXTFRAMEWORK_FORMSUREDEL, $obj->getVar("fixskin")));
		}
	break;
	
	case "update_online_fixskin":
		
	if (isset($_REQUEST["fixskin_id"])) {
		$obj =& $fixskinHandler->get($_REQUEST["fixskin_id"]);
	} 
	$obj->setVar("fixskin_online", $_REQUEST["fixskin_online"]);

	if ($fixskinHandler->insert($obj)) {
		ixt_redirect("fixskin.php", 3, _AM_IXTFRAMEWORK_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("fixskin_id");
		$criteria->setOrder("ASC");
		$numrows = $fixskinHandler->getCount();
		$fixskin_arr = $fixskinHandler->getall($criteria);
		
			//Affichage du tableau
			if ($numrows>0) 
			{			
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<th align=\"center\">"._AM_IXTFRAMEWORK_FIXSKIN_NAME."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_FIXSKIN_SUBMITTER."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_FIXSKIN_DATE_CREATED."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_FIXSKIN_ONLINE."</th>
						
						<th align=\"center\" width=\"10%\">"._AM_IXTFRAMEWORK_FORMACTION."</th>
					</tr>";
						
				$class = "odd";
				
				foreach (array_keys($fixskin_arr) as $i) 
				{	
					if ( $fixskin_arr[$i]->getVar("topic_pid") == 0)
					{
						$class = ($class == "even") ? "odd" : "even";
						echo "<tr class=\"".$class."\">";
						
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_FIXSKIN_NAME."\">".$fixskin_arr[$i]->getVar("fixskin_name")."</a></td>";	
					
					echo "<td align=\"center\">".XoopsUser::getUnameFromId($fixskin_arr[$i]->getVar("fixskin_submitter"),"S")."</td>";	
					echo "<td align=\"center\">".formatTimeStamp($fixskin_arr[$i]->getVar("fixskin_date_created"),"S")."</td>";	
					
					$online = $fixskin_arr[$i]->getVar("fixskin_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./fixskin.php?op=update_online_fixskin&fixskin_id=".$fixskin_arr[$i]->getVar("fixskin_id")."&fixskin_online=0\" title=\""._AM_IXTFRAMEWORK_ON."\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_ON."\" title=\""._AM_IXTFRAMEWORK_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./fixskin.php?op=update_online_fixskin&fixskin_id=".$fixskin_arr[$i]->getVar("fixskin_id")."&fixskin_online=1\" title=\""._AM_IXTFRAMEWORK_OFF."\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_OFF."\" title=\""._AM_IXTFRAMEWORK_OFF."\"></a></td>";
					}
									echo "<td align=\"center\" width=\"10%\">
										<a style=\"text-decoration:none\" class=\"tooltip\" href=\"fixskin.php?op=edit_fixskin&fixskin_id=".$fixskin_arr[$i]->getVar("fixskin_id")."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"><img src=\"../images/deco/edit.png\" alt=\""._AM_IXTFRAMEWORK_EDIT."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"></a>
										<a style=\"text-decoration:none\" class=\"tooltip\" href=\"fixskin.php?op=delete_fixskin&fixskin_id=".$fixskin_arr[$i]->getVar("fixskin_id")."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"><img src=\"../images/deco/delete.png\" alt=\""._AM_IXTFRAMEWORK_DELETE."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"></a>
									  </td>";
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		
    	$obj =& $fixskinHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
	
?>