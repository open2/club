<?
include_once "./_common.php";

$g4[title] = "클럽업그레이드";
include_once("$nc[cb_path]/head.sub.php");

// 클럽 버젼
$club_version = 225;

echo "클럽을 {$club_version} 버젼으로 업그레이드 합니다.<Br>업그레이드 완료창이 나타날때까지 기다리시기 바랍니다.";

$sql    = " select nf_version from $nc[tbl_config]  ";
$row = sql_fetch($sql);

// 2.2.0 이전
if ($row[nf_version] < $club_version) {
    sql_query(" ALTER TABLE $nc[config_table] ADD `nf_title_change_limits` TINYINT( 4 ) NOT NULL ", FALSE);

    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_bo_notice_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_bo_coverstory_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_bo_board_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_bo_notice_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_bo_gallery_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_bo_jisik_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_bo_oneline_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_bo_1to1_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_bo_schedule_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_bo_link_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_bo_pds_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_bo_mart_skin` VARCHAR( 255 ) NOT NULL ", FALSE);

    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_latest_default_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_connect_default_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_search_default_skin` VARCHAR( 255 ) NOT NULL ", FALSE);

    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_last_update_datetime` datetime NOT NULL ", FALSE);

    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_notice_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_board_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_gallery_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_jisik_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_oneline_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_1to1_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_schedule_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_link_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_mart_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_pds_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_latest_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_notice_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
}

// 2.2.0
if ($row[nf_version] < $club_version) {
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_latest_text` text NOT NULL default '' ", FALSE);
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_coverstory_latest_skin` varchar(255) NOT NULL default '' ", FALSE);
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_notice_latest_skin` varchar(255) NOT NULL default '' ", FALSE);
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_board_latest_skin` varchar(255) NOT NULL default '' ", FALSE);
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_gallery_latest_skin` varchar(255) NOT NULL default '' ", FALSE);
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_jisik_latest_skin` varchar(255) NOT NULL default '' ", FALSE);
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_oneline_latest_skin` varchar(255) NOT NULL default '' ", FALSE);
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_1to1_latest_skin` varchar(255) NOT NULL default '' ", FALSE);
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_schedule_latest_skin` varchar(255) NOT NULL default '' ", FALSE);
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_link_latest_skin` varchar(255) NOT NULL default '' ", FALSE);
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_mart_latest_skin` varchar(255) NOT NULL default '' ", FALSE);
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_pds_latest_skin` varchar(255) NOT NULL default '' ", FALSE);
    sql_query(" ALTER TABLE $nc[member_table] ADD `cm_secede_datetime` DATETIME NOT NULL AFTER `cm_reply` ", FALSE);

    sql_query(" ALTER TABLE $nc[config_table]  ADD `nf_read_popular` INT( 11 ) NOT NULL  ", FALSE);
    sql_query(" ALTER TABLE $nc[config_table]  ADD `nf_write_popular` INT( 11 ) NOT NULL  ", FALSE);
    sql_query(" ALTER TABLE $nc[config_table]  ADD `nf_comment_popular` INT( 11 ) NOT NULL  ", FALSE);
    sql_query(" ALTER TABLE $nc[config_table]  ADD `nf_download_popular` INT( 11 ) NOT NULL  ", FALSE);
}

// 2.2.1
if ($row[nf_version] < $club_version) {
    sql_query(" ALTER TABLE $nc[menu_table] ADD `cn_datetime` DATETIME NOT NULL AFTER `cn_idx` ", FALSE);
    sql_query(" ALTER TABLE $nc[config_table] ADD `nf_open_level` TEXT NOT NULL AFTER `nf_opentype` ", FALSE);
    sql_query(" ALTER TABLE $nc[config_table] ADD `nf_filter` MEDIUMTEXT NOT NULL ", FALSE);
}

// 2.2.2
if ($row[nf_version] < $club_version) {
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_join_sex` varchar(1) NOT NULL default '' AFTER `cb_join_level` ", FALSE);
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_connect_view` TINYINT( 4 ) NOT NULL AFTER `cb_connect_skin` ", FALSE);
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_left_textarea` TEXT NOT NULL ", FALSE);
    sql_query(" ALTER TABLE $nc[config_table] ADD `nf_maintext` TEXT NOT NULL ", FALSE);
    sql_query(" ALTER TABLE $nc[config_table] ADD `nf_search_default_skin` VARCHAR( 255 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE $nc[club_table] ADD `cb_tail_textarea` TEXT NOT NULL  ", FALSE);
}

// 2.2.3
if ($row[nf_version] < $club_version) {
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `title_img_height` INT( 11 ) NOT NULL ", FALSE);
    sql_query(" UPDATE `$nc[config_table]` SET `title_img_height` = '70' ", FALSE);
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_maintext_html` TINYINT( 4 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_latest_text_html` TINYINT( 4 ) NOT NULL AFTER `cb_latest_text` ", FALSE);
}

// 2.2.4
if ($row[nf_version] < $club_version) {
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_club_text` TEXT NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_club_text_use` TINYINT( 4 ) NOT NULL ", FALSE);

    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_count_notice` INT( 11 ) NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_count_coverstory` INT( 11 ) NOT NULL ", FALSE);

    sql_query(" ALTER TABLE `$nc[club_table]` ADD `cb_count_notice_datetime` DATETIME NOT NULL ", FALSE);
    sql_query(" ALTER TABLE `$nc[club_table]`ADD `cb_count_coverstory_datetime` DATETIME NOT NULL ", FALSE);
    
    sql_query(" ALTER TABLE `$nc[config_table]` ADD `nf_random_days` INT( 11 ) NOT NULL ", FALSE);
}

// 2.2.5
if ($row[nf_version] < $club_version) {
    sql_query(" ALTER TABLE `$nc[config_table]` CHANGE `nf_title` `nf_title` VARCHAR( 255 ) ", FALSE);
}


// 버젼 정보를 업데이트    
//sql_query(" UPDATE $nc[config_table] SET nf_version = '223' ");

sql_query(" UPDATE $nc[config_table] SET nf_version = '$club_version' ");
alert("{$club_version} 버젼으로 업그레이드가 완료되었습니다.");
?>

<?
include_once("$nc[cb_path]/tail.sub.php");
?>
