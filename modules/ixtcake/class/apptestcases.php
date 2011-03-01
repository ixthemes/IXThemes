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

	class ixtcake_apptestcases extends XoopsObject
	{ 
		//Constructor
		function __construct()
		{
			$this->XoopsObject();
			$this->initVar("apptestcases_id",XOBJ_DTYPE_INT,null,false,8);
			$this->initVar("apptestcases_name",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("apptestcases_path",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("apptestcases_submitter",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("apptestcases_date_created",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("apptestcases_online",XOBJ_DTYPE_INT,null,false,1);
			
			$this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
			
		}

		function ixtcake_apptestcases()
		{
			$this->__construct();
		}
	
		function getForm($action = false)
		{
			global $xoopsDB, $xoopsModuleConfig;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf(_AM_IXTCAKE_APPTESTCASES_ADD) : sprintf(_AM_IXTCAKE_APPTESTCASES_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra('enctype="multipart/form-data"');
			
			$form->addElement(new XoopsFormText(_AM_IXTCAKE_APPTESTCASES_NAME, "apptestcases_name", 50, 255, $this->getVar("apptestcases_name")), true);
			$form->addElement(new XoopsFormText(_AM_IXTCAKE_APPTESTCASES_PATH, "apptestcases_path", 50, 255, $this->getVar("apptestcases_path")), true);
			$form->addElement(new XoopsFormSelectUser(_AM_IXTCAKE_APPTESTCASES_SUBMITTER, "apptestcases_submitter", false, $this->getVar("apptestcases_submitter"), 1, false), true);
			$form->addElement(new XoopsFormTextDateSelect(_AM_IXTCAKE_APPTESTCASES_DATE_CREATED, "apptestcases_date_created", "", $this->getVar("apptestcases_date_created")));
			 $apptestcases_online = $this->isNew() ? 1 : $this->getVar("apptestcases_online");
			$check_apptestcases_online = new XoopsFormCheckBox(_AM_IXTCAKE_APPTESTCASES_ONLINE, "apptestcases_online", $apptestcases_online);
			$check_apptestcases_online->addOption(1, " ");
			$form->addElement($check_apptestcases_online);
			
			$form->addElement(new XoopsFormHidden("op", "save_apptestcases"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}
	}
	class ixtcakeixtcake_apptestcasesHandler extends XoopsPersistableObjectHandler 
	{

		function __construct(&$db) 
		{
			parent::__construct($db, "ixtcake_apptestcases", "ixtcake_apptestcases", "apptestcases_id", "apptestcases_name");
		}

	}
	
?>