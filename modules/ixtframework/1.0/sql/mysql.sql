#
# Table structure for table `ixtframework_pagelayout`
#
		
CREATE TABLE  `ixtframework_pagelayout` (
`pagelayout_id` int (8)   NOT NULL  auto_increment,
`pagelayout_name` varchar (3)   NOT NULL ,
`pagelayout_submitter` int (10)   NOT NULL default '0',
`pagelayout_date_created` int (10)   NOT NULL default '0',
`pagelayout_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`pagelayout_id`)
) ENGINE=MyISAM;

#
# Table structure for table `ixtframework_slides`
#
		
CREATE TABLE  `ixtframework_slides` (
`slides_id` int (8)   NOT NULL  auto_increment,
`slides_name` varchar (20)   NOT NULL ,
`slides_submitter` int (10)   NOT NULL default '0',
`slides_date_created` int (10)   NOT NULL default '0',
`slides_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`slides_id`)
) ENGINE=MyISAM;

#
# Table structure for table `ixtframework_topic`
#
		
CREATE TABLE  `ixtframework_topic` (
`topic_id` int (11) unsigned NOT NULL  auto_increment,
`topic_pid` int (5) unsigned NOT NULL default '0',
`topic_title` varchar (255)   NOT NULL ,
`topic_desc` text   NOT NULL ,
`topic_img` varchar (255)   NOT NULL ,
`topic_weight` int (5)   NOT NULL default '0',
`topic_color` varchar (10)   NULL ,
`topic_submitter` int (10)   NOT NULL default '0',
`topic_date_created` int (10)   NOT NULL default '0',
`topic_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`topic_id`)
) ENGINE=MyISAM;

#
# Table structure for table `ixtframework_assigns`
#
		
CREATE TABLE  `ixtframework_assigns` (
`assigns_id` int (8)   NOT NULL  auto_increment,
`assigns_name` varchar (20)   NOT NULL ,
`assigns_scrolblocks` varchar ( 255)   NOT NULL ,
`assigns_jsenable` tinyint (1)   NOT NULL ,
`assigns_globalnav` int ( 1)   NOT NULL ,
`assigns_widecontent` tinyint (1)   NOT NULL ,
`assigns_preheader` int ( 1)   NOT NULL ,
`assigns_extheader` tinyint (1)   NOT NULL ,
`assigns_headerrss` tinyint (1)   NOT NULL ,
`assigns_slides` int ( 2)   NOT NULL ,
`assigns_layout` int (1)   NOT NULL ,
`assigns_w0` int (2)   NOT NULL ,
`assigns_w1` int (2)   NOT NULL ,
`assigns_w2` int (2)   NOT NULL ,
`assigns_logos` varchar ( 255)   NOT NULL ,
`assigns_logow` int (3)   NOT NULL ,
`assigns_logoh` int (3)   NOT NULL ,
`assigns_ctrl0` tinyint (1)   NOT NULL ,
`assigns_ctrl1` tinyint (1)   NOT NULL ,
`assigns_ctrl2` tinyint (1)   NOT NULL ,
`assigns_extfooter` tinyint (1)   NOT NULL ,
`assigns_ehblock` varchar ( 255)   NOT NULL ,
`assigns_efblocks0` varchar ( 255)   NOT NULL ,
`assigns_efblocks1` varchar ( 255)   NOT NULL ,
`assigns_efblocks2` varchar ( 255)   NOT NULL ,
`assigns_efblocks3` varchar ( 255)   NOT NULL ,
`assigns_wblocks1` varchar ( 255)   NOT NULL ,
`assigns_wblocks2` varchar ( 255)   NOT NULL ,
`assigns_footerrss` tinyint (1)   NOT NULL ,
`assigns_uitheme` int ( 2)   NOT NULL ,
`assigns_multiskin` tinyint (1)   NOT NULL ,
`assigns_fixskin` int ( 2)   NOT NULL ,
`assigns_blconcat` tinyint (1)   NOT NULL ,
`assigns_sb1style` tinyint (1)   NOT NULL ,
`assigns_sb2style` tinyint (1)   NOT NULL ,
`assigns_eftstyle` tinyint (1)   NOT NULL ,
`assigns_sysbstyle` tinyint (1)   NOT NULL ,
`assigns_wide1style` tinyint (1)   NOT NULL ,
`assigns_wide2style` tinyint (1)   NOT NULL ,
`assigns_rtl` tinyint (1)   NOT NULL ,
`assigns_content_top_order` int ( 1)   NOT NULL ,
`assigns_content_bottom_order` int ( 1)   NOT NULL ,
`assigns_submitter` int (10)   NOT NULL default '0',
`assigns_date_created` int (10)   NOT NULL default '0',
`assigns_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`assigns_id`)
) ENGINE=MyISAM;

