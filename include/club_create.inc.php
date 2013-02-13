<?
$board_path = "$g4[path]/data/file/$bo_table";

$gr_id              = $nc[gr_id];
$bo_table           = $bo_table;
$bo_subject         = $cb_name;
$bo_admin           = $member[mb_id];
$bo_list_level      = "1";
$bo_read_level      = "1";
$bo_write_level     = "2";
$bo_reply_level     = "2";
$bo_comment_level   = "2";
$bo_link_level      = "2";
$bo_upload_level    = "2";
$bo_download_level  = "2";
$bo_html_level      = "2";
$bo_trackback_level = "2";
$bo_count_modify    = "10";
$bo_count_delete    = "10";
$bo_read_point      = $g4[cf_read_point];
$bo_write_point     = $g4[cf_write_point];
$bo_comment_point   = $g4[cf_comment_point];
$bo_download_point  = $g4[cf_download_point];
$bo_use_category    = "1";
$bo_category_list   = "$nc[nf_menu_list]";
$bo_disable_tags    = "";
$bo_skin            = "$nc[nf_bo_skin]";
$bo_use_list_view   = "0";
$bo_gallery_cols    = "4";
$bo_table_width     = "100";
$bo_page_rows       = "15";
$bo_subject_len     = "60";
$bo_new             = "24";
$bo_hot             = "100";
$bo_image_width     = "600";
$bo_write_min       = "";
$bo_write_max       = "";
$bo_comment_min     = "";
$bo_comment_max     = "";
$bo_upload_size     = "1024768";
$bo_reply_order     = "1";
$bo_include_head    = "";
$bo_include_tail    = "";
$bo_content_head    = "";
$bo_content_tail    = "";
$bo_insert_content  = "";
$bo_use_search      = "0";
$bo_order_search    = "";
$bo_1               = "550";
$bo_2               = "130x70";
$bo_3               = "3";
$bo_4               = "1000|1|3|180";
$bo_5               = "";
$bo_6               = "";
$bo_7               = "";
$bo_8               = "";
$bo_9               = "";
$bo_10              = "";
$bo_1_subj          = "view 폭";
$bo_2_subj          = "리스트 썸네일 폭x높이";
$bo_3_subj          = "비추천수";
$bo_4_subj          = "지식 최소포인트|최소가입일자|미채택횟수|미채택기간";
$bo_5_subj          = "";
$bo_6_subj          = "";
$bo_7_subj          = "";
$bo_8_subj          = "";
$bo_9_subj          = "";
$bo_10_subj         = "";
$bo_use_dhtml_editor= "1";
$bo_disable_tags    = "script|iframe";
$bo_use_sideview    = "1";
$bo_use_signature   = "1";

// 게시판 디렉토리 생성
@mkdir($board_path, 0707);
@chmod($board_path, 0707);

