<script type="text/javascript"> 
{ 
try
{
    parent.scrollTo(0,0);
    parent.document.getElementById("CLUB_BODY").height = document.body.scrollHeight + 50;
}catch(e){}
}

function resize_iframe() {
    parent.scrollTo(0,0);
    parent.document.getElementById("CLUB_BODY").height = document.body.scrollHeight + 50;
}
</script>

<script language="javascript"> 
// iframe ���� ��ũ�� ���� 

// fire fox                    
// ie 6.0                      
// Mozilla 1.75        
// Netscape 7.0 
// ���� ��������� �׽�Ʈ�غý��ϴ�. 

function resizeIFrame() 
{ 
      try { 
              var objFrame = document.getElementById("CLUB_BODY"); 
              var objBody = CLUB_BODY.document.body; 

              ifrmHeight = objBody.scrollHeight + (objBody.offsetHeight - objBody.clientHeight); 

              if (ifrmHeight > 300) { 
                    objFrame.style.height = ifrmHeight; 
              } else { 
                    objFrame.style.height = 300; 
              } 
              objFrame.style.width = '100%' 
      } catch(e) { 
      }; 
} 

function getRetry() 
{ 
      resizeIFrame(); 
      setTimeout('getRetry()',500); 
} 
getRetry(); 

</script> 

<?
include_once "$g4[path]/tail.sub.php";
?>
