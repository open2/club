<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("{$cb_id} Ŭ���� �������� �ʽ��ϴ�.");
}

$g4[title] = "$cb[cb_name]:Ŭ���絵 - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";

$ss_id = 'club_transfer_mb_id'; // ���� ���޹��� ��
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>Ŭ�� �絵</strong></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<form name=fmemoform method=post enctype='multipart/form-data' onsubmit="return fmemoform_submit(this);" >
<input type=hidden name=cb_id value="<?=$cb_id?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td height="30" colspan="7">
    Ŭ�� �絵 ����<br><br>
    1. Ŭ���� �μ��� ������� Ŭ�� �絵�� ��û<br>
    2. Ŭ���� �μ��� ������� Ŭ�� �絵�� �ʿ��� url�� �˷��� (���� ������)<br>
    3. Ŭ���� �μ��� ����� Ŭ���μ� url�� click<br>
    </td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td height="30">
    ���� ����<br><br>
    1. Ŭ���� �絵�� ��û�� �μ��ڰ� �³��� �������� ����� �� �ֽ��ϴ�.<br>
    2. Ŭ���� �μ��� ���Ŀ��� Ŭ���� �������� �ٽ� ������ �� �����ϴ�.<br>
    </td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>

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

  <? 
  // �̹� �絵�� ��û�� ��쿡�� â�� ������ �ʰ�
  $cm_club_transfer = get_club_transfer($cb[cb_id]);
  if ($cm_club_transfer) {

      $mb = get_member($cm_club_transfer);
      $nick = get_sideview($mb[mb_id], $mb[mb_nick], $mb[mb_email], $mb[mb_homepage]);
      
      $s_del = "<a href=\"javascript:post_delete('cm_club_transfer.update.php', '$cm_club_transfer');\">Ŭ����������</a>";
  ?>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">
    Ŭ���� ������� �������Դϴ�.<br>
    Ŭ���� ������� <?=$nick?> �Կ��� ��û�Ͽ����ϴ�.<br>
    <br>
    ���� url�� ������� ȸ������ �˷��ֽø� �˴ϴ�.<br>
    <br>
    <?=$nc[cb_url_path]?>/cm_club_transfer.update.php?cb_id=<?=$cb_id?>&w=approve
    <br>
    <br>
    Ŭ���� ������� ����Ϸ��� ( <?=$s_del?> )�� �����ּ���.
    </td>
  </tr>
  <tr>
  <? } else { ?>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	<colgroup><col width="130px" /><col width="200px" /><col /></colgroup>
	<tr bgcolor="#f7f7f7">
      <td align="center" height="30"><strong>Ŭ���� �μ��� ȸ��</strong></td>
      <td align="center"><input type="text" name="<?=$ss_id?>" id="<?=$ss_id?>" required="required" itemname="�μ��� ȸ�����̵�" value="" class="ed" style="width:190px;" /></td>
      <td><a href="javascript:popup_id('fmemoform','<?=$ss_id?>',200,500);"><img src="<?=$nc[cb_path]?>/images/btn_smember.gif" width="80" height="21" border="0"></a></td>
	</tr>
	</table></td>
  </tr>
  <tr>
  <td style="padding:5px 10px 5px 10px;" align="right">
      <INPUT type=image src="<?=$nc[cb_path]?>/images/btn_confirm.gif" width="90" height="21" border="0" accesskey='s'> 
  </td>
  </tr>
  <? } ?>
</table>
</form>

<script language="JavaScript">
function fmemoform_submit(f) {

    f.action = "./cm_club_transfer.update.php";

    return true;
}
</script>

<script>
// POST ������� ����
function post_delete(action_url, val)
{
	var f = document.fpost;

	if(confirm("�ѹ� ������ �ڷ�� ������ ����� �����ϴ�.\n\n���� �����Ͻðڽ��ϱ�?")) {
    f.club_transfer_mb_id.value = val;
		f.action         = action_url;
		f.submit();
	}
}
</script>

<form name='fpost' method='post'>
<input type='hidden' name='cb_id' value='<?=$cb[cb_id]?>'>
<input type='hidden' name='w' value='cancel'>
<input type='hidden' name='club_transfer_mb_id'>
</form>

<?
include "$nc[cb_path]/tail.sub.php";
?>
