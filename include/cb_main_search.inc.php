<?
// �Խù� �˻� ��
?>
<table width="100%"  border="0" cellpadding="3" cellspacing="0" bgcolor="<?=$cb[cb_box_bg_skin]?>">
  <tr>
    <td><table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="<?=$cb[cb_box_line_skin]?>">
        <tr>
          <td><table width="100%"  border="0" cellpadding="10" cellspacing="0" bgcolor="#FFFFFF">
            <form name="fcbsearch" method="post" action="">
            <tr>
              <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center"><strong>�Խù� �˻�</strong>
                      <select name="ca_name" id="ca_name">
                        <option value="0">�Խ���</option>
                        <option value="<?=$row[cc_id]?>"><?=$row[cc_name]?></option>
                      </select>
                      <select name=sfl>
                        <option value='wr_subject'>����</option>
                        <option value='wr_content'>����</option>
                        <option value='mb_id'>ȸ�����̵�</option>
                        <option value='wr_name'>�̸�</option>
                      </select>
                      <input maxlength=30 size=30 name=stx itemname="�˻���" required value="">
                      <input name="imageField" type="image" src="images/btn_search.gif" align="absmiddle" width="47" height="21" border="0"></td>
                  </tr>
                </table></td>
            </tr>
            </form>
            </table></td>
        </tr>
    </table></td>
  </tr>
</table>
