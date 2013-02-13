<?
// 클럽 검색 폼
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<form name="fcbsearch" method="post" action="<?=$nc[cb_path]?>/cb_list.php" style="margin:0px;">
<tr>
	<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	<colgroup><col width="107px" /><col width="205px" /><col /><col width="78px" /></colgroup>
	<tr>
		<td><img src="images/cb_search_text.gif"></td>
		<td align="center" background="images/cb_search_bg.gif">
		<select name="cc_id" id="cc_id" class="search_cb1">
			<option value="0">카테고리</option>
			<? for ($i=0; $row=mysql_fetch_array($cc_result); $i++) { ?>
			<option value="<?=$row[cc_id]?>"><?=$row[cc_name]?></option>
			<? } ?>
		</select>
		<script>document.fcbsearch.cc_id.value = "<?=$cc_id?"$cc_id":"0"?>";</script>
		<select name="sselect" id="sselect" class="search_cb2">
			<option value="cb_name">클럽명</option>
			<option value="cb_keyword">클럽키워드</option>
			<option value="cb_manager">클럽매니저</option>
		</select></td>
		<td background="images/cb_search_bg.gif">
		<script>document.fcbsearch.sselect.value = "<?=$sselect?"$sselect":"cb_name"?>";</script>
		<input name="stext" type="text" id="stext" class=ed style="width:98%" itemname="검색어" required value="<?=$stext?>"></td>
		<td background="images/cb_search_right.gif"><input name="imageField" type="image" src="images/cb_search_btn.gif" align="absmiddle" width="60" height="21" border="0"></td>		
	</tr>
	</table></td>
</tr>
</form>
</table>
