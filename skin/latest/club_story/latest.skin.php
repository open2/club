<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;">
<? for ($i=0; $i<count($list); $i++) { ?>
<tr>
	<td>
	    <?
        $image = urlencode($list[$i][file][0][file]); // ù��° ������ �̹������ 
        if (preg_match("/\.(gif|jpg|png)$/i", $image)) { 
            $img = "$g4[path]/data/file/$bo_table/".urlencode($list[$i][file][0][file]);
            $img_width = $nc[nf_width ]-190;
            $img_info = getimagesize($img);
            if ($img_info[0] >= $img_width) {
                include_once("$g4[path]/lib/thumb.lib.php");
                $img = thumbnail($img, $img_width, 0, 1, 1, 90);
                //function thumbnail($file_name, $width=0, $height=0, $is_create=false, $is_crop=2, $quality=70, $small_thumb=true, $watermark="", $filter="", $noimg="", $thumb_type="") 
            }
      		  echo "<img style='vertical-align:bottom;' src='{$img}'>";
        } else 
			echo ""; 
		?></td>
</tr>
<tr>
	<td style="padding-top:10px;">
		<a href='<?=$list[$i][href]?>'><span style="font:bold 16px ����; color:#FF6600; letter-spacing:-1px;"><?=$list[$i][subject]?></span></a><br />
		<?=nl2br(stripslashes($list[$i][wr_content]))?></td>
</tr>
<? } ?>
<? if (count($list) == 0) { ?><div style="width:100%; text-align:center;"><span style='font: 12px ����; color:#5B5B5B;'><br/ >Ŭ���� �����Ǿ����ϴ�.<br />
Ŭ�� ���ݿ� �°� Ŀ�����丮�� �ٸ纸����~ 
<br /></span><? } ?>
<tr>
	<td align="right" height="30"><a href='<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&sca=<?=$ca_name?>'><img src="<?=$latest_skin_path?>/img/btn_list.gif" border="0" /></a></td>
</tr>
</table>
