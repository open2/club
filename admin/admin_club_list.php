<?
include_once "./_common.php";

$g4[title] = "클럽 목록 관리";
include_once "$nc[cb_path]/head.sub.php";

if (!$ssort) { $ssort = "a.cb_regdate"; }
if (!$sorder) { $sorder = "desc"; }

$sql_common	= " from $nc[club_table] as a";
$sql_order	= " order by $ssort $sorder ";

if ($stext) {
	$sql_where	= " where (1) ";
	$sql_where .= " and $sselect like '%$stext%' ";
}

$sql = " select count(*) as cnt $sql_common ";
$result	= sql_fetch($sql);
$total_count = $result[cnt];

$rows		= 15;
$total_page	= ceil($total_count / $rows);	// 전체 페이지 계산
if ($page == "") { $page = 1; }				// 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows;			// 시작 열을 구함

$sql	= " select *,
                   date_format(a.cb_opendate, '%y.%m.%d') as opendate,
                   date_format(a.cb_regdate, '%y.%m.%d') as regdate
                   $sql_common
         left join $nc[category_table] as b
                on a.cc_id = b.cc_id
                   $sql_where
                   $sql_order
             limit $from_record, $rows ";
$result	= sql_query($sql);
?>

<table width="100%" border="0">
<form name="fcbsearch" method="post" action="./admin_club_list.php">
  <tr>
    <td>전체 (<?=$total_count?>) </td>
    <td align="right"><select name="sselect">
      <option value="a.cb_id">클럽아이디</option>
      <option value="a.cb_name">클럽명</option>
      <option value="a.cb_manager">매니져아이디</option>
    </select>
    <input name="stext" type="text" size="20" itemname="검색어" required>
    <input type="submit" name="Submit" value="검 색"></td>
  </tr>
</form>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<form name="fcblist" method="post" action="./admin_club_list_update.php">
<input type="hidden" name="exec" value="">
  <tr bgcolor="#CCCCCC">
    <td height="3" colspan="100"></td>
  </tr>
  <tr align="center" bgcolor="#f5f5f5">
    <td width="40" height="25"><input type="checkbox" name="chkall" value="checkbox" onClick="check_all(this.form);"></td>
    <td height="25"><b>클럽아이디</b></td>
    <td height="25" align="left">&nbsp;<b>클럽명</b></td>
    <td height="25"><b>매니져</b></td>
    <td height="25"><b>분류</b></td>
    <td height="25"><b>회원</b></td>
    <td height="25"><b>운영</b></td>
    <td height="25"><b>성격</b></td>
    <td height="25"><b>추천</b></td>
    <td height="25"><b>개설일</b></td>
    <td height="25"><b>등록일</b></td>
    <td height="25"><b>수정</b></td>
  </tr>
  <tr>
    <td height="1" colspan="100" bgcolor="#EEEEEE"></td>
  </tr>
<?
	for ($i=0;$row=mysql_fetch_array($result); $i++) {
?>
  <tr align="center">
    <td height="25"><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="cb_id_arr[]" value="<?=$row[cb_id]?>"></td>
    <td height="25"><a href="<?=$nc[cb_path]?>/club_main.php?cb_id=<?=$row[cb_id]?>" target="_blank" style="text-decoration: underline;"><?=$row[cb_id]?></a></td>
    <td height="25" align="left">&nbsp;<?=$row[cb_name]?></td>
    <td height="25"><?=view_member($row[cb_manager])?></td>
    <td height="25"><?=$row[cc_name]?><input type="hidden" name="cc_id[]" value="<?=$row[cc_id]?>"></td>
    <td height="25"><a href="./admin_club_mblist.php?cb_id=<?=$row[cb_id]?>" style="text-decoration: underline;"><?=$row[cb_total_member]?></a></td>
    <td height="25"><select name="cb_state[]">
    	<?
    		$cso = Array("운영", "대기", "폐쇄", "개설대기");
    		for ($k=0; $k<count($cso); $k++) {
    				$j = $k + 1;
    				$selected = "";
    				if ($j == $row[cb_state]) $selected = "selected";
    				echo "<option value='$j' $selected>$cso[$k]</option>";
    		}
    	?>
    	</select>
    	<input type="hidden" name="tmp_cb_state[]" value="<?=$row[cb_state]?>"></td>
    <td height="25"><select name="cb_type[]">
    	<?
    		$cto = Array("공개", "승인", "비밀");
    		for ($k=0; $k<count($cto); $k++) {
    				$j = $k + 1;
    				$selected = "";
    				if ($j == $row[cb_type]) $selected = "selected";
    				echo "<option value='$j' $selected>$cto[$k]</option>";
    		}
    	?>
    	</select></td>
    <td height="25"><input type="checkbox" name="cb_recommend[<?=$i?>]" value="Y" <?=($row[cb_recommend]=="Y")?"checked":""?>></td>
    <td height="25"><?=$row[opendate]?></td>
    <td height="25"><?=$row[regdate]?></td>
    <td height="25"><a href="./admin_club_form.php?cb_id=<?=$row[cb_id]?>&exec=update">수정</a></td>
  </tr>
  <tr>
    <td height="1" colspan="100" bgcolor="#EEEEEE"></td>
  </tr>
<?
	}

	if ($i == 0) {
		echo "<tr><td height='100' align='center' colspan='10'>검색 결과가 없습니다.</td></tr>";
	}
?>
  <tr>
    <td height="1" colspan="100" bgcolor="#EEEEEE"></td>
  </tr>
  <tr>
  	<td colspan="100"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
			    <td height="30"><input type="button" name="Submit" value="선택수정" onClick="btn_check(this.form, 'update');">
    				<input type="button" name="Submit" value="선택삭제" onClick="btn_check(this.form, 'delete');"></td>
			    <td height="30">
			    	<?
							$pagelist = get_paging(10, $page, $total_page, "./admin_club_list.php?doc=$doc&sorder=$sorder&ssort=$ssort&page=");
							if ($pagelist) {
							    echo "<p><table width=100% cellpadding=3 cellspacing=1><tr><td align=center>$pagelist</td></tr></table>\n";
							}
						?>
					</td>
			  </tr>
			</table></td>
  </tr>
</form>
</table>
<br><br><br><br>
<script language="JavaScript" type="text/JavaScript">
	<? if ($stext) { ?>
	document.fcbsearch.stext.value		= "<?=$stext?>";
	document.fcbsearch.sselect.value	= "<?=$sselect?>";
	<? } ?>
	
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
	
	    if (act == "delete")
	    {
	        if (!confirm("선택한 자료를 정말 삭제 하시겠습니까?"))
	            return;
	    }
	
	    f.submit();
	}
</script>

<?
include_once("$nc[cb_path]/tail.sub.php");
?>
