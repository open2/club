<?
$cb_id = $_POST[cb_id];
$club_invite_mb_id = $_POST['club_invite_mb_id'];
$w = $_POST['w'];

include_once "./_common.php";

// 클럽이 존재하지 않거나 $cb_id가 없을경우
if (!$cb[cb_id]) {
    error_msg("클럽이 존재하지 않습니다.");
}

if (!$member[mb_id]) {
    error_msg("로그인후에 이용하세요");
}

// 클럽 가입 불가
if ($cb[cb_join] == "N") {
    error_msg("현재 클럽에서 회원 가입을 받지 않습니다.");
}

// 초대받은 사람이 회원이 아닌 경우에는?
$mb = get_member($club_invite_mb_id);
if (!$mb[mb_id]) {
    error_msg("초대한 회원 {$club_invite_mb_id} 은 현재 존재하지 않습니다.");
}

// 이미 초대한 경우에는
if ($w == "" && get_club_invite($cb_id, $club_invite_mb_id)) {
    error_msg("회원 {$club_invite_mb_id} 은 이미 초대하였습니다.");
}

// 이미 클럽 회원으로 가입된 경우 (업데이트 하기전에 한번 더 check)
$cb_member = get_club_member($cb[cb_id], $club_invite_mb_id);
if ($cb_member[mb_id])
    error_msg("이미 클럽 회원으로 등록되어 있습니다.");

// history table에 초청 history를 기록 합니다.
if ($w == "") {
    $sql = " insert $nc[cb_history_table]
            set cb_id = '$cb_id',
                history_mb_id = '$club_invite_mb_id',
                history_notice = '비밀클럽가입초대',
                history_datetime = '$g4[time_ymdhis]'
            ";
    sql_query($sql);

    error_msg("비밀클럽회원으로 {$club_invite_mb_id} 을 초대 하였습니다.");
} else if ($w == "cancel") {
    $sql = " update $nc[cb_history_table]
                set history_notice = '비밀클럽가입초대취소'
              where cb_id = '$cb_id' 
                    and history_mb_id = '$club_invite_mb_id'
                    and history_notice = '비밀클럽가입초대'
            ";
    sql_query($sql);

    error_msg("{$club_invite_mb_id} 님의 비밀클럽회원 초대를 취소 하였습니다.");
} else {
    error_msg("오류입니다. 확인해봐 주세요. cm_club_invite.update.php");
}
?>
