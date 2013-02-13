<style type="text/css"> 
.category_list {width:100%; padding:0px; margin:0; list-style:none; overflow:hidden; border:0;}
.category_list li {margin-bottom:3px; font:normal 12px/1.5 µ¸¿ò, Dotum; letter-spacing:-1px; vertical-align:top;}
.category_list li img {vertical-align:middle; margin-top:-2px;}
.category_list li a {color:#5B5B5B; text-decoration:none;}
.category_list li a:hover {text-decoration:underline;}
</style>
<table width="180" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td colspan="2"><img src="<?=$nc[member_skin_path]?>/img/title_category.gif" width="180" height="33" /></td>
</tr>
<tr>
	<td width="10" background="<?=$nc[member_skin_path]?>/img/box1_lbg.gif"></td>
	<td width="170" valign="top" style="background:url('<?=$nc[member_skin_path]?>/img/box1_rbg.gif') repeat-y right;">
	<ul class="category_list">
	<? for ($i=0; $row=mysql_fetch_array($result); $i++) { ?>
	<li>
		<a href="<?=$nc[cb_path]?>/club_index.php?doc=<?=urlencode("cb_list.php?cc_id={$row[cc_id]}")?>"><?=$row[cc_name]?></a> <span class="tahoma10">(<?=$row[cc_total]?>)</span>
	</li>	
	<? } ?>
	</ul>
	</td>
</tr>
<tr>
	<td><img src="<?=$nc[member_skin_path]?>/img/box1_b01.gif" /></td>
	<td style="background:url('<?=$nc[member_skin_path]?>/img/box1_btm_r.gif') repeat-y right;"></td>
</tr>
</table>
