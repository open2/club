<?
// ������̱� - http://sir.co.kr/bbs/board.php?bo_table=g4_tiptech&wr_id=20648
include_once("_common.php");

// ���� xx���� ������ ����ϱ� ���ؼ�
$cb_id = strip_tags($cb_id);
$wr_id = strip_tags($wr_id);

$url = $nc[cb_url_path] . "/club_main.php?cb_id=$cb_id";

if ($wr_id)
    $url .= "&wr_id=$wr_id";

goto_url($url);
?>
