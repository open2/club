<?
include_once "./_common.php";

// 클럽이 존재하지 않거나 $cb_id가 없을경우
if (!$cb[cb_id]) {
    error_msg("해당 클럽이 존재하지 않습니다.", "$nc[cb_url_path]/club_index.php");
}

if (!is_manager()) {
    error_msg("스텝권한 이상만 접근 가능합니다.");
}

// 클럽명 중복 검사
if ($cb_name != $tmp_cb_name) {
    $chk_name = sql_total($nc[tbl_club], "cb_name", $cb_name);
    if ($check > 0) {
        error_msg("이미 사용중인 클럽명입니다.\\n\\n다른 클럽명을 선택하세요.");
    }
}

// 카테고리 업데이트
if ($cc_id != $tmp_cc_id) {
    sql_query(" update $nc[category_table] set cc_total = cc_total - 1 where cc_id = '$tmp_cc_id' ");
    sql_query(" update $nc[category_table] set cc_total = cc_total + 1 where cc_id = '$cc_id' ");
}

// 운영 상태에 따른 카테고리 업데이트
if ($cb_state != $tmp_cb_state && $cb_state == 3) {
    sql_query(" update $nc[category_table] set cc_total = cc_total - 1 where cc_id = '$cc_id' ");
}

//폐쇄,대기 에서 운영으로 바꾸면 +1 by Daeng2 
if ($cb_state != $tmp_cb_state && $cb_state == 1) { 
    sql_query(" update $nc[category_table] set cc_total = cc_total + 1 where cc_id = '$cc_id' "); 
} 

$cb_left_textarea = addslashes($cb_left_textarea);
$cb_tail_textarea = addslashes($cb_tail_textarea);

$sql = " update $nc[tbl_club]
              set 
                  cc_id = '$cc_id',
                  cb_type = '$cb_type',
                  cb_state = '$cb_state',
                  cb_connect_view = '$cb_connect_view',
                  cb_left_textarea = '$cb_left_textarea',
                  cb_tail_textarea = '$cb_tail_textarea'
            where cb_id = '$cb_id' ";
sql_query($sql);

//클럽명이 변경되었을 때
if ($cb_name !== $cb[cb_name]) {
  $sql = " update $nc[tbl_club]
              set 
                  cb_name = '$cb_name',
                  cb_title_change_date = '$g4[time_ymdhis]'
            where cb_id = '$cb_id' ";
}
$result = sql_query($sql);

if ($result) {
    $sql = " update $nc[tbl_cb_info]
                set cb_keyword = '$cb_keyword',
                    cb_ask_body = '$cb_ask_body',
                    cb_content = '$cb_content'
              where cb_id = '$cb_id' ";
    sql_query($sql);

    // 게시판 정보도 변경
    $sql = " update $g4[board]
                set bo_name = '$cb_name'
              where bo_table = '$cb_id' ";
    sql_query($sql);
}

frame_url("./club_manager.php?doc=$doc&cb_id=$cb_id");
?>            
