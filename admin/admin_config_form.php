<?
include_once "./_common.php";

$g4[title] = "Ŭ������";
include_once "$nc[cb_path]/head.sub.php";
?>

<form name="adminconfigform" method="post" action="./admin_config_form.update.php" onSubmit="return form_check();">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" colspan="4"><strong>ȯ�� ����</strong> (Ŭ��DB����: <?=$nc[nf_version]?>)</td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="3" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� Ÿ��Ʋ</td>
    <td colspan="3" class="list"><input type="text" name="nf_title" value="<?=$nc[nf_title]?>" style="width:80%;"></td>
  </tr>
  <tr>
    <td height="1" colspan="4" bgcolor="#EEEEEE"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ��ü��</td>
    <td class="list"><input type="text" name="nf_width" size="10" value="<?=$nc[nf_width]?>" required itemname="��ü��" style="text-align:right;">
      100 ���ϴ� %</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ��ġ</td>
    <td class="list"><select name="nf_align">
        <option value="left">��������</option>
        <option value="center">�߾�����</option>
        <option value="right">����������</option>
      </select></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ��� title ����</td>
    <td class="list"><input type="text" name="title_img_height" size="10" value="<?=$nc[title_img_height]?>" required itemname="��� title �̹��� ����" style="text-align:right;">
    </td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu"></td>
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ���� ���</td>
    <td colspan="3" class="list"><input type="checkbox" name="nf_opentype" value="1">
      ������ ������ ����</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ���� ����</td>
    <td colspan="3" class="list"><?=get_member_level_select('nf_open_level', 2, 10, $nc[nf_open_level]) ?>
      �������� Ŭ���� ���� �� �ֽ��ϴ�</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ���� ����</td>
    <td colspan="3" class="list"><input type="text" name="nf_limits" size="10" value="<?=$nc[nf_limits]?>" style="text-align:right;">
      1�δ� Ŭ�� ���� ���Ѽ� (0�� ���Ѵ�)</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ���� ���� ����</td>
    <td colspan="3" class="list"><input type="text" name="nf_title_change_limits" size="10" value="<?=$nc[nf_title_change_limits]?>" style="text-align:right;">
      ������ �Ⱓ�� ���� ���Ŀ� Ŭ������ ������ �� �ֽ��ϴ�. (0�� �׻󺯰氡��, �⺻�� 30��)</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">���б� ����Ʈ</td>
    <td class="list"><input type="text" name="nf_read_point" id="nf_read_point" required itemname="���б� ����Ʈ" value="<?=$nc[nf_read_point]?>" size="10" style="text-align:right;"></td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">�۾��� ����Ʈ</td>
    <td class="list"><input type="text" name="nf_write_point" id="nf_write_point" required itemname="�۾��� ����Ʈ" value="<?=$nc[nf_write_point]?>" size="10" style="text-align:right;"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">�ڸ�Ʈ���� ����Ʈ</td>
    <td class="list"><input type="text" name="nf_comment_point" id="nf_comment_point" required itemname="�ڸ�Ʈ���� ����Ʈ" value="<?=$nc[nf_comment_point]?>" size="10" style="text-align:right;"></td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">�ٿ�ε� ����Ʈ</td>
    <td class="list"><input type="text" name="nf_download_point" id="nf_download_point" required itemname="�ٿ�ε� ����Ʈ" value="<?=$nc[nf_download_point]?>" size="10" style="text-align:right;"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">&nbsp;</td>
    <td class="list" colspan=3>
    Ŭ���� �۾���, ���б� ���� �� �� ȸ�� �����ο��� �ο��ϴ� ����Ʈ �Դϴ�.<br>
    Ŭ������Ʈ�� �״������� �⺻ ���� ����Ʈ�� ���� �մϴ�. <br>
    ����, <b>Ŭ���� ����Ʈ�� �����ϸ� �״������� �⺻ ����Ʈ�� ���� �˴ϴ�</b>. <br>
    �̴� ���� Ŭ������ ����Ʈ�� �ο��� �� ���� �� �ִ� ������ ���� ���� �Դϴ�.</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ����Ʈ<br>��� ���</td>
    <td class="list"><select name="nf_point_use">
        <option value="1">������</option>
        <option value="2">�����������</option>
        <option value="3">���Ա�ι��</option>
      </select>
      <table>
        <tr><td>����������� : Ŭ�����Խ� ���� ����Ʈ�� Ŭ���� ����</td></tr>
        <tr><td>���Ա�ι�� : Ŭ�����Խ� ȸ�� ����Ʈ�� Ŭ���� ���</td></tr>
      </table>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">���� ����Ʈ</td>
      
    <td class="list"><input type="text" name="nf_save_point" id="nf_save_point" value="<?=$nc[nf_save_point]?>" size="10" style="text-align:right;"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">���б� �α⵵</td>
    <td class="list"><input type="text" name="nf_read_popular" id="nf_read_popular" required itemname="���б� �α⵵" value="<?=$nc[nf_read_popular]?>" size="10" style="text-align:right;"></td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">�۾��� �α⵵</td>
    <td class="list"><input type="text" name="nf_write_popular" id="nf_write_popular" required itemname="�۾��� �α⵵" value="<?=$nc[nf_write_popular]?>" size="10" style="text-align:right;"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">�ڸ�Ʈ���� �α⵵</td>
    <td class="list"><input type="text" name="nf_comment_popular" id="nf_comment_popular" required itemname="�ڸ�Ʈ���� �α⵵" value="<?=$nc[nf_comment_popular]?>" size="10" style="text-align:right;"></td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">�ٿ�ε� �α⵵</td>
    <td class="list"><input type="text" name="nf_download_popular" id="nf_download_popular" required itemname="�ٿ�ε� �α⵵" value="<?=$nc[nf_download_popular]?>" size="10" style="text-align:right;"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">&nbsp;</td>
    <td class="list" colspan=3>
    Ŭ���� Ȱ���� ���� Ŭ���� �ο��Ǵ� �α⵵ �Դϴ�.<br>
    ��� Ŭ���� ������ �������� ����Ǿ �α⵵�� �����ϰ� �˴ϴ�.<br>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� �Խ��� ��Ų</td>
    <td class="list" colspan=3><select name="nf_bo_skin">
      <?
        $arr = get_skin_dir("board");
        for ($i=0; $i<count($arr); $i++) {
          if(stristr($arr[$i],'CLUB')) {    // ��ҹ��� �����ϰ� CLUB�� �����ϰ��ִٸ� 
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
          }
        }
      ?>
    </select> �� Ŭ�� ��Ų�� �������ִ� ��Ų ($g4[path]/skin/board/ ���丮���� �̸��� club�� �ִ� ���丮�� �������)</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� �α��� ��Ų</td>
    <td width="300" class="list"><select name="nf_outlogin_skin">
      <?
        $arr = get_club_skin_dir("outlogin");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> �� Ŭ�� �α��� ��Ų</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">&nbsp;</td>
    <td width="300" class="list">&nbsp;</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">�������� ��Ų</td>
    <td width="300" class="list"><select name="nf_bo_notice_skin">
      <?
        $arr = get_club_skin_dir("notice");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> �� Ŭ�� ������ �⺻ ��Ų</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŀ�����丮 ��Ų</td>
    <td width="300" class="list"><select name="nf_bo_coverstory_skin">
      <?
        $arr = get_club_skin_dir("coverstory");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> �� Ŭ�� ������ �⺻ ��Ų</td>
  </tr>  
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">�Խ��� ��Ų</td>
    <td width="300" class="list"><select name="nf_bo_board_skin">
      <?
        $arr = get_club_skin_dir("board");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> �� Ŭ�� ������ �⺻ ��Ų</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">������ ��Ų</td>
    <td width="300" class="list"><select name="nf_bo_gallery_skin">
      <?
        $arr = get_club_skin_dir("gallery");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> �� Ŭ�� ������ �⺻ ��Ų</td>
  </tr>  
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">���� ��Ų</td>
    <td width="300" class="list"><select name="nf_bo_jisik_skin">
      <?
        $arr = get_club_skin_dir("jisik");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> �� Ŭ�� ������ �⺻ ��Ų</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">���� ��Ų</td>
    <td width="300" class="list"><select name="nf_bo_oneline_skin">
      <?
        $arr = get_club_skin_dir("oneline");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> �� Ŭ�� ������ �⺻ ��Ų</td>
  </tr>  
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">1:1 ��Ų</td>
    <td width="300" class="list"><select name="nf_bo_1to1_skin">
      <?
        $arr = get_club_skin_dir("1to1");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> �� Ŭ�� ������ �⺻ ��Ų</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">������ ��Ų</td>
    <td width="300" class="list"><select name="nf_bo_schedule_skin">
      <?
        $arr = get_club_skin_dir("schedule");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> �� Ŭ�� ������ �⺻ ��Ų</td>
  </tr>  
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">��ũ ��Ų</td>
    <td width="300" class="list"><select name="nf_bo_link_skin">
      <?
        $arr = get_club_skin_dir("link");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> �� Ŭ�� ������ �⺻ ��Ų</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">�ڷ�� ��Ų</td>
    <td width="300" class="list"><select name="nf_bo_pds_skin">
      <?
        $arr = get_club_skin_dir("pds");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> �� Ŭ�� ������ �⺻ ��Ų</td>
  </tr>  
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">���� ��Ų</td>
    <td width="300" class="list"><select name="nf_bo_mart_skin">
      <?
        $arr = get_club_skin_dir("mart");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> �� Ŭ�� ������ �⺻ ��Ų</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">&nbsp;</td>
    <td width="300" class="list">&nbsp;</td>
  </tr>  
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>

  
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">�ֱٰԽñ� ��Ų</td>
    <td width="300" class="list"><select name="nf_latest_default_skin">
      <?
        $arr = get_club_skin_dir("latest");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> �� Ŭ�� ������ �⺻ �ֽű� ��Ų</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">������ ��Ų</td>
    <td width="300" class="list"><select name="nf_connect_default_skin">
      <?
        $arr = get_club_skin_dir("connect");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select></td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu"></td>
    <td width="300" class="list">
    </td>
  </tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">�˻� ��Ų</td>
    <td width="300" class="list"><select name="nf_search_default_skin">
      <?
        $arr = get_club_skin_dir("search");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ����<BR>HTML EDITOR</td>
    <td colspan="3" class="list"><input type="checkbox" name="nf_maintext_html" value="1">
      Ŭ�����ο� HTML �����⸦ �� ��쿡 CHECK ���ּ���</td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ���� ����</td>
    <td colspan="3" class="list">
    <textarea name="nf_maintext" rows="10" style="width:80%;"><?=stripslashes($nc[nf_maintext])?></textarea>
    <br>Ŭ���� �ʱ�ȭ�鿡 ���� ���̾ƿ� ���� �Դϴ�.
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ���͸�</td>
    <td colspan="3" class="list">
    <textarea name="nf_filter" rows="3" style="width:80%;"><?=$nc[nf_filter]?></textarea>
    <br>�Էµ� �ܾ ���Ե� ������ ����� �� �����ϴ�. �ܾ�� �ܾ� ���̴� ,�� �����մϴ�.
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� ���� random �Ⱓ</td>
    <td colspan="3" class="list"><input type="text" name="nf_random_days" size="95" value="<?=$nc[nf_random_days]?>">
    <br>Ŭ�� ������ ������������, ����Ŀ�����丮�� �����ϴ� �Ⱓ�� ����</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� �ʱ� �޴� </td>
    <td colspan="3" class="list"><input type="text" name="nf_menu_list" size="95" value="<?=$nc[nf_menu_list]?>">
      '|'�� ����</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� �ʱ�<BR>HTML ���</td>
    <td colspan="3" class="list"><input type="checkbox" name="nf_club_text_use" value="1" <?=$nc[nf_club_text_use]?'checked':'';?>>
      ������ Ŭ���� �ʱ�ȭ���� html ���� �ڵ带 �����Ϸ��� ��� CHECK ���ּ���</td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">Ŭ�� �ʱ� html</td>
    <td colspan="3" class="list">
      <textarea name="nf_club_text" rows="10" style="width:80%;"><?=stripslashes($nc[nf_club_text])?></textarea>
      <br>������ Ŭ���� �ʱ���ο� ���� html �ڵ带 �������ݴϴ�.</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">Ŭ�� �̿� ��� </td>
    <td colspan="3" class="list"><textarea name="nf_clause" rows="10" style="width:80%;"><?=$nc[nf_clause]?></textarea></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="2" colspan="4"></td>
  </tr>
  <tr>
    <td colspan="4" align="center" style="padding:5px 10px 5px 10px;"><input type="submit" name="Submit" value=" Ȯ  �� "></td>
  </tr>
