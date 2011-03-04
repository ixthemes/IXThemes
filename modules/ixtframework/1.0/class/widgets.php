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
 
	
	if (!defined("XOOPS_ROOT_PATH")) {
		die("XOOPS root path not defined");
	}

// algalochkin : this need for support xoops2.0.x or icms1.1 ONLY
include_once XOOPS_ROOT_PATH."/class/xoopsform/formeditor.php";

/*
if (!class_exists("XoopsPersistableObjectHandler")) {
  include_once XOOPS_ROOT_PATH."/modules/ixtcreate/class/object.php";
}
*/

	class ixtframework_widgets extends XoopsObject
	{ 
		//Constructor
		function __construct()
		{
			$this->XoopsObject();
			$this->initVar("widgets_id",XOBJ_DTYPE_INT,null,false,8);
			$this->initVar("widgets_name",XOBJ_DTYPE_TXTBOX,null,false);
			 $this->initVar("widgets_title",XOBJ_DTYPE_TXTAREA, null, false);
			 $this->initVar("widgets_content",XOBJ_DTYPE_TXTAREA, null, false);
			$this->initVar("widgets_submitter",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("widgets_date_created",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("widgets_online",XOBJ_DTYPE_INT,null,false,1);
			
			// Pour autoriser le html
			$this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
			
		}

		function ixtframework_widgets()
		{
			$this->__construct();
		}
	
		function getForm($action = false)
		{
			global $xoopsDB, $xoopsModuleConfig;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf(_AM_IXTFRAMEWORK_WIDGETS_ADD) : sprintf(_AM_IXTFRAMEWORK_WIDGETS_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra('enctype="multipart/form-data"');
			
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_WIDGETS_NAME, "widgets_name", 50, 255, $this->getVar("widgets_name")), true);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_WIDGETS_TITLE, "widgets_title", 50, 255, $this->getVar("widgets_title")), false);
			$editor_configs=array();
			$editor_configs["name"] ="widgets_content";
			$editor_configs["value"] = $this->getVar("widgets_content", "e");
			$editor_configs["rows"] = 20;
			$editor_configs["cols"] = 80;
			$editor_configs["width"] = "100%";
			$editor_configs["height"] = "400px";
			$editor_configs["editor"] = $xoopsModuleConfig["ixtframework_editor"];	
			$form->addElement( new XoopsFormEditor(_AM_IXTFRAMEWORK_WIDGETS_CONTENT, "widgets_content", $editor_configs), true );
			$form->addElement(new XoopsFormSelectUser(_AM_IXTFRAMEWORK_WIDGETS_SUBMITTER, "widgets_submitter", false, $this->getVar("widgets_submitter"), 1, false), true);
			$form->addElement(new XoopsFormTextDateSelect(_AM_IXTFRAMEWORK_WIDGETS_DATE_CREATED, "widgets_date_created", "", $this->getVar("widgets_date_created")));
			 $widgets_online = $this->isNew() ? 1 : $this->getVar("widgets_online");
			$check_widgets_online = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_WIDGETS_ONLINE, "widgets_online", $widgets_online);
			$check_widgets_online->addOption(1, " ");
			$form->addElement($check_widgets_online);
			
			$form->addElement(new XoopsFormHidden("op", "save_widgets"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}
	}
	
if (class_exists("XoopsPersistableObjectHandler")) {
	class ixtframeworkixtframework_widgetsHandler extends XoopsPersistableObjectHandler 
	{
		function __construct(&$db) 
		{
			parent::__construct($db, "ixtframework_widgets", "ixtframework_widgets", "widgets_id", "widgets_name");
		}
	}
} else {
    // algalochkin : this need for support icms1.2 ONLY
	class ixtframeworkixtframework_widgetsHandler extends IcmsPersistableObjectHandler 
	{
		function __construct(&$db) 
		{
			parent::__construct($db, "ixtframework_widgets", "ixtframework_widgets", "widgets_id", "widgets_name", "");
		}
	}
}
?>