<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td width="30"><img src="<?=$nc[member_skin_path]?>/img/box_list_t01.gif"></td>
		<td width="100%" background="<?=$nc[member_skin_path]?>/img/box_list_bg1.gif"><strong>클럽 만들기</strong></td>
		<td width="50"><img src="<?=$nc[member_skin_path]?>/img/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="<?=$nc[member_skin_path]?>/img/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<form name="fcbopen" method="post" action="javascript:check_agree();">
<input type=hidden name=cb_id_enabled    value="" id="cb_id_enabled">
<input type=hidden name=cb_name_enabled  value="" id="cb_name_enabled">
  <tr>
    <td width="140" bgcolor="#f7f7f7" class="gmenu"><strong>클럽 아이디</strong></td>
    <td colspan="2" style="padding:5px 0px 5px 10px;"><? if ($nc[cb_disc]) { echo "<strong>$nc[cb_disc]</strong> "; } ?><input name="cb_id" type="text" id="cb_id" class="ed" itemname="클럽아이디" required size="50" maxlength="17" style="ime-mode:inactive;" onchange="fcbopen.cb_id_enabled.value='';">
      <a href="javascript:cb_id_check();"><img src="<?=$nc[member_skin_path]?>/img/btn_double_check.gif" alt="중복확인" width="80" height="20" border="0" align="absmiddle"></a>
      <br>※ 한번 등록한 클럽아이디는 변경할 수 없습니다.
      </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu"><strong>클럽 이름</strong></td>
    <td colspan="2" style="padding:5px 0px 5px 10px;"><input name="cb_name" type="text" id="cb_name" class="ed" itemname="클럽이름" required size="55" onchange="fcbopen.cb_name_enabled.value='';">
      <a href="javascript:cb_name_check();"><img src="<?=$nc[member_skin_path]?>/img/btn_double_check.gif" alt="중복확인" width="80" height="20" border="0" align="absmiddle"></a>
      <br>※ 등록한 클럽 이름은 6개월간 변경할 수 없습니다.
      </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu"><strong>클럽 분류</strong></td>
    <td colspan="2" style="padding:5px 0px 5px 10px;"><select name="cc_id" itemname="클럽분류" required id="cc_id">
        <option value="">▼ 분류 선택 ==</option>
    <? for ($i=0; $row=mysql_fetch_array($result); $i++) { ?>
    	<option value="<?=$row[cc_id]?>"><?=$row[cc_name]?></option>
    <? } ?>
      </select></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu"><strong>클럽 성격</strong></td>
    <td colspan="2" style="padding:5px 0px 5px 10px;"><input name="cb_type" type="radio" value="1" checked>
      공개 클럽 : 가입신청시 자동 가입, 검색 가능<br>
      <input name="cb_type" type="radio" value="2">
      승인 클럽 : 클럽매니져의 승인 후 가입, 검색 가능<br>
      <input name="cb_type" type="radio" value="3">
      비밀 클럽 : 초대에 의해서만 가입, 검색 불가능</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu"><strong>검색 키워드</strong></td>
    <td width="" style="padding:5px 0px 5px 10px;" colspan="2"><input type="text" name="cb_keyword" id="cb_keyword" class="ed" style="width:100%; ">
    * 클럽 검색을 위한 키워드, 각 키워드는 콤마(,)로 구분
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu"><strong>클럽 설명</strong></td>
    <td width="" style="padding:5px 0px 5px 10px;" colspan="2">
    <textarea name="cb_content" rows="5" id="cb_content" class="tx" itemname="클럽설명" required style="width:100%;"></textarea>
    * 120자 이내, HTML TAG 사용 불가
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td colspan="3" align="Center" style="padding:15px 0px 5px 10px;"><strong>클럽 이용 약관</strong></td>
  </tr>
  <tr>
    <td  colspan="3" style="padding:5px 0px 5px 10px;"><textarea name="" rows="10" id="cb_content" readonly style="width:100%;"><?=$nc[nf_clause]?></textarea></td>
  </tr>
  <tr>
    <td align="center" colspan="3" style="padding:5px 0px 5px 10px;"><input type="checkbox" name="agree" id="agree" value="1"><label for=agree>약관의 내용을 모두 읽어 보았고 모든 내용에 동의합니다.</label></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td height="20" colspan="3"></td>
  </tr>
  <tr align="right">
    <td height="30" bgcolor="#F7F7F7" colspan="3" align="center"><input type="image" src="<?=$nc[member_skin_path]?>/img/btn_cbmake_ok.gif" width="90" height="25" border="0"></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</form>
</table>

<script language="JavaScript" type="text/JavaScript">
    var f = document.fcbopen;
	
	// 클럽아이디 검사
	function cb_id_check()
	{
	    if (f.cb_id.value == "") {
	        alert("클럽 아이디를 입력하세요.");
	        f.cb_id.focus();
	        return;
	    }

     if (f.cb_id.value.length > 17 ) {
            alert('클럽 아이디는 17자 이상 입력할 수 없습니다.');
            f.cb_id.focus();
            return;
     }
	
	    var id = prohibit_id_check(f.cb_id.value);
	    if (id) {
	        alert("'"+id + "'은(는) 사용하실 수 없는 클럽아이디입니다.");
	        f.cb_id.focus();
	        return;
	    }
	
	    win_open("./club_id_check.php?w=cb_id&cb_id="+f.cb_id.value, "hiddenframe");
	}
	
	// 클럽 이름 검사
	function cb_name_check()
	{
	    if (f.cb_name.value == "") {
	        alert("클럽 이름을 입력하세요.");
	        f.cb_name.focus();
	        return;
	    }
	    
	    var id = prohibit_id_check(f.cb_name.value);
	    if (id) {
	        alert("'"+id + "'은(는) 사용하실 수 없는 클럽명입니다.");
	        f.cb_name.focus();
	        return;
	    }
	
	    win_open("./club_id_check.php?w=cb_name&cb_name="+f.cb_name.value, "hiddenframe");
	    //win_open("./club_id_check.php?w=cb_name&cb_id="+f.cb_id.value+"&cb_name="+f.cb_name.value);
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
	
	function check_agree()
	{
      if (f.cb_id_enabled.value == "") {
          alert("클럽아이디 중복확인을 해주십시오.");
          f.cb_id.focus();
          return;
      }

      if (f.cb_name_enabled.value == "") {
          alert("클럽이름 중복확인을 해주십시오.");
          f.cb_name.focus();
          return;
      }
      
	    if (f.agree.checked != true) {
	        alert("이용약관에 동의 하여야 합니다.");
	        f.agree.focus();
	        return;
	    } else {
	        f.action = "./cb_open.update.php";
	        f.submit();
	    }
	}
</script>
