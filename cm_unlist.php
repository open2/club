<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("{$cb_id} Ŭ���� �������� �ʽ��ϴ�.");
}

$g4[title] = "$cb[cb_name]:Ŭ���Ⱥ��̴°Խñ� - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";

// �Խ��� ������ ��������
$board = sql_fetch(" select * from $g4[board_table] where bo_table = '$cb[cb_id]' ");

// ī�װ� ������ ca_in �迭�� �־ mysql���� ����� �� �ְ�
$ca_list = $board[bo_category_list];
$ca_array = explode('|', $ca_list);
$ca_in = "(";
foreach($ca_array as $tok)
    $ca_in .= "'" . $tok . "', ";
$ca_in .= "'')";

$tmp_write_table = $g4[write_prefix] . $board[bo_table]; // �Խ��� ���̺� ��ü�̸�
$sql = " select * from $tmp_write_table where ca_name not in $ca_in ";
$result = sql_query($sql);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td>
  Ŭ��2�� �޴�=�з� �Դϴ�.<br>
  �޴����� ������ �ʴ� ���� � ������ �з��� ������ �ֱ� ���� �Դϴ�.<br>
  �з��� �����ϰ� �����ϸ� �޴��� ���� ��, �Խñ��� �ٽ� ������ �˴ϴ�.<br>
  <br>
  1. �Խñ� ������ Ŭ�� �մϴ�.<br>
  2. �Խñ��� �����ؼ�, �з��� ���ϴ� �޴��� ���� �մϴ�.<br>
  </td>
</tr>
</table>
<br>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
<tr height=20px>
<td width=50px>no.</td><td width=150px>�޴���</td><td>�Խñ� ����</td>
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
