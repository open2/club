<?
include_once "./_common.php";

if (!$cb[cb_no]) {
    error_msg("해당 클럽이 존재하지 않습니다.", "$nc[cb_url_path]/club_index.php");
}

if ($cb[cb_state] == 4) {
    error_msg("개설 대기중인 클럽입니다.");
}

//if ($member[mb_id] != $cb[cb_manager]) {
if ($cm[cm_level] < 90) {
    error_msg("스텝권한 이상만 접근 가능합니다.");
}

if (!$doc) {
    $doc = "cm_default.php";
}
$doc .= "?doc=$doc&cb_id=$cb[cb_id]&page=$page";

$vs = get_count($cb[cb_id]);

$boxstyle = "boxtext";
if ($cb[cb_box_line_skin] == "#E2E2E2") {
    $boxstyle = "boxtext1";
}

$sql = " select count(*) from $nc[coverstory_table] where cb_id = '$cb[cb_id]' ";
$cs_total = sql_fetch_array(sql_query($sql));

$g4[title] = "$cb[cb_name]:클럽관리 - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";
?>

<body>
<table width="<?=$nc[nf_width]?>" border="0" align="<?=$nc[nf_align]?>" cellpadding="0" cellspacing="0">
  <tr>
    <td><? include_once "./include/cb_top.inc.php"; ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="180" height="100" align="center" valign="top">
            <?=cb_outlogin("club");?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5"></td>
              </tr>
            </table>
            <? include_once "./include/cb_defaultmenu.inc.php"; ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5"></td>
              </tr>
            </table>
            <? include_once "$nc[cb_path]/include/cb_managermenu.inc.php"; ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td align="center" class="verdana9">today <?=number_format($vs[today])?> | total <?=number_format($vs[total])?></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5"></td>
              </tr>
            </table></td>
          <td width="10" align="center" valign="top">&nbsp;</td>
          <td align="center" valign="top">
          <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" scrolling="no" src="<?=$doc?>" name="CLUB_BODY" id="CLUB_BODY" ALLOWTRANSPARENCY="true"></iframe>           </td>
        </tr>
      </table>
      <? include_once "./include/cb_bottom.inc.php"; ?></td>
  </tr>
</table>

<?
include_once "$nc[cb_path]/tail.sub.php";
?>
