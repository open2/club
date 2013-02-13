<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("{$cb_id} 클럽이 존재하지 않습니다.");
}

$g4[title] = "클럽관리";
include_once "$nc[cb_path]/head.sub.php";

if (!$ssort) { $ssort = "a.cm_regdate"; }
if (!$sorder) { $sorder = "desc"; }

$sql_common = " $nc[member_table] as a, $g4[member_table] as b ";
$sql_order	= " order by $ssort $sorder ";

$sql_where  = " where ( a.mb_id = b.mb_id and a.cb_id = '$cb[cb_id]' ) ";
if ($stext) {
    $sql_where .= " and $sselect like '%$stext%' ";
}

$sql    = " select count(*) from $sql_common $sql_where $sql_order ";
$result = sql_query($sql);
$row    = sql_fetch_array($result);
$total_count = $row[0];

$rows		= 10;
$total_page	= ceil($total_count / $rows);	// 전체 페이지 계산
if ($page == "") { $page = 1; }				// 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows;			// 시작 열을 구함

$sql	= " select *,
                   date_format(cm_regdate, '%y.%m.%d %p %h:%i') as regdate,
                   date_format(cm_logdate, '%y.%m.%d %p %h:%i') as logdate
              from $sql_common
                   $sql_where
                   $sql_order
             limit $from_record, $rows ";
$result	= mysql_query($sql);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" colspan="7"><strong>클럽관리 > 클럽 회원 목록 </strong></td>
  </tr>
  <tr>
    <td colspan="7"><table width="100%" border="0">
      <form name="fcbsearch" method="post" action="./cm_member_list.php">
      <input type="hidden" name="cb_id" value="<?=$cb[cb_id]?>">
        <tr>
          <td><a href="./admin_club_mblist.php?cb_id=<?=$cb[cb_id]?>">처음</a> (<?=$total_count?>)</td>
          <td align="right"><select name="sselect">
            <option value="a.mb_id">아이디</option>
            <option value="b.mb_nick">닉네임</option>
          </select>
          <input name="stext" type="text" size="20" itemname="검색어" required>
          <input type="submit" name="Submit" value="검 색"></td>
        </tr>
      </form>
    </table></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="3" colspan="7"></td>
  </tr>
  <tr align="center" bgcolor="#f5f5f5">
  <form name="fcmmblevel" method="post" action="./admin_club_mblist_update.php">
  <input type="hidden" name="exec"  value="">
  <input type="hidden" name="cb_id" value="<?=$cb[cb_id]?>">
    <td width="40" height="25" class="list"><input name="chkall" type="checkbox" id="chkall" value="checkbox" onClick="check_all(this.form);"></td>
    <td align="left" class="listsub">닉네임</td>
    <td class="listsub">회원등급</td>
    <td class="listsub">가입일</td>
    <td class="listsub">최근방문일</td>
    <td class="listsub">방문수</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="7"></td>
  </tr>
  <?
    for ($i=0; $row=mysql_fetch_array($result); $i++) {
        $mb_homepage  = get_text(addslashes($row[mb_homepage]));
    	$tmp_name     = get_text(cut_str($row[mb_nick], $config[cf_cut_name])); // 설정된 자리수 만큼만 이름 출력
    	$mb_name      = get_sideview($row[mb_id], $tmp_name, $row[mb_email], $mb_homepage);
  ?>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="7"></td>
  </tr>
  <tr>
    <td width="40" height="25" align="center" class="list">
      <input name="chk[]" type="checkbox" id="chk[]" value="<?=$i?>"><input type="hidden" name="mb_id[]" value="<?=$row[mb_id]?>">
    </td>
    <td height="25" class="listtext"><?=$mb_name?>(<?=$row[mb_id]?>)</td>
    <td height="25" align="center" class="list"><select name="cm_level[]">
      <?
        $sql1     = " select *
                        from $nc[mb_level_table]
                       where cb_id = '$cb[cb_id]'
                       order by cm_level asc ";
        $result1  = sql_query($sql1);
        for ($k=0; $ml=sql_fetch_array($result1); $k++) {
            $selected = "";
            if ($ml[cm_level] == $row[cm_level]) { $selected = "selected"; }
            echo "<option value='$ml[cm_level]' $selected>$ml[ml_name]</option>\n";
        }
      ?>
      </select></td>
    <td height="25" align="center" class="tahoma11 list"><?=$row[regdate]?></td>
    <td height="25" align="center" class="tahoma11 list"><?=$row[logdate]?></td>
    <td height="25" align="center" class="tahoma11 list"><?=$row[cm_visit]?></td>
  </tr>
  <?
    }
    
    if ($i == 0) {
		echo "<tr><td height='100' align='center' colspan='10'>검색 결과가 없습니다.</td></tr>";
	}
  ?>
  <tr bgcolor="#CCCCCC">
    <td height="2" colspan="7"></td>
  </tr>
  <tr align="right">
    <td colspan="10"><table border="0" width="100%">
        <tr>
          <td style="padding:5px 10px 5px 10px;"><input type="button" value=" 선택수정 " onClick="btn_check('update');"></td>
          <td align="right">
            <?
				$pagelist = get_paging($rows, $page, $total_page, "./admin_club_mblist.php?cb_id=$cb[cb_id]". $qstr. "&page=");
				if ($pagelist) {
				    echo "<p><table width=100% cellpadding=3 cellspacing=1><tr><td align=right>$pagelist</td></tr></table>\n";
				}
			?>
		  </td>
		</tr>
    </table></td>
  </tr>
  </form>
</table>
<br><br><br><br><br>

<script language="JavaScript" type="text/JavaScript">
	
	<?
	if ($stext) {
	    echo "document.fcbsearch.stext.value    = '$stext';";
	    echo "document.fcbsearch.sselect.value  = '$sselect';";
    }
    ?>
    	
	function check_all(f)
	{
	    var chk = document.getElementsByName("chk[]");
	
	    for (i=0; i<chk.length; i++)
	        chk[i].checked = f.chkall.checked;
	}
	
	function btn_check(act)
	{
	    f = document.fcmmblevel;
	    
	    if (act == "update") // 선택수정
	    { 
	        f.exec.value = act;
	        str = "수정";
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
