<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("{$cb_id} Ŭ���� �������� �ʽ��ϴ�.");
}

$g4[title] = "$cb[cb_name]:���Ŭ�� ȸ���ʴ� - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";

$ss_id = 'club_invite_mb_id'; // ���� ���޹��� ��
?>
<form name=fmemoform method=post enctype='multipart/form-data' onsubmit="return fmemoform_submit(this);" >
<input type=hidden name=cb_id value="<?=$cb_id?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30"><strong>���Ŭ�� ȸ���ʴ�</strong></td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td height="30" colspan="7">
    ���Ŭ�� ���� ����<br><br>
    1. ���Ŭ���� ������ ������� Ŭ�� ���Կ�û message�� �߽�<br>
    2. ���Ŭ���� ������ ����� Ŭ���� �ͼ� ���Ը޴��� click<br>
    </td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">Ŭ���� ������ ȸ��
    <input type="text" name="<?=$ss_id?>" id="<?=$ss_id?>" required="required" itemname="������ ȸ�����̵�" value="" style="width:200px;" />
    <a href="javascript:popup_id('fmemoform','<?=$ss_id?>',200,500);">ȸ���˻�</a>
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
                and history_notice = '���Ŭ�������ʴ�'
        ";
$result = sql_query($sql);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan=4><strong>�ʴ������� �̰����� ȸ�����</strong></td>
  </tr>
  <tr>
    <td height="2"></td>
  </tr>
  <tr>
    <td width=120>no.</td>
    <td width=180>�ʴ���ȸ��</td>
    <td width=180>�ʴ�����</td>
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
      $s_del = "<a href=\"javascript:post_delete('cm_club_invite.update.php', '$mb_id');\">�ʴ����</a>";

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
<!-- // ȸ��ID ã��  
function popup_id(frm_name, ss_id, top, left) 
{ 
    url = './cb_write_id.php?frm_name='+frm_name+'&ss_id='+ss_id; 
    opt = 'scrollbars=yes,width=320,height=470,top='+top+',left='+left; 
    window.open(url, "write_id", opt); 
} 
//--> 
</script> 

<script>
// POST ������� ����
function post_delete(action_url, val)
{
	var f = document.fpost;

	if(confirm("�ѹ� ������ �ڷ�� ������ ����� �����ϴ�.\n\n���� �����Ͻðڽ��ϱ�?")) {
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
