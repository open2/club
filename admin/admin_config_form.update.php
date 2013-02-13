<?
include_once "./_common.php";

// Å¬·´Æø 100ÀÌÇÏ %
if ($nf_width <= 100) {
    $nf_width .= "%";
}

$nf_maintext = addslashes($nf_maintext);
$nf_club_text = addslashes($nf_club_text);

$sql = " update $nc[tbl_config]
            set nf_title = '$nf_title',
                nf_width = '$nf_width',
                nf_align = '$nf_align',
                nf_opentype = '$nf_opentype',
                nf_open_level = '$nf_open_level',
                nf_limits = '$nf_limits',
                nf_title_change_limits = '$nf_title_change_limits',
                nf_point_use = '$nf_point_use',
                nf_save_point = '$nf_save_point',
                nf_read_point = '$nf_read_point',
                nf_write_point = '$nf_write_point',
                nf_comment_point = '$nf_comment_point',
                nf_download_point = '$nf_download_point',
                nf_read_popular = '$nf_read_popular',
                nf_write_popular = '$nf_write_popular',
                nf_comment_popular = '$nf_comment_popular',
                nf_download_popular = '$nf_download_popular',
                nf_bo_skin = '$nf_bo_skin',
                nf_outlogin_skin = '$nf_outlogin_skin',
                nf_bo_notice_skin = '$nf_bo_notice_skin',
                nf_bo_coverstory_skin = '$nf_bo_coverstory_skin',
                nf_bo_board_skin = '$nf_bo_board_skin',
                nf_bo_gallery_skin = '$nf_bo_gallery_skin',
                nf_bo_jisik_skin = '$nf_bo_jisik_skin',
                nf_bo_oneline_skin = '$nf_bo_oneline_skin',
                nf_bo_1to1_skin = '$nf_bo_1to1_skin',
                nf_bo_schedule_skin = '$nf_bo_schedule_skin',
                nf_bo_link_skin = '$nf_bo_link_skin',
                nf_bo_pds_skin = '$nf_bo_pds_skin',
                nf_bo_mart_skin = '$nf_bo_mart_skin',
                nf_latest_default_skin = '$nf_latest_default_skin',
                nf_connect_default_skin = '$nf_connect_default_skin',
                nf_search_default_skin = '$nf_search_default_skin',
                nf_maintext = '$nf_maintext',
                nf_filter = '$nf_filter',
                nf_menu_list = '$nf_menu_list',
                nf_clause = '$nf_clause',
                title_img_height = '$title_img_height',
                nf_maintext_html = '$nf_maintext_html',
                nf_club_text = '$nf_club_text',
                nf_club_text_use = '$nf_club_text_use',
                nf_random_days = '$nf_random_days'
                 ";
$result = sql_query($sql);

if ($result) {
    $sql = " update $g4[board_table]
                set bo_read_point = '$nf_read_point',
                    bo_write_point = '$nf_write_point',
                    bo_comment_point = '$nf_comment_point',
                    bo_download_point = '$nf_download_point',
                    bo_skin = '$nf_bo_skin'
              where gr_id = '$nc[gr_id]' ";
    sql_query($sql);
}

frame_url("./club_admin.php?doc=admin_config_form.php");
?>
