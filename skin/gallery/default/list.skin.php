<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

$board_skin_path = $cb_gallery_skin_path; 

include_once("$board_skin_path/skin.lib.php");

if (!$board[bo_1]) alert("�Խ��� ���� : ���� �ʵ� 1 �� ��Ͽ��� ������ �̹����� ��(����)�� �����Ͻʽÿ�. (�ȼ� ����)");
if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 �̻� ������ ��ġ�Ǿ� �־�� ����� �� �ִ� ������ �Խ��� �Դϴ�.");

if (!$board[bo_2]) {
    $board[bo_2] = "130x70";
    $sql = " update $g4[board_table] set bo_2 = '$board[bo_2]' where bo_table = '$bo_table' ";
    sql_query($sql);
}

list($img_width, $img_height) = explode("x", $board[bo_1]);
list($img2_width, $img2_height) = explode("x", $board[bo_2]);

$mod = $board[bo_gallery_cols];
if ($mod) $mod = 3; // �ƹ��� ������ ������ �⺻���� 3�� ����
$td_width = (int)(100 / $mod);

$data_path = $g4[path]."/data/file/$bo_table";
$thumb_path = $data_path.'/thumb';

// ���ÿɼ����� ���� ����ġ�Ⱑ ���������� ����
$colspan = 5;
if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// ������ ���ٷ� ǥ�õǴ� ��� �� �ڵ带 ����� ������.
// <nobr style='display:block; overflow:hidden; width:000px;'>����</nobr>
?>

<!-- �Խ��� ��� ���� -->
<table width="<?=$width?>" align=center cellpadding=0 cellspacing=0><tr><td>

<!-- �з� ����Ʈ �ڽ�, �Խù� ���, ������ȭ�� ��ũ -->
<table width="100%" cellspacing="0" cellpadding="0">
<tr height="25">
    <form name="fcategory" method="get"><td width="50%">
    <? if ($is_category) { ?>
    <select name=sca onchange="location='<?=$category_location?>'+this.value;"><option value=''>��ü</option><?=$category_option?>
    </select> 
    <? } ?>
    <?=subject_sort_link('wr_good', $qstr2, 1)?>��õ��</a>
    |
    <?=subject_sort_link('wr_hit', $qstr2, 1)?>��ȸ��</a>
    |
    <?=subject_sort_link('wr_comment', $qstr2, 1)?>�ڸ�Ʈ��</a>
    <? if ($is_checkbox) { ?> <input onclick="if (this.checked) all_checked(true); else all_checked(false);" type=checkbox><?}?>
    </td></form>
    <td align="right">
        �Խù� <?=number_format($total_count)?>�� 
        <? if ($rss_href) { ?><a href='<?=$rss_href?>'><img src='<?=$board_skin_path?>/img/btn_rss.gif' border=0 align=absmiddle></a><?}?>
        <? if ($admin_href) { ?><a href="<?=$admin_href?>"><img src="<?=$board_skin_path?>/img/admin_button.gif" title="������" width="63" height="22" border="0" align="absmiddle"></a><?}?></td>
</tr>
<tr><td height=5></td></tr>
</table>

