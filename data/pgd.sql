
--
-- Table structure for table `t_addproperty`
--

DROP TABLE IF EXISTS `t_addproperty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_addproperty` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(80) NOT NULL DEFAULT '' COMMENT '属性名称',
  `tag` varchar(30) NOT NULL DEFAULT '' COMMENT '属性标识',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COMMENT='附加属性表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_addproperty`
--

LOCK TABLES `t_addproperty` WRITE;
/*!40000 ALTER TABLE `t_addproperty` DISABLE KEYS */;
INSERT INTO `t_addproperty` VALUES (67,'特色他','tsg');
/*!40000 ALTER TABLE `t_addproperty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_archives`
--

DROP TABLE IF EXISTS `t_archives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_archives` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `s_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `m_id` mediumint(8) unsigned DEFAULT '0' COMMENT '模块ID',
  `title` varchar(255) DEFAULT '' COMMENT '标题',
  `alias` varchar(255) DEFAULT '' COMMENT '标题的别称',
  `author` varchar(60) DEFAULT '' COMMENT '作者',
  `pubdate` varchar(20) DEFAULT '' COMMENT '发布时间',
  `update` varchar(20) DEFAULT '' COMMENT '修改时间',
  `url` varchar(255) DEFAULT '' COMMENT '新的链接',
  `click` int(10) unsigned DEFAULT '0' COMMENT '点击数',
  `keywords` varchar(255) DEFAULT '' COMMENT '关键字',
  `description` text COMMENT '简短描述',
  `sort` mediumint(8) unsigned DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章、软件、图片\r\n基本档案';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_archives`
--

LOCK TABLES `t_archives` WRITE;
/*!40000 ALTER TABLE `t_archives` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_archives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_archives_attr`
--

DROP TABLE IF EXISTS `t_archives_attr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_archives_attr` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `m_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '模块ID',
  `a_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '附加属性ID',
  `isalias` tinyint(1) unsigned DEFAULT '0' COMMENT '是否别名：1是，0否',
  `sort` smallint(5) unsigned DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容基础表的扩展';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_archives_attr`
--

LOCK TABLES `t_archives_attr` WRITE;
/*!40000 ALTER TABLE `t_archives_attr` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_archives_attr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_article`
--

DROP TABLE IF EXISTS `t_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_article` (
  `arc_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '基础表ID',
  `content` text NOT NULL COMMENT '内容',
  KEY `arc_id` (`arc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_article`
--

LOCK TABLES `t_article` WRITE;
/*!40000 ALTER TABLE `t_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_attachment`
--

DROP TABLE IF EXISTS `t_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_attachment` (
  `attakey` varchar(30) NOT NULL DEFAULT '' COMMENT 'KEY',
  `attavalue` varchar(50) DEFAULT '' COMMENT 'VALUE',
  KEY `attrkey` (`attakey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件管理';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_attachment`
--

LOCK TABLES `t_attachment` WRITE;
/*!40000 ALTER TABLE `t_attachment` DISABLE KEYS */;
INSERT INTO `t_attachment` VALUES ('isopen','0'),('atta_path','/attachment'),('atta_ext','.apk,.rar'),('atta_size','1024'),('pic_ext','.jpg,.png'),('pic_path','/upload/img'),('pic_size','10000'),('pic_width','500'),('pic_height','500');
/*!40000 ALTER TABLE `t_attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_bind_article_game`
--

DROP TABLE IF EXISTS `t_bind_article_game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_bind_article_game` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `art_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章ID',
  `soft_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '软件ID',
  PRIMARY KEY (`id`),
  KEY `art_id` (`art_id`),
  KEY `soft_id` (`soft_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章和游戏关联表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_bind_article_game`
--

LOCK TABLES `t_bind_article_game` WRITE;
/*!40000 ALTER TABLE `t_bind_article_game` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_bind_article_game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_bind_group_permission`
--

DROP TABLE IF EXISTS `t_bind_group_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_bind_group_permission` (
  `group_id` mediumint(8) NOT NULL COMMENT '组ID',
  `permission_id` mediumint(8) NOT NULL COMMENT '权限ID',
  KEY `group_id` (`group_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组和权限的关联';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_bind_group_permission`
--

LOCK TABLES `t_bind_group_permission` WRITE;
/*!40000 ALTER TABLE `t_bind_group_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_bind_group_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_bind_section_module`
--

DROP TABLE IF EXISTS `t_bind_section_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_bind_section_module` (
  `st_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '栏目模板ID',
  `m_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '模块ID',
  `sort` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  KEY `s_id` (`st_id`),
  KEY `m_id` (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目和模块绑定表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_bind_section_module`
--

LOCK TABLES `t_bind_section_module` WRITE;
/*!40000 ALTER TABLE `t_bind_section_module` DISABLE KEYS */;
INSERT INTO `t_bind_section_module` VALUES (42,2,3),(18,2,3),(42,1,2),(34,2,1),(18,1,2);
/*!40000 ALTER TABLE `t_bind_section_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_bind_user_group`
--

DROP TABLE IF EXISTS `t_bind_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_bind_user_group` (
  `user_id` mediumint(8) unsigned NOT NULL COMMENT '用户ID',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '组ID',
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户和组的关联表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_bind_user_group`
--

LOCK TABLES `t_bind_user_group` WRITE;
/*!40000 ALTER TABLE `t_bind_user_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_bind_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_group`
--

DROP TABLE IF EXISTS `t_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_group` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) DEFAULT '' COMMENT '组名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_group`
--

LOCK TABLES `t_group` WRITE;
/*!40000 ALTER TABLE `t_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_management`
--

DROP TABLE IF EXISTS `t_management`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_management` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(24) NOT NULL DEFAULT '' COMMENT '密码',
  `alias` varchar(30) DEFAULT '' COMMENT '别名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_management`
--

LOCK TABLES `t_management` WRITE;
/*!40000 ALTER TABLE `t_management` DISABLE KEYS */;
INSERT INTO `t_management` VALUES (1,'admin','e10adc3949ba5343b2765a48','葛平');
/*!40000 ALTER TABLE `t_management` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_module`
--

DROP TABLE IF EXISTS `t_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_module` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `t_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '模板ID',
  `title` varchar(90) NOT NULL COMMENT '标题',
  `tag` varchar(30) DEFAULT '' COMMENT 'tag',
  `description` varchar(255) DEFAULT '' COMMENT '模块说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='模块表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_module`
--

LOCK TABLES `t_module` WRITE;
/*!40000 ALTER TABLE `t_module` DISABLE KEYS */;
INSERT INTO `t_module` VALUES (1,5,'模块','模块','模块'),(2,5,'秦始皇陵','geping','尼采');
/*!40000 ALTER TABLE `t_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_permission`
--

DROP TABLE IF EXISTS `t_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_permission` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `title` varchar(90) NOT NULL DEFAULT '' COMMENT '权限名称',
  `controller` varchar(50) NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(50) NOT NULL DEFAULT '' COMMENT '方法',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_permission`
--

LOCK TABLES `t_permission` WRITE;
/*!40000 ALTER TABLE `t_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_pictrue`
--

DROP TABLE IF EXISTS `t_pictrue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_pictrue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '图片路径',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='图片表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_pictrue`
--

LOCK TABLES `t_pictrue` WRITE;
/*!40000 ALTER TABLE `t_pictrue` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_pictrue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_section`
--

DROP TABLE IF EXISTS `t_section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_section` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '父栏目ID',
  `path` varchar(50) NOT NULL DEFAULT '' COMMENT '无限分类路径',
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '标题',
  `keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` text NOT NULL COMMENT '描述',
  `uri` varchar(150) NOT NULL DEFAULT '' COMMENT '生成的文件保存路径',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示，1显示，0不显示',
  `type` tinyint(1) unsigned DEFAULT '1' COMMENT '栏目类型，1表示单页面，2表示双页面',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='栏目表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_section`
--

LOCK TABLES `t_section` WRITE;
/*!40000 ALTER TABLE `t_section` DISABLE KEYS */;
INSERT INTO `t_section` VALUES (18,17,'14,17,18','栏目名称311','311','311','/soft/3/1',311,0,2),(17,14,'14,17','栏目名称31','31','31','/soft/3',31,0,2),(16,11,'11,16','栏目名称12','12','12','/soft/1',12,0,2),(15,11,'11,15','栏目名称11','11','11','/lanmu/',11,1,2),(14,0,'14','栏目名称4','4','4','/',4,0,1),(13,0,'13','栏目名称3','3','3','/',3,0,1),(12,0,'12','栏目名称2','2','2','/',2,0,1),(11,0,'11','栏目名称1','1','1','/',1,1,1);
/*!40000 ALTER TABLE `t_section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_section_temp`
--

DROP TABLE IF EXISTS `t_section_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_section_temp` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `s_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '指向栏目ID',
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '标题',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '模板类型：1列表页、2详细页、0代表单页面',
  `temp_path` varchar(255) NOT NULL DEFAULT '' COMMENT '模板路径',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COMMENT='栏目表的扩展模板表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_section_temp`
--

LOCK TABLES `t_section_temp` WRITE;
/*!40000 ALTER TABLE `t_section_temp` DISABLE KEYS */;
INSERT INTO `t_section_temp` VALUES (43,17,'栏目名称31',2,'/templete/31s.html'),(25,16,'栏目名称12',2,'/templete/12s.html'),(24,16,'栏目名称12',1,'/templete/12.html'),(23,15,'栏目名称11',2,'/templete/11s.html'),(22,15,'栏目名称11',1,'/templete/11.html'),(21,14,'栏目名称4',0,'default.html'),(20,13,'栏目名称3',0,'index.html'),(19,12,'栏目名称2',0,'default.php'),(18,11,'栏目名称1',0,'index.php'),(42,17,'栏目名称31',1,'/templete/31.html'),(45,18,'栏目名称311',2,'/templete/311s.html'),(44,18,'栏目名称311',1,'/templete/311.html'),(35,19,'栏目名称3111',2,'/templete/3111s.html'),(34,19,'栏目名称3111',1,'/templete/3111.html');
/*!40000 ALTER TABLE `t_section_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_soft`
--

DROP TABLE IF EXISTS `t_soft`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_soft` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `icon` varchar(255) DEFAULT '' COMMENT '软件icon路径',
  `language` varchar(20) DEFAULT '' COMMENT '语言',
  `softtype` varchar(20) DEFAULT '' COMMENT '软件类型',
  `gameplatform` varchar(20) DEFAULT '' COMMENT '软件运行平台',
  `softrank` mediumint(8) unsigned DEFAULT '0' COMMENT '热度',
  `softsize` varchar(10) DEFAULT '' COMMENT '软件大小',
  `download` varchar(255) DEFAULT '' COMMENT '软件下载链接',
  `price` varchar(20) DEFAULT '' COMMENT '软件价格',
  `barcode` varchar(255) DEFAULT '' COMMENT '二维码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='软件表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_soft`
--

LOCK TABLES `t_soft` WRITE;
/*!40000 ALTER TABLE `t_soft` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_soft` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_template`
--

DROP TABLE IF EXISTS `t_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_template` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL DEFAULT '' COMMENT '标题',
  `pic` varchar(255) NOT NULL DEFAULT '' COMMENT '预览图路径',
  `code` text NOT NULL COMMENT '模板代码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='模板表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_template`
--

LOCK TABLES `t_template` WRITE;
/*!40000 ALTER TABLE `t_template` DISABLE KEYS */;
INSERT INTO `t_template` VALUES (2,'在来一俄1','/uploads/template_pic/2012/01/11/20120111172827_a2f13ae9f84f63c1107b8df4661218f4.jpg','特色想想想 '),(4,'TETXX','/uploads/template_pic/2012/01/11/20120111172639_a9a3bba50d9eb12b8a7c9da2b074c6d6.jpg','TTTTTTTTTTTTTT'),(5,'360安全卫士','/uploads/template_pic/2012/01/11/20120111173114_053e19d52b816bb136336145c3af4a35.jpg','test');
/*!40000 ALTER TABLE `t_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_website`
--

DROP TABLE IF EXISTS `t_website`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_website` (
  `webkey` varchar(50) NOT NULL,
  `webvalue` varchar(255) NOT NULL,
  KEY `webkey` (`webkey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_website`
--

LOCK TABLES `t_website` WRITE;
/*!40000 ALTER TABLE `t_website` DISABLE KEYS */;
INSERT INTO `t_website` VALUES ('web_name','天天游戏乐园'),('web_host','http://www.tiantian.com'),('web_email','tiantian@gmail.com'),('web_keyword','关键字s'),('web_description','描述'),('mail_protocol','smtp'),('smtp_host','127.0.0.1'),('smtp_user','root'),('smtp_pass','123456'),('smtp_port','25'),('smtp_timeout','5'),('mail_wordwrap','0'),('mail_type','html'),('mail_charset','utf-8');
/*!40000 ALTER TABLE `t_website` ENABLE KEYS */;
UNLOCK TABLES;
