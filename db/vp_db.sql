# Host: localhost  (Version: 5.5.53)
# Date: 2019-07-08 22:21:37
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "udata"
#

CREATE TABLE `udata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '数据ID',
  `u_name` varchar(20) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `content` text NOT NULL COMMENT '内容',
  `picture` varchar(1999) DEFAULT NULL COMMENT '图片路径',
  `video` varchar(255) DEFAULT NULL COMMENT '视频',
  `at_type` varchar(255) DEFAULT NULL COMMENT '类型',
  `agree` enum('1','0') NOT NULL DEFAULT '0' COMMENT '审核',
  `create_at` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`,`u_name`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

#
# Data for table "udata"
#

INSERT INTO `udata` VALUES (22,'user1','今天天气真不错<br/><br/>nice啊啊','飘哥是尼玛的帅啊<br/>',NULL,'图片','1',1459889233),(34,'user1','nice a  马飞 :anguished:','./images/picture/1559890442b.jpg',NULL,'图片','1',1559890442),(35,'ardans','nice a  马飞 :anguished:','./images/picture/1559890442b.jpg,./images/picture/1559890442photo-1554443883-83db889b4007.jpg',NULL,'图片','1',1559890442),(36,'ardans','nice a  马飞 :anguished:','./images/picture/1559890639b.jpg',NULL,'图片','1',1559890639),(37,'ardans','nice a  马飞 :anguished:','./images/picture/1559890639b.jpg,./images/picture/1559890639photo-1554443883-83db889b4007.jpg',NULL,'图片','1',1559890639),(38,'ardans','nice a  马飞 :anguished:','./images/picture/1559890647b.jpg',NULL,'图片','1',1559890647),(39,'user1','nice a  马飞 :anguished:','./images/picture/1559890647b.jpg,./images/picture/1559890647photo-1554443883-83db889b4007.jpg',NULL,'图片','1',1559890647),(40,'ardans','qweqwe','./images/picture/1559890998b.jpg',NULL,'图片','1',1559890998),(43,'user1','第一次测试','./images/picture/1559890998b.jpg','','图片','1',1558862945),(44,'ardans','视频测试','./images/picture/1559890647b.jpg,./images/picture/1559890647photo-1554443883-83db889b4007.jpg','','图片','1',1559900452),(45,'用户1','文字测试','./images/picture/1559889233photo-1554443883-83db889b4007.jpg','','图片','1',1559900477),(46,'ardans','文字测试','','','文章','1',1559900641),(48,'用户2','qwe','','','文章','1',1559902720),(49,'用户2','zxc','','images/video//9dfb971068b31be67247c9b552285d86.mp4','视频','1',1559902839),(50,'黄金叶','飘哥是尼玛的帅啊<br/>','./images/picture/1560056238photo-1554336902-a957c6cc2390.jpg,./images/picture/1560056238photo-1554490783-82bac5dfc351.jpg,','','图片','1',1560056238),(52,'user1','user1上传视频','','images/video//465b782889282d1e7ae29197712adf3a.mp4','视频','1',1560061244),(54,'ardans','今天老师验收项目了:hamster::kissing_smiling_eyes:','','','文章','0',1560150895),(55,'ardans','测试表情:smile:','','','文章','0',1560151093),(59,'ardans','9','./images/picture/1560151560456.jpg,./images/picture/1560151560789.jpg,./images/picture/15601515601554442707(1).jpg,./images/picture/15601515601554479161(1).jpg,./images/picture/15601515601551182743858.jpg,./images/picture/15601515601479089940729001.png,./images/picture/1560151560a.jpg,./images/picture/1560151561b.jpg,./images/picture/1560151561zxc.jpg,','','图片','0',1560151560),(60,'ardans','4','./images/picture/1560151594123.jpg,./images/picture/1560151594456.jpg,./images/picture/1560151594789.jpg,./images/picture/1560151594a.jpg,','','图片','0',1560151594),(61,'ardans','nice !!','','','文章','0',1560153573),(62,'user1','晚霞！','./images/picture/15612672411659202190.jpg,','','图片','0',1561267241);

#
# Structure for table "udata_status"
#

