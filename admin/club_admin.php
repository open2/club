<?
include_once "./_common.php";

$g4[title] = "클럽 관리";
include_once "$nc[cb_path]/head.sub.php";

if (!$doc) {
	$doc = "./admin_club_list.php";
}
?>

<table align="<?=$nc[nf_align]?>" border="0" align="center" cellpadding="0" cellspacing="0" style='padding-left:5px;'>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            	<td><? include_once "$nc[member_skin_path]/cb_club_top.skin.php"; ?>
              </td>
          </tr>
      </table>

      <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#EEEEEE">
        <tr>
          <td style="padding:10px 10px 8px 10px"><strong><a href="./club_admin.php?doc=admin_config_form.php">환경설정</a></strong> |
            <strong><a href="./club_admin.php?doc=admin_club_list.php">클럽관리</a></strong> |
            <strong><a href="./club_admin.php?doc=admin_category_list.php">분류관리</a></strong> |
            <strong><a href="./club_admin.php?doc=admin_club_history.php">클럽 HISTORY</a></strong> |
            <strong><a href="./club_admin.php?doc=admin_upgrade.php">업그레이드</a></strong></td>
        </tr>
      </table>
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5"></td>
        </tr>
      </table>
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" scrolling="no" src="<?=$doc?>" name="CLUB_BODY" id="CLUB_BODY" onChange="resize_iframe();" ALLOWTRANSPARENCY="true"></iframe></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top-width: 1px; border-top-style: solid; border-top-color: #999999;">
        <tr>
          <td height="5"></td>
        </tr>
      </table>
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="50" align="center">
          <? include_once "$nc[cb_path]/include/cb_bottom.inc.php";?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>

<?
include_once("$nc[cb_path]/tail.sub.php");
?>
