<?
// 게시물 검색 폼
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
                    <td align="center"><strong>게시물 검색</strong>
                      <select name="ca_name" id="ca_name">
                        <option value="0">게시판</option>
                        <option value="<?=$row[cc_id]?>"><?=$row[cc_name]?></option>
                      </select>
                      <select name=sfl>
                        <option value='wr_subject'>제목</option>
                        <option value='wr_content'>내용</option>
                        <option value='mb_id'>회원아이디</option>
                        <option value='wr_name'>이름</option>
                      </select>
                      <input maxlength=30 size=30 name=stx itemname="검색어" required value="">
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
