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
 * Version : 1.03:
 * ****************************************************************************
 */
 
include_once("./header.php");
	
xoops_cp_header();

if (isset($_REQUEST["op"])) {
	$op = $_REQUEST["op"];
} else {
	@$op = "show_list_coretestgroups";
}

if (!($op == "save_coretestgroups") && !($op == "update_online_coretestgroups") && !($op == "delete_coretestgroups")) {

// algalochkin: Admin menu with support old CMS version or icms
if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
ixtcake_adminmenu(2, _AM_IXTCAKE_MANAGER_CORETESTGROUPS);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (2, _AM_IXTCAKE_MANAGER_CORETESTGROUPS);
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

/*
$curtheme = $GLOBALS["xoopsConfig"]["theme_set"];

xoops_error(sprintf(_AM_IXTCAKE_MANAGER_WARNINGFREE, ""));
echo "<br />";

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
*/
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

echo "<div class=\"cpbigtitle\" style=\"background-image: url(../images/deco/tests.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTCAKE_MANAGER_CORETESTGROUPS."</strong>
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
	case "save_coretestgroups":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("coretestgroups.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["coretestgroups_id"])) {
           $obj =& $coretestgroupsHandler->get($_REQUEST["coretestgroups_id"]);
        } else {
           $obj =& $coretestgroupsHandler->create();
        }
		
		//Form coretestgroups_name
		$obj->setVar("coretestgroups_name", $_REQUEST["coretestgroups_name"]);
		//Form coretestgroups_path
		$obj->setVar("coretestgroups_path", $_REQUEST["coretestgroups_path"]);
		//Form coretestgroups_submitter
		$obj->setVar("coretestgroups_submitter", $_REQUEST["coretestgroups_submitter"]);
		//Form coretestgroups_date_created
		$obj->setVar("coretestgroups_date_created", strtotime($_REQUEST["coretestgroups_date_created"]));
		//Form coretestgroups_online
		$verif_coretestgroups_online = ($_REQUEST["coretestgroups_online"] == 1) ? "1" : "0";
		$obj->setVar("coretestgroups_online", $verif_coretestgroups_online);
		
		
        if ($coretestgroupsHandler->insert($obj)) {
           redirect_header("coretestgroups.php?op=show_list_coretestgroups", 2, _AM_IXTCAKE_FORMOK);
        }
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_coretestgroups":
		$obj = $coretestgroupsHandler->get($_REQUEST["coretestgroups_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_coretestgroups":
		$obj =& $coretestgroupsHandler->get($_REQUEST["coretestgroups_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("coretestgroups.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($coretestgroupsHandler->delete($obj)) {
				redirect_header("coretestgroups.php", 3, _AM_IXTCAKE_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "coretestgroups_id" => $_REQUEST["coretestgroups_id"], "op" => "delete_coretestgroups"), $_SERVER["REQUEST_URI"], sprintf(_AM_IXTCAKE_FORMSUREDEL, $obj->getVar("coretestgroups")));
		}
	break;
	
	case "update_online_coretestgroups":
		
	if (isset($_REQUEST["coretestgroups_id"])) {
		$obj =& $coretestgroupsHandler->get($_REQUEST["coretestgroups_id"]);
	} 
	$obj->setVar("coretestgroups_online", $_REQUEST["coretestgroups_online"]);

	if ($coretestgroupsHandler->insert($obj)) {
		redirect_header("coretestgroups.php", 3, _AM_IXTCAKE_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("coretestgroups_id");
		$criteria->setOrder("ASC");
		$numrows = $coretestgroupsHandler->getCount();
		$coretestgroups_arr = $coretestgroupsHandler->getall($criteria);
		
			if ($numrows>0) 
			{			
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<th align=\"center\">"._AM_IXTCAKE_CORETESTGROUPS_NAME."</th>
						<th align=\"center\">"._AM_IXTCAKE_CORETESTGROUPS_PATH."</th>
						<th align=\"center\">"._AM_IXTCAKE_CORETESTGROUPS_SUBMITTER."</th>
						<th align=\"center\">"._AM_IXTCAKE_CORETESTGROUPS_DATE_CREATED."</th>
						<th align=\"center\">"._AM_IXTCAKE_CORETESTGROUPS_ONLINE."</th>
						
						<th align=\"center\" width=\"10%\">"._AM_IXTCAKE_FORMACTION."</th>
					</tr>";
						
				$class = "odd";
				
				foreach (array_keys($coretestgroups_arr) as $i) 
				{	
					if ( $coretestgroups_arr[$i]->getVar("topic_pid") == 0)
					{
						$class = ($class == "even") ? "odd" : "even";
						echo "<tr class=\"".$class."\">";
						
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:\" title="._AM_IXTCAKE_CORETESTGROUPS_NAME.">".$coretestgroups_arr[$i]->getVar("coretestgroups_name")."</a></td>";	
					
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:\" title="._AM_IXTCAKE_CORETESTGROUPS_PATH.">".$coretestgroups_arr[$i]->getVar("coretestgroups_path")."</a></td>";	
					
					echo "<td align=\"center\">".XoopsUser::getUnameFromId($coretestgroups_arr[$i]->getVar("coretestgroups_submitter"),"S")."</td>";	
					echo "<td align=\"center\">".formatTimeStamp($coretestgroups_arr[$i]->getVar("coretestgroups_date_created"),"S")."</td>";	
					
					$online = $coretestgroups_arr[$i]->getVar("coretestgroups_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./coretestgroups.php?op=update_online_coretestgroups&coretestgroups_id=".$coretestgroups_arr[$i]->getVar("coretestgroups_id")."&coretestgroups_online=0\" title=\""._AM_IXTCAKE_ON."\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTCAKE_ON."\" title=\""._AM_IXTCAKE_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./coretestgroups.php?op=update_online_coretestgroups&coretestgroups_id=".$coretestgroups_arr[$i]->getVar("coretestgroups_id")."&coretestgroups_online=1\" title=\""._AM_IXTCAKE_OFF."\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTCAKE_OFF."\" title=\""._AM_IXTCAKE_OFF."\"></a></td>";
					}
									echo "<td align=\"center\" width=\"10%\">
										<a style=\"text-decoration:none\" class=\"tooltip\" href=\"coretestgroups.php?op=edit_coretestgroups&coretestgroups_id=".$coretestgroups_arr[$i]->getVar("coretestgroups_id")."\" title=\""._AM_IXTCAKE_EDIT."\"><img src=\"../images/deco/edit.png\" alt=\""._AM_IXTCAKE_EDIT."\" title=\""._AM_IXTCAKE_EDIT."\"></a>
										<a style=\"text-decoration:none\" class=\"tooltip\" href=\"coretestgroups.php?op=delete_coretestgroups&coretestgroups_id=".$coretestgroups_arr[$i]->getVar("coretestgroups_id")."\" title=\""._AM_IXTCAKE_DELETE."\"><img src=\"../images/deco/delete.png\" alt=\""._AM_IXTCAKE_DELETE."\" title=\""._AM_IXTCAKE_DELETE."\"></a>
									  </td>";
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		
		// Affichage du formulaire
    	$obj =& $coretestgroupsHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
	
?>