<?
include_once("./_common.php");

if (!$member[mb_id]) {
	error_msg("로그인 후에 이용하세요");
}

$g4[title] = "클럽개설 - $nc[nf_title]";
include_once("$nc[cb_path]/head.sub.php");

// 클럽 개설 가능 레벨 확인
if (!$member[mb_id] || $member[mb_level] < $nc[nf_open_level]) { 
    alert("클럽 개설은 한 회원이 $nc[nf_open_level] 레벨 회원부터 가능합니다.");
}

// 회원의 최대 클럽 생성수 체크
$limits = mysql_fetch_array(mysql_query(" select count(*) from $nc[tbl_club] where cb_manager = '$member[mb_id]' "));
if ($nc[nf_limits] && $limits[0] >= $nc[nf_limits]) {
    alert("한 회원이 생성할수 있는 클럽수는 $nc[nf_limits] 개 까지 입니다.");
}

$sql	= " select * from $nc[tbl_category] order by cc_idx asc ";
$result	= mysql_query($sql);

include_once $nc[member_skin_path] . "/cb_open.skin.php"; 

include_once "$nc[cb_path]/tail.sub.php"; 
?>
