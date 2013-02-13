<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$time = date("Y-m-d H:i:s", $g4[server_time] - 86400 * 7);
$sql = " select count(*) as cnt from $g4[board_good_table] 
          where mb_id = '$member[mb_id]'
		    and bg_datetime >= '$time' ";
$row = sql_fetch($sql);
$cnt = $row[cnt];

if ($view[wr_nogood] >= $board[bo_3] && !$is_admin)
    alert("비추천을 많이 받은 글은 확인이 불가합니다.");

//$exif = @exif_read_data("{$view[file][0][path]}/{$view[file][0][file]}");

$board_skin_path = $cb_gallery_skin_path; 
?>

<!-- 게시글 보기 시작 -->
<table width="<?=$width?>" align="center" cellpadding="0" cellspcing="0"><tr><td>

<!-- 링크 버튼 -->
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
<tr><td height=30>&nbsp;&nbsp;<font color=#7A8FDB>글쓴이</font> : <?=$view[name]?><? if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>&nbsp;&nbsp;&nbsp;
       <font color=#7A8FDB>날짜</font> : <?=substr($view[wr_datetime],2,14)?>&nbsp;&nbsp;&nbsp;
       <font color=#7A8FDB>조회</font> : <?=$view[wr_hit]?>&nbsp;&nbsp;&nbsp;
       <? if ($is_good) { ?><font color=#7A8FDB>추천</font> : <?=$view[wr_good]?>&nbsp;&nbsp;&nbsp;<?}?>
       <? if ($is_nogood) { ?><font color=#7A8FDB>비추천</font> : <?=$view[wr_nogood]?>&nbsp;&nbsp;&nbsp;<?}?></td></tr>
<tr><td height=1 bgcolor=#E7E7E7></td></tr>

<? if ($trackback_url) { ?>
<tr><td height=30>&nbsp;&nbsp;트랙백 주소 : <a href="javascript:clipboard_trackback('<?=$trackback_url?>');" style="letter-spacing:0;" title='이 글을 소개할 때는 이 주소를 사용하세요'><?=$trackback_url?></a>
<script language="JavaScript">
function clipboard_trackback(str) 
{
    if (g4_is_gecko)
        prompt("이 글의 고유주소입니다. Ctrl+C를 눌러 복사하세요.", str);
    else if (g4_is_ie) {
        window.clipboardData.setData("Text", str);
        alert("트랙백 주소가 복사되었습니다.\n\n<?=$trackback_url?>");
    }
}
</script></td></tr>
<?}?>

<?
// 가변 파일
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
        echo "<a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}'><u><b>{$view[file][$i][source]}</b> ({$view[file][$i][size]})<!--, {$view[file][$i][datetime]}--> (원본이미지 사이즈 <b>{$exif[COMPUTED][Width]} x {$exif[COMPUTED][Height]}</b>)</u></a><br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<span style='color:blue;'>↑ 워터마크 없는 원본이미지 다운로드시 <b>".number_format(abs($board[bo_download_point]))." 포인트</b>를 차감합니다.</span></td></tr>";
    }
}

// 링크
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
        <!-- <font color=#ff8800><b>목록에서 작은 이미지로 확인하신 후 ↑ 위의 파일을 다운로드 받아서 사용하세요.</b></font>
        <br><br> -->
        <? 
        // 파일 출력
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
                echo "<p><b>>>> EXIF 정보 <<<</b><br>" ;
                //$exif = @exif_read_data("{$view[file][$i][path]}/{$view[file][$i][file]}");
                if (isset($exif[Make]) || isset($exif[Model])) echo "카메라모델 : $exif[Make] - $exif[Model]<br>";
                if (isset($exif[DateTimeOriginal])) echo "촬영일시 : $exif[DateTimeOriginal]<br>";
                if (isset($exif[COMPUTED][Width]) || isset($exif[COMPUTED][Height])) echo "원본 이미지크기 : {$exif[COMPUTED][Width]} x {$exif[COMPUTED][Height]} 픽셀<br>";
                if (isset($exif[COMPUTED][ApertureFNumber])) echo "조리개 : {$exif[COMPUTED][ApertureFNumber]}<br>";
                if (isset($exif[ISOSpeedRatings])) echo "ISO : $exif[ISOSpeedRatings]<br>";
                if (isset($exif[WhiteBalance])) echo "화이트밸런스 : {$exif[WhiteBalance]}<br>";
                if (isset($exif[ExposureTime])) echo "노출시간 : $exif[ExposureTime] 초<br>";
                if (isset($exif[ExposureBiasValue])) echo "노출보정 : $exif[ExposureBiasValue]<br>";
                if (isset($exif[COMPUTED][CCDWidth])) echo "CCD : {$exif[COMPUTED][CCDWidth]}<br>";
                if (isset($exif[Flash])) echo "플래쉬 : {$exif[Flash]}<br>";
                echo "<p>" ;
*/
            }
        }
        ?>

        <span class="ct lh"><?=$view[content];?></span>
        <?//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>
        <!-- 테러 태그 방지용 --></xml></xmp><a href=""></a><a href=''></a>
        
        <? if ($is_signature) { echo "<br>$signature<br><br>"; } // 서명 출력 ?></td>
</tr>
</table><br>

<?
include_once("./view_comment.php");
?>

<?=$link_buttons?>

</td></tr></table><br>

<script language="JavaScript">
// HTML 로 넘어온 <img ... > 태그의 폭이 테이블폭보다 크다면 테이블폭을 적용한다.
function resize_image()
{
    var target = document.getElementsByName('target_resize_image[]');
    var image_width = parseInt('<?=$board[bo_image_width]?>');
    var image_height = 0;

    for(i=0; i<target.length; i++) 
    { 
        // 원래 사이즈를 저장해 놓는다
        target[i].tmp_width  = target[i].width;
        target[i].tmp_height = target[i].height;
        // 이미지 폭이 테이블 폭보다 크다면 테이블폭에 맞춘다
        if(target[i].width > image_width) {
            image_height = parseFloat(target[i].width / target[i].height)
            target[i].width = image_width;
            target[i].height = parseInt(image_width / image_height);

            // 스타일에 적용된 이미지의 폭과 높이를 삭제한다
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
    // 관리자이거나 자신의 글이거나 계급이 높거나 같으면, 등록 후 한달이 지났으면 통과
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
                    and po_rel_action = '다운로드' ";
        $row = sql_fetch($sql);
        if (!$row[cnt]) {
?>
            if (confirm("'"+file+"' 파일을 다운로드 하시면 포인트가 <?=number_format($board['bo_download_point'])?> 점 차감됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?"))
<?
        }
    }
}
?>
document.location.href = link;
}
</script>
<!-- 게시글 보기 끝 -->
