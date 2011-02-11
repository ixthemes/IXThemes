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

INSERT INTO `ixtcake_coretestgroups` values
(1,'All tests','app/webroot/test.php?group=all',1,1288465200,0),
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
(16,'No Cross Contamination','app/webroot/test.php?group=no_cross_contamination',1,1288465200,0),
(17,'Router and Dispatcher','app/webroot/test.php?group=routing_system',1,1288465200,1),
(18,'CakeSocket and HttpSocket tests','app/webroot/test.php?group=socket',1,1288465200,1),
(19,'TestSuite','app/webroot/test.php?group=test_suite',1,1288465200,1),
(20,'View and ThemeView','app/webroot/test.php?group=view',1,1288465200,1),
(21,'Xml based classes (Xml, XmlHelper and RssHelper)','app/webroot/test.php?group=xml',1,1288465200,1);

#
# Table structure for table `ixtcake_apptestcases`
#
		
CREATE TABLE  `ixtcake_apptestcases` (
`apptestcases_id` int (8)   NOT NULL  auto_increment,
`apptestcases_name` varchar (255)   NOT NULL ,
`apptestcases_path` varchar (255)   NOT NULL ,
`apptestcases_submitter` int (10)   NOT NULL default '0',
`apptestcases_date_created` int (10)   NOT NULL default '0',
`apptestcases_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`apptestcases_id`)
) ENGINE=MyISAM;

INSERT INTO `ixtcake_apptestcases` values
(1,'All tests','app/webroot/test.php?show=cases&app=true',1,1288551600,1);

#
# Table structure for table `ixtcake_coretestcases`
#
		
CREATE TABLE  `ixtcake_coretestcases` (
`coretestcases_id` int (8)   NOT NULL  auto_increment,
`coretestcases_name` varchar (255)   NOT NULL ,
`coretestcases_path` varchar (255)   NOT NULL ,
`coretestcases_submitter` int (10)   NOT NULL default '0',
`coretestcases_date_created` int (10)   NOT NULL default '0',
`coretestcases_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`coretestcases_id`)
) ENGINE=MyISAM;

