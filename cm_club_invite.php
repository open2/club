<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("{$cb_id} 클럽이 존재하지 않습니다.");
}

$g4[title] = "$cb[cb_name]:비밀클럽 회원초대 - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";

$ss_id = 'club_invite_mb_id'; // 값을 전달받을 곳
?>
<form name=fmemoform method=post enctype='multipart/form-data' onsubmit="return fmemoform_submit(this);" >
<input type=hidden name=cb_id value="<?=$cb_id?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30"><strong>비밀클럽 회원초대</strong></td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td height="30" colspan="7">
    비밀클럽 가입 절차<br><br>
    1. 비밀클럽에 가입할 사람에게 클럽 가입요청 message를 발신<br>
    2. 비밀클럽에 가입할 사람이 클럽에 와서 가입메뉴를 click<br>
    </td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">클럽에 가입할 회원
    <input type="text" name="<?=$ss_id?>" id="<?=$ss_id?>" required="required" itemname="가입할 회원아이디" value="" style="width:200px;" />
    <a href="javascript:popup_id('fmemoform','<?=$ss_id?>',200,500);">회원검색</a>
    </td>
  </tr>
  <tr>
  <td>
      <INPUT type=image src="<?=$nc[cb_path]?>/images/btn_ok_1.gif" border=0 accesskey='s'> 
  </td>
  </tr>
</table>
</form>

<br><br><br>
<?
$sql = " select * from $nc[cb_history_table] 
          where cb_id = '$cb_id' 
                and history_notice = '비밀클럽가입초대'
        ";
$result = sql_query($sql);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan=4><strong>초대했으나 미가입한 회원목록</strong></td>
  </tr>
  <tr>
    <td height="2"></td>
  </tr>
  <tr>
    <td width=120>no.</td>
    <td width=180>초대한회원</td>
    <td width=180>초대일자</td>
    <td align=left></td>
  <tr>
    <td height="2"></td>
  </tr>
  <?
  $i=0;
  while ($row = sql_fetch_array($result)) {
      $mb_id = $row[history_mb_id];
      $mb = get_member($mb_id);
      $nick = get_sideview($mb[mb_id], $mb[mb_nick], $mb[mb_email], $mb[mb_homepage]);
      $s_del = "<a href=\"javascript:post_delete('cm_club_invite.update.php', '$mb_id');\">초대취소</a>";

      $i++;
  ?>
  <tr>
    <td><?=$i?></td>
    <td><strong><?=$nick?></strong></td>
    <td><?=$row[history_datetime]?></td>
    <td align=left><?=$s_del?></td>
  </tr>
  <tr>
    <td height="2"></td>
  </tr>
  <?
  }
  ?>
</table>

<script language="JavaScript">
function fmemoform_submit(f) {

    f.action = "./cm_club_invite.update.php";

    return true;
}
</script>

<script type="text/javascript"> 
<!-- // 회원ID 찾기  
function popup_id(frm_name, ss_id, top, left) 
{ 
    url = './cb_write_id.php?frm_name='+frm_name+'&ss_id='+ss_id; 
    opt = 'scrollbars=yes,width=320,height=470,top='+top+',left='+left; 
    window.open(url, "write_id", opt); 
} 
//--> 
</script> 

<script>
// POST 방식으로 삭제
function post_delete(action_url, val)
{
	var f = document.fpost;

	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
    f.club_invite_mb_id.value = val;
		f.action         = action_url;
		f.submit();
	}
}
</script>

<form name='fpost' method='post'>
<input type='hidden' name='cb_id' value='<?=$cb[cb_id]?>'>
<input type='hidden' name='w' value='cancel'>
<input type='hidden' name='club_invite_mb_id'>
</form>

<?
include "$nc[cb_path]/tail.sub.php";
?>
