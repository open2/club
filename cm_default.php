<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("�ش� Ŭ���� �������� �ʽ��ϴ�.", "$nc[cb_url_path]/club_index.php");
}

$g4[title] = "$cb[cb_name]:Ŭ���⺻�������� - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>�⺻ ����</strong></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<form name="fcmdefault" method="post" action="./cm_default.update.php" enctype="multipart/form-data">
<input type="hidden" name="doc"         value="<?=$doc?>">
<input type="hidden" name="cb_id"       value="<?=$cb[cb_id]?>">
<input type="hidden" name="tmp_cb_name" value="<?=$cb[cb_name]?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="3" colspan="3" bgcolor="#CCCCCC"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�����̵�</td>
    <td colspan="2" style="font-family:verdana; font-weight: bold; padding: 7px 7px 7px 7px;"><?=$cb[cb_id]?></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ����</td>
    <?
      // Ŭ���� ���������� ���� ��¥���� ���
      $title_change_diff = $nc[nf_title_change_limits] - floor(($g4[server_time] - strtotime($cb[cb_title_change_date])) / 86400);
      if ($is_admin=="super" || $title_change_diff < 1) {
    ?>
    <td colspan="2" class="list"><input name="cb_name" type="text" id="cb_name" size="40" class="ed" itemname="Ŭ����" required>
      <a href="javascript:cb_name_check();"><img src="./images/btn_double.gif" alt="�ߺ�Ȯ��" width="68" height="21" border="0" align="absmiddle"></a>
      &nbsp;(Ŭ���� �������� <?=$nc[nf_title_change_limits]?>��)
    </td>
    <? } else { ?>
    <td colspan="2" class="list"><input name="cb_name" type="text" id="cb_name" size="40" class="ed" itemname="Ŭ����" readonly>
      &nbsp;(Ŭ������ <?=$title_change_diff?>���� ������ �����մϴ�)
    </td>
    <? } ?>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� �з�</td>
    <td colspan="2" class="list">
      <select name="cc_id" id="cc_id">
        <?
          $sql    = " select * from $nc[tbl_category] order by cc_idx asc ";
          $result = mysql_query($sql);
          for ($i=0; $row=mysql_fetch_array($result); $i++) {
              echo "<option value='$row[cc_id]'>$row[cc_name]</option>\n";
          }
        ?>
      </select><input type="hidden" name="tmp_cc_id" value="<?=$cb[cc_id]?>"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ����</td>
    <td colspan="2" class="list"><input name="cb_type" type="radio" value="1" checked>
      ���� Ŭ�� : ���Խ�û�� �ڵ� ����, �˻� ����<br>
      <input name="cb_type" type="radio" value="2">
      ���� Ŭ�� : Ŭ���Ŵ����� ���� �� ����, �˻� ����<br>
      <input name="cb_type" type="radio" value="3">
      ��� Ŭ�� : �ʴ뿡 ���ؼ��� ����, �˻� �Ұ��� </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� � ����</td>
    <td colspan="2" class="list">
    	<?
    	  if ($is_admin!=='super' && $cb[cb_state]=='3') {
    	      echo "Ŭ�� ��� : Ŭ�����¸� �����Ϸ��� ����Ʈ ��ڿ��� �����Ͻñ� �ٶ��ϴ�.";
    	?>
    	      <input type="hidden" name="cb_state" value="<?=$cb[cb_state]?>">
      <?
    	  } else {
        	  echo "<select name='cb_state'>";
        		$cso = Array("�", "���", "���");
    		    for ($k=0; $k<count($cso); $k++) {
        		    $j = $k + 1;
        		    echo "<option value='$j'>$cso[$k]</option>";
    		    }
        		echo "</select>";
    		}
    	?>
      <input type="hidden" name="tmp_cb_state" value="<?=$cb[cb_state]?>"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� �˻� Ű����</td>
    <td width="" class="list"><input type="text" name="cb_keyword" id="cb_keyword" class="ed" style="width:100%; ">
      </textarea>
    * �� Ű����� ','�� ����
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ����</td>
    <td width="" class="list"><textarea name="cb_content" rows="5" id="cb_content" class="tx" style="width:100%;" itemname="Ŭ������" required><?=$cb[cb_content]?></textarea>
    * 120�� �̳�, HTML TAG ��� �Ұ� 
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">���������� ���</td>
    <td colspan="2" style="padding:7px 7px 7px 7px; font-family:tahoma;">
        <input type='checkbox' name='cb_connect_view' value='1' <?=$cb[cb_connect_view]?'checked':'';?>> �������������
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">�޴��ϴ� text ���</td>
    <td colspan="2" style="padding:7px 7px 7px 7px; font-family:tahoma;">
        <textarea name="cb_left_textarea" rows="5" id="cb_left_textarea" class="tx" style="width:100%;" itemname="�޴��ϴ� text ���" ><?=stripslashes($cb[cb_left_textarea])?></textarea>
        * �޴��� �Ʒ��ʿ� ���� text/html�� �Է����ּ���. JavaScript/php�� ��ŷ�� ����� ������� �ʽ��ϴ�
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ���ϴ� text ���</td>
    <td colspan="2" style="padding:7px 7px 7px 7px; font-family:tahoma;">
        <textarea name="cb_tail_textarea" rows="5" id="cb_tail_textarea" class="tx" style="width:100%;" itemname="Ŭ���ϴ� text ���" ><?=stripslashes($cb[cb_tail_textarea])?></textarea>
        * Ŭ���� �Ʒ��ʿ� ���� text/html�� �Է����ּ���. JavaScript/php�� ��ŷ�� ����� ������� �ʽ��ϴ�
        * �Է����� ������, ����Ʈ�� �⺻ tail�� ��� �˴ϴ�.
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ������</td>
    <td colspan="2" style="padding:7px 7px 7px 7px; font-family:tahoma;"><?=$cb[cb_opendate]?></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ������</td>
    <? $mb_manager = get_member($cb[cb_manager]);?>
    <td colspan="2" style="padding:7px 7px 7px 7px; font-family:tahoma;"><?=$cb[cb_manager]?> (<?=$mb_manager[mb_nick]?>/<?=$mb_manager[mb_name]?>)</td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="2" colspan="3"></td>
  </tr>
  <tr align="right">
    <td colspan="3" style="padding:5px 10px 5px 10px;"><input name="imageField" type="image" src="./images/btn_confirm.gif" width="90" height="21" border="0"></td>
  </tr>
