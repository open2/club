<table width="180" border="0" cellpadding="0" cellspacing="0">
  <form name="fcblogin" method="post" action="javascript:fhead_submit(document.fcblogin);" autocomplete="off">
    <input type="hidden" name="url" value="<?=$urlencode?>">
	<tr>
		<td colspan="3"><img src="<?=$cb_outlogin_skin?>/login_title.gif"></td>
	</tr>
	<tr>
		<td height="108" width="13" background="<?=$cb_outlogin_skin?>/left_bg.gif">&nbsp;</td>		
		<td width="155" bgcolor="#FBFBFB"><table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
		    <td width="105"><input name="mb_id" type="text" class="ed" style="width:98%" id="mb_id" required itemname="���̵�" size="10" tabindex="1"></td>
			<td rowspan="2" width="50" align="right"><input name="imageField" type="image" src="<?=$cb_outlogin_skin?>/btn_login.gif" alt="�α���" width="48" height="46" border="0" tabindex="4"></td>
		  </tr>
		  <tr>
		    <td><input name="mb_password" type="password" class="ed" style="width:98%" id="mb_password" required itemname="��й�ȣ" size="10" tabindex="2"></td>
		  </tr>
		  <tr><td colspan="2" height="6"></td>
		  </tr>
		  <tr>
		    <td colspan="2"><input name="auto_login" type="checkbox" id="auto_login" value="1" tabindex="3" onClick="if (this.checked) { if (confirm('�ڵ��α����� ����Ͻø� �������� ȸ�����̵�� �н����带 �Է��Ͻ� �ʿ䰡 �����ϴ�.\n\n\������ҿ����� ���������� ����� �� ������ ����� �����Ͽ� �ֽʽÿ�.\n\n�ڵ��α����� ����Ͻðڽ��ϱ�?')) { this.checked = true; } else { this.checked = false; } }"><img src="<?=$cb_outlogin_skin?>/btn_login_save.gif" width="35" height="14" border="0" alt="ID����"><a href="javascript:win_password_forget();"><img src="<?=$cb_outlogin_skin?>/btn_login_pw_find.gif" alt="���̵�/���ã��" width="100" height="14" border="0"></a></td>
		  </tr>
		  <tr><td colspan="2" height="8"></td>
		  </tr>
		  <tr>
          <td colspan="3"><a href="<?=$nc[cb_path]?>/bbs/register.php"><img src="<?=$cb_outlogin_skin?>/btn_login_join.gif" alt="ȸ������" width="155" height="28" border="0"></a></td>
          </tr>
          </table></td>
		<td width="12" background="<?=$cb_outlogin_skin?>/right_bg.gif">&nbsp;</td>
	</tr>	
	<tr>
		<td colspan="3"><img src="<?=$cb_outlogin_skin?>/box_btm.gif"></td>
	</tr>
  </form>
</table>
<script language="JavaScript">
	document.onload = document.fcblogin.mb_id.focus();
	function fhead_submit(f)
	{
	    f.action = "<?=$g4[bbs_path]?>/login_check.php";
	    f.submit();
	}
</script>