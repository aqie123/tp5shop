CREATE DATABASE IF NOT EXISTS tp5shop DEFAULT CHARSET utf8;
use tp5shop;

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for o2o_category
-- ----------------------------
DROP TABLE IF EXISTS `o2o_category`;
CREATE TABLE `o2o_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '分类名称',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '子类',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='生活服务分类表';

-- ----------------------------
-- Table structure for o2o_city
-- ----------------------------
DROP TABLE IF EXISTS `o2o_city`;
CREATE TABLE `o2o_city` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '城市名称',
  `uname` varchar(50) NOT NULL COMMENT '城市字母',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '子类',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否为默认',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`uname`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='城市表';

-- ----------------------------
-- Table structure for o2o_area
-- ----------------------------
DROP TABLE IF EXISTS `o2o_area`;
CREATE TABLE `o2o_area` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '商圈名称',
  `city_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '城市ID',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '子类',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商圈表';

-- ----------------------------
-- Table structure for o2o_bis
-- ----------------------------
DROP TABLE IF EXISTS `o2o_bis`;
CREATE TABLE `o2o_bis` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '商户名称',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '商户邮箱',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT 'Logo',
  `licence_logo` varchar(255) NOT NULL DEFAULT '' COMMENT '营业执照',
  `description` text NOT NULL COMMENT '描述',
  `city_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '城市ID',
  `city_path` varchar(50) NOT NULL DEFAULT '' COMMENT '城市所属',
  `bank_info` varchar(50) NOT NULL DEFAULT '' COMMENT '银行账号',
  `money` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `bank_name` varchar(50) NOT NULL DEFAULT '' COMMENT '开户行名称',
  `bank_user` varchar(50) NOT NULL DEFAULT '' COMMENT '开户人姓名',
  `bank_account` varchar(50) NOT NULL DEFAULT '' COMMENT '银行账号',
  `faren` varchar(20) NOT NULL DEFAULT '' COMMENT '法人',
  `faren_tel` varchar(20) NOT NULL DEFAULT '' COMMENT '法人电话',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商户表';

-- ----------------------------
-- Table structure for o2o_bis_account
-- ----------------------------
DROP TABLE IF EXISTS `o2o_bis_account`;
CREATE TABLE `o2o_bis_account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `code` varchar(10) NOT NULL DEFAULT '' COMMENT '盐值随机数',
  `bis_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商户ID',
  `last_login_ip` varchar(30) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `is_main` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为总管理员',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `bis_id` (`bis_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商户账号表';

-- ----------------------------
-- Table structure for o2o_bis_location
-- ----------------------------
DROP TABLE IF EXISTS `o2o_bis_location`;
CREATE TABLE `o2o_bis_location` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '门店名称',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT '门店Logo',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '门店地址',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '门店电话',
  `contact` varchar(20) NOT NULL DEFAULT '' COMMENT '门店联系人',
  `xpoint` varchar(20) NOT NULL DEFAULT '' COMMENT '经度',
  `ypoint` varchar(20) NOT NULL DEFAULT '' COMMENT '纬度',
  `bis_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商户ID',
  `open_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '营业开始时间',
  `end_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '营业结束时间',
  `content` text NOT NULL  COMMENT '门店介绍',
  `is_main` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为总管理员',
  `api_address` varchar(255) NOT NULL DEFAULT '' COMMENT '相关地址',
  `city_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '城市ID',
  `city_path` varchar(50) NOT NULL DEFAULT '' COMMENT '城市所属',
  `category_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `category_path` varchar(50) NOT NULL DEFAULT '' COMMENT '分类所属',
  `last_login_ip` varchar(30) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `bis_id` (`bis_id`),
  KEY `city_id` (`city_id`),
  KEY `category_id` (`category_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商户门店表';


