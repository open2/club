<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$data_path = $g4[path]."/data/file/$bo_table";
$thumb_path = $data_path.'/thumb';
@unlink("$thumb_path/$wr_id");
?>
