<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("해당 클럽이 존재하지 않습니다.");
}

$is_manager = is_manager();
if (!$is_manager) {
    error_msg("스텝권한 이상만 접근 가능합니다.");
}

if ($cb_type == 2 || $cb_type == 3) {
    $cb_join_level = 1;
}

$sql = " update $nc[club_table]
            set cb_join = '$cb_join',
                cb_join_level = '$cb_join_level',
                cb_join_point = '$cb_join_point',
                cb_join_sex   = '$cb_join_sex',
                cb_ask_use = '$cb_ask_use'
          where cb_id = '$cb_id' ";
$result = mysql_query($sql);

if ($result) {
    foreach ($cb_ask as $value) {
        $cb_ask_body .= $value. "|";
    }
    
    $sql = " update $nc[tbl_cb_info]
                set cb_ask_body = '$cb_ask_body'
              where cb_id = '$cb_id' ";
    mysql_query($sql);
}

frame_url("./club_manager.php?doc=$doc&cb_id=$cb_id");
?>  