#
# Table structure for table `ixtframework_widgets`
#
		
CREATE TABLE  `ixtframework_widgets` (
`widgets_id` int (8)   NOT NULL  auto_increment,
`widgets_name` varchar (20)   NOT NULL ,
`widgets_title` text   NOT NULL ,
`widgets_content` text   NOT NULL ,
`widgets_submitter` int (10)   NOT NULL default '0',
`widgets_date_created` int (10)   NOT NULL default '0',
`widgets_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`widgets_id`)
) ENGINE=MyISAM;

#
# Table structure for table `ixtframework_globalnav`
#
		
CREATE TABLE  `ixtframework_globalnav` (
`globalnav_id` int (8)   NOT NULL  auto_increment,
`globalnav_name` varchar (20)   NOT NULL ,
`globalnav_submitter` int (10)   NOT NULL default '0',
`globalnav_date_created` int (10)   NOT NULL default '0',
`globalnav_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`globalnav_id`)
) ENGINE=MyISAM;

#
# Table structure for table `ixtframework_preheader`
#
		
CREATE TABLE  `ixtframework_preheader` (
`preheader_id` int (8)   NOT NULL  auto_increment,
`preheader_name` varchar (20)   NOT NULL ,
`preheader_submitter` int (10)   NOT NULL default '0',
`preheader_date_created` int (10)   NOT NULL default '0',
`preheader_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`preheader_id`)
) ENGINE=MyISAM;

#
# Table structure for table `ixtframework_uitheme`
#
		
CREATE TABLE  `ixtframework_uitheme` (
`uitheme_id` int (8)   NOT NULL  auto_increment,
`uitheme_name` varchar (20)   NOT NULL ,
`uitheme_submitter` int (10)   NOT NULL default '0',
`uitheme_date_created` int (10)   NOT NULL default '0',
`uitheme_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`uitheme_id`)
) ENGINE=MyISAM;

#
# Table structure for table `ixtframework_fixskin`
#
		
CREATE TABLE  `ixtframework_fixskin` (
`fixskin_id` int (8)   NOT NULL  auto_increment,
`fixskin_name` varchar (20)   NOT NULL ,
`fixskin_submitter` int (10)   NOT NULL default '0',
`fixskin_date_created` int (10)   NOT NULL default '0',
`fixskin_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`fixskin_id`)
) ENGINE=MyISAM;

#
# Table structure for table `ixtframework_toplayout`
#
		
CREATE TABLE  `ixtframework_toplayout` (
`toplayout_id` int (8)   NOT NULL  auto_increment,
`toplayout_name` varchar (3)   NOT NULL ,
`toplayout_submitter` int (10)   NOT NULL default '0',
`toplayout_date_created` int (10)   NOT NULL default '0',
`toplayout_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`toplayout_id`)
) ENGINE=MyISAM;

#
# Table structure for table `ixtframework_botlayout`
#
		
