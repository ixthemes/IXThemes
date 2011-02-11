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
	@$op = "show_list_fixskin";
}

if (!($op == "save_fixskin") && !($op == "update_online_fixskin") && !($op == "delete_fixskin")) {
//Menu admin
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php") ) {
IXTFrameWork_adminmenu(9, _AM_IXTFRAMEWORK_MANAGER_FIXSKIN);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (9, _AM_IXTFRAMEWORK_MANAGER_FIXSKIN);
}
//Sous menu
echo "<div class=\"CPbigTitle\" style=\"background-image: url(../images/deco/assigns.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTFRAMEWORK_MANAGER_FIXSKIN."</strong>
	</div><br /><br>";
}
switch ($op) 
{	
	case "save_fixskin":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("fixskin.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
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
           redirect_header("fixskin.php?op=show_list_fixskin", 2, _AM_IXTFRAMEWORK_FORMOK);
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
				redirect_header("fixskin.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($fixskinHandler->delete($obj)) {
				redirect_header("fixskin.php", 3, _AM_IXTFRAMEWORK_FORMDELOK);
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
		redirect_header("fixskin.php", 3, _AM_IXTFRAMEWORK_FORMOK);
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
						echo "<td align=\"center\">".$fixskin_arr[$i]->getVar("fixskin_name")."</td>";	
					echo "<td align=\"center\">".XoopsUser::getUnameFromId($fixskin_arr[$i]->getVar("fixskin_submitter"),"S")."</td>";	
					echo "<td align=\"center\">".formatTimeStamp($fixskin_arr[$i]->getVar("fixskin_date_created"),"S")."</td>";	
					
					$online = $fixskin_arr[$i]->getVar("fixskin_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a href=\"./fixskin.php?op=update_online_fixskin&fixskin_id=".$fixskin_arr[$i]->getVar("fixskin_id")."&fixskin_online=0\"><img src=\"./../images/deco/on.gif\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_ON."\" title=\""._AM_IXTFRAMEWORK_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a href=\"./fixskin.php?op=update_online_fixskin&fixskin_id=".$fixskin_arr[$i]->getVar("fixskin_id")."&fixskin_online=1\"><img src=\"./../images/deco/off.gif\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_OFF."\" title=\""._AM_IXTFRAMEWORK_OFF."\"></a></td>";
					}
									echo "<td align=\"center\" width=\"10%\">
										<a href=\"fixskin.php?op=edit_fixskin&fixskin_id=".$fixskin_arr[$i]->getVar("fixskin_id")."\"><img src=\"../images/deco/edit.gif\" alt=\""._AM_IXTFRAMEWORK_EDIT."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"></a>
										<a href=\"fixskin.php?op=delete_fixskin&fixskin_id=".$fixskin_arr[$i]->getVar("fixskin_id")."\"><img src=\"../images/deco/delete.gif\" alt=\""._AM_IXTFRAMEWORK_DELETE."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"></a>
									  </td>";
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		
		// Affichage du formulaire
    	$obj =& $fixskinHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
	
?>