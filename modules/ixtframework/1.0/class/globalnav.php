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

	class ixtframework_globalnav extends XoopsObject
	{ 
		//Constructor
		function __construct()
		{
			$this->XoopsObject();
			$this->initVar("globalnav_id",XOBJ_DTYPE_INT,null,false,8);
			$this->initVar("globalnav_name",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("globalnav_submitter",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("globalnav_date_created",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("globalnav_online",XOBJ_DTYPE_INT,null,false,1);
			
			// Pour autoriser le html
			$this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
			
		}

		function ixtframework_globalnav()
		{
			$this->__construct();
		}
	
		function getForm($action = false)
		{
			global $xoopsDB, $xoopsModuleConfig;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf(_AM_IXTFRAMEWORK_GLOBALNAV_ADD) : sprintf(_AM_IXTFRAMEWORK_GLOBALNAV_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra('enctype="multipart/form-data"');
			
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_GLOBALNAV_NAME, "globalnav_name", 50, 255, $this->getVar("globalnav_name")), true);
			$form->addElement(new XoopsFormSelectUser(_AM_IXTFRAMEWORK_GLOBALNAV_SUBMITTER, "globalnav_submitter", false, $this->getVar("globalnav_submitter"), 1, false), true);
			$form->addElement(new XoopsFormTextDateSelect(_AM_IXTFRAMEWORK_GLOBALNAV_DATE_CREATED, "globalnav_date_created", "", $this->getVar("globalnav_date_created")));
			 $globalnav_online = $this->isNew() ? 1 : $this->getVar("globalnav_online");
			$check_globalnav_online = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_GLOBALNAV_ONLINE, "globalnav_online", $globalnav_online);
			$check_globalnav_online->addOption(1, " ");
			$form->addElement($check_globalnav_online);
			
			$form->addElement(new XoopsFormHidden("op", "save_globalnav"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}
	}
	class ixtframeworkixtframework_globalnavHandler extends XoopsPersistableObjectHandler 
	{

		function __construct(&$db) 
		{
			parent::__construct($db, "ixtframework_globalnav", "ixtframework_globalnav", "globalnav_id", "globalnav_name");
		}

	}
	
?>