<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("{$cb_id} Ŭ���� �������� �ʽ��ϴ�.");
}

$g4[title] = "$cb[cb_name]:Ŭ����� - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";

// ��üȸ����
$sql = " select count(*) as cnt from $nc[member_table] where cb_id = '$cb[cb_id]' ";
$result = sql_fetch($sql);
$total_member = $result[cnt];

// ��ü�Խñ�
$tmp_write_table = $g4[write_prefix] . $cb[cb_id];
$sql = " select count(*) as cnt from $tmp_write_table ";
$result = sql_fetch($sql);
$total_post = $result[cnt];

// ��ü�ڸ�Ʈ
$tmp_write_table = $g4[write_prefix] . $cb[cb_id];
$sql = " select count(*) as cnt from $tmp_write_table where wr_is_comment = '1' ";
$result = sql_fetch($sql);
$total_comment = $result[cnt];
$total_article = $total_post - $total_comment;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>Ŭ�� ���</strong></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" width=180><strong>��ü ȸ����</strong></td>
    <td align=left><?=$total_member?></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="1" colspan=2></td>
  </tr>
  <tr>
    <td height="30"><strong>��ü �Խñ� (�ڸ�Ʈ)</strong></td>
    <td align=left><?=$total_article?> (<?=$total_comment?>)</td>
  </tr>
</table>

<?
include "$nc[cb_path]/tail.sub.php";
?>
