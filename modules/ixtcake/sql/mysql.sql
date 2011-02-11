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

INSERT INTO `ixtcake_apptestgroups` VALUES (1,'All tests','app/webroot/test.php?group=all&app=true',1,1288465200,1);

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

INSERT INTO `x250_ixtcake_coretestgroups` values
(1,'All tests','app/webroot/test.php?group=all',1,1288465200,1),
(2,'Acl and Auth','app/webroot/test.php?group=acl',1,1288465200,1),
(3,'All Tasks related to bake','app/webroot/test.php?group=bake',1,1288465200,1),
(4,'All core behavior test cases','app/webroot/test.php?group=behaviors',1,1288465200,1),
(5,'Cache and all CacheEngines','app/webroot/test.php?group=cache',1,1288465200,1),
(6,'All Components','app/webroot/test.php?group=components',1,1288465200,1),
(7,'Configure, App and ClassRegistry','app/webroot/test.php?group=configure',1,1288465200,1),
(8,'ShellDispatcher, Shell and all Tasks','app/webroot/test.php?group=console',1,1288465200,1),
(9,'Component, Controllers, Scaffold test cases','app/webroot/test.php?group=controller',1,1288465200,1),
(10,'Datasources, Schema and DbAcl tests','app/webroot/test.php?group=database',1,1288465200,1),
(11,'All Helpers','app/webroot/test.php?group=helpers',1,1288465200,1),
(12,'i18n, l10n and multibyte tests','app/webroot/test.php?group=i18n',1,1288465200,1),
(13,'Js Helper and all Engine Helpers','app/webroot/test.php?group=javascript',1,1288465200,1),
(14,'All core, non MVC element libs','app/webroot/test.php?group=lib',1,1288465200,1),
(15,'All Model tests','app/webroot/test.php?group=model',1,1288465200,1),
(16,'No Cross Contamination','app/webroot/test.php?group=no_cross_contamination',1,1288465200,1),
(17,'Router and Dispatcher','app/webroot/test.php?group=routing_system',1,1288465200,1),
(18,'CakeSocket and HttpSocket tests','app/webroot/test.php?group=socket',1,1288465200,1),
(19,'TestSuite','app/webroot/test.php?group=test_suite',1,1288465200,1),
(20,'View and ThemeView','app/webroot/test.php?group=view',1,1288465200,1),
(21,'Xml based classes (Xml, XmlHelper and RssHelper)','app/webroot/test.php?group=xml',1,1288465200,1);
