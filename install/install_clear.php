<?
include_once "./_common.php";
include_once "$cb_path/lib/club.lib.php";

// 최고 관리자만 삭제를 할 수 있슴
if ($is_admin !== 'super') {
    alert("최고 관리자만 삭제를 할 수 있습니다");
}

echo "<br>클럽 삭제를 시작 합니다<br>";

// 클럽 최근글, 게시판, 방문자 관련 테이블 삭제
$sql = " select * from $g4[board_table] where gr_id = '$nc[gr_id]' ";
$result = sql_query($sql);

for ($i=0; $row=mysql_fetch_array($result); $i++) {
    echo "<br>" . $row[bo_table] . " 테이블 정보를 삭제 합니다" ;
    // 최근글 테이블 정보를 삭제
    $sql1 = " delete from $g4[board_new_table] where bo_table = '$row[bo_table]' ";
    echo "<br>" . $sql1;
    sql_query($sql1, FALSE);

    // 첨부파일 테이블 정보를 삭제
    $sql1_1 = " delete from $g4[board_file_table] where bo_table = '$row[bo_table]' ";
    echo "<br>" . $sql1_1;
    sql_query($sql1_1, FALSE);
    
    // 추천 테이블 정보를 삭제
    $sql1_2 = " delete from $g4[board_good_table] where bo_table = '$row[bo_table]' ";
    echo "<br>" . $sql1_2;
    sql_query($sql1_2, FALSE);
    
    // 게시판을 삭제
    $sql2 = " drop table $g4[write_prefix]$row[bo_table] ";
    echo "<br>" . $sql2;
    sql_query($sql2, FALSE);
    
    // 방문자 관련 테이블 삭제
    $sql3 = " drop table nc_visit_$row[bo_table] ";
    echo "<br>" . $sql3;
    sql_query($sql3, FALSE);
    $sql4 = " drop table nc_visit_sum_$row[bo_table] ";
    echo "<br>" . $sql4;
    sql_query($sql4, FALSE);
}

// 게시판 정보를 삭제
echo "<br>" . $nc[gr_id] . " 게시판 정보를 삭제 합니다" ;
$sql5 = " delete from $g4[board_table] where gr_id = '$nc[gr_id]'  ";
echo "<br>" . $sql5;
sql_query($sql5, FALSE);
    
// 클럽 그룹을 삭제
echo "<br>" . $nc[gr_id] . " 그룹 정보를 삭제 합니다" ;
$sql6 = " delete from $g4[group_table] where gr_id = '$nc[gr_id]' ";
echo "<br>" . $sql6;
sql_query($sql6, FALSE);

// 클럽 설정 테이블을 삭제
echo "<br>클럽 설정 테이블들을 삭제 합니다";
$sql10 = " drop table $nc[tbl_config] ";
sql_query($sql10, FALSE);
$sql11 = " drop table $nc[tbl_category] ";
sql_query($sql11, FALSE);
$sql12 = " drop table $nc[tbl_club] ";
sql_query($sql12, FALSE);
$sql13 = " drop table $nc[tbl_cb_info] ";
sql_query($sql13, FALSE);
$sql14 = " drop table $nc[tbl_coverstory] ";
sql_query($sql14, FALSE);
$sql15 = " drop table $nc[tbl_member] ";
sql_query($sql15, FALSE);
$sql16 = " drop table $nc[tbl_mb_level] ";
sql_query($sql16, FALSE);
$sql17 = " drop table $nc[tbl_menu] ";
sql_query($sql17, FALSE);
$sql18 = " drop table $nc[tbl_visit] ";
sql_query($sql18, FALSE);
$sql19 = " drop table $nc[tbl_cb_history] ";
sql_query($sql19, FALSE);

// 설치 디렉토리를 삭제 합니다.
$install_name = $cb_path . "/install_dir";
@rmdir("$install_name");

echo "<br><br>";

echo "설치된 클럽을 Clear 하였습니다.";

goto_url($g4[path]);
?>
