<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

// �Ҵ���� include �մϴ�.
if (!function_exists('thumbnail')) {
    include_once("$g4[path]/lib/thumb.lib.php");
}
?>
<style type="text/css"> 
.box_left { border-top:1px solid #D3D3D3; border-left:1px solid #D3D3D3; border-bottom:1px solid #D3D3D3;}
.box_right { border-top:1px solid #D3D3D3; border-right:1px solid #D3D3D3; border-bottom:1px solid #D3D3D3; line-height:18px; padding:13px; vertical-align:top;}
.box_title_tr { text-align:right; background:url('<?=$latest_skin_path?>/img/title_bg.gif') repeat-x right; padding:0 10px 2px 0; vertical-align:bottom;}
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<colgroup><col width="250px" /><col /></colgroup>
<? for ($i=0; $i<count($list); $i++) { ?>
<tr>
	<td height="27" background='<?=$latest_skin_path?>/img/title.gif'></td>
	<td class="box_title_tr"><span class="tahoma11"><a href='<?=$list[$i]['wr_link1']?>' target="_top"><?=$list[$i]['wr_link1']?></a></span></td>
</tr>
<tr>
	<td class="box_left">
	    <?
    		echo "<a href='{$list[$i]['href']}' target='_top'>"; 
        $image = urlencode($list[$i][file][0][file]); // ù��° ������ �̹������ 
        if (preg_match("/\.(gif|jpg|png)$/i", $image)) { 
            $img = thumbnail($g4[path] . "/data/file/" . $board[bo_table] . "/". $image, 250, 150, 0, 1, 90);
      			echo "<img src='$img' style='border:0; vertical-align:bottom;'></a>"; // �̹���ũ�� 
        } else 
			      echo "<img src='$latest_skin_path/img/noimage.gif' width='250' height='150' style='border:0; vertical-align:bottom;'></a>"; 
		?>
	</td>
	<td class="box_right">
	<span style="font: 14px ����; color:#FF6600; letter-spacing:-1px;"><strong><?=$list[$i][subject]?></strong></span><br /><br />
	<?=nl2br(strip_tags(cut_str($list[$i][wr_content], 270, '...' )))?></font></td>
</tr>
<tr><td colspan="2" height="12"></td>
</tr>
<? } ?>
</table>