CREATE TABLE  `ixtframework_botlayout` (
`botlayout_id` int (8)   NOT NULL  auto_increment,
`botlayout_name` varchar (3)   NOT NULL ,
`botlayout_submitter` int (10)   NOT NULL default '0',
`botlayout_date_created` int (10)   NOT NULL default '0',
`botlayout_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`botlayout_id`)
) ENGINE=MyISAM;

#
# Table structure for table `ixtframework_themes`
#
		
CREATE TABLE  `ixtframework_themes` (
`themes_id` int (8)   NOT NULL  auto_increment,
`themes_name` varchar (255)   NOT NULL ,
`themes_screenshot` varchar (255)   NOT NULL ,
`themes_release` varchar (255)   NOT NULL ,
`themes_description` text   NOT NULL ,
`themes_author` varchar (255)   NOT NULL ,
`themes_copyright` varchar (255)   NOT NULL ,
`themes_submitter` int (10)   NOT NULL default '0',
`themes_date_created` int (10)   NOT NULL default '0',
`themes_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`themes_id`)
) ENGINE=MyISAM;

INSERT INTO `ixtframework_pagelayout` VALUES (1, 'lcr', 1, 1285610400, 1);
INSERT INTO `ixtframework_pagelayout` VALUES (2, 'clr', 1, 1285610400, 1);
INSERT INTO `ixtframework_pagelayout` VALUES (3, 'lrc', 1, 1285610400, 1);

INSERT INTO `ixtframework_slides` VALUES (1, 's0', 1, 1285610400, 1);
INSERT INTO `ixtframework_slides` VALUES (2, 's1', 1, 1285610400, 1);
INSERT INTO `ixtframework_slides` VALUES (3, 's2', 1, 1285610400, 1);
INSERT INTO `ixtframework_slides` VALUES (4, 's3', 1, 1285610400, 1);
INSERT INTO `ixtframework_slides` VALUES (5, 's4', 1, 1285610400, 1);
INSERT INTO `ixtframework_slides` VALUES (6, 's5', 1, 1285610400, 1);
INSERT INTO `ixtframework_slides` VALUES (7, 's6', 1, 1285610400, 1);
INSERT INTO `ixtframework_slides` VALUES (8, 'no', 1, 1285610400, 1);

INSERT INTO `ixtframework_topic` VALUES (1, 0, 'styles', 'styles description', '', 0, '', 1, 1285610400, 1);

INSERT INTO `ixtframework_assigns` VALUES (1, 'style0', '1,3,6,7,8', 1, 2, 0, 2, 1, 0, 1, 1, 55, 75, 80, 'logo.png', 199, 51, 0, 1, 1, 1, 'ixt05', 'ixt04', 'ixt01', 'ixt02', 'ixt09', 'ixt07,ixt04', 'ixt08', 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 1, 0, 2, 2, 1, 1283277600, 1);
INSERT INTO `ixtframework_assigns` VALUES (2, 'style1', '1,8', 1, 2, 0, 2, 1, 0, 1, 1, 55, 75, 80, 'logo.png', 199, 51, 0, 1, 1, 1, 'ixt05', 'ixt04', 'ixt01', 'ixt02', 'ixt09', 'ixt07,ixt04', 'ixt08', 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 1, 0, 2, 2, 1, 1283364000, 0);
INSERT INTO `ixtframework_assigns` VALUES (3, 'style2', '9999', 1, 2, 0, 2, 1, 0, 1, 1, 55, 75, 80, 'logo_490.png', 490, 126, 0, 1, 1, 1, 'ixt05', '1', 'ixt01', 'ixt02', '5', 'ixt07,ixt04', 'ixt08', 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 1, 0, 2, 2, 1, 1283450400, 0);
INSERT INTO `ixtframework_assigns` VALUES (4, 'style3', '3,6', 1, 2, 0, 2, 1, 0, 1, 1, 55, 75, 80, 'blank.gif', 199, 51, 0, 1, 1, 1, 'ixt05', 'ixt04', 'ixt01', 'ixt02', 'ixt09', 'ixt07,ixt04', 'ixt08', 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 1, 0, 2, 2, 1, 1283536800, 0);
INSERT INTO `ixtframework_assigns` VALUES (5, 'style4', '1,7,8', 1, 2, 0, 2, 1, 0, 1, 1, 55, 75, 80, 'blank.gif', 199, 51, 0, 1, 1, 1, 'ixt05', 'ixt04', 'ixt01', 'ixt02', 'ixt09', 'ixt07,ixt04', 'ixt08', 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 1, 0, 2, 2, 1, 1283623200, 0);

