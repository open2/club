<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// 불당썸을 include 합니다.
if (!function_exists('thumbnail')) {
    include_once("$g4[path]/lib/thumb.lib.php");
}
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td width="100%" height="35" background="<?=$latest_skin_path?>/img/title_bg.gif"><a href="<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&sca=<?=$ca_name?>"><img src="<?=$latest_skin_path?>/img/title_text.gif" border="0"></a></td>
    <td width="37"><img src="<?=$latest_skin_path?>/img/title_link.gif"></td>
</tr>
<tr>
	<td colspan="2" height="12" background="<?=$latest_skin_path?>/img/line2.gif"></td>
</tr>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<colgroup><col width="160px" /><col /><col width="75px" /></colgroup>
<? for ($i=0; $i<count($list); $i++) { ?>
<tr>
	<td valign="middle"><div style="position:relative; left:0px; top:0px;">		
	<?            
		echo "<a href='{$list[$i]['wr_link1']}' target='_top'>"; 
        $image = urlencode($list[$i][file][0][file]); // 첫번째 파일이 이미지라면 
        if (preg_match("/\.(gif|jpg|png)$/i", $image)) {
            $img = thumbnail($g4[path] . "/data/file/" . $board[bo_table] . "/". $image, 150, 45, 0, 1, 90);
			      echo "<img src='$img' style='border:#DDDDDD solid 1px'></a>"; // 이미지크기 
        } else 
			      echo "<img src='$latest_skin_path/img/noimage.gif' width='150' height='45' style='border:#DDDDDD solid 1px'></a>"; 
	?></div>
	</td>
	<td>
		<span style="font: 12px 돋움; color:#5B5B5B;"><?=$list[$i][subject]?></span><br />
		<span class="tahoma11"><a href='<?=$list[$i]['wr_link1']?>' target="_top"><?=$list[$i]['wr_link1']?></a></span></td>
	<td align="center"><a href='<?=$list[$i]['wr_link1']?>' target="_top"><img src='<?=$latest_skin_path?>/img/go_club.gif' align="absmiddle" border="0"></a></td>			
</tr>
<tr>
	<td colspan="3" style="height:13px; background:url('<?=$latest_skin_path?>/img/line.gif');"></td>
</tr>
<? } ?>
<? if (count($list) == 0) { ?><tr><td colspan="3" align="center" height="50"><span style="font: 12px 돋움; color:#5B5B5B;">게시물이 없습니다.</a></span></td></tr><? } ?>
</table>
