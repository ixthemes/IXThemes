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
 
	
	if (!defined("XOOPS_ROOT_PATH")) {
		die("XOOPS root path not defined");
	}

	if (!class_exists("XoopsPersistableObjectHandler")) {
		include_once XOOPS_ROOT_PATH."/modules/IXTFrameWork/class/object.php";
	}

	class ixtframework_assigns extends XoopsObject
	{ 
		//Constructor
		function __construct()
		{
			$this->XoopsObject();
			$this->initVar("assigns_id",XOBJ_DTYPE_INT,null,false,8);
			$this->initVar("assigns_name",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("assigns_scrolblocks",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("assigns_jsenable",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_globalnav",XOBJ_DTYPE_INT,null,false, 1);
			$this->initVar("assigns_widecontent",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_preheader",XOBJ_DTYPE_INT,null,false, 1);
			$this->initVar("assigns_extheader",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_headerrss",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_slides",XOBJ_DTYPE_INT,null,false, 2);
			$this->initVar("assigns_layout",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_w0",XOBJ_DTYPE_INT,null,false,2);
			$this->initVar("assigns_w1",XOBJ_DTYPE_INT,null,false,2);
			$this->initVar("assigns_w2",XOBJ_DTYPE_INT,null,false,2);
			$this->initVar("assigns_logos",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("assigns_logow",XOBJ_DTYPE_INT,null,false,3);
			$this->initVar("assigns_logoh",XOBJ_DTYPE_INT,null,false,3);
			$this->initVar("assigns_ctrl0",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_ctrl1",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_ctrl2",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_extfooter",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_ehblock",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("assigns_efblocks0",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("assigns_efblocks1",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("assigns_efblocks2",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("assigns_efblocks3",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("assigns_wblocks1",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("assigns_wblocks2",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("assigns_footerrss",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_uitheme",XOBJ_DTYPE_INT,null,false, 2);
			$this->initVar("assigns_multiskin",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_fixskin",XOBJ_DTYPE_INT,null,false, 2);
			$this->initVar("assigns_blconcat",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_sb1style",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_sb2style",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_eftstyle",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_sysbstyle",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_wide1style",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_wide2style",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_rtl",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("assigns_content_top_order",XOBJ_DTYPE_INT,null,false, 1);
			$this->initVar("assigns_content_bottom_order",XOBJ_DTYPE_INT,null,false, 1);
			$this->initVar("assigns_submitter",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("assigns_date_created",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("assigns_online",XOBJ_DTYPE_INT,null,false,1);
			
			// Pour autoriser le html
			$this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
			
		}

		function ixtframework_assigns()
		{
			$this->__construct();
		}
	
		function getForm($action = false)
		{
			global $xoopsDB, $xoopsModuleConfig;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf(_AM_IXTFRAMEWORK_ASSIGNS_ADD) : sprintf(_AM_IXTFRAMEWORK_ASSIGNS_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra('enctype="multipart/form-data"');
			
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_ASSIGNS_NAME, "assigns_name", 50, 255, $this->getVar("assigns_name")), true);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_ASSIGNS_SCROLBLOCKS, "assigns_scrolblocks", 50, 255, $this->getVar("assigns_scrolblocks")), false);
			 $assigns_jsenable = $this->isNew() ? 1 : $this->getVar("assigns_jsenable");
			$check_assigns_jsenable = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_JSENABLE, "assigns_jsenable", $assigns_jsenable);
			$check_assigns_jsenable->addOption(1, " ");
			$form->addElement($check_assigns_jsenable);
			
			$globalnavHandler =& xoops_getModuleHandler("IXTFrameWork_globalnav", "IXTFrameWork");
			$globalnav_select = new XoopsFormSelect(_AM_IXTFRAMEWORK_ASSIGNS_GLOBALNAV, "assigns_globalnav", $this->getVar("assigns_globalnav"));
			$globalnav_select->addOptionArray($globalnavHandler->getList());
			$form->addElement($globalnav_select, true);
			 $assigns_widecontent = $this->isNew() ? 1 : $this->getVar("assigns_widecontent");
			$check_assigns_widecontent = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_WIDECONTENT, "assigns_widecontent", $assigns_widecontent);
			$check_assigns_widecontent->addOption(1, " ");
			$form->addElement($check_assigns_widecontent);
			
			$preheaderHandler =& xoops_getModuleHandler("IXTFrameWork_preheader", "IXTFrameWork");
			$preheader_select = new XoopsFormSelect(_AM_IXTFRAMEWORK_ASSIGNS_PREHEADER, "assigns_preheader", $this->getVar("assigns_preheader"));
			$preheader_select->addOptionArray($preheaderHandler->getList());
			$form->addElement($preheader_select, true);
			 $assigns_extheader = $this->isNew() ? 1 : $this->getVar("assigns_extheader");
			$check_assigns_extheader = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_EXTHEADER, "assigns_extheader", $assigns_extheader);
			$check_assigns_extheader->addOption(1, " ");
			$form->addElement($check_assigns_extheader);
			 $assigns_headerrss = $this->isNew() ? 1 : $this->getVar("assigns_headerrss");
			$check_assigns_headerrss = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_HEADERRSS, "assigns_headerrss", $assigns_headerrss);
			$check_assigns_headerrss->addOption(1, " ");
			$form->addElement($check_assigns_headerrss);
			
			$slidesHandler =& xoops_getModuleHandler("IXTFrameWork_slides", "IXTFrameWork");
			$slides_select = new XoopsFormSelect(_AM_IXTFRAMEWORK_ASSIGNS_SLIDES, "assigns_slides", $this->getVar("assigns_slides"));
			$slides_select->addOptionArray($slidesHandler->getList());
			$form->addElement($slides_select, true);
			
			$pagelayoutHandler =& xoops_getModuleHandler("IXTFrameWork_pagelayout", "IXTFrameWork");
			$pagelayout_select = new XoopsFormSelect(_AM_IXTFRAMEWORK_ASSIGNS_LAYOUT, "assigns_layout", $this->getVar("assigns_layout"));
			$pagelayout_select->addOptionArray($pagelayoutHandler->getList());
			$form->addElement($pagelayout_select, true);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_ASSIGNS_W0, "assigns_w0", 50, 255, $this->getVar("assigns_w0")), true);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_ASSIGNS_W1, "assigns_w1", 50, 255, $this->getVar("assigns_w1")), true);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_ASSIGNS_W2, "assigns_w2", 50, 255, $this->getVar("assigns_w2")), true);
			
			$assigns_logos = $this->getVar("assigns_logos") ? $this->getVar("assigns_logos") : 'blank.gif';
		
			$uploadirectory_assigns_logos = '/uploads/IXTFrameWork/assigns/assigns_logos';
			$imgtray_assigns_logos = new XoopsFormElementTray(_AM_IXTFRAMEWORK_ASSIGNS_LOGOS,'<br />');
			$imgpath_assigns_logos = sprintf(_AM_IXTFRAMEWORK_FORMIMAGE_PATH, $uploadirectory_assigns_logos);
			$imageselect_assigns_logos = new XoopsFormSelect($imgpath_assigns_logos, 'assigns_logos', $assigns_logos);
			$image_array_assigns_logos = XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH.$uploadirectory_assigns_logos );
			foreach( $image_array_assigns_logos as $image_assigns_logos ) {
				$imageselect_assigns_logos->addOption("$image_assigns_logos", $image_assigns_logos);
			}
			$imageselect_assigns_logos->setExtra( "onchange='showImgSelected(\"image_assigns_logos\", \"assigns_logos\", \"".$uploadirectory_assigns_logos."\", \"\", \"".XOOPS_URL."\")'" );
			$imgtray_assigns_logos->addElement($imageselect_assigns_logos, false);
			$imgtray_assigns_logos->addElement( new XoopsFormLabel( '', "<br /><img src='".XOOPS_URL."/".$uploadirectory_assigns_logos."/".$assigns_logos."' name='image_assigns_logos' id='image_assigns_logos' alt='' />" ) );
		
			$fileseltray_assigns_logos = new XoopsFormElementTray('','<br />');
			$fileseltray_assigns_logos->addElement(new XoopsFormFile(_AM_IXTFRAMEWORK_FORMUPLOAD , "assigns_logos", $xoopsModuleConfig["assigns_logos_size"]),false);
			$fileseltray_assigns_logos->addElement(new XoopsFormLabel(''), false);
			$imgtray_assigns_logos->addElement($fileseltray_assigns_logos);
			$form->addElement($imgtray_assigns_logos);

			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_ASSIGNS_LOGOW, "assigns_logow", 50, 255, $this->getVar("assigns_logow")), true);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_ASSIGNS_LOGOH, "assigns_logoh", 50, 255, $this->getVar("assigns_logoh")), true);
			 $assigns_ctrl0 = $this->isNew() ? 1 : $this->getVar("assigns_ctrl0");
			$check_assigns_ctrl0 = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_CTRL0, "assigns_ctrl0", $assigns_ctrl0);
			$check_assigns_ctrl0->addOption(1, " ");
			$form->addElement($check_assigns_ctrl0);
			 $assigns_ctrl1 = $this->isNew() ? 1 : $this->getVar("assigns_ctrl1");
			$check_assigns_ctrl1 = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_CTRL1, "assigns_ctrl1", $assigns_ctrl1);
			$check_assigns_ctrl1->addOption(1, " ");
			$form->addElement($check_assigns_ctrl1);
			 $assigns_ctrl2 = $this->isNew() ? 1 : $this->getVar("assigns_ctrl2");
			$check_assigns_ctrl2 = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_CTRL2, "assigns_ctrl2", $assigns_ctrl2);
			$check_assigns_ctrl2->addOption(1, " ");
			$form->addElement($check_assigns_ctrl2);
			 $assigns_extfooter = $this->isNew() ? 1 : $this->getVar("assigns_extfooter");
			$check_assigns_extfooter = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_EXTFOOTER, "assigns_extfooter", $assigns_extfooter);
			$check_assigns_extfooter->addOption(1, " ");
			$form->addElement($check_assigns_extfooter);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_ASSIGNS_EHBLOCK, "assigns_ehblock", 50, 255, $this->getVar("assigns_ehblock")), false);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS0, "assigns_efblocks0", 50, 255, $this->getVar("assigns_efblocks0")), false);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS1, "assigns_efblocks1", 50, 255, $this->getVar("assigns_efblocks1")), false);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS2, "assigns_efblocks2", 50, 255, $this->getVar("assigns_efblocks2")), false);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_ASSIGNS_EFBLOCKS3, "assigns_efblocks3", 50, 255, $this->getVar("assigns_efblocks3")), false);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_ASSIGNS_WBLOCKS1, "assigns_wblocks1", 50, 255, $this->getVar("assigns_wblocks1")), false);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_ASSIGNS_WBLOCKS2, "assigns_wblocks2", 50, 255, $this->getVar("assigns_wblocks2")), false);
			 $assigns_footerrss = $this->isNew() ? 1 : $this->getVar("assigns_footerrss");
			$check_assigns_footerrss = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_FOOTERRSS, "assigns_footerrss", $assigns_footerrss);
			$check_assigns_footerrss->addOption(1, " ");
			$form->addElement($check_assigns_footerrss);
			
			$uithemeHandler =& xoops_getModuleHandler("IXTFrameWork_uitheme", "IXTFrameWork");
			$uitheme_select = new XoopsFormSelect(_AM_IXTFRAMEWORK_ASSIGNS_UITHEME, "assigns_uitheme", $this->getVar("assigns_uitheme"));
			$uitheme_select->addOptionArray($uithemeHandler->getList());
			$form->addElement($uitheme_select, true);
			 $assigns_multiskin = $this->isNew() ? 1 : $this->getVar("assigns_multiskin");
			$check_assigns_multiskin = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_MULTISKIN, "assigns_multiskin", $assigns_multiskin);
			$check_assigns_multiskin->addOption(1, " ");
			$form->addElement($check_assigns_multiskin);
			
			$fixskinHandler =& xoops_getModuleHandler("IXTFrameWork_fixskin", "IXTFrameWork");
			$fixskin_select = new XoopsFormSelect(_AM_IXTFRAMEWORK_ASSIGNS_FIXSKIN, "assigns_fixskin", $this->getVar("assigns_fixskin"));
			$fixskin_select->addOptionArray($fixskinHandler->getList());
			$form->addElement($fixskin_select, true);
			 $assigns_blconcat = $this->isNew() ? 1 : $this->getVar("assigns_blconcat");
			$check_assigns_blconcat = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_BLCONCAT, "assigns_blconcat", $assigns_blconcat);
			$check_assigns_blconcat->addOption(1, " ");
			$form->addElement($check_assigns_blconcat);
			 $assigns_sb1style = $this->isNew() ? 1 : $this->getVar("assigns_sb1style");
			$check_assigns_sb1style = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_SB1STYLE, "assigns_sb1style", $assigns_sb1style);
			$check_assigns_sb1style->addOption(1, " ");
			$form->addElement($check_assigns_sb1style);
			 $assigns_sb2style = $this->isNew() ? 1 : $this->getVar("assigns_sb2style");
			$check_assigns_sb2style = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_SB2STYLE, "assigns_sb2style", $assigns_sb2style);
			$check_assigns_sb2style->addOption(1, " ");
			$form->addElement($check_assigns_sb2style);
			 $assigns_eftstyle = $this->isNew() ? 1 : $this->getVar("assigns_eftstyle");
			$check_assigns_eftstyle = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_EFTSTYLE, "assigns_eftstyle", $assigns_eftstyle);
			$check_assigns_eftstyle->addOption(1, " ");
			$form->addElement($check_assigns_eftstyle);
			 $assigns_sysbstyle = $this->isNew() ? 1 : $this->getVar("assigns_sysbstyle");
			$check_assigns_sysbstyle = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_SYSBSTYLE, "assigns_sysbstyle", $assigns_sysbstyle);
			$check_assigns_sysbstyle->addOption(1, " ");
			$form->addElement($check_assigns_sysbstyle);
			 $assigns_wide1style = $this->isNew() ? 1 : $this->getVar("assigns_wide1style");
			$check_assigns_wide1style = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_WIDE1STYLE, "assigns_wide1style", $assigns_wide1style);
			$check_assigns_wide1style->addOption(1, " ");
			$form->addElement($check_assigns_wide1style);
			 $assigns_wide2style = $this->isNew() ? 1 : $this->getVar("assigns_wide2style");
			$check_assigns_wide2style = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_WIDE2STYLE, "assigns_wide2style", $assigns_wide2style);
			$check_assigns_wide2style->addOption(1, " ");
			$form->addElement($check_assigns_wide2style);
			 $assigns_rtl = $this->isNew() ? 1 : $this->getVar("assigns_rtl");
			$check_assigns_rtl = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_RTL, "assigns_rtl", $assigns_rtl);
			$check_assigns_rtl->addOption(1, " ");
			$form->addElement($check_assigns_rtl);
			
			$toplayoutHandler =& xoops_getModuleHandler("IXTFrameWork_toplayout", "IXTFrameWork");
			$toplayout_select = new XoopsFormSelect(_AM_IXTFRAMEWORK_ASSIGNS_CONTENT_TOP_ORDER, "assigns_content_top_order", $this->getVar("assigns_content_top_order"));
			$toplayout_select->addOptionArray($toplayoutHandler->getList());
			$form->addElement($toplayout_select, true);
			
			$botlayoutHandler =& xoops_getModuleHandler("IXTFrameWork_botlayout", "IXTFrameWork");
			$botlayout_select = new XoopsFormSelect(_AM_IXTFRAMEWORK_ASSIGNS_CONTENT_BOTTOM_ORDER, "assigns_content_bottom_order", $this->getVar("assigns_content_bottom_order"));
			$botlayout_select->addOptionArray($botlayoutHandler->getList());
			$form->addElement($botlayout_select, true);
			$form->addElement(new XoopsFormSelectUser(_AM_IXTFRAMEWORK_ASSIGNS_SUBMITTER, "assigns_submitter", false, $this->getVar("assigns_submitter"), 1, false), true);
			$form->addElement(new XoopsFormTextDateSelect(_AM_IXTFRAMEWORK_ASSIGNS_DATE_CREATED, "assigns_date_created", "", $this->getVar("assigns_date_created")));
			 $assigns_online = $this->isNew() ? 1 : $this->getVar("assigns_online");
			$check_assigns_online = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_ASSIGNS_ONLINE, "assigns_online", $assigns_online);
			$check_assigns_online->addOption(1, " ");
			$form->addElement($check_assigns_online);
			
			$form->addElement(new XoopsFormHidden("op", "save_assigns"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}
	}
	class IXTFrameWorkixtframework_assignsHandler extends XoopsPersistableObjectHandler 
	{

		function __construct(&$db) 
		{
			parent::__construct($db, "ixtframework_assigns", "ixtframework_assigns", "assigns_id", "assigns_name");
		}

	}
	
?>