#
# Table structure for table `ixtcake_apptestgroups`
#
		
CREATE TABLE  `ixtcake_apptestgroups` (
`apptestgroups_id` int (8)   NOT NULL  auto_increment,
`apptestgroups_name` varchar (255)   NOT NULL ,
`apptestgroups_path` varchar (255)   NOT NULL ,
`apptestgroups_submitter` int (10)   NOT NULL default '0',
`apptestgroups_date_created` int (10)   NOT NULL default '0',
`apptestgroups_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`apptestgroups_id`)
) ENGINE=MyISAM;

INSERT INTO `ixtcake_apptestgroups` VALUES (1,'all tests','app/webroot/test.php?group=all&app=true',1,1288465200,1);

#
# Table structure for table `ixtcake_coretestgroups`
#
		
CREATE TABLE  `ixtcake_coretestgroups` (
`coretestgroups_id` int (8)   NOT NULL  auto_increment,
`coretestgroups_name` varchar (255)   NOT NULL ,
`coretestgroups_path` varchar (255)   NOT NULL ,
`coretestgroups_submitter` int (10)   NOT NULL default '0',
`coretestgroups_date_created` int (10)   NOT NULL default '0',
`coretestgroups_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`coretestgroups_id`)
) ENGINE=MyISAM;

INSERT INTO `ixtcake_coretestgroups` VALUES
(1,'all tests','app/webroot/test.php?group=all',1,1288465200,1),
(2,'acl','app/webroot/test.php?group=acl',1,1288465200,1),
(3,'bake','app/webroot/test.php?group=bake',1,1288465200,1),
(4,'behaviors','app/webroot/test.php?group=behaviors',1,1288465200,1),
(5,'cache','app/webroot/test.php?group=cache',1,1288465200,1),
(6,'components','app/webroot/test.php?group=components',1,1288465200,1),
(7,'configure','app/webroot/test.php?group=configure',1,1288465200,1),
(8,'console','app/webroot/test.php?group=console',1,1288465200,1),
(9,'controller','app/webroot/test.php?group=controller',1,1288465200,1),
(10,'database','app/webroot/test.php?group=database',1,1288465200,1),
(11,'helpers','app/webroot/test.php?group=helpers',1,1288465200,1),
(12,'i18n','app/webroot/test.php?group=i18n',1,1288465200,1),
(13,'javascript','app/webroot/test.php?group=javascript',1,1288465200,1),
(14,'lib','app/webroot/test.php?group=lib',1,1288465200,1),
(15,'model','app/webroot/test.php?group=model',1,1288465200,1),
(16,'no_cross_contamination','app/webroot/test.php?group=no_cross_contamination',1,1288465200,1),
(17,'routing_system','app/webroot/test.php?group=routing_system',1,1288465200,1),
(18,'socket','app/webroot/test.php?group=socket',1,1288465200,1),
(19,'test_suite','app/webroot/test.php?group=test_suite',1,1288465200,1),
(20,'view','app/webroot/test.php?group=view',1,1288465200,1),
(21,'xml','app/webroot/test.php?group=xml',1,1288465200,1);
