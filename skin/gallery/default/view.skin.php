<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

$time = date("Y-m-d H:i:s", $g4[server_time] - 86400 * 7);
$sql = " select count(*) as cnt from $g4[board_good_table] 
          where mb_id = '$member[mb_id]'
		    and bg_datetime >= '$time' ";
$row = sql_fetch($sql);
$cnt = $row[cnt];

if ($view[wr_nogood] >= $board[bo_3] && !$is_admin)
    alert("����õ�� ���� ���� ���� Ȯ���� �Ұ��մϴ�.");

//$exif = @exif_read_data("{$view[file][0][path]}/{$view[file][0][file]}");

$board_skin_path = $cb_gallery_skin_path; 
?>

<!-- �Խñ� ���� ���� -->
<table width="<?=$width?>" align="center" cellpadding="0" cellspcing="0"><tr><td>

<!-- ��ũ ��ư -->
<? 
ob_start(); 
?>
<table width='100%' cellpadding=0 cellspacing=0>
<tr height=35>
    <td width=75%>
        <? if ($search_href) { echo "<a href=\"$search_href\"><img src='$board_skin_path/img/btn_search_list.gif' border='0' align='absmiddle'></a> "; } ?>
        <? echo "<a href=\"$list_href&sca=$sca\"><img src='$board_skin_path/img/btn_list.gif' border='0' align='absmiddle'></a> "; ?>

        <? if ($write_href) { echo "<a href=\"$write_href&sca=$sca\"><img src='$board_skin_path/img/btn_write.gif' border='0' align='absmiddle'></a> "; } ?>
        <? if ($reply_href) { echo "<a href=\"$reply_href&sca=$sca\"><img src='$board_skin_path/img/btn_reply.gif' border='0' align='absmiddle'></a> "; } ?>

        <? if ($update_href) { echo "<a href=\"$update_href\"><img src='$board_skin_path/img/btn_update.gif' border='0' align='absmiddle'></a> "; } ?>
        <? if ($delete_href) { echo "<a href=\"$delete_href\"><img src='$board_skin_path/img/btn_delete.gif' border='0' align='absmiddle'></a> "; } ?>

        <? if ($scrap_href) { echo "<a href=\"javascript:;\" onclick=\"win_scrap('./scrap_popin.php?bo_table=$bo_table&wr_id=$wr_id');\"><img src='$board_skin_path/img/btn_scrap.gif' border='0' align='absmiddle'></a> "; } ?>

        <? if ($copy_href) { echo "<a href=\"$copy_href\"><img src='$board_skin_path/img/btn_copy.gif' border='0' align='absmiddle'></a> "; } ?>
        <? if ($move_href) { echo "<a href=\"$move_href\"><img src='$board_skin_path/img/btn_move.gif' border='0' align='absmiddle'></a> "; } ?>
    </td>
    <td width=25% align=right>
        <? if ($prev_href) { echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\"><img src='$board_skin_path/img/btn_prev.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
        <? if ($next_href) { echo "<a href=\"$next_href\" title=\"$next_wr_subject\"><img src='$board_skin_path/img/btn_next.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
    </td>
</tr>
</table>
<?
$link_buttons = ob_get_contents();
ob_end_flush();
?>

<table width="100%" cellspacing="0" cellpadding="0">
<tr><td height=2 bgcolor=#B0ADF5></td></tr> 
<tr><td height=30 bgcolor=#F8F8F9 style="padding:5 0 5 0;">&nbsp;&nbsp;<strong><? if ($is_category) { echo ($category_name ? "[$view[ca_name]] " : ""); } ?><?=$view[subject]?></strong></td></tr>
<tr><td height=30>&nbsp;&nbsp;<font color=#7A8FDB>�۾���</font> : <?=$view[name]?><? if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>&nbsp;&nbsp;&nbsp;
       <font color=#7A8FDB>��¥</font> : <?=substr($view[wr_datetime],2,14)?>&nbsp;&nbsp;&nbsp;
       <font color=#7A8FDB>��ȸ</font> : <?=$view[wr_hit]?>&nbsp;&nbsp;&nbsp;
       <? if ($is_good) { ?><font color=#7A8FDB>��õ</font> : <?=$view[wr_good]?>&nbsp;&nbsp;&nbsp;<?}?>
       <? if ($is_nogood) { ?><font color=#7A8FDB>����õ</font> : <?=$view[wr_nogood]?>&nbsp;&nbsp;&nbsp;<?}?></td></tr>
<tr><td height=1 bgcolor=#E7E7E7></td></tr>

<? if ($trackback_url) { ?>
<tr><td height=30>&nbsp;&nbsp;Ʈ���� �ּ� : <a href="javascript:clipboard_trackback('<?=$trackback_url?>');" style="letter-spacing:0;" title='�� ���� �Ұ��� ���� �� �ּҸ� ����ϼ���'><?=$trackback_url?></a>
<script language="JavaScript">
function clipboard_trackback(str) 
{
    if (g4_is_gecko)
        prompt("�� ���� �����ּ��Դϴ�. Ctrl+C�� ���� �����ϼ���.", str);
    else if (g4_is_ie) {
        window.clipboardData.setData("Text", str);
        alert("Ʈ���� �ּҰ� ����Ǿ����ϴ�.\n\n<?=$trackback_url?>");
    }
}
</script></td></tr>
<?}?>

<?
// ���� ����
$cnt = 0;
for ($i=0; $i<count($view[file]); $i++) 
{
    //if ($view[file][$i][source] && !$view[file][$i][view]) 
    if ($view[file][$i][source]) 
    {
        $cnt++;
        //echo "<tr><td height=22>&nbsp;&nbsp;<img src='{$board_skin_path}/img/icon_file.gif' align=absmiddle> <a href='{$view[file][$i][href]}' title='{$view[file][$i][content]}'><strong>{$view[file][$i][source]}</strong> ({$view[file][$i][size]}), Down : {$view[file][$i][download]}, {$view[file][$i][datetime]}</a></td></tr>";
        echo "<tr><td height=22 style='padding:3px 0 3px 0;' class=lh>&nbsp;&nbsp;";
        echo "<img src='{$board_skin_path}/img/icon_file.gif' align=absmiddle> ";
        echo "<a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}'><u><b>{$view[file][$i][source]}</b> ({$view[file][$i][size]})<!--, {$view[file][$i][datetime]}--> (�����̹��� ������ <b>{$exif[COMPUTED][Width]} x {$exif[COMPUTED][Height]}</b>)</u></a><br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<span style='color:blue;'>�� ���͸�ũ ���� �����̹��� �ٿ�ε�� <b>".number_format(abs($board[bo_download_point]))." ����Ʈ</b>�� �����մϴ�.</span></td></tr>";
    }
}

// ��ũ
$cnt = 0;
for ($i=1; $i<=$g4[link_count]; $i++) 
{
    if ($view[link][$i]) 
    {
        $cnt++;
        $link = cut_str($view[link][$i], 70);
        echo "<tr><td height=22>&nbsp;&nbsp;<img src='{$board_skin_path}/img/icon_link.gif' align=absmiddle> <a href='{$view[link_href][$i]}' target=_blank><strong>{$link}</strong> ({$view[link_hit][$i]})</a></td></tr>";
    }
}
?>

<tr><td height=1 bgcolor=#E7E7E7></td></tr>
<tr> 
    <td height="150" style='word-break:break-all; padding:10px;' bgcolor=#F8F8F9>
        <!-- <font color=#ff8800><b>��Ͽ��� ���� �̹����� Ȯ���Ͻ� �� �� ���� ������ �ٿ�ε� �޾Ƽ� ����ϼ���.</b></font>
        <br><br> -->
        <? 
        // ���� ���
        for ($i=0; $i<=count($view[file]); $i++) {
            if ($view[file][$i][view]) {
                $data_path = $g4[path]."/data/file/$bo_table";
                $thumb_path = $data_path.'/thumb';
                $size = getimagesize("$thumb_path/$wr_id");
                echo "<p><div style='width:{$size[0]}px;border:1px solid #cccccc;background:#EEEEEE;padding:10px;'><img src='$thumb_path/$wr_id'></div>";

                echo "<p>" ;
                if ($good_href) { echo "<a href=\"$good_href\" target='hiddenframe'><img src='$board_skin_path/img/btn_good.gif' border='0' align='absmiddle'></a> "; }
                if ($nogood_href) { echo "&nbsp; <a href=\"$nogood_href\" target='hiddenframe'><img src='$board_skin_path/img/btn_nogood.gif' border='0' align='absmiddle'></a> "; }

/*
                echo "<p><b>>>> EXIF ���� <<<</b><br>" ;
                //$exif = @exif_read_data("{$view[file][$i][path]}/{$view[file][$i][file]}");
                if (isset($exif[Make]) || isset($exif[Model])) echo "ī�޶�� : $exif[Make] - $exif[Model]<br>";
                if (isset($exif[DateTimeOriginal])) echo "�Կ��Ͻ� : $exif[DateTimeOriginal]<br>";
                if (isset($exif[COMPUTED][Width]) || isset($exif[COMPUTED][Height])) echo "���� �̹���ũ�� : {$exif[COMPUTED][Width]} x {$exif[COMPUTED][Height]} �ȼ�<br>";
                if (isset($exif[COMPUTED][ApertureFNumber])) echo "������ : {$exif[COMPUTED][ApertureFNumber]}<br>";
                if (isset($exif[ISOSpeedRatings])) echo "ISO : $exif[ISOSpeedRatings]<br>";
                if (isset($exif[WhiteBalance])) echo "ȭ��Ʈ�뷱�� : {$exif[WhiteBalance]}<br>";
                if (isset($exif[ExposureTime])) echo "����ð� : $exif[ExposureTime] ��<br>";
                if (isset($exif[ExposureBiasValue])) echo "���⺸�� : $exif[ExposureBiasValue]<br>";
                if (isset($exif[COMPUTED][CCDWidth])) echo "CCD : {$exif[COMPUTED][CCDWidth]}<br>";
                if (isset($exif[Flash])) echo "�÷��� : {$exif[Flash]}<br>";
                echo "<p>" ;
*/
            }
        }
        ?>

        <span class="ct lh"><?=$view[content];?></span>
        <?//echo $view[rich_content]; // {�̹���:0} �� ���� �ڵ带 ����� ���?>
        <!-- �׷� �±� ������ --></xml></xmp><a href=""></a><a href=''></a>
        
        <? if ($is_signature) { echo "<br>$signature<br><br>"; } // ���� ��� ?></td>
</tr>
</table><br>

<?
include_once("./view_comment.php");
?>

<?=$link_buttons?>

</td></tr></table><br>

<script language="JavaScript">
// HTML �� �Ѿ�� <img ... > �±��� ���� ���̺������� ũ�ٸ� ���̺����� �����Ѵ�.
function resize_image()
{
    var target = document.getElementsByName('target_resize_image[]');
    var image_width = parseInt('<?=$board[bo_image_width]?>');
    var image_height = 0;

    for(i=0; i<target.length; i++) 
    { 
        // ���� ����� ������ ���´�
        target[i].tmp_width  = target[i].width;
        target[i].tmp_height = target[i].height;
        // �̹��� ���� ���̺� ������ ũ�ٸ� ���̺����� �����
        if(target[i].width > image_width) {
            image_height = parseFloat(target[i].width / target[i].height)
            target[i].width = image_width;
            target[i].height = parseInt(image_width / image_height);

            // ��Ÿ�Ͽ� ����� �̹����� ���� ���̸� �����Ѵ�
            target[i].style.width = '';
            target[i].style.height = '';
        }
        target[i].border = 1;
    }
}

window.onload = resize_image;

function file_download(link, file) {
<? 
if ($board['bo_download_point'] < 0) { 
    // �������̰ų� �ڽ��� ���̰ų� ����� ���ų� ������, ��� �� �Ѵ��� �������� ���
    if ($is_admin || 
        ($view[mb_id] == $member[mb_id] && $member[mb_id]) || 
        $member[mb_10] >= $mb[mb_10] ||
        $view[wr_datetime] < date("Y-m-d H:i:s", $g4[server_time] - 86400 * 30))
        ;
    else  {

        $sql = " select count(*) as cnt from $g4[point_table]
                  where mb_id = '$member[mb_id]'
                    and po_rel_table = '$bo_table'
                    and po_rel_id = '$wr_id'
                    and po_rel_action = '�ٿ�ε�' ";
        $row = sql_fetch($sql);
        if (!$row[cnt]) {
?>
            if (confirm("'"+file+"' ������ �ٿ�ε� �Ͻø� ����Ʈ�� <?=number_format($board['bo_download_point'])?> �� �����˴ϴ�.\n\n����Ʈ�� �Խù��� �ѹ��� �����Ǹ� ������ �ٽ� �ٿ�ε� �ϼŵ� �ߺ��Ͽ� �������� �ʽ��ϴ�.\n\n�׷��� �ٿ�ε� �Ͻðڽ��ϱ�?"))
<?
        }
    }
}
?>
document.location.href = link;
}
</script>
<!-- �Խñ� ���� �� -->
