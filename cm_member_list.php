<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("{$cb_id} 클럽이 존재하지 않습니다.");
}

$g4[title] = "$cb[cb_name]:클럽회원관리 - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";


if (!$ssort) { $ssort = "a.cm_regdate"; }
if (!$sorder) { $sorder = "desc"; }

$sql_common = " $nc[tbl_member] as a, $g4[member_table] as b ";
$sql_order	= " order by $ssort $sorder ";

$sql_where  = " where ( a.mb_id = b.mb_id and a.cb_id = '$cb[cb_id]' )  ";
if ($stext) {
    $sql_where .= " and $sselect like '%$stext%' ";
}

$sql    = " select count(*) from $sql_common $sql_where $sql_order ";
$result = mysql_query($sql);
$row    = mysql_fetch_array($result);
$total_count = $row[0];

$rows		= 15;
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
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>전체 회원 관리</strong></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <colgroup><col /><col width="50px" /><col width="100px" /><col width="63px" /></colgroup>
	  <form name="fcbsearch" method="post" action="./cm_member_list.php">
      <input type="hidden" name="cb_id" value="<?=$cb[cb_id]?>">
        <tr>
          <td><a href="./cm_member_list.php?cb_id=<?=$cb[cb_id]?>">처음</a> (<?=$total_count?>)</td>
          <td align="right"><select name="sselect">
            <option value="a.mb_id">아이디</option>
            <option value="b.mb_nick">닉네임</option>
          </select></td>
          <td align="center"><input name="stext" type="text" size="20" style="width:100%" itemname="검색어" required></td>
          <td align="right"><input type="image" src="images/cb_search_btn.gif" name="Submit" value="검 색"></td>
        </tr>
      </form>
    </table></td>
  </tr>
  <tr>
    <td height="3" colspan="7"></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="3" colspan="7"></td>
  </tr>
  <tr align="center" bgcolor="#f5f5f5">
  <form name="fcmmblevel" method="post" action="./cm_member_list.update.php">
    <input type="hidden" name="exec"  value="">
    <input type="hidden" name="doc" value="<?=$doc?>">
    <input type="hidden" name="cb_id" value="<?=$cb[cb_id]?>">
    <input type="hidden" name="page" value="<?=$page?>">
    <td width="40" height="25" class="list"><input name="chkall" type="checkbox" id="chkall" value="checkbox" onClick="check_all(this.form);"></td>
    <td align="left" class="listsub">닉네임</td>
    <td class="listsub">회원등급</td>
    <td class="listsub">가입일</td>
    <td class="listsub">최근방문일</td>
    <td class="listsub">클럽포인트</td>
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
      <? if ($row[mb_id] !== $cb[cb_manager]) { ?>
          <input name="chk[]" type="checkbox" id="chk[]" value="<?=$i?>"><input type="hidden" name="mb_id[]" value="<?=$row[mb_id]?>">
      <? } ?>
    </td>
    <td height="25" class="listtext"><?=$mb_name?>(<?=$row[mb_id]?>)</td>
    <td height="25" align="center" class="list">
      <? if ($row[mb_id] == $cb[cb_manager]) { ?>
          <?
              $sql1 = " select ml_name from $nc[tbl_mb_level]
                       where cb_id = '$cb[cb_id]' and cm_level='$row[cm_level]' ";
              $ml = sql_fetch($sql1);
              echo $ml[ml_name];
          ?>
      <? } else { ?>
      <select name="cm_level[]">
      <?
        $sql1     = " select *
                        from $nc[tbl_mb_level]
                       where cb_id = '$cb[cb_id]'
                    order by cm_level asc ";
        $result1  = mysql_query($sql1);
        for ($k=0; $ml=mysql_fetch_array($result1); $k++) {
            $selected = "";
            if ($ml[cm_level] == $row[cm_level]) { $selected = "selected"; }
            echo "<option value='$ml[cm_level]' $selected>$ml[ml_name]</option>\n";
        }
      ?>
      </select>
      <? } ?>
    </td>
    <td height="25" align="center" class="tahoma11 list"><?=$row[regdate]?></td>
    <td height="25" align="center" class="tahoma11 list"><?=$row[logdate]?></td>
    <td height="25" align="center" class="tahoma11 list"><?=$row[cm_point]?></td>
    <td height="25" align="center" class="tahoma11 list"><?=$row[cm_visit]?></td>
  </tr>
  <?
  $ask = explode("|", $row[cm_query]);
  $reply = explode("|", $row[cm_reply]);
  if ($ask[0]) { 
  ?>
  <tr>
    <td width="40" height="25" align="center" class="list">&nbsp;</td>
    <td colspan=5>
    <?
        $ask_count = count($ask) - 1;
        for ($m=0; $m < $ask_count; $m++) {
            echo "(" . $ask[$m] . ") " . $reply[$m] . "&nbsp;&nbsp;&nbsp;";
        }
    ?>
    </td>
  </tr>
  <? } ?>
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
          <td style="padding:5px 10px 5px 10px;"><a href="#" onClick="btn_check('update');"><img src="./images/btn_confirm.gif" width="90" height="21" border="0"></td>
          <td align="right">
            <?
				$pagelist = get_paging($rows, $page, $total_page, "./cm_member_list.php?cb_id=$cb[cb_id]". $qstr. "&page=");
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

	    f.submit();
	}
</script>

<?
include "$nc[cb_path]/tail.sub.php";
?>
