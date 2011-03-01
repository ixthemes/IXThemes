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
 * Version : 1.06:
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

	class ixtcake_coretestcases extends XoopsObject
	{ 
		//Constructor
		function __construct()
		{
			$this->XoopsObject();
			$this->initVar("coretestcases_id",XOBJ_DTYPE_INT,null,false,8);
			$this->initVar("coretestcases_name",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("coretestcases_path",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("coretestcases_submitter",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("coretestcases_date_created",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("coretestcases_online",XOBJ_DTYPE_INT,null,false,1);
			
			$this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
			
		}

		function ixtcake_coretestcases()
		{
			$this->__construct();
		}
	
		function getForm($action = false)
		{
			global $xoopsDB, $xoopsModuleConfig;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf(_AM_IXTCAKE_CORETESTCASES_ADD) : sprintf(_AM_IXTCAKE_CORETESTCASES_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra('enctype="multipart/form-data"');
			
			$form->addElement(new XoopsFormText(_AM_IXTCAKE_CORETESTCASES_NAME, "coretestcases_name", 50, 255, $this->getVar("coretestcases_name")), true);
			$form->addElement(new XoopsFormText(_AM_IXTCAKE_CORETESTCASES_PATH, "coretestcases_path", 150, 255, $this->getVar("coretestcases_path")), true);
			$form->addElement(new XoopsFormSelectUser(_AM_IXTCAKE_CORETESTCASES_SUBMITTER, "coretestcases_submitter", false, $this->getVar("coretestcases_submitter"), 1, false), true);
			$form->addElement(new XoopsFormTextDateSelect(_AM_IXTCAKE_CORETESTCASES_DATE_CREATED, "coretestcases_date_created", "", $this->getVar("coretestcases_date_created")));
			 $coretestcases_online = $this->isNew() ? 1 : $this->getVar("coretestcases_online");
			$check_coretestcases_online = new XoopsFormCheckBox(_AM_IXTCAKE_CORETESTCASES_ONLINE, "coretestcases_online", $coretestcases_online);
			$check_coretestcases_online->addOption(1, " ");
			$form->addElement($check_coretestcases_online);
			
			$form->addElement(new XoopsFormHidden("op", "save_coretestcases"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}
	}
	class ixtcakeixtcake_coretestcasesHandler extends XoopsPersistableObjectHandler 
	{

		function __construct(&$db) 
		{
			parent::__construct($db, "ixtcake_coretestcases", "ixtcake_coretestcases", "coretestcases_id", "coretestcases_name");
		}

	}
	
?>