</table>
<br><br><br><br><br><br>
</form>
<script language="JavaScript" type="text/JavaScript">
    var f = document.fcmdefault;
    
    f.cb_name.value     = "<?=$cb[cb_name]?>";
    f.cc_id.value       = "<?=$cb[cc_id]?>";
    f.cb_state.value    = "<?=$cb[cb_state]?>";
    f.cb_keyword.value  = "<?=$cb[cb_keyword]?>";
    f.cb_type[<?=$cb[cb_type]-1?>].checked = true;

    // Ŭ�� �̸� �˻�
	function cb_name_check()
	{
	    if (f.cb_name.value == "") {
	        alert("Ŭ�� �̸��� �Է��ϼ���.");
	        f.cb_name.focus();
	        return;
	    }
	    
	    if (f.cb_name.value == f.tmp_cb_name.value) {
	        alert("'"+f.cb_name.value + "'��(��) �ߺ��� Ŭ������ �����ϴ�.\n\n����ϼŵ� �����ϴ�.");
	        return;
	    }
	
	    var id = prohibit_id_check(f.cb_name.value);
	    if (id) {
	        alert("'"+id + "'��(��) ����Ͻ� �� ���� Ŭ�����Դϴ�.");
	        f.cb_name.focus();
	        return;
	    }
	
	    win_open("./club_id_check.php?w=cb_name&cb_name="+f.cb_name.value, "hiddenframe");
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
</script>

<?
include "$nc[cb_path]/tail.sub.php";
?>
