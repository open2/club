<?
include_once "./_common.php";

$cb = get_club($cb_id);
if (!$cb[cb_id]) {
    error_msg("해당 클럽이 존재하지 않습니다.");
}

$cm = get_club_member($cb[cb_id], $member[mb_id]);
$is_manager = is_manager();
if (!$is_manager) {
    error_msg("스텝권한 이상만 접근 가능합니다.");
}

if ($_POST[exec] == "update") {
    foreach ($chk as $i) {
        $sql = " update $nc[tbl_member]
                    set cm_level = '$cm_level[$i]'
                  where mb_id = '$mb_id[$i]'
                    and cb_id = '$cb_id' ";
        mysql_query($sql);
    }
}

goto_url("./admin_club_mblist.php?cb_id=$cb_id");
?>
