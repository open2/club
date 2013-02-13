DROP TABLE IF EXISTS $nc[config_table];
CREATE TABLE $nc[config_table] (
  `nf_title` varchar(20) NOT NULL default '',
  `nf_width` varchar(5) NOT NULL default '',
  `nf_align` varchar(10) NOT NULL default '',
  `nf_opentype` tinyint(4) NOT NULL default '0',
  `nf_limits` tinyint(4) NOT NULL default '0',
  `nf_title_change_limits` tinyint(4) NOT NULL default '30',
  `nf_point_use` set('1','2','3','4') NOT NULL default '',
  `nf_save_point` int(11) NOT NULL default '0',
  `nf_read_point` int(11) NOT NULL default '0',
  `nf_write_point` int(11) NOT NULL default '0',
  `nf_comment_point` int(11) NOT NULL default '0',
  `nf_download_point` int(11) NOT NULL default '0',
  `nf_bo_skin` varchar(255) NOT NULL default '',
  `nf_outlogin_skin` varchar(255) NOT NULL default '',
  `nf_bo_notice_skin` VARCHAR( 255 ) NOT NULL default '',
  `nf_bo_coverstory_skin` VARCHAR( 255 ) NOT NULL default '',
  `nf_bo_board_skin` VARCHAR( 255 ) NOT NULL default '',
  `nf_bo_gallery_skin` VARCHAR( 255 ) NOT NULL default '',
  `nf_bo_jisik_skin` VARCHAR( 255 ) NOT NULL default '',
  `nf_bo_oneline_skin` VARCHAR( 255 ) NOT NULL default '',
  `nf_bo_1to1_skin` VARCHAR( 255 ) NOT NULL default '',
  `nf_bo_schedule_skin` VARCHAR( 255 ) NOT NULL default '',
  `nf_bo_link_skin` VARCHAR( 255 ) NOT NULL default '',
  `nf_bo_pds_skin` VARCHAR( 255 ) NOT NULL default '',
  `nf_bo_mart_skin` VARCHAR( 255 ) NOT NULL default '',
  `nf_latest_default_skin` VARCHAR( 255 ) NOT NULL default '',
  `nf_connect_default_skin` VARCHAR( 255 ) NOT NULL default '',
  `nf_menu_list` varchar(255) NOT NULL default '',
  `nf_clause` text NOT NULL,
  `nf_version` varchar(255) NOT NULL default ''
);

DROP TABLE IF EXISTS $nc[category_table];
CREATE TABLE $nc[category_table] (
  `cc_id` int(11) NOT NULL auto_increment,
  `cc_mid` int(11) NOT NULL default '0',
  `cc_idx` int(11) NOT NULL default '0',
  `cc_name` varchar(255) NOT NULL default '',
  `cc_total` int(11) NOT NULL default '0',
  `cc_1` varchar(255) NOT NULL default '',
  `cc_2` varchar(255) NOT NULL default '',
  `cc_3` varchar(255) NOT NULL default '',
  `cc_4` varchar(255) NOT NULL default '',
  `cc_5` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`cc_id`)
);

