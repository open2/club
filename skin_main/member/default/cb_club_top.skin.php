<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<colgroup><col width="7px" /><col /><col width="190px" /><col width="7px" /></colgroup>
	<tr>
		<td class="cbmenuTb_tL"></td>
		<td class="cbmenuTb_tC">
		<div id="cbmenu_top" style="padding-left:30px;">
			<ul>
			<li class="first">		
				<a href="<?=$nc[cb_path]?>">Ŭ������(Club main)</a>
			</li>
			<li>
				<a href="<?=$g4[path]?>"><?=$config[cf_title]?>(Home)</a>
			</li>
			<? if ($member[mb_id]) { ?>
			<li>
				<a href="<?=$nc[cb_path]?>/club_index.php?doc=cb_myclub_list.php">����Ŭ��</span></a>
			</li>
			<? } ?>
			<li>
				<a href="<?=$nc[cb_path]?>/club_index.php?doc=<?=urlencode("cb_list.php?cb_recommend=N&ssort=cb_regdate")?>">��üŬ��</a>
			</li>
			<li>
				<a href="<?=$nc[cb_path]?>/club_index.php?doc=<?=urlencode("cb_list.php?cb_recommend=Y")?>">��õŬ��</a>
			</li>
			<li>
				<a href="<?=get_random_club_url()?>">����Ŭ��</a>
			</li>
			<li>
				<a href="<?=$nc[cb_path]?>/club_index.php?doc=<?=urlencode("cb_list.php?ssort=cb_total_member&sorder=desc&rank=1")?>">Ŭ��(ȸ����)</a>
			</li>
			<li>
				<a href="<?=$nc[cb_path]?>/club_index.php?doc=<?=urlencode("cb_list.php?ssort=cb_point&sorder=desc&rank=1")?>">Ŭ��(����Ʈ)</a>
			</li>
			</ul>
		</div></td>
		<td class="cbmenuTb_tC"><? if ($is_member) { ?>
        <select name="select" onChange="go_club(this.value);" style="width:170px;">
        <option> �� Ŭ�� �ٷ� ���� =====</option>
        <?=get_my_club($member[mb_id])?>
        </select>
        <script language="javascript">
            function go_club(cb_id)
            {
              if (cb_id != "")
                window.location.href = "<?=$nc[cb_path]?>/club_main.php?cb_id=" + cb_id;
            }
        </script>
        <? } ?></td>
		<td class="cbmenuTb_tR"></td>
	</tr>
	<tr><td height="6" colspan="4"></td>
	</tr>
</table>
