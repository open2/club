<table width="180" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3"><img src="<?=$cb_outlogin_skin?>/login_title.gif"></td>
	</tr>
	<tr>
		<td height="108" width="13" background="<?=$cb_outlogin_skin?>/left_bg.gif">&nbsp;</td>		
		<td width="155" bgcolor="#FBFBFB"><table width="100%" border="0" cellpadding="0" cellspacing="0">
		  </tr>
		  <tr>
		    <td colspan="2" valign="bottom" height="20"><strong><?=$nick?></strong>님<? if ($cm[0]) { echo "[$cm[ml_name]]"; } ?><? if ($is_admin == "super" || $is_auth) { ?><a href="<?=$nc[cb_path]?>/admin/club_admin.php"><img src="<?=$cb_outlogin_skin?>/admin.gif" width="16" height="15" border="0" align="absmiddle"></a><? } ?></td>
		  </tr>
		  <tr><td colspan="2" height="5"></td>
		  </tr>
		  <tr>
		    <td><a href="javascript:win_point();">포인트 : <span class="tahoma9"><?=$point?></span></a></td>
			<td><a href="javascript:win_memo();">쪽지 : <span class="tahoma9"><?=$memo_not_read?></span></a></td>
		  </tr>
		  <tr><td colspan="2" height="8"></td>
		  </tr>
		  <tr>
		    <td><a href="javascript:win_scrap();">스크랩</a></td>
			<td><a href="./club_index.php?doc=cb_myclub_list.php">내클럽</a></td>
		  </tr>
		  <tr><td colspan="2" height="17"></td>
		  </tr>
		  <tr>
          <td colspan="3"><a href="<?=$nc[cb_path]?>/bbs/member_confirm.php?url=register_form.php"><img src="<?=$cb_outlogin_skin?>/btn_info.gif" width="77" height="28" border="0" alt="정보수정"></a><? if ($cb[cb_id]) { ?><a href="<?=$g4[bbs_path]?>/logout.php?url=<?=$g4[path]?>/club/club_main.php?cb_id=<?=$cb[cb_id]?>" target=_top><? } else { ?><a href="<?=$g4[bbs_path]?>/logout.php?url=<?=$g4[path]?>/club/" target=_top><? } ?><img src="<?=$cb_outlogin_skin?>/btn_logout.gif" width="78" height="28" border="0" alt="로그아웃"></a></td>
          </tr>
          </table></td>
		<td width="12" background="<?=$cb_outlogin_skin?>/right_bg.gif">&nbsp;</td>
	</tr>	
	<tr>
		<td colspan="3"><img src="<?=$cb_outlogin_skin?>/box_btm.gif"></td>
	</tr>
</table>
