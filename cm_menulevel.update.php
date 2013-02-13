<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("해당 클럽이 존재하지 않습니다.");
}

if (!$is_manager) {
    error_msg("스텝권한 이상만 접근 가능합니다.");
}

if ($_POST[exec] == "update") {
    foreach ($chk as $i) {
		$sql = " update $nc[tbl_menu]
					set cn_view_level = '$cn_view_level[$i]',
					    cn_write_level = '$cn_write_level[$i]',
					    cn_del_level = '$cn_del_level[$i]',
					    cn_list_level = '$cn_list_level[$i]',
					    cn_reply_level = '$cn_reply_level[$i]',
					    cn_comment_level = '$cn_comment_level[$i]',
 					    cn_1 = '$cn_1[$i]'
				  where cb_id = '$cb_id'
				    and cn_id = '$cn_id[$i]' ";
		mysql_query($sql);
	}
}              

frame_url("./club_manager.php?doc=$doc&cb_id=$cb_id");
?>
