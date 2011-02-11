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
# Table structure for table `ixtframework_wigets`
#
		
CREATE TABLE  `ixtframework_wigets` (
`wigets_id` int (8)   NOT NULL  auto_increment,
`wigets_name` varchar (20)   NOT NULL ,
`wigets_title` text   NOT NULL ,
`wigets_content` text   NOT NULL ,
`wigets_submitter` int (10)   NOT NULL default '0',
`wigets_date_created` int (10)   NOT NULL default '0',
`wigets_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`wigets_id`)
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

INSERT INTO `ixtframework_assigns` VALUES (1, 'style0', '1,3,6,7,8', 1, 2, 0, 2, 1, 0, 1, 1, 55, 75, 80, 'logo.png', 199, 51, 0, 1, 1, 1, 'ixt05', 'ixt04', 'ixt01', 'ixt02', 'ixt09', 'ixt07,ixt04', 'ixt08', 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 2, 2, 1, 1285610400, 1);

INSERT INTO `ixtframework_wigets` VALUES (1, 'ixt01', 'Do You like it?', '<div align="center"><a href="http://ixthemes.org">If you like these themes you can support IXThemes Project</a><p>&nbsp;</p><div align="center"><span class="ixt-button-wrapper"><span class="l"></span><span class="r"></span><a class="ixt-button" href="http://ixthemes.com/shop" >MAKE SHOPPING</a></span></div><p>&nbsp;</p><a href="http://ixthemes.com">We will create many FREE fine themes for YOUR COMMUNITY!</a><p>&nbsp;</p></div>', 1, 1285610400, 1);
INSERT INTO `ixtframework_wigets` VALUES (2, 'ixt02', 'Follow Us!!!', '<div align="center"><a href="http://twitter.com/ixthemes"><img title="Follow IXThemes on Twitter" alt="IXThemes on Twitter" src="\'.XOOPS_URL.\'/themes/\'.$theme.\'/img/twitter-follow-me.png" /></a><p>&nbsp;</p><a href="http://ixthemes.org"><img title="Welcome to IXThemes Project" alt="The Best FREE XOOPS Themes" src="\'.XOOPS_URL.\'/themes/\'.$theme.\'/img/logo.png" /></a><p>&nbsp;</p></div>', 1, 1285610400, 1);
INSERT INTO `ixtframework_wigets` VALUES (3, 'ixt03', 'Free Themes', '<div align="center"><span class="ixt-button-wrapper"><span class="l"></span><span class="r"></span><a class="ixt-button" href="http://ixthemes.com/modules/TDMDownloads/viewcat.php?cid=1" >DOWNLOAD</a></span></div>', 1, 1285610400, 1);

INSERT INTO `ixtframework_globalnav` VALUES (1, 'no', 1, 1285610400, 1);
INSERT INTO `ixtframework_globalnav` VALUES (2, 'yes', 1, 1285610400, 1);
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
