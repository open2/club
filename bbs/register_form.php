<?
include_once("./_common.php");

include_once("$nc[cb_path]/head.sub.php");

if ($cb[cb_id])
    include_once("$nc[cb_path]/club_main.head.php");
else
    include_once("$nc[cb_path]/head.php");

// $url이 없으면 클럽 메인으로 가도록
if (!$url) {
    $url = $nc[cb_url_path];
    if ($cb_id) {
        $url = $url . "/club_main.php?cb_id=$cb_id";

    }
    if ($wr_id)
        $url = $url . "?wr_id=$wr_id";
}

//$w="u";
//$mb_id=$member[mb_id];
//$_POST[mb_password] = sql_password($member[mb_password]);

include_once("$g4[bbs_path]/register_form.php");

if ($cb[cb_id])
    include_once("$nc[cb_path]/club_main.tail.php");
else
    include_once("$nc[cb_path]/tail.php");
?>