DROP TABLE IF EXISTS $nc[club_table];
CREATE TABLE $nc[club_table] (
  `cb_no` int(11) NOT NULL auto_increment,
  `cb_id` varchar(20) NOT NULL default '',
  `cb_name` varchar(255) NOT NULL default '',
  `cb_manager` varchar(255) NOT NULL default '',
  `cc_id` int(11) NOT NULL default '0',
  `cb_type` tinyint(4) NOT NULL default '1',
  `cb_state` set('1','2','3','4') NOT NULL default '1',
  `cb_join` set('Y','N') NOT NULL default 'Y',
  `cb_join_level` int(11) NOT NULL default '0',
  `cb_join_point` int(11) NOT NULL default '0',
  `cb_ask_use` set('Y','N') NOT NULL default 'N',
  `cb_latest_use` set('Y','N') NOT NULL default '',
  `cb_latest_text` text NOT NULL default '',
  `cb_latest_cols` set('1','2','3') NOT NULL default '',
  `cb_latest_rows` tinyint(4) NOT NULL default '0',
  `cb_latest_len` tinyint(4) NOT NULL default '0',
  `cb_top_method` set('1','2') NOT NULL default '',
  `cb_top_img` varchar(255) NOT NULL default '',
  `cb_top_img_src` varchar(255) NOT NULL default '',
  `cb_top_skin` varchar(255) NOT NULL default '',
  `cb_title_color_skin` varchar(255) NOT NULL default '',
  `cb_box_line_skin` varchar(255) NOT NULL default '',
  `cb_box_bg_skin` varchar(255) NOT NULL default '',
  `cb_coverstory_skin` varchar(255) NOT NULL default '',
  `cb_notice_skin` varchar(255) NOT NULL default '',
  `cb_board_skin` varchar(255) NOT NULL default '',
  `cb_gallery_skin` varchar(255) NOT NULL default '',
  `cb_jisik_skin` varchar(255) NOT NULL default '',
  `cb_oneline_skin` varchar(255) NOT NULL default '',
  `cb_1to1_skin` varchar(255) NOT NULL default '',
  `cb_schedule_skin` varchar(255) NOT NULL default '',
  `cb_link_skin` varchar(255) NOT NULL default '',
  `cb_mart_skin` varchar(255) NOT NULL default '',
  `cb_pds_skin` varchar(255) NOT NULL default '',
  `cb_latest_skin` varchar(255) NOT NULL default '',
  `cb_coverstory_latest_skin` varchar(255) NOT NULL default '',
  `cb_notice_latest_skin` varchar(255) NOT NULL default '',
  `cb_board_latest_skin` varchar(255) NOT NULL default '',
  `cb_gallery_latest_skin` varchar(255) NOT NULL default '',
  `cb_jisik_latest_skin` varchar(255) NOT NULL default '',
  `cb_oneline_latest_skin` varchar(255) NOT NULL default '',
  `cb_1to1_latest_skin` varchar(255) NOT NULL default '',
  `cb_schedule_latest_skin` varchar(255) NOT NULL default '',
  `cb_link_latest_skin` varchar(255) NOT NULL default '',
  `cb_mart_latest_skin` varchar(255) NOT NULL default '',
  `cb_pds_latest_skin` varchar(255) NOT NULL default '',
  `cb_connect_skin` VARCHAR( 255 ) NOT NULL default '',
  `cb_recommend` set('Y','N') NOT NULL default 'N',
  `cb_point` int(11) NOT NULL default '0',
  `cb_total_member` int(11) NOT NULL default '0',
  `cb_opendate` datetime NOT NULL default '0000-00-00 00:00:00',
  `cb_regdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `cb_title_change_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `cb_visit` varchar(255) NOT NULL default '',
  `cb_last_visit_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `cb_last_update_datetime` datetime NOT NULL default '0000-00-00 00:00:00',  
  `cb_1` varchar(255) NOT NULL default '',
  `cb_2` varchar(255) NOT NULL default '',
  `cb_3` varchar(255) NOT NULL default '',
  `cb_4` varchar(255) NOT NULL default '',
  `cb_5` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`cb_no`),
  KEY `cb_id` (`cb_id`),
  KEY `cb_manager` (`cb_manager`)
);

DROP TABLE IF EXISTS $nc[tbl_cb_info];
CREATE TABLE $nc[tbl_cb_info] (
  `cb_id` varchar(20) NOT NULL default '',
  `cb_keyword` varchar(255) NOT NULL default '',
  `cb_ask_body` text NOT NULL,
  `cb_content` text NOT NULL,
  PRIMARY KEY  (`cb_id`)
);

DROP TABLE IF EXISTS $nc[tbl_coverstory];
CREATE TABLE $nc[tbl_coverstory] (
  `cs_id` int(11) NOT NULL auto_increment,
  `cb_id` varchar(20) NOT NULL default '',
  `mb_id` varchar(255) NOT NULL default '',
  `cs_subject` varchar(255) NOT NULL default '',
  `cs_use` set('Y','N') NOT NULL default '',
  `cs_content` text NOT NULL,
  `cs_img` varchar(255) NOT NULL default '',
  `cs_img_src` varchar(255) NOT NULL default '',
  `cs_regdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `cs_1` varchar(255) NOT NULL default '',
  `cs_2` varchar(255) NOT NULL default '',
  `cs_3` varchar(255) NOT NULL default '',
  `cs_4` varchar(255) NOT NULL default '',
  `cs_5` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`cs_id`),
  KEY `cb_id` (`cb_id`),
  KEY `cs_use` (`cs_use`)
);

