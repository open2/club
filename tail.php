    </td>

    <td width="10">&nbsp;</td>
    <td width="200" valign="top">
    <!-- club_list($kind="", $cc_id="", $skin_dir="", $rows=10, $subject_len=40, $latest_title="클럽목록") -->
    <?=club_list("new", "", "cb_list", 10, 23,"신규클럽")?>
    <div style="height:5px; overflow:hidden;"></div>
	  <?=cb_latest_main("",20,23,"클럽 최신글")?>
    <div style="height:10px; overflow:hidden;"></div>
    <?=cb_pop_main("",20,23,"클럽 인기글")?>
    </td>
</tr>
</table>

</td></tr><tr><td>

<? include_once "$nc[cb_path]/include/cb_bottom.inc.php"; ?>

<?
include_once "$nc[cb_path]/tail.sub.php";
?>

</td></tr></table>
