<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 자신만의 코드를 넣어주세요.

$data_path = $g4[path]."/data/file/$bo_table";
$thumb_path = $data_path.'/thumb';
for ($i=count($tmp_array)-1; $i>=0; $i--) 
    @unlink("$thumb_path/{$tmp_array[$i]}");
?>
