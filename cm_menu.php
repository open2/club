<?
include_once "./_common.php";

$g4[title] = "$cb[cb_name]:Ŭ���޴����� - $nc[nf_title]";

include_once "$nc[cb_path]/head.sub.php";
?>

<script language="javascript">

var mObjCnt=0;        // �޴��� ����
var m = new Array();  // �޴��� �����ϴ� �迭

function MenuObject(cn_id,cn_type,cn_name,cn_url,tmp_name)
{
	this.cn_id = cn_id;
	this.cn_type = cn_type;
	this.cn_name = cn_name;
	this.cn_url = cn_url;
	this.tmp_name = tmp_name;
	mObjCnt++;
}

function AddMenuSelect(value)
{
	var menu = m[value];

	// 'N', 'C', 'B', 'I', 'K', 'O', 'T', 'S', 'A', 'J', 'P', 'G', 'U', 'L'
	switch(menu.cn_type)
	{
    case 'N' : text="[��������]"; break;
		case 'C' : text="[Ŀ�����丮]"; break;
		case 'B' : text="[�ϹݰԽ���]"; break;
		case 'I' : text="[������]"; break;
		case 'K' : text="[���İԽ���]"; break;
		case 'O' : text="[���ٰԽ���]"; break;
		case 'T' : text="[1:1�Խ���]"; break;
		case 'S' : text="[������Խ���]"; break;
		case 'A' : text="[��ũ�Խ���]"; break;
		case 'J' : text="[���ͰԽ���]"; break;
		case 'P' : text="[�ڷ�Խ���]"; break;
		case 'U' : text="[��ũ]"; break;
		case 'L' : text="[���м�-----------]"; break;
		case 'G' : text="[�׷��]"; break;
		default : break;
	}

  text += menu.cn_name;

	var clubMenu = document.getElementById("ClubMenu");
	var oOption = document.createElement("OPTION");

	document.getElementById("ClubMenu").options.add(oOption);

	oOption.innerText = text;
	oOption.value = value;

	PreviewMenu();
}

function DeleteClubMenu()
{
	var clubMenu = document.getElementById("ClubMenu");
	var delIdx = document.getElementById("ClubMenu").options[clubMenu.selectedIndex].value;

  if ( m[clubMenu.selectedIndex].cn_type == 'N')
      alert ("�������� �޴��� ������ �� �����ϴ�");
  else if ( m[clubMenu.selectedIndex].cn_type == 'C')
      alert ("Ŀ�����丮 �޴��� ������ �� �����ϴ�");
  else {
    	clubMenu.options.remove(clubMenu.selectedIndex);
    	document.menu.menu.value="";
    	document.menu.link.value="";

    	m[delIdx].cn_type='X';
  }

	PreviewMenu();
}

