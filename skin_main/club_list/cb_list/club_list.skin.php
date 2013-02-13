<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup><col width="29px" /><col /><col width="40px" /></colgroup>
<tr>
	<td>
	<?
		if ($kind =='suggest'){ echo "<img src='$club_list_skin_path/img/t_suggest.gif' border='0'>";}
		if ($kind =='new'){ echo "<img src='$club_list_skin_path/img/t_new.gif' border='0'>";}
		if ($kind =='member'){ echo "<img src='$club_list_skin_path/img/t_hot.gif' border='0'>";}
		if ($kind =='point'){ echo "<img src='$club_list_skin_path/img/t_hot.gif' border='0'>";}
		if ($kind =='update'){ echo "<img src='$club_list_skin_path/img/t_update.gif' border='0'>";}
		if ($kind =='rand'){ echo "<img src='$club_list_skin_path/img/t_random.gif' border='0'>";}
	?></td>
	<td background="<?=$club_list_skin_path?>/img/bg_top.gif"><span style="font:bold 12px 돋움; color:#FFFFFF;"><?=$latest_title?></span></td>
	<td background="<?=$club_list_skin_path?>/img/latest_t02.gif"><? if ($more_url) { ?><a href="<?=$more_url?>" target="_top"><img src="<?=$club_list_skin_path?>/img/more.gif" border="0" /></a><? } ?></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup><col width="10px" /><col /><col width="10px" /></colgroup>
<tr>
	<td background="<?=$club_list_skin_path?>/img/bg_left.gif"></td>
	<td height="70" valign="top" nowarp="nowrap" >
	<nobr style="display:block; overflow:hidden;">
	<div>
	<? for ($i=0; $i<count($list); $i++) { ?>
	<? $b = $i + 1; ?>
		<div style="width:100%; padding-bottom:5px;">
			<span class="verdana10"><strong><?= $b ?></strong></span>&nbsp;
            <?
            echo "<a href='$nc[cb_path]/club_main.php?cb_id=" . strip_cb_id($list[$i][cb_id]) . "' target=_top>";
            echo "<span style='font: 12px 돋움; color:#5B5B5B; letter-spacing:-1px;'>{$list[$i][cb_name]}</span>";
            echo "</a>";
            ?>
		</div>	
	<? } ?>
	<? if (count($list) == 0) { ?><div style="width:170px;"><span style='font: 12px 돋움; color:#5B5B5B;'>게시물이 없습니다.</span><? } ?>
	</div>
	</nobr>
	</td>
	<td background="<?=$club_list_skin_path?>/img/bg_right.gif"></td>
</tr>
<tr>
	<td><img src="<?=$club_list_skin_path?>/img/latest_b01.gif" /></td>
	<td background="<?=$club_list_skin_path?>/img/bg_bottom.gif"></td>
	<td><img src="<?=$club_list_skin_path?>/img/latest_b02.gif" /></td>
</tr>
</table>
