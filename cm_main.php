<?
include_once "./_common.php";

$g4[title] = "$cb[cb_name]:Ŭ�����ΰ��� - $nc[nf_title]";
include_once "./head.sub.php";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>Ŭ�� ���� ����</strong></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<form name="fcmmain" method="post" action="./cm_main.update.php" enctype="multipart/form-data">
<input type="hidden" name="doc"   value="<?=$doc?>">
<input type="hidden" name="cb_id" value="<?=$cb[cb_id]?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <colgroup width=130 >
  <colgroup width=150 >
  <colgroup width="" >
  <tr>
    <td height="3" colspan="3" bgcolor="#CCCCCC"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">�ֱ� �Խù� ���</td>
    <td class="list" colspan=2><input name="cb_latest_use" type="radio" value="Y" checked>
      Ŭ���⺻��
      <input name="cb_latest_use" type="radio" value="N">
      �����HTML</td>
  </tr>

  <tr bgcolor="#CCCCCC">
    <td height="2" colspan="3"></td>
  </tr>
  <tr align="left">
    <td style="padding:5px 10px 5px 10px;" colspan="4">�Ʒ��� Ŭ���⺻�� �ֱٱ��� �����Դϴ�</td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="2" colspan="3"></td>
  </tr>

  <!--
  <tr>
    <td height="1" colspan="3" bgcolor="#eeeeee"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">�ֱ� �Խù� ��Ų</td>
    <td class="list" colspan=2><select name="cb_latest_skin">
      <?
        $arr = get_club_skin_dir("latest");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select></td>
  </tr>
  -->
  <tr bgcolor="#eeeeee">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">���� �ֱٱ� �÷� ��</td>
    <td class="list" colspan=2><input name="cb_latest_cols" type="radio" value="1">
      1��
      <input name="cb_latest_cols" type="radio" value="2">
      2��
      <input name="cb_latest_cols" type="radio" value="3">
      3��</td>
  </tr>

  <tr bgcolor="#eeeeee">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">�Խñ� ���� ���ڼ�</td>
    <td class="list" colspan=2><input name="cb_latest_len" type="text" id="cb_latest_len" class="ed" style="text-align:right;" value="<?=$cb[cb_latest_len]?>" size="10" itemname="������ڼ�" required></td>
  </tr>
  <tr bgcolor="#eeeeee">
    <td height="1" colspan="3"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">�Խñۼ�</td>
    <td class="list" colspan=2><input name="cb_latest_rows" type="text" id="cb_latest_rows" class="ed" style="text-align:right;" value="<?=$cb[cb_latest_rows]?>" size="10" itemname="�Խñۼ�" required>
      ��</td>
  </tr>

  <? if ($cb_coverstory_skin_path) { ?>
  <tr>
    <td height="1" colspan="3" bgcolor="#eeeeee"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">Ŀ�����丮 ��Ų</td>
    <td class="list"><select name="cb_coverstory_skin">
      <?
        $arr = get_club_skin_dir("coverstory");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select>
    </td>
    <td class="list"><select name="cb_coverstory_latest_skin">
      <?
        $arr = get_club_skin_dir("latest");
        echo "<option value=''>������������</option>\n";
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select>
    </td>
  </tr>
  </tr>
  <? } ?>

  <? if ($cb_notice_skin_path) { ?>
  <tr>
    <td height="1" colspan="3" bgcolor="#eeeeee"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">�������� ��Ų</td>
    <td class="list"><select name="cb_notice_skin">
      <?
        $arr = get_club_skin_dir("notice");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select></td>
    <td class="list"><select name="cb_notice_latest_skin">
      <?
        $arr = get_club_skin_dir("latest");
        echo "<option value=''>������������</option>\n";
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select>
    </td>
  </tr>
  <? } ?>
  
  <? if ($cb_board_skin_path) { ?>
  <tr>
    <td height="1" colspan="3" bgcolor="#eeeeee"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">�Խ��� ��Ų</td>
    <td class="list"><select name="cb_board_skin">
      <?
        $arr = get_club_skin_dir("board");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select></td>
    <td class="list"><select name="cb_board_latest_skin">
      <?
        $arr = get_club_skin_dir("latest");
        echo "<option value=''>������������</option>\n";
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select>
    </td>
  </tr>
  <? } ?>

  <? if ($cb_gallery_skin_path) { ?>
  <tr>
    <td height="1" colspan="3" bgcolor="#eeeeee"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">������ ��Ų</td>
    <td class="list"><select name="cb_gallery_skin">
      <?
        $arr = get_club_skin_dir("gallery");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select></td>
    <td class="list"><select name="cb_gallery_latest_skin">
      <?
        $arr = get_club_skin_dir("latest");
        echo "<option value=''>������������</option>\n";
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select>
    </td>
  </tr>
  <? } ?>

  <? if ($cb_jisik_skin_path) { ?>
  <tr>
    <td height="1" colspan="3" bgcolor="#eeeeee"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">���� ��Ų</td>
    <td class="list"><select name="cb_jisik_skin">
      <?
        $arr = get_club_skin_dir("jisik");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select></td>
    <td class="list"><select name="cb_jisik_latest_skin">
      <?
        $arr = get_club_skin_dir("latest");
        echo "<option value=''>������������</option>\n";
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select>
    </td>
  </tr>
  <? } ?>

  <? if ($cb_oneline_skin_path) { ?>
  <tr>
    <td height="1" colspan="3" bgcolor="#eeeeee"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">���ٰԽ��� ��Ų</td>
    <td class="list"><select name="cb_oneline_skin">
      <?
        $arr = get_club_skin_dir("oneline");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select></td>
    <td class="list"><select name="cb_oneline_latest_skin">
      <?
        $arr = get_club_skin_dir("latest");
        echo "<option value=''>������������</option>\n";
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select>
    </td>
  </tr>
  <? } ?>
 
  <? if ($cb_1to1_skin_path) { ?>
  <tr>
    <td height="1" colspan="3" bgcolor="#eeeeee"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">1:1�Խ��� ��Ų</td>
    <td class="list"><select name="cb_1to1_skin">
      <?
        $arr = get_club_skin_dir("1to1");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select></td>
    <td class="list"><select name="cb_1to1_latest_skin">
      <?
        $arr = get_club_skin_dir("latest");
        echo "<option value=''>������������</option>\n";
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select>
    </td>
  </tr>
  <? } ?>

  <? if ($cb_schedule_skin_path) { ?>
  <tr>
    <td height="1" colspan="3" bgcolor="#eeeeee"></td>
  </tr>  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">������ ��Ų</td>
    <td class="list"><select name="cb_schedule_skin">
      <?
        $arr = get_club_skin_dir("schedule");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select></td>
    <td class="list"><select name="cb_schedule_latest_skin">
      <?
        $arr = get_club_skin_dir("latest");
        echo "<option value=''>������������</option>\n";
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select>
    </td>
  </tr>
  <? } ?>

  <? if ($cb_link_skin_path) { ?>
  <tr>
    <td height="1" colspan="3" bgcolor="#eeeeee"></td>
  </tr>  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">��ũ�Խ��� ��Ų</td>
    <td class="list"><select name="cb_link_skin">
      <?
        $arr = get_club_skin_dir("link");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select></td>
    <td class="list"><select name="cb_link_latest_skin">
      <?
        $arr = get_club_skin_dir("latest");
        echo "<option value=''>������������</option>\n";
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select>
    </td>
  </tr>
  <? } ?>

  <? if ($cb_mart_skin_path) { ?>
  <tr>
    <td height="1" colspan="3" bgcolor="#eeeeee"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">���ͰԽ��� ��Ų</td>
    <td class="list"><select name="cb_mart_skin">
      <?
        $arr = get_club_skin_dir("mart");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select></td>
    <td class="list"><select name="cb_mart_latest_skin">
      <?
        $arr = get_club_skin_dir("latest");
        echo "<option value=''>������������</option>\n";
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select>
    </td>
  </tr>
  <? } ?>
  
  <? if ($cb_pds_skin_path) { ?>
  <tr>
    <td height="1" colspan="3" bgcolor="#eeeeee"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">�ڷ�� ��Ų</td>
    <td class="list"><select name="cb_pds_skin">
      <?
        $arr = get_club_skin_dir("pds");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select></td>
    <td class="list"><select name="cb_pds_latest_skin">
      <?
        $arr = get_club_skin_dir("latest");
        echo "<option value=''>������������</option>\n";
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select></td>
  </tr>
  <? } ?>
  
  <tr>
    <td height="1" colspan="3" bgcolor="#eeeeee"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">������ ��Ų</td>
    <td class="list" colspan=2><select name="cb_connect_skin">
      <?
        $arr = get_club_skin_dir("connect");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
        </select></td>
  </tr>

  <tr bgcolor="#CCCCCC">
    <td height="2" colspan="3"></td>
  </tr>
  <tr align="left">
    <td style="padding:5px 10px 5px 10px;" colspan="4">�Ʒ��� �����HTML ������ �����Դϴ�</td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="2" colspan="3"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">�����<BR>HTML EDITOR</td>
    <td colspan="3" class="list"><input type="checkbox" name="cb_latest_text_html" value="1" <?=$cb[cb_latest_text_html]?'checked':'';?>>
      Ŭ���빮�� HTML �����⸦ �� ��쿡 CHECK ���ּ���</td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">����� HTML</td>
    <td class="list" colspan=2>
    <textarea class=tx name=cb_latest_text rows=20 style='width:100%;'><?=stripslashes($cb[cb_latest_text])?></textarea>
    </td>
  </tr>

  <tr bgcolor="#CCCCCC">
    <td height="2" colspan="3"></td>
  </tr>
  <tr align="right">
    <td style="padding:5px 10px 5px 10px;" colspan="4"><input name="imageField" type="image" src="images/btn_confirm.gif" width="90" height="21" border="0"></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="2" colspan="3"></td>
  </tr>

