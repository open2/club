<?
include_once("./_common.php");

$title = "마이클럽 업데이트 소식";
?>

<?
// 우리클럽 업데이트 정보 가져오기
$sql_from = " from $nc[member_table] a left join $nc[club_table] b on (a.cb_id = b.cb_id) ";
$sql_where = " where a.mb_id = '$member[mb_id]' and cb_last_update_datetime <> '0000-00-00 00:00:00' ";

$sql = " select count(*) as cnt $sql_from $sql_where ";
$total_count = sql_fetch($sql);

$sql = " select b.* $sql_from $sql_where order by b.cb_last_update_datetime desc ";
$result = sql_query($sql);
?>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:7px 10px 5px 5px"><strong><?=$title?></strong> <span class="tahoma10">(<?=$total_count[cnt]?>)</span></td>
    <td align="right" style="padding:7px 5px 5px 5px"></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="2" colspan="2"></td>
  </tr>
  <?
  	for ($i=0; $row=mysql_fetch_array($result); $i++) {
  ?>
  <tr>
    <td height="5" colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2">
    <!-- 우리클럽 업데이트 정보 출력하기 -->
    <table width="100%"  border="0">
      <tr>
            <td align=left>
            <? 
            $club_manager = sql_fetch(" select * from $g4[member_table] where mb_id = TRIM('$row[cb_manager]') ");
            $cb_list = "<b>" . $row[cb_name] . "</b> (" . $club_manager[mb_nick] . ")"; 
            ?>
            <a href="./club_main.php?cb_id=<?=$row[cb_id]?>" target="_parent"><?=$cb_list?></a>
            </td>
            <td width=120 align=right>
            <?=cut_str($row[cb_last_update_datetime],16, '') ?>
            </td>
      </tr>
    </table>
    </td>
    </tr>
    </table>
  </td>
  </tr>
  <tr>
    <td height="5" colspan="2"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="2"></td>
  </tr>
  <? } 
  if ($i == 0) {
		echo "<tr><td height='100' align='center' colspan='2'>가입한 클럽이 없습니다.</td></tr>";
	}
  ?>
  <tr bgcolor="#EEEEEE">
    <td height="2" colspan="2"></td>
  </tr>
  <tr>
    <td height="5" colspan="2"></td>
  </tr>
</table>