DROP TABLE IF EXISTS $nc[member_table];
CREATE TABLE $nc[member_table] (
  `cm_id` int(11) NOT NULL auto_increment,
  `cb_id` varchar(20) NOT NULL default '',
  `mb_id` varchar(255) NOT NULL default '',
  `cm_level` int(5) NOT NULL default '0',
  `cm_point` int(11) NOT NULL default '0',
  `cm_visit` int(11) NOT NULL default '0',
  `cm_logdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `cm_regdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `cm_query` text NOT NULL,
  `cm_reply` text NOT NULL,
  `cm_secede_datetime` DATETIME NOT NULL,
  `cm_1` varchar(255) NOT NULL default '',
  `cm_2` varchar(255) NOT NULL default '',
  `cm_3` varchar(255) NOT NULL default '',
  `cm_4` varchar(255) NOT NULL default '',
  `cm_5` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`cm_id`),
  KEY `cb_id` (`cb_id`),
  KEY `mb_id` (`mb_id`),
  KEY `cm_level` (`cm_level`),
  KEY `cm_logdate` (`cm_logdate`)
);

DROP TABLE IF EXISTS $nc[tbl_mb_level];
CREATE TABLE $nc[tbl_mb_level] (
  `ml_id` int(11) NOT NULL auto_increment,
  `cb_id` varchar(20) NOT NULL default '',
  `cm_level` int(11) NOT NULL default '0',
  `ml_name` varchar(30) NOT NULL default '',
  `ml_1` varchar(255) NOT NULL default '',
  `ml_2` varchar(255) NOT NULL default '',
  `ml_3` varchar(255) NOT NULL default '',
  `ml_4` varchar(255) NOT NULL default '',
  `ml_5` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`ml_id`),
  KEY `cb_id` (`cb_id`)
);

DROP TABLE IF EXISTS $nc[tbl_menu];
CREATE TABLE $nc[tbl_menu] (
  `cn_id` int(11) NOT NULL auto_increment,
  `cb_id` varchar(20) NOT NULL default '',
  `cn_name` varchar(40) NOT NULL default '',
  `cn_list_level` int(5) NOT NULL default '0',
  `cn_view_level` int(5) NOT NULL default '0',
  `cn_write_level` int(5) NOT NULL default '0',
  `cn_del_level` int(5) NOT NULL default '0',
  `cn_reply_level` int(5) NOT NULL default '0',
  `cn_comment_level` int(5) NOT NULL default '0',
  `cn_upload_level` int(5) NOT NULL default '0',
  `cn_download_level` int(5) NOT NULL default '0',
  `cn_type` enum('N','C','B','I','K','O','T','S','A','J','P','G','U','L') NOT NULL default 'B',
  `cn_url` varchar(255) NOT NULL default '',
  `cn_idx` int(11) NOT NULL default '0',
  `cn_1` varchar(255) NOT NULL default '',
  `cn_2` varchar(255) NOT NULL default '',
  `cn_3` varchar(255) NOT NULL default '',
  `cn_4` varchar(255) NOT NULL default '',
  `cn_5` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`cn_id`),
  KEY `cb_id` (`cb_id`),
  KEY `cn_name` (`cn_name`)
);

