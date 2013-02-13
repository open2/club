<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("{$cb_id} 클럽이 존재하지 않습니다.");
}

$g4[title] = "$cb[cb_name]:클럽메뉴권한관리 - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";

$list   = Array();
$sql    = " select *
              from $nc[tbl_mb_level]
             where cb_id = '$cb[cb_id]'
          order by cm_level asc ";
$result = mysql_query($sql);
for ($i=0; $row=mysql_fetch_array($result); $i++) {
    $list[$i] = $row;
}

$sql    = " select a.*, count(b.wr_id) as total
              from $nc[tbl_menu] as a
         left join $g4[write_prefix]{$cb_id} as b
                on a.cn_name = b.ca_name
             where cb_id = '$cb[cb_id]'
               and cn_type <> 'G'
               and cn_type <> 'U'
               and cn_type <> 'L'
          group by cn_name
          order by cn_idx asc ";
$result = mysql_query($sql);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>메뉴 권한 설정</strong></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<form name="fcmmenulevel" method="post" action="./cm_menulevel.update.php">
<input type="hidden" name="exec"  value="">
<input type="hidden" name="doc"   value="<?=$doc?>">
<input type="hidden" name="cb_id" value="<?=$cb[cb_id]?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#CCCCCC">
    <td height="3" colspan="9"></td>
  </tr>
  <tr align="center" bgcolor="#f5f5f5">
    <td width="10" class="list"><input type="checkbox" name="chkall" value="checkbox" onClick="check_all(this.form);"></td>
    <td align="left" class="listsub"><strong>메뉴명</strong></td>
    <td class="listsub"><strong>목록권한</strong></td>
    <td class="listsub"><strong>읽기권한</strong></td>
    <td class="listsub"><strong>쓰기권한</strong></td>
    <td class="listsub"><strong>답글권한</strong></td>
    <td class="listsub"><strong>코멘트권한</strong></td>
    <td class="listsub"><strong>삭제권한</strong></td>
    <td class="listsub"><strong>최신글출력</strong></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="9"></td>
  </tr>
  <?
  for ($i=0; $row=mysql_fetch_array($result); $i++) {
  ?>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="9"></td>
  </tr>
  <tr>
    <td width="10" align="center" class="list"><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="cn_id[]" value="<?=$row[cn_id]?>"></td>
    <td height="25" class="listtext"><?=$row[cn_name]?></td>
    <td height="25" align="center" class="list"><select name="cn_list_level[]">
        <option value="0">손님</option>
      <? // 목록
        $k = 0;
        while ($k <= count($list) - 1) {
            $selected = "";
            if ($list[$k][cm_level] == $row[cn_list_level]) {
                $selected = "selected";
            }
            echo "<option value='{$list[$k][cm_level]}' $selected>{$list[$k][ml_name]}</option>\n";
            $k++;
        }
      ?>
      </select></td>
    <td height="25" align="center" class="list"><select name="cn_view_level[]">
        <option value="0">손님</option>
      <? // 읽기
        $k = 0;
        while ($k <= count($list) - 1) {
            $selected = "";
            if ($list[$k][cm_level] == $row[cn_view_level]) {
                $selected = "selected";
            }
            echo "<option value='{$list[$k][cm_level]}' $selected>{$list[$k][ml_name]}</option>\n";
            $k++;
        }
      ?>
      </select></td>
    <td height="25" align="center" class="list"><select name="cn_write_level[]">
        <option value="0">손님</option>
      <? // 쓰기
        $k = 0;
        while ($k <= count($list) - 1) {
            $selected = "";
            if ($list[$k][cm_level] == $row[cn_write_level]) {
                $selected = "selected";
            }
            echo "<option value='{$list[$k][cm_level]}' $selected>{$list[$k][ml_name]}</option>\n";
            $k++;
        }
      ?>
      </select></td>
    <td height="25" align="center" class="list"><select name="cn_reply_level[]">
        <option value="0">손님</option>
      <? // 답글
        $k = 0;
        while ($k <= count($list) - 1) {
            $selected = "";
            if ($list[$k][cm_level] == $row[cn_reply_level]) {
                $selected = "selected";
            }
            echo "<option value='{$list[$k][cm_level]}' $selected>{$list[$k][ml_name]}</option>\n";
            $k++;
        }
      ?>
      </select></td>
    <td height="25" align="center" class="list"><select name="cn_comment_level[]">
        <option value="0">손님</option>
      <? // 코멘트
        $k = 0;
        while ($k <= count($list) - 1) {
            $selected = "";
            if ($list[$k][cm_level] == $row[cn_comment_level]) {
                $selected = "selected";
            }
            echo "<option value='{$list[$k][cm_level]}' $selected>{$list[$k][ml_name]}</option>\n";
            $k++;
        }
      ?>
      </select></td>
    <td height="25" align="center" class="list"><select name="cn_del_level[]">
        <option value="0">손님</option>
      <? // 삭제
        $k = 0;
        while ($k <= count($list) - 1) {
            $selected = "";
            if ($list[$k][cm_level] == $row[cn_del_level]) {
                $selected = "selected";
            }
            echo "<option value='{$list[$k][cm_level]}' $selected>{$list[$k][ml_name]}</option>\n";
            $k++;
        }
      ?>
      </select></td>
    <td height="25" align="center" class="listtext">
    		<select name="cn_1[]" class='ed'> 
        <? 
      	$lists[$i] = $row;
      	if($lists[$i][cn_1] == "Y") {
      	    $selected = "selected";
            $selected2 = "";
      	} else {
      	    $selected = "";
            $selected2 = "selected";
        }
        ?>
  		  <option value="Y" <?=$selected?>>출력함</option> 
  		  <option value="N" <?=$selected2?>>출력안함</option> 
		</select> 
    </td>
  </tr>
  <? } ?>
  <tr bgcolor="#CCCCCC">
    <td height="2" colspan="9"></td>
  </tr>
  <tr align="right">
    <td style="padding:5px 10px 5px 10px;" colspan="9"><a href="#" onClick="btn_check('document.fcmmenulevel', 'update');"><img src="images/btn_confirm.gif" width="90" height="21" border="0"></a></td>
  </tr>
</table>
</form>
<br><br><br><br><br><br>
<script language="JavaScript" type="text/JavaScript">
		
	function check_all(f)
	{
	    var chk = document.getElementsByName("chk[]");
	
	    for (i=0; i<chk.length; i++)
	        chk[i].checked = f.chkall.checked;
	}
	
	function btn_check(f, act)
	{
	    f = document.fcmmenulevel;
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
	    
	    if (act == "delete")
	    {
	        if (!confirm("선택한 자료를 정말 삭제 하시겠습니까?"))
	            return;
	    }
	
	    f.submit();
	}
</script>

<?
include "$nc[cb_path]/tail.sub.php";
?>
