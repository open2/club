<?
include_once("./_common.php");

$g4[title] = "��Ŭ�� ���� - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";

$sql = " select * from $nc[tbl_category] order by cc_idx asc "; 
$cc_result = mysql_query($sql); 

$search_skin_path = "$nc[cb_path]/skin/search/$nc[nf_search_default_skin]";

include_once "$search_skin_path/cb_search.skin.php";

$title = "��Ŭ�� ����";

if (!$ssort) { $ssort = "rand()"; }
if (!$sorder) { $sorder = "asc"; }

$sql_common	= " from $nc[tbl_member] as a, $nc[tbl_club] as b ";
$sql_order	= " order by $ssort $sorder ";
$sql_where	= " where  a.cb_id = b.cb_id and a.mb_id = '$member[mb_id]' ";

$sql = " select count(*) $sql_common $sql_where $sql_order ";
$row = mysql_fetch_array(mysql_query($sql));
$total_count = $row[0];						// �� �˻� ��

if (!$rows) {
	$rows = 10;
}
$total_page  = ceil($total_count / $rows);	// ��ü ������ ���
if ($page == "") { $page = 1; }				// �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows;			// ���� ���� ����

$sql	= " select *, date_format(cb_opendate, '%Y.%m.%d') as opendate
				   $sql_common
				   $sql_where
				   $sql_order
			 limit $from_record, $rows ";
$result	= mysql_query($sql);

$page_url = "./cb_myclub_list.php?cc_id=$cc_id&cb_recommend=$cb_recommend&sorder=$sorder&ssort=$ssort&page=";

include_once "$search_skin_path/cb_search_list.skin.php";

include_once("$nc[cb_path]/tail.sub.php");
?>