DROP TABLE IF EXISTS $nc[bo_clubhouse];
CREATE TABLE $nc[bo_clubhouse] (
  `wr_id` int(11) NOT NULL auto_increment,
  `wr_num` int(11) NOT NULL default '0',
  `wr_reply` varchar(10) NOT NULL default '',
  `wr_parent` int(11) NOT NULL default '0',
  `wr_is_comment` tinyint(4) NOT NULL default '0',
  `wr_comment` int(11) NOT NULL default '0',
  `wr_comment_reply` varchar(5) NOT NULL default '',
  `ca_name` varchar(255) NOT NULL default '',
  `wr_option` set('html1','html2','secret','mail') NOT NULL default '',
  `wr_subject` varchar(255) NOT NULL default '',
  `wr_content` text NOT NULL,
  `wr_link1` text NOT NULL,
  `wr_link2` text NOT NULL,
  `wr_link1_hit` int(11) NOT NULL default '0',
  `wr_link2_hit` int(11) NOT NULL default '0',
  `wr_trackback` varchar(255) NOT NULL default '',
  `wr_hit` int(11) NOT NULL default '0',
  `wr_good` int(11) NOT NULL default '0',
  `wr_nogood` int(11) NOT NULL default '0',
  `mb_id` varchar(255) NOT NULL default '',
  `wr_password` varchar(255) NOT NULL default '',
  `wr_name` varchar(255) NOT NULL default '',
  `wr_email` varchar(255) NOT NULL default '',
  `wr_homepage` varchar(255) NOT NULL default '',
  `wr_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `wr_last` varchar(19) NOT NULL default '',
  `wr_ip` varchar(255) NOT NULL default '',
  `wr_1` varchar(255) NOT NULL default '',
  `wr_2` varchar(255) NOT NULL default '',
  `wr_3` varchar(255) NOT NULL default '',
  `wr_4` varchar(255) NOT NULL default '',
  `wr_5` varchar(255) NOT NULL default '',
  `wr_6` varchar(255) NOT NULL default '',
  `wr_7` varchar(255) NOT NULL default '',
  `wr_8` varchar(255) NOT NULL default '',
  `wr_9` varchar(255) NOT NULL default '',
  `wr_10` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`wr_id`),
  KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  KEY `wr_is_comment` (`wr_is_comment`,`wr_id`)
);

DROP TABLE IF EXISTS $nc[tbl_cb_history];
CREATE TABLE $nc[tbl_cb_history] (
  `history_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
  `cb_id` VARCHAR( 20 ) NOT NULL ,
  `history_mb_id` VARCHAR( 255 ) NOT NULL ,
  `history_notice` VARCHAR( 255 ) NOT NULL ,
  `history_datetime` DATETIME NOT NULL ,
UNIQUE (
`history_id` 
)
);

DROP TABLE IF EXISTS $nc[visit_clubhouse];
CREATE TABLE $nc[visit_clubhouse] (
  `vi_id` int(11) NOT NULL default '0',
  `vi_ip` varchar(255) NOT NULL default '',
  `vi_date` date NOT NULL default '0000-00-00',
  `vi_time` time NOT NULL default '00:00:00',
  `vi_referer` text NOT NULL,
  `vi_agent` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`vi_id`),
  UNIQUE KEY `index1` (`vi_ip`,`vi_date`),
  KEY `index2` (`vi_date`)
);

DROP TABLE IF EXISTS $nc[visit_sum_clubhouse];
CREATE TABLE $nc[visit_sum_clubhouse] (
  `vs_date` date NOT NULL default '0000-00-00',
  `vs_count` int(11) NOT NULL default '0',
  PRIMARY KEY  (`vs_date`),
  KEY `index1` (`vs_count`)
);

## 2.2.1에서 추가된 config
ALTER TABLE `$nc[config_table]` ADD `nf_open_level` TEXT NOT NULL AFTER `nf_opentype` ; 
ALTER TABLE `$nc[config_table]` ADD `nf_filter` MEDIUMTEXT NOT NULL AFTER `nf_connect_default_skin` ;

## 2.2.2에서 추가된 config
ALTER TABLE `$nc[config_table]` ADD `nf_maintext` TEXT NOT NULL AFTER `nf_menu_list` ;
ALTER TABLE `$nc[config_table]` ADD `nf_search_default_skin` VARCHAR( 255 ) NOT NULL AFTER `nf_connect_default_skin` ; 

