<div style="height:10px; overflow:hidden;"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong><?=$title?></strong> <span class="tahoma10">(<?=$total_count?>)</span></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:20px; overflow:hidden;"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?
		for ($i=0; $row=sql_fetch_array($result); $i++) {
        $b = $rows*($page-1) + $i+1;
        if (!$row[cb_content]) {
            $sql1 = " select cb_content from $nc[cb_info_table] where cb_id = '$row[cb_id]' ";
            $result1 = sql_fetch($sql1);
            $row[cb_content] = $result1[cb_content]; 
        }
  ?>
    <tr>
		<td style="padding-bottom:23px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="bottom">&nbsp;<span style="font-weight:bold; color:#5881B1;"><?= $b ?></span> - <a href="./club_main.php?cb_id=<?=$row[cb_id]?>" target="_parent"><span style="font-weight:bold; color:#2F3743;"><?=$row[cb_name]?></span></a></td>
			</tr>
		</table>		
		<table width="100%" border="0" class="cbList_tb" cellpadding="0">
		<colgroup>
		<col width="170px" /><col /><col width="70px" /><col width="100px" /><col width="105px" /></colgroup>
		<tr class="cbList_tr">
			<td style="padding-left:10px;" height="28">
			<? 
				$sql2 = " select cc_name from $nc[tbl_category] where cc_id = '$row[cc_id]' ";
				$result2 = sql_fetch($sql2);
	        ?>
	        카테고리 : <?=$result2[cc_name]?></td>
			<td>매니저 : <?=view_member($row[cb_manager])?></td>
			<td class="cbList_subtd">회원 : <span style="color:#FF6600;"><?=$row[cb_total_member]?>명</span></td>
			<td class="cbList_subtd">포인트 : <span style="color:#FF6600;"><?=$row[cb_point]?></span></td>
			<td class="cbList_subtd">개설일 : <?=$row[opendate]?></td>
		</tr>
	    <tr>
			<td colspan="5" style="padding-left:10px;" height="28">클럽소개 : <?=get_text(cut_str($row[cb_content], 210))?></td>
		</tr>
		</table></td>
	</tr>
	<?
		}	
		if ($i == 0) {
			echo "<tr><td height='100' align='center'>검색 결과가 없습니다.</td></tr>";
		}
	?>
</table>
<?
$pagelist = get_paging(10, $page, $total_page, $page_url); 
if ($pagelist) {
    echo "<p><table width=100% cellpadding=3 cellspacing=1><tr><td align=center>$pagelist</td></tr></table>\n";
}
?>
<br /><br /><br /><br /><br /><br />
