<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td width="30"><img src="<?=$nc[member_skin_path]?>/img/box_list_t01.gif"></td>
		<td width="100%" background="<?=$nc[member_skin_path]?>/img/box_list_bg1.gif"><strong>Ŭ�� �����</strong></td>
		<td width="50"><img src="<?=$nc[member_skin_path]?>/img/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="<?=$nc[member_skin_path]?>/img/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<form name="fcbopen" method="post" action="javascript:check_agree();">
<input type=hidden name=cb_id_enabled    value="" id="cb_id_enabled">
<input type=hidden name=cb_name_enabled  value="" id="cb_name_enabled">
  <tr>
    <td width="140" bgcolor="#f7f7f7" class="gmenu"><strong>Ŭ�� ���̵�</strong></td>
    <td colspan="2" style="padding:5px 0px 5px 10px;"><? if ($nc[cb_disc]) { echo "<strong>$nc[cb_disc]</strong> "; } ?><input name="cb_id" type="text" id="cb_id" class="ed" itemname="Ŭ�����̵�" required size="50" maxlength="17" style="ime-mode:inactive;" onchange="fcbopen.cb_id_enabled.value='';">
      <a href="javascript:cb_id_check();"><img src="<?=$nc[member_skin_path]?>/img/btn_double_check.gif" alt="�ߺ�Ȯ��" width="80" height="20" border="0" align="absmiddle"></a>
      <br>�� �ѹ� ����� Ŭ�����̵�� ������ �� �����ϴ�.
      </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu"><strong>Ŭ�� �̸�</strong></td>
    <td colspan="2" style="padding:5px 0px 5px 10px;"><input name="cb_name" type="text" id="cb_name" class="ed" itemname="Ŭ���̸�" required size="55" onchange="fcbopen.cb_name_enabled.value='';">
      <a href="javascript:cb_name_check();"><img src="<?=$nc[member_skin_path]?>/img/btn_double_check.gif" alt="�ߺ�Ȯ��" width="80" height="20" border="0" align="absmiddle"></a>
      <br>�� ����� Ŭ�� �̸��� 6������ ������ �� �����ϴ�.
      </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu"><strong>Ŭ�� �з�</strong></td>
    <td colspan="2" style="padding:5px 0px 5px 10px;"><select name="cc_id" itemname="Ŭ���з�" required id="cc_id">
        <option value="">�� �з� ���� ==</option>
    <? for ($i=0; $row=mysql_fetch_array($result); $i++) { ?>
    	<option value="<?=$row[cc_id]?>"><?=$row[cc_name]?></option>
    <? } ?>
      </select></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu"><strong>Ŭ�� ����</strong></td>
    <td colspan="2" style="padding:5px 0px 5px 10px;"><input name="cb_type" type="radio" value="1" checked>
      ���� Ŭ�� : ���Խ�û�� �ڵ� ����, �˻� ����<br>
      <input name="cb_type" type="radio" value="2">
      ���� Ŭ�� : Ŭ���Ŵ����� ���� �� ����, �˻� ����<br>
      <input name="cb_type" type="radio" value="3">
      ��� Ŭ�� : �ʴ뿡 ���ؼ��� ����, �˻� �Ұ���</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu"><strong>�˻� Ű����</strong></td>
    <td width="" style="padding:5px 0px 5px 10px;" colspan="2"><input type="text" name="cb_keyword" id="cb_keyword" class="ed" style="width:100%; ">
    * Ŭ�� �˻��� ���� Ű����, �� Ű����� �޸�(,)�� ����
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu"><strong>Ŭ�� ����</strong></td>
    <td width="" style="padding:5px 0px 5px 10px;" colspan="2">
    <textarea name="cb_content" rows="5" id="cb_content" class="tx" itemname="Ŭ������" required style="width:100%;"></textarea>
    * 120�� �̳�, HTML TAG ��� �Ұ�
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td colspan="3" align="Center" style="padding:15px 0px 5px 10px;"><strong>Ŭ�� �̿� ���</strong></td>
  </tr>
  <tr>
    <td  colspan="3" style="padding:5px 0px 5px 10px;"><textarea name="" rows="10" id="cb_content" readonly style="width:100%;"><?=$nc[nf_clause]?></textarea></td>
  </tr>
  <tr>
    <td align="center" colspan="3" style="padding:5px 0px 5px 10px;"><input type="checkbox" name="agree" id="agree" value="1"><label for=agree>����� ������ ��� �о� ���Ұ� ��� ���뿡 �����մϴ�.</label></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td height="20" colspan="3"></td>
  </tr>
  <tr align="right">
    <td height="30" bgcolor="#F7F7F7" colspan="3" align="center"><input type="image" src="<?=$nc[member_skin_path]?>/img/btn_cbmake_ok.gif" width="90" height="25" border="0"></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</form>
</table>

<script language="JavaScript" type="text/JavaScript">
    var f = document.fcbopen;
	
	// Ŭ�����̵� �˻�
	function cb_id_check()
	{
	    if (f.cb_id.value == "") {
	        alert("Ŭ�� ���̵� �Է��ϼ���.");
	        f.cb_id.focus();
	        return;
	    }

     if (f.cb_id.value.length > 17 ) {
            alert('Ŭ�� ���̵�� 17�� �̻� �Է��� �� �����ϴ�.');
            f.cb_id.focus();
            return;
     }
	
	    var id = prohibit_id_check(f.cb_id.value);
	    if (id) {
	        alert("'"+id + "'��(��) ����Ͻ� �� ���� Ŭ�����̵��Դϴ�.");
	        f.cb_id.focus();
	        return;
	    }
	
	    win_open("./club_id_check.php?w=cb_id&cb_id="+f.cb_id.value, "hiddenframe");
	}
	
	// Ŭ�� �̸� �˻�
	function cb_name_check()
	{
	    if (f.cb_name.value == "") {
	        alert("Ŭ�� �̸��� �Է��ϼ���.");
	        f.cb_name.focus();
	        return;
	    }
	    
	    var id = prohibit_id_check(f.cb_name.value);
	    if (id) {
	        alert("'"+id + "'��(��) ����Ͻ� �� ���� Ŭ�����Դϴ�.");
	        f.cb_name.focus();
	        return;
	    }
	
	    win_open("./club_id_check.php?w=cb_name&cb_name="+f.cb_name.value, "hiddenframe");
	    //win_open("./club_id_check.php?w=cb_name&cb_id="+f.cb_id.value+"&cb_name="+f.cb_name.value);
	}
	
	// ���� ���̵� �˻�
	function prohibit_id_check(id)
	{
	    id = id.toLowerCase();
	    
	    var prohibit_id = '<?=$nc[nf_filter]?>';

	    var s = prohibit_id.split(",");
	
	    for (i=0; i<s.length; i++) {
	        if (s[i] == id)
	            return id;
	    }
	    return "";
	}
	
	function check_agree()
	{
      if (f.cb_id_enabled.value == "") {
          alert("Ŭ�����̵� �ߺ�Ȯ���� ���ֽʽÿ�.");
          f.cb_id.focus();
          return;
      }

      if (f.cb_name_enabled.value == "") {
          alert("Ŭ���̸� �ߺ�Ȯ���� ���ֽʽÿ�.");
          f.cb_name.focus();
          return;
      }
      
	    if (f.agree.checked != true) {
	        alert("�̿����� ���� �Ͽ��� �մϴ�.");
	        f.agree.focus();
	        return;
	    } else {
	        f.action = "./cb_open.update.php";
	        f.submit();
	    }
	}
</script>
