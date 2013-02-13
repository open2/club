<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("{$cb_id} 클럽이 존재하지 않습니다.");
}

$g4[title] = "$cb[cb_name]:클럽안보이는게시글 - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";

// 게시판 정보를 가져오고
$board = sql_fetch(" select * from $g4[board_table] where bo_table = '$cb[cb_id]' ");

// 카테고리 정보를 ca_in 배열에 넣어서 mysql에서 사용할 수 있게
$ca_list = $board[bo_category_list];
$ca_array = explode('|', $ca_list);
$ca_in = "(";
foreach($ca_array as $tok)
    $ca_in .= "'" . $tok . "', ";
$ca_in .= "'')";

$tmp_write_table = $g4[write_prefix] . $board[bo_table]; // 게시판 테이블 전체이름
$sql = " select * from $tmp_write_table where ca_name not in $ca_in ";
$result = sql_query($sql);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td>
  클럽2의 메뉴=분류 입니다.<br>
  메뉴에서 나오지 않는 것은 어떤 이유로 분류에 오류가 있기 때문 입니다.<br>
  분류를 적정하게 수정하면 메뉴를 누를 때, 게시글이 다시 나오게 됩니다.<br>
  <br>
  1. 게시글 제목을 클릭 합니다.<br>
  2. 게시글을 수정해서, 분류를 원하는 메뉴로 수정 합니다.<br>
  </td>
</tr>
</table>
<br>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
<tr height=20px>
<td width=50px>no.</td><td width=150px>메뉴명</td><td>게시글 제목</td>
</tr>
<?
for ($i=0; $row=mysql_fetch_array($result); $i++) {
  $j = $i+1;
  $href = "<a target=new href='$g4[bbs_path]/board.php?bo_table=$cb[cb_id]&wr_id=$row[wr_id]'>";
  echo "<tr height=20px>";
  echo "<td>$j</td><td>$row[ca_name]</td><td>$href$row[wr_subject]</a></td>";
  echo "</tr>";
}
?>
</table>

<?
include "$nc[cb_path]/tail.sub.php";
?>