function AddClubMenu()
{
	var menuCategory = document.getElementById("MenuCategory");
	var clubMenu = document.getElementById("ClubMenu");
	var newcn_type = menuCategory.options[menuCategory.selectedIndex].value;
	var newcn_name = "";
	var newIdx = parseInt(mObjCnt);

	document.menu.menu.disabled=false;
	document.menu.link.disabled=false;

	// 'N', 'C', 'B', 'I', 'K', 'O', 'T', 'S', 'A', 'J', 'P', 'G', 'U', 'L'
	switch(newcn_type)
	{
		case 'N' :
			newcn_name="��������";
			document.menu.menu.value="��������";
			document.menu.link.value="";
			document.menu.menu.focus();
			document.menu.link.disabled=true;
			break;
		case 'C' :
			newcn_name="Ŀ�����丮";
			document.menu.menu.value="Ŀ�����丮";
			document.menu.link.value="";
			document.menu.menu.focus();
			document.menu.link.disabled=true;
			break;
		case 'B' :
		{
			newcn_name="�ϹݰԽ���";
			document.menu.menu.value="�ϹݰԽ���";
			document.menu.link.value="";
			document.menu.menu.focus();
			document.menu.link.disabled=true;
			break;
		}
		case 'I' :
		{
			newcn_name="������";
			document.menu.menu.value="������";
			document.menu.link.value="";
			document.menu.menu.focus();
			document.menu.link.disabled=true;
			break;
		}
		case 'K' :
		{
			newcn_name="���İԽ���";
			document.menu.menu.value="���İԽ���";
			document.menu.link.value="";
			document.menu.menu.focus();
			document.menu.link.disabled=true;
			break;
		}
		case 'O' :
		{
			newcn_name="���ٰԽ���";
			document.menu.menu.value="���ٰԽ���";
			document.menu.link.value="";
			document.menu.menu.focus();
			document.menu.link.disabled=true;
			break;
		}
		case 'T' :
		{
			newcn_name="1:1�Խ���";
			document.menu.menu.value="1:1�Խ���";
			document.menu.link.value="";
			document.menu.menu.focus();
			document.menu.link.disabled=true;
			break;
		}
		case 'S' :
		{
			newcn_name="������Խ���";
			document.menu.menu.value="������Խ���";
			document.menu.link.value="";
			document.menu.menu.focus();
			document.menu.link.disabled=true;
			break;
		}
		case 'A' :
		{
			newcn_name="��ũ�Խ���";
			document.menu.menu.value="��ũ�Խ���";
			document.menu.link.value="";
			document.menu.menu.focus();
			document.menu.link.disabled=true;
			break;
		}
		case 'J' :
		{
			newcn_name="���ͰԽ���";
			document.menu.menu.value="���ͰԽ���";
			document.menu.link.value="";
			document.menu.menu.focus();
			document.menu.link.disabled=true;
			break;
		}
		case 'P' :
		{
			newcn_name="�ڷ�Խ���";
			document.menu.menu.value="�ڷ�Խ���";
			document.menu.link.value="";
			document.menu.menu.focus();
			document.menu.link.disabled=true;
			break;
		}
		case 'U' :
		{
			newcn_name="��ũ";
			document.menu.menu.value="��ũ";
			document.menu.link.value="";
			document.menu.menu.focus();
			document.menu.link.value="http://";
			break;
		}
		case 'L' : // ���м�
		{
			newcn_name="";
			document.menu.menu.value="";
			document.menu.link.value="";
			document.menu.menu.disabled=true;
			document.menu.link.disabled=true;
			break;
		}
		case 'G' :
		{
			newcn_name="�׷��";
			document.menu.menu.value="�׷��";
			document.menu.link.value="";
			document.menu.menu.focus();
			document.menu.link.disabled=true;
			break;
		}
		default :
		{
			newcn_name="ERROR";
			document.menu.menu.value="ERROR";
			document.menu.link.value="";
			document.menu.menu.focus();
			document.menu.link.disabled=true;
			break;
		}
	}

	m[newIdx] = new MenuObject('',newcn_type,newcn_name,'','');

	if(clubMenu.selectedIndex>=0)
		AddMenuSelect(newIdx,clubMenu.selectedIndex);
	else
	{
		clubMenu.selectedIndex=0;
		AddMenuSelect(newIdx);
		clubMenu.selectedIndex=newIdx;
	}
}

function MoveMenuUp()
{
	var clubMenu = document.getElementById("ClubMenu");
	for (var i = 0; i < clubMenu.options.length; i++)
	{
		if (clubMenu.options[i].selected && clubMenu.options[i] != "" && clubMenu.options[i] != clubMenu.options[0])
		{
			var idx = clubMenu.selectedIndex;
			var tmpval = clubMenu.options[i].value;
			var tmpval2 = clubMenu.options[i].text;
			clubMenu.options[i].value = clubMenu.options[i - 1].value;
			clubMenu.options[i].text = clubMenu.options[i - 1].text
			clubMenu.options[i - 1].value = tmpval;
			clubMenu.options[i - 1].text = tmpval2;
			clubMenu.options[idx - 1].selected = true;
			break;
		}
	}
	PreviewMenu();
}

