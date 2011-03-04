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
/*
if (!class_exists("XoopsPersistableObjectHandler")) {
  include_once XOOPS_ROOT_PATH."/modules/ixtcreate/class/object.php";
}
*/

	class ixtframework_preheader extends XoopsObject
	{ 
		//Constructor
		function __construct()
		{
			$this->XoopsObject();
			$this->initVar("preheader_id",XOBJ_DTYPE_INT,null,false,8);
			$this->initVar("preheader_name",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("preheader_submitter",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("preheader_date_created",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("preheader_online",XOBJ_DTYPE_INT,null,false,1);
			
			// Pour autoriser le html
			$this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
			
		}

		function ixtframework_preheader()
		{
			$this->__construct();
		}
	
		function getForm($action = false)
		{
			global $xoopsDB, $xoopsModuleConfig;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf(_AM_IXTFRAMEWORK_PREHEADER_ADD) : sprintf(_AM_IXTFRAMEWORK_PREHEADER_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra('enctype="multipart/form-data"');
			
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_PREHEADER_NAME, "preheader_name", 50, 255, $this->getVar("preheader_name")), true);
			$form->addElement(new XoopsFormSelectUser(_AM_IXTFRAMEWORK_PREHEADER_SUBMITTER, "preheader_submitter", false, $this->getVar("preheader_submitter"), 1, false), true);
			$form->addElement(new XoopsFormTextDateSelect(_AM_IXTFRAMEWORK_PREHEADER_DATE_CREATED, "preheader_date_created", "", $this->getVar("preheader_date_created")));
			 $preheader_online = $this->isNew() ? 1 : $this->getVar("preheader_online");
			$check_preheader_online = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_PREHEADER_ONLINE, "preheader_online", $preheader_online);
			$check_preheader_online->addOption(1, " ");
			$form->addElement($check_preheader_online);
			
			$form->addElement(new XoopsFormHidden("op", "save_preheader"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}
	}
	
if (class_exists("XoopsPersistableObjectHandler")) {
	class ixtframeworkixtframework_preheaderHandler extends XoopsPersistableObjectHandler 
	{
		function __construct(&$db) 
		{
			parent::__construct($db, "ixtframework_preheader", "ixtframework_preheader", "preheader_id", "preheader_name");
		}
	}
} else {
    // algalochkin : this need for support icms1.2 ONLY
	class ixtframeworkixtframework_preheaderHandler extends IcmsPersistableObjectHandler 
	{
		function __construct(&$db) 
		{
			parent::__construct($db, "ixtframework_preheader", "ixtframework_preheader", "preheader_id", "preheader_name", "");
		}
	}
}
?>