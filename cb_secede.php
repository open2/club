<?
include_once "./_common.php";

if (!$member[mb_id]) {
    error_msg("로그인후에 이용하세요.");
}

if (!$cb[cb_id]) {
    error_msg("해당 클럽이 존재하지 않습니다.");
}

if (!$cm[mb_id]) {
    error_msg("클럽의 회원이 아닙니다.");
}

if ($cm[cm_level] <= 0 && $is_admin!=="super") {
    error_msg("회원이 아니므로 탈퇴할 수 없습니다.");
}

// 탈퇴하려는 회원이 매니저일경우 탈퇴 불가
if (is_manager() == "manager" && $cb[cb_manager] == $member[mb_id]) {
    error_msg("클럽 매니저는 탈퇴를 할 수 없습니다. 클럽을 양도후 탈퇴 하시기 바랍니다.");
}

$sql    = " delete from $nc[member_table] where mb_id = '$member[mb_id]' and cb_id ='$cb[cb_id]' "; 
$result = sql_query($sql);

// 탈퇴후 정보처리
if ($result) {
    //클럽 정보의 총회원수 감소
    sql_query(" update $nc[club_table] set cb_total_member = cb_total_member - 1 where cb_id = '$cb[cb_id]' ");
    
    // 클럽포인트 차감, $nc[nf_point_use], 1:사용안한, 2: 가입적립, 3: 가입기부
    if ($nc[nf_point_use] > 1) {
        sql_query(" update $nc[club_table] set cb_point = cb_point - $nc[nf_save_point] where cb_id = '$cb[cb_id]' ");
    }
}

frame_url("./club_index.php");
?>