<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
// 불당썸을 include 합니다.
if (!function_exists('thumbnail')) {
    include_once("$g4[path]/lib/thumb.lib.php");
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup><col width="35px" /><col /><col width="52px" /></colgroup>
<tr>
	<td><img src="<?=$latest_skin_path?>/img/latest_t01.gif" /></td>
	<td background="<?=$latest_skin_path?>/img/bg_top.gif" valign="middle"><strong><a href='<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&sca=<?=$ca_name?>'><?=$board[bo_subject]?></a></strong></td>
	<td background="<?=$latest_skin_path?>/img/latest_t02.gif"><a href='<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&sca=<?=$ca_name?>'><img src="<?=$latest_skin_path?>/img/more.gif" border="0" /></a></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup><col width="10px" /><col /><col width="10px" /></colgroup>
<tr>
	<td background="<?=$latest_skin_path?>/img/bg_left.gif"></td>
	<td style="padding-top:7px; padding-bottom:7px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
	<? for ($i=0; $i<count($list); $i++) { ?>
		<td valign='top' align='center'>
		<?
    	echo "<a href='{$list[$i]['href']}' target='_top'>"; 
        $image = urlencode($list[$i][file][0][file]); // 첫번째 파일이 이미지라면 
        if (preg_match("/\.(gif|jpg|png)$/i", $image)) { 
	        $img = thumbnail($g4[path] . "/data/file/" . $board[bo_table] . "/". $image, 120, 100, 0, 1, 90);
      		echo "<img src='$img' style='border:0; vertical-align:bottom;'></a>";
        } else 
		    echo "<img src='$latest_skin_path/img/noimage.gif' width='120' height='100' style='border:0; vertical-align:bottom;'></a>"; 
		?></td>
	<?}	?>		
	<? if (count($list) == 0) { ?><div style="width:100%; text-align:center;"><font style='span: 12px 돋움; color:#5B5B5B;'><br/ >게시물이 없습니다.<br /></span><? } ?>
	</tr>
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
