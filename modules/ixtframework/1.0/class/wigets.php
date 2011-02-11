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
 
	
	if (!defined("XOOPS_ROOT_PATH")) {
		die("XOOPS root path not defined");
	}

	if (!class_exists("XoopsPersistableObjectHandler")) {
		include_once XOOPS_ROOT_PATH."/modules/ixtframework/class/object.php";
	}

	class ixtframework_wigets extends XoopsObject
	{ 
		//Constructor
		function __construct()
		{
			$this->XoopsObject();
			$this->initVar("wigets_id",XOBJ_DTYPE_INT,null,false,8);
			$this->initVar("wigets_name",XOBJ_DTYPE_TXTBOX,null,false);
			 $this->initVar("wigets_title",XOBJ_DTYPE_TXTAREA, null, false);
			 $this->initVar("wigets_content",XOBJ_DTYPE_TXTAREA, null, false);
			$this->initVar("wigets_submitter",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("wigets_date_created",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("wigets_online",XOBJ_DTYPE_INT,null,false,1);
			
			// Pour autoriser le html
			$this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
			
		}

		function ixtframework_wigets()
		{
			$this->__construct();
		}
	
		function getForm($action = false)
		{
			global $xoopsDB, $xoopsModuleConfig;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf(_AM_IXTFRAMEWORK_WIGETS_ADD) : sprintf(_AM_IXTFRAMEWORK_WIGETS_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra('enctype="multipart/form-data"');
			
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_WIGETS_NAME, "wigets_name", 50, 255, $this->getVar("wigets_name")), true);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_WIGETS_TITLE, "wigets_title", 50, 255, $this->getVar("wigets_title")), true);
			$editor_configs=array();
			$editor_configs["name"] ="wigets_content";
			$editor_configs["value"] = $this->getVar("wigets_content", "e");
			$editor_configs["rows"] = 20;
			$editor_configs["cols"] = 80;
			$editor_configs["width"] = "100%";
			$editor_configs["height"] = "400px";
			$editor_configs["editor"] = $xoopsModuleConfig["ixtframework_editor"];				
			$form->addElement( new XoopsFormEditor(_AM_IXTFRAMEWORK_WIGETS_CONTENT, "wigets_content", $editor_configs), true );
			$form->addElement(new XoopsFormSelectUser(_AM_IXTFRAMEWORK_WIGETS_SUBMITTER, "wigets_submitter", false, $this->getVar("wigets_submitter"), 1, false), true);
			$form->addElement(new XoopsFormTextDateSelect(_AM_IXTFRAMEWORK_WIGETS_DATE_CREATED, "wigets_date_created", "", $this->getVar("wigets_date_created")));
			 $wigets_online = $this->isNew() ? 1 : $this->getVar("wigets_online");
			$check_wigets_online = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_WIGETS_ONLINE, "wigets_online", $wigets_online);
			$check_wigets_online->addOption(1, " ");
			$form->addElement($check_wigets_online);
			
			$form->addElement(new XoopsFormHidden("op", "save_wigets"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}
	}
	class ixtframeworkixtframework_wigetsHandler extends XoopsPersistableObjectHandler 
	{

		function __construct(&$db) 
		{
			parent::__construct($db, "ixtframework_wigets", "ixtframework_wigets", "wigets_id", "wigets_name");
		}

	}
	
?>