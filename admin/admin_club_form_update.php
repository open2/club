<?
include_once "./_common.php";

if ($_POST[exec] == "update") {
	foreach ($cb_ask as $value) {
		$cb_ask_body .= $value. "|";
	}
	
	if ($cb_manager) {
	    $chk_man = sql_total($nc[tbl_member], "mb_id", $cb_manager, " and cb_id = '$cb_id' ");
	    if (!$chk_man) {
	        alert("클럽매니저로 지정한 회원이 현재 해당 클럽의 회원이 아닙니다.");
	    }
	}
	
	$sql_1 = " update $nc[club_table]
      				  set cb_name         = '$cb_name',
			        		  cb_manager      = '$cb_manager',
        					  cc_id           = '$cc_id',
				        	  cb_type         = '$cb_type',
        					  cb_state        = '$cb_state',
				        	  cb_join         = '$cb_join',
        					  cb_join_level   = '$cb_join_level',
				        	  cb_ask_use      = '$cb_ask_use',
        					  cb_recommend    = '$cb_recommend',
        					  cb_point        = '$cb_point',
        					  cb_1            = '$cb_1',
				        	  cb_2            = '$cb_2',
        					  cb_3            = '$cb_3',
        					  cb_4            = '$cb_4',
        					  cb_5            = '$cb_5'
			        where cb_id = '$cb_id' ";
	$result = sql_query($sql_1);
							
	if ($result) {
    	$sql_2 = " update $nc[cb_info_table]
          				  set cb_keyword  = '$cb_keyword',
    	        				  cb_ask_body = '$cb_ask_body',
    					          cb_content  = '$cb_content'
         			    where cb_id = '$cb_id' ";
    	sql_query($sql_2);
    	
    	sql_query(" update $nc[category_table] set cc_total = cc_total - 1 where cc_id = '$tmp_cc_id' ");
    	sql_query(" update $nc[category_table] set cc_total = cc_total + 1 where cc_id = '$cc_id' ");
    }
}

goto_url("./admin_club_form.php?cb_id=$cb_id");
?>
