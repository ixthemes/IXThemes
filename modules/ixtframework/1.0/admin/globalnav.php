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
	@$op = "show_list_globalnav";
}

if (!($op == "save_globalnav") && !($op == "update_online_globalnav") && !($op == "delete_globalnav")) {
//Menu admin
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php") ) {
IXTFrameWork_adminmenu(6, _AM_IXTFRAMEWORK_MANAGER_GLOBALNAV);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (6, _AM_IXTFRAMEWORK_MANAGER_GLOBALNAV);
}
//Sous menu
echo "<div class=\"CPbigTitle\" style=\"background-image: url(../images/deco/assigns.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTFRAMEWORK_MANAGER_GLOBALNAV."</strong>
	</div><br /><br>";
}
switch ($op) 
{	
	case "save_globalnav":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("globalnav.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["globalnav_id"])) {
           $obj =& $globalnavHandler->get($_REQUEST["globalnav_id"]);
        } else {
           $obj =& $globalnavHandler->create();
        }
		
		//Form globalnav_name
		$obj->setVar("globalnav_name", $_REQUEST["globalnav_name"]);
		//Form globalnav_submitter
		$obj->setVar("globalnav_submitter", $_REQUEST["globalnav_submitter"]);
		//Form globalnav_date_created
		$obj->setVar("globalnav_date_created", strtotime($_REQUEST["globalnav_date_created"]));
		//Form globalnav_online
		$verif_globalnav_online = ($_REQUEST["globalnav_online"] == 1) ? "1" : "0";
		$obj->setVar("globalnav_online", $verif_globalnav_online);
		
		
        if ($globalnavHandler->insert($obj)) {
           redirect_header("globalnav.php?op=show_list_globalnav", 2, _AM_IXTFRAMEWORK_FORMOK);
        }
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_globalnav":
		$obj = $globalnavHandler->get($_REQUEST["globalnav_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_globalnav":
		$obj =& $globalnavHandler->get($_REQUEST["globalnav_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("globalnav.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($globalnavHandler->delete($obj)) {
				redirect_header("globalnav.php", 3, _AM_IXTFRAMEWORK_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "globalnav_id" => $_REQUEST["globalnav_id"], "op" => "delete_globalnav"), $_SERVER["REQUEST_URI"], sprintf(_AM_IXTFRAMEWORK_FORMSUREDEL, $obj->getVar("globalnav")));
		}
	break;
	
	case "update_online_globalnav":
		
	if (isset($_REQUEST["globalnav_id"])) {
		$obj =& $globalnavHandler->get($_REQUEST["globalnav_id"]);
	} 
	$obj->setVar("globalnav_online", $_REQUEST["globalnav_online"]);

	if ($globalnavHandler->insert($obj)) {
		redirect_header("globalnav.php", 3, _AM_IXTFRAMEWORK_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("globalnav_id");
		$criteria->setOrder("ASC");
		$numrows = $globalnavHandler->getCount();
		$globalnav_arr = $globalnavHandler->getall($criteria);
		
			//Affichage du tableau
			if ($numrows>0) 
			{			
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<th align=\"center\">"._AM_IXTFRAMEWORK_GLOBALNAV_NAME."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_GLOBALNAV_SUBMITTER."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_GLOBALNAV_DATE_CREATED."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_GLOBALNAV_ONLINE."</th>
						
						<th align=\"center\" width=\"10%\">"._AM_IXTFRAMEWORK_FORMACTION."</th>
					</tr>";
						
				$class = "odd";
				
				foreach (array_keys($globalnav_arr) as $i) 
				{	
					if ( $globalnav_arr[$i]->getVar("topic_pid") == 0)
					{
						$class = ($class == "even") ? "odd" : "even";
						echo "<tr class=\"".$class."\">";
						echo "<td align=\"center\">".$globalnav_arr[$i]->getVar("globalnav_name")."</td>";	
					echo "<td align=\"center\">".XoopsUser::getUnameFromId($globalnav_arr[$i]->getVar("globalnav_submitter"),"S")."</td>";	
					echo "<td align=\"center\">".formatTimeStamp($globalnav_arr[$i]->getVar("globalnav_date_created"),"S")."</td>";	
					
					$online = $globalnav_arr[$i]->getVar("globalnav_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a href=\"./globalnav.php?op=update_online_globalnav&globalnav_id=".$globalnav_arr[$i]->getVar("globalnav_id")."&globalnav_online=0\"><img src=\"./../images/deco/on.gif\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_ON."\" title=\""._AM_IXTFRAMEWORK_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a href=\"./globalnav.php?op=update_online_globalnav&globalnav_id=".$globalnav_arr[$i]->getVar("globalnav_id")."&globalnav_online=1\"><img src=\"./../images/deco/off.gif\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_OFF."\" title=\""._AM_IXTFRAMEWORK_OFF."\"></a></td>";
					}
									echo "<td align=\"center\" width=\"10%\">
										<a href=\"globalnav.php?op=edit_globalnav&globalnav_id=".$globalnav_arr[$i]->getVar("globalnav_id")."\"><img src=\"../images/deco/edit.gif\" alt=\""._AM_IXTFRAMEWORK_EDIT."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"></a>
										<a href=\"globalnav.php?op=delete_globalnav&globalnav_id=".$globalnav_arr[$i]->getVar("globalnav_id")."\"><img src=\"../images/deco/delete.gif\" alt=\""._AM_IXTFRAMEWORK_DELETE."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"></a>
									  </td>";
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		
		// Affichage du formulaire
    	$obj =& $globalnavHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
	
?>