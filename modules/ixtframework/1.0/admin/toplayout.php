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
 * Version : 1.03:
 * ****************************************************************************
 */
 
include_once("./header.php");
	
xoops_cp_header();

if (isset($_REQUEST["op"])) {
	$op = $_REQUEST["op"];
} else {
	@$op = "show_list_toplayout";
}

if (!($op == "save_toplayout") && !($op == "update_online_toplayout") && !($op == "delete_toplayout")) {
//Admin menu with support old CMS version
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php") ) {
ixtframework_adminmenu(10, _AM_IXTFRAMEWORK_MANAGER_TOPLAYOUT);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (10, _AM_IXTFRAMEWORK_MANAGER_TOPLAYOUT);
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
</style>";
echo "<div class=\"cpbigtitle\" style=\"background-image: url(../images/deco/assigns.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTFRAMEWORK_MANAGER_TOPLAYOUT."</strong>
	</div><br /><br>";
}
switch ($op) 
{	
	case "save_toplayout":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("toplayout.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["toplayout_id"])) {
           $obj =& $toplayoutHandler->get($_REQUEST["toplayout_id"]);
        } else {
           $obj =& $toplayoutHandler->create();
        }
		
		//Form toplayout_name
		$obj->setVar("toplayout_name", $_REQUEST["toplayout_name"]);
		//Form toplayout_submitter
		$obj->setVar("toplayout_submitter", $_REQUEST["toplayout_submitter"]);
		//Form toplayout_date_created
		$obj->setVar("toplayout_date_created", strtotime($_REQUEST["toplayout_date_created"]));
		//Form toplayout_online
		$verif_toplayout_online = ($_REQUEST["toplayout_online"] == 1) ? "1" : "0";
		$obj->setVar("toplayout_online", $verif_toplayout_online);
		
		
        if ($toplayoutHandler->insert($obj)) {
           redirect_header("toplayout.php?op=show_list_toplayout", 2, _AM_IXTFRAMEWORK_FORMOK);
        }
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_toplayout":
		$obj = $toplayoutHandler->get($_REQUEST["toplayout_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_toplayout":
		$obj =& $toplayoutHandler->get($_REQUEST["toplayout_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("toplayout.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($toplayoutHandler->delete($obj)) {
				redirect_header("toplayout.php", 3, _AM_IXTFRAMEWORK_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "toplayout_id" => $_REQUEST["toplayout_id"], "op" => "delete_toplayout"), $_SERVER["REQUEST_URI"], sprintf(_AM_IXTFRAMEWORK_FORMSUREDEL, $obj->getVar("toplayout")));
		}
	break;
	
	case "update_online_toplayout":
		
	if (isset($_REQUEST["toplayout_id"])) {
		$obj =& $toplayoutHandler->get($_REQUEST["toplayout_id"]);
	} 
	$obj->setVar("toplayout_online", $_REQUEST["toplayout_online"]);

	if ($toplayoutHandler->insert($obj)) {
		redirect_header("toplayout.php", 3, _AM_IXTFRAMEWORK_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("toplayout_id");
		$criteria->setOrder("ASC");
		$numrows = $toplayoutHandler->getCount();
		$toplayout_arr = $toplayoutHandler->getall($criteria);
		
			//Affichage du tableau
			if ($numrows>0) 
			{			
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<th align=\"center\">"._AM_IXTFRAMEWORK_TOPLAYOUT_NAME."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_TOPLAYOUT_SUBMITTER."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_TOPLAYOUT_DATE_CREATED."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_TOPLAYOUT_ONLINE."</th>
						
						<th align=\"center\" width=\"10%\">"._AM_IXTFRAMEWORK_FORMACTION."</th>
					</tr>";
						
				$class = "odd";
				
				foreach (array_keys($toplayout_arr) as $i) 
				{	
					if ( $toplayout_arr[$i]->getVar("topic_pid") == 0)
					{
						$class = ($class == "even") ? "odd" : "even";
						echo "<tr class=\"".$class."\">";
						echo "<td align=\"center\">".$toplayout_arr[$i]->getVar("toplayout_name")."</td>";	
					echo "<td align=\"center\">".XoopsUser::getUnameFromId($toplayout_arr[$i]->getVar("toplayout_submitter"),"S")."</td>";	
					echo "<td align=\"center\">".formatTimeStamp($toplayout_arr[$i]->getVar("toplayout_date_created"),"S")."</td>";	
					
					$online = $toplayout_arr[$i]->getVar("toplayout_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a href=\"./toplayout.php?op=update_online_toplayout&toplayout_id=".$toplayout_arr[$i]->getVar("toplayout_id")."&toplayout_online=0\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_ON."\" title=\""._AM_IXTFRAMEWORK_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a href=\"./toplayout.php?op=update_online_toplayout&toplayout_id=".$toplayout_arr[$i]->getVar("toplayout_id")."&toplayout_online=1\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_OFF."\" title=\""._AM_IXTFRAMEWORK_OFF."\"></a></td>";
					}
									echo "<td align=\"center\" width=\"10%\">
										<a href=\"toplayout.php?op=edit_toplayout&toplayout_id=".$toplayout_arr[$i]->getVar("toplayout_id")."\"><img src=\"../images/deco/edit.png\" alt=\""._AM_IXTFRAMEWORK_EDIT."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"></a>
										<a href=\"toplayout.php?op=delete_toplayout&toplayout_id=".$toplayout_arr[$i]->getVar("toplayout_id")."\"><img src=\"../images/deco/delete.png\" alt=\""._AM_IXTFRAMEWORK_DELETE."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"></a>
									  </td>";
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		
		// Affichage du formulaire
    	$obj =& $toplayoutHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
	
?>