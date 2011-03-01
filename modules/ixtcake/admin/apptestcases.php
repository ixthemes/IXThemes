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
 * Version : 1.07:
 * ****************************************************************************
 */
 
include_once("./header.php");
	
xoops_cp_header();

if (isset($_REQUEST["op"])) {
	$op = $_REQUEST["op"];
} else {
	@$op = "show_list_apptestcases";
}

if (!($op == "save_apptestcases") && !($op == "update_online_apptestcases") && !($op == "delete_apptestcases")) {

if (!ixtcake_isrmcommon()) {
	// algalochkin: Admin menu with support old CMS version or icms
	if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
	ixtcake_adminmenu(3, _AM_IXTCAKE_MANAGER_APPTESTCASES);
	} else {
	include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
	loadModuleAdminMenu (3, _AM_IXTCAKE_MANAGER_APPTESTCASES);
	}
	if (class_exists('XoopsPreload')) {
		// since XOOPS 2.4.x
		$xoopsPreload =& XoopsPreload::getInstance();
		$xoopsPreload->triggerEvent('ixtcake.admin');
  $xoopsPreload->triggerEvent('ixtcake.jgrowlredirect');
	}
} else {
 define('RMCLOCATION','apptestcases'); // for menubar item hover
 ixtcake_rmtoolbar();
	echo "
	<link rel=\"stylesheet\" href=\"../css/prettyPhoto.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\" />
	<script type=\"text/javascript\" src=\"../js/jquery.prettyPhoto.js\" charset=\"utf-8\"></script>
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
/*
xoops_error(sprintf(_AM_IXTCAKE_MANAGER_WARNINGFREE, ""));
echo "<br />";
*/

echo "<div class=\"cpbigtitle\" style=\"background-image: url(../images/deco/apptestcases.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTCAKE_MANAGER_APPTESTCASES."</strong>
	</div><div class=\"cleared\"></div><br /><br />";
}

