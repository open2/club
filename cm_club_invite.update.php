<?
$cb_id = $_POST[cb_id];
$club_invite_mb_id = $_POST['club_invite_mb_id'];
$w = $_POST['w'];

include_once "./_common.php";

// Ŭ���� �������� �ʰų� $cb_id�� �������
if (!$cb[cb_id]) {
    error_msg("Ŭ���� �������� �ʽ��ϴ�.");
}

if (!$member[mb_id]) {
    error_msg("�α����Ŀ� �̿��ϼ���");
}

// Ŭ�� ���� �Ұ�
if ($cb[cb_join] == "N") {
    error_msg("���� Ŭ������ ȸ�� ������ ���� �ʽ��ϴ�.");
}

// �ʴ���� ����� ȸ���� �ƴ� ��쿡��?
$mb = get_member($club_invite_mb_id);
if (!$mb[mb_id]) {
    error_msg("�ʴ��� ȸ�� {$club_invite_mb_id} �� ���� �������� �ʽ��ϴ�.");
}

// �̹� �ʴ��� ��쿡��
if ($w == "" && get_club_invite($cb_id, $club_invite_mb_id)) {
    error_msg("ȸ�� {$club_invite_mb_id} �� �̹� �ʴ��Ͽ����ϴ�.");
}

// �̹� Ŭ�� ȸ������ ���Ե� ��� (������Ʈ �ϱ����� �ѹ� �� check)
$cb_member = get_club_member($cb[cb_id], $club_invite_mb_id);
if ($cb_member[mb_id])
    error_msg("�̹� Ŭ�� ȸ������ ��ϵǾ� �ֽ��ϴ�.");

// history table�� ��û history�� ��� �մϴ�.
if ($w == "") {
    $sql = " insert $nc[cb_history_table]
            set cb_id = '$cb_id',
                history_mb_id = '$club_invite_mb_id',
                history_notice = '���Ŭ�������ʴ�',
                history_datetime = '$g4[time_ymdhis]'
            ";
    sql_query($sql);

    error_msg("���Ŭ��ȸ������ {$club_invite_mb_id} �� �ʴ� �Ͽ����ϴ�.");
} else if ($w == "cancel") {
    $sql = " update $nc[cb_history_table]
                set history_notice = '���Ŭ�������ʴ����'
              where cb_id = '$cb_id' 
                    and history_mb_id = '$club_invite_mb_id'
                    and history_notice = '���Ŭ�������ʴ�'
            ";
    sql_query($sql);

    error_msg("{$club_invite_mb_id} ���� ���Ŭ��ȸ�� �ʴ븦 ��� �Ͽ����ϴ�.");
} else {
    error_msg("�����Դϴ�. Ȯ���غ� �ּ���. cm_club_invite.update.php");
}
?>
