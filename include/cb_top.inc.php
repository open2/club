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
    <td class="<?=$boxstyle?>" style="padding:7px 10px 5px 10px">클럽매니저 : <?=view_member($cb[cb_manager])?> | 회원 : <span class="tahoma11"><?=$cb[cb_total_member]?></span> | 클럽포인트 : <span class="tahoma11"><?=number_format($cb[cb_point])?>P</span> | 개설일 : <span class="tahoma11"><?=date('Y. m. d', strtotime($cb[cb_opendate]))?></span></td>
    <td align="right" class="<?=$boxstyle?>" style="padding:8px 10px 5px 10px">
      <?

          $club_apply = 0;
          switch ($cb[cb_type]) {
              case 1 : // 공개클럽
                       if (!$cm[mb_id]) {
                          if ($cb[cb_join] == 'Y') 
                              $club_apply = 1;
                          else
                              echo "<b>(공개클럽)가입신청을 허용하지 않음</b>";
                       }
                       break;
              case 2 : // 승인후 가입클럽 - 이미 가입신청을 했는지 확인
                       if ($cm[mb_id]) {
                          if ($cm[member_join_wait])
                              echo "<b>클럽 가입승인 대기중</b>";
                       } else {
                              echo "<b>(승인클럽)관리자의 승인후 가입이 완료됩니다.</b>";
                              $club_apply = 1;
                       }
                       break;
              case 3 : // 비밀클럽
                       if (!$cm[mb_id]) {
                            if ($member[mb_id] && get_club_invite($cb[cb_id], $member[mb_id]))
                                $club_apply = 1;
                            else
                                echo "(비밀클럽)관리자의 초청에 의해서만 가입이 가능 합니다.";
                       }
                       break;
          }
      ?>

      <? if ($club_apply == "1") { ?>
          <a href="<?="./cb_mb_join.php?cb_id=$cb[cb_id]"?>" target="CLUB_BODY" class="<?=$boxstyle?>">클럽가입</a>
      <? } ?>

      <? if (($cm[mb_id] && $member[mb_id] != $cb[cb_manager]) || $cm[member_join_wait]) { ?>
          <a href="#" onClick="cm_secede();" class="<?=$boxstyle?>">클럽탈퇴</a>
      <? } ?>

      <? if ($cm[cm_level] < 0){ ?>
      회원정지중
      <? }?>

      <? if ($cb[cb_type] == "2" && $cm[mb_id] && $cm[cm_level] == "0") { ?>
          클럽가입신청중 입니다.
      <? } ?>
          
      <? if ($is_manager == "manager") { ?>
          <a href="<?="./club_manager.php?cb_id=$cb[cb_id]"?>" class="<?=$boxstyle?>">클럽관리</a>
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
    if (!confirm("클럽에서 탈퇴하시겠습니까?")) {
        return;
    } else {
        window.CLUB_BODY.location.href = "./cb_secede.php?cb_id=<?=$cb[cb_id]?>";
    }
}
</script>
