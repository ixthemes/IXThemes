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

	class ixtframework_topic extends XoopsObject
	{ 
		//Constructor
		function __construct()
		{
			$this->XoopsObject();
			$this->initVar("topic_id",XOBJ_DTYPE_INT,null,false,11);
			$this->initVar("topic_pid",XOBJ_DTYPE_INT,null,false,5);
			$this->initVar("topic_title",XOBJ_DTYPE_TXTBOX,null,false);
			 $this->initVar("topic_desc",XOBJ_DTYPE_TXTAREA, null, false);
			$this->initVar("topic_img",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("topic_weight",XOBJ_DTYPE_INT,null,false,5);
			$this->initVar("topic_color",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("topic_submitter",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("topic_date_created",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("topic_online",XOBJ_DTYPE_INT,null,false,1);
			
			// Pour autoriser le html
			$this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
			
		}

		function ixtframework_topic()
		{
			$this->__construct();
		}
	
		function getForm($action = false)
		{
			global $xoopsDB, $xoopsModuleConfig;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf(_AM_IXTFRAMEWORK_TOPIC_ADD) : sprintf(_AM_IXTFRAMEWORK_TOPIC_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra('enctype="multipart/form-data"');
			
			
			include_once(XOOPS_ROOT_PATH."/class/tree.php");
			
			$topicHandler =& xoops_getModuleHandler("IXTFrameWork_topic", "IXTFrameWork");
			$arr = $topicHandler->getall();
			$mytree = new XoopsObjectTree($arr, "topic_id", "topic_pid");
			$form->addElement(new XoopsFormLabel(_AM_IXTFRAMEWORK_TOPIC_PID, $mytree->makeSelBox("topic_pid", "topic_title","-", $this->getVar("topic_pid"),false)));
			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_TOPIC_TITLE, "topic_title", 50, 255, $this->getVar("topic_title")), true);
			$form->addElement(new XoopsFormTextArea(_AM_IXTFRAMEWORK_TOPIC_DESC, "topic_desc", $this->getVar("topic_desc"), 4, 47), true);
			
			$topic_img = $this->getVar("topic_img") ? $this->getVar("topic_img") : 'blank.gif';
		
			$uploadirectory_topic_img = '/uploads/IXTFrameWork/topic/topic_img';
			$imgtray_topic_img = new XoopsFormElementTray(_AM_IXTFRAMEWORK_TOPIC_IMG,'<br />');
			$imgpath_topic_img = sprintf(_AM_IXTFRAMEWORK_FORMIMAGE_PATH, $uploadirectory_topic_img);
			$imageselect_topic_img = new XoopsFormSelect($imgpath_topic_img, 'topic_img', $topic_img);
			$image_array_topic_img = XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH.$uploadirectory_topic_img );
			foreach( $image_array_topic_img as $image_topic_img ) {
				$imageselect_topic_img->addOption("$image_topic_img", $image_topic_img);
			}
			$imageselect_topic_img->setExtra( "onchange='showImgSelected(\"image_topic_img\", \"topic_img\", \"".$uploadirectory_topic_img."\", \"\", \"".XOOPS_URL."\")'" );
			$imgtray_topic_img->addElement($imageselect_topic_img, false);
			$imgtray_topic_img->addElement( new XoopsFormLabel( '', "<br /><img src='".XOOPS_URL."/".$uploadirectory_topic_img."/".$topic_img."' name='image_topic_img' id='image_topic_img' alt='' />" ) );
		
			$fileseltray_topic_img = new XoopsFormElementTray('','<br />');
			$fileseltray_topic_img->addElement(new XoopsFormFile(_AM_IXTFRAMEWORK_FORMUPLOAD , "topic_img", $xoopsModuleConfig["topic_img_size"]),false);
			$fileseltray_topic_img->addElement(new XoopsFormLabel(''), false);
			$imgtray_topic_img->addElement($fileseltray_topic_img);
			$form->addElement($imgtray_topic_img);

			$form->addElement(new XoopsFormText(_AM_IXTFRAMEWORK_TOPIC_WEIGHT, "topic_weight", 50, 255, $this->getVar("topic_weight")), true);
			$form->addElement(new XoopsFormColorPicker(_AM_IXTFRAMEWORK_TOPIC_COLOR, "topic_color", $this->getVar("topic_color")), false);
			$form->addElement(new XoopsFormSelectUser(_AM_IXTFRAMEWORK_TOPIC_SUBMITTER, "topic_submitter", false, $this->getVar("topic_submitter"), 1, false), true);
			$form->addElement(new XoopsFormTextDateSelect(_AM_IXTFRAMEWORK_TOPIC_DATE_CREATED, "topic_date_created", "", $this->getVar("topic_date_created")));
			 $topic_online = $this->isNew() ? 1 : $this->getVar("topic_online");
			$check_topic_online = new XoopsFormCheckBox(_AM_IXTFRAMEWORK_TOPIC_ONLINE, "topic_online", $topic_online);
			$check_topic_online->addOption(1, " ");
			$form->addElement($check_topic_online);
			
			$form->addElement(new XoopsFormHidden("op", "save_topic"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}
	}
	class IXTFrameWorkixtframework_topicHandler extends XoopsPersistableObjectHandler 
	{

		function __construct(&$db) 
		{
			parent::__construct($db, "ixtframework_topic", "ixtframework_topic", "topic_id", "topic_title");
		}

	}
	
?>