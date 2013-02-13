<?
include_once "./_common.php";

if ($w=="approve") {
    $cb_id = strip_tags($cb_id);
    $club_transfer_mb_id = $member[mb_id];
} else {
    $cb_id = $_POST[cb_id];
    $club_transfer_mb_id = $_POST['club_transfer_mb_id'];
    $w = $_POST['w'];
}

// 클럽이 존재하지 않거나 $cb_id가 없을경우
if (!$cb[cb_id]) {
    error_msg("클럽이 존재하지 않습니다.");
}

if (!$member[mb_id]) {
    error_msg("로그인후에 이용하세요");
}

// 양도요청을 받은 사람이 회원이 아닌 경우에는?
$mb = get_member($club_transfer_mb_id);
if (!$mb[mb_id]) {
    error_msg("회원 {$club_transfer_mb_id} 은 현재 존재하지 않습니다.");
}

// 이미 양도를 신청한 경우에는
if ($w == "" && get_club_transfer($cb_id)) {
    error_msg("클럽 양수도가 진행중입니다.");
}

// 클럽 회원인지 확인 합니다.
$cm_tmp = get_club_member($cb_id, $club_transfer_mb_id);
if (!$cm_tmp || $cm_tmp[cm_level] <= 0)
    error_msg("클럽 양수도에 필요한 회원자격이 아닙니다.");

// history table에 초청 history를 기록 합니다.
if ($w == "") {
    $sql = " insert $nc[cb_history_table]
            set cb_id = '$cb_id',
                history_mb_id = '$club_transfer_mb_id',
                history_notice = '클럽양도요청',
                history_datetime = '$g4[time_ymdhis]'
            ";
    sql_query($sql);

    error_msg("{$club_transfer_mb_id} 님에게 클럽양수도를 요청 하였습니다.");
} else if ($w == "cancel") {
    $sql = " update $nc[cb_history_table]
                set history_notice = '클럽양도요청취소'
              where cb_id = '$cb_id' 
                    and history_mb_id = '$club_transfer_mb_id'
                    and history_notice = '클럽양도요청'
            ";
    sql_query($sql);

    error_msg("{$club_transfer_mb_id} 님의 클럽양수도 요청을 취소 하였습니다.");
} else if ($w == "approve") {

    $sql = " update $nc[cb_history_table]
                set history_notice = '클럽양도승인'
              where cb_id = '$cb_id' 
                    and history_mb_id = '$club_transfer_mb_id'
                    and history_notice = '클럽양도요청'
            ";
    sql_query($sql);

    // 양도자의 레벨을 정회원으로 조정 합니다.
    $sql = " update $nc[member_table] set cm_level = '30' where cb_id = '$cb_id' and mb_id = '$cb[cb_manager]'";
    sql_query($sql);
    
    // 클럽 관리자 정보를 양수인으로 update 합니다.
    $sql = " update $nc[club_table] set cb_manager = '$club_transfer_mb_id' where cb_id = '$cb_id' ";
    sql_query($sql);

    // 회원레벨을 올려줍니다.
    $sql = " update $nc[member_table] set cm_level = '100' where cb_id = '$cb_id' and mb_id = '$club_transfer_mb_id'";
    sql_query($sql);

    error_msg("클럽양수도 요청을 승인하였습니다.", "$nc[cb_path]/club_main.php?cb_id=$cb_id");
} else {
    error_msg("오류입니다. 확인해봐 주세요. cm_club_transfer.update.php");
}
?>
