<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// �ڽŸ��� �ڵ带 �־��ּ���.

$data_path = $g4[path]."/data/file/$bo_table";
$thumb_path = $data_path.'/thumb';
for ($i=count($tmp_array)-1; $i>=0; $i--) 
    @unlink("$thumb_path/{$tmp_array[$i]}");
?>