INSERT INTO $nc[tbl_config] 
(`nf_title`, `nf_width`, `nf_align`, `nf_opentype`, `nf_limits`, nf_title_change_limits, `nf_point_use`, `nf_save_point`, `nf_read_point`, `nf_write_point`, `nf_comment_point`, `nf_download_point`, `nf_bo_skin`, `nf_outlogin_skin`, `nf_bo_notice_skin`, `nf_bo_coverstory_skin`, `nf_bo_board_skin`, `nf_bo_gallery_skin`, `nf_bo_jisik_skin`, `nf_bo_oneline_skin`, `nf_bo_1to1_skin`, `nf_bo_schedule_skin`, `nf_bo_link_skin`, `nf_bo_pds_skin`, `nf_bo_mart_skin`, `nf_latest_default_skin`, `nf_connect_default_skin`, `nf_search_default_skin`, `nf_menu_list`, `nf_clause`, `nf_version`) 
VALUES ('클럽', '1000', 'center', 0, 3, 30, '1', 0, 0, 0, 0, 0, 'club', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', '공지사항|커버스토리|인사나누기|자유게시판|갤러리', '이용약관', '220');

INSERT INTO $nc[tbl_category] VALUES (10, 0, 0, '지역', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (20, 0, 0, '친목/모임', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (30, 0, 0, '동창/동문', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (40, 0, 0, '팬클럽', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (50, 0, 0, '게임', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (60, 0, 0, '만화/애니', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (70, 0, 0, '영화/비디오', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (80, 0, 0, '음악', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (90, 0, 0, '방송/연예', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (100, 0, 0, '취미', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (110, 0, 0, '문화/예술', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (120, 0, 0, '경제/금융', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (130, 0, 0, '교육/외국어', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (140, 0, 0, '컴퓨터/인터넷', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (150, 0, 0, '종교/봉사', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (160, 0, 0, '생활/건강', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (170, 0, 0, '스포츠/레저', 0, '', '', '', '', '');
INSERT INTO $nc[tbl_category] VALUES (180, 0, 0, '기타', 1, '', '', '', '', '');

### 2.2.0
ALTER TABLE `$nc[config_table]` ADD `nf_read_popular` INT( 11 ) NOT NULL AFTER `nf_download_point` ,
ADD `nf_write_popular` INT( 11 ) NOT NULL AFTER `nf_read_popular` ,
ADD `nf_comment_popular` INT( 11 ) NOT NULL AFTER `nf_write_popular` ,
ADD `nf_download_popular` INT( 11 ) NOT NULL AFTER `nf_comment_popular` ;

### 2.2.1
ALTER TABLE `$nc[menu_table]` ADD `cn_datetime` DATETIME NOT NULL AFTER `cn_idx` ; 

### 2.2.2
ALTER TABLE `$nc[club_table]` ADD `cb_join_sex` varchar(255) NOT NULL default '' NOT NULL AFTER `cb_join_level` ;
ALTER TABLE `$nc[club_table]` ADD `cb_connect_view` TINYINT( 4 ) NOT NULL AFTER `cb_connect_skin` ;
ALTER TABLE `$nc[club_table]` ADD `cb_left_textarea` TEXT NOT NULL AFTER `cb_last_update_datetime` ;
ALTER TABLE `$nc[club_table]` ADD `cb_tail_textarea` TEXT NOT NULL AFTER `cb_left_textarea` ; 

### 2.2.3
ALTER TABLE `$nc[config_table]` ADD `title_img_height` INT( 11 ) NOT NULL ;
UPDATE `$nc[config_table]` SET `title_img_height` = '70' ;
ALTER TABLE `$nc[config_table]` ADD `nf_maintext_html` TINYINT( 4 ) NOT NULL ;
ALTER TABLE `$nc[club_table]` ADD `cb_latest_text_html` TINYINT( 4 ) NOT NULL AFTER `cb_latest_text` ;

### 2.2.4
ALTER TABLE `$nc[config_table]` ADD `nf_club_text` TEXT NOT NULL ;
ALTER TABLE `$nc[config_table]` ADD `nf_club_text_use` TINYINT( 4 ) NOT NULL ;
ALTER TABLE `$nc[club_table]` ADD `cb_count_notice` INT( 11 ) NOT NULL ;
ALTER TABLE `$nc[club_table]` ADD `cb_count_coverstory` INT( 11 ) NOT NULL ;
ALTER TABLE `$nc[club_table]` ADD `cb_count_notice_datetime` DATETIME NOT NULL ;
ALTER TABLE `$nc[club_table]`ADD `cb_count_coverstory_datetime` DATETIME NOT NULL ;
ALTER TABLE `$nc[config_table]` ADD `nf_random_days` INT( 11 ) NOT NULL ;

### 2.2.5
ALTER TABLE `$nc[config_table]` CHANGE `nf_title` `nf_title` VARCHAR( 255 ) ; 

# 버젼정보 업데이트
UPDATE $nc[tbl_config] set nf_version = '225';