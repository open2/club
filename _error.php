<?
include_once "./_common.php";

$g4[title] = "확인 메세지 - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";

if ($url) {
    if ($target == "0" || $target == "") {
        $target = "";
    } else {
        $target = $target. ".";
    }
    $onclick = "onClick=\"window.{$target}location.href='$url';\"";
} else {
    $onclick = "onClick=\"history.back();\"";
}
?>
<br><br><br><br>
<table  border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td bgcolor="#eeeeee"><table  border="0" cellspacing="0" cellpadding="1">
        <tr>
          <td bgcolor="#CCCCCC"><table  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center" bgcolor="#FFFFFF" style="padding: 10px 10px 10px 10px;"><strong>확인 메세지</strong></td>
              </tr>
              <tr>
                <td width="400" align="center" valign="top" bgcolor="#FFFFFF" style="padding: 10px 10px 10px 10px;"><?=conv_content($msg, 0)?></td>
              </tr>
              <tr>
                <td align="center" bgcolor="#FFFFFF" style="padding: 10px 10px 10px 10px;"><a href="#" <?=$onclick?>><img src="./images/btn_ok_1.gif" width="41" height="21" border="0"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<br><br><br><br>

<?
include_once "$nc[cb_path]/tail.sub.php";
exit();
?>
