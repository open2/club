<?
include_once("./_common.php");

if (!$member[mb_id]) {
	error_msg("�α��� �Ŀ� �̿��ϼ���");
}

$g4[title] = "Ŭ������ - $nc[nf_title]";
include_once("$nc[cb_path]/head.sub.php");

// Ŭ�� ���� ���� ���� Ȯ��
if (!$member[mb_id] || $member[mb_level] < $nc[nf_open_level]) { 
    alert("Ŭ�� ������ �� ȸ���� $nc[nf_open_level] ���� ȸ������ �����մϴ�.");
}

// ȸ���� �ִ� Ŭ�� ������ üũ
$limits = mysql_fetch_array(mysql_query(" select count(*) from $nc[tbl_club] where cb_manager = '$member[mb_id]' "));
if ($nc[nf_limits] && $limits[0] >= $nc[nf_limits]) {
    alert("�� ȸ���� �����Ҽ� �ִ� Ŭ������ $nc[nf_limits] �� ���� �Դϴ�.");
}

$sql	= " select * from $nc[tbl_category] order by cc_idx asc ";
$result	= mysql_query($sql);

include_once $nc[member_skin_path] . "/cb_open.skin.php"; 

include_once "$nc[cb_path]/tail.sub.php"; 
?>
