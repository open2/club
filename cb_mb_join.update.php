<?
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

// 비밀클럽의 경우 초대 받았는지 확인
if ($cb[cb_type] == 3 && !get_club_invite($cb_id, $member[mb_id]))
    error_msg("회원 {$member[mb_id]} 은 초대 받지 않은 회원입니다.");

// 이미 클럽 회원으로 가입된 경우 (업데이트 하기전에 한번 더 check)
$cb_member = get_club_member($cb[cb_id], $member[mb_id]);
if ($cb_member[mb_id])
    error_msg("이미 클럽 회원으로 등록되어 있습니다.");

// 클럽 포인트, 2: 가입적립, 3: 가입기부(회원포인트를 클럽에)
if ($nc[nf_point_use] == 2) {
    $cm_point = $nc[nf_save_point];
} else if ($nc[nf_point_use] == 3) {

    // 회원포인트가 가입포인트 보다 적을때
    if ($member[mb_point] < $cb[cb_join_point]) {
        alert("현재 보유하고 있는 포인트가 모자랍니다.");
    }

    $cm_point = $cb[cb_join_point];
}

// 클럽 가입후 회원 등급
switch ($cb[cb_type]) {
    case  2 : $cm_level = 10; break;
    default :
    case  3 : 
    case  1 : $cm_level = $cb[cb_join_level]; break;
}

// 가입 질문에 대한 답변
if ($reply) {
    foreach ($reply as $value) {
        $cm_reply .= $value. "|";
    }
    $cm_query = $cb[cb_ask_body];
}

$sql = " insert into $nc[member_table]
                 set cb_id = '$cb[cb_id]',
                     mb_id = '$member[mb_id]',
                     cm_level = '$cm_level',
                     cm_point = '$cm_point',
                     cm_visit = '1',
                     cm_logdate = now(),
                     cm_regdate = now(),
                     cm_query = '$cm_query',
                     cm_reply = '$cm_reply',
                     cm_1 = '$cm_1',
                     cm_2 = '$cm_2',
                     cm_3 = '$cm_3',
                     cm_4 = '$cm_4',
                     cm_5 = '$cm_5' ";
$result = sql_query($sql);

// 클럽 정보 테이블의 총회원수 업뎃
if ($result) {
    // 포인트 기부
    $point = $cm_point * (-1);
    if ($nc[nf_point_use] == 3) {
        insert_point($member[mb_id], $point, "{$cb[cb_name]} 클럽가입");
    }
    
    sql_query(" update $nc[club_table] set cb_total_member = cb_total_member + 1, cb_point = cb_point + '$cm_point' where cb_id = '$cb[cb_id]' ");
}

// cm_level의 이름을 구합니다.
$sql = " select ml_name from $nc[mb_level_table] where cb_id = '$cb[cb_id]' and cm_level = '$cm_level' ";
$cm_level_result = sql_fetch($sql);
if (!$cm_level_result)
    error_msg("회원레벨은 오류입니다. 관리자에게 문의 하시기 바랍니다.");

// 비밀회원은 가입확인을 history를 찍어줍니다
$url = "./club_main.php?cb_id=$cb[cb_id]";
if ($cb[cb_type] == 3)
{
    $sql = " update $nc[cb_history_table]
                    set history_notice = '비밀클럽가입완료' 
              where cb_id = '$cb_id' and history_mb_id = '$member[mb_id]' and history_notice = '비밀클럽가입초대' ";
    sql_query($sql);

    error_msg("비밀클럽 회원으로 등록되었습니다. 회원레벨은 {$cm_level_result[ml_name]} 입니다.", $url, 1);
} else if ($cb[cb_type] == 2) {
    error_msg("가입하신 클럽은 해당 클럽관리자의 승인후 가입이 가능한 클럽 입니다.", $url, 1);
} else {
    error_msg("클럽 회원으로 등록되었습니다. 회원레벨은 {$cm_level_result[ml_name]} 입니다.", $url, 1);
}

frame_url("./club_main.php?cb_id=$cb[cb_id]");
?>