function MoveMenuDn()
{
	var clubMenu = document.getElementById("ClubMenu");
	for(var i = 0; i < clubMenu.options.length; i++)
	{
		if (clubMenu.options[i].selected && clubMenu.options[i] != "" && clubMenu.options[i + 1] != clubMenu.options[clubMenu.options.length])
		{
			var idx = clubMenu.selectedIndex;
			var tmpval = clubMenu.options[i].value;
			var tmpval2 = clubMenu.options[i].text;
			clubMenu.options[i].value = clubMenu.options[i+1].value;
			clubMenu.options[i].text = clubMenu.options[i+1].text
			clubMenu.options[i + 1].value = tmpval;
			clubMenu.options[i + 1].text = tmpval2;
			clubMenu.options[idx + 1].selected = true;
			break;
		}
	}
	PreviewMenu();
}

// 'N', 'C', 'B', 'I', 'K', 'O', 'T', 'S', 'A', 'J', 'P', 'G', 'U', 'L'
function PreviewMenu()
{
	var clubMenu = document.getElementById("ClubMenu");
	var preview  = "";
	for(i=0; i <clubMenu.options.length; i++)
	{
		var idx = clubMenu.options[i].value;
		var pcn_type=m[idx].cn_type;

		preview += "<tr>";		
		switch (pcn_type) 
		{
		  case 'N'  :
            			preview += "<td align='left' valign='top' class='cmenu'><img src='./images/ico_note_notice.gif' align='absmiddle'> ";
            			preview += m[idx].cn_name;
            			break;
		  case 'C'  :
            			preview += "<td align='left' valign='top' class='cmenu'><img src='./images/ico_note_coverstory.gif' align='absmiddle'> ";
            			preview += m[idx].cn_name;
            			break;
      case 'B' : 
            			preview += "<td align='left' valign='top' class='cmenu'><img src='./images/ico_note.gif' align='absmiddle'> ";
            			preview += m[idx].cn_name;
            			break;
      case 'I' :
            			preview += "<td align='left' valign='top' class='cmenu'><img src='./images/ico_note_album.gif' align='absmiddle'> ";
            			preview += m[idx].cn_name;
            			break;
      case 'K' :
            			preview += "<td align='left' valign='top' class='cmenu'><img src='./images/ico_note_knowledge.gif' align='absmiddle'> ";
            			preview += m[idx].cn_name;
                  break;
      case 'O' :
            			preview += "<td align='left' valign='top' class='cmenu'><img src='./images/ico_note_oneline.gif' align='absmiddle'> ";
            			preview += m[idx].cn_name;
            			break;
      case 'T' : 
            			preview += "<td align='left' valign='top' class='cmenu'><img src='./images/ico_note_1to1.gif' align='absmiddle'> ";
            			preview += m[idx].cn_name;
            			break;
      case 'S' : 
            			preview += "<td align='left' valign='top' class='cmenu'><img src='./images/ico_note_schedule.gif' align='absmiddle'> ";
            			preview += m[idx].cn_name;
            			break;
      case 'A' : 
            			preview += "<td align='left' valign='top' class='cmenu'><img src='./images/ico_note_link.gif' align='absmiddle'> ";
            			preview += m[idx].cn_name;
            			break;
      case 'J' : 
            			preview += "<td align='left' valign='top' class='cmenu'><img src='./images/ico_note_mart.gif' align='absmiddle'> ";
            			preview += m[idx].cn_name;
            			break;
      case 'P' : 
            			preview += "<td align='left' valign='top' class='cmenu'><img src='./images/ico_note_pda.gif' align='absmiddle'> ";
            			preview += m[idx].cn_name;
                  break;
      case 'G' : 
            			preview += "<td align='left' valign='top' class='gmenu'> <strong>"+ m[idx].cn_name +"</strong>";
            			break;
      case 'U' :
            			preview += "<td align='left' valign='top' class='cmenu'><img src='./images/ico_note_link.gif' align='absmiddle'> ";
            			preview += m[idx].cn_name;
                  break;
      case 'L' : 
            			preview += "<td height='1' background='./images/bg_dot02.gif'>";
            			break;
      default : 
            			preview += "<td align='left' valign='top' class='cmenu'><img src='./images/ico_note.gif' align='absmiddle'> ";
            			preview += m[idx].cn_name;
	    }
 			preview += "</td>";
 			preview += "</tr>";

	}

	if(preview)
	{
		var setHtml = "";
		setHtml += "<table width='100%'  border='0' cellpadding='1' cellspacing='0'>";
        setHtml += "<tr>";
        setHtml += "<td bgcolor='#CCCCCC'>";

        setHtml += "<table width='100%'  border='0' cellpadding='0' cellspacing='6' bgcolor='#FFFFFF'>";
		setHtml += "<tr><td height='1'></td></tr>";

		setHtml += preview

		setHtml += "<tr><td height='1'></td></tr>";
		setHtml += "</table>";

		setHtml += "</td>";
		setHtml += "</tr>";
		setHtml += "</table>";

		document.getElementById("preview").innerHTML = setHtml;
	}
}