INSERT INTO `ixtframework_widgets` VALUES (1, 'ixt01', 'Do You like it?', '<div align="center"><a href="http://ixthemes.org">If you like these themes you can support IXThemes Project</a><p>&nbsp;</p><div align="center"><span class="ixt-button-wrapper"><span class="l"></span><span class="r"></span><a class="ixt-button" href="http://ixthemes.com/shop" >MAKE SHOPPING</a></span></div><p>&nbsp;</p><a href="http://ixthemes.com">We will create many FREE fine themes for YOUR COMMUNITY!</a><p>&nbsp;</p></div>', 1, 1285610400, 1);
INSERT INTO `ixtframework_widgets` VALUES (2, 'ixt02', 'Follow Us!!!', '<div align="center"><a href="http://twitter.com/ixthemes"><img title="Follow IXThemes on Twitter" alt="IXThemes on Twitter" src="\'.XOOPS_URL.\'/themes/\'.$theme.\'/img/twitter-follow-me.png" /></a><p>&nbsp;</p><a href="http://ixthemes.org"><img title="Welcome to IXThemes Project" alt="The Best FREE XOOPS Themes" src="\'.XOOPS_URL.\'/themes/\'.$theme.\'/img/logo.png" /></a><p>&nbsp;</p></div>', 1, 1285610400, 1);
INSERT INTO `ixtframework_widgets` VALUES (3, 'ixt03', 'Free Themes', '<div align="center"><span class="ixt-button-wrapper"><span class="l"></span><span class="r"></span><a class="ixt-button" href="http://ixthemes.com/modules/TDMDownloads/viewcat.php?cid=1" >DOWNLOAD</a></span></div>', 1, 1285610400, 1);
INSERT INTO `ixtframework_widgets` VALUES (4, 'ixt04', 'IXThemes offers', '<div><ul><li><a href="http://ixthemes.org">Fresh Ideas for You</a></li><li><a href="http://ixthemes.org">Top zone for customised slides</a></li><li><a href="http://ixthemes.org">Two control zones on user side</a></li><li><a href="http://ixthemes.org">Customized expanded footer</a></li><li><a href="http://ixthemes.org">Self-adjusted a menu bar</a></li><li><a href="http://ixthemes.org">Own style of any system block</a></li><li><a href="http://ixthemes.org">Flexible modular structure</a></li><li><a href="http://ixthemes.org">Cross browsers support</a></li><li><a href="http://ixthemes.org">Customized columns layout</a></li><li><a href="http://ixthemes.org">Customized columns width</a></li><li><a href="http://ixthemes.org">Original threecolour buttons</a></li><li><a href="http://ixthemes.org">Over 300 free themes</a></li><li><a href="http://ixthemes.org">RTL support</a></li><li><a href="http://ixthemes.org">More...</a></li></ul></div>', 1, 1285610400, 1);
INSERT INTO `ixtframework_widgets` VALUES (5, 'ixt05', 'IXThemes Theme Framework 4.0', '<div><ul><li><a href="http://ixthemes.com">2880 variants in one theme</a></li><li><a href="http://ixthemes.com">Two customizable wide zones</a></li><li><a href="http://ixthemes.com">Customizable preheader menu</a></li><li><a href="http://ixthemes.com">Seven preestablished scenarios for a slide show</a></li></ul></div>', 1, 1285610400, 1);
INSERT INTO `ixtframework_widgets` VALUES (6, 'ixt06', 'Custom Widget', '<div><p>Custom Widget</p></div>', 1, 1285610400, 1);
INSERT INTO `ixtframework_widgets` VALUES (7, 'ixt07', '', '<h3>IXThemes is an implementation of innovative methods in the development of qualitative universality themes and templates for content management systems based on the XOOPS Web application platform.</h3>', 1, 1285610400, 1);
INSERT INTO `ixtframework_widgets` VALUES (8, 'ixt08', '', '<h3>XOOPS is an extensible, OO (Object Oriented), easy to use dynamic web content management system written in PHP. XOOPS is the ideal tool for developing small to large dynamic community websites, intra company portals, corporate portals.</h3>', 1, 1285610400, 1);
INSERT INTO `ixtframework_widgets` VALUES (9, 'ixt09', 'Contact Us', '<script type="text/javascript"><!--// function ixtFormValidate() { var ixtform = window.document.ixtcontact; if ( ixtform.ele_2.value == "" ) { window.alert("Please enter Your name"); ixtform.ele_2.focus(); return false; }; if ( ixtform.ele_3.value == "" ) { window.alert("Please enter Email"); ixtform.ele_3.focus(); return false; }; if ( ixtform.ele_4.value == "" ) { window.alert("Please enter Website"); ixtform.ele_4.focus(); return false; }; if ( ixtform.ele_7.value == "" ) { window.alert("Please enter Message"); ixtform.ele_7.focus(); return false; } return true; } //--></script><form method="post" action="\'.XOOPS_URL.\'/modules/liaise/index.php" id="ixtcontact" name="ixtcontact">Your name:<br /><input type="text" maxlength="255" size="29" id="ele_2" title="Your name" name="ele_2" />Email:<br /><input type="text" maxlength="255" size="29" id="ele_3" title="Email" name="ele_3" />Website:<br /><input type="text" value="http://" maxlength="255" size="29" id="ele_4" title="Website" name="ele_4" />Message:<br /><textarea style="height:50px;" cols="28" title="Message" id="ele_7" name="ele_7"></textarea><div align="right"><input type="submit" title="Send" value="Send" id="submit" name="submit" class="ixt-button" onclick="ixtFormValidate();" /></div><input type="hidden" value="1" id="form_id" name="form_id" /></form>', 1, 1285610400, 1);

