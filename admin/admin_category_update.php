<?
include_once "./_common.php";

if ($_POST[exec] == "update") {
		foreach ($chk as $i) {
		    $cc_name  = strip_tags($cc_name_list[$i]);
		    $cc_idx   = (int) $cc_idx[$i];
        $cc_id    = $cc_id_list[$i];

				$sql = " update $nc[category_table]
										set cc_name = '$cc_name',
												cc_idx = '$cc_idx'
									where cc_id = '$cc_id' ";

				sql_query($sql);
		}
}

if ($_POST[exec] == "delete") {

		foreach ($chk as $i) {
        // 등록된 클럽이 있는 경우, 삭제할 수 없습니다.
        $cc = get_category($cc_id[$i]);
        if ($cc[cc_total] > 0)
            alert("카테고리 ( $cc[cc_name] )에 등록된 클럽이 $cc[cc_total] 개이므로, 삭제할 수 없습니다.");

				$sql = " delete from $nc[category_table] where cc_id = '{$cc_id[$i]}' ";
				sql_query($sql);
		}
}

if ($_POST[exec] == "add") { 

    $cc_id    = (int) $cc_id;
    $cc_mid   = (int) $cc_mid;
    $cc_idx   = (int) $cc_idx;
    $cc_name  = strip_tags($cc_name);
    $cc_1     = strip_tags($cc_1);
    $cc_2     = strip_tags($cc_2);
    $cc_3     = strip_tags($cc_3);
    $cc_4     = strip_tags($cc_4);
    $cc_5     = strip_tags($cc_5);

		$sql = " insert into $nc[category_table]
						    set cc_id   = '$cc_id',
						        cc_mid  = '$cc_mid',
     							  cc_idx  = '$cc_idx',
							      cc_name = '$cc_name',
							      cc_1    = '$cc_1',
							      cc_2    = '$cc_2',
							      cc_3    = '$cc_3',
							      cc_4    = '$cc_4',
							      cc_5    = '$cc_5' ";
		sql_query($sql);
}

if ($_GET[exec] == "delete") {

    $cc_id = (int) $cc_id;

    // 등록된 클럽이 있는 경우, 삭제할 수 없습니다.
    $cc = get_category($cc_id);
    if ($cc[cc_total] > 0)
        alert("카테고리 ( $cc[cc_name] )에 등록된 클럽이 $cc[cc_total] 개이므로, 삭제할 수 없습니다.");

		$sql = " delete from $nc[category_table] where cc_id = '$cc_id' ";
		sql_query($sql);
		
		alert("카테고리 ( $cc[cc_name] )이 삭제되었습니다");
}

goto_url("./admin_category_list.php");
?>
