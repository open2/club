<?
include_once "./_common.php";

$g4[title] = "Ŭ������";
include_once("$nc[cb_path]/head.sub.php");

$cb		= get_club($cb_id);
$cb_ask	= explode("|", $cb[cb_ask_body]);
?>
<br>
<form name="fcbform" method="post" action="javascript:check_form();">
<input type="hidden" name="exec"  value="update">
<input type="hidden" name="cb_id" value="<?=$cb[cb_id]?>">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#CCCCCC">
    <td height="3" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">Ŭ�����̵�</td>
    <td width="300" style="padding:5px 5px 5px 5px"><b><?=$cb[cb_id]?></b></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">Ŭ���Ŵ���</td>
    <td style="padding:5px 5px 5px 5px"><input name="cb_manager" type="text" id="cb_manager" itemname="Ŭ���Ŵ���" value=<?=$cb[cb_manager]?> required>
    <?
    $mb = get_member($cb[cb_manager]);
    echo get_sideview($mb[mb_id], $mb[mb_nick], $mb[mb_email]);
    ?>
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">Ŭ����</td>
    <td colspan="3" style="padding:5px 5px 5px 5px"><input name="cb_name" type="text" id="cb_name" itemname="Ŭ����" required style="width:60%;" value="<?=$cb[cb_name]?>"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">Ŭ���з�</td>
    <td colspan="3" style="padding:5px 5px 5px 5px"><select name="cc_id" id="cc_id" value="$cb[cc_id]">
    	<?
    		$sql		= " select * from $nc[tbl_category] order by cc_idx asc ";
    		$result	= mysql_query($sql);
    		for ($i=0; $row=mysql_fetch_array($result); $i++) {
    				echo "<option value='$row[cc_id]'>$row[cc_name]</option>\n";
    		}
    	?>
      </select>
      <input type="hidden" name="tmp_cc_id" value="<?=$cb[cc_id]?>"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">Ŭ������</td>
    <td colspan=3 style="padding:5px 5px 5px 5px"><input name="cb_type" type="radio" value="1" checked>
	      ���� Ŭ�� : ���Խ�û�� �ڵ� ����, �˻� ����<br>
	      <input name="cb_type" type="radio" value="2">
	      ���� Ŭ�� : Ŭ���Ŵ����� ���� �� ����, �˻� ����<br>
	      <input name="cb_type" type="radio" value="3">
	      ��� Ŭ�� : �ʴ뿡 ���ؼ��� ����, �˻� �Ұ���</td>
	</tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="2"></td>
  </tr>
  <tr>	
    <td width="150" align="center" bgcolor="#f7f7f7">���Ի���</td>
    <td colspan=3 style="padding:5px 5px 5px 5px"><input name="cb_join" type="radio" value="Y">
      �������<br>
      <input name="cb_join" type="radio" value="N">
      ���ԺҰ�</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="2"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">Ŭ�� ���� ȸ�� ���</td>
    <td class="list" colspan="3" style="padding:5px 5px 5px 5px">
      <select name="cb_join_level" id="cb_join_level">
      <?=get_level_option($cb[cb_id])?>
      </select></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">�����</td>
    <td colspan="3" style="padding:5px 5px 5px 5px"><select name="cb_state">
    	<?
    	  $cso = Array("�", "���", "���", "�������");
    	  for ($k=0; $k<count($cso); $k++) {
    	      $j = $k + 1;
    	      echo "<option value='$j'>$cso[$k]</option>";
    	  }
    	?>
    	</select></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">Ŭ������Ʈ</td>
    <td colspan="3" style="padding:5px 5px 5px 5px"><input name="cb_point" type="text" id="cb_point" style="width:60%;" value="<?=$cb[cb_point]?>">
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">�����������</td>
    <td colspan="3" style="padding:5px 5px 5px 5px"><input name="cb_ask_use" type="radio" value="Y">
      ���
      <input name="cb_ask_use" type="radio" value="N">
      ������</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">��������</td>
    <td colspan="3" style="padding:5px 5px 5px 5px;"><table border="0" cellspacing="0" cellpadding="2">
			  <tr>
			    <td>1. 
			    	<input type="text" name="cb_ask[]" size="50"></td>
			  </tr>
			  <tr>
			    <td>2. 
			    	<input type="text" name="cb_ask[]" size="50"></td>
			  </tr>
			  <tr>
			    <td>3. 
			    	<input type="text" name="cb_ask[]" size="50"></td>
			  </tr>
			  <tr>
			    <td>4.
			    	<input type="text" name="cb_ask[]" size="50"></td>
			  </tr>
			  <tr>
			    <td>5.
			    	<input type="text" name="cb_ask[]" size="50"></td>
			  </tr>
			</table></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
	</span>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">Ŭ��Ű����</td>
    <td colspan="3" style="padding:5px 5px 5px 5px"><input name="cb_keyword" type="text" id="cb_keyword" style="width:60%;" value="<?=$cb[cb_keyword]?>">
    	* �� Ű����� ','�� ����</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">Ŭ������</td>
    <td colspan="3" style="padding:5px 5px 5px 5px"><textarea name="cb_content" rows="5" id="cb_content" itemname="Ŭ����" required style="width:60%;"><?=$cb[cb_content]?></textarea>
    	* 120�� �̳�,
    	* HTML TAG ��� �Ұ�</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">������</td>
    <td style="padding:5px 5px 5px 5px"><?=$cb[cb_opendate]?></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">�����</td>
    <td style="padding:5px 5px 5px 5px"><?=$cb[cb_regdate]?></td>
  </tr>
  <tr bgcolor="#cccccc">
    <td height="2" colspan="4"></td>
  </tr>
  <tr>
    <td height="30" colspan="4" align="center">
        <input type="submit" name="Submit" value=" Ȯ    �� ">
        <a href="./club_admin.php?doc=admin_club_list.php" target=_parent>��  ��</a>
    </td>
  </tr>
</table>
</form>

<script language="JavaScript" type="text/JavaScript">
	f = document.fcbform;
	f.cb_state.value	= "<?=$cb[cb_state]?>";
	f.cb_join_level.value = "<?=$cb[cb_join_level]?>";
	
	f.cb_type[<?=$cb[cb_type]-1?>].checked = true;
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
		f = document.fcbform;
		if (f.cb_ask_use[0].checked == true) {
			for (i=0; i<5; i++) {
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
				f.action = "./admin_club_form_update.php";
				f.submit();
			}
		} else {
			f.action = "./admin_club_form_update.php";
			f.submit();
		}
	}
</script>
<br><br><br><br>

<?
include_once("$nc[cb_path]/tail.sub.php");
?>
