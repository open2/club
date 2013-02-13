<?
include_once "./_common.php";

$g4[title] = "클럽이용약관 - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";
?>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td width="30"><img src="../images/box_list_t01.gif"></td>
		<td width="100%" background="../images/box_list_bg1.gif"><strong>클럽 이용 약관</strong></td>
		<td width="50"><img src="../images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="../images/box_list_bg2.gif"></td>
	</tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr><td height="25"></td></tr>
	<tr>
		<td>
		<?
		echo nl2br($nc[nf_clause]);
		?></td>
	</tr>
</table>
<?
echo "<br><br>";
include_once "$nc[cb_path]/tail.sub.php";
?>
