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
 * Version : 1.07:
 * ****************************************************************************
 */
 
	
	if (!defined("XOOPS_ROOT_PATH")) {
		die("XOOPS root path not defined");
	}

	class ixtcake_apptestgroups extends XoopsObject
	{ 
		//Constructor
		function __construct()
		{
			$this->XoopsObject();
			$this->initVar("apptestgroups_id",XOBJ_DTYPE_INT,null,false,8);
			$this->initVar("apptestgroups_name",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("apptestgroups_path",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("apptestgroups_submitter",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("apptestgroups_date_created",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("apptestgroups_online",XOBJ_DTYPE_INT,null,false,1);
			
			$this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
			
		}

		function ixtcake_apptestgroups()
		{
			$this->__construct();
		}
	
		function getForm($action = false)
		{
			global $xoopsDB, $xoopsModuleConfig;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf(_AM_IXTCAKE_APPTESTGROUPS_ADD) : sprintf(_AM_IXTCAKE_APPTESTGROUPS_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra('enctype="multipart/form-data"');
			
			$form->addElement(new XoopsFormText(_AM_IXTCAKE_APPTESTGROUPS_NAME, "apptestgroups_name", 50, 255, $this->getVar("apptestgroups_name")), true);
			$form->addElement(new XoopsFormText(_AM_IXTCAKE_APPTESTGROUPS_PATH, "apptestgroups_path", 50, 255, $this->getVar("apptestgroups_path")), true);
			$form->addElement(new XoopsFormSelectUser(_AM_IXTCAKE_APPTESTGROUPS_SUBMITTER, "apptestgroups_submitter", false, $this->getVar("apptestgroups_submitter"), 1, false), true);
			$form->addElement(new XoopsFormTextDateSelect(_AM_IXTCAKE_APPTESTGROUPS_DATE_CREATED, "apptestgroups_date_created", "", $this->getVar("apptestgroups_date_created")));
			 $apptestgroups_online = $this->isNew() ? 1 : $this->getVar("apptestgroups_online");
			$check_apptestgroups_online = new XoopsFormCheckBox(_AM_IXTCAKE_APPTESTGROUPS_ONLINE, "apptestgroups_online", $apptestgroups_online);
			$check_apptestgroups_online->addOption(1, " ");
			$form->addElement($check_apptestgroups_online);
			
			$form->addElement(new XoopsFormHidden("op", "save_apptestgroups"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}
	}
if (class_exists("XoopsPersistableObjectHandler")) {
	class ixtcakeixtcake_apptestgroupsHandler extends XoopsPersistableObjectHandler 
	{
		function __construct(&$db) 
		{
			parent::__construct($db, "ixtcake_apptestgroups", "ixtcake_apptestgroups", "apptestgroups_id", "apptestgroups_name");
		}
	}
} else {
    // algalochkin : this need for support icms1.2 ONLY
	class ixtcakeixtcake_apptestgroupsHandler extends IcmsPersistableObjectHandler 
	{
		function __construct(&$db) 
		{
			parent::__construct($db, "ixtcake_apptestgroups", "ixtcake_apptestgroups", "apptestgroups_id", "apptestgroups_name", "");
		}
	}
}

?>