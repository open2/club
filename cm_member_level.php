<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("{$cb_id} Ŭ���� �������� �ʽ��ϴ�.");
}

$g4[title] = "$cb[cb_name]:Ŭ��ȸ����ް��� - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";

$sql    = " select a.*, count(b.mb_id) as total
              from $nc[tbl_mb_level] as a
         left join $nc[tbl_member] as b
                on a.cm_level = b.cm_level
               and a.cb_id = b.cb_id
             where a.cb_id = '$cb[cb_id]'
          group by a.cm_level
          order by a.cm_level asc ";
$result = sql_query($sql);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>ȸ�� ��� ����</strong></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<form name="fcmmemberlevel" method="post" action="./cm_member_level.update.php">
<input type="hidden" name="exec"  value="">
<input type="hidden" name="doc"  value="<?=$doc?>">
<input type="hidden" name="cb_id"  value="<?=$cb[cb_id]?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#CCCCCC">
    <td height="3" colspan="4"></td>
  </tr>
  <tr align="center" bgcolor="#f5f5f5">
    <td width="40" class="list"><input name="chkall" type="checkbox" id="chkall" value="checkbox" onClick="check_all(this.form);"></td>
    <td class="listsub">ȸ�����</td>
    <td class="listsub">��޸�</td>
    <td class="listsub">ȸ����</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <?
  for ($i=0; $row=mysql_fetch_array($result); $i++) {
      $list[$i] = $row;
      switch ($row[cm_level]) {
          case -100:
          case 10:
          case 20:
          case 30:
          case 100: 
                    $read_only = " readonly ";
                    break;
          default : 
                    $read_only = " ";
                    break;
      }
  ?>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr align="center">
    <td width="40" class="list">
    <input name="chk[]" type="checkbox" id="chk[]" value="<?=$i?>">
    <input type="hidden" name="ml_id[]" value="<?=$row[ml_id]?>">
    </td>
    <td class="list">
      <input name="cm_level[]" type="text" id="cm_level[]" size="10" class="ed" value="<?=$row[cm_level]?>" itemname="���" numeric required <?=$read_only?> style="text-align:right;" <?=$read_only?> >
      <input type="hidden" name="tmp_cm_level[]" value="<?=$row[cm_level]?>">
    </td>
    <td class="list"><input name="ml_name[]" type="text" id="ml_name[]" size="30" class="ed" value="<?=$row[ml_name]?>" itemname="��޸�" required ></td>
    <td class="list tahoma11"><?=$row[total]?></td>
  </tr>
  <?
  }
  ?>
  <tr bgcolor="#CCCCCC">
    <td height="2" colspan="4"></td>
  </tr>
  <tr>
    <td colspan="3">
        * 90�̸� : ȸ��, 90�̻� : ���ܱ���, 100 : �Ŵ���<br>
        * -100, 10, 20, 30, 100 ������ ȸ���� ������ �� �����ϴ� (Ŭ���⺻��)
    </td>
    <td colspan="2" align="right" style="padding:5px 10px 5px 10px;"><input name="button" type="button" id="button" style="background-color:#9FB2C5; height:22px; font: bold 12px '����'; color:#fff; padding:4px; border:1px solid #7E97B1; vertical-align:top; cursor:pointer;" value="���ü���" onClick="btn_check(this.form, 'update');">
      <input name="button" type="button" id="button" style="background-color:#9FB2C5; height:22px; font: bold 12px '����'; color:#fff; padding:4px; border:1px solid #7E97B1; vertical-align:top; cursor:pointer;" value="���û���" onClick="btn_check(this.form, 'delete');"></td>
  </tr>
</table>
</form>
<br>
<form name="fcmmemberleveladd" method="post" action="./cm_member_level.update.php">
<input type="hidden" name="exec"  value="add">
<input type="hidden" name="doc" value="<?=$doc?>">
<input type="hidden" name="cb_id" value="<?=$cb[cb_id]?>">
<table border="0" cellpadding="0" cellspacing="0" align="center">
  <tr bgcolor="#999999">
    <td height="3" colspan="4"></td>
  </tr>
  <tr align="center" bgcolor="#F5F5F5">
    <td height="25" width="100" class="listsub">���</td>
    <td height="25" width="250" class="listsub">��޸�</td>
    <td height="25" width="130">&nbsp;</td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="1" colspan="4"></td>
  </tr>
  <tr align="center">
    <td height="30"><input name="cm_level" type="text" id="cm_level" size="10" class="ed" itemname="���" numeric required style="text-align:right;"></td>
    <td height="30"><input name="ml_name" type="text" id="ml_name" size="30" class="ed" itemname="��޸�" required></td>
    <td height="30"><input type="submit" name="Submit" style="background-color:#9FB2C5; height:22px; font: bold 12px '����'; color:#fff; padding:4px; border:1px solid #7E97B1; vertical-align:top; cursor:pointer;" value=" ����߰� "></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="1" colspan="4"></td>
  </tr>
</table>
</form>
<br><br><br><br><br>
<script language="JavaScript" type="text/JavaScript">
    	
	function check_all(f)
	{
	    var chk = document.getElementsByName("chk[]");
	
	    for (i=0; i<chk.length; i++)
	        chk[i].checked = f.chkall.checked;
	}
	
	function btn_check(f, act)
	{
	    if (act == "update") // ���ü���
	    { 
	        f.exec.value = act;
	        str = "����";
	    } 
	    else if (act == "delete") // ���û���
	    { 
	        f.exec.value = act;
	        str = "����";
	    } 
	    else
	        return;
	
	    var chk = document.getElementsByName("chk[]");
	    var bchk = false;
	
	    for (i=0; i<chk.length; i++)
	    {
	        if (chk[i].checked)
	            bchk = true;
	    }
	
	    if (!bchk) 
	    {
	        alert(str + "�� �ڷḦ �ϳ� �̻� �����ϼ���.");
	        return;
	    }
	
	    if (act == "update")
	    {
	        if (!confirm("������ �ڷḦ ���� �Ͻðڽ��ϱ�?\n\n���õ� ȸ���� ��޵� ��� �����˴ϴ�."))
	            return;
	    }
	
	    if (act == "delete")
	    {
	        if (!confirm("������ �ڷḦ ���� ���� �Ͻðڽ��ϱ�?\n\n���õ� ȸ���� ����� ��� ��� 1�� �����˴ϴ�."))
	            return;
	    }
	
	    f.submit();
	}
</script>

<?
include "$nc[cb_path]/tail.sub.php";
?>
