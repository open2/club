<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("해당 클럽이 존재하지 않습니다.");
}

if (!$is_manager) {
    error_msg("스텝권한 이상만 접근 가능합니다.");
}

$cb_latest_text = addslashes($_POST[cb_latest_text]);

$sql = " update $nc[tbl_club]
            set cb_latest_use               = '$cb_latest_use',
                cb_latest_skin              = '$cb_latest_skin',
                cb_latest_cols              = '$cb_latest_cols',
                cb_latest_len               = '$cb_latest_len',
                cb_latest_rows              = '$cb_latest_rows',
                cb_notice_skin              = '$cb_notice_skin',
                cb_coverstory_skin          = '$cb_coverstory_skin',
                cb_board_skin               = '$cb_board_skin',
                cb_gallery_skin             = '$cb_gallery_skin',
                cb_jisik_skin               = '$cb_jisik_skin',
                cb_oneline_skin             = '$cb_oneline_skin',
                cb_1to1_skin                = '$cb_1to1_skin',
                cb_schedule_skin            = '$cb_schedule_skin',
                cb_link_skin                = '$cb_link_skin',
                cb_mart_skin                = '$cb_mart_skin',
                cb_pds_skin                 = '$cb_pds_skin',
                cb_latest_text              = '$cb_latest_text',
                cb_latest_text_html         = '$cb_latest_text_html',
                cb_notice_latest_skin       = '$cb_notice_latest_skin',
                cb_coverstory_latest_skin   = '$cb_coverstory_latest_skin',
                cb_board_latest_skin        = '$cb_board_latest_skin',
                cb_gallery_latest_skin      = '$cb_gallery_latest_skin',
                cb_jisik_latest_skin        = '$cb_jisik_latest_skin',
                cb_oneline_latest_skin      = '$cb_oneline_latest_skin',
                cb_1to1_latest_skin         = '$cb_1to1_latest_skin',
                cb_schedule_latest_skin     = '$cb_schedule_latest_skin',
                cb_link_latest_skin         = '$cb_link_latest_skin',
                cb_mart_latest_skin         = '$cb_martv_skin',
                cb_pds_latest_skin          = '$cb_pds_latest_skin',
                cb_connect_skin             = '$cb_connect_skin'
          where cb_id = '$cb_id' ";
$result = sql_query($sql);

frame_url("./club_manager.php?doc=$doc&cb_id=$cb_id");
?>