function SelectClubMenu()
{
	var clubMenu = document.getElementById("ClubMenu");
	var menuSelected = clubMenu.options[clubMenu.selectedIndex].value;

	document.menu.menu.disabled=false;
	document.menu.link.disabled=false;

	// 'N', 'C', 'B', 'I', 'K', 'O', 'T', 'S', 'A', 'J', 'P', 'G', 'U', 'L'
	switch(m[menuSelected].cn_type)
	{
		case 'N' :
    case 'C' :
		case 'B' :
		case 'I' :
		case 'K' :
		case 'O' :
		case 'T' :
    case 'S' :
    case 'A' :
    case 'J' :
		case 'P' :
		case 'G' :
		{
			document.menu.menu.value=m[menuSelected].cn_name;
			document.menu.link.value="";
			document.menu.menu.focus();
			document.menu.link.disabled=true;
			break;
		}
		case 'U' :
		{
			document.menu.menu.value=m[menuSelected].cn_name;
			document.menu.link.value=m[menuSelected].cn_url;
			document.menu.menu.focus();
			break;
		}
		case 'L' :
		{
			document.menu.menu.value="";
			document.menu.link.value="";
			document.menu.menu.disabled=true;
			document.menu.link.disabled=true;
			break;
		}
		default :
		{
			document.menu.menu.value="ERROR";
			document.menu.link.value="ERROR";
			break;
		}
	}
}

function ModifyInfo(cm_check)
{
	var clubMenu = document.getElementById("ClubMenu");

  // �޴��� Ư�� ���ڸ� ������� ���ϰ� �ϱ� ���ؼ�	
  if (event.keyCode==220 || event.keyCode==192 || event.keyCode ==189 || event.keyCode ==222 ) { 
      alert("Ư���ڵ带 ����� �� �����");  //  | ` - ���ڿ� �и��� ���ؼ� ����ϴ� �ڵ� 
      event.returnValue = false; 
      cm_check.value = cm_check.value.substring(0,cm_check.value.length-1); 
      return; 
  }

	
	if(clubMenu.selectedIndex >= 0)
	{
		var mIdx = clubMenu.options[clubMenu.selectedIndex].value;
		m[mIdx].cn_name = document.menu.menu.value;
		m[mIdx].cn_url = document.menu.link.value;

  	// 'N', 'C', 'B', 'I', 'K', 'O', 'T', 'S', 'A', 'J', 'P', 'G', 'U', 'L'
		switch(m[mIdx].cn_type)
		{
			case 'N' : text="[��������]";     break;
			case 'C' : text="[Ŀ�����丮]";   break;
			case 'B' : text="[�ϹݰԽ���]";   break;
			case 'I' : text="[������]";       break;
			case 'K' : text="[���İԽ���]";   break;
			case 'O' : text="[���ٰԽ���]";   break;
			case 'T' : text="[1:1�Խ���]";    break;
			case 'S' : text="[������Խ���]"; break;
			case 'A' : text="[��ũ�Խ���]";   break;
			case 'J' : text="[���ͰԽ���]";   break;
			case 'P' : text="[�ڷ�Խ���]";   break;
			case 'U' : text="[��ũ]";   			break;
			case 'L' : text="[���м�-----------]"; break;
			case 'G' : text="[�׷��]"; break;
			default  : text="[ERROR]"; break;
		}

		clubMenu.options[clubMenu.selectedIndex].text = text + document.menu.menu.value;
		PreviewMenu();
	}
}

