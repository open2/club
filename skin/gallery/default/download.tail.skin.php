<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// �ڽ��� �ٿ�ε� �޴� ��� ������ ����Ʈ�� �����Ѵ�
if ($is_admin || ($write[mb_id] == $member[mb_id] && $member[mb_id]))
//    $write[wr_datetime] < date("Y-m-d H:i:s", $g4[server_time] - 86400 * 30))
{
    delete_point($member[mb_id], $bo_table, $wr_id, '�ٿ�ε�');
}
else
{
    // �Ѵ��� ������ ���� �Խù�
    //echo "if ($write[wr_datetime] > date(\"Y-m-d\", $g4[server_time] - 86400 * 30)) {"; exit;
    if ($write[wr_datetime] > date("Y-m-d", $g4[server_time] - 86400 * 30)) {
        // �Խ��ڿ��� ����Ʈ 50% �ο�
        insert_point($write[mb_id], (int)(abs($board[bo_download_point])/2), "{$member[mb_nick]}���� $board[bo_subject] $wr_id ���� �ٿ�ε�", $bo_table, $wr_id, "{$member[mb_nick]}���� �ٿ�ε�");
    }
}
?>
