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
 * Version : 1.04:
 * ****************************************************************************
 */
 
include_once("./header.php");
	
xoops_cp_header();

if (isset($_REQUEST["op"])) {
	$op = $_REQUEST["op"];
} else {
	@$op = "show_list_apptestgroups";
}

if (!($op == "save_apptestgroups") && !($op == "update_online_apptestgroups") && !($op == "delete_apptestgroups")) {

// algalochkin: Admin menu with support old CMS version or icms
if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
ixtcake_adminmenu(1, _AM_IXTCAKE_MANAGER_APPTESTGROUPS);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (1, _AM_IXTCAKE_MANAGER_APPTESTGROUPS);
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

/* current default theme */
$curtheme = $GLOBALS["xoopsConfig"]["theme_set"];

xoops_error(sprintf(_AM_IXTCAKE_MANAGER_WARNINGFREE, ""));
echo "<br />";

/* list only allowed themes */
$themesallowed = $GLOBALS["xoopsConfig"]["theme_set_allowed"];
if (!(is_file(XOOPS_THEME_PATH . "/" . $curtheme . "/tpl/assigns.html"))) {
    xoops_error(sprintf(_AM_IXTCAKE_MANAGER_WARNINGNOTIXTTHEME, $curtheme));
    echo "<br />";
} elseif (!(is_file(XOOPS_THEME_PATH . "/" . $curtheme."/xoplugins/ixt09.php"))) {
    xoops_error(sprintf(_AM_IXTCAKE_MANAGER_WARNINGNOTIXTTHEME4, $curtheme));
    echo "<br />";
} else {
    xoops_error(sprintf(_AM_IXTCAKE_MANAGER_WARNINGDEFTHEME1, $curtheme));
    echo "<br />";
}

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

echo "<div class=\"cpbigtitle\" style=\"background-image: url(../images/deco/apptestgroups.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTCAKE_MANAGER_APPTESTGROUPS."</strong>
	</div><br /><br>";
}
echo "<style>
/* Correction RMCommon GUI for required elements in XOOPS form */
div.xoops-form-element-caption .caption-marker { display:none; }
div.xoops-form-element-caption-required .caption-marker {	background-color:inherit;	padding-left:2px;	color:#ff0000; }
</style>
";

switch ($op) 
{	
	case "save_apptestgroups":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("apptestgroups.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["apptestgroups_id"])) {
           $obj =& $apptestgroupsHandler->get($_REQUEST["apptestgroups_id"]);
        } else {
           $obj =& $apptestgroupsHandler->create();
        }
		
		//Form apptestgroups_name
		$obj->setVar("apptestgroups_name", $_REQUEST["apptestgroups_name"]);
		//Form apptestgroups_path
		$obj->setVar("apptestgroups_path", $_REQUEST["apptestgroups_path"]);
		//Form apptestgroups_submitter
		$obj->setVar("apptestgroups_submitter", $_REQUEST["apptestgroups_submitter"]);
		//Form apptestgroups_date_created
		$obj->setVar("apptestgroups_date_created", strtotime($_REQUEST["apptestgroups_date_created"]));
		//Form apptestgroups_online
		$verif_apptestgroups_online = ($_REQUEST["apptestgroups_online"] == 1) ? "1" : "0";
		$obj->setVar("apptestgroups_online", $verif_apptestgroups_online);
		
		
        if ($apptestgroupsHandler->insert($obj)) {
           redirect_header("apptestgroups.php?op=show_list_apptestgroups", 2, _AM_IXTCAKE_FORMOK);
        }
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_apptestgroups":
		$obj = $apptestgroupsHandler->get($_REQUEST["apptestgroups_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_apptestgroups":
		$obj =& $apptestgroupsHandler->get($_REQUEST["apptestgroups_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("apptestgroups.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($apptestgroupsHandler->delete($obj)) {
				redirect_header("apptestgroups.php", 3, _AM_IXTCAKE_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "apptestgroups_id" => $_REQUEST["apptestgroups_id"], "op" => "delete_apptestgroups"), $_SERVER["REQUEST_URI"], sprintf(_AM_IXTCAKE_FORMSUREDEL, $obj->getVar("apptestgroups")));
		}
	break;
	
	case "update_online_apptestgroups":
		
	if (isset($_REQUEST["apptestgroups_id"])) {
		$obj =& $apptestgroupsHandler->get($_REQUEST["apptestgroups_id"]);
	} 
	$obj->setVar("apptestgroups_online", $_REQUEST["apptestgroups_online"]);

	if ($apptestgroupsHandler->insert($obj)) {
		redirect_header("apptestgroups.php", 3, _AM_IXTCAKE_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("apptestgroups_id");
		$criteria->setOrder("ASC");
		$numrows = $apptestgroupsHandler->getCount();
		$apptestgroups_arr = $apptestgroupsHandler->getall($criteria);
		
			if ($numrows>0) 
			{			
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<th align=\"center\">"._AM_IXTCAKE_APPTESTGROUPS_NAME."</th>
						<th align=\"center\">"._AM_IXTCAKE_APPTESTGROUPS_PATH."</th>
						<th align=\"center\">"._AM_IXTCAKE_APPTESTGROUPS_SUBMITTER."</th>
						<th align=\"center\">"._AM_IXTCAKE_APPTESTGROUPS_DATE_CREATED."</th>
						<th align=\"center\">"._AM_IXTCAKE_APPTESTGROUPS_ONLINE."</th>
						
						<th align=\"center\" width=\"10%\">"._AM_IXTCAKE_FORMACTION."</th>
					</tr>";
						
				$class = "odd";
				
				foreach (array_keys($apptestgroups_arr) as $i) 
				{	
					if ( $apptestgroups_arr[$i]->getVar("topic_pid") == 0)
					{
						$class = ($class == "even") ? "odd" : "even";
						echo "<tr class=\"".$class."\">";
						
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:\" title="._AM_IXTCAKE_APPTESTGROUPS_NAME.">".$apptestgroups_arr[$i]->getVar("apptestgroups_name")."</a></td>";	
					
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:\" title="._AM_IXTCAKE_APPTESTGROUPS_PATH.">".$apptestgroups_arr[$i]->getVar("apptestgroups_path")."</a></td>";	
					
					echo "<td align=\"center\">".XoopsUser::getUnameFromId($apptestgroups_arr[$i]->getVar("apptestgroups_submitter"),"S")."</td>";	
					echo "<td align=\"center\">".formatTimeStamp($apptestgroups_arr[$i]->getVar("apptestgroups_date_created"),"S")."</td>";	
					
					$online = $apptestgroups_arr[$i]->getVar("apptestgroups_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./apptestgroups.php?op=update_online_apptestgroups&apptestgroups_id=".$apptestgroups_arr[$i]->getVar("apptestgroups_id")."&apptestgroups_online=0\" title=\""._AM_IXTCAKE_ON."\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTCAKE_ON."\" title=\""._AM_IXTCAKE_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./apptestgroups.php?op=update_online_apptestgroups&apptestgroups_id=".$apptestgroups_arr[$i]->getVar("apptestgroups_id")."&apptestgroups_online=1\" title=\""._AM_IXTCAKE_OFF."\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTCAKE_OFF."\" title=\""._AM_IXTCAKE_OFF."\"></a></td>";
					}
									echo "<td align=\"center\" width=\"10%\">
										<a style=\"text-decoration:none\" class=\"tooltip\" href=\"apptestgroups.php?op=edit_apptestgroups&apptestgroups_id=".$apptestgroups_arr[$i]->getVar("apptestgroups_id")."\" title=\""._AM_IXTCAKE_EDIT."\"><img src=\"../images/deco/edit.png\" alt=\""._AM_IXTCAKE_EDIT."\" title=\""._AM_IXTCAKE_EDIT."\"></a>
										<a style=\"text-decoration:none\" class=\"tooltip\" href=\"apptestgroups.php?op=delete_apptestgroups&apptestgroups_id=".$apptestgroups_arr[$i]->getVar("apptestgroups_id")."\" title=\""._AM_IXTCAKE_DELETE."\"><img src=\"../images/deco/delete.png\" alt=\""._AM_IXTCAKE_DELETE."\" title=\""._AM_IXTCAKE_DELETE."\"></a>
									  </td>";
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		
		// Affichage du formulaire
    	$obj =& $apptestgroupsHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
	
?>