CREATE TABLE `udata_status` (
  `u_id` int(11) NOT NULL COMMENT '用户ID',
  `date_id` int(11) NOT NULL COMMENT '数据ID',
  `c_status` enum('1','0') NOT NULL DEFAULT '0',
  `up_data` enum('1','0') NOT NULL DEFAULT '0',
  `create_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`u_id`,`date_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "udata_status"
#


#
# Structure for table "uhome"
#

CREATE TABLE `uhome` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `u_name` varchar(255) NOT NULL DEFAULT '',
  `u_bgm` varchar(100) DEFAULT NULL COMMENT '背景音乐',
  `u_cover_pic` varchar(255) DEFAULT NULL COMMENT '前景图',
  `u_bg_pic` varchar(255) DEFAULT NULL COMMENT '背景图',
  `create_at` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`,`u_name`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

#
# Data for table "uhome"
#

INSERT INTO `uhome` VALUES (1,'user1',NULL,NULL,NULL,NULL),(2,'user2',NULL,NULL,NULL,NULL),(3,'用户1',NULL,NULL,NULL,NULL),(5,'ardans',NULL,NULL,NULL,NULL),(6,'用户2',NULL,NULL,NULL,NULL),(7,'qweqwe',NULL,NULL,NULL,NULL),(8,'qqqqqqqq',NULL,NULL,NULL,NULL),(9,'ADWxca',NULL,NULL,NULL,NULL),(10,'yjjboy',NULL,NULL,NULL,NULL),(11,'YjjBoys',NULL,NULL,NULL,NULL);

#
# Structure for table "user"
#

CREATE TABLE `user` (
  `u_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `u_name` varchar(20) NOT NULL COMMENT '用户名',
  `u_password` varchar(20) NOT NULL COMMENT '密码',
  `u_sex` varchar(255) DEFAULT '' COMMENT '性别',
  `u_birth` varchar(255) DEFAULT NULL COMMENT '生日',
  `u_phone` varchar(11) DEFAULT NULL COMMENT '电话',
  `u_email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `u_motto` varchar(255) DEFAULT NULL COMMENT '座右铭',
  `u_intro` varchar(255) DEFAULT NULL COMMENT '自我介绍',
  `u_city` varchar(20) DEFAULT NULL COMMENT '城市',
  `u_cover` varchar(255) DEFAULT NULL COMMENT '头像',
  `u_bg` varchar(255) DEFAULT NULL,
  `create_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_update` int(11) DEFAULT NULL,
  `fabulous` varchar(255) DEFAULT NULL COMMENT '赞',
  `collection` varchar(255) DEFAULT NULL COMMENT '收藏',
  PRIMARY KEY (`u_id`,`u_name`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,'user1','123123','男','1970-01-20','15626233564','user1@163.com',NULL,NULL,NULL,'../images/portrait/b.jpg',NULL,0,NULL,NULL,NULL),(2,'user2','123123',NULL,NULL,NULL,'uern2@163.com',NULL,NULL,NULL,'../images/portrait/b.jpg',NULL,0,NULL,NULL,NULL),(5,'用户1','123123',NULL,NULL,NULL,'123123@qq.com',NULL,NULL,NULL,'../images/portrait/b.jpg',NULL,1559972043,NULL,NULL,NULL),(7,'ardans','Humingshan123','男','1997-06-17','15975631649','qwe@719481334qq.com','nice啊 兄弟','','海珠区','../images/portrait/121.jpg',NULL,1559973864,1560149769,NULL,NULL),(8,'用户2','123123','女','19970201123','43243562251','123123@qq.com','','','','../images/portrait/b.jpg','images/background/1560059767.dat',1559975708,1559988936,NULL,NULL),(9,'qweqwe','Qwe123',NULL,NULL,NULL,'qwe@qq.com',NULL,NULL,NULL,'../images/portrait/b.jpg',NULL,1559976349,NULL,NULL,NULL),(10,'qqqqqqqq','Qwe123',NULL,NULL,NULL,'qwe@qq.com',NULL,NULL,NULL,'../images/portrait/b.jpg',NULL,1559976401,NULL,NULL,NULL),(11,'ADWxca','Ardans123',NULL,NULL,NULL,'qwe@163.com',NULL,NULL,NULL,'../images/portrait/b.jpg',NULL,1559976839,NULL,NULL,NULL),(12,'yjjboy','Qweqwe123','',NULL,NULL,'yjj@qq.com',NULL,NULL,NULL,'../images/portrait/b.jpg',NULL,1560005618,NULL,NULL,NULL),(13,'YjjBoys','Humingshan123','',NULL,NULL,'yjj@qq.com',NULL,NULL,NULL,'../images/portrait/b.jpg',NULL,1560005720,NULL,NULL,NULL);
