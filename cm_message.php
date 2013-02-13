<?
include_once "./_common.php";

$cb		= get_club($cb_id);
$cb_ask	= explode("|", $cb[cb_ask_body]);

$g4[title] = "$cb[cb_name]:클럽가입조건관리 - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>쪽지 보내기</strong></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<form name="fcmmessage" method="post" action="./cm_message.update.php">
<input type="hidden" name="doc"   value="<?=$doc?>">
<input type="hidden" name="cb_id" value="<?=$cb[cb_id]?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="3" colspan="2" bgcolor="#CCCCCC"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">받는 회원</td>
    <td class="list"><select name="cm_level" id="cm_level">
      <option value="">전체회원</option>
      <?=get_level_option($cb[cb_id])?>
      </select></td>
  </tr>
  <? 
  if (file_exists("$g4[path]/memo.config.php")) 
  {
        include_once("$g4[path]/memo.config.php");
  ?>
  <input type="hidden" name="memo4"   value="1">
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="2"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">제목</td>
    <td class="list"><input type="text" name="me_subject" id="me_subject" required="required" style="width:100%; text-align:left;" / value='<?=$subject?>' ></td>
  </tr>
  <? } else { ?>
  <input type="hidden" name="memo4"        value="0">
  <input type="hidden" name="me_subject"   value="">
  <? } ?>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="2"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">내 용</td>
    <td class="list"><textarea name="me_memo" rows="15" required itemname="내용" class="tx" style="width:100%;"></textarea></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="2" colspan="2"></td>
  </tr>
  <tr align="right">
    <td colspan="2" style="padding:5px 10px 5px 10px;" align="right"><input name="imageField" type="image" src="./images/btn_confirm.gif" width="90" height="21" border="0">
    </td>
  </tr>
</table>
</form>
<br><br><br><br><br><br>
<script language="JavaScript" type="text/JavaScript">

</script>

<?
include "$nc[cb_path]/tail.sub.php";
?>
