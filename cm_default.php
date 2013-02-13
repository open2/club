<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("해당 클럽이 존재하지 않습니다.", "$nc[cb_url_path]/club_index.php");
}

$g4[title] = "$cb[cb_name]:클럽기본정보관리 - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>기본 정보</strong></td>
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
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽아이디</td>
    <td colspan="2" style="font-family:verdana; font-weight: bold; padding: 7px 7px 7px 7px;"><?=$cb[cb_id]?></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽명</td>
    <?
      // 클럽명 변경이후의 남은 날짜수를 계산
      $title_change_diff = $nc[nf_title_change_limits] - floor(($g4[server_time] - strtotime($cb[cb_title_change_date])) / 86400);
      if ($is_admin=="super" || $title_change_diff < 1) {
    ?>
    <td colspan="2" class="list"><input name="cb_name" type="text" id="cb_name" size="40" class="ed" itemname="클럽명" required>
      <a href="javascript:cb_name_check();"><img src="./images/btn_double.gif" alt="중복확인" width="68" height="21" border="0" align="absmiddle"></a>
      &nbsp;(클럽명 변경제한 <?=$nc[nf_title_change_limits]?>일)
    </td>
    <? } else { ?>
    <td colspan="2" class="list"><input name="cb_name" type="text" id="cb_name" size="40" class="ed" itemname="클럽명" readonly>
      &nbsp;(클럽명은 <?=$title_change_diff?>일후 변경이 가능합니다)
    </td>
    <? } ?>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 분류</td>
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
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 성격</td>
    <td colspan="2" class="list"><input name="cb_type" type="radio" value="1" checked>
      공개 클럽 : 가입신청시 자동 가입, 검색 가능<br>
      <input name="cb_type" type="radio" value="2">
      승인 클럽 : 클럽매니져의 승인 후 가입, 검색 가능<br>
      <input name="cb_type" type="radio" value="3">
      비밀 클럽 : 초대에 의해서만 가입, 검색 불가능 </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 운영 상태</td>
    <td colspan="2" class="list">
    	<?
    	  if ($is_admin!=='super' && $cb[cb_state]=='3') {
    	      echo "클럽 폐쇄 : 클럽상태를 변경하려면 사이트 운영자에게 문의하시기 바랍니다.";
    	?>
    	      <input type="hidden" name="cb_state" value="<?=$cb[cb_state]?>">
      <?
    	  } else {
        	  echo "<select name='cb_state'>";
        		$cso = Array("운영", "대기", "폐쇄");
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
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 검색 키워드</td>
    <td width="" class="list"><input type="text" name="cb_keyword" id="cb_keyword" class="ed" style="width:100%; ">
      </textarea>
    * 각 키워드는 ','로 구분
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 설명</td>
    <td width="" class="list"><textarea name="cb_content" rows="5" id="cb_content" class="tx" style="width:100%;" itemname="클럽설명" required><?=$cb[cb_content]?></textarea>
    * 120자 이내, HTML TAG 사용 불가 
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">현재접속자 출력</td>
    <td colspan="2" style="padding:7px 7px 7px 7px; font-family:tahoma;">
        <input type='checkbox' name='cb_connect_view' value='1' <?=$cb[cb_connect_view]?'checked':'';?>> 현재접속자출력
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">메뉴하단 text 출력</td>
    <td colspan="2" style="padding:7px 7px 7px 7px; font-family:tahoma;">
        <textarea name="cb_left_textarea" rows="5" id="cb_left_textarea" class="tx" style="width:100%;" itemname="메뉴하단 text 출력" ><?=stripslashes($cb[cb_left_textarea])?></textarea>
        * 메뉴의 아래쪽에 나올 text/html을 입력해주세요. JavaScript/php는 해킹의 우려로 허용하지 않습니다
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽하단 text 출력</td>
    <td colspan="2" style="padding:7px 7px 7px 7px; font-family:tahoma;">
        <textarea name="cb_tail_textarea" rows="5" id="cb_tail_textarea" class="tx" style="width:100%;" itemname="클럽하단 text 출력" ><?=stripslashes($cb[cb_tail_textarea])?></textarea>
        * 클럽의 아래쪽에 나올 text/html을 입력해주세요. JavaScript/php는 해킹의 우려로 허용하지 않습니다
        * 입력하지 않으면, 사이트의 기본 tail만 출력 됩니다.
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 개설일</td>
    <td colspan="2" style="padding:7px 7px 7px 7px; font-family:tahoma;"><?=$cb[cb_opendate]?></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 관리자</td>
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

    // 클럽 이름 검사
	function cb_name_check()
	{
	    if (f.cb_name.value == "") {
	        alert("클럽 이름을 입력하세요.");
	        f.cb_name.focus();
	        return;
	    }
	    
	    if (f.cb_name.value == f.tmp_cb_name.value) {
	        alert("'"+f.cb_name.value + "'은(는) 중복된 클럽명이 없습니다.\n\n사용하셔도 좋습니다.");
	        return;
	    }
	
	    var id = prohibit_id_check(f.cb_name.value);
	    if (id) {
	        alert("'"+id + "'은(는) 사용하실 수 없는 클럽명입니다.");
	        f.cb_name.focus();
	        return;
	    }
	
	    win_open("./club_id_check.php?w=cb_name&cb_name="+f.cb_name.value, "hiddenframe");
	}
	
	// 금지 아이디 검사
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
