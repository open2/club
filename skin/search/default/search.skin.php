<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<style type="text/css">
.search_cb1 { width: 105px; height:21px;}
.search_cb2 { width: 80px; height:21px;}
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<form name=fsearch method=get onsubmit="return fsearch_submit(this);" style="margin:0px;">
<input type="hidden" name="srows" value="<?=$srows?>">
<tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <colgroup><col width="107px" /><col width="205px" /><col /><col width="78px" /></colgroup>
	  <tr>
        <td><img src="<?=$search_skin_path?>/img/cb_search_text.gif"></td>
		<td align="center" background="<?=$search_skin_path?>/img/cb_search_bg.gif">
        <?=$group_select?>
        <script language="JavaScript">document.getElementById("gr_id").value = "<?=$gr_id?>";</script>
        <select name="sfl" class="search_cb1">
        <option value="wr_subject||wr_content">제목+내용</option>
        <option value="wr_subject">제목</option>
        <option value="wr_content">내용</option>
        <option value="mb_id">회원아이디</option>
        <option value="wr_name">이름</option>
        </select>
        <select name=sop class="search_cb2">
        <option value=and>AND</option>
        <option value=or>OR</option>
        </select></td>		
		<td background="<?=$search_skin_path?>/img/cb_search_bg.gif">
        <input type=text name="stx" class="ed" style="width:98%" maxlength="20" required itemname="검색어" value='<?=$text_stx?>'></td>		
		<td background="<?=$search_skin_path?>/img/cb_search_right.gif">
        <input type="image" src="<?=$search_skin_path?>/img/cb_search_btn.gif" align="absmiddle" width="60" height="21" border="0" value=" 검 색 ">
        <script language="javascript">
        document.fsearch.sfl.value = "<?=$sfl?>";

        function fsearch_submit(f)
        {
            if (f.stx.value.length < 2) {
                alert("검색어는 두글자 이상 입력하십시오.");
                f.stx.select();
                f.stx.focus();
                return false;
            }

            // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
            var cnt = 0;
            for (var i=0; i<f.stx.value.length; i++) {
                if (f.stx.value.charAt(i) == ' ')
                    cnt++;
            }

            if (cnt > 1) {
                alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
                f.stx.select();
                f.stx.focus();
                return false;
            }
            
            f.action = "<?=$nc[cb_path]?>/bbs/search.php";
            return true;
        }
        </script>		
		</td>		
	  </tr>
    </table></td>
</tr>
</table>
</form>
<table width="100%" border="0" align="left"  cellpadding="0" cellspacing="0">
<tr>
    <td style='word-break:break-all;'>

        <? 
        if ($stx) 
        { 
            echo "<br /><ul type=circle><li><b>검색된 게시판 리스트</b> (<b>{$board_count}</b>개의 게시판, <b>".number_format($total_count)."</b>개의 게시글, <b>".number_format($page)."/".number_format($total_page)."</b> 페이지)</ul>";
            if ($board_count)
            {
                echo "<ul><ul type=square style='line-height:130%;'>";
                if ($onetable)
                    echo "<li><a href='?$search_query&gr_id=$gr_id'>전체게시판 검색</a>";
                echo $str_board_list;
                echo "</ul></ul>";
            }
            else
            {
                echo "<ul style='line-height:130%;'><li>검색된 자료가 하나도 없습니다.</ul>";
            }
        }
        ?>

        <? 
        $k=0;
        for ($idx=$table_index, $k=0; $idx<count($search_table) && $k<$rows; $idx++) 
        { 
            echo "<ul type=circle><li><b><a href='./board.php?bo_table={$search_table[$idx]}&{$search_query}'><u>{$bo_subject[$idx]}</u></a>에서의 검색결과</b></ul>";
            $comment_href = "";
            for ($i=0; $i<count($list[$idx]) && $k<$rows; $i++, $k++) 
            {
                echo "<ul><ul type=square><li style='line-height:130%;'>";
                if ($list[$idx][$i][wr_is_comment]) 
                {
                    echo "<font color=999999>[코멘트]</font> ";
                    $comment_href = "#c_".$list[$idx][$i][wr_id];
                }
                echo "<a href='{$list[$idx][$i][href]}{$comment_href}'><u>";
                echo $list[$idx][$i][subject];
                echo "</u></a> [<a href='{$list[$idx][$i][href]}{$comment_href}' target=_blank>새창</a>]<br>";
                echo $list[$idx][$i][content];
                echo "<br><font color=#999999>{$list[$idx][$i][wr_datetime]}</font>&nbsp;&nbsp;&nbsp;";
                echo $list[$idx][$i][name];
                echo "</ul></ul>";
            }
        }
        ?>

        <p align="center"><?=$write_pages?>

</td>
</tr>
</table>
