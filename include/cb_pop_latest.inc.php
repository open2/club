<? 
include_once("./_common.php"); 

####################################### 
#bbs ���� new.php�� �ణ �����߽��ϴ�. 
#�������� �Խù��� �������� �� ������ ����..ư �ణ..������. 
####################################### 
#�ϳ�ȿ� ���ۿ��� �����մϴ�. 
#���� ���⸦ 7�� �ٲٸ� �����Ͼȿ� ��ϵ� �Ĵ��̴� �ű� 
#�Ĵ��̳�..��..�׸� �ٲٸ� ����������.. 
#������ �̾Ƴ���..�ֽű� ��Ÿ�� ����...���� �����ϸ鼭 
#������ �൵ �ǰ�����.. 
//��¥�� �˾Ƴ��� ����.
$today = getdate(); 
$gong = "0";
$a_year = $today['year']; 

$before_day =365;  #�ڷ� ��ĥ������ ����...�����:1; 
$before_time = date("Y-m-d H:i:s", $g4[server_time] - (86400 * $before_day)); 
$start_day = "$a_year-01-01 00:00:00";
$end_day = "$a_year-12-31 23:59:59";
####################################### 
#�����2:������ �׷��......!!! 
$gr_id = "club"; 
$NotSelectTable="'club_notice','club_qa','club_ad'";//���Խ�Ű�� ���� �Խ���

#�����3:��õ�� ����õ���� �ϳ� ��Ʈ�� ���ü��� �ϳ� ??? 

$hit_ro_ha_ja='YES'; 
?>


<?

#######################################  ��Ʈ���̸�...!!!  
if ($hit_ro_ha_ja=='YES'): 
####################################### 

$top1 = $top2 = 8;  #�����2:���� �� ���ں��� 1����........!!! 
$list2 = array();reset($list2); 
$list3 = array(); reset($list3); 
$list4 = array();reset($list4); 
#bo_table bo_notics �� �����������̺� �ش�׷츸 ���� 
$sql = " select bo_table, bo_subject ,bo_notice from $g4[board_table] 
          where gr_id = '$gr_id'
		  and bo_table not in ($NotSelectTable) 
           "; 
$result = sql_query($sql); 

while ($row = sql_fetch_array($result)) 
{ //��𿡼� �����Ⱓ���� �����ε� �ڸ�Ʈ�� ��Ʈ���� 
    //�ڸ�Ʈ�ų� ��Ʈ���� �����Ⱓ���� �۷� ��...2005.10.25 
    $sql2 = " select * from $g4[write_prefix]$row[bo_table] 
                where ((wr_comment > -1 or wr_datetime) and (wr_datetime >= '$start_day' or wr_datetime <= '$end_day')) "; 
    $result2 = sql_query($sql2); 

  while ($row2 = sql_fetch_array($result2)) 
    { $key = $row2[wr_datetime]. '-' . $row2[wr_id]; 
      if($row2[wr_subject]){ 

        $key = substr('00000'.$row2[wr_hit],-5) . '-' . $row2[wr_id]; 

        $list2[$key][bo_subject] = conv_subject($row[bo_subject],20,'��' ); 
        $list2[$key][subject] = conv_subject($row2[wr_subject],30,'��'); 
        $list2[$key][ca_name] = $row2[ca_name]; 
//        $list2[$key][href] = "../new/print_list2.php?bo_table=$row[bo_table]&wr_id=$row2[wr_id]&sca=$row2[ca_name]"; 
        $list2[$key][href] = "../../club/club_main.php?botable=1&cb_id=$row[bo_table]&wr_id=$row2[wr_id]&sca=$row2[ca_name]"; 
        $list2[$key][bo_table] = $row[bo_table]; 
        $list2[$key][wr_id] = $row2[wr_id]; 
        $list2[$key][is_notice] = preg_match("/[^0-9]{0,1}{$row2[wr_id]}[\r]{0,1}/",$row[bo_notice]); 
        $list2[$key][wr_hit] = $row2[wr_hit]; 
        $list2[$key][hit] = "($row2[wr_hit])"; 

        $list2[$key][mb_id] = "$row2[mb_id]"; 
        $list2[$key][wr_name] = "$row2[wr_name]"; 

        }//if 
    } //while 
} 

$list4 = $list2; 

@krsort($list2); 
@ksort($list3); 
@ksort($list4); 
$latest_skin_path = "$g4[path]/skin/latest/basic"; 
?> 
<table width=100% class=box_all>
  <tr><td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
          <td width="5"></td>
           <td height="23"><strong><font color=#1749ba>Ŭ�� �α��</strong></td>
           <td align="right"></td>
           <td width="5"></td>
       </tr>
       <tr><td colspan=4 height="1" bgcolor=green width=95%></td></tr>
       <tr><td colspan=4 height="5" ></td></tr>
    </table>        
        
    <table width="100%" border="0" cellspacing="0" cellpadding="0">        
          <? 
          $i=0; 
          foreach($list2 as $key=>$value) { 
             if ($i++>=($top1-1)) break; 
          ?> 
          <tr> 
            <td width="15" height="22" align="center" valign="middle" ><img src="<?=$latest_skin_path?>/img/board_icon.gif" width="9" height="13"></td> 
            <td  style='word-break:break-all;'> 
                <? 
                echo $list2[$key][icon_reply] . " ";    
                echo "<a href='{$list2[$key][href]}'>";                           
                echo "<font style='font-family:����; font-size:9pt; color:#6A6A6A;'>{$list2[$key][subject]}</font>"; 
                echo " <span style='font-family:����; font-size:8pt; color:#9A9A9A;'><b>{$list2[$key][hit]}</b></span>";                 
                echo "</a>"; 
                ?> 
            </td> 
        </tr> 
        <tr><td colspan="2" height="1" background="../bbs/img/dot_bg.gif"></td></tr> 
		<? } ?> 

        <? if (count($list2) == 0) { ?> 
        <tr><td colspan=2 align=center height=30 background="<?=$latest_skin_path?>/img/board_bg_line.gif">�Խù��� �����ϴ�.</td></tr> 
        <? } ?> 
      </table> 
    </td> 

</tr><tr><td  height="5" width=95%></td></tr>  </table> 
<? endif; ?> 
