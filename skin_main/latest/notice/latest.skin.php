<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<table width="180" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="10"><img src="<?=$latest_skin_path?>/img/latest_t01.gif" /></td>
	<td width="125" background="<?=$latest_skin_path?>/img/bg_top.gif"><span style="font:bold 12px 돋움; color:#FFFFFF;"><?=$latest_title?></span></td>
	<td width="45" background="<?=$latest_skin_path?>/img/latest_t02.gif"><? if ($more_url) { ?><a href="<?=$more_url?>"><img src="<?=$latest_skin_path?>/img/more.gif" border="0" /></a><? } ?></td>
</tr>
</table>
<table width="180" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="10" background="<?=$latest_skin_path?>/img/bg_left.gif"></td>
	<td width="160" height="70" valign=top nowarp="nowrap" >
	<div>
	<? for ($i=0; $i<count($list); $i++) { ?>
	  <nobr style="display:block; overflow:hidden;">
		<div style="width:160px; padding-bottom:6px;overflow: hidden; text-overflow: ellipsis;">
			<?
				echo $list[$i]['icon_reply'] . " ";
	          $link = $list[$i]['href'];
		        $link = str_replace("&", "&amp;", "$link");
			    echo "<a href='$link'>";
				//if($list[$i]['ca_name']) echo "[".$list[$i]['ca_name']."] ";
	            if ($list[$i]['is_notice'])
		            echo "<span style='font:bold 12px 돋움; color:#5B5B5B;'>{$list[$i]['subject']}</span>";
			    else
					echo "<span style='font: 12px 돋움; color:#5B5B5B; letter-spacing:-1px;'>{$list[$i]['subject']}</span>";
				  echo "</a>";
	
		        if ($list[$i]['comment_cnt']) {
			        $link = $list[$i]['comment_href'];
				    $link = str_replace("&", "&amp;", "$link");
					echo " <a class='tahoma9' href=\"$link\">{$list[$i]['comment_cnt']}</a>";
	            }
    		  echo " " . $list[$i]['icon_new'];
			?>
		</div>
		</nobr>
	<? } ?>
	<? if (count($list) == 0) { ?><div style="width:160px;height:70px;"><font style='font: 12px 돋움; color:#5B5B5B;'>게시물이 없습니다.</font><? } ?>
	</div>
	</td>
	<td width="10" background="<?=$latest_skin_path?>/img/bg_right.gif"></td>
</tr>
<tr>
	<td colspan="3"><img src="<?=$latest_skin_path?>/img/bg_bottom.gif" border="0" width="180" height="9" /></td>
</tr>
</table>
