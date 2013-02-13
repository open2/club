<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<table width=100% cellpadding=1 cellspacing=0>
  <tr>
    <td bgcolor="#CCCCCC">
    
<table width="100%" border="0" cellspacing="1" bgcolor="#FFFFFF">
<colgroup width=14>
<colgroup>
<colgroup width=37>
<colgroup width=14>
<tr bgcolor="#EEEEEE" style="padding:7px 10px 5px 5px">
    <td colspan=3>
    <strong>
    <?=$latest_title?>
    </strong>
    <td>
    <? if ($more_url) { ?>
    <a href="<?=$more_url?>" target=_top><img src='<?=$club_list_skin_path?>/img/more.gif' align=absmiddle border=0></a>
    <? } ?>
    </td>
</tr>

<? for ($i=0; $i<count($list); $i++) { ?>
<tr>
            <td colspan=4 style="padding:3px 10px 2px 10px">
            <?
            echo "<a href='$nc[cb_path]/club_main.php?cb_id=" . strip_cb_id($list[$i][cb_id]) . "' target=_top>";
            echo "<font style='font-family:돋움; font-size:9pt; color:#6A6A6A;'>{$list[$i][cb_name]}</font>";
            echo "</a>";
            ?>
          </td>
</tr>
<? } ?>

<? if (count($list) == 0) { ?><tr><td colspan=4 align=center height=50><font color=#6A6A6A>게시물이 없습니다.</a></td></tr><? } ?>

</table>

    </td>
  </tr>
</table>
