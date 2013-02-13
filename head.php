<?
include_once "./_common.php";

$g4[title] = "클럽메인 - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";
?>

<table width=100% border="0" cellpadding="0" cellspacing="0" style='padding-left:5px;'><tr><td>

<table width="<?=$nc[nf_width]?>" border="0" align="<?=$nc[nf_align]?>" cellpadding="0" cellspacing="0">
<tr>
	<td><? include_once "$nc[member_skin_path]/cb_club_top.skin.php"; ?>
  </td>
</tr>
</table>

</td></tr><tr><td>

<table width="<?=$nc[nf_width]?>" border="0" align="<?=$nc[nf_align]?>" cellspacing="0" cellpadding="0">
    <tr>
		<td width="180" valign="top">
		
		<?=cb_outlogin($nc[nf_outlogin_skin]);?>
		<div style="height:10px; overflow:hidden;"></div>
		<?=cb_club_notice("notice",3,22,"공지사항")?>
		<div style="height:10px; overflow:hidden;"></div>
		<? 
		include_once "$nc[member_skin_path]/cb_clubmenu.skin.php"; 
		?>
		<div style="height:7px; overflow:hidden;"></div>
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<? if ($member[mb_id] && $member[mb_level] >= $nc[nf_open_level]) { ?>
		<tr>
			<td><a href="<?=$nc[cb_path]?>/club_index.php?doc=cb_open.php"><img src="<?=$nc[cb_path]?>/images/btn_club_make.gif" border="0"></a></td>
		</tr>
		<tr>
			<td height="5"></td>
		</tr>
		<? } ?>
		<tr>
			<td>
			<a href="<?=$nc[cb_path]?>/club_main.php?cb_id=cb_clubhouse"><img src="<?=$nc[cb_path]?>/images/btn_club_house.gif" border="0"></a>
			</td>
		</tr>
		</table>

		<div style="height:7px; overflow:hidden;"></div>
		<?
    // 클럽 카테고리
    $sql    = " select * from $nc[category_table] order by cc_idx asc ";
    $result	= sql_query($sql);
  	include_once "$nc[member_skin_path]/cb_category.skin.php"; 
  	?>

		</td>

	  <td width="10"></td>
	  
    <td valign="top">
