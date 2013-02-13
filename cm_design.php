<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("{$cb_id} 클럽이 존재하지 않습니다.");
}

$g4[title] = "$cb[cb_name]:클럽디자인관리 - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";

$sql    = " select * from $nc[tbl_mb_level] where cb_id = '$cb[cb_id]' order by cm_level asc ";
$result = mysql_query($sql);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>디자인 관리</strong></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<form name="fcmdesign" method="post" action="./cm_design.update.php" enctype="multipart/form-data">
<input type="hidden" name="doc"               value="<?=$doc?>">
<input type="hidden" name="cb_id"             value="<?=$cb[cb_id]?>">
<input type="hidden" name="cb_top_skin"       value="<?=$cb[cb_top_skin]?>">
<input type="hidden" name="cb_box_line_skin"  value="<?=$cb[cb_box_line_skin]?>">
<input type="hidden" name="cb_title_color_skin"  value="<?=$cb[cb_title_color_skin]?>">
<input type="hidden" name="cb_box_bg_skin"    value="<?=$cb[cb_box_bg_skin]?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="3" bgcolor="#CCCCCC"></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="listsub">미리보기</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td bgcolor="#FFFFFF">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" background="<?=get_background($cb[cb_top_img])?>" id="view1">
                    <tr>
                      <td height="<?=$nc[title_img_height]?>" style="padding:0px 0px 0px 10px">
                      <div id=cb_link>
                      <a href="#" class="title" style="color:<?=$cb[cb_title_color_skin]?>;"><?=$cb[cb_name]?></a>
                      <br>
                      <a href="#" class="tahoma11" style="text-decoration: underline; color:<?=$cb[cb_title_color_skin]?>;"><?="$g4[url]/$nc[cb_dir]/$cb[cb_id]"?></a>
                      </div>
                      </td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="2"></td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="<?=$cb[cb_box_line_skin]?>" id="view2">
                    <tr>
                      <td class="<?=$boxstyle?>" style="padding:7px 10px 5px 10px">클럽매니저 : <?=view_member($cb[cb_manager])?> | 회원 : <span class="tahoma11"><?=$cb[cb_total_member]?></span> | 개설일 : <span class="tahoma11"><?=date('Y. m. d', strtotime($cb[cb_opendate]))?></span></td>
                      <td align="right" class="<?=$boxstyle?>" style="padding:8px 10px 5px 10px"><a href="#" class="<?=$boxstyle?>">클럽탈퇴</a> | <a href="#" class="<?=$boxstyle?>">클럽관리</a></td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="5"></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="130" class="listsub">타이틀 스킨</td>
          <td><input name="cb_top_method" type="radio" value="1" onClick="view_table(this.value);">
            일반스킨 
            <input name="cb_top_method" type="radio" value="2" onClick="view_table(this.value);">
            이미지 등록 (넓이x높이: <?=$nc[nf_width]?>x<?=$nc[title_img_height]?> px)</td>
        </tr>
      </table>
      <table border="0" cellspacing="0" cellpadding="0" align="center" id="skinset">
        <tr>
          <td align="center"><table border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td><a href="#" onClick="tskin_view('01');"><img src="./images/tskin_01.gif" width="65" height="60" border="0"></a></td>
                <td><a href="#" onClick="tskin_view('02');"><img src="./images/tskin_02.gif" width="65" height="60" border="0"></a></td>
                <td><a href="#" onClick="tskin_view('03');"><img src="./images/tskin_03.gif" width="65" height="60" border="0"></a></td>
                <td><a href="#" onClick="tskin_view('04');"><img src="./images/tskin_04.gif" width="65" height="60" border="0"></a></td>
                <td><a href="#" onClick="tskin_view('05');"><img src="./images/tskin_05.gif" width="65" height="60" border="0"></a></td>
              </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td><a href="#" onClick="tskin_view('06');"><img src="./images/tskin_06.gif" width="65" height="60" border="0"></a></td>
                <td><a href="#" onClick="tskin_view('07');"><img src="./images/tskin_07.gif" width="65" height="60" border="0"></a></td>
                <td><a href="#" onClick="tskin_view('08');"><img src="./images/tskin_08.gif" width="65" height="60" border="0"></a></td>
                <td><a href="#" onClick="tskin_view('09');"><img src="./images/tskin_09.gif" width="65" height="60" border="0"></a></td>
                <td><a href="#" onClick="tskin_view('10');"><img src="./images/tskin_10.gif" width="65" height="60" border="0"></a></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <table border="0" align="center" id="imgset" style="display:none;">
        <tr>
          <td>이미지</td>
          <td class="list"><input type="file" name="cb_top_img[]" size="50" onChange="img_view(this.value);"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>현재 이미지 : <?=$cb[cb_top_img_src]?>
            <input type="hidden" name="cb_top_img"      value="<?=$cb[cb_top_img]?>">
            <input type="hidden" name="cb_top_img_src"  value="<?=$cb[cb_top_img_src]?>"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>

  
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="listsub">클럽 타이틀 </td>
      </tr>
      <tr>
        <td align="center"><table border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td bgcolor="">
              <div id=title_blank style="display:none;">
              <a href="#" onClick="cskin_view('');">없슴</a>
              </div>
              </td>
              <td width=11 nowrap></td>
              <td bgcolor="#C9E4AF"><a href="#" onClick="cskin_view('#C9E4AF');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#AFD7EF"><a href="#" onClick="cskin_view('#AFD7EF');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#B1E1E4"><a href="#" onClick="cskin_view('#B1E1E4');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#D5C3E5"><a href="#" onClick="cskin_view('#D5C3E5');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#F6BFC8"><a href="#" onClick="cskin_view('#F6BFC8');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#FBB7B9"><a href="#" onClick="cskin_view('#FBB7B9');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#D9CDBA"><a href="#" onClick="cskin_view('#D9CDBA');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#F9C4A3"><a href="#" onClick="cskin_view('#F9C4A3');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#B9B9B9"><a href="#" onClick="cskin_view('#B9B9B9');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
            </tr>
            <tr><td colspan="20">&nbsp;</td></tr>
          </table>
          <table border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td bgcolor="#EDEDED"><a href="#" onClick="cskin_view('#EDEDED');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#E0AD94"><a href="#" onClick="cskin_view('#E0AD94');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#C4B3EF"><a href="#" onClick="cskin_view('#C4B3EF');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#F3ECC6"><a href="#" onClick="cskin_view('#F3ECC6');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#B3B6EF"><a href="#" onClick="cskin_view('#B3B6EF');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#D3DC91"><a href="#" onClick="cskin_view('#D3DC91');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#E7E6A2"><a href="#" onClick="cskin_view('#E7E6A2');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#CAAA8D"><a href="#" onClick="cskin_view('#CAAA8D');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#7E7E7E"><a href="#" onClick="cskin_view('#7E7E7E');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#B3D3C8"><a href="#" onClick="cskin_view('#B3D3C8');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="listsub">박스셋 스킨 </td>
      </tr>
      <tr>
        <td align="center"><table border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td bgcolor="#C9E4AF"><a href="#" onClick="bskin_view('#EAF4E0','#8AB83A');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#AFD7EF"><a href="#" onClick="bskin_view('#E5F2FA','#4C87BB');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#B1E1E4"><a href="#" onClick="bskin_view('#E5F4F5','#58A1B0');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#D5C3E5"><a href="#" onClick="bskin_view('#F0EBF5','#885F9F');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#F6BFC8"><a href="#" onClick="bskin_view('#F4E8E9','#B45C62');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#FBB7B9"><a href="#" onClick="bskin_view('#FAE6E8','#D94B45');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#D9CDBA"><a href="#" onClick="bskin_view('#EDE7DE','#695D45');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#F9C4A3"><a href="#" onClick="bskin_view('#FCF3E4','#F68C27');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#B9B9B9"><a href="#" onClick="bskin_view('#F3F3F3','#B9B9B9');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
            </tr>
            <tr><td colspan="20">&nbsp;</td></tr>
          </table>
          <table border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td bgcolor="#EDEDED"><a href="#" onClick="bskin_view('#F7F7F7','#E2E2E2');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#E0AD94"><a href="#" onClick="bskin_view('#F7F3E9','#BA7F55');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#C4B3EF"><a href="#" onClick="bskin_view('#F5F1FC','#B397C3');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#F3ECC6"><a href="#" onClick="bskin_view('#F4F0DD','#A89A4C');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#B3B6EF"><a href="#" onClick="bskin_view('#EDEBF9','#A0A3DC');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#D3DC91"><a href="#" onClick="bskin_view('#F1F4DF','#AED668');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#E7E6A2"><a href="#" onClick="bskin_view('#F6F6E1','#C7C78F');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#CAAA8D"><a href="#" onClick="bskin_view('#F0EADD','#CAAA8D');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#7E7E7E"><a href="#" onClick="bskin_view('#E2E2E2','#7E7E7E');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
              <td width=11 nowrap></td>
              <td bgcolor="#B3D3C8"><a href="#" onClick="bskin_view('#E0EDE8','#ABC9BF');"><img src="./images/img_blank.gif" width="20" height="20" border="0"></a></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="2" bgcolor="#CCCCCC"></td>
  </tr>
  <tr>
    <td align="right" style="padding:5px 10px 5px 10px;"><input name="imageField" type="image" src="./images/btn_confirm.gif" width="90" height="21" border="0"></td>
  </tr>