INSERT INTO `ixtframework_globalnav` VALUES (1, 'no', 1, 1285610400, 1);
INSERT INTO `ixtframework_globalnav` VALUES (2, 'default', 1, 1285610400, 1);
INSERT INTO `ixtframework_globalnav` VALUES (3, 'mymenu', 1, 1285610400, 1);

INSERT INTO `ixtframework_preheader` VALUES (1, 'no', 1, 1285610400, 1);
INSERT INTO `ixtframework_preheader` VALUES (2, 'search', 1, 1285610400, 1);
INSERT INTO `ixtframework_preheader` VALUES (3, 'menu', 1, 1285610400, 1);

INSERT INTO `ixtframework_uitheme` VALUES (1, 'base', 1, 1285610400, 1);

INSERT INTO `ixtframework_fixskin` VALUES (1, 'no', 1, 1285610400, 1);

INSERT INTO `ixtframework_toplayout` VALUES (1, 'lcr', 1, 1285610400, 1);
INSERT INTO `ixtframework_toplayout` VALUES (2, 'clr', 1, 1285610400, 1);
INSERT INTO `ixtframework_toplayout` VALUES (3, 'lrc', 1, 1285610400, 1);

INSERT INTO `ixtframework_botlayout` VALUES (1, 'lcr', 1, 1285610400, 1);
INSERT INTO `ixtframework_botlayout` VALUES (2, 'clr', 1, 1285610400, 1);
INSERT INTO `ixtframework_botlayout` VALUES (3, 'lrc', 1, 1285610400, 1);
