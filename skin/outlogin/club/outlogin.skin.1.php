<?
$bgcolor = "#FBFBFB";
if ($cb[cb_box_skin_line]) $bgcolor = $cb[cb_box_skin_line];
?>
<div style="margin:0px; width:176px; height:160px; border:2px solid <?=$cb[cb_box_line_skin]?>;">
<table width="176" border="0" cellpadding="0" cellspacing="0">
  <form name="fcblogin" method="post" action="javascript:fhead_submit(document.fcblogin);" autocomplete="off" style="margin:0px;">
    <input type="hidden" name="url" value="<?=$urlencode?>">
	<tr>
		<td colspan="3"><img src="<?=$cb_outlogin_skin?>/login_title.gif"></td>
	</tr>
	<tr>
		<td height="106" width="13" background="<?=$cb_outlogin_skin?>/left_bg.gif"></td>		
		<td width="151" bgcolor="#FBFBFB"><table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
		    <td width="101"><input name="mb_id" type="text" class="ed" style="width:98%" id="mb_id" required itemname="아이디" size="10" tabindex="1"></td>
			<td rowspan="2" width="50" align="right"><input name="imageField" type="image" src="<?=$cb_outlogin_skin?>/btn_login.gif" alt="로그인" width="48" height="46" border="0" tabindex="4"></td>
		  </tr>
		  <tr>
		    <td><input name="mb_password" type="password" class="ed" style="width:98%" id="mb_password" required itemname="비밀번호" size="10" tabindex="2"></td>
		  </tr>
		  <tr><td colspan="2" height="6"></td>
		  </tr>
		  <tr>
		    <td colspan="2"><input name="auto_login" type="checkbox" id="auto_login" value="1" tabindex="3" onClick="if (this.checked) { if (confirm('자동로그인을 사용하시면 다음부터 회원아이디와 패스워드를 입력하실 필요가 없습니다.\n\n\공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?')) { this.checked = true; } else { this.checked = false; } }"><img src="<?=$cb_outlogin_skin?>/btn_login_save.gif" border="0"><a href="javascript:win_password_forget();"><img src="<?=$cb_outlogin_skin?>/btn_login_pw_find.gif" alt="아이디/비번찾기"  border="0"></a></td>
		  </tr>
		  <tr><td colspan="2" height="6"></td>
		  </tr>
		  <tr>
          <td colspan="3"><a href="<?=$nc[cb_path]?>/bbs/register.php?cb_id=<?=$cb[cb_id]?>"><img src="<?=$cb_outlogin_skin?>/btn_login_join.gif" alt="회원가입" border="0"></a></td>
          </tr>
          </table></td>
		<td width="12" background="<?=$cb_outlogin_skin?>/right_bg.gif"></td>
	</tr>	
	<tr>
		<td colspan="3"><img src="<?=$cb_outlogin_skin?>/box_btm.gif"></td>
	</tr>
  </form>
</table>
</div>
<script language="JavaScript">
	document.onload = document.fcblogin.mb_id.focus();
	function fhead_submit(f)
	{
	    f.action = "<?=$g4[bbs_path]?>/login_check.php";
	    f.submit();
	}
</script>
