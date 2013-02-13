<?
include_once "./_common.php";

// Ŭ���� �������� �ʰų� $cb_id�� �������
if (!$cb[cb_id]) {
    error_msg("�ش� Ŭ���� �������� �ʽ��ϴ�.", "$nc[cb_url_path]/club_index.php");
}

if (!$member[mb_id]) {
    error_msg("�α����Ŀ� �̿��ϼ���", "$nc[cb_url_path]/bbs/login.php?cb_id=$cb[cb_id]", 1);
}

if ($cb[cb_join] == "N") {
    error_msg("���� Ŭ������ ȸ�� ������ ���� �ʽ��ϴ�.");
}

if ($cm[mb_id]) {
    error_msg("�̹� Ŭ�� ȸ������ ��ϵǾ� �ֽ��ϴ�.");
}

if ($cb[cb_state] == 3 && !$is_admin && !$cm[mb_id]) {
    error_msg("���� Ŭ���Դϴ�.", $nc[cb_url_path]);
}

// �������ǿ� ������ �ִ��� Ȯ��
if ($config[cf_use_sex] && $cb[cb_join_sex] !== "") {
    if ($cb[cb_join_sex] !== $member[mb_sex]) {
        if ($cb[cb_join_sex] == "M")
            error_msg("Ŭ���� �ƺ�/����(��)�� ������ ������ Ŭ���Դϴ�.");
        else
            error_msg("Ŭ���� ����/�̸�(��)�� ������ ������ Ŭ���Դϴ�.");
    }
}

// ������ ���ؼ� �����ϴ� Ŭ���� ��� �̹� ���Խ�û�� �ߴ��� Ȯ��
if ($cb[cb_type] == 2) { 
    $sql = " select count(*) as cnt from $nc[member_table] where cb_id = '$cb[cb_id]' and mb_id = '$member[mb_id]' ";
    $result = sql_fetch($sql);
    if ($result[cnt] > 0) 
        alert("�̹� ���Խ�û�� �ϼ̽��ϴ�.");
}

// ���Ŭ���� ���, �������� ��û�� �ִ��� Ȯ��
if ($cb[cb_type] == 3) {
    if (!get_club_invite($cb[cb_id], $member[mb_id]))
        alert("��û�� ���ؼ��� ������ ���� �մϴ�.");
}

$g4[title] = "$cb[cb_name]:Ŭ������ - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>Ŭ�� ȸ�� ����</strong></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<form name="fcbmbjoin" method="post" action="./cb_mb_join.update.php">
<input type="hidden" name="cb_id" value="<?=$cb[cb_id]?>">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="3" colspan="2" bgcolor="#CCCCCC"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="listsub">Ŭ�� �Ұ���</td>
    <td class="list"><?=conv_content($cb[cb_content], 0)?></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#EEEEEE"></td>
  </tr>
  <? if ($nc[nf_point_use] == 3) { ?>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="listsub">���� ����Ʈ</td>
    <td class="list">
    ȸ�����Խ� <?=number_format($cb[cb_join_point])?> ����Ʈ�� Ŭ���� ��� �ϰ� �˴ϴ�.
    </td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#EEEEEE"></td>
  </tr>
  <? } ?>
  <?
    if ($cb[cb_ask_use] == "Y") {
        $ask = explode("|", $cb[cb_ask_body]);
    }
    if ($ask[0]) {
        $i = 1;
        foreach ($ask as $value) {
            if ($value != "") {
  ?>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="listsub">���� <?=$i?>. </td>
    <td class="list"><?=$value?></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="listsub">�亯 <?=$i?>. </td>
    <td class="list"><input name="reply[]" type="text" id="reply[]" size="60" class="ed" itemname="����<?=$i?>" required></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#EEEEEE"></td>
  </tr>
  <?
            }
        $i++;
        }
    }
  ?>
  <tr bgcolor="#CCCCCC">
    <td height="1" colspan="2"></td>
  </tr>
  <tr align="right">
    <td style="padding:15px 10px 5px 10px;" colspan="2"><input name="imageField" type="image" src="images/btn_confirm.gif" width="90" height="21" border="0"></td>
  </tr>
</table>
</form>
<br><br><br><br><br><br>

<?
include_once "$nc[cb_path]/tail.sub.php";
?>