-- ----------------------------
-- Table structure for o2o_deal
-- ----------------------------
DROP TABLE IF EXISTS `o2o_deal`;
CREATE TABLE `o2o_deal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `category_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品分类ID',
  `sec_category_id` varchar(50)  NOT NULL DEFAULT '0' COMMENT '商品二级分类ID',
  `bis_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商户ID',
  `location_ids` varchar(100) NOT NULL DEFAULT '' COMMENT '所属门店ID',
  `image` varchar(100) NOT NULL DEFAULT '' COMMENT '商品图片',
  `description` text NOT NULL COMMENT '商品描述',
  `start_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '团购开始时间',
  `end_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '团购结束时间',
  `origin_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '商品原价',
  `current_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '商品当前价格',
  `city_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '城市ID',
  `sec_city_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '二级城市ID',
  `buy_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最多买几份',
  `total_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品总量',
  `coupons_begin_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '团购券开始时间',
  `coupons_end_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '团购券失效时间',
  `xpoint` varchar(20) NOT NULL DEFAULT '' COMMENT '经度',
  `ypoint` varchar(20) NOT NULL DEFAULT '' COMMENT '纬度',
  `bis_account_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '提交数据商家的ID',
  `balance_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '商品结算价格',
  `notes` text NOT NULL  COMMENT '商品提示',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `category_id` (`category_id`),
  KEY `sec_category_id` (`sec_category_id`),
  KEY `start_time` (`start_time`),
  KEY `end_time` (`end_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='团购商品表';

-- ----------------------------
-- Table structure for o2o_user
-- ----------------------------
DROP TABLE IF EXISTS `o2o_user`;
CREATE TABLE `o2o_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `code` varchar(10) NOT NULL DEFAULT '' COMMENT '盐值随机数',
  `last_login_ip` varchar(30) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '用户邮箱',
  `mobile` varchar(50) NOT NULL DEFAULT '' COMMENT '用户手机号码',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE `username` (`username`),
  UNIQUE `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户账号表';

-- ----------------------------
-- Table structure for o2o_featured
-- ----------------------------
DROP TABLE IF EXISTS `o2o_featured`;
CREATE TABLE `o2o_featured` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '推荐位分类',
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '标题',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '跳转网址',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='推荐位表';

-- ----------------------------
-- Table structure for o2o_order
-- ----------------------------
drop table if exists o2o_order;
create table o2o_order(
  id int(11) unsigned not null auto_increment,
  out_trade_no varchar(100) not null default '' comment '订单编号',
  transaction_id varchar(100) not null default '' comment '微信支付订单编号',
  user_id int(11) not null default 0 comment '用户id',
  username varchar(50) not null default '' comment '用户名',
  pay_time varchar(20) not null default '' comment '微信支付时间',
  payment_id tinyint(1) not null default 1 comment '支付方式1默认微信支付',
  deal_id int(11) not null default 0 comment '商品id',
  deal_count int(11) not null default 0 comment '商品数量',
  pay_status tinyint(1) not null default 0 comment '支付状态,0：未支付,1:支付成功,2:支付失败,3:其他',
  total_price decimal(20,2) not null default 0.00 comment '总价',
  pay_amount decimal(20,2) not null default 0.00 comment '微信支付总价',
   status tinyint(1) unsigned not null default 1 comment '订单状态默认为1正常',
   referer varchar(255)  not null default '' comment '订单来自哪里',
   create_time int(11) unsigned not null default 0,
   update_time int(11) unsigned not null default 0,
   primary key(id),
   unique `out_trade_no`(`out_trade_no`),
   key user_id(`user_id`),
   key create_time(`create_time`)
)engine=InnoDB default charset=utf8 COMMENT='订单表';

SET FOREIGN_KEY_CHECKS=1

INSERT INTO `o2o_city` (`id`, `name`, `uname`, `parent_id`, `is_default`, `listorder`, `status`, `create_time`, `update_time`) VALUES
(1, '北京', 'beijing1', 0, 0, '0', 1, 1474013959, 0),
(2, '北京', 'beijing', 1, 0, '0', 1, 1474014007, 0),
(4, '江西', 'jiangxi', 0, 0, '0', 1, 1474014162, 0),
(5, '南昌', 'nanchang', 4, 1, '0', 1, 1474014181, 0),
(6, '上饶', 'shangrao', 4, 0, '0', 1, 1474014193, 0),
(7, '抚州', 'fuzhou', 4, 0, '0', 1, 1474014204, 0),
(8, '景德镇', 'jdz', 4, 0, '0', 1, 1474014220, 0),
(9, '九江', 'jiujiang', 4, 0, '0', 1, 0, 0),
(10, '赣州', 'ganzhou', 4, 0, '0', 1, 0, 0),
(11, '萍乡', 'pingxiang', 4, 0, '0', 1, 0, 0),
(12, '宜春', 'yichun', 4, 0, '0', 1, 0, 0),
(13, '吉安', 'jian', 4, 0, '0', 1, 0, 0);