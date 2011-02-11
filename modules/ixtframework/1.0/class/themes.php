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
 * Version : 1.04:
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

	class ixtframework_themes extends XoopsObject
	{ 
		//Constructor
		function __construct()
		{
			$this->XoopsObject();
			$this->initVar("themes_id",XOBJ_DTYPE_INT,null,false,8);
			$this->initVar("themes_name",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("themes_screenshot",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("themes_release",XOBJ_DTYPE_TXTBOX,null,false);
			 $this->initVar("themes_description",XOBJ_DTYPE_TXTAREA, null, false);
			$this->initVar("themes_author",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("themes_copyright",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("themes_submitter",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("themes_date_created",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("themes_online",XOBJ_DTYPE_INT,null,false,1);
			
			// Pour autoriser le html
			$this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
			
		}

		function ixtframework_themes()
		{
			$this->__construct();
		}
	
		function getForm($action = false)
		{
			global $xoopsDB, $xoopsModuleConfig;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf(_AM_IXTFRAMEWORK_THEMES_ADD) : sprintf(_AM_IXTFRAMEWORK_THEMES_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra('enctype="multipart/form-data"');
			
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_THEMES_NAME, "themes_name", 50, 255, $this->getVar("themes_name")), true);
			
			$themes_screenshot = $this->getVar("themes_screenshot") ? $this->getVar("themes_screenshot") : 'blank.gif';
		
			$uploadirectory_themes_screenshot = '/uploads/ixtframework/themes/themes_screenshot';
			$imgtray_themes_screenshot = new XoopsFormElementTray(_AM_IXTFRAMEWORK_THEMES_SCREENSHOT,'<br />');
			$imgpath_themes_screenshot = sprintf(_AM_IXTFRAMEWORK_FORMIMAGE_PATH, $uploadirectory_themes_screenshot);
			$imageselect_themes_screenshot = new XoopsFormSelect($imgpath_themes_screenshot, 'themes_screenshot', $themes_screenshot);
			$image_array_themes_screenshot = XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH.$uploadirectory_themes_screenshot );
			foreach( $image_array_themes_screenshot as $image_themes_screenshot ) {
				$imageselect_themes_screenshot->addOption("$image_themes_screenshot", $image_themes_screenshot);
			}
			$imageselect_themes_screenshot->setExtra( "onchange='showImgSelected(\"image_themes_screenshot\", \"themes_screenshot\", \"".$uploadirectory_themes_screenshot."\", \"\", \"".XOOPS_URL."\")'" );
			$imgtray_themes_screenshot->addElement($imageselect_themes_screenshot, false);
			$imgtray_themes_screenshot->addElement( new XoopsFormLabel( '', "<br /><img src='".XOOPS_URL."/".$uploadirectory_themes_screenshot."/".$themes_screenshot."' name='image_themes_screenshot' id='image_themes_screenshot' alt='' />" ) );
		
			$fileseltray_themes_screenshot = new XoopsFormElementTray('','<br />');
			$fileseltray_themes_screenshot->addElement(new XoopsFormFile(_AM_IXTFRAMEWORK_FORMUPLOAD , "themes_screenshot", $xoopsModuleConfig["themes_screenshot_size"]),false);
			$fileseltray_themes_screenshot->addElement(new XoopsFormLabel(''), false);
			$imgtray_themes_screenshot->addElement($fileseltray_themes_screenshot);
			$form->addElement($imgtray_themes_screenshot);

			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_THEMES_RELEASE, "themes_release", 50, 255, $this->getVar("themes_release")), false);
			$form->addElement(new XoopsFormTextArea(_AM_IXTFRAMEWORK_THEMES_DESCRIPTION, "themes_description", $this->getVar("themes_description"), 4, 47), false);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_THEMES_AUTHOR, "themes_author", 50, 255, $this->getVar("themes_author")), false);
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_THEMES_COPYRIGHT, "themes_copyright", 50, 255, $this->getVar("themes_copyright")), false);
			$form->addElement(new XoopsFormSelectUser(_AM_IXTFRAMEWORK_THEMES_SUBMITTER, "themes_submitter", false, $this->getVar("themes_submitter"), 1, false), true);
			$form->addElement(new XoopsFormTextDateSelect(_AM_IXTFRAMEWORK_THEMES_DATE_CREATED, "themes_date_created", "", $this->getVar("themes_date_created")));
			 $themes_online = $this->isNew() ? 1 : $this->getVar("themes_online");
			$check_themes_online = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_THEMES_ONLINE, "themes_online", $themes_online);
			$check_themes_online->addOption(1, " ");
			$form->addElement($check_themes_online);
			
			$form->addElement(new XoopsFormHidden("op", "save_themes"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}
	}
	class ixtframeworkixtframework_themesHandler extends XoopsPersistableObjectHandler 
	{

		function __construct(&$db) 
		{
			parent::__construct($db, "ixtframework_themes", "ixtframework_themes", "themes_id", "themes_name");
		}

	}
	
?>