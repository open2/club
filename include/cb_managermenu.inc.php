<table width="100%" border="0" cellspacing="0" >
  <tr>
    <td bgcolor="<?=$cb[cb_box_bg_skin]?>"><table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td bgcolor="<?=$cb[cb_box_line_skin]?>"><table width="100%" border="0" cellpadding="0" cellspacing="6" bgcolor="#FFFFFF">
              <tr>
                <td style="padding:5px 0px 0px 5px"><strong>Ŭ������</strong></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#EEEEEE"></td>
              </tr>
              <tr>
                <td align="left" class="gmenu">�⺻ ���� ����</td>
              </tr>
              <tr>
                <td align="left" class="cmenu"><img src="./images/bu_ar.gif" width="10" height="11" align="absmiddle"> <a href="./cm_default.php?doc=cm_default.php&cb_id=<?=$cb[cb_id]?>" target="CLUB_BODY">�⺻ ����</a></td>
              </tr>
              <tr>
                <td align="left" class="cmenu"><img src="./images/bu_ar.gif" width="10" height="11" align="absmiddle"> <a href="./cm_join.php?doc=cm_join.php&cb_id=<?=$cb[cb_id]?>" target="CLUB_BODY">���� ����</a></td>
              </tr>
              <tr>
                <td height="1" background="images/bg_dot02.gif"></td>
              </tr>
              <tr>
                <td align="left" class="gmenu">������ ����</td>
              </tr>
              <tr>
                <td align="left" class="cmenu"><img src="./images/bu_ar.gif" width="10" height="11" align="absmiddle"> <a href="./cm_main.php?doc=cm_main.php&cb_id=<?=$cb[cb_id]?>" target="CLUB_BODY">���� ����</a></td>
              </tr>
              <tr>
                <td align="left" class="cmenu"><img src="./images/bu_ar.gif" width="10" height="11" align="absmiddle"> <a href="./cm_design.php?doc=cm_design.php&cb_id=<?=$cb[cb_id]?>" target="CLUB_BODY">������ ����</a></td>
              </tr>
              <tr>
                <td height="1" background="images/bg_dot02.gif"></td>
              </tr>
              <tr>
                <td align="left" class="gmenu">�޴�����</td>
              </tr>
              <tr>
                <td align="left" class="cmenu"><img src="./images/bu_ar.gif" width="10" height="11" align="absmiddle"> <a href="./cm_menu.php?doc=cm_menu.php&cb_id=<?=$cb[cb_id]?>" target="CLUB_BODY">�޴� ����</a></td>
              </tr>
              <tr>
                <td align="left" class="cmenu"><img src="./images/bu_ar.gif" width="10" height="11" align="absmiddle"> <a href="./cm_menulevel.php?doc=cm_menulevel.php&cb_id=<?=$cb[cb_id]?>" target="CLUB_BODY">�޴� ���� ����</a></td>
              </tr>
              <tr>
                <td height="1" background="images/bg_dot02.gif"></td>
              </tr>
              <tr>
                <td align="left" class="gmenu">ȸ������</td>
              </tr>
              <tr>
                <td align="left" class="cmenu"><img src="./images/bu_ar.gif" width="10" height="11" align="absmiddle"> <a href="./cm_member_list.php?doc=cm_member_list.php&cb_id=<?=$cb[cb_id]?>" target="CLUB_BODY">��ü ȸ�� ����</a></td>
              </tr>
              <tr>
                <td align="left" class="cmenu"><img src="./images/bu_ar.gif" width="10" height="11" align="absmiddle"> <a href="./cm_member_level.php?doc=cm_member_level.php&cb_id=<?=$cb[cb_id]?>" target="CLUB_BODY">ȸ�� ��� ����</a></td>
              </tr>
              <tr>
                <td align="left" class="cmenu"><img src="./images/bu_ar.gif" width="10" height="11" align="absmiddle"> <a href="./cm_message.php?doc=cm_message.php&cb_id=<?=$cb[cb_id]?>" target="CLUB_BODY">ȸ�� ���� ������</a></td>
              </tr>
              <tr>
                <td height="1" background="images/bg_dot02.gif"></td>
              </tr>
              <tr>
                <td align="left" class="gmenu">Ŭ������</td>
              </tr>
              <tr>
                <td align="left" class="cmenu">
                <img src="./images/bu_ar.gif" width="10" height="11" align="absmiddle"> 
                <a href="./cm_unlist.php?cb_id=<?=$cb[cb_id]?>" target="CLUB_BODY">�Ⱥ��̴°Խñ�</a></td>
              </tr>
              <tr>
                <td align="left" class="cmenu">
                <img src="./images/bu_ar.gif" width="10" height="11" align="absmiddle"> 
                <a href="./cm_stat.php?cb_id=<?=$cb[cb_id]?>" target="CLUB_BODY">Ŭ�����</a></td>
              </tr>
              <tr>
                <td align="left" class="cmenu">
                <img src="./images/bu_ar.gif" width="10" height="11" align="absmiddle"> 
                <a href="./cm_club_transfer.php?cb_id=<?=$cb[cb_id]?>" target="CLUB_BODY">Ŭ���絵</a></td>
              </tr>

              <?
              if ($cb[cb_type] == 3) {
              ?>
              <tr>
                <td align="left" class="cmenu">
                <img src="./images/bu_ar.gif" width="10" height="11" align="absmiddle"> 
                <a href="./cm_club_invite.php?cb_id=<?=$cb[cb_id]?>" target="CLUB_BODY">ȸ���ʴ�</a></td>
              </tr>
              <? } ?>

              <tr>
                <td height="1"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