<form name="fboardlist" method="post" style="margin:0px;">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="sfl"  value="<?=$sfl?>">
<input type="hidden" name="stx"  value="<?=$stx?>">
<input type="hidden" name="spt"  value="<?=$spt?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="sw"   value="">
<table width=100% cellpadding=0 cellspacing=0>
<tr><td colspan='<?=$mod?>' height=2 bgcolor=#B0ADF5></td></tr>
<tr> 
<?
for ($i=0; $i<count($list); $i++) { 
    if ($i && $i%$mod==0)
        echo "</tr><tr>";

    $img = "<img src='$board_skin_path/img/noimage.gif' border=0 title='�̹��� ����'>";
    $thumb = $thumb_path.'/'.$list[$i][wr_id];
    $file = $list[$i][file][0][path] .'/'. $list[$i][file][0][file];
    //$exif = @exif_read_data($file);
    if (!file_exists($thumb)) {
        if (preg_match("/\.(jpg|gif|png)$/i", $file) && file_exists($file)) {
            $thumb_file = "{$thumb_path}/{$list[$i][wr_id]}";
            $size = @getimagesize($file);
            if ($size[2] == 1)
                $src = imagecreatefromgif($file);
            else if ($size[2] == 2)
                $src = imagecreatefromjpeg($file);
            else if ($size[2] == 3)
                $src = imagecreatefrompng($file);
            else
                continue;

            if ($size[0] > $size[1]) {
                $rate = $board[bo_1] / $size[0];
                $height = (int)($size[1] * $rate);

                $img_width = $board[bo_1];
                $img_height = $height;
            } else {
                $rate = $board[bo_1] / $size[1];
                $width = (int)($size[0] * $rate);
                $img_width = $width;
                $img_height = $board[bo_1];
            }
            createThumb2($img_width, $img_height, $file, $thumb, $list[$i][mb_id]);
            
            $thumb_file = "{$thumb_path}/{$list[$i][wr_id]}_{$img2_width}x{$img2_height}";
            createThumb($img2_width, $img2_height, $file, $thumb_file);

            $sql = " update $write_table set wr_10 = '$exif[Model]' where wr_id = '{$list[$i][wr_id]}' ";
            sql_query($sql);
        }
    }

    $thumb_file = "{$thumb_path}/{$list[$i][wr_id]}_{$img2_width}x{$img2_height}";
    if (file_exists($thumb_file)) {
        $size = getimagesize($thumb_file);
        $img = "<div style='width:{$size[0]}px; border:1px solid #cccccc;background:#EEEEEE;padding:4px;'>";
        ?> 

        <script language="javascript" src="<?=$nc[cb_url_path]?>/js/common.js"></script> 
        <? 
        if($cm[cm_level] >= $cn[cn_view_level]){ 
            $img .= "<a href=\"{$list[$i][comment_href]}\">"; 
        } else { 
            $img .= "<a href='javascript:no_member();' onfocus='this.blur()'>"; 
        } 
        $img .= "<img src='$thumb_file' border=0>";
        $img .= "</a></div>";
    }

    $style = "";
    //if ($list[$i][icon_new]) $style = " style='font-weight:bold;' ";
    //$subject = "<span $style>".cut_str($list[$i][subject],20)."</span>";
    $subject = "<span $style>{$list[$i][subject]}</span>";

    $comment_cnt = "";
    if ($list[$i][comment_cnt]) 
        $comment_cnt = " <a href=\"{$list[$i][comment_href]}\"><span class='commentFont'>{$list[$i][comment_cnt]}</span></a>";

    $list[$i][name] = preg_replace("/<img /", "<img style='display:none;' ", $list[$i][name]);
    $list[$i][name] = preg_replace("/> <span/", "><span", $list[$i][name]);
    $list[$i][name] = preg_replace("/class='member'/", "", $list[$i][name]);

    //echo "<td width='{$td_width}%' valign=bottom style='word-break:break-all;padding-left:10px;padding-right:10px;'>";
    echo "<td width='{$td_width}%' valign=bottom style='word-break:break-all;padding:0 10 0 10px;'>";
    echo "<table align=center>";
    echo "<tr><td height=5></td></tr>";
    echo "<tr><td align=center><a href='{$list[$i][href]}'>$img</a></td></tr>";
    echo "<tr><td align=center class=lh>";
    //echo "<nobr style='display:block;overflow:hidden;width:145px;'><span class=small><a href='{$list[$i][ca_name_href]}'>[{$list[$i][ca_name]}]</a></span> ";
    echo "<a href='{$list[$i][href]}'>$subject</a>{$comment_cnt}</nobr>";
    //echo "<span class=small><font color=gray>";
    //echo "<span class='lsm'><a href='$g4[bbs_path]/board.php?bo_table=$bo_table&sca=$sca&sfl=wr_10&stx=$exif[Model]&sop=and'>";
    //echo "$exif[Model]</a></span>";
    //echo "<br><span class='lsm'>�Կ� : $exif[DateTimeOriginal]</span>";
    //echo "<br>��ȸ ({$list[$i][wr_hit]}) / ��õ ({$list[$i][wr_good]})";
    //echo "</font></span>";
    echo "</td></tr>";
    //if ($is_category) echo "<tr><td align=center><span class=small></span></td></tr>";
    //echo "<tr><td align=center>".$cls." {$list[$i][name]}</td></tr>";
    //echo "<tr><td align=center><span class=small>{$list[$i][name]}</span></td></tr>";
    if ($is_checkbox) echo "<tr><td align=center><input type=checkbox name=chk_wr_id[] value='{$list[$i][wr_id]}'></td></tr>";
    echo "<tr><td height=10></td></tr>";
    echo "</table></td>\n";
}

// ������ td
$cnt = $i%$mod;
if ($cnt)
    for ($i=$cnt; $i<$mod; $i++)
        echo "<td width='{$td_width}%'>&nbsp;</td>";
?>
</tr>
<tr><td colspan=<?=$mod?> height=1 bgcolor=#E7E7E7></td></tr>

<? if (count($list) == 0) { echo "<tr><td colspan='$mod' height=100 align=center>�Խù��� �����ϴ�.</td></tr>"; } ?>
<tr><td colspan=<?=$mod?> bgcolor=#5C86AD height=1>
</table>
</form>

