<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("해당 클럽이 존재하지 않습니다.");
}

if (!$is_manager) {
    error_msg("스텝권한 이상만 접근 가능합니다.");
}

if ($_POST[exec] == "update") {
    foreach ($chk as $i) {
		if ($cm_level[$i] <= 30 || $cm_level[$i] >= 100) {
		    error_msg("정회원 이하 또는 매니저 이상의 레벨로 수정할 수 없습니다.");
		}		
		$sql = " update $nc[tbl_mb_level]
		            set cm_level = '$cm_level[$i]',
		                ml_name = '$ml_name[$i]'
		          where ml_id = '$ml_id[$i]'
		            and cb_id = '$cb_id' ";
		$result = mysql_query($sql);

		if ($result && $tmp_cm_level[$i] != $cm_level[$i]) {
  		    $sql_1 = " update $nc[tbl_member]
  		                  set cm_level = '$cm_level[$i]'
  		                where cm_level = '$tmp_cm_level[$i]'
  		                  and cb_id = '$cb_id' ";
		    mysql_query($sql_1);
		}
	}
}

if ($_POST[exec] == "delete") {
    foreach ($chk as $i) {
		if ($cm_level[$i] <= 30 || $cm_level[$i] >= 100) {
		    error_msg("정회원 이하 또는 매니저 이상의 레벨은 삭제할 수 없습니다.");
		}
		$sql = " delete from $nc[tbl_mb_level]
		               where ml_id = '$ml_id[$i]'
		                 and cb_id = '$cb_id' ";
		$result = mysql_query($sql);
		
		if ($result) {
		    $sql_1 = " update $nc[tbl_member]
		                  set cm_level = '1'
		                where cm_level = '$cm_level[$i]'
		                  and cb_id = '$cb_id' ";
		    mysql_query($sql_1);
		}
	}
}

if ($_POST[exec] == "add") {
		if ($cm_level <= 30 || $cm_level >= 100) {
		    error_msg("정회원 이하 또는 매니저 이상의 레벨로 이상은 추가할 수 없습니다.");
		}

    // 추가할 레벨이 있는지 확인
    $sql = " select count(*) as cnt from $nc[tbl_mb_level]
              where cb_id = '$cb_id' and (cm_level = '$cm_level' or ml_name = '$ml_name')";
    $result = sql_fetch($sql);
    if ($result['cnt'] > 0)
		    error_msg("이미 등록된 회원레벨/레벨명 입니다.");
    
    $sql = " insert into $nc[tbl_mb_level]
                     set cb_id = '$cb_id',
                         cm_level = '$cm_level',
                         ml_name = '$ml_name' ";
    mysql_query($sql);
}

frame_url("./club_manager.php?doc=$doc&cb_id=$cb_id");
?>
