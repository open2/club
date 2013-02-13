<?
include_once("./_common.php");

$g4[title] = "나의클럽정보 - $nc[nf_title]";
include_once("./head.sub.php");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="30"><img src="./images/box_list_t01.gif"></td>
		<td width="100%" background="./images/box_list_bg1.gif"><strong>나의클럽정보</strong></td>
		<td width="50"><img src="./images/box_list_t02.gif"></td>
	</tr>
	<tr>
		<td colspan="3" height="12" background="./images/box_list_bg2.gif"></td>
	</tr>
</table>
<div style="height:10px; overflow:hidden;"></div>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#CCCCCC">
    <td height="2" colspan="2"></td>
  </tr>
  <tr>
    <td style="padding:7px 10px 5px 5px" width=180>클럽가입일</td>
    <td><?=$cm[cm_regdate]?></td>
  </tr>
  <tr>
    <td style="padding:7px 10px 5px 5px" width=180>클럽방문횟수</td>
    <td><?=$cm[cm_visit]?></td>
  </tr>
  <tr>
    <td style="padding:7px 10px 5px 5px" width=180>클럽 레벨</td>
    <td><?=$cm[cm_level]?> (<?=$cm[ml_name]?>)</td>
  </tr>
  <tr>
    <td style="padding:7px 10px 5px 5px" width=180>클럽 포인트</td>
    <td><?=$cm[cm_point]?></td>
  </tr>
</table>

<?
include_once("./tail.sub.php");
?>
