<?
include_once "./_common.php";

$cb_ask	= explode("|", $cb[cb_ask_body]);

$g4[title] = "$cb[cb_name]:Ŭ���������ǰ��� - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>���� ����</strong></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<form name="fcmjoin" method="post" action="javascript:check_form();">
<input type="hidden" name="doc"     value="<?=$doc?>">
<input type="hidden" name="cb_id"   value="<?=$cb[cb_id]?>">
<input type="hidden" name="cb_type" value="<?=$cb[cb_type]?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="3" colspan="2" bgcolor="#CCCCCC"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ���� ��û </td>
    <td class="list"><input name="cb_join" type="radio" value="Y" checked>
      ���� ���
      <input name="cb_join" type="radio" value="N">
      ���� ��� ����</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="2"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ���� ȸ�� ���</td>
    <td class="list"><select name="cb_join_level" id="cb_join_level">
      <?=get_level_option($cb[cb_id])?>
      </select></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="2"></td>
  </tr>
  <? if ($config[cf_use_sex]) { ?>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ���� ȸ�� ����</td>
    <td class="list">
        <select id=cb_join_sex name=cb_join_sex itemname='����'>
        <option value=''>�������Ѿ���
        <option value='F'>����/�̸�(��)
        <option value='M'>�ƺ�/����(��)
        </select>
        <script language="JavaScript"> document.getElementById('cb_join_sex').value="<?=$cb[cb_join_sex]?>";</script>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="2"></td>
  </tr>
  <? } ?>
  <? if ($nc[nf_point_use] == 3) { ?>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ���� ����Ʈ</td>
    <td class="list"><input type="text" name="cb_join_point" required itemname="��������Ʈ" size="10" id="cb_join_point" value="<?=$cb[cb_join_point]?>"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="2"></td>
  </tr>
  <? } ?>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ���� ����</td>
    <td class="list"><input name="cb_ask_use" type="radio" value="Y" checked>
      ���� ���
      <input name="cb_ask_use" type="radio" value="N">
      ���� ��� ����</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="2"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ���� ���� </td>
    <td class="list"><table border="0" cellspacing="0" cellpadding="2">
        <? 
        for ($i=0; $i < $nc[cm_join_query_count]; $i++) {
        ?>
    	  <tr>
    	    <td><?=$i+1?>. 
    	    	<input type="text" name="cb_ask[]" size="50" class="ed"></td>
    	  </tr>
    	  <? } ?>
    	</table></td>
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
	f = document.fcmjoin;
	
	f.cb_join_level.value = "<?=$cb[cb_join_level]?>";
	<?
	if ($cb[cb_join] == "N") {
		echo "f.cb_join[1].checked = true;\n";
	} else {
		echo "f.cb_join[0].checked = true;\n";
	}
	
	if ($cb[cb_ask_use] == "N") {
		echo "f.cb_ask_use[1].checked = true;\n";
	} else {
		echo "f.cb_ask_use[0].checked = true;\n";
	}
	
	for ($k=0; $k<count($cb_ask)-1; $k++) {
		echo "f.elements['cb_ask[]'][$k].value = '$cb_ask[$k]';\n";
	}
	?>
	
	function check_form()
	{
		f = document.fcmjoin;
		if (f.cb_ask_use[0].checked == true) {
		  
			for (i=0; i<3; i++) {
				if (f.elements['cb_ask[]'][i].value == "") {
						str = 1;
				} else {
						str = 0;
						break;
				}
			}
			
			if (str == 1) {
				alert ("���������� �Է��ϼ���.");
				f.elements['cb_ask[]'][0].focus();
			} else {
			    f.action = "cm_join.update.php";
		        f.submit();
		    }
		} else {
    		f.action = "cm_join.update.php";
    		f.submit();
    	}
	}
</script>
<?
include "$nc[cb_path]/tail.sub.php";
?>
