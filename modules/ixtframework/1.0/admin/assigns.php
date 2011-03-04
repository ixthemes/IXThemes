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
 * Version : 1.05:
 * ****************************************************************************
 */
 
include_once("./header.php");
	
xoops_cp_header();

if (isset($_REQUEST["op"])) {
	$op = $_REQUEST["op"];
} else {
	@$op = "show_list_assigns";
}

if (ixtframework_isrmcommon() || !(class_exists('XoopsPreload'))) {
// impresscms 1.2 or rmcommon utilities
echo "
<link rel=\"stylesheet\" href=\"../css/prettyPhoto.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\" />
<link rel=\"stylesheet\" href=\"../css/jgrowl.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\" />
<link rel=\"stylesheet\" href=\"../css/tooltip.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\" />
<script type=\"text/javascript\" src=\"../js/jquery.prettyPhoto.js\" charset=\"utf-8\"></script>
<script type=\"text/javascript\" src=\"../js/jquery.jgrowl.js\" charset=\"utf-8\"></script>
<script type=\"text/javascript\" src=\"../js/tooltip.js\" charset=\"utf-8\"></script>
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

echo "<style>
/* Correction RMCommon GUI for required elements in XOOPS form */
div.xoops-form-element-caption .caption-marker { display:none; }
div.xoops-form-element-caption-required .caption-marker {	background-color:inherit;	padding-left:2px;	color:#ff0000; }
/* Correction for icms default theme */
div#icms-page { padding-left:0; margin-left:0; width:98%; }
div#icms-content { padding-left:0; margin-left:0; width:100%; }
span {line-height:1;}
</style>
";
} else {
	if (class_exists('XoopsPreload')) {
	 // since XOOPS 2.4.x
	 $xoopsPreload =& XoopsPreload::getInstance();
	 $xoopsPreload->triggerEvent('ixtframework.admin');
	 $xoopsPreload->triggerEvent('ixtframework.jgrowlredirect');
	}
}

if (!($op == "save_assigns") && !($op == "update_online_assigns") && !($op == "delete_assigns")) {

if (!ixtframework_isrmcommon()) {
	// algalochkin: Admin menu with support old CMS version or icms
	if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
	ixtframework_adminmenu(1, _AM_IXTFRAMEWORK_MANAGER_ASSIGNS);
	} else {
	include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
	loadModuleAdminMenu (1, _AM_IXTFRAMEWORK_MANAGER_ASSIGNS);
	}
} else {
 define('RMCLOCATION','assigns'); // for menubar item hover
 ixtframework_rmtoolbar();
}

echo "<style>
.cpbigtitle{ float:left; width:95%; font-size: 20px; color: #1E90FF; background: no-repeat left top; font-weight: bold; height: 50px; vertical-align: middle; padding: 10px 0 0 50px; border-bottom: 3px solid #1E90FF; }
.cleared { float: none; clear: both; margin: 0; padding: 0; border: none; font-size: 1px; }
fieldset {margin: .5em;padding: 1em;border: 1px solid #333;color: #000;background-color: #f0f0f0;-moz-border-radius: 6px;-webkit-border-radius: 6px;-khtml-border-radius: 6px;border-radius: 6px;}
legend {padding: .5em;font-size: 1.1em;font-weight: bolder;}
label, .caption-text {margin-bottom: .5em;padding-right: .5em;font-weight: bold;}
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

/* current selected theme on user side */
$curtheme = $GLOBALS["xoopsConfig"]["theme_set"];

$criteria = new CriteriaCompo();
$criteria->add(new Criteria("assigns_online", 1));
$criteria->setSort("assigns_date_created");
$criteria->setOrder("DESC");
$criteria->setLimit(1);
if (class_exists("XoopsPersistableObjectHandler")) {
 $curassigns_arr = $assignsHandler->getall($criteria);
} else {
 // algalochkin : this need for support icms1.2 ONLY
 $curassigns_arr = $assignsHandler->getObjects($criteria, false, true);
}
foreach (array_keys($curassigns_arr) as $i) {
	$curactassignsn = $curassigns_arr[$i]->getVar("assigns_name");
}

//xoops_error(sprintf(_AM_IXTFRAMEWORK_MANAGER_WARNINGFREE, ""));
//echo "<br />";

/* list only allowed themes */
echo "<div class=\"cleared\"></div><br />";
$themesallowed = $GLOBALS["xoopsConfig"]["theme_set_allowed"];
if (!(is_file(XOOPS_THEME_PATH . "/" . $curtheme . "/tpl/assigns.html"))) {
    xoops_error(sprintf(_AM_IXTFRAMEWORK_MANAGER_WARNINGNOTIXTTHEME, $curtheme));
} elseif (!(is_file(XOOPS_THEME_PATH . "/" . $curtheme."/xoplugins/ixt09.php"))) {
    xoops_error(sprintf(_AM_IXTFRAMEWORK_MANAGER_WARNINGNOTIXTTHEME4, $curtheme));
} else {
	if ($curactassignsn) {
     xoops_error(sprintf(_AM_IXTFRAMEWORK_MANAGER_WARNINGDEFASSIGNS, $curactassignsn));
	}
}

// since 2.4.0 release jQuery included in xoops and load in HTML-header
// ixtSTART ifjQuery
if ((is_file(XOOPS_TRUST_PATH . "/Frameworks/jquery/jquery.js"))) {
	$ifjquery = 1;
}
// ixtFINISH ifjQuery

echo "<div class=\"cpbigtitle\" style=\"background-image: url(../images/deco/assigns.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_IXTFRAMEWORK_MANAGER_ASSIGNS."</strong>
	</div><div class=\"cleared\"></div><br /><br />";
}

switch ($op) 
{	
	case "save_assigns":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           ixt_redirect("assigns.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["assigns_id"])) {
           $obj =& $assignsHandler->get($_REQUEST["assigns_id"]);
        } else {
           $obj =& $assignsHandler->create();
        }
		
		//Form assigns_name
		$obj->setVar("assigns_name", $_REQUEST["assigns_name"]);
		//Form assigns_scrolblocks
		$obj->setVar("assigns_scrolblocks", $_REQUEST["assigns_scrolblocks"]);
		//Form assigns_slblocks: Blocks for slideshow
		$obj->setVar("assigns_slblocks", $_REQUEST["assigns_slblocks"]);
		//Form assigns_jsenable
		$verif_assigns_jsenable = ($_REQUEST["assigns_jsenable"] == 1) ? "1" : "0";
		$obj->setVar("assigns_jsenable", $verif_assigns_jsenable);
		//Form assigns_globalnav
		$obj->setVar("assigns_globalnav", $_REQUEST["assigns_globalnav"]);
		//Form assigns_widecontent
		$verif_assigns_widecontent = ($_REQUEST["assigns_widecontent"] == 1) ? "1" : "0";
		$obj->setVar("assigns_widecontent", $verif_assigns_widecontent);
		//Form assigns_preheader
		$obj->setVar("assigns_preheader", $_REQUEST["assigns_preheader"]);
		//Form assigns_extheader
		$verif_assigns_extheader = ($_REQUEST["assigns_extheader"] == 1) ? "1" : "0";
		$obj->setVar("assigns_extheader", $verif_assigns_extheader);
		//Form assigns_headerrss
		$verif_assigns_headerrss = ($_REQUEST["assigns_headerrss"] == 1) ? "1" : "0";
		$obj->setVar("assigns_headerrss", $verif_assigns_headerrss);
		//Form assigns_slides
		$obj->setVar("assigns_slides", $_REQUEST["assigns_slides"]);
		//Form assigns_layout
		$obj->setVar("assigns_layout", $_REQUEST["assigns_layout"]);
		//Form assigns_w0
// in the future releases		
//		$obj->setVar("assigns_w0", $_REQUEST["assigns_w0"]);
		$obj->setVar("assigns_w0", 55);
		//Form assigns_w1
// in the future releases		
//		$obj->setVar("assigns_w1", $_REQUEST["assigns_w1"]);
		$obj->setVar("assigns_w1", 75);
		//Form assigns_w2
// in the future releases		
//		$obj->setVar("assigns_w2", $_REQUEST["assigns_w2"]);
		$obj->setVar("assigns_w2", 80);
		//Form assigns_logos	
		include_once XOOPS_ROOT_PATH."/class/uploader.php";
		$uploaddir_assigns_logos = XOOPS_ROOT_PATH."/uploads/ixtframework/assigns/assigns_logos/";
		$uploader_assigns_logos = new XoopsMediaUploader($uploaddir_assigns_logos, $xoopsModuleConfig["assigns_logos_mimetypes"], $xoopsModuleConfig["assigns_logos_size"], null, null);

		if ($uploader_assigns_logos->fetchMedia("assigns_logos")) {
			$uploader_assigns_logos->setPrefix("assigns_logos_") ;
			$uploader_assigns_logos->fetchMedia("assigns_logos");
			if (!$uploader_assigns_logos->upload()) {
				$errors = $uploader_assigns_logos->getErrors();
				ixt_redirect("javascript:history.go(-1)",3, $errors);
			} else {
				$obj->setVar("assigns_logos", $uploader_assigns_logos->getSavedFileName());
			}
		} else {
			$obj->setVar("assigns_logos", $_REQUEST["assigns_logos"]);
		}
		//Form assigns_logow
		$obj->setVar("assigns_logow", $_REQUEST["assigns_logow"]);
		//Form assigns_logoh
		$obj->setVar("assigns_logoh", $_REQUEST["assigns_logoh"]);
		//Form assigns_ctrl0
		$verif_assigns_ctrl0 = ($_REQUEST["assigns_ctrl0"] == 1) ? "1" : "0";
		$obj->setVar("assigns_ctrl0", $verif_assigns_ctrl0);
		//Form assigns_ctrl1
		$verif_assigns_ctrl1 = ($_REQUEST["assigns_ctrl1"] == 1) ? "1" : "0";
		$obj->setVar("assigns_ctrl1", $verif_assigns_ctrl1);
		//Form assigns_ctrl2
		$verif_assigns_ctrl2 = ($_REQUEST["assigns_ctrl2"] == 1) ? "1" : "0";
		$obj->setVar("assigns_ctrl2", $verif_assigns_ctrl2);
		//Form assigns_ctrl3
		$verif_assigns_ctrl3 = ($_REQUEST["assigns_ctrl3"] == 1) ? "1" : "0";
		$obj->setVar("assigns_ctrl3", $verif_assigns_ctrl3);
		//Form assigns_extfooter
		$verif_assigns_extfooter = ($_REQUEST["assigns_extfooter"] == 1) ? "1" : "0";
		$obj->setVar("assigns_extfooter", $verif_assigns_extfooter);
		//Form assigns_ehblock
		$obj->setVar("assigns_ehblock", $_REQUEST["assigns_ehblock"]);
		//Form assigns_efblocks0
		$obj->setVar("assigns_efblocks0", $_REQUEST["assigns_efblocks0"]);
		//Form assigns_efblocks1
		$obj->setVar("assigns_efblocks1", $_REQUEST["assigns_efblocks1"]);
		//Form assigns_efblocks2
		$obj->setVar("assigns_efblocks2", $_REQUEST["assigns_efblocks2"]);
		//Form assigns_efblocks3
		$obj->setVar("assigns_efblocks3", $_REQUEST["assigns_efblocks3"]);
		//Form assigns_wblocks1
		$obj->setVar("assigns_wblocks1", $_REQUEST["assigns_wblocks1"]);
		//Form assigns_wblocks2
		$obj->setVar("assigns_wblocks2", $_REQUEST["assigns_wblocks2"]);
		//Form assigns_footerrss
		$verif_assigns_footerrss = ($_REQUEST["assigns_footerrss"] == 1) ? "1" : "0";
		$obj->setVar("assigns_footerrss", $verif_assigns_footerrss);
		//Form assigns_uitheme
		$obj->setVar("assigns_uitheme", $_REQUEST["assigns_uitheme"]);
		//Form assigns_multiskin
		$verif_assigns_multiskin = ($_REQUEST["assigns_multiskin"] == 1) ? "1" : "0";
		$obj->setVar("assigns_multiskin", $verif_assigns_multiskin);
		//Form assigns_fixskin
		$obj->setVar("assigns_fixskin", $_REQUEST["assigns_fixskin"]);
		//Form assigns_blconcat
		$verif_assigns_blconcat = ($_REQUEST["assigns_blconcat"] == 1) ? "1" : "0";
		$obj->setVar("assigns_blconcat", $verif_assigns_blconcat);
		//Form assigns_sb1style
		$verif_assigns_sb1style = ($_REQUEST["assigns_sb1style"] == 1) ? "1" : "0";
		$obj->setVar("assigns_sb1style", $verif_assigns_sb1style);
		//Form assigns_sb2style
		$verif_assigns_sb2style = ($_REQUEST["assigns_sb2style"] == 1) ? "1" : "0";
		$obj->setVar("assigns_sb2style", $verif_assigns_sb2style);
		//Form assigns_eftstyle
		$verif_assigns_eftstyle = ($_REQUEST["assigns_eftstyle"] == 1) ? "1" : "0";
		$obj->setVar("assigns_eftstyle", $verif_assigns_eftstyle);
		//Form assigns_sysbstyle
		$verif_assigns_sysbstyle = ($_REQUEST["assigns_sysbstyle"] == 1) ? "1" : "0";
		$obj->setVar("assigns_sysbstyle", $verif_assigns_sysbstyle);
		//Form assigns_wide1style
		$verif_assigns_wide1style = ($_REQUEST["assigns_wide1style"] == 1) ? "1" : "0";
		$obj->setVar("assigns_wide1style", $verif_assigns_wide1style);
		//Form assigns_wide2style
		$verif_assigns_wide2style = ($_REQUEST["assigns_wide2style"] == 1) ? "1" : "0";
		$obj->setVar("assigns_wide2style", $verif_assigns_wide2style);
		//Form assigns_rtl
		$verif_assigns_rtl = ($_REQUEST["assigns_rtl"] == 1) ? "1" : "0";
		$obj->setVar("assigns_rtl", $verif_assigns_rtl);
		//Form assigns_content_top_order
		$obj->setVar("assigns_content_top_order", $_REQUEST["assigns_content_top_order"]);
		//Form assigns_content_bottom_order
		$obj->setVar("assigns_content_bottom_order", $_REQUEST["assigns_content_bottom_order"]);
		//Form assigns_submitter
		$obj->setVar("assigns_submitter", $_REQUEST["assigns_submitter"]);
		//Form assigns_date_created
		$obj->setVar("assigns_date_created", strtotime($_REQUEST["assigns_date_created"]));
		//Form assigns_online
		$verif_assigns_online = ($_REQUEST["assigns_online"] == 1) ? "1" : "0";
		$obj->setVar("assigns_online", $verif_assigns_online);
		
        if ($assignsHandler->insert($obj)) {
           ixt_redirect("assigns.php?op=show_list_assigns", 2, _AM_IXTFRAMEWORK_FORMOK);
        }
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_assigns":
		$obj = $assignsHandler->get($_REQUEST["assigns_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_assigns":
		$obj =& $assignsHandler->get($_REQUEST["assigns_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				ixt_redirect("assigns.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($assignsHandler->delete($obj)) {
				ixt_redirect("assigns.php", 3, _AM_IXTFRAMEWORK_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "assigns_id" => $_REQUEST["assigns_id"], "op" => "delete_assigns"), $_SERVER["REQUEST_URI"], sprintf(_AM_IXTFRAMEWORK_FORMSUREDEL, $obj->getVar("assigns")));
		}
	break;
	
	case "update_online_assigns":
		
	if (isset($_REQUEST["assigns_id"])) {
		$obj =& $assignsHandler->get($_REQUEST["assigns_id"]);
	} 
	$obj->setVar("assigns_online", $_REQUEST["assigns_online"]);

	if ($assignsHandler->insert($obj)) {
		ixt_redirect("assigns.php", 3, _AM_IXTFRAMEWORK_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("assigns_id");
		$criteria->setOrder("ASC");
		$numrows = $assignsHandler->getCount();
		if (class_exists("XoopsPersistableObjectHandler")) {
		 $assigns_arr = $assignsHandler->getall($criteria);
		} else {
		 // algalochkin : this need for support icms1.2 ONLY
		 $assigns_arr = $assignsHandler->getObjects($criteria, false, true);
		}
		
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria("assigns_online", 1));
		$criteria->setSort("assigns_date_created");
		$criteria->setOrder("DESC");
        $criteria->setLimit(1);
		if (class_exists("XoopsPersistableObjectHandler")) {
		 $curassigns_arr = $assignsHandler->getall($criteria);
		} else {
		 // algalochkin : this need for support icms1.2 ONLY
		 $curassigns_arr = $assignsHandler->getObjects($criteria, false, true);
		}
		foreach (array_keys($curassigns_arr) as $i) {
 		$curactassigns = $curassigns_arr[$i]->getVar("assigns_id");
		}
		
			if ($numrows>0) 
			{			
   if (ixtframework_isrmcommon()) {
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<th rowspan=\"6\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_NAME."</th>
						<th rowspan=\"6\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_ONLINE."</th>
						<th rowspan=\"6\" align=\"center\">"._AM_IXTFRAMEWORK_FORMACTION."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_SCROLBLOCKS."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_SLBLOCKS."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_JSENABLE."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_GLOBALNAV."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_WIDECONTENT."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_PREHEADER."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EXTHEADER."</th>
					</tr>
					<tr>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_HEADERRSS."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_SLIDES."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_LAYOUT."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_W0."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_W1."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_W2."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_LOGOS."</th>
					</tr>
					<tr>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_LOGOW."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_LOGOH."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_CTRL0."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_CTRL1."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_CTRL2."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_CTRL3."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EXTFOOTER."</th>
					</tr>
					<tr>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EHBLOCK."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS0."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS1."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS2."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS3."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_WBLOCKS1."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_WBLOCKS2."</th>
					</tr>
					<tr>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_FOOTERRSS."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_UITHEME."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_MULTISKIN."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_FIXSKIN."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_BLCONCAT."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_SB1STYLE."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_SB2STYLE."</th>
					</tr>
					<tr>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EFTSTYLE."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_SYSBSTYLE."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_WIDE1STYLE."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_WIDE2STYLE."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_RTL."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_CONTENT_TOP_ORDER."</th>
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_CONTENT_BOTTOM_ORDER."</th>
<!--
						<th align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_DATE_CREATED."</th>
-->
					</tr>";
			} else {
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<td class=\"head\" rowspan=\"6\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_NAME."</td>
						<td class=\"head\" rowspan=\"6\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_ONLINE."</td>
						<td class=\"head\" rowspan=\"6\" align=\"center\">"._AM_IXTFRAMEWORK_FORMACTION."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_SCROLBLOCKS."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_SLBLOCKS."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_JSENABLE."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_GLOBALNAV."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_WIDECONTENT."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_PREHEADER."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EXTHEADER."</td>
					</tr>
					<tr>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_HEADERRSS."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_SLIDES."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_LAYOUT."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_W0."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_W1."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_W2."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_LOGOS."</td>
					</tr>
					<tr>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_LOGOW."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_LOGOH."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_CTRL0."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_CTRL1."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_CTRL2."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_CTRL3."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EXTFOOTER."</td>
					</tr>
					<tr>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EHBLOCK."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS0."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS1."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS2."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS3."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_WBLOCKS1."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_WBLOCKS2."</td>
					</tr>
					<tr>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_FOOTERRSS."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_UITHEME."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_MULTISKIN."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_FIXSKIN."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_BLCONCAT."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_SB1STYLE."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_SB2STYLE."</td>
					</tr>
					<tr>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_EFTSTYLE."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_SYSBSTYLE."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_WIDE1STYLE."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_WIDE2STYLE."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_RTL."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_CONTENT_TOP_ORDER."</td>
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_CONTENT_BOTTOM_ORDER."</td>
<!--
						<td class=\"head\" align=\"center\">"._AM_IXTFRAMEWORK_ASSIGNS_DATE_CREATED."</td>
-->
					</tr>";
			}
						
				$class = "odd";
				
				foreach (array_keys($assigns_arr) as $i) 
				{	
					if ( $assigns_arr[$i]->getVar("topic_pid") == 0)
					{
						
$class = (($class == "even") || ($class == "mark")) ? "odd" : "even";
if ($assigns_arr[$i]->getVar("assigns_id") == $curactassigns) {
	$class = "mark";
}
						echo "<tr class=\"".$class."\">";

if ($class == "mark") {
echo "<td rowspan=\"6\" align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\"Current Assigns Style\">".$assigns_arr[$i]->getVar("assigns_name")."</a></td>";	
} else {
echo "<td rowspan=\"6\" align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_NAME."\">".$assigns_arr[$i]->getVar("assigns_name")."</a></td>";	
}

					$online = $assigns_arr[$i]->getVar("assigns_online");
					if( $online == 1 ) {
						echo "<td rowspan=\"6\" align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./assigns.php?op=update_online_assigns&assigns_id=".$assigns_arr[$i]->getVar("assigns_id")."&assigns_online=0\" title=\""._AM_IXTFRAMEWORK_ON."\"><img src=\"./../images/deco/1.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_ON."\" title=\""._AM_IXTFRAMEWORK_ON."\" /></a></td>";	
					} else {
						echo "<td rowspan=\"6\" align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"./assigns.php?op=update_online_assigns&assigns_id=".$assigns_arr[$i]->getVar("assigns_id")."&assigns_online=1\" title=\""._AM_IXTFRAMEWORK_OFF."\"><img src=\"./../images/deco/0.png\" border=\"0\" alt=\""._AM_IXTFRAMEWORK_OFF."\" title=\""._AM_IXTFRAMEWORK_OFF."\" /></a></td>";
					}
					
     echo "<td rowspan=\"6\" align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"assigns.php?op=edit_assigns&assigns_id=".$assigns_arr[$i]->getVar("assigns_id")."\" title=\""._AM_IXTFRAMEWORK_EDIT."\"><img src=\"../images/deco/edit.png\" alt=\""._AM_IXTFRAMEWORK_EDIT."\" title=\""._AM_IXTFRAMEWORK_EDIT."\" /></a><br /><a style=\"text-decoration:none\" class=\"tooltip\" href=\"assigns.php?op=delete_assigns&assigns_id=".$assigns_arr[$i]->getVar("assigns_id")."\" title="._AM_IXTFRAMEWORK_DELETE."><img src=\"../images/deco/delete.png\" alt=\""._AM_IXTFRAMEWORK_DELETE."\" title=\""._AM_IXTFRAMEWORK_DELETE."\" /></a></td>";
					
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_SCROLBLOCKS."\">".$assigns_arr[$i]->getVar("assigns_scrolblocks")."</a></td>";	

					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_SLBLOCKS."\">".$assigns_arr[$i]->getVar("assigns_slblocks")."</a></td>";	
					
					$verif_assigns_jsenable = ( $assigns_arr[$i]->getVar("assigns_jsenable") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_JSENABLE."\">".$verif_assigns_jsenable."</a></td>";	
					
					$verif_assigns_globalnav =& $globalnavHandler->get($assigns_arr[$i]->getVar("assigns_globalnav"));
     $title_globalnav = $verif_assigns_globalnav->getVar("globalnav_name");
     echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_GLOBALNAV."\">".$title_globalnav."</a></td>";	
					
					$verif_assigns_widecontent = ( $assigns_arr[$i]->getVar("assigns_widecontent") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_WIDECONTENT."\">".$verif_assigns_widecontent."</a></td>";	
					
					$verif_assigns_preheader =& $preheaderHandler->get($assigns_arr[$i]->getVar("assigns_preheader"));
     $title_preheader = $verif_assigns_preheader->getVar("preheader_name");
     echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_PREHEADER."\">".$title_preheader."</a></td>";	
					
					$verif_assigns_extheader = ( $assigns_arr[$i]->getVar("assigns_extheader") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_EXTHEADER."\">".$verif_assigns_extheader."</a></td>";	
					
echo "</tr>";
echo "<tr class=\"".$class."\">";

					$verif_assigns_headerrss = ( $assigns_arr[$i]->getVar("assigns_headerrss") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_HEADERRSS."\">".$verif_assigns_headerrss."</a></td>";	

					$verif_assigns_slides =& $slidesHandler->get($assigns_arr[$i]->getVar("assigns_slides"));
     $title_slides = $verif_assigns_slides->getVar("slides_name");
     echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_SLIDES."\">".$title_slides."</a></td>";	
					
					$verif_assigns_layout =& $pagelayoutHandler->get($assigns_arr[$i]->getVar("assigns_layout"));
     $title_pagelayout = $verif_assigns_layout->getVar("pagelayout_name");
     echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_LAYOUT."\">".$title_pagelayout."</a></td>";	
					
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_W0."\">".$assigns_arr[$i]->getVar("assigns_w0")."</a></td>";	
					
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_W1."\">".$assigns_arr[$i]->getVar("assigns_w1")."</a></td>";	
					
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_W2."\">".$assigns_arr[$i]->getVar("assigns_w2")."</a></td>";	

					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_LOGOS."\"><img src=\"".XOOPS_URL."/uploads/ixtframework/assigns/assigns_logos/".$assigns_arr[$i]->getVar("assigns_logos")."\" height=\"30px\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_LOGOS."\" /></a></td>";	

echo "</tr>";
echo "<tr class=\"".$class."\">";

                    echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_LOGOW."\">".$assigns_arr[$i]->getVar("assigns_logow")."</a></td>";	

					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_LOGOH."\">".$assigns_arr[$i]->getVar("assigns_logoh")."</a></td>";	
					
					$verif_assigns_ctrl0 = ( $assigns_arr[$i]->getVar("assigns_ctrl0") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_CTRL0."\">".$verif_assigns_ctrl0."</a></td>";	
					
					$verif_assigns_ctrl1 = ( $assigns_arr[$i]->getVar("assigns_ctrl1") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_CTRL1."\">".$verif_assigns_ctrl1."</a></td>";	
					
					$verif_assigns_ctrl2 = ( $assigns_arr[$i]->getVar("assigns_ctrl2") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_CTRL2."\">".$verif_assigns_ctrl2."</a></td>";	

					$verif_assigns_ctrl3 = ( $assigns_arr[$i]->getVar("assigns_ctrl3") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_CTRL3."\">".$verif_assigns_ctrl3."</a></td>";	
					
					$verif_assigns_extfooter = ( $assigns_arr[$i]->getVar("assigns_extfooter") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_EXTFOOTER."\">".$verif_assigns_extfooter."</a></td>";	
					
echo "</tr>";
echo "<tr class=\"".$class."\">";

					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_EHBLOCK."\">".$assigns_arr[$i]->getVar("assigns_ehblock")."</a></td>";	

					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS0."\">".$assigns_arr[$i]->getVar("assigns_efblocks0")."</a></td>";	
					
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS1."\">".$assigns_arr[$i]->getVar("assigns_efblocks1")."</a></td>";	
					
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS2."\">".$assigns_arr[$i]->getVar("assigns_efblocks2")."</a></td>";	
					
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS3."\">".$assigns_arr[$i]->getVar("assigns_efblocks3")."</a></td>";	
					
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_WBLOCKS1."\">".$assigns_arr[$i]->getVar("assigns_wblocks1")."</a></td>";	
					
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_WBLOCKS2."\">".$assigns_arr[$i]->getVar("assigns_wblocks2")."</a></td>";	
					
echo "</tr>";
echo "<tr class=\"".$class."\">";

					$verif_assigns_footerrss = ( $assigns_arr[$i]->getVar("assigns_footerrss") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_FOOTERRSS."\">".$verif_assigns_footerrss."</a></td>";	

					$verif_assigns_uitheme =& $uithemeHandler->get($assigns_arr[$i]->getVar("assigns_uitheme"));
     $title_uitheme = $verif_assigns_uitheme->getVar("uitheme_name");
     echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_UITHEME."\">".$title_uitheme."</a></td>";	

					$verif_assigns_multiskin = ( $assigns_arr[$i]->getVar("assigns_multiskin") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_MULTISKIN."\">".$verif_assigns_multiskin."</a></td>";	
					
					$verif_assigns_fixskin =& $fixskinHandler->get($assigns_arr[$i]->getVar("assigns_fixskin"));
     $title_fixskin = $verif_assigns_fixskin->getVar("fixskin_name");
     echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_FIXSKIN."\">".$title_fixskin."</a></td>";	
					
					$verif_assigns_blconcat = ( $assigns_arr[$i]->getVar("assigns_blconcat") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_BLCONCAT."\">".$verif_assigns_blconcat."</a></td>";	
					
					$verif_assigns_sb1style = ( $assigns_arr[$i]->getVar("assigns_sb1style") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_SB1STYLE."\">".$verif_assigns_sb1style."</a></td>";	
					
					$verif_assigns_sb2style = ( $assigns_arr[$i]->getVar("assigns_sb2style") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_SB2STYLE."\">".$verif_assigns_sb2style."</a></td>";	
					
echo "</tr>";
echo "<tr class=\"".$class."\">";

					$verif_assigns_eftstyle = ( $assigns_arr[$i]->getVar("assigns_eftstyle") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_EFTSTYLE."\">".$verif_assigns_eftstyle."</a></td>";	

					$verif_assigns_sysbstyle = ( $assigns_arr[$i]->getVar("assigns_sysbstyle") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_SYSBSTYLE."\">".$verif_assigns_sysbstyle."</a></td>";	

					$verif_assigns_wide1style = ( $assigns_arr[$i]->getVar("assigns_wide1style") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_WIDE1STYLE."\">".$verif_assigns_wide1style."</a></td>";	
					
					$verif_assigns_wide2style = ( $assigns_arr[$i]->getVar("assigns_wide2style") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title="._AM_IXTFRAMEWORK_ASSIGNS_WIDE2STYLE."\">".$verif_assigns_wide2style."</a></td>";	
					
					$verif_assigns_rtl = ( $assigns_arr[$i]->getVar("assigns_rtl") == 1 ) ? "yes" : "no";
					echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_RTL."\">".$verif_assigns_rtl."</a></td>";	
					
					$verif_assigns_content_top_order =& $toplayoutHandler->get($assigns_arr[$i]->getVar("assigns_content_top_order"));
     $title_toplayout = $verif_assigns_content_top_order->getVar("toplayout_name");
     echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_CONTENT_TOP_ORDER."\">".$title_toplayout."</a></td>";	
					
					$verif_assigns_content_bottom_order =& $botlayoutHandler->get($assigns_arr[$i]->getVar("assigns_content_bottom_order"));
     $title_botlayout = $verif_assigns_content_bottom_order->getVar("botlayout_name");
     echo "<td align=\"center\"><a style=\"text-decoration:none\" class=\"tooltip\" href=\"javascript:void(0);\" title=\""._AM_IXTFRAMEWORK_ASSIGNS_CONTENT_BOTTOM_ORDER."\">".$title_botlayout."</a></td>";	
					
//					echo "<td align=\"center\">".XoopsUser::getUnameFromId($assigns_arr[$i]->getVar("assigns_submitter"),"S")."</td>";	
//					echo "<td align=\"center\">".formatTimeStamp($assigns_arr[$i]->getVar("assigns_date_created"),"S")."</td>";	
					
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		
		// Affichage du formulaire
    	$obj =& $assignsHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://ixthemes.org\" target=\"_blank\"><img width=\"120px\" src=\"http://ixthemes.org/images/logo.png\" alt=\"IXThemes\" title=\"IXThemes\"></a></div>
";
xoops_cp_footer();
	
?>