<?
$cb_path  = ".";

// ���޵Ǵ� �μ��� $que�� injection�� ���´�
$que      = strip_tags($_SERVER[QUERY_STRING]);

if (!$que)
    $path = "$cb_path/club_index.php";
else
    $path = "$cb_path/club_main.php?cb_id=$que";

echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=$path\">";
?>