<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="50" background="<?=$club_list_skin_path?>/img/title_bg.gif" style="padding-left:17px;"><a href="<?=$more_url?>" target="_top">
	<?
	if ($kind =='suggest'){ echo "<img src='$club_list_skin_path/img/t_suggest.gif' border='0'>";}
	if ($kind =='new'){ echo "<img src='$club_list_skin_path/img/t_new.gif' border='0'>";}
	if ($kind =='member'){ echo "<img src='$club_list_skin_path/img/t_member.gif' border='0'>";}
	if ($kind =='point'){ echo "<img src='$club_list_skin_path/img/t_point.gif' border='0'>";}
	if ($kind =='update'){ echo "<img src='$club_list_skin_path/img/t_rasing.gif' border='0'>";}
	if ($kind =='rand'){ echo "<img src='$club_list_skin_path/img/t_random.gif' border='0'>";}
	?></a></td>
</tr>
<tr>
	<td height="110" valign="top" bgcolor="#F8F9FA">
	<div style="position:relative; left:22px; top:0px;">
	<? for ($i=0; $i<$rows; $i++) { ?>
	<div style="width:100%; padding:3px 0 3px 0; vertical-align:middle;"><img src="<?=$club_list_skin_path?>/img/<?=$i+1?>.gif" align="absmiddle">
		<?
			echo "<a href='$nc[cb_path]/club_main.php?cb_id={$list[$i][cb_id]}' target=_top>";
			echo "<span style='font:normal 12px/1.5 돋움, Dotum; color:#5B5B5B;'>{$list[$i][cb_name]}</span></a> - <span style='font: 11px 돋움; color:#A2A2A2;'>{$list[$i][cc_name]}</span>";
		?>
	</div>
	<? } ?>
	</div>
	</td>
</tr>
<tr>
	<td height="15" background="<?=$club_list_skin_path?>/img/bg_bottom.gif"></td>
</tr>
</table>
