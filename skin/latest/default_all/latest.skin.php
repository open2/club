<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup><col width="35px" /><col /><col width="52px" /></colgroup>
<tr>
	<td><img src="<?=$latest_skin_path?>/img/latest_t01.gif" /></td>
	<td background="<?=$latest_skin_path?>/img/bg_top.gif" valign="middle"><strong><a href='<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&sca=<?=$ca_name?>'><?=$board[bo_subject]?> - 전체글보기</a></strong></td>
	<td background="<?=$latest_skin_path?>/img/latest_t02.gif"><a href='<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&sca=<?=$ca_name?>'><img src="<?=$latest_skin_path?>/img/more.gif" border="0" /></a></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup><col width="10px" /><col /><col width="10px" /></colgroup>
<tr>
	<td background="<?=$latest_skin_path?>/img/bg_left.gif"></td>
	<td style="padding-top:5px;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<colgroup><col /><col width="100px" /><col width="30px" /><col width="50px" /></colgroup>
	<? for ($i=0; $i<count($list); $i++) { ?>
	<tr style="height:27px;">
		<td>
		<?
        echo $list[$i]['icon_reply'] . " ";
        echo "<a href='{$list[$i][ca_name_href]}'>[{$list[$i]['ca_name']}]</a> <a href='{$list[$i]['href']}'>";
        if ($list[$i]['is_notice'])
			echo "<spna style='font:12px 돋움; color:#5B5B5B;'><strong>{$list[$i]['subject']}</strong></span>";
        else
			echo "<span style='font:12px 돋움; color:#5B5B5B;'>{$list[$i]['subject']}</span></a>";

        if ($list[$i]['comment_cnt']) 
			echo " <a href=\"{$list[$i]['comment_href']}\"><span style='font: 11px 돋움; color:#FF6600;'>{$list[$i]['comment_cnt']}</span></a>";

        echo " " . $list[$i]['icon_new'];
        echo " " . $list[$i]['icon_secret'];
        ?>
		</td>
		<td style="font:11px 돋움; color:#5B5B5B;"><?=$list[$i][name]?></td>
		<td style="font:11px 돋움; color:#BABABA; text-align:center;"><?=$list[$i][wr_hit]?></td>
		<td style="font:11px 돋움; color:#BABABA; text-align:center;"><?=$list[$i][datetime2]?></td>
	</tr>
	<tr><td colspan="4" height="1" bgcolor="#EEEEEE"><td></tr>
	<? } ?>
	<? if (count($list) == 0) { ?><div style="width:100%; text-align:center;"><span style='font: 12px 돋움; color:#5B5B5B;'><br/ >게시물이 없습니다.<br /><br /></span><? } ?>
	</table>
	</td>
	<td background="<?=$latest_skin_path?>/img/bg_right.gif"></td>
</tr>
<tr>
	<td><img src="<?=$latest_skin_path?>/img/latest_b01.gif" /></td>
	<td background="<?=$latest_skin_path?>/img/bg_bottom.gif"></td>
	<td><img src="<?=$latest_skin_path?>/img/latest_b02.gif" /></td>
</tr>
</table>