switch ($op) 
{	
	case "save_apptestcases":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
					redirect_header("apptestcases.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
		}
		if (isset($_REQUEST["apptestcases_id"])) {
					$obj =& $apptestcasesHandler->get($_REQUEST["apptestcases_id"]);
		} else {
					$obj =& $apptestcasesHandler->create();
		}
		
		//Form apptestcases_name
		$obj->setVar("apptestcases_name", $_REQUEST["apptestcases_name"]);
		//Form apptestcases_path
		$obj->setVar("apptestcases_path", $_REQUEST["apptestcases_path"]);
		//Form apptestcases_submitter
		$obj->setVar("apptestcases_submitter", $_REQUEST["apptestcases_submitter"]);
		//Form apptestcases_date_created
		$obj->setVar("apptestcases_date_created", strtotime($_REQUEST["apptestcases_date_created"]));
		//Form apptestcases_online
		$verif_apptestcases_online = ($_REQUEST["apptestcases_online"] == 1) ? "1" : "0";
		$obj->setVar("apptestcases_online", $verif_apptestcases_online);
		
		if ($apptestcasesHandler->insert($obj)) {
					redirect_header("apptestcases.php?op=show_list_apptestcases", 2, _AM_IXTCAKE_FORMOK);
		}
		echo $obj->getHtmlErrors();
		$form =& $obj->getForm();
	break;
	
	case "edit_apptestcases":
		$obj = $apptestcasesHandler->get($_REQUEST["apptestcases_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_apptestcases":
		$obj =& $apptestcasesHandler->get($_REQUEST["apptestcases_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("apptestcases.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($apptestcasesHandler->delete($obj)) {
				redirect_header("apptestcases.php", 3, _AM_IXTCAKE_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "apptestcases_id" => $_REQUEST["apptestcases_id"], "op" => "delete_apptestcases"), $_SERVER["REQUEST_URI"], sprintf(_AM_IXTCAKE_FORMSUREDEL, $obj->getVar("apptestcases")));
		}
	break;
	
	case "update_online_apptestcases":
		
	if (isset($_REQUEST["apptestcases_id"])) {
		$obj =& $apptestcasesHandler->get($_REQUEST["apptestcases_id"]);
	} 
	$obj->setVar("apptestcases_online", $_REQUEST["apptestcases_online"]);

	if ($apptestcasesHandler->insert($obj)) {
		redirect_header("apptestcases.php", 3, _AM_IXTCAKE_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("apptestcases_id");
		$criteria->setOrder("ASC");
		$numrows = $apptestcasesHandler->getCount();
        if (class_exists("XoopsPersistableObjectHandler")) {
	 	 $apptestcases_arr = $apptestcasesHandler->getAll($criteria);
		} else {
         // algalochkin : this need for support icms1.2 ONLY
		 $apptestcases_arr = $apptestcasesHandler->getObjects($criteria, false, true);
		}
			if ($numrows>0) 
			{			
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<th align=\"center\">"._AM_IXTCAKE_APPTESTCASES_NAME."</th>
						<th align=\"center\">"._AM_IXTCAKE_APPTESTCASES_PATH."</th>
						<th align=\"center\">"._AM_IXTCAKE_APPTESTCASES_ONLINE."</th>
						
						<th align=\"center\" width=\"10%\">"._AM_IXTCAKE_FORMACTION."</th>
					</tr>";
						
				$class = "odd";
				
				foreach (array_keys($apptestcases_arr) as $i) 
				{	
					if ( $apptestcases_arr[$i]->getVar("topic_pid") == 0)
					{
						$class = ($class == "even") ? "odd" : "even";
						echo "<tr class=\"".$class."\">";
						
					echo "<td align=\"left\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:\" title="._AM_IXTCAKE_APPTESTCASES_NAME.">".$apptestcases_arr[$i]->getVar("apptestcases_name")."</a></td>";	
					
					echo "<td align=\"left\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:\" title="._AM_IXTCAKE_APPTESTCASES_PATH.">".$apptestcases_arr[$i]->getVar("apptestcases_path")."</a></td>";	
					
					$online = $apptestcases_arr[$i]->getVar("apptestcases_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./apptestcases.php?op=update_online_apptestcases&apptestcases_id=".$apptestcases_arr[$i]->getVar("apptestcases_id")."&apptestcases_online=0\" title=\""._AM_IXTCAKE_ON."\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTCAKE_ON."\" title=\""._AM_IXTCAKE_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./apptestcases.php?op=update_online_apptestcases&apptestcases_id=".$apptestcases_arr[$i]->getVar("apptestcases_id")."&apptestcases_online=1\" title=\""._AM_IXTCAKE_OFF."\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTCAKE_OFF."\" title=\""._AM_IXTCAKE_OFF."\"></a></td>";
					}
									echo "<td align=\"center\" width=\"10%\">
										<a style=\"text-decoration:none\" class=\"tooltip\" href=\"apptestcases.php?op=edit_apptestcases&apptestcases_id=".$apptestcases_arr[$i]->getVar("apptestcases_id")."\" title=\""._AM_IXTCAKE_EDIT."\"><img src=\"../images/deco/edit.png\" alt=\""._AM_IXTCAKE_EDIT."\" title=\""._AM_IXTCAKE_EDIT."\"></a>
										<a style=\"text-decoration:none\" class=\"tooltip\" href=\"apptestcases.php?op=delete_apptestcases&apptestcases_id=".$apptestcases_arr[$i]->getVar("apptestcases_id")."\" title=\""._AM_IXTCAKE_DELETE."\"><img src=\"../images/deco/delete.png\" alt=\""._AM_IXTCAKE_DELETE."\" title=\""._AM_IXTCAKE_DELETE."\"></a>
									  </td>";
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		
		// Affichage du formulaire
    	$obj =& $apptestcasesHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";

xoops_cp_footer();
	
?>