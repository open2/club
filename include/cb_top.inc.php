<?
$club_url = $nc[cb_url_path]. "/club_main.php?cb_id=". strip_cb_id($cb_id);
?>
<a name="cb_top"></a>

<? include_once "$nc[member_skin_path]/cb_club_top.skin.php"; ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" background="<?=get_background($cb[cb_top_img])?>" style="<?=get_background($cb[cb_top_style])?>">
  <tr>
    <? if ($cb[cb_top_method]==2) { ?>
      <? if ($cb[cb_title_color_skin]) { ?>
      <td height="<?=$nc[title_img_height]?>" style="padding:0px 0px 0px 10px" >
      <a href="<?=$nc[cb_path]?>/club_main.php?cb_id=<?=strip_cb_id($cb[cb_id])?>" class="title" style="color:<?=$cb[cb_title_color_skin]?>;"><?=$cb[cb_name]?></a><br>
      <a href="<?=$nc[cb_path]?>/club_main.php?cb_id=<?=strip_cb_id($cb[cb_id])?>" class="tahoma11" style="text-decoration: underline; color:<?=$cb[cb_title_color_skin]?>;"><?=$club_url?></a>
      <? } else { ?>
      <td height="<?=$nc[title_img_height]?>" style="padding:0px 0px 0px 10px" onclick="location.replace('<?=$club_url?>');exit;">
      <? } ?>
    </td>
    <? } else { ?>
    <td height="<?=$nc[title_img_height]?>" style="padding:0px 0px 0px 10px">
      <a href="<?=$nc[cb_path]?>/club_main.php?cb_id=<?=strip_cb_id($cb[cb_id])?>" class="title" style="color:<?=$cb[cb_title_color_skin]?>;"><?=$cb[cb_name]?></a><br>
      <a href="<?=$nc[cb_path]?>/club_main.php?cb_id=<?=strip_cb_id($cb[cb_id])?>" class="tahoma11" style="text-decoration: underline; color:<?=$cb[cb_title_color_skin]?>;"><?=$club_url?></a>
    </td>
    <? } ?>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="2"></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="<?=$cb[cb_box_line_skin]?>">
  <tr>
    <td class="<?=$boxstyle?>" style="padding:7px 10px 5px 10px">Ŭ���Ŵ��� : <?=view_member($cb[cb_manager])?> | ȸ�� : <span class="tahoma11"><?=$cb[cb_total_member]?></span> | Ŭ������Ʈ : <span class="tahoma11"><?=number_format($cb[cb_point])?>P</span> | ������ : <span class="tahoma11"><?=date('Y. m. d', strtotime($cb[cb_opendate]))?></span></td>
    <td align="right" class="<?=$boxstyle?>" style="padding:8px 10px 5px 10px">
      <?

          $club_apply = 0;
          switch ($cb[cb_type]) {
              case 1 : // ����Ŭ��
                       if (!$cm[mb_id]) {
                          if ($cb[cb_join] == 'Y') 
                              $club_apply = 1;
                          else
                              echo "<b>(����Ŭ��)���Խ�û�� ������� ����</b>";
                       }
                       break;
              case 2 : // ������ ����Ŭ�� - �̹� ���Խ�û�� �ߴ��� Ȯ��
                       if ($cm[mb_id]) {
                          if ($cm[member_join_wait])
                              echo "<b>Ŭ�� ���Խ��� �����</b>";
                       } else {
                              echo "<b>(����Ŭ��)�������� ������ ������ �Ϸ�˴ϴ�.</b>";
                              $club_apply = 1;
                       }
                       break;
              case 3 : // ���Ŭ��
                       if (!$cm[mb_id]) {
                            if ($member[mb_id] && get_club_invite($cb[cb_id], $member[mb_id]))
                                $club_apply = 1;
                            else
                                echo "(���Ŭ��)�������� ��û�� ���ؼ��� ������ ���� �մϴ�.";
                       }
                       break;
          }
      ?>

      <? if ($club_apply == "1") { ?>
          <a href="<?="./cb_mb_join.php?cb_id=$cb[cb_id]"?>" target="CLUB_BODY" class="<?=$boxstyle?>">Ŭ������</a>
      <? } ?>

      <? if (($cm[mb_id] && $member[mb_id] != $cb[cb_manager]) || $cm[member_join_wait]) { ?>
          <a href="#" onClick="cm_secede();" class="<?=$boxstyle?>">Ŭ��Ż��</a>
      <? } ?>

      <? if ($cm[cm_level] < 0){ ?>
      ȸ��������
      <? }?>

      <? if ($cb[cb_type] == "2" && $cm[mb_id] && $cm[cm_level] == "0") { ?>
          Ŭ�����Խ�û�� �Դϴ�.
      <? } ?>
          
      <? if ($is_manager == "manager") { ?>
          <a href="<?="./club_manager.php?cb_id=$cb[cb_id]"?>" class="<?=$boxstyle?>">Ŭ������</a>
      <? } ?>
      </td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="5"></td>
  </tr>
</table>

<script type="text/javascript"> 
function cm_secede()
{
    if (!confirm("Ŭ������ Ż���Ͻðڽ��ϱ�?")) {
        return;
    } else {
        window.CLUB_BODY.location.href = "./cb_secede.php?cb_id=<?=$cb[cb_id]?>";
    }
}
</script>
