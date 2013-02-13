<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("{$cb_id} 클럽이 존재하지 않습니다.");
}

$g4[title] = "$cb[cb_name]:클럽양도 - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";

$ss_id = 'club_transfer_mb_id'; // 값을 전달받을 곳
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>클럽 양도</strong></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<form name=fmemoform method=post enctype='multipart/form-data' onsubmit="return fmemoform_submit(this);" >
<input type=hidden name=cb_id value="<?=$cb_id?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td height="30" colspan="7">
    클럽 양도 절차<br><br>
    1. 클럽을 인수할 사람에게 클럽 양도를 신청<br>
    2. 클럽을 인수할 사람에게 클럽 양도에 필요한 url을 알려줌 (쪽지 등으로)<br>
    3. 클럽을 인수할 사람이 클럽인수 url을 click<br>
    </td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td height="30">
    주의 사항<br><br>
    1. 클럽의 양도를 신청후 인수자가 승낙할 때까지는 취소할 수 있습니다.<br>
    2. 클럽이 인수된 이후에는 클럽의 소유권을 다시 가져올 수 없습니다.<br>
    </td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>

<script type="text/javascript"> 
<!-- // 회원ID 찾기  
function popup_id(frm_name, ss_id, top, left) 
{ 
    url = './cb_write_id.php?frm_name='+frm_name+'&ss_id='+ss_id; 
    opt = 'scrollbars=yes,width=320,height=470,top='+top+',left='+left; 
    window.open(url, "write_id", opt); 
} 
//--> 
</script>

  <? 
  // 이미 양도를 신청한 경우에는 창이 보이지 않게
  $cm_club_transfer = get_club_transfer($cb[cb_id]);
  if ($cm_club_transfer) {

      $mb = get_member($cm_club_transfer);
      $nick = get_sideview($mb[mb_id], $mb[mb_nick], $mb[mb_email], $mb[mb_homepage]);
      
      $s_del = "<a href=\"javascript:post_delete('cm_club_transfer.update.php', '$cm_club_transfer');\">클럽양수도취소</a>";
  ?>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">
    클럽의 양수도가 진행중입니다.<br>
    클럽의 양수도를 <?=$nick?> 님에게 요청하였습니다.<br>
    <br>
    다음 url을 양수받을 회원에게 알려주시면 됩니다.<br>
    <br>
    <?=$nc[cb_url_path]?>/cm_club_transfer.update.php?cb_id=<?=$cb_id?>&w=approve
    <br>
    <br>
    클럽의 양수도를 취소하려면 ( <?=$s_del?> )를 눌러주세요.
    </td>
  </tr>
  <tr>
  <? } else { ?>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	<colgroup><col width="130px" /><col width="200px" /><col /></colgroup>
	<tr bgcolor="#f7f7f7">
      <td align="center" height="30"><strong>클럽을 인수할 회원</strong></td>
      <td align="center"><input type="text" name="<?=$ss_id?>" id="<?=$ss_id?>" required="required" itemname="인수할 회원아이디" value="" class="ed" style="width:190px;" /></td>
      <td><a href="javascript:popup_id('fmemoform','<?=$ss_id?>',200,500);"><img src="<?=$nc[cb_path]?>/images/btn_smember.gif" width="80" height="21" border="0"></a></td>
	</tr>
	</table></td>
  </tr>
  <tr>
  <td style="padding:5px 10px 5px 10px;" align="right">
      <INPUT type=image src="<?=$nc[cb_path]?>/images/btn_confirm.gif" width="90" height="21" border="0" accesskey='s'> 
  </td>
  </tr>
  <? } ?>
</table>
</form>

<script language="JavaScript">
function fmemoform_submit(f) {

    f.action = "./cm_club_transfer.update.php";

    return true;
}
</script>

<script>
// POST 방식으로 삭제
function post_delete(action_url, val)
{
	var f = document.fpost;

	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
    f.club_transfer_mb_id.value = val;
		f.action         = action_url;
		f.submit();
	}
}
</script>

<form name='fpost' method='post'>
<input type='hidden' name='cb_id' value='<?=$cb[cb_id]?>'>
<input type='hidden' name='w' value='cancel'>
<input type='hidden' name='club_transfer_mb_id'>
</form>

<?
include "$nc[cb_path]/tail.sub.php";
?>
