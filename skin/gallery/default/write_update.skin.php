<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$board_skin_path = $cb_gallery_skin_path; 

include_once("$board_skin_path/skin.lib.php");

list($img_width, $img_height) = explode("x", $board[bo_1]);
list($img2_width, $img2_height) = explode("x", $board[bo_2]);
$img_quality = 100;

$data_path = $g4[path]."/data/file/$bo_table";
$thumb_path = $data_path.'/thumb';

@mkdir("$thumb_path", 0707);

if ($_FILES[bf_file][name][0]) {
    $row = sql_fetch(" select * from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '0' ");

    $file = $data_path .'/'. $row[bf_file];

    if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file)) {
        $thumb_file = "{$thumb_path}/{$wr_id}";
        $size = getimagesize($file);
        if ($size[2] == 1)
            $src = imagecreatefromgif($file);
        else if ($size[2] == 2)
            $src = imagecreatefromjpeg($file);
        else if ($size[2] == 3)
            $src = imagecreatefrompng($file);
        else
            break;
        if ($size[0] > $size[1]) {
            $rate = $board[bo_1] / $size[0];
            $height = (int)($size[1] * $rate);
            $img_width = $board[bo_1];
            $img_height = $height;
        } else {
            $rate = $board[bo_1] / $size[1];
            $width = (int)($size[0] * $rate);
            $img_width = $width;
            $img_height = $board[bo_1];
        }
        createThumb2($img_width, $img_height, $file, $thumb_file, $member[mb_id]);
        
        $thumb_file = "{$thumb_path}/{$wr_id}_{$img2_width}x{$img2_height}";
        createThumb($img2_width, $img2_height, $file, $thumb_file);

        $sql = " update $write_table set wr_10 = '$exif[Model]' where wr_id = '$wr_id' ";
        sql_query($sql);
    }
}
?>
