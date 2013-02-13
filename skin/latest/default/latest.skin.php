<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup><col width="35px" /><col /><col width="45px" /></colgroup>
<tr>
	<td><img src="<?=$latest_skin_path?>/img/latest_t01.gif" /></td>
	<td background="<?=$latest_skin_path?>/img/bg_top.gif" valign="middle"><span style="font:bold 12px 돋움; color:#FFFFFF;"><a href='<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&sca=<?=$ca_name?>'><?=$board[bo_subject]?></a></span></td>
	<td background="<?=$latest_skin_path?>/img/latest_t02.gif"><a href='<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&sca=<?=$ca_name?>'><img src="<?=$latest_skin_path?>/img/more.gif" border="0" /></a></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup><col width="10px" /><col /><col width="10px" /></colgroup>
<tr>
	<td background="<?=$latest_skin_path?>/img/bg_left.gif"></td>
	<td height="127" valign="top">
	<div style="position:relative; left:0px; top:10px;">
	<? for ($i=0; $i<count($list); $i++) { ?>
		<div style="width:100%; padding:0 0 8px 6px; background:url(<?=$latest_skin_path?>/img/dot.gif) no-repeat 0 6px; vertical-align:top;">
            <?
            echo $list[$i]['icon_reply'] . " ";
            echo "<a href='{$list[$i]['href']}'>";
            if ($list[$i]['is_notice'])
                echo "<font style='font:bold 12px 돋움; color:#5B5B5B; letter-spacing:-1px;'>{$list[$i]['subject']}</font>";
            else
                echo "<font style='font: 12px 돋움; color:#5B5B5B; letter-spacing:-1px;'>{$list[$i]['subject']}</font>";
            echo "</a>";

            if ($list[$i]['comment_cnt']) 
                echo " <a href=\"{$list[$i]['comment_href']}\"><span class='verdana10'>{$list[$i]['comment_cnt']}</span></a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            echo " " . $list[$i]['icon_new'];
            //echo " " . $list[$i]['icon_file'];
            //echo " " . $list[$i]['icon_link'];
            //echo " " . $list[$i]['icon_hot'];
            echo " " . $list[$i]['icon_secret'];
            ?>
		</div>	
	<? } ?>
	<? if (count($list) == 0) { ?><div style="width:100%; text-align:center;"><span style='font: 12px 돋움; color:#5B5B5B;'><br/ ><br />게시물이 없습니다.</span><? } ?>
	</div>
	</td>
	<td background="<?=$latest_skin_path?>/img/bg_right.gif"></td>
</tr>
<tr>
	<td><img src="<?=$latest_skin_path?>/img/latest_b01.gif" /></td>
	<td background="<?=$latest_skin_path?>/img/bg_bottom.gif"></td>
	<td><img src="<?=$latest_skin_path?>/img/latest_b02.gif" /></td>
</tr>
</table>
