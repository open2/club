<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

$downloadCount = 3;

if (!$is_admin) {
    $sql = " select bf_download from $g4[board_file_table]
              where bo_table = '$bo_table'
                and wr_id = '$wr_id'
                and bf_no = 0 ";
    $row = sql_fetch($sql);
    if ($row[bf_download] >= $downloadCount) {
        alert("�ٿ�ε���� {$downloadCount}ȸ �̻��̸� ���� �Ұ��մϴ�. ���� �ٿ�ε�� : {$row[bf_download]}ȸ");
    }
}
?>
