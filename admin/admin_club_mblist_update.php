<?
include_once "./_common.php";

$cb = get_club($cb_id);
if (!$cb[cb_id]) {
    error_msg("�ش� Ŭ���� �������� �ʽ��ϴ�.");
}

$cm = get_club_member($cb[cb_id], $member[mb_id]);
$is_manager = is_manager();
if (!$is_manager) {
    error_msg("���ܱ��� �̻� ���� �����մϴ�.");
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