</table>
</form>
<br><br><br><br><br><br>
<script language="JavaScript" type="text/JavaScript">
    var f = document.adminconfigform;
    
    f.nf_bo_skin.value        = "<?=$nc[nf_bo_skin]?>";
    f.nf_outlogin_skin.value  = "<?=$nc[nf_outlogin_skin]?>";
    
    f.nf_align.value          = "<?=$nc[nf_align]?>";
    f.nf_point_use.value      = "<?=$nc[nf_point_use]?>";
    f.nf_save_point.value     = "<?=$nc[nf_save_point]?>";
    
    f.nf_bo_notice_skin.value  = "<?=$nc[nf_bo_notice_skin]?>";
    f.nf_bo_coverstory_skin.value  = "<?=$nc[nf_bo_coverstory_skin]?>";
    f.nf_bo_board_skin.value  = "<?=$nc[nf_bo_board_skin]?>";
    f.nf_bo_gallery_skin.value  = "<?=$nc[nf_bo_gallery_skin]?>";
    f.nf_bo_jisik_skin.value  = "<?=$nc[nf_bo_jisik_skin]?>";
    f.nf_bo_oneline_skin.value  = "<?=$nc[nf_bo_oneline_skin]?>";
    f.nf_bo_1to1_skin.value  = "<?=$nc[nf_bo_1to1_skin]?>";
    f.nf_bo_schedule_skin.value  = "<?=$nc[nf_bo_schedule_skin]?>";
    f.nf_bo_link_skin.value  = "<?=$nc[nf_bo_link_skin]?>";
    f.nf_bo_pds_skin.value  = "<?=$nc[nf_bo_pds_skin]?>";
    f.nf_bo_mart_skin.value  = "<?=$nc[nf_bo_mart_skin]?>";

    f.nf_latest_default_skin.value  = "<?=$nc[nf_latest_default_skin]?>";
    f.nf_connect_default_skin.value  = "<?=$nc[nf_connect_default_skin]?>";
    f.nf_search_default_skin.value  = "<?=$nc[nf_search_default_skin]?>";

    <? if ($nc[nf_opentype] == 1) { echo "f.nf_opentype.checked = true;"; } ?>
    <? if ($nc[nf_maintext_html] == 1) { echo "f.nf_maintext_html.checked = true;"; } ?>

    function form_check()
    {
        if (f.nf_point_use.value == 2) {
            if (f.nf_save_point.value == "" || f.nf_save_point.value == 0) {
                alert("��������Ʈ�� �Է��ϼ���");
                f.nf_save_point.focus();
                return false;
            } else {
                return;
            }
        } else {
            return;
        }
    }
</script>

<?
include_once("$nc[cb_path]/tail.sub.php");
?>
