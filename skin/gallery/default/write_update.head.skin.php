<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

if ($_FILES[bf_file][name][0]) {
    $exif = @exif_read_data($_FILES[bf_file][tmp_name][0]);
    if (!$exif[Make]) {
        alert("EXIF ������ ���� �̹����� ����� �Ұ��մϴ�.");
        exit;
    }
}
?>