</table>
</form>
<br><br><br><br><br><br>
<script language="JavaScript" type="text/JavaScript">
    f = document.fcmmain;
    
    <?
    if ($cb[cb_latest_use] == "N") {
        echo "f.cb_latest_use[1].checked = true;\n";
    }
    ?>

    //f.cb_latest_skin.value      = "<?=$cb[cb_latest_skin]?>";

    f.cb_latest_cols[<?=$cb[cb_latest_cols]-1?>].checked = true;
    f.cb_latest_len.value = "<?=$cb[cb_latest_len]?>";
    f.cb_latest_rows.value = "<?=$cb[cb_latest_rows]?>";

    f.cb_notice_skin.value  = "<?=$cb[cb_notice_skin]?>";
    f.cb_coverstory_skin.value  = "<?=$cb[cb_coverstory_skin]?>";

    if (typeof(f.cb_coverstory_skin) != 'undefined')
        f.cb_coverstory_skin.value       = "<?=$cb[cb_coverstory_skin]?>";
    if (typeof(f.cb_notice_skin) != 'undefined')
        f.cb_notice_skin.value       = "<?=$cb[cb_notice_skin]?>";
    if (typeof(f.cb_board_skin) != 'undefined')
        f.cb_board_skin.value       = "<?=$cb[cb_board_skin]?>";
    if (typeof(f.cb_gallery_skin) != 'undefined')
        f.cb_gallery_skin.value       = "<?=$cb[cb_gallery_skin]?>";
    if (typeof(f.cb_jisik_skin) != 'undefined')
        f.cb_jisik_skin.value       = "<?=$cb[cb_jisik_skin]?>";
    if (typeof(cb_oneline_skin) != 'undefined')
        f.cb_oneline_skin.value       = "<?=$cb[cb_oneline_skin]?>";
    if (typeof(cb_1to1_skin) != 'undefined')
        f.cb_1to1_skin.value       = "<?=$cb[cb_1to1_skin]?>";
    if (typeof(cb_schedule_skin) != 'undefined')
        f.cb_schedule_skin.value       = "<?=$cb[cb_schedule_skin]?>";
    if (typeof(cb_link_skin) != 'undefined')
        f.cb_link_skin.value       = "<?=$cb[cb_link_skin]?>";
    if (typeof(cb_mart_skin) != 'undefined')
        f.cb_mart_skin.value       = "<?=$cb[cb_mart_skin]?>";
    if (typeof(cb_pds_skin) != 'undefined')
        f.cb_pds_skin.value       = "<?=$cb[cb_pds_skin]?>";

    if (typeof(f.cb_coverstory_latest_skin) != 'undefined')
        f.cb_coverstory_latest_skin.value       = "<?=$cb[cb_coverstory_latest_skin]?>";
    if (typeof(f.cb_notice_latest_skin) != 'undefined')
        f.cb_notice_latest_skin.value       = "<?=$cb[cb_notice_latest_skin]?>";
    if (typeof(f.cb_board_latest_skin) != 'undefined')
        f.cb_board_latest_skin.value       = "<?=$cb[cb_board_latest_skin]?>";
    if (typeof(f.cb_gallery_latest_skin) != 'undefined')
        f.cb_gallery_latest_skin.value       = "<?=$cb[cb_gallery_latest_skin]?>";
    if (typeof(f.cb_jisik_latest_skin) != 'undefined')
        f.cb_jisik_latest_skin.value       = "<?=$cb[cb_jisik_latest_skin]?>";
    if (typeof(f.cb_oneline_latest_skin) != 'undefined')
        f.cb_oneline_latest_skin.value       = "<?=$cb[cb_oneline_latest_skin]?>";
    if (typeof(f.cb_1to1_latest_skin) != 'undefined')
        f.cb_1to1_latest_skin.value       = "<?=$cb[cb_1to1_latest_skin]?>";
    if (typeof(f.cb_schedule_latest_skin) != 'undefined')
        f.cb_schedule_latest_skin.value       = "<?=$cb[cb_schedule_latest_skin]?>";
    if (typeof(f.cb_link_latest_skin) != 'undefined')
        f.cb_link_latest_skin.value       = "<?=$cb[cb_link_latest_skin]?>";
    if (typeof(f.cb_mart_latest_skin) != 'undefined')
        f.cb_mart_latest_skin.value       = "<?=$cb[cb_mart_latest_skin]?>";
    if (typeof(f.cb_pds_latest_skin) != 'undefined')
        f.cb_pds_latest_skin.value       = "<?=$cb[cb_pds_latest_skin]?>";
    if (typeof(f.cb_connect_skin) != 'undefined')
        f.cb_connect_skin.value  = "<?=$cb[cb_connect_skin]?>";

</script>

<?
include "$nc[cb_path]/tail.sub.php";
?>
