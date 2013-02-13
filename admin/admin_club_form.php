<?
include_once "./_common.php";

$g4[title] = "클럽관리";
include_once("$nc[cb_path]/head.sub.php");

$cb		= get_club($cb_id);
$cb_ask	= explode("|", $cb[cb_ask_body]);
?>
<br>
<form name="fcbform" method="post" action="javascript:check_form();">
<input type="hidden" name="exec"  value="update">
<input type="hidden" name="cb_id" value="<?=$cb[cb_id]?>">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#CCCCCC">
    <td height="3" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">클럽아이디</td>
    <td width="300" style="padding:5px 5px 5px 5px"><b><?=$cb[cb_id]?></b></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">클럽매니저</td>
    <td style="padding:5px 5px 5px 5px"><input name="cb_manager" type="text" id="cb_manager" itemname="클럽매니저" value=<?=$cb[cb_manager]?> required>
    <?
    $mb = get_member($cb[cb_manager]);
    echo get_sideview($mb[mb_id], $mb[mb_nick], $mb[mb_email]);
    ?>
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">클럽명</td>
    <td colspan="3" style="padding:5px 5px 5px 5px"><input name="cb_name" type="text" id="cb_name" itemname="클럽명" required style="width:60%;" value="<?=$cb[cb_name]?>"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">클럽분류</td>
    <td colspan="3" style="padding:5px 5px 5px 5px"><select name="cc_id" id="cc_id" value="$cb[cc_id]">
    	<?
    		$sql		= " select * from $nc[tbl_category] order by cc_idx asc ";
    		$result	= mysql_query($sql);
    		for ($i=0; $row=mysql_fetch_array($result); $i++) {
    				echo "<option value='$row[cc_id]'>$row[cc_name]</option>\n";
    		}
    	?>
      </select>
      <input type="hidden" name="tmp_cc_id" value="<?=$cb[cc_id]?>"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">클럽성격</td>
    <td colspan=3 style="padding:5px 5px 5px 5px"><input name="cb_type" type="radio" value="1" checked>
	      공개 클럽 : 가입신청시 자동 가입, 검색 가능<br>
	      <input name="cb_type" type="radio" value="2">
	      승인 클럽 : 클럽매니져의 승인 후 가입, 검색 가능<br>
	      <input name="cb_type" type="radio" value="3">
	      비밀 클럽 : 초대에 의해서만 가입, 검색 불가능</td>
	</tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="2"></td>
  </tr>
  <tr>	
    <td width="150" align="center" bgcolor="#f7f7f7">가입상태</td>
    <td colspan=3 style="padding:5px 5px 5px 5px"><input name="cb_join" type="radio" value="Y">
      가입허용<br>
      <input name="cb_join" type="radio" value="N">
      가입불가</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="2"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">클럽 가입 회원 등급</td>
    <td class="list" colspan="3" style="padding:5px 5px 5px 5px">
      <select name="cb_join_level" id="cb_join_level">
      <?=get_level_option($cb[cb_id])?>
      </select></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">운영상태</td>
    <td colspan="3" style="padding:5px 5px 5px 5px"><select name="cb_state">
    	<?
    	  $cso = Array("운영", "대기", "폐쇄", "개설대기");
    	  for ($k=0; $k<count($cso); $k++) {
    	      $j = $k + 1;
    	      echo "<option value='$j'>$cso[$k]</option>";
    	  }
    	?>
    	</select></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">클럽포인트</td>
    <td colspan="3" style="padding:5px 5px 5px 5px"><input name="cb_point" type="text" id="cb_point" style="width:60%;" value="<?=$cb[cb_point]?>">
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">가입질문사용</td>
    <td colspan="3" style="padding:5px 5px 5px 5px"><input name="cb_ask_use" type="radio" value="Y">
      사용
      <input name="cb_ask_use" type="radio" value="N">
      사용안함</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">가입질문</td>
    <td colspan="3" style="padding:5px 5px 5px 5px;"><table border="0" cellspacing="0" cellpadding="2">
			  <tr>
			    <td>1. 
			    	<input type="text" name="cb_ask[]" size="50"></td>
			  </tr>
			  <tr>
			    <td>2. 
			    	<input type="text" name="cb_ask[]" size="50"></td>
			  </tr>
			  <tr>
			    <td>3. 
			    	<input type="text" name="cb_ask[]" size="50"></td>
			  </tr>
			  <tr>
			    <td>4.
			    	<input type="text" name="cb_ask[]" size="50"></td>
			  </tr>
			  <tr>
			    <td>5.
			    	<input type="text" name="cb_ask[]" size="50"></td>
			  </tr>
			</table></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
	</span>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">클럽키워드</td>
    <td colspan="3" style="padding:5px 5px 5px 5px"><input name="cb_keyword" type="text" id="cb_keyword" style="width:60%;" value="<?=$cb[cb_keyword]?>">
    	* 각 키워드는 ','로 구분</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">클럽설명</td>
    <td colspan="3" style="padding:5px 5px 5px 5px"><textarea name="cb_content" rows="5" id="cb_content" itemname="클럽명" required style="width:60%;"><?=$cb[cb_content]?></textarea>
    	* 120자 이내,
    	* HTML TAG 사용 불가</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">개설일</td>
    <td style="padding:5px 5px 5px 5px"><?=$cb[cb_opendate]?></td>
  </tr>
  <tr>
    <td width="150" align="center" bgcolor="#f7f7f7">등록일</td>
    <td style="padding:5px 5px 5px 5px"><?=$cb[cb_regdate]?></td>
  </tr>
  <tr bgcolor="#cccccc">
    <td height="2" colspan="4"></td>
  </tr>
  <tr>
    <td height="30" colspan="4" align="center">
        <input type="submit" name="Submit" value=" 확    인 ">
        <a href="./club_admin.php?doc=admin_club_list.php" target=_parent>목  록</a>
    </td>
  </tr>
</table>
</form>

<script language="JavaScript" type="text/JavaScript">
	f = document.fcbform;
	f.cb_state.value	= "<?=$cb[cb_state]?>";
	f.cb_join_level.value = "<?=$cb[cb_join_level]?>";
	
	f.cb_type[<?=$cb[cb_type]-1?>].checked = true;
	<?
	if ($cb[cb_join] == "N") {
		echo "f.cb_join[1].checked = true;\n";
	} else {
		echo "f.cb_join[0].checked = true;\n";
	}
	
	if ($cb[cb_ask_use] == "N") {
		echo "f.cb_ask_use[1].checked = true;\n";
	} else {
		echo "f.cb_ask_use[0].checked = true;\n";
	}
	
	for ($k=0; $k<count($cb_ask)-1; $k++) {
		echo "f.elements['cb_ask[]'][$k].value = '$cb_ask[$k]';\n";
	}
	?>
	
	function check_form()
	{
		f = document.fcbform;
		if (f.cb_ask_use[0].checked == true) {
			for (i=0; i<5; i++) {
				if (f.elements['cb_ask[]'][i].value == "") {
						str = 1;
				} else {
						str = 0;
						break;
				}
			}
			
			if (str == 1) {
				alert ("가입질문을 입력하세요.");
				f.elements['cb_ask[]'][0].focus();
			} else {
				f.action = "./admin_club_form_update.php";
				f.submit();
			}
		} else {
			f.action = "./admin_club_form_update.php";
			f.submit();
		}
	}
</script>
<br><br><br><br>

<?
include_once("$nc[cb_path]/tail.sub.php");
?>
