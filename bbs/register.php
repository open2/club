<?
include_once("./_common.php");

include_once("$nc[cb_path]/head.sub.php");

if ($cb[cb_id])
    include_once("$nc[cb_path]/club_main.head.php");
else
    include_once("$nc[cb_path]/head.php");

// $url�� ������ Ŭ�� �������� ������
if (!$url) {
    $url = $nc[cb_url_path] . "/";
    if ($cb_id && $cb_id !== "cb_") {
        $url = $url . "/club_main.php?cb_id=$cb_id";
        if ($wr_id)
            $url = $url . "?wr_id=$wr_id";
    }
}

// �α������� ��� ȸ������ �� �� �����ϴ�.
if (!$member[mb_id]) 
    include_once("$g4[bbs_path]/register.php");
else
    goto_url($nc[cb_path]);

if ($cb[cb_id])
    include_once("$nc[cb_path]/club_main.tail.php");
else
    include_once("$nc[cb_path]/tail.php");
?>
