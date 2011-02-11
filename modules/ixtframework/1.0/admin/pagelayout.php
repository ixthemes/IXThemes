<?php
/**
 * IXTFrameWork - MODULE FOR XOOPS AND IMPRESS CMS
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
 * @package         IXTFrameWork
 * @author          IXThemes Project (http://ixthemes.org)
 *
 * Version : 1.00:
 * ****************************************************************************
 */
 
include_once("./header.php");
	
xoops_cp_header();

if (isset($_REQUEST["op"])) {
	$op = $_REQUEST["op"];
} else {
	@$op = "show_list_pagelayout";
}

if (!($op == "save_pagelayout") && !($op == "update_online_pagelayout") && !($op == "delete_pagelayout")) {
//Menu admin
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php") ) {
IXTFrameWork_adminmenu(1, _AM_IXTFRAMEWORK_MANAGER_PAGELAYOUT);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (1, _AM_IXTFRAMEWORK_MANAGER_PAGELAYOUT);
}
//Sous menu
echo "<div class=\"CPbigTitle\" style=\"background-image: url(../images/deco/assigns.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTFRAMEWORK_MANAGER_PAGELAYOUT."</strong>
	</div><br /><br>";
}
switch ($op) 
{	
	case "save_pagelayout":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("pagelayout.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["pagelayout_id"])) {
           $obj =& $pagelayoutHandler->get($_REQUEST["pagelayout_id"]);
        } else {
           $obj =& $pagelayoutHandler->create();
        }
		
		//Form pagelayout_name
		$obj->setVar("pagelayout_name", $_REQUEST["pagelayout_name"]);
		//Form pagelayout_submitter
		$obj->setVar("pagelayout_submitter", $_REQUEST["pagelayout_submitter"]);
		//Form pagelayout_date_created
		$obj->setVar("pagelayout_date_created", strtotime($_REQUEST["pagelayout_date_created"]));
		//Form pagelayout_online
		$verif_pagelayout_online = ($_REQUEST["pagelayout_online"] == 1) ? "1" : "0";
		$obj->setVar("pagelayout_online", $verif_pagelayout_online);
		
		
        if ($pagelayoutHandler->insert($obj)) {
           redirect_header("pagelayout.php?op=show_list_pagelayout", 2, _AM_IXTFRAMEWORK_FORMOK);
        }
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_pagelayout":
		$obj = $pagelayoutHandler->get($_REQUEST["pagelayout_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_pagelayout":
		$obj =& $pagelayoutHandler->get($_REQUEST["pagelayout_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("pagelayout.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($pagelayoutHandler->delete($obj)) {
				redirect_header("pagelayout.php", 3, _AM_IXTFRAMEWORK_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "pagelayout_id" => $_REQUEST["pagelayout_id"], "op" => "delete_pagelayout"), $_SERVER["REQUEST_URI"], sprintf(_AM_IXTFRAMEWORK_FORMSUREDEL, $obj->getVar("pagelayout")));
		}
	break;
	
	case "update_online_pagelayout":
		
	if (isset($_REQUEST["pagelayout_id"])) {
		$obj =& $pagelayoutHandler->get($_REQUEST["pagelayout_id"]);
	} 
	$obj->setVar("pagelayout_online", $_REQUEST["pagelayout_online"]);

	if ($pagelayoutHandler->insert($obj)) {
		redirect_header("pagelayout.php", 3, _AM_IXTFRAMEWORK_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("pagelayout_id");
		$criteria->setOrder("ASC");
		$numrows = $pagelayoutHandler->getCount();
		$pagelayout_arr = $pagelayoutHandler->getall($criteria);
		
			//Affichage du tableau
			if ($numrows>0) 
			{			
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<th align=\"center\">"._AM_IXTFRAMEWORK_PAGELAYOUT_NAME."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_PAGELAYOUT_SUBMITTER."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_PAGELAYOUT_DATE_CREATED."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_PAGELAYOUT_ONLINE."</th>
						
						<th align=\"center\" width=\"10%\">"._AM_IXTFRAMEWORK_FORMACTION."</th>
					</tr>";
						
				$class = "odd";
				
				foreach (array_keys($pagelayout_arr) as $i) 
				{	
					if ( $pagelayout_arr[$i]->getVar("topic_pid") == 0)
					{
						$class = ($class == "even") ? "odd" : "even";
						echo "<tr class=\"".$class."\">";
						echo "<td align=\"center\">".$pagelayout_arr[$i]->getVar("pagelayout_name")."</td>";	
					echo "<td align=\"center\">".XoopsUser::getUnameFromId($pagelayout_arr[$i]->getVar("pagelayout_submitter"),"S")."</td>";	
					echo "<td align=\"center\">".formatTimeStamp($pagelayout_arr[$i]->getVar("pagelayout_date_created"),"S")."</td>";	
					
					$online = $pagelayout_arr[$i]->getVar("pagelayout_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a href=\"./pagelayout.php?op=update_online_pagelayout&pagelayout_id=".$pagelayout_arr[$i]->getVar("pagelayout_id")."&pagelayout_online=0\"><img src=\"./../images/deco/on.gif\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_ON."\" title=\""._AM_IXTFRAMEWORK_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a href=\"./pagelayout.php?op=update_online_pagelayout&pagelayout_id=".$pagelayout_arr[$i]->getVar("pagelayout_id")."&pagelayout_online=1\"><img src=\"./../images/deco/off.gif\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_OFF."\" title=\""._AM_IXTFRAMEWORK_OFF."\"></a></td>";
					}
									echo "<td align=\"center\" width=\"10%\">
										<a href=\"pagelayout.php?op=edit_pagelayout&pagelayout_id=".$pagelayout_arr[$i]->getVar("pagelayout_id")."\"><img src=\"../images/deco/edit.gif\" alt=\""._AM_IXTFRAMEWORK_EDIT."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"></a>
										<a href=\"pagelayout.php?op=delete_pagelayout&pagelayout_id=".$pagelayout_arr[$i]->getVar("pagelayout_id")."\"><img src=\"../images/deco/delete.gif\" alt=\""._AM_IXTFRAMEWORK_DELETE."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"></a>
									  </td>";
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		
		// Affichage du formulaire
    	$obj =& $pagelayoutHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
	
?>