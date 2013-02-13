<?
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

// ���Ŭ���� ��� �ʴ� �޾Ҵ��� Ȯ��
if ($cb[cb_type] == 3 && !get_club_invite($cb_id, $member[mb_id]))
    error_msg("ȸ�� {$member[mb_id]} �� �ʴ� ���� ���� ȸ���Դϴ�.");

// �̹� Ŭ�� ȸ������ ���Ե� ��� (������Ʈ �ϱ����� �ѹ� �� check)
$cb_member = get_club_member($cb[cb_id], $member[mb_id]);
if ($cb_member[mb_id])
    error_msg("�̹� Ŭ�� ȸ������ ��ϵǾ� �ֽ��ϴ�.");

// Ŭ�� ����Ʈ, 2: ��������, 3: ���Ա��(ȸ������Ʈ�� Ŭ����)
if ($nc[nf_point_use] == 2) {
    $cm_point = $nc[nf_save_point];
} else if ($nc[nf_point_use] == 3) {

    // ȸ������Ʈ�� ��������Ʈ ���� ������
    if ($member[mb_point] < $cb[cb_join_point]) {
        alert("���� �����ϰ� �ִ� ����Ʈ�� ���ڶ��ϴ�.");
    }

    $cm_point = $cb[cb_join_point];
}

// Ŭ�� ������ ȸ�� ���
switch ($cb[cb_type]) {
    case  2 : $cm_level = 10; break;
    default :
    case  3 : 
    case  1 : $cm_level = $cb[cb_join_level]; break;
}

// ���� ������ ���� �亯
if ($reply) {
    foreach ($reply as $value) {
        $cm_reply .= $value. "|";
    }
    $cm_query = $cb[cb_ask_body];
}

$sql = " insert into $nc[member_table]
                 set cb_id = '$cb[cb_id]',
                     mb_id = '$member[mb_id]',
                     cm_level = '$cm_level',
                     cm_point = '$cm_point',
                     cm_visit = '1',
                     cm_logdate = now(),
                     cm_regdate = now(),
                     cm_query = '$cm_query',
                     cm_reply = '$cm_reply',
                     cm_1 = '$cm_1',
                     cm_2 = '$cm_2',
                     cm_3 = '$cm_3',
                     cm_4 = '$cm_4',
                     cm_5 = '$cm_5' ";
$result = sql_query($sql);

// Ŭ�� ���� ���̺��� ��ȸ���� ����
if ($result) {
    // ����Ʈ ���
    $point = $cm_point * (-1);
    if ($nc[nf_point_use] == 3) {
        insert_point($member[mb_id], $point, "{$cb[cb_name]} Ŭ������");
    }
    
    sql_query(" update $nc[club_table] set cb_total_member = cb_total_member + 1, cb_point = cb_point + '$cm_point' where cb_id = '$cb[cb_id]' ");
}

// cm_level�� �̸��� ���մϴ�.
$sql = " select ml_name from $nc[mb_level_table] where cb_id = '$cb[cb_id]' and cm_level = '$cm_level' ";
$cm_level_result = sql_fetch($sql);
if (!$cm_level_result)
    error_msg("ȸ�������� �����Դϴ�. �����ڿ��� ���� �Ͻñ� �ٶ��ϴ�.");

// ���ȸ���� ����Ȯ���� history�� ����ݴϴ�
$url = "./club_main.php?cb_id=$cb[cb_id]";
if ($cb[cb_type] == 3)
{
    $sql = " update $nc[cb_history_table]
                    set history_notice = '���Ŭ�����ԿϷ�' 
              where cb_id = '$cb_id' and history_mb_id = '$member[mb_id]' and history_notice = '���Ŭ�������ʴ�' ";
    sql_query($sql);

    error_msg("���Ŭ�� ȸ������ ��ϵǾ����ϴ�. ȸ�������� {$cm_level_result[ml_name]} �Դϴ�.", $url, 1);
} else if ($cb[cb_type] == 2) {
    error_msg("�����Ͻ� Ŭ���� �ش� Ŭ���������� ������ ������ ������ Ŭ�� �Դϴ�.", $url, 1);
} else {
    error_msg("Ŭ�� ȸ������ ��ϵǾ����ϴ�. ȸ�������� {$cm_level_result[ml_name]} �Դϴ�.", $url, 1);
}

frame_url("./club_main.php?cb_id=$cb[cb_id]");
?>
