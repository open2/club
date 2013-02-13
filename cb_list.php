<?
include_once("./_common.php");

$g4[title] = "클럽검색결과 - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";

$search_skin_path = "$nc[cb_path]/skin/search/$nc[nf_search_default_skin]";

$sql	= " select * from $nc[tbl_category] order by cc_idx asc ";
$cc_result	= mysql_query($sql);

include_once "$search_skin_path/cb_search.skin.php"; 

$title = "검색결과";

if ($rank) {
	$title = "클럽랭킹";
}

if (!$ssort) { $ssort = "rand()"; }
if (!$sorder) { $sorder = "desc"; }

$sql_common	= " from $nc[tbl_club] as a left join $nc[tbl_cb_info] as b on a.cb_id = b.cb_id ";
$sql_order	= " order by $ssort $sorder ";
$sql_where	= " where ( a.cb_type <> 3 and a.cb_state = 1 )";

// 카테고리 검색
if ($cc_id) {
	$sql_where .= " and a.cc_id = '$cc_id' ";
}

// 추천클럽
if ($cb_recommend == "Y") {
	$sql_where .= " and a.cb_recommend = 'Y' ";
	$title		= "추천클럽";
}

// 옵션별 검색
if ($sselect && $stext) {
	$sql_where .= " and ( $sselect like '%$stext%' ) ";
}

$sql = " select count(*) $sql_common $sql_where $sql_order ";
$row = mysql_fetch_array(mysql_query($sql));
$total_count = $row[0];						// 총 검색 수

if (!$rows) {
	$rows = 20;
} else if ($rows=="none") {
	$rows = 1;
	$only_search="1";
}

$total_page  = ceil($total_count / $rows);	// 전체 페이지 계산
if ($page == "") { $page = 1; }				// 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows;			// 시작 열을 구함

$sql	= " select *, date_format(cb_opendate, '%Y.%m.%d') as opendate
				   $sql_common
				   $sql_where
				   $sql_order
			 limit $from_record, $rows ";
$result	= sql_query($sql);

// 검색창만 보이게 할 때
if (!$only_search) {
  $page_url = "./cb_list.php?cc_id=$cc_id&cb_recommend=$cb_recommend&sorder=$sorder&ssort=$ssort&page=";
  include_once "$search_skin_path/cb_search_list.skin.php"; 
}

if ($is_member && $main == "Y")
    include_once("./my_cb_list.php");
?>

<?
include_once("./tail.sub.php");
?>
