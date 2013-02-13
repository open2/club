<?
include_once "./_common.php";

if (!$cb[cb_no]) {
    error_msg("�ش� Ŭ���� �������� �ʽ��ϴ�.", "$nc[cb_url_path]/club_index.php");
}

if ($cb[cb_state] == 4) {
    error_msg("���� ������� Ŭ���Դϴ�.");
}

if ($cb[cb_state] == 3 && !$is_admin && !$cm[mb_id]) {
    error_msg("���� Ŭ���Դϴ�.", $nc[cb_url_path]);
}

if (!$doc) {
    $doc = "cb_main.php";
}
$doc .= "?cb_id=$cb[cb_id]&bo_table=$bo_table";

if($wr_id || $sca) { // �Խù� ���̵� �ִ� ��쿡�� �ش� �Խù��� �����ݴϴ�
    $doc = $g4[bbs_path] . "/board.php?bo_table=" . $cb[cb_id] . "&wr_id=$wr_id&sca=$sca";  
}

$vs       = get_count($cb[cb_id]);
$daytime  = strtotime(date('Y-m-d'));

if (!$cm[cm_logdate]) {
    $logtime = $daytime;
} else {
    $logtime = strtotime($cm[cm_logdate]);
}

// �湮�ڼ��� ������ ����
include_once("{$nc['cb_path']}/include/cb_visit_insert.inc.php");

// ȸ���� ���� ���� ����� ����
$sql1 = " update $nc[member_table]
             set cm_logdate = now(),
                 cm_visit = cm_visit+1
           where ( cb_id = '$cb[cb_id]' and mb_id = '$member[mb_id]' )
             and cm_logdate < date_sub(now(), interval 1 HOUR) ";
sql_query($sql1);
        
// Ŭ���� �湮�� ������ ��¥�� ������Ʈ
$sql3 = " update $nc[club_table] set cb_last_visit_datetime = now() where cb_id = '$cb[cb_id]' ";
sql_query($sql3);

$boxstyle = "boxtext";
if ($cb[cb_box_line_skin] == "#E2E2E2") {
    $boxstyle = "boxtext1";
}

$sql = " select count(*) from $nc[coverstory_table] where cb_id = '$cb[cb_id]' ";
$cs_total = sql_fetch_array(sql_query($sql));

$g4[title] = "$cb[cb_name] - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";
?>

<script language="JavaScript" type="text/JavaScript">
function location_top()
{
    document.location = "#";
}
</script>

<!-- �Ϲ� �Խù��� �������� -->
<form name='club_check'><input name='cb_check' id='cb_check' value='here' type=hidden></form> 

<table width="<?=$nc[nf_width]?>" border="0" align="<?=$nc[nf_align]?>" cellpadding="0" cellspacing="0">
  <tr>
    <td><? include_once "$nc[cb_path]/include/cb_top.inc.php"; ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="180" height="100" align="center" valign="top">
            <?=cb_outlogin("club");?>
			
			<div style="height:5px; overflow:hidden;"></div>
            <? include_once "$nc[cb_path]/include/cb_defaultmenu.inc.php"; ?>
			
			<div style="height:5px; overflow:hidden;"></div>
            <? include_once "$nc[cb_path]/include/cb_leftmenu.inc.php"; ?>
            
			<? 
            // ���� Ŭ�������� ȸ�����Ը� �����ش�
            if ($cm[mb_id]) { 
            ?>
			<div style="height:5px; overflow:hidden;"></div>
			<table width="100%" cellspacing="0" cellpadding="0" style="border:2px solid <?=$cb[cb_box_line_skin]?>;">
			  <tr>
			    <td align="left" valign="middle" class="gmenu" style="padding:7px 0 7px 20px;">
                  <img src='<?=$nc[cb_path]?>/images/ico_note_notice.gif' border='0' align='absmiddle'> <a href="<?=$nc[cb_path]?>/cb_mb_info.php?cb_id=<?=$cb[cb_id]?>" target='CLUB_BODY'>����Ŭ������</a></td>
              </tr>
            </table>
            <? } ?>

            <? if ($cb[cb_left_textarea]) { ?>
			<div style="height:5px; overflow:hidden;"></div>
            <?
                $left_text = stripslashes($cb[cb_left_textarea]);
                echo strip_only($left_text, "script");
            } ?>

            <? if ($cb[cb_connect_view]) { ?>
			<div style="height:5px; overflow:hidden;"></div>
            <?=cb_current_connect($cb[cb_name]) ?>
            <? } ?>

            <table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td align="center" class="verdana9">today <?=number_format($vs[today])?> | total <?=number_format($vs[total])?></td>
              </tr>
            </table>

          </td>

          <td width="10" align="center" valign="top">&nbsp;</td>
          <td align="center" valign="top">
