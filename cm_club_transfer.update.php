<?
include_once "./_common.php";

if ($w=="approve") {
    $cb_id = strip_tags($cb_id);
    $club_transfer_mb_id = $member[mb_id];
} else {
    $cb_id = $_POST[cb_id];
    $club_transfer_mb_id = $_POST['club_transfer_mb_id'];
    $w = $_POST['w'];
}

// Ŭ���� �������� �ʰų� $cb_id�� �������
if (!$cb[cb_id]) {
    error_msg("Ŭ���� �������� �ʽ��ϴ�.");
}

if (!$member[mb_id]) {
    error_msg("�α����Ŀ� �̿��ϼ���");
}

// �絵��û�� ���� ����� ȸ���� �ƴ� ��쿡��?
$mb = get_member($club_transfer_mb_id);
if (!$mb[mb_id]) {
    error_msg("ȸ�� {$club_transfer_mb_id} �� ���� �������� �ʽ��ϴ�.");
}

// �̹� �絵�� ��û�� ��쿡��
if ($w == "" && get_club_transfer($cb_id)) {
    error_msg("Ŭ�� ������� �������Դϴ�.");
}

// Ŭ�� ȸ������ Ȯ�� �մϴ�.
$cm_tmp = get_club_member($cb_id, $club_transfer_mb_id);
if (!$cm_tmp || $cm_tmp[cm_level] <= 0)
    error_msg("Ŭ�� ������� �ʿ��� ȸ���ڰ��� �ƴմϴ�.");

// history table�� ��û history�� ��� �մϴ�.
if ($w == "") {
    $sql = " insert $nc[cb_history_table]
            set cb_id = '$cb_id',
                history_mb_id = '$club_transfer_mb_id',
                history_notice = 'Ŭ���絵��û',
                history_datetime = '$g4[time_ymdhis]'
            ";
    sql_query($sql);

    error_msg("{$club_transfer_mb_id} �Կ��� Ŭ��������� ��û �Ͽ����ϴ�.");
} else if ($w == "cancel") {
    $sql = " update $nc[cb_history_table]
                set history_notice = 'Ŭ���絵��û���'
              where cb_id = '$cb_id' 
                    and history_mb_id = '$club_transfer_mb_id'
                    and history_notice = 'Ŭ���絵��û'
            ";
    sql_query($sql);

    error_msg("{$club_transfer_mb_id} ���� Ŭ������� ��û�� ��� �Ͽ����ϴ�.");
} else if ($w == "approve") {

    $sql = " update $nc[cb_history_table]
                set history_notice = 'Ŭ���絵����'
              where cb_id = '$cb_id' 
                    and history_mb_id = '$club_transfer_mb_id'
                    and history_notice = 'Ŭ���絵��û'
            ";
    sql_query($sql);

    // �絵���� ������ ��ȸ������ ���� �մϴ�.
    $sql = " update $nc[member_table] set cm_level = '30' where cb_id = '$cb_id' and mb_id = '$cb[cb_manager]'";
    sql_query($sql);
    
    // Ŭ�� ������ ������ ��������� update �մϴ�.
    $sql = " update $nc[club_table] set cb_manager = '$club_transfer_mb_id' where cb_id = '$cb_id' ";
    sql_query($sql);

    // ȸ�������� �÷��ݴϴ�.
    $sql = " update $nc[member_table] set cm_level = '100' where cb_id = '$cb_id' and mb_id = '$club_transfer_mb_id'";
    sql_query($sql);

    error_msg("Ŭ������� ��û�� �����Ͽ����ϴ�.", "$nc[cb_path]/club_main.php?cb_id=$cb_id");
} else {
    error_msg("�����Դϴ�. Ȯ���غ� �ּ���. cm_club_transfer.update.php");
}
?>
