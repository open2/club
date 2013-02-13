<!-- 클럽 메인의 좌측 로그인박스 밑에 -->
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
		<td height="21"><a href="./club_index.php?doc=cb_myclub_list.php">마이클럽</a></td>
	</tr>
	<? } ?>
	<tr>
		<td height="21"><a href="./club_index.php?doc=<?=urlencode("cb_list.php?cb_recommend=Y")?>">추천클럽</a></td>
	</tr>
	<tr>
		<td height="21"><a href="<?=get_random_club_url()?>">랜덤클럽</a></td>
	</tr>
	<tr>
		<td height="21"><a href="./club_index.php?doc=<?=urlencode("cb_list.php?ssort=cb_total_member&sorder=desc&rank=1")?>">클럽랭킹(회원수)</a></td>
	</tr>
	<tr>
		<td height="21"><a href="./club_index.php?doc=<?=urlencode("cb_list.php?ssort=cb_point&sorder=desc&rank=1")?>">클럽랭킹(포인트)</a></td>
	</tr>
	<tr>
		<td height="21"><a href="./club_index.php?doc=<?=urlencode("cb_list.php?cb_recommend=N&ssort=cb_regdate")?>">전체클럽</a></td>
	</tr>
	<tr>
		<td height="21"><a href="./club_index.php?doc=<?=urlencode("bbs/search.php?srows=&gr_id=<?=$nc[gr_id]?>&sfl=wr_subject")?>">클럽게시글검색</a></td>
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
