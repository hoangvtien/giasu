<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 16 Jun 2014 10:31:33 GMT
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_giasu`";
$sql_drop_module[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_dangky`";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_giasu` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `idclass` mediumint(9) NOT NULL,
  `namestu` varchar(255) NOT NULL COMMENT 'Tên người cần tìm',
  `alias` varchar(255) NOT NULL,
  `numberstu` tinyint(4) NOT NULL COMMENT 'Số người học',
  `teaching` varchar(50) NOT NULL COMMENT 'Dạy môn',
  `sessionnum` tinyint(4) NOT NULL COMMENT 'Số buổi/tuần',
  `training` varchar(30) NOT NULL COMMENT 'Các buổi Dạy trong tuần',
  `email` varchar(100) NOT NULL COMMENT 'Email',
  `phonenumber` varchar(30) NOT NULL COMMENT 'Số điện thoại',
  `requirements` text NOT NULL COMMENT 'Yêu cầu',
  `address` varchar(255) NOT NULL COMMENT 'Địa chỉ',
  `weight` tinyint(4) NOT NULL COMMENT 'STT',
  `avartar` varchar(255) NOT NULL COMMENT 'Hình ảnh',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;";
$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_dangky` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `namegs` varchar(50) NOT NULL COMMENT 'Tên người đăng ký',
  `alias` varchar(255) NOT NULL,
  `datebirth` varchar(10) NOT NULL COMMENT 'Ngày sinh',
  `workplace` varchar(255) NOT NULL COMMENT 'Nơi công tác hiện nay',
  `email` varchar(255) NOT NULL,
  `subregister` varchar(150) NOT NULL COMMENT 'Môn đăng ký dạy',
  `begindate` int(11) NOT NULL COMMENT 'Bắt đầu thời gian dạy',
  `enddate` int(11) NOT NULL COMMENT 'Kết thúc',
  `numsession` tinyint(4) NOT NULL COMMENT 'Số buổi',
  `phonenumber` varchar(30) NOT NULL COMMENT 'Số điện thoại',
  `weight` smallint(6) NOT NULL COMMENT 'STT',
  `avartar` varchar(255) NOT NULL COMMENT 'Avartar',
  `requirements` text NOT NULL COMMENT 'Yêu cầu',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;