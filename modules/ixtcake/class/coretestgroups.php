<?php
/**
 * IXTCake - MODULE FOR XOOPS CONTENT MANAGEMENT SYSTEM
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
 * @package         
 * @author          IXThemes Project (http://ixthemes.org)
 *
 * Version : 1.03:
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

	class ixtcake_coretestgroups extends XoopsObject
	{ 
		//Constructor
		function __construct()
		{
			$this->XoopsObject();
			$this->initVar("coretestgroups_id",XOBJ_DTYPE_INT,null,false,8);
			$this->initVar("coretestgroups_name",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("coretestgroups_path",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("coretestgroups_submitter",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("coretestgroups_date_created",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("coretestgroups_online",XOBJ_DTYPE_INT,null,false,1);
			
			$this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
			
		}

		function ixtcake_coretestgroups()
		{
			$this->__construct();
		}
	
		function getForm($action = false)
		{
			global $xoopsDB, $xoopsModuleConfig;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf(_AM_IXTCAKE_CORETESTGROUPS_ADD) : sprintf(_AM_IXTCAKE_CORETESTGROUPS_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra('enctype="multipart/form-data"');
			
			$form->addElement(new XoopsFormText(_AM_IXTCAKE_CORETESTGROUPS_NAME, "coretestgroups_name", 50, 255, $this->getVar("coretestgroups_name")), true);
			$form->addElement(new XoopsFormText(_AM_IXTCAKE_CORETESTGROUPS_PATH, "coretestgroups_path", 50, 255, $this->getVar("coretestgroups_path")), true);
			$form->addElement(new XoopsFormSelectUser(_AM_IXTCAKE_CORETESTGROUPS_SUBMITTER, "coretestgroups_submitter", false, $this->getVar("coretestgroups_submitter"), 1, false), true);
			$form->addElement(new XoopsFormTextDateSelect(_AM_IXTCAKE_CORETESTGROUPS_DATE_CREATED, "coretestgroups_date_created", "", $this->getVar("coretestgroups_date_created")));
			 $coretestgroups_online = $this->isNew() ? 1 : $this->getVar("coretestgroups_online");
			$check_coretestgroups_online = new XoopsFormCheckBox(_AM_IXTCAKE_CORETESTGROUPS_ONLINE, "coretestgroups_online", $coretestgroups_online);
			$check_coretestgroups_online->addOption(1, " ");
			$form->addElement($check_coretestgroups_online);
			
			$form->addElement(new XoopsFormHidden("op", "save_coretestgroups"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}
	}
	class ixtcakeixtcake_coretestgroupsHandler extends XoopsPersistableObjectHandler 
	{

		function __construct(&$db) 
		{
			parent::__construct($db, "ixtcake_coretestgroups", "ixtcake_coretestgroups", "coretestgroups_id", "coretestgroups_name");
		}

	}
	
?>