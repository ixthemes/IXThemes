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
	@$op = "show_list_wigets";
}

if (!($op == "save_wigets") && !($op == "update_online_wigets") && !($op == "delete_wigets")) {
//Menu admin
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php") ) {
IXTFrameWork_adminmenu(5, _AM_IXTFRAMEWORK_MANAGER_WIGETS);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (5, _AM_IXTFRAMEWORK_MANAGER_WIGETS);
}
//Sous menu
echo "<div class=\"CPbigTitle\" style=\"background-image: url(../images/deco/assigns.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTFRAMEWORK_MANAGER_WIGETS."</strong>
	</div><br /><br>";
}
switch ($op) 
{	
	case "save_wigets":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("wigets.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["wigets_id"])) {
           $obj =& $wigetsHandler->get($_REQUEST["wigets_id"]);
        } else {
           $obj =& $wigetsHandler->create();
        }
		
		//Form wigets_name
		$obj->setVar("wigets_name", $_REQUEST["wigets_name"]);
		//Form wigets_title
		$obj->setVar("wigets_title", $_REQUEST["wigets_title"]);
		//Form wigets_content
		$obj->setVar("wigets_content", $_REQUEST["wigets_content"]);
		//Form wigets_submitter
		$obj->setVar("wigets_submitter", $_REQUEST["wigets_submitter"]);
		//Form wigets_date_created
		$obj->setVar("wigets_date_created", strtotime($_REQUEST["wigets_date_created"]));
		//Form wigets_online
		$verif_wigets_online = ($_REQUEST["wigets_online"] == 1) ? "1" : "0";
		$obj->setVar("wigets_online", $verif_wigets_online);
		
		
        if ($wigetsHandler->insert($obj)) {
           redirect_header("wigets.php?op=show_list_wigets", 2, _AM_IXTFRAMEWORK_FORMOK);
        }
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_wigets":
		$obj = $wigetsHandler->get($_REQUEST["wigets_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_wigets":
		$obj =& $wigetsHandler->get($_REQUEST["wigets_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("wigets.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($wigetsHandler->delete($obj)) {
				redirect_header("wigets.php", 3, _AM_IXTFRAMEWORK_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "wigets_id" => $_REQUEST["wigets_id"], "op" => "delete_wigets"), $_SERVER["REQUEST_URI"], sprintf(_AM_IXTFRAMEWORK_FORMSUREDEL, $obj->getVar("wigets")));
		}
	break;
	
	case "update_online_wigets":
		
	if (isset($_REQUEST["wigets_id"])) {
		$obj =& $wigetsHandler->get($_REQUEST["wigets_id"]);
	} 
	$obj->setVar("wigets_online", $_REQUEST["wigets_online"]);

	if ($wigetsHandler->insert($obj)) {
		redirect_header("wigets.php", 3, _AM_IXTFRAMEWORK_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("wigets_id");
		$criteria->setOrder("ASC");
		$numrows = $wigetsHandler->getCount();
		$wigets_arr = $wigetsHandler->getall($criteria);
		
			//Affichage du tableau
			if ($numrows>0) 
			{			
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<th align=\"center\">"._AM_IXTFRAMEWORK_WIGETS_NAME."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_WIGETS_TITLE."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_WIGETS_CONTENT."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_WIGETS_SUBMITTER."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_WIGETS_DATE_CREATED."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_WIGETS_ONLINE."</th>
						
						<th align=\"center\" width=\"10%\">"._AM_IXTFRAMEWORK_FORMACTION."</th>
					</tr>";
						
				$class = "odd";
				
				foreach (array_keys($wigets_arr) as $i) 
				{	
					if ( $wigets_arr[$i]->getVar("topic_pid") == 0)
					{
						$class = ($class == "even") ? "odd" : "even";
						echo "<tr class=\"".$class."\">";
						echo "<td align=\"center\">".$wigets_arr[$i]->getVar("wigets_name")."</td>";	
					echo "<td align=\"center\">".$wigets_arr[$i]->getVar("wigets_title")."</td>";	
					echo "<td align=\"center\">".$wigets_arr[$i]->getVar("wigets_content")."</td>";	
					echo "<td align=\"center\">".XoopsUser::getUnameFromId($wigets_arr[$i]->getVar("wigets_submitter"),"S")."</td>";	
					echo "<td align=\"center\">".formatTimeStamp($wigets_arr[$i]->getVar("wigets_date_created"),"S")."</td>";	
					
					$online = $wigets_arr[$i]->getVar("wigets_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a href=\"./wigets.php?op=update_online_wigets&wigets_id=".$wigets_arr[$i]->getVar("wigets_id")."&wigets_online=0\"><img src=\"./../images/deco/on.gif\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_ON."\" title=\""._AM_IXTFRAMEWORK_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a href=\"./wigets.php?op=update_online_wigets&wigets_id=".$wigets_arr[$i]->getVar("wigets_id")."&wigets_online=1\"><img src=\"./../images/deco/off.gif\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_OFF."\" title=\""._AM_IXTFRAMEWORK_OFF."\"></a></td>";
					}
									echo "<td align=\"center\" width=\"10%\">
										<a href=\"wigets.php?op=edit_wigets&wigets_id=".$wigets_arr[$i]->getVar("wigets_id")."\"><img src=\"../images/deco/edit.gif\" alt=\""._AM_IXTFRAMEWORK_EDIT."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"></a>
										<a href=\"wigets.php?op=delete_wigets&wigets_id=".$wigets_arr[$i]->getVar("wigets_id")."\"><img src=\"../images/deco/delete.gif\" alt=\""._AM_IXTFRAMEWORK_DELETE."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"></a>
									  </td>";
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		
		// Affichage du formulaire
    	$obj =& $wigetsHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
	
?>