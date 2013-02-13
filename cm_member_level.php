<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("{$cb_id} 클럽이 존재하지 않습니다.");
}

$g4[title] = "$cb[cb_name]:클럽회원등급관리 - $nc[nf_title]";
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
		<td width="100%" background="./images/box_list_bg1.gif"><strong>회원 등급 설정</strong></td>
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
    <td class="listsub">회원등급</td>
    <td class="listsub">등급명</td>
    <td class="listsub">회원수</td>
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
      <input name="cm_level[]" type="text" id="cm_level[]" size="10" class="ed" value="<?=$row[cm_level]?>" itemname="등급" numeric required <?=$read_only?> style="text-align:right;" <?=$read_only?> >
      <input type="hidden" name="tmp_cm_level[]" value="<?=$row[cm_level]?>">
    </td>
    <td class="list"><input name="ml_name[]" type="text" id="ml_name[]" size="30" class="ed" value="<?=$row[ml_name]?>" itemname="등급명" required ></td>
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
        * 90미만 : 회원, 90이상 : 스텝권한, 100 : 매니저<br>
        * -100, 10, 20, 30, 100 레벨의 회원은 수정할 수 없습니다 (클럽기본임)
    </td>
    <td colspan="2" align="right" style="padding:5px 10px 5px 10px;"><input name="button" type="button" id="button" style="background-color:#9FB2C5; height:22px; font: bold 12px '돋움'; color:#fff; padding:4px; border:1px solid #7E97B1; vertical-align:top; cursor:pointer;" value="선택수정" onClick="btn_check(this.form, 'update');">
      <input name="button" type="button" id="button" style="background-color:#9FB2C5; height:22px; font: bold 12px '돋움'; color:#fff; padding:4px; border:1px solid #7E97B1; vertical-align:top; cursor:pointer;" value="선택삭제" onClick="btn_check(this.form, 'delete');"></td>
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
    <td height="25" width="100" class="listsub">등급</td>
    <td height="25" width="250" class="listsub">등급명</td>
    <td height="25" width="130">&nbsp;</td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="1" colspan="4"></td>
  </tr>
  <tr align="center">
    <td height="30"><input name="cm_level" type="text" id="cm_level" size="10" class="ed" itemname="등급" numeric required style="text-align:right;"></td>
    <td height="30"><input name="ml_name" type="text" id="ml_name" size="30" class="ed" itemname="등급명" required></td>
    <td height="30"><input type="submit" name="Submit" style="background-color:#9FB2C5; height:22px; font: bold 12px '돋움'; color:#fff; padding:4px; border:1px solid #7E97B1; vertical-align:top; cursor:pointer;" value=" 등급추가 "></td>
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
	    if (act == "update") // 선택수정
	    { 
	        f.exec.value = act;
	        str = "수정";
	    } 
	    else if (act == "delete") // 선택삭제
	    { 
	        f.exec.value = act;
	        str = "삭제";
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
	        alert(str + "할 자료를 하나 이상 선택하세요.");
	        return;
	    }
	
	    if (act == "update")
	    {
	        if (!confirm("선택한 자료를 수정 하시겠습니까?\n\n관련된 회원의 등급도 모두 수정됩니다."))
	            return;
	    }
	
	    if (act == "delete")
	    {
	        if (!confirm("선택한 자료를 정말 삭제 하시겠습니까?\n\n관련된 회원의 등급은 모두 등급 1로 수정됩니다."))
	            return;
	    }
	
	    f.submit();
	}
</script>

<?
include "$nc[cb_path]/tail.sub.php";
?>
