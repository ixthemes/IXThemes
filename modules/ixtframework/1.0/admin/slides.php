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
	@$op = "show_list_slides";
}

if (!($op == "save_slides") && !($op == "update_online_slides") && !($op == "delete_slides")) {
//Admin menu with support old CMS version
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php") ) {
ixtframework_adminmenu(2, _AM_IXTFRAMEWORK_MANAGER_SLIDES);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (2, _AM_IXTFRAMEWORK_MANAGER_SLIDES);
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
		<strong>"._AM_IXTFRAMEWORK_MANAGER_SLIDES."</strong>
	</div><br /><br>";
}
switch ($op) 
{	
	case "save_slides":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("slides.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["slides_id"])) {
           $obj =& $slidesHandler->get($_REQUEST["slides_id"]);
        } else {
           $obj =& $slidesHandler->create();
        }
		
		//Form slides_name
		$obj->setVar("slides_name", $_REQUEST["slides_name"]);
		//Form slides_submitter
		$obj->setVar("slides_submitter", $_REQUEST["slides_submitter"]);
		//Form slides_date_created
		$obj->setVar("slides_date_created", strtotime($_REQUEST["slides_date_created"]));
		//Form slides_online
		$verif_slides_online = ($_REQUEST["slides_online"] == 1) ? "1" : "0";
		$obj->setVar("slides_online", $verif_slides_online);
		
		
        if ($slidesHandler->insert($obj)) {
           redirect_header("slides.php?op=show_list_slides", 2, _AM_IXTFRAMEWORK_FORMOK);
        }
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_slides":
		$obj = $slidesHandler->get($_REQUEST["slides_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_slides":
		$obj =& $slidesHandler->get($_REQUEST["slides_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("slides.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($slidesHandler->delete($obj)) {
				redirect_header("slides.php", 3, _AM_IXTFRAMEWORK_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "slides_id" => $_REQUEST["slides_id"], "op" => "delete_slides"), $_SERVER["REQUEST_URI"], sprintf(_AM_IXTFRAMEWORK_FORMSUREDEL, $obj->getVar("slides")));
		}
	break;
	
	case "update_online_slides":
		
	if (isset($_REQUEST["slides_id"])) {
		$obj =& $slidesHandler->get($_REQUEST["slides_id"]);
	} 
	$obj->setVar("slides_online", $_REQUEST["slides_online"]);

	if ($slidesHandler->insert($obj)) {
		redirect_header("slides.php", 3, _AM_IXTFRAMEWORK_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("slides_id");
		$criteria->setOrder("ASC");
		$numrows = $slidesHandler->getCount();
		$slides_arr = $slidesHandler->getall($criteria);
		
			//Affichage du tableau
			if ($numrows>0) 
			{			
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<th align=\"center\">"._AM_IXTFRAMEWORK_SLIDES_NAME."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_SLIDES_SUBMITTER."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_SLIDES_DATE_CREATED."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_SLIDES_ONLINE."</th>
						
						<th align=\"center\" width=\"10%\">"._AM_IXTFRAMEWORK_FORMACTION."</th>
					</tr>";
						
				$class = "odd";
				
				foreach (array_keys($slides_arr) as $i) 
				{	
					if ( $slides_arr[$i]->getVar("topic_pid") == 0)
					{
						$class = ($class == "even") ? "odd" : "even";
						echo "<tr class=\"".$class."\">";
						echo "<td align=\"center\">".$slides_arr[$i]->getVar("slides_name")."</td>";	
					echo "<td align=\"center\">".XoopsUser::getUnameFromId($slides_arr[$i]->getVar("slides_submitter"),"S")."</td>";	
					echo "<td align=\"center\">".formatTimeStamp($slides_arr[$i]->getVar("slides_date_created"),"S")."</td>";	
					
					$online = $slides_arr[$i]->getVar("slides_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a href=\"./slides.php?op=update_online_slides&slides_id=".$slides_arr[$i]->getVar("slides_id")."&slides_online=0\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_ON."\" title=\""._AM_IXTFRAMEWORK_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a href=\"./slides.php?op=update_online_slides&slides_id=".$slides_arr[$i]->getVar("slides_id")."&slides_online=1\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_OFF."\" title=\""._AM_IXTFRAMEWORK_OFF."\"></a></td>";
					}
									echo "<td align=\"center\" width=\"10%\">
										<a href=\"slides.php?op=edit_slides&slides_id=".$slides_arr[$i]->getVar("slides_id")."\"><img src=\"../images/deco/edit.png\" alt=\""._AM_IXTFRAMEWORK_EDIT."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"></a>
										<a href=\"slides.php?op=delete_slides&slides_id=".$slides_arr[$i]->getVar("slides_id")."\"><img src=\"../images/deco/delete.png\" alt=\""._AM_IXTFRAMEWORK_DELETE."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"></a>
									  </td>";
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		
		// Affichage du formulaire
    	$obj =& $slidesHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
	
?>