<?
include_once "./_common.php";

if ($_POST[exec] == "update") {
	foreach ($chk as $i) {
		if ($tmp_cb_state[$i] == 4 && $cb_state[$i] != 4) {
		    $sql_common = " cb_opendate = '$g4[time_ymdhis]', ";
		}
		
		$cb_id = $cb_id_arr[$i];

		$sql = " update $nc[club_table]
					set cb_type = '$cb_type[$i]',
						  cb_state = '$cb_state[$i]',
  						cb_recommend = '$cb_recommend[$i]',
	  					$sql_common
		  				cb_1 = '$cb_1[$i]',
			  			cb_2 = '$cb_2[$i]',
				  		cb_3 = '$cb_3[$i]',
					  	cb_4 = '$cb_4[$i]',
						  cb_5 = '$cb_5[$i]'
				  where cb_id = '$cb_id' ";
		sql_query($sql);
	}
}

if ($_POST[exec] == "delete") {
	foreach ($chk as $i) {

		$cb_id = $cb_id_arr[$i];

		$sql = " delete from $nc[club_table] where cb_id = '$cb_id' ";
		$result = sql_query($sql);
		
		if ($result) {
		    // Ŭ�� ���� ����
		    sql_query(" delete from $nc[cb_info_table] where cb_id = '$cb_id' ");
		    
		    // Ŭ�� ȸ�� ����
		    sql_query(" delete from $nc[member_table] where cb_id = '$cb_id' ");
		    
		    // Ŭ�� ȸ�� ��� ����
		    sql_query(" delete from $nc[mb_level_table] where cb_id = '$cb_id' ");
		    
		    // Ŭ�� �޴� ����
		    sql_query(" delete from $nc[menu_table] where cb_id = '$cb_id' ");
		    
		    // Ŭ�� Ŀ�����丮 ����
		    sql_query(" delete from $nc[coverstory_table] where cb_id = '$cb_id' ");
		    
		    // Ŭ�� ���� ��ü ����
        rm_rf("$nc[cb_path]/data/$cb_id");

		    // Ŭ�� �湮 �α� ����
		    sql_query(" drop table $nc[visit_table]_{$cb_id} ");

        // Ŭ�� �湮 �α� ������ ���� 
        sql_query(" drop table $nc[visit_table]_sum_{$cb_id} "); 
		    
		    // �Խ��� ����
		    sql_query(" drop table $g4[write_prefix]{$cb_id} ");
		    
		    // ī�װ� ������Ʈ
		    sql_query(" update $nc[category_table] set cc_total = cc_total - 1 where cc_id = '$cc_id' ");

		    // �Խ��� ���� ����
		    sql_query(" delete from $g4[board_table] where bo_table = '$cb_id' ");
		    
		    // �Խ��� ���� ����
		    sql_query(" delete from $g4[board_file_table] where bo_table = '$cb_id' ");
		    
		    // �Խ��� �ֱ� �Խù� ����
		    sql_query(" delete from $g4[board_new_table] where bo_table = '$cb_id' ");
		    
        // �Խ��� ���� ��ü ����
        rm_rf("$g4[path]/data/file/$cb_id");
		}
	}
}

goto_url("./admin_club_list.php");
?>