function SaveClubMenu()
{
 	var clubMenu = document.getElementById("ClubMenu");
	var append_text="<form name=menusubmit method=post action='./cm_menu.update.php' ><input type=hidden name=doc value='<?=$doc?>'><input type=hidden name=cb_id value='<?=$cb[cb_id]?>'>";

	if(mObjCnt > clubMenu.options.length)
	{
		for(var i=0;i<clubMenu.options.length ;i++){
			var idx = clubMenu.options[i].value;
			if( m[idx].cn_type !='L' && ! m[idx].cn_name )
			{
				alert('�޴����� �����ּ���.   ');
				clubMenu.selectedIndex=i;
				document.menu.menu.focus();
				return;
			}

			append_text+="<input type=hidden name=cn_id[] value='"+m[idx].cn_id+"'>";
			append_text+="<input type=hidden name=cn_name[] value='"+m[idx].cn_name+"'>";
			append_text+="<input type=hidden name=cn_type[] value='"+m[idx].cn_type+"'>";
			append_text+="<input type=hidden name=cn_url[] value='"+m[idx].cn_url+"'>";
			append_text+="<input type=hidden name=tmp_name[] value='"+m[idx].tmp_name+"'>";

		}

		for(var i=0;i<mObjCnt ;i++){
			if( m[i].cn_id &&  m[i].cn_type =='X' )
			{
				append_text+="<input type=hidden name=cn_id[] value='"+m[i].cn_id+"'>";
				append_text+="<input type=hidden name=cn_name[] value='"+m[i].cn_name+"'>";
				append_text+="<input type=hidden name=cn_type[] value='"+m[i].cn_type+"'>";
				append_text+="<input type=hidden name=cn_url[] value='"+m[i].cn_url+"'>";
			  append_text+="<input type=hidden name=tmp_name[] value='"+m[idx].tmp_name+"'>";
			}
		}
	}
	else
	{
		for(var i=0;i<clubMenu.options.length ;i++){
			var idx = clubMenu.options[i].value;
			if( m[idx].cn_type !='L' && ! m[idx].cn_name )
			{
				alert('�޴����� �����ּ���.   ');
				clubMenu.selectedIndex=i;
				document.menu.menu.focus();
				return;
			}

			append_text+="<input type=hidden name=cn_id[] value='"+m[idx].cn_id+"'>";
			append_text+="<input type=hidden name=cn_name[] value='"+m[idx].cn_name+"'>";
			append_text+="<input type=hidden name=cn_type[] value='"+m[idx].cn_type+"'>";
			append_text+="<input type=hidden name=cn_url[] value='"+m[idx].cn_url+"'>";
			append_text+="<input type=hidden name=tmp_name[] value='"+m[idx].tmp_name+"'>";

		}
	}
	append_text+="</form>";
	document.getElementById("tform").innerHTML=append_text;
	document.menusubmit.submit();
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>�޴� ����</strong></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr align="center">
    <td colspan="2"><table border="0">
        <tr>
          <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><select name="MenuCategory" id="MenuCategory"size="14">
                    <option value="B">�ϹݰԽ���</option>
                    <? if ($cb_gallery_skin_path) { ?><option value="I">������</option><? } ?>
                    <? if ($cb_jisik_skin_path) { ?><option value="K">���İԽ���</option><? } ?>
                    <? if ($cb_1to1_skin_path) { ?>     <option value="T">1:1�Խ���</option><? } ?>
                    <? if ($cb_oneline_skin_path) { ?><option value="O">���ٰԽ���</option><? } ?>
                    <? if ($cb_schedule_skin_path) { ?><option value="S">������Խ���</option><? } ?>
                    <? if ($cb_link_skin_path) { ?><option value="A">��ũ�Խ���</option><? } ?>
                    <? if ($cb_mart_skin_path) { ?><option value="J">���ͰԽ���</option><? } ?>
                    <? if ($cb_pds_skin_path) { ?><option value="P">�ڷ�Խ���</option><? } ?>
                    <option value="U">��ũ</option>
                    <option value="L">���м�-----------</option>
                    <option value="G">�׷��</option>
                  </select></td>
                <td width="60" align="center"><a href="javascript:AddClubMenu()"><img src="./images/btn_additem.gif" width="41" height="19" border="0"></a></td>
                <td><!--<form name=frm method=post target=hframe> -->
                    <select name="ClubMenu" id="ClubMenu" size="20" style="position:relative;width:230px" class="left01" onclick=SelectClubMenu();>
                    </select>
                <!--</form> -->
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><table width="98%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><a href="javascript:MoveMenuUp();"><img src="./images/btn_aup.gif" width="20" height="19" border="0"></a> <a href="javascript:MoveMenuDn();"><img src="./images/btn_adn.gif" width="20" height="19" border="0"></a></td>
                      <td align="right"><a href="javascript:DeleteClubMenu()"><img src="images/btn_adel.gif" width="41" height="19" border="0"></a></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><table width="100%" border="0">
                    <form name=menu>
                      <tr>
                        <td align="right">�޴���</td>
                        <td><input size=20 name=menu class=ed onKeyUp="ModifyInfo(this)" maxlength=20 hangulalphanumeric>
                          <input type="hidden" name="no" value=""></td>
                      </tr>
                      <tr>
                        <td align="right">�ּ�</td>
                        <td><input size=20 name=link class=ed onKeyUp="ModifyInfo()"></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center">* �޴��� �����Ͻð� �ݵ�� [Ȯ��] ��ư�� Ŭ���ϼ���.</td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center">
                        <b>*�޴����� ����/Ư������(&,*,% ��)�� ���� �ȵ˴ϴ�</b>
                        </td>
                      </tr>
                      <tr align="center">
                        <td colspan="2">
                        <a href="javascript:SaveClubMenu();">
                        <img src="./images/btn_confirm.gif" width="90" height="21" border="0">
                        </a></td>
                      </tr>
                    </form>
                    <span id=tform name=tform></span>
                  </table></td>
              </tr>
            </table></td>
          <td width="30" valign="top">&nbsp;</td>
          <td valign="top"><table  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><img src="images/btn_apreview.gif" width="175" height="23"></td>
              </tr>
              <tr>
                <td><span id=preview name=preview> </span>
                  <script>
                    <?
    					$sql = " select *
    							   from $nc[tbl_menu]
    							  where cb_id = '$cb_id'
    						   order by cn_idx asc ";
    					$result = mysql_query($sql);
    					for ($i=0; $row=mysql_fetch_array($result); $i++) {
    						echo "m[$i]=new MenuObject('$row[cn_id]','$row[cn_type]','$row[cn_name]','$row[cn_url]','$row[cn_name]');\n";
    						echo "AddMenuSelect('$i');\n";
    					}
    				?>
    				PreviewMenu();
				  </script></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<iframe name=hframe id=hframe scrolling=no scrollbar=no width=0 height=0 frameborder=0 src='about:blank'></iframe>

<?
include "$nc[cb_path]/tail.sub.php";
?>