<!-- ������ -->
<table width="100%" cellspacing="0" cellpadding="0">
<tr> 
    <td width="100%" align="center" height=30 valign=bottom>
        <? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/btn_search_prev.gif' border=0 align=absmiddle title='�����˻�'></a>"; } ?>
        <?
        // �⺻���� �Ѿ���� �������� �Ʒ��� ���� ��ȯ�Ͽ� �̹����ε� ����� �� �ֽ��ϴ�.
        //echo $write_pages;
        $write_pages = str_replace("ó��", "<img src='$board_skin_path/img/begin.gif' border='0' align='absmiddle' title='ó��'>", $write_pages);
        $write_pages = str_replace("����", "<img src='$board_skin_path/img/prev.gif' border='0' align='absmiddle' title='����'>", $write_pages);
        $write_pages = str_replace("����", "<img src='$board_skin_path/img/next.gif' border='0' align='absmiddle' title='����'>", $write_pages);
        $write_pages = str_replace("�ǳ�", "<img src='$board_skin_path/img/end.gif' border='0' align='absmiddle' title='�ǳ�'>", $write_pages);
        $write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "<b><font style=\"font-family:����; font-size:9pt; color:#797979\">$1</font></b>", $write_pages);
        $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><font style=\"font-family:����; font-size:9pt; color:orange;\">$1</font></b>", $write_pages);
        ?>
        <?=$write_pages?>
        <? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/btn_search_next.gif' border=0 align=absmiddle title='�����˻�'></a>"; } ?>
    </td>
</tr>
</table>

<!-- ��ư ��ũ -->
<form name=fsearch method=get style="margin:0px;">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=sca      value="<?=$sca?>">
<table width=100% cellpadding=0 cellspacing=0>
<tr> 
    <td width="50%" height="40">
        <? if ($list_href) { ?><a href="<?=$list_href?>&sca=<?=$sca?>"><img src="<?=$board_skin_path?>/img/btn_list.gif" border="0"></a><? } ?>
        <? if ($write_href) { ?><a href="<?=$write_href?>&sca=<?=$sca?>"><img src="<?=$board_skin_path?>/img/btn_write.gif" border="0"></a><? } ?>
        <? if ($is_checkbox) { ?>
            <a href="javascript:select_delete();"><img src="<?=$board_skin_path?>/img/btn_select_delete.gif" border="0"></a>
            <a href="javascript:select_copy('copy');"><img src="<?=$board_skin_path?>/img/btn_select_copy.gif" border="0"></a>
            <a href="javascript:select_copy('move');"><img src="<?=$board_skin_path?>/img/btn_select_move.gif" border="0"></a>
        <? } ?>
    </td>
    <td width="50%" align="right">
        <select name=sfl>
            <option value='wr_subject||wr_content'>����+����</option>
            <option value='wr_subject'>����</option>
            <option value='wr_content'>����</option>
            <option value='mb_id'>ȸ�����̵�</option>
            <option value='wr_name'>�̸�</option>
        </select><input name=stx maxlength=15 size=10 itemname="�˻���" required value="<?=$stx?>"><select name=sop>
            <option value=and>and</option>
            <option value=or>or</option>
        </select>
        <input type=image src="<?=$board_skin_path?>/img/search_btn.gif" border=0 align=absmiddle></td>
</tr>
</table>
</form>

</td></tr></table>

<script language="JavaScript">
if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
if ('<?=$stx?>') {
    document.fsearch.sfl.value = '<?=$sfl?>';

    if ('<?=$sop?>' == 'and') 
        document.fsearch.sop[0].checked = true;

    if ('<?=$sop?>' == 'or')
        document.fsearch.sop[1].checked = true;
} else {
    document.fsearch.sop[0].checked = true;
}
</script>

<? if ($is_checkbox) { ?>
<script language="JavaScript">
function all_checked(sw)
{
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function check_confirm(str)
{
    var f = document.fboardlist;
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(str + "�� �Խù��� �ϳ� �̻� �����ϼ���.");
        return false;
    }
    return true;
}

// ������ �Խù� ����
function select_delete()
{
    var f = document.fboardlist;

    str = "����";
    if (!check_confirm(str))
        return;

    if (!confirm("������ �Խù��� ���� "+str+" �Ͻðڽ��ϱ�?\n\n�ѹ� "+str+"�� �ڷ�� ������ �� �����ϴ�"))
        return;

    f.action = "./delete_all.php";
    f.submit();
}

// ������ �Խù� ���� �� �̵�
function select_copy(sw)
{
    var f = document.fboardlist;

    if (sw == "copy")
        str = "����";
    else
        str = "�̵�";
                       
    if (!check_confirm(str))
        return;

    var sub_win = window.open("", "move", "left=50, top=50, width=396, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<? } ?>
<!-- �Խ��� ��� �� -->
