<?
$cb_path  = ".";

// 전달되는 인수값 $que의 injection을 막는다
$que      = strip_tags($_SERVER[QUERY_STRING]);

if (!$que)
    $path = "$cb_path/club_index.php";
else
    $path = "$cb_path/club_main.php?cb_id=$que";

echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=$path\">";
?>