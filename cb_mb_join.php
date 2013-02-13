<?
include_once "./_common.php";

// 클럽이 존재하지 않거나 $cb_id가 없을경우
if (!$cb[cb_id]) {
    error_msg("해당 클럽이 존재하지 않습니다.", "$nc[cb_url_path]/club_index.php");
}

if (!$member[mb_id]) {
    error_msg("로그인후에 이용하세요", "$nc[cb_url_path]/bbs/login.php?cb_id=$cb[cb_id]", 1);
}

if ($cb[cb_join] == "N") {
    error_msg("현재 클럽에서 회원 가입을 받지 않습니다.");
}

if ($cm[mb_id]) {
    error_msg("이미 클럽 회원으로 등록되어 있습니다.");
}

if ($cb[cb_state] == 3 && !$is_admin && !$cm[mb_id]) {
    error_msg("폐쇄된 클럽입니다.", $nc[cb_url_path]);
}

// 가입조건에 성별이 있는지 확인
if ($config[cf_use_sex] && $cb[cb_join_sex] !== "") {
    if ($cb[cb_join_sex] !== $member[mb_sex]) {
        if ($cb[cb_join_sex] == "M")
            error_msg("클럽은 아빠/삼촌(남)만 가입이 가능한 클럽입니다.");
        else
            error_msg("클럽은 엄마/이모(여)만 가입이 가능한 클럽입니다.");
    }
}

// 승인을 통해서 가입하는 클럽의 경우 이미 가입신청을 했는지 확인
if ($cb[cb_type] == 2) { 
    $sql = " select count(*) as cnt from $nc[member_table] where cb_id = '$cb[cb_id]' and mb_id = '$member[mb_id]' ";
    $result = sql_fetch($sql);
    if ($result[cnt] > 0) 
        alert("이미 가입신청을 하셨습니다.");
}

// 비밀클럽인 경우, 관리자의 초청이 있는지 확인
if ($cb[cb_type] == 3) {
    if (!get_club_invite($cb[cb_id], $member[mb_id]))
        alert("초청에 의해서만 가입이 가능 합니다.");
}

$g4[title] = "$cb[cb_name]:클럽가입 - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>클럽 회원 가입</strong></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<form name="fcbmbjoin" method="post" action="./cb_mb_join.update.php">
<input type="hidden" name="cb_id" value="<?=$cb[cb_id]?>">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="3" colspan="2" bgcolor="#CCCCCC"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="listsub">클럽 소개글</td>
    <td class="list"><?=conv_content($cb[cb_content], 0)?></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#EEEEEE"></td>
  </tr>
  <? if ($nc[nf_point_use] == 3) { ?>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="listsub">가입 포인트</td>
    <td class="list">
    회원가입시 <?=number_format($cb[cb_join_point])?> 포인트를 클럽에 기부 하게 됩니다.
    </td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#EEEEEE"></td>
  </tr>
  <? } ?>
  <?
    if ($cb[cb_ask_use] == "Y") {
        $ask = explode("|", $cb[cb_ask_body]);
    }
    if ($ask[0]) {
        $i = 1;
        foreach ($ask as $value) {
            if ($value != "") {
  ?>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="listsub">질문 <?=$i?>. </td>
    <td class="list"><?=$value?></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="listsub">답변 <?=$i?>. </td>
    <td class="list"><input name="reply[]" type="text" id="reply[]" size="60" class="ed" itemname="질문<?=$i?>" required></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#EEEEEE"></td>
  </tr>
  <?
            }
        $i++;
        }
    }
  ?>
  <tr bgcolor="#CCCCCC">
    <td height="1" colspan="2"></td>
  </tr>
  <tr align="right">
    <td style="padding:15px 10px 5px 10px;" colspan="2"><input name="imageField" type="image" src="images/btn_confirm.gif" width="90" height="21" border="0"></td>
  </tr>
</table>
</form>
<br><br><br><br><br><br>

<?
include_once "$nc[cb_path]/tail.sub.php";
?>
