<!-- Ŭ�� ������ ���� �α��ιڽ� �ؿ� -->
<table width="180" border="0" cellspacing="0" cellpadding="0">
<colgroup><col width="10px" /><col /><col width="10px" /></colgroup>
<tr>
	<td height="33"><img src="<?=$nc[member_skin_path]?>/img/box1_t01.gif"></td>
	<td valign="top" background="<?=$nc[member_skin_path]?>/img/box1_tbg.gif"><img src="<?=$nc[member_skin_path]?>/img/title_cbmenu.gif"></td>
	<td><img src="<?=$nc[member_skin_path]?>/img/box1_t02.gif" border="0"></a></td>
</tr>
<tr>
	<td background="<?=$nc[member_skin_path]?>/img/box1_lbg.gif"></td>
	<td><table border="0" cellpadding="0" cellspacing="0" width="100%">
	<? if ($member[mb_id]) { ?>
	<tr>
		<td height="21"><a href="./club_index.php?doc=cb_myclub_list.php">����Ŭ��</a></td>
	</tr>
	<? } ?>
	<tr>
		<td height="21"><a href="./club_index.php?doc=<?=urlencode("cb_list.php?cb_recommend=Y")?>">��õŬ��</a></td>
	</tr>
	<tr>
		<td height="21"><a href="<?=get_random_club_url()?>">����Ŭ��</a></td>
	</tr>
	<tr>
		<td height="21"><a href="./club_index.php?doc=<?=urlencode("cb_list.php?ssort=cb_total_member&sorder=desc&rank=1")?>">Ŭ����ŷ(ȸ����)</a></td>
	</tr>
	<tr>
		<td height="21"><a href="./club_index.php?doc=<?=urlencode("cb_list.php?ssort=cb_point&sorder=desc&rank=1")?>">Ŭ����ŷ(����Ʈ)</a></td>
	</tr>
	<tr>
		<td height="21"><a href="./club_index.php?doc=<?=urlencode("cb_list.php?cb_recommend=N&ssort=cb_regdate")?>">��üŬ��</a></td>
	</tr>
	<tr>
		<td height="21"><a href="./club_index.php?doc=<?=urlencode("bbs/search.php?srows=&gr_id=<?=$nc[gr_id]?>&sfl=wr_subject")?>">Ŭ���Խñ۰˻�</a></td>
	</tr>
	</table></td>
	<td background="<?=$nc[member_skin_path]?>/img/box1_rbg.gif"></td>
</tr>
<tr>
	<td><img src="<?=$nc[member_skin_path]?>/img/box1_b01.gif"></td>
	<td background="<?=$nc[member_skin_path]?>/img/box1_bbg.gif"></td>
	<td><img src="<?=$nc[member_skin_path]?>/img/box1_b02.gif"></td>
</tr>
</table>