INSERT INTO `ixtcake_coretestcases` values
(1,'Basics','app/webroot/test.php?case=basics.test.php',1,1288551600,1),
(2,'console/ Cake','app/webroot/test.php?case=console%5Ccake.test.php',1,1288551600,1),
(3,'console/libs/ Acl','app/webroot/test.php?case=console%5Clibs%5Cacl.test.php',1,1288551600,1),
(4,'console/libs/ Api','app/webroot/test.php?case=console%5Clibs%5Capi.test.php',1,1288551600,1),
(5,'console/libs/ Bake','app/webroot/test.php?case=console%5Clibs%5Cbake.test.php',1,1288551600,1),
(6,'console/libs/ Schema','app/webroot/test.php?case=console%5Clibs%5Cschema.test.php',1,1288551600,1),
(7,'console/libs/ Shell','app/webroot/test.php?case=console%5Clibs%5Cshell.test.php',1,1288551600,1),
(8,'console/libs/tasks/ Controller','app/webroot/test.php?case=console%5Clibs%5Ctasks%5Ccontroller.test.php',1,1288551600,1),
(9,'console/libs/tasks/ DbConfig','app/webroot/test.php?case=console%5Clibs%5Ctasks%5Cdb_config.test.php',1,1288551600,1),
(10,'console/libs/tasks/ Extract','app/webroot/test.php?case=console%5Clibs%5Ctasks%5Cextract.test.php',1,1288551600,1),
(11,'console/libs/tasks/ Fixture','app/webroot/test.php?case=console%5Clibs%5Ctasks%5Cfixture.test.php',1,1288551600,1),
(12,'console/libs/tasks/ Model','app/webroot/test.php?case=console%5Clibs%5Ctasks%5Cmodel.test.php',1,1288551600,1),
(13,'console/libs/tasks/ Plugin','app/webroot/test.php?case=console%5Clibs%5Ctasks%5Cplugin.test.php',1,1288551600,1),
(14,'console/libs/tasks/ Project','app/webroot/test.php?case=console%5Clibs%5Ctasks%5Cproject.test.php',1,1288551600,1),
(15,'console/libs/tasks/ Template','app/webroot/test.php?case=console%5Clibs%5Ctasks%5Ctemplate.test.php',1,1288551600,1),
(16,'console/libs/tasks/ Test','app/webroot/test.php?case=console%5Clibs%5Ctasks%5Ctest.test.php',1,1288551600,1),
(17,'console/libs/tasks/ View','app/webroot/test.php?case=console%5Clibs%5Ctasks%5Cview.test.php',1,1288551600,1),
(18,'Dispatcher','app/webroot/test.php?case=dispatcher.test.php',1,1288551600,1),
(19,'libs/cache/ Apc','app/webroot/test.php?case=libs%5Ccache%5Capc.test.php',1,1288551600,1),
(20,'libs/cache/ File','app/webroot/test.php?case=libs%5Ccache%5Cfile.test.php',1,1288551600,1),
(21,'libs/cache/ Memcache','app/webroot/test.php?case=libs%5Ccache%5Cmemcache.test.php',1,1288551600,1),
(22,'libs/cache/ Xcache','app/webroot/test.php?case=libs%5Ccache%5Cxcache.test.php',1,1288551600,1),
(23,'libs/ Cache','app/webroot/test.php?case=libs%5Ccache.test.php',1,1288551600,1),
(24,'libs/ CakeLog','app/webroot/test.php?case=libs%5Ccake_log.test.php',1,1288551600,1),
(25,'libs/ CakeSession','app/webroot/test.php?case=libs%5Ccake_session.test.php',1,1288551600,1),
(26,'libs/ CakeSocket','app/webroot/test.php?case=libs%5Ccake_socket.test.php',1,1288551600,1),
(27,'libs/ CakeTestCase','app/webroot/test.php?case=libs%5Ccake_test_case.test.php',1,1288551600,1),
(28,'libs/ CakeTestFixture','app/webroot/test.php?case=libs%5Ccake_test_fixture.test.php',1,1288551600,1),
(29,'libs/ ClassRegistry','app/webroot/test.php?case=libs%5Cclass_registry.test.php',1,1288551600,1),
(30,'libs/ CodeCoverageManager','app/webroot/test.php?case=libs%5Ccode_coverage_manager.test.php',1,1288551600,1),
(31,'libs/ Configure','app/webroot/test.php?case=libs%5Cconfigure.test.php',1,1288551600,1),
(32,'libs/controller/ Component','app/webroot/test.php?case=libs%5Ccontroller%5Ccomponent.test.php',1,1288551600,1),
(33,'libs/controller/components/ Acl','app/webroot/test.php?case=libs%5Ccontroller%5Ccomponents%5Cacl.test.php',1,1288551600,1),
(34,'libs/controller/components/ Auth','app/webroot/test.php?case=libs%5Ccontroller%5Ccomponents%5Cauth.test.php',1,1288551600,1),
(35,'libs/controller/components/ Cookie','app/webroot/test.php?case=libs%5Ccontroller%5Ccomponents%5Ccookie.test.php',1,1288551600,1),
(36,'libs/controller/components/ Email','app/webroot/test.php?case=libs%5Ccontroller%5Ccomponents%5Cemail.test.php',1,1288551600,1),
(37,'libs/controller/components/ RequestHandler','app/webroot/test.php?case=libs%5Ccontroller%5Ccomponents%5Crequest_handler.test.php',1,1288551600,1),
(38,'libs/controller/components/ Security','app/webroot/test.php?case=libs%5Ccontroller%5Ccomponents%5Csecurity.test.php',1,1288551600,1),
(39,'libs/controller/components/ Session','app/webroot/test.php?case=libs%5Ccontroller%5Ccomponents%5Csession.test.php',1,1288551600,1),
(40,'libs/controller/ Controller','app/webroot/test.php?case=libs%5Ccontroller%5Ccontroller.test.php',1,1288551600,1),
(41,'libs/controller/ ControllerMergeVars','app/webroot/test.php?case=libs%5Ccontroller%5Ccontroller_merge_vars.test.php',1,1288551600,1),
(42,'libs/controller/ PagesController','app/webroot/test.php?case=libs%5Ccontroller%5Cpages_controller.test.php',1,1288551600,1),
(43,'libs/controller/ Scaffold','app/webroot/test.php?case=libs%5Ccontroller%5Cscaffold.test.php',1,1288551600,1),
(44,'libs/ Debugger','app/webroot/test.php?case=libs%5Cdebugger.test.php',1,1288551600,1),
(45,'libs/ Error','app/webroot/test.php?case=libs%5Cerror.test.php',1,1288551600,1),
(46,'libs/ File','app/webroot/test.php?case=libs%5Cfile.test.php',1,1288551600,1),
(47,'libs/ Folder','app/webroot/test.php?case=libs%5Cfolder.test.php',1,1288551600,1),
(48,'libs/ HttpSocket','app/webroot/test.php?case=libs%5Chttp_socket.test.php',1,1288551600,1),
(49,'libs/ I18n','app/webroot/test.php?case=libs%5Ci18n.test.php',1,1288551600,1),
(50,'libs/ Inflector','app/webroot/test.php?case=libs%5Cinflector.test.php',1,1288551600,1),
(51,'libs/ L10n','app/webroot/test.php?case=libs%5Cl10n.test.php',1,1288551600,1),
(52,'libs/log/ FileLog','app/webroot/test.php?case=libs%5Clog%5Cfile_log.test.php',1,1288551600,1),
(53,'libs/ MagicDb','app/webroot/test.php?case=libs%5Cmagic_db.test.php',1,1288551600,1),
(54,'libs/model/behaviors/ Acl','app/webroot/test.php?case=libs%5Cmodel%5Cbehaviors%5Cacl.test.php',1,1288551600,1),
(55,'libs/model/behaviors/ Containable','app/webroot/test.php?case=libs%5Cmodel%5Cbehaviors%5Ccontainable.test.php',1,1288551600,1),
(56,'libs/model/behaviors/ Translate','app/webroot/test.php?case=libs%5Cmodel%5Cbehaviors%5Ctranslate.test.php',1,1288551600,1),
(57,'libs/model/behaviors/ Tree','app/webroot/test.php?case=libs%5Cmodel%5Cbehaviors%5Ctree.test.php',1,1288551600,1),
(58,'libs/model/ CakeSchema','app/webroot/test.php?case=libs%5Cmodel%5Ccake_schema.test.php',1,1288551600,1),
(59,'libs/model/ ConnectionManager','app/webroot/test.php?case=libs%5Cmodel%5Cconnection_manager.test.php',1,1288551600,1),
(60,'libs/model/datasources/dbo/ DboMssql','app/webroot/test.php?case=libs%5Cmodel%5Cdatasources%5Cdbo%5Cdbo_mssql.test.php',1,1288551600,1),
(61,'libs/model/datasources/dbo/ DboMysql','app/webroot/test.php?case=libs%5Cmodel%5Cdatasources%5Cdbo%5Cdbo_mysql.test.php',1,1288551600,1),
(62,'libs/model/datasources/dbo/ DboMysqli','app/webroot/test.php?case=libs%5Cmodel%5Cdatasources%5Cdbo%5Cdbo_mysqli.test.php',1,1288551600,1),
(63,'libs/model/datasources/dbo/ DboOracle','app/webroot/test.php?case=libs%5Cmodel%5Cdatasources%5Cdbo%5Cdbo_oracle.test.php',1,1288551600,1),
(64,'libs/model/datasources/dbo/ DboPostgres','app/webroot/test.php?case=libs%5Cmodel%5Cdatasources%5Cdbo%5Cdbo_postgres.test.php',1,1288551600,1),
(65,'libs/model/datasources/dbo/ DboSqlite','app/webroot/test.php?case=libs%5Cmodel%5Cdatasources%5Cdbo%5Cdbo_sqlite.test.php',1,1288551600,1),
(66,'libs/model/datasources/ DboSource','app/webroot/test.php?case=libs%5Cmodel%5Cdatasources%5Cdbo_source.test.php',1,1288551600,1),
(67,'libs/model/ DbAcl','app/webroot/test.php?case=libs%5Cmodel%5Cdb_acl.test.php',1,1288551600,1),
(68,'libs/model/ Model','app/webroot/test.php?case=libs%5Cmodel%5Cmodel.test.php',1,1288551600,1),
(69,'libs/model/ ModelBehavior','app/webroot/test.php?case=libs%5Cmodel%5Cmodel_behavior.test.php',1,1288551600,1),
(70,'libs/model/ ModelDelete','app/webroot/test.php?case=libs%5Cmodel%5Cmodel_delete.test.php',1,1288551600,1),
(71,'libs/model/ ModelIntegration','app/webroot/test.php?case=libs%5Cmodel%5Cmodel_integration.test.php',1,1288551600,1),
(72,'libs/model/ ModelRead','app/webroot/test.php?case=libs%5Cmodel%5Cmodel_read.test.php',1,1288551600,1),
(73,'libs/model/ ModelValidation','app/webroot/test.php?case=libs%5Cmodel%5Cmodel_validation.test.php',1,1288551600,1),
(74,'libs/model/ ModelWrite','app/webroot/test.php?case=libs%5Cmodel%5Cmodel_write.test.php',1,1288551600,1),
(75,'libs/ Multibyte','app/webroot/test.php?case=libs%5Cmultibyte.test.php',1,1288551600,1),
(76,'libs/ Object','app/webroot/test.php?case=libs%5Cobject.test.php',1,1288551600,1),
(77,'libs/ Overloadable','app/webroot/test.php?case=libs%5Coverloadable.test.php',1,1288551600,1),
(78,'libs/ Router','app/webroot/test.php?case=libs%5Crouter.test.php',1,1288551600,1),
(79,'libs/ Sanitize','app/webroot/test.php?case=libs%5Csanitize.test.php',1,1288551600,1),
(80,'libs/ Security','app/webroot/test.php?case=libs%5Csecurity.test.php',1,1288551600,1),
(81,'libs/ Set','app/webroot/test.php?case=libs%5Cset.test.php',1,1288551600,1),
(82,'libs/ String','app/webroot/test.php?case=libs%5Cstring.test.php',1,1288551600,1),
(83,'libs/ TestManager','app/webroot/test.php?case=libs%5Ctest_manager.test.php',1,1288551600,1),
(84,'libs/ Validation','app/webroot/test.php?case=libs%5Cvalidation.test.php',1,1288551600,1),
(85,'libs/view/ Helper','app/webroot/test.php?case=libs%5Cview%5Chelper.test.php',1,1288551600,1),
(86,'libs/view/helpers/ Ajax','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Cajax.test.php',1,1288551600,1),
(87,'libs/view/helpers/ Cache','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Ccache.test.php',1,1288551600,1),
(88,'libs/view/helpers/ Form','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Cform.test.php',1,1288551600,1),
(89,'libs/view/helpers/ Html','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Chtml.test.php',1,1288551600,1),
(90,'libs/view/helpers/ Javascript','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Cjavascript.test.php',1,1288551600,1),
(91,'libs/view/helpers/ JqueryEngine','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Cjquery_engine.test.php',1,1288551600,1),
(92,'libs/view/helpers/ Js','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Cjs.test.php',1,1288551600,1),
(93,'libs/view/helpers/ MootoolsEngine','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Cmootools_engine.test.php',1,1288551600,1),
(94,'libs/view/helpers/ Number','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Cnumber.test.php',1,1288551600,1),
(95,'libs/view/helpers/ Paginator','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Cpaginator.test.php',1,1288551600,1),
(96,'libs/view/helpers/ PrototypeEngine','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Cprototype_engine.test.php',1,1288551600,1),
(97,'libs/view/helpers/ Rss','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Crss.test.php',1,1288551600,1),
(98,'libs/view/helpers/ Session','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Csession.test.php',1,1288551600,1),
(99,'libs/view/helpers/ Text','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Ctext.test.php',1,1288551600,1),
(100,'libs/view/helpers/ Time','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Ctime.test.php',1,1288551600,1),
(101,'libs/view/helpers/ Xml','app/webroot/test.php?case=libs%5Cview%5Chelpers%5Cxml.test.php',1,1288551600,1),
(102,'libs/view/ Media','app/webroot/test.php?case=libs%5Cview%5Cmedia.test.php',1,1288551600,1),
(103,'libs/view/ Theme','app/webroot/test.php?case=libs%5Cview%5Ctheme.test.php',1,1288551600,1),
(104,'libs/view/ View','app/webroot/test.php?case=libs%5Cview%5Cview.test.php',1,1288551600,1),
(105,'libs/ Xml','app/webroot/test.php?case=libs%5Cxml.test.php',1,1288551600,1);
