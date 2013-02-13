<?
include_once "./_common.php";

$g4[title] = "$cb[cb_name] - $nc[nf_title]";
include_once "$nc[cb_path]/head.sub.php";

if ($cb[cb_latest_use] == "Y") {

// 커버스토리 출력 (1)
$sql = " select cn_name from $nc[tbl_menu] where cb_id = '$cb[cb_id]' and cn_type = 'C' and cn_1 = 'Y' ";
$ca_coverstory = sql_fetch($sql);

// 공지사항 출력 (1)
$sql = " select cn_name from $nc[tbl_menu] where cb_id = '$cb[cb_id]' and cn_type = 'N' and cn_1 = 'Y' ";
$ca_notice = sql_fetch($sql);

// 출력할 최근글 목록
$sql = " select cn_name, cn_type from $nc[tbl_menu] where cb_id = '$cb[cb_id]' and cn_1 = 'Y' and cn_type not in ('C', 'N') order by cn_idx asc ";
$cn_list = sql_query($sql); 

switch ($cb[cb_latest_cols]) {
case 1 :  if ($ca_coverstory && $cb[cb_coverstory_latest_skin]) {
              echo cb_latest($cb[cb_coverstory_latest_skin], $cb[cb_id], $ca_coverstory[cn_name], $cb[cb_latest_rows], $cb[cb_latest_len]);
              echo "<table width='100%'><tr><td height='5'></td></tr></table>";
          }
          if ($ca_notice && $cb[cb_notice_latest_skin]) {
              echo cb_latest($cb[cb_notice_latest_skin], $cb[cb_id], $ca_notice[cn_name], $cb[cb_latest_rows], $cb[cb_latest_len]);
              echo "<table width='100%'><tr><td height='5'></td></tr></table>";
          }

          for ($i=0; $row=sql_fetch_array($cn_list); $i++) {
              $latest_skin = cn_latest_skin($row[cn_type]);
              if ($latest_skin) { 
                  echo cb_latest(cn_latest_skin($row[cn_type]), $cb[cb_id], $row[cn_name], $cb[cb_latest_rows], $cb[cb_latest_len]);
                  echo "<table width='100%'><tr><td height='5'></td></tr></table>";
              }
          }
          break;
case 2 :
case 3 :
default:
          $col_width = 100 / $cb[cb_latest_cols]. "%";
          echo "<table width='100%'>";
          if ($ca_coverstory && $cb[cb_coverstory_latest_skin]) { 
              echo "<tr valign=top>";
              echo "<td colspan=" . $cb[cb_latest_cols] . " width='" . $col_width . "'>";
              echo cb_latest($cb[cb_coverstory_latest_skin], $cb[cb_id], $ca_coverstory[cn_name], $cb[cb_latest_rows], $cb[cb_latest_len]);
              echo "</td>";
              echo "</tr>";
          }

          $ja = 0; // 2개씩 채워서 넣기 위해서
          echo "<tr valign=top>";
          if ($ca_notice && $cb[cb_notice_latest_skin]) {
              echo "<td width='" . $col_width ."' valign=top>";
              echo cb_latest($cb[cb_notice_latest_skin], $cb[cb_id], $ca_notice[cn_name], $cb[cb_latest_rows], $cb[cb_latest_len]);
              echo "</td>";
              $ja++;
          }

          for ($i=0; $row=sql_fetch_array($cn_list); $i++) {
              if ($ja == $cb[cb_latest_cols]) { // 줄바꿈
                  echo "</tr><tr><td height=5></td></tr><tr valign=top>";
                  $ja = 0;
              }
          
              $latest_skin = cn_latest_skin($row[cn_type]);
              if ($latest_skin) {
                  echo "<td width='" . $col_width ."' valign=top>";
                  echo cb_latest($latest_skin, $cb[cb_id], $row[cn_name], $cb[cb_latest_rows], $cb[cb_latest_len]);
                  echo "</td>";
                  $ja++;
              }
          }
          
          echo "</tr></table>";
}

} else {

    // 클럽 메인의 최신글을 프로세싱
    $latest = stripslashes($cb[cb_latest_text]);
    $pattern = "|<\?=cb_latest\(([^)]+)\);\?>|";
    $new_latest = preg_replace_callback($pattern, "replace_latest", $latest);

    echo strip_only($new_latest, "script");
}
echo "<br /><br />";

function cn_latest_skin($cn_type) {
    global $cb;

    switch ($cn_type) {
        case 'C'  : $latest_skin = $cb[cb_coverstory_latest_skin]; break;
        case 'N'  : $latest_skin = $cb[cb_notice_latest_skin]; break;
        case 'B'  : $latest_skin = $cb[cb_board_latest_skin]; break;
        case 'I'  : $latest_skin = $cb[cb_gallery_latest_skin]; break;
        case 'K'  : $latest_skin = $cb[cb_jisik_latest_skin]; break;
        case 'O'  : $latest_skin = $cb[cb_oneline_latest_skin]; break;
        case 'T'  : $latest_skin = $cb[cb_1to1_latest_skin]; break;
        case 'S'  : $latest_skin = $cb[cb_schedule_latest_skin]; break;
        case 'A'  : $latest_skin = $cb[cb_link_latest_skin]; break;
        case 'J'  : $latest_skin = $cb[cb_mart_latest_skin]; break;
        case 'P'  : $latest_skin = $cb[cb_pds_latest_skin]; break;
        default   : $latest_skin = "";
    }
    
    return $latest_skin;
}

include_once "$nc[cb_path]/tail.sub.php";
?>
