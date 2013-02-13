<table width="100%" cellspacing="0" cellpadding="0" style="border:2px solid <?=$cb[cb_box_line_skin]?>;">
  <tr>
    <td bgcolor="<?=$cb[cb_box_bg_skin]?>">
	  <table id="cb_leftmenu" width="100%"  border="0" cellpadding="0" cellspacing="5" bgcolor="#F9F9F9">
        <tr>
          <td height="1"></td>
        </tr>
        <?=view_club_menu($cb_id)?>
      </table>
    </td>
  </tr>
</table>

<script type="text/javascript"> 
function setFontWeight(id) 
{ 
    var cb_leftmenu = document.getElementById(id); 
    var cb_link = cb_leftmenu.getElementsByTagName("A"); 
    for(var i=0; i<cb_link.length; i++) 
    { 
          cb_link[i].onclick = function() { 
              for (var i=0; i<cb_link.length; i++) 
                    cb_link[i].style.fontWeight = "normal"; 
              this.style.fontWeight = "bold";
              document.title = this.title;
          } 
    } 
} 
setFontWeight("cb_leftmenu"); 
</script> 
