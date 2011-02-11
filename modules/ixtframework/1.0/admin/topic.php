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
	@$op = "show_list_topic";
}

if (!($op == "save_topic") && !($op == "update_online_topic") && !($op == "delete_topic")) {
//Admin menu with support old CMS version
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php") ) {
ixtframework_adminmenu(3, _AM_IXTFRAMEWORK_MANAGER_TOPIC);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (3, _AM_IXTFRAMEWORK_MANAGER_TOPIC);
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
echo "<div class=\"cpbigtitle\" style=\"background-image: url(../images/deco/topic.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTFRAMEWORK_MANAGER_TOPIC."</strong>
	</div><br /><br>";
}
switch ($op) 
{	
	case "save_topic":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("topic.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["topic_id"])) {
           $obj =& $topicHandler->get($_REQUEST["topic_id"]);
        } else {
           $obj =& $topicHandler->create();
        }
		
		//Form topic_pid
		$obj->setVar("topic_pid", $_REQUEST["topic_pid"]);
		//Form topic_title
		$obj->setVar("topic_title", $_REQUEST["topic_title"]);
		//Form topic_desc
		$obj->setVar("topic_desc", $_REQUEST["topic_desc"]);
		//Form topic_img	
		include_once XOOPS_ROOT_PATH."/class/uploader.php";
		$uploaddir_topic_img = XOOPS_ROOT_PATH."/uploads/ixtframework/topic/topic_img/";
		$uploader_topic_img = new XoopsMediaUploader($uploaddir_topic_img, $xoopsModuleConfig["topic_img_mimetypes"], $xoopsModuleConfig["topic_img_size"], null, null);

		if ($uploader_topic_img->fetchMedia("topic_img")) {
			$uploader_topic_img->setPrefix("topic_img_") ;
			$uploader_topic_img->fetchMedia("topic_img");
			if (!$uploader_topic_img->upload()) {
				$errors = $uploader_topic_img->getErrors();
				redirect_header("javascript:history.go(-1)",3, $errors);
			} else {
				$obj->setVar("topic_img", $uploader_topic_img->getSavedFileName());
			}
		} else {
			$obj->setVar("topic_img", $_REQUEST["topic_img"]);
		}
		//Form topic_weight
		$obj->setVar("topic_weight", $_REQUEST["topic_weight"]);
		//Form topic_color
		$obj->setVar("topic_color", $_REQUEST["topic_color"]);
		//Form topic_submitter
		$obj->setVar("topic_submitter", $_REQUEST["topic_submitter"]);
		//Form topic_date_created
		$obj->setVar("topic_date_created", strtotime($_REQUEST["topic_date_created"]));
		//Form topic_online
		$verif_topic_online = ($_REQUEST["topic_online"] == 1) ? "1" : "0";
		$obj->setVar("topic_online", $verif_topic_online);
		
		
        if ($topicHandler->insert($obj)) {
           redirect_header("topic.php?op=show_list_topic", 2, _AM_IXTFRAMEWORK_FORMOK);
        }
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_topic":
		$obj = $topicHandler->get($_REQUEST["topic_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_topic":
		$obj =& $topicHandler->get($_REQUEST["topic_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("topic.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($topicHandler->delete($obj)) {
				redirect_header("topic.php", 3, _AM_IXTFRAMEWORK_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "topic_id" => $_REQUEST["topic_id"], "op" => "delete_topic"), $_SERVER["REQUEST_URI"], sprintf(_AM_IXTFRAMEWORK_FORMSUREDEL, $obj->getVar("topic")));
		}
	break;
	
	case "update_online_topic":
		
	if (isset($_REQUEST["topic_id"])) {
		$obj =& $topicHandler->get($_REQUEST["topic_id"]);
	} 
	$obj->setVar("topic_online", $_REQUEST["topic_online"]);

	if ($topicHandler->insert($obj)) {
		redirect_header("topic.php", 3, _AM_IXTFRAMEWORK_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("topic_id");
		$criteria->setOrder("ASC");
		$numrows = $topicHandler->getCount();
		$topic_arr = $topicHandler->getall($criteria);
		
			//Fonction qui permet afficher les catégories enfants
			function ixtframework_display_children($topic_id = 0, $topic_arr, $prefix = "", $order = "", &$class) 
			{   
				$topicHandler =& xoops_getModuleHandler("ixtframework_topic", "ixtframework");
				$prefix = $prefix."<img src=\"".XOOPS_URL."/modules/ixtframework/images/deco/arrow.gif\">";
				foreach (array_keys($topic_arr) as $i) 
				{
					$topic_id = $topic_arr[$i]->getVar("topic_id");
					$topic_img = $topic_arr[$i]->getVar("topic_img");
					$topic_title = $topic_arr[$i]->getVar("topic_title");
					$topic_weight = $topic_arr[$i]->getVar("topic_weight");
					echo "<tr class=\"".$class."\">";
					echo "<td align=\"left\">".$prefix."&nbsp;".$topic_arr[$i]->getVar("topic_title")."</td>";	
						echo "<td align=\"center\"><img src=\"".XOOPS_URL."/uploads/ixtframework/topic/topic_img/".$topic_arr[$i]->getVar("topic_img")."\" height=\"30px\" title=\"topic_img\" alt=\"topic_img\"></td>";	
					echo "<td align=\"center\">".$topic_arr[$i]->getVar("topic_weight")."</td>";	
					echo "<td align=\"center\"><span style=\"background-color:".$topic_arr[$i]->getVar("topic_color")."\">&nbsp;&nbsp;&nbsp;</span> -> ".$topic_arr[$i]->getVar("topic_color")."</td>";	
					
					$online = $topic_arr[$i]->getVar("topic_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a href=\"./topic.php?op=update_online_topic&topic_id=".$topic_arr[$i]->getVar("topic_id")."&topic_online=0\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_ON."\" title=\""._AM_IXTFRAMEWORK_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a href=\"./topic.php?op=update_online_topic&topic_id=".$topic_arr[$i]->getVar("topic_id")."&topic_online=1\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_OFF."\" title=\""._AM_IXTFRAMEWORK_OFF."\"></a></td>";
					}
								echo "<td align=\"center\" width=\"10%\">
									<a href=\"topic.php?op=edit_topic&topic_id=".$topic_arr[$i]->getVar("topic_id")."\"><img src=\"../images/deco/edit.png\" alt=\""._AM_IXTFRAMEWORK_EDIT."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"></a>
									<a href=\"topic.php?op=delete_topic&topic_id=".$topic_arr[$i]->getVar("topic_id")."\"><img src=\"../images/deco/delete.png\" alt=\""._AM_IXTFRAMEWORK_DELETE."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"></a>
								</td>                 
						</tr>";
					$class = ($class == "even") ? "odd" : "even";
					$criteria = new CriteriaCompo();
					$criteria->add(new Criteria("topic_pid", $topic_arr[$i]->getVar("topic_id")));
					$criteria->setSort("topic_title");
					$criteria->setOrder("ASC");
					$topic_pid = $topicHandler->getall($criteria);
					$num_pid = $topicHandler->getCount();
					if ( $num_pid != 0 )
					{
						ixtframework_display_children($topic_id, $topic_pid, $prefix, $order, $class);
					}
				}
			}

			//Affichage du tableau
			if ($numrows>0) 
			{
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
						<tr>
						<th align=\"center\">"._AM_IXTFRAMEWORK_TOPIC_TITLE."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_TOPIC_IMG."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_TOPIC_WEIGHT."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_TOPIC_COLOR."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_TOPIC_ONLINE."</th>
						
							<th align=\"center\" width=\"10%\">"._AM_IXTFRAMEWORK_FORMACTION."</th>		
						</tr>";
				$class = "odd";
				$prefix = "<img src=\"".XOOPS_URL."/modules/ixtframework/images/deco/arrow.gif\">";
				foreach (array_keys($topic_arr) as $i) 
				{               
					if ( $topic_arr[$i]->getVar("topic_pid") == 0 )
					{                    
						$topic_id = $topic_arr[$i]->getVar("topic_id");
						$topic_img = $topic_arr[$i]->getVar("topic_img");
						$topic_title = $topic_arr[$i]->getVar("topic_title");
						$topic_weight = $topic_arr[$i]->getVar("topic_weight");
						echo "<tr class=\"".$class."\">";
						echo "<td align=\"left\">".$prefix."&nbsp;".$topic_arr[$i]->getVar("topic_title")."</td>";	
						echo "<td align=\"center\"><img src=\"".XOOPS_URL."/uploads/ixtframework/topic/topic_img/".$topic_arr[$i]->getVar("topic_img")."\" height=\"30px\" title=\"topic_img\" alt=\"topic_img\"></td>";	
					echo "<td align=\"center\">".$topic_arr[$i]->getVar("topic_weight")."</td>";	
					echo "<td align=\"center\"><span style=\"background-color:".$topic_arr[$i]->getVar("topic_color")."\">&nbsp;&nbsp;&nbsp;</span> -> ".$topic_arr[$i]->getVar("topic_color")."</td>";	
					
					$online = $topic_arr[$i]->getVar("topic_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a href=\"./topic.php?op=update_online_topic&topic_id=".$topic_arr[$i]->getVar("topic_id")."&topic_online=0\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_ON."\" title=\""._AM_IXTFRAMEWORK_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a href=\"./topic.php?op=update_online_topic&topic_id=".$topic_arr[$i]->getVar("topic_id")."&topic_online=1\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_OFF."\" title=\""._AM_IXTFRAMEWORK_OFF."\"></a></td>";
					}
								echo "<td align=\"center\" width=\"10%\">
									<a href=\"topic.php?op=edit_topic&topic_id=".$topic_arr[$i]->getVar("topic_id")."\"><img src=\"../images/deco/edit.png\" alt=\""._AM_IXTFRAMEWORK_EDIT."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"></a>
									<a href=\"topic.php?op=delete_topic&topic_id=".$topic_arr[$i]->getVar("topic_id")."\"><img src=\"../images/deco/delete.png\" alt=\""._AM_IXTFRAMEWORK_DELETE."\" title=\""._AM_IXTFRAMEWORK_DELETE."\"></a>
								</td>                 
						</tr>";
						$class = ($class == "even") ? "odd" : "even";
						$criteria = new CriteriaCompo();
						$criteria->add(new Criteria("topic_pid", $topic_id));
						$criteria->setSort("topic_title");
						$criteria->setOrder("ASC");
						$topic_pid = $topicHandler->getall($criteria);
						$num_pid = $topicHandler->getCount();
						
						if ( $num_pid != 0)
						{
							ixtframework_display_children($topic_id, $topic_pid, $prefix, "topic_title", $class);
						}
					}
				}
				echo "</table><br><br>";
			}
		
		// Affichage du formulaire
    	$obj =& $topicHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
	
?>