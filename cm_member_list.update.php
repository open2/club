<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("�ش� Ŭ���� �������� �ʽ��ϴ�.");
}

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

frame_url("./club_manager.php?doc=cm_member_list.php&cb_id=$cb_id&page=$page");
?>