$sql_common = " gr_id               = '$gr_id',
                bo_subject          = '$bo_subject',
                bo_admin            = '$bo_admin',
                bo_list_level       = '$bo_list_level',
                bo_read_level       = '$bo_read_level',
                bo_write_level      = '$bo_write_level',
                bo_reply_level      = '$bo_reply_level',
                bo_comment_level    = '$bo_comment_level',
                bo_html_level       = '$bo_html_level',
                bo_link_level       = '$bo_link_level',
                bo_trackback_level  = '$bo_trackback_level',
                bo_count_write      = '0',
                bo_count_comment    = '0',
                bo_count_modify     = '$bo_count_modify',
                bo_count_delete     = '$bo_count_delete',
                bo_upload_level     = '$bo_upload_level',
                bo_download_level   = '$bo_download_level',
                bo_read_point       = '$bo_read_point',
                bo_write_point      = '$bo_write_point',
                bo_comment_point    = '$bo_comment_point',
                bo_download_point   = '$bo_download_point',
                bo_use_category     = '$bo_use_category',
                bo_category_list    = '$bo_category_list',
                bo_disable_tags     = '$bo_disable_tags',
                bo_use_sideview     = '$bo_use_sideview',
                bo_use_file_content = '$bo_use_file_content',
                bo_use_secret       = '$bo_use_secret',
                bo_use_comment      = '$bo_use_comment',
                bo_use_dhtml_editor = '$bo_use_dhtml_editor',
                bo_use_good         = '$bo_use_good',
                bo_use_nogood       = '$bo_use_nogood',
                bo_use_name         = '$bo_use_name',
                bo_use_signature    = '$bo_use_signature',
                bo_use_ip_view      = '$bo_use_ip_view',
                bo_use_trackback    = '$bo_use_trackback',
                bo_use_list_view    = '$bo_use_list_view',
                bo_use_list_content = '$bo_use_list_content',
                bo_table_width      = '$bo_table_width',
                bo_subject_len      = '$bo_subject_len',
                bo_page_rows        = '$bo_page_rows',
                bo_new              = '$bo_new',
                bo_hot              = '$bo_hot',
                bo_image_width      = '$bo_image_width',
                bo_skin             = '$bo_skin',
                bo_include_head     = '$bo_include_head',
                bo_include_tail     = '$bo_include_tail',
                bo_content_head     = '$bo_content_head',
                bo_content_tail     = '$bo_content_tail',
                bo_insert_content   = '$bo_insert_content',
                bo_gallery_cols     = '$bo_gallery_cols',
                bo_upload_size      = '$bo_upload_size',
                bo_reply_order      = '$bo_reply_order',
                bo_use_search       = '$bo_use_search',
                bo_order_search     = '$bo_order_search',
                bo_write_min        = '$bo_write_min',
                bo_write_max        = '$bo_write_max',
                bo_comment_min      = '$bo_comment_min',
                bo_comment_max      = '$bo_comment_max',
                bo_1                = '$bo_1',
                bo_2                = '$bo_2',
                bo_3                = '$bo_3',
                bo_4                = '$bo_4',
                bo_5                = '$bo_5',
                bo_6                = '$bo_6',
                bo_7                = '$bo_7',
                bo_8                = '$bo_8',
                bo_9                = '$bo_9',
                bo_10               = '$bo_10',
                bo_1_subj           = '$bo_1_subj',
                bo_2_subj           = '$bo_2_subj',
                bo_3_subj           = '$bo_3_subj',
                bo_4_subj           = '$bo_4_subj',
                bo_5_subj           = '$bo_5_subj',
                bo_6_subj           = '$bo_6_subj',
                bo_7_subj           = '$bo_7_subj',
                bo_8_subj           = '$bo_8_subj',
                bo_9_subj           = '$bo_9_subj',
                bo_10_subj          = '$bo_10_subj'
                ";

if ($is_open == true) {
    $sql = " insert into $g4[board_table]
                     set bo_table = '$bo_table',
                         $sql_common ";
    sql_query($sql);

    // 게시판 테이블 생성
    $file = file("$g4[admin_path]/sql_write.sql");
    $sql = implode($file, "\n");

    $create_table = $g4[write_prefix] . $bo_table;

    // sql_write.sql 파일의 테이블명을 변환
    $source = array("/__TABLE_NAME__/", "/;/");
    $target = array($create_table, "");
    $sql = preg_replace($source, $target, $sql);
    sql_query($sql, FALSE);
    
    // 클럽 방문자 테이블 생성
    $visit_table = $nc[tbl_visit] . "_" . $bo_table;
    
    $sql = " 
        CREATE TABLE `$visit_table` (
            `vi_id` int(11) NOT NULL default '0',
            `vi_ip` varchar(255) NOT NULL default '',
            `vi_date` date NOT NULL default '0000-00-00',
            `vi_time` time NOT NULL default '00:00:00',
            `vi_referer` text NOT NULL,
            `vi_agent` varchar(255) NOT NULL default '',
            PRIMARY KEY  (`vi_id`),
            KEY `index1` (`vi_date`)
      )
      ";
    sql_query($sql);

    // 클럽 방문자 통계 테이블 생성
    $visit_sum_table = $nc[tbl_visit] . "_sum_" . $bo_table;
    $sql = " 
        CREATE TABLE `$visit_sum_table` (
          `vs_date` date NOT NULL default '0000-00-00',
          `vs_count` int(11) NOT NULL default '0',
          PRIMARY KEY  (`vs_date`),
          KEY `index1` (`vs_count`)
      )
      ";
    sql_query($sql);
}
?>
