<?
include_once("./_common.php");

include_once("$nc[cb_path]/head.sub.php");

if ($cb[cb_id])
    include_once("$nc[cb_path]/club_main.head.php");
else
    include_once("$nc[cb_path]/head.php");

// $url이 없으면 클럽 메인으로 가도록
if (!$url) {
    $url = $nc[cb_url_path] . "/";
    if ($cb_id && $cb_id !== "cb_") {
        $url = $url . "/club_main.php?cb_id=$cb_id";
        if ($wr_id)
            $url = $url . "?wr_id=$wr_id";
    }
}

// 로그인중인 경우 회원가입 할 수 없습니다.
if (!$member[mb_id]) 
    include_once("$g4[bbs_path]/register.php");
else
    goto_url($nc[cb_path]);

if ($cb[cb_id])
    include_once("$nc[cb_path]/club_main.tail.php");
else
    include_once("$nc[cb_path]/tail.php");
?>