</table>
</form>
<br><br><br><br><br><br>
<script language="JavaScript" type="text/JavaScript">
    f = document.fcmdesign;
    
    f.cb_top_method[<?=$cb[cb_top_method]-1?>].checked = true;    
    f.cb_top_skin.value       = "<?=$cb[cb_top_skin]?>"
    f.cb_box_line_skin.value  = "<?=$cb[cb_box_line_skin]?>";
    f.cb_title_color_skin.value  = "<?=$cb[cb_title_color_skin]?>";
    f.cb_box_bg_skin.value    = "<?=$cb[cb_box_bg_skin]?>";
    
    function view_table(view)
    {
        if (view == "1") {
            document.getElementById("skinset").style.display = "";
            document.getElementById("imgset").style.display = "none";
            document.getElementById("title_blank").style.display = "none";
            if (document.getElementById("cb_title_color_skin").value == "")
                cskin_view('#C9E4AF');
            //document.getElementById("cb_link").style.display = "";
        } else {
            document.getElementById("skinset").style.display = "none";
            document.getElementById("imgset").style.display = "";
            document.getElementById("title_blank").style.display = "";
            //document.getElementById("cb_link").style.display = "none";
        }
    }
    
    function tskin_view(sv)
	{
		sv = "images/tskin_bg_" + sv + ".gif";
		document.getElementById("view1").setAttribute('background',sv);
		f.cb_top_skin.value = sv;
	}
	
    function bskin_view(sv1, sv2)
	{
		document.getElementById("view2").bgColor = sv2;
		f.cb_box_bg_skin.value     = sv1;
		f.cb_box_line_skin.value   = sv2;
	}

    function cskin_view(sv1)
	{
    tmp = document.getElementById("view1").getElementsByTagName("a"); 
		f.cb_title_color_skin.value     = sv1;    
    for (i=0; i<tmp.length; i++) 
      {
      if (sv1 == '') {
          tmp[i].style.color = ''; 
          tmp[i].style.visibility = 'hidden'; 
      } else {
          tmp[i].style.visibility = 'visible'; 
          tmp[i].style.color = sv1; 
      }
      } 
	}
	
	<?
	if ($cb[cb_top_method] != 1) {
	    echo "document.onload = view_table(2);";
	}
	?>
</script>

<?
include "$nc[cb_path]/tail.sub.php";
?>
