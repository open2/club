<?
include_once "./_common.php";

$g4[title] = "클럽분류관리";
include_once("$nc[cb_path]/head.sub.php");

// 해당카테고리의 클럽숫자를 구해서, 클럽 카테고리 테이블을 업데이트 합니다
$sql_ca = " select * from $nc[category_table] ";
$result_ca = sql_query($sql_ca);
for ($i=0; $ca=sql_fetch_array($result_ca); $i++) {
    $tot = sql_total($nc[club_table], "cc_id", $ca[cc_id], $que="");
    sql_query(" update $nc[category_table] set cc_total = '$tot' where cc_id = '$ca[cc_id]' "); 
}

// 카테고리의 전체 갯수
$total_count = $i;

$sql_order	= " order by cc_idx asc, cc_id ";
$sql_group	= " group by cc_id ";

if ($stext) {
    $sql_where = " where $sselect like '%$stext%' ";
}

$sql	= " select *
              from $nc[category_table]
                   $sql_where
                   $sql_group
                   $sql_order ";
$result	= sql_query($sql);
?>

<table width="100%"  border="0">
<form name="fncsearch" method="post" action="./admin_category_list.php">
  <tr>
    <td><a href="./admin_category_list.php">전체</a> (<?=$total_count?>) </td>
    <td align="right">
        <select name="sselect">
        <option value="cc_id">분류아이디</option>
        <option value="cc_name">분류명</option>
        </select>
        <input type="text" name="stext" size="20" itemname="검색어" required>
        <input type="submit" name="Submit" value="검색">
    </td>
  </tr>
</form>
</table>

<table width="100%"  border="0" cellpadding="0" cellspacing="0">
<form name="fnccalist" method="post" action="./admin_category_update.php">
<input type="hidden" name="exec" value="">
  <tr bgcolor="#CCCCCC">
    <td height="3" colspan="6"></td>
  </tr>
  <tr align="center" bgcolor="#f5f5f5">
    <td width="40"><input type="checkbox" name="chkall" value="checkbox" onClick="check_all(this.form);"></td>
    <td width="80" height="25">ID</td>
    <td height="25" align="left">&nbsp;분류명</td>
    <td height="25">순서</td>
    <td height="25">클럽수</td>
    <td height="25">삭제</td>
  </tr>
  <tr>
    <td height="1" colspan="6" bgcolor="#EEEEEE"></td>
  </tr>
  <?
  	for ($i=0; $row=sql_fetch_array($result); $i++) {
  ?>
  <tr align="center">
    <td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="cc_id_list[]" value="<?=$row[cc_id]?>"></td>
    <td height="25"><?=$row[cc_id]?></td>
    <td height="25" align="left">&nbsp;<input type="text" name="cc_name_list[]" size="30" value="<?=$row[cc_name]?>" itemname="분류명" required></td>
    <td height="25"><input type="text" name="cc_idx[]" size="10" value="<?=$row[cc_idx]?>" style="text-align:right;"></td>
    <td height="25"><?=$row[cc_total]?></td>
    <td height="25"><a href="./admin_category_update.php?exec=delete&cc_id=<?=$row[cc_id]?>">삭제</a></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="6"></td>
  </tr>
	<?
		}
		if ($i == 0) {
			echo "<tr><td height='100' align='center' colspan='10'>검색 결과가 없습니다.</td></tr>";
		}
	?>
  <tr bgcolor="#CCCCCC">
    <td height="1" colspan="6"></td>
  </tr>
  <tr align="right">
    <td height="30" colspan="6"><input type="button" name="Submit" value="선택수정" onClick="btn_check(this.form, 'update');">
    <input type="button" name="Submit" value="선택삭제" onClick="btn_check(this.form, 'delete');"></td>
  </tr>
</form>
</table>
<br>

<form name="fnccaadd" method="post" action="./admin_category_update.php">
<input type="hidden" name="exec" value="add">
<table border="0" cellpadding="0" cellspacing="0" align="center">
  <tr bgcolor="#999999">
    <td height="3" colspan="4"></td>
  </tr>
  <tr align="center" bgcolor="#F5F5F5">
    <td height="25" width="100">ID</td>
    <td height="25" width="250">분류명</td>
    <td height="25" width="100">순서</td>
    <td height="25" width="130">&nbsp;</td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="1" colspan="4"></td>
  </tr>
  <tr align="center">
    <td height="30"><input name="cc_id" type="text" id="cc_id" size="10" itemname="ID" required></td>
    <td height="30"><input name="cc_name" type="text" id="cc_name" size="30" itemname="분류명" required></td>
    <td height="30"><input name="cc_idx" type="text" id="cc_idx" size="10" style="text-align:right;"></td>
    <td height="30"><input type="submit" name="Submit" value=" 분류추가 "></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="1" colspan="4"></td>
  </tr>
</table>
</form>

<script language="JavaScript" type="text/JavaScript">
		<? if ($stext) { ?>
		document.fncsearch.sselect.value	= "<?=$sselect?>";
		document.fncsearch.stext.value		= "<?=$stext?>";
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
