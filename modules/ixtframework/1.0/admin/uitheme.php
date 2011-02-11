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
	@$op = "show_list_uitheme";
}

if (!($op == "save_uitheme") && !($op == "update_online_uitheme") && !($op == "delete_uitheme")) {
//Admin menu with support old CMS version
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php") ) {
ixtframework_adminmenu(8, _AM_IXTFRAMEWORK_MANAGER_UITHEME);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (8, _AM_IXTFRAMEWORK_MANAGER_UITHEME);
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
		<strong>"._AM_IXTFRAMEWORK_MANAGER_UITHEME."</strong>
	</div><br /><br>";
}
switch ($op) 
{	
	case "save_uitheme":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("uitheme.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["uitheme_id"])) {
           $obj =& $uithemeHandler->get($_REQUEST["uitheme_id"]);
        } else {
           $obj =& $uithemeHandler->create();
        }
		
		//Form uitheme_name
		$obj->setVar("uitheme_name", $_REQUEST["uitheme_name"]);
		//Form uitheme_submitter
		$obj->setVar("uitheme_submitter", $_REQUEST["uitheme_submitter"]);
		//Form uitheme_date_created
		$obj->setVar("uitheme_date_created", strtotime($_REQUEST["uitheme_date_created"]));
		//Form uitheme_online
		$verif_uitheme_online = ($_REQUEST["uitheme_online"] == 1) ? "1" : "0";
		$obj->setVar("uitheme_online", $verif_uitheme_online);
		
		
        if ($uithemeHandler->insert($obj)) {
           redirect_header("uitheme.php?op=show_list_uitheme", 2, _AM_IXTFRAMEWORK_FORMOK);
        }
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_uitheme":
		$obj = $uithemeHandler->get($_REQUEST["uitheme_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_uitheme":
		$obj =& $uithemeHandler->get($_REQUEST["uitheme_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("uitheme.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($uithemeHandler->delete($obj)) {
				redirect_header("uitheme.php", 3, _AM_IXTFRAMEWORK_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "uitheme_id" => $_REQUEST["uitheme_id"], "op" => "delete_uitheme"), $_SERVER["REQUEST_URI"], sprintf(_AM_IXTFRAMEWORK_FORMSUREDEL, $obj->getVar("uitheme")));
		}
	break;
	
	case "update_online_uitheme":
		
	if (isset($_REQUEST["uitheme_id"])) {
		$obj =& $uithemeHandler->get($_REQUEST["uitheme_id"]);
	} 
	$obj->setVar("uitheme_online", $_REQUEST["uitheme_online"]);

	if ($uithemeHandler->insert($obj)) {
		redirect_header("uitheme.php", 3, _AM_IXTFRAMEWORK_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("uitheme_id");
		$criteria->setOrder("ASC");
		$numrows = $uithemeHandler->getCount();
		$uitheme_arr = $uithemeHandler->getall($criteria);
		
			//Affichage du tableau
			if ($numrows>0) 
			{			
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<th align=\"center\">"._AM_IXTFRAMEWORK_UITHEME_NAME."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_UITHEME_SUBMITTER."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_UITHEME_DATE_CREATED."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_UITHEME_ONLINE."</th>
						
						<th align=\"center\" width=\"10%\">"._AM_IXTFRAMEWORK_FORMACTION."</th>
					</tr>";
						
				$class = "odd";
				
				foreach (array_keys($uitheme_arr) as $i) 
				{	
					if ( $uitheme_arr[$i]->getVar("topic_pid") == 0)
					{
						$class = ($class == "even") ? "odd" : "even";
						echo "<tr class=\"".$class."\">";
						echo "<td align=\"center\">".$uitheme_arr[$i]->getVar("uitheme_name")."</td>";	
					echo "<td align=\"center\">".XoopsUser::getUnameFromId($uitheme_arr[$i]->getVar("uitheme_submitter"),"S")."</td>";	
					echo "<td align=\"center\">".formatTimeStamp($uitheme_arr[$i]->getVar("uitheme_date_created"),"S")."</td>";	
					
					$online = $uitheme_arr[$i]->getVar("uitheme_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a href=\"./uitheme.php?op=update_online_uitheme&uitheme_id=".$uitheme_arr[$i]->getVar("uitheme_id")."&uitheme_online=0\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_ON."\" title=\""._AM_IXTFRAMEWORK_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a href=\"./uitheme.php?op=update_online_uitheme&uitheme_id=".$uitheme_arr[$i]->getVar("uitheme_id")."&uitheme_online=1\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_OFF."\" title=\""._AM_IXTFRAMEWORK_OFF."\"></a></td>";
					}
									echo "<td align=\"center\" width=\"10%\">
										<a href=\"uitheme.php?op=edit_uitheme&uitheme_id=".$uitheme_arr[$i]->getVar("uitheme_id")."\"><img src=\"../images/deco/edit.png\" alt=\""._AM_IXTFRAMEWORK_EDIT."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"></a>
										<a href=\"uitheme.php?op=delete_uitheme&uitheme_id=".$uitheme_arr[$i]->getVar("uitheme_id")."\"><img src=\"../images/deco/delete.png\" alt=\""._AM_IXTFRAMEWORK_DELETE."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"></a>
									  </td>";
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		
		// Affichage du formulaire
    	$obj =& $uithemeHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
	
?>