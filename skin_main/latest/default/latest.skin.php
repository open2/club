<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup><col width="10px" /><col /><col width="45px" /></colgroup>
<tr>
	<td><img src="<?=$latest_skin_path?>/img/latest_t01.gif" /></td>
	<td background="<?=$latest_skin_path?>/img/bg_top.gif"><img src='<?=$latest_skin_path?>/img/icon_title.gif' align="absmiddle" border="0"><span style="font:bold 12px 돋움; color:#383D41;"><?=$latest_title?></span></td>
	<td background="<?=$latest_skin_path?>/img/latest_t02.gif"><? if ($more_url) { ?><a href="<?=$more_url?>"><img src="<?=$latest_skin_path?>/img/more.gif" border="0" /></a><? } ?></td>
</tr>
</table>
<table width="200" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;">
<colgroup><col width="10px" /><col /></colgroup>
<tr>
	<td background="<?=$latest_skin_path?>/img/bg_left.gif"></td>
	<td valign="top" style="background:url('<?=$latest_skin_path?>/img/bg_right.gif') repeat-y right;" nowarp="nowrap">
	<? for ($i=0; $i<count($list); $i++) { ?>
	<nobr style="display:block; overflow:hidden;">
	<span style="width:100%; overflow: hidden; text-overflow: ellipsis; height:18px; margin-right:6px; line-height:18px;">
		<?
			echo $list[$i]['icon_reply'] . " ";
	        $link = $list[$i]['href'];
	        $link = str_replace("&", "&amp;", "$link");
		    echo "<a href='$link'>";
			  //if($list[$i]['ca_name']) echo "[".$list[$i]['ca_name']."] ";
		    if ($list[$i]['is_notice'])
	            echo "<span style='font:bold 12px 돋움; color:#5B5B5B;'>{$list[$i]['subject']}</span>";
		    else
				echo "<span style='font: 12px 돋움; color:#5B5B5B;'>{$list[$i]['subject']}</span>";
			    echo "</a>";

	        if ($list[$i]['comment_cnt']) {
			$link = $list[$i]['comment_href'];
			$link = str_replace("&", "&amp;", "$link");
				echo " <a class='tahoma9' href=\"$link\">{$list[$i]['comment_cnt']}</a>";
	        }
				echo " " . $list[$i]['icon_new'];
		?>
		</span>
	</nobr>
	<? } ?>
	<? if (count($list) == 0) { ?><div style="width:100%; height:70px;"><span style='font: 12px 돋움; color:#5B5B5B;'>게시물이 없습니다.</span></div><? } ?>	
	</td>
</tr>
<tr>
	<td><img src="<?=$latest_skin_path?>/img/latest_b01.gif" /></td>
	<td style="background:url('<?=$latest_skin_path?>/img/latest_b02.gif') repeat-y right;"></td>
</tr>
</table>
