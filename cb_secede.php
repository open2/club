<?
include_once "./_common.php";

if (!$member[mb_id]) {
    error_msg("�α����Ŀ� �̿��ϼ���.");
}

if (!$cb[cb_id]) {
    error_msg("�ش� Ŭ���� �������� �ʽ��ϴ�.");
}

if (!$cm[mb_id]) {
    error_msg("Ŭ���� ȸ���� �ƴմϴ�.");
}

if ($cm[cm_level] <= 0 && $is_admin!=="super") {
    error_msg("ȸ���� �ƴϹǷ� Ż���� �� �����ϴ�.");
}

// Ż���Ϸ��� ȸ���� �Ŵ����ϰ�� Ż�� �Ұ�
if (is_manager() == "manager" && $cb[cb_manager] == $member[mb_id]) {
    error_msg("Ŭ�� �Ŵ����� Ż�� �� �� �����ϴ�. Ŭ���� �絵�� Ż�� �Ͻñ� �ٶ��ϴ�.");
}

$sql    = " delete from $nc[member_table] where mb_id = '$member[mb_id]' and cb_id ='$cb[cb_id]' "; 
$result = sql_query($sql);

// Ż���� ����ó��
if ($result) {
    //Ŭ�� ������ ��ȸ���� ����
    sql_query(" update $nc[club_table] set cb_total_member = cb_total_member - 1 where cb_id = '$cb[cb_id]' ");
    
    // Ŭ������Ʈ ����, $nc[nf_point_use], 1:������, 2: ��������, 3: ���Ա��
    if ($nc[nf_point_use] > 1) {
        sql_query(" update $nc[club_table] set cb_point = cb_point - $nc[nf_save_point] where cb_id = '$cb[cb_id]' ");
    }
}

frame_url("./club_index.php");
?>