<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("�ش� Ŭ���� �������� �ʽ��ϴ�.");
}

if (!$is_manager) {
    error_msg("���ܱ��� �̻� ���� �����մϴ�.");
}

if ($_POST[exec] == "update") {
    foreach ($chk as $i) {
		if ($cm_level[$i] <= 30 || $cm_level[$i] >= 100) {
		    error_msg("��ȸ�� ���� �Ǵ� �Ŵ��� �̻��� ������ ������ �� �����ϴ�.");
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
		    error_msg("��ȸ�� ���� �Ǵ� �Ŵ��� �̻��� ������ ������ �� �����ϴ�.");
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
		    error_msg("��ȸ�� ���� �Ǵ� �Ŵ��� �̻��� ������ �̻��� �߰��� �� �����ϴ�.");
		}

    // �߰��� ������ �ִ��� Ȯ��
    $sql = " select count(*) as cnt from $nc[tbl_mb_level]
              where cb_id = '$cb_id' and (cm_level = '$cm_level' or ml_name = '$ml_name')";
    $result = sql_fetch($sql);
    if ($result['cnt'] > 0)
		    error_msg("�̹� ��ϵ� ȸ������/������ �Դϴ�.");
    
    $sql = " insert into $nc[tbl_mb_level]
                     set cb_id = '$cb_id',
                         cm_level = '$cm_level',
                         ml_name = '$ml_name' ";
    mysql_query($sql);
}

frame_url("./club_manager.php?doc=$doc&cb_id=$cb_id");
?>
