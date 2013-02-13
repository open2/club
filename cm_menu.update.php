<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("해당 클럽이 존재하지 않습니다.");
}

if (!$is_manager) {
    error_msg("스텝권한 이상만 접근 가능합니다.");
}

$count = count($cn_id);

// 회원가입시 레벨
$join_level = $cb[cb_join_level];

$i = 0;
foreach ($cn_id as $value) {

    $tmp_name[$i] = strip_tags($tmp_name[$i]);
    $tmp_name[$i] = preg_replace ("/[#\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "",  $tmp_name[$i]); 

    $cn_name[$i] = strip_tags($cn_name[$i]);
    $cn_name[$i] = preg_replace ("/[#\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "",  $cn_name[$i]); 

    $sql_common = " cn_name = '$cn_name[$i]',
                    cn_type = '$cn_type[$i]',
                    cn_url = '$cn_url[$i]',
                    cn_idx = '$i' ";
    switch ($cb[cb_type]) {
        case 2 :  // 승인클럽
                  $sql_level = " cn_view_level = '$join_level', cn_write_level = '$join_level', cn_del_level = '90', cn_reply_level='90', cn_comment_level='$join_level', cn_upload_level='$join_level', cn_download_level='$join_level' "; 
                  break;
        case 3 :  // 비밀클럽
                  $sql_level = " cn_list_level='$join_level', cn_view_level = '$join_level', cn_write_level = '$join_level', cn_del_level = '90', cn_reply_level='90', cn_comment_level='$join_level', cn_upload_level='$join_level', cn_download_level='$join_level' "; 
                  break;
        case 1 : // 공개클럽
        default:
                  $sql_level = " cn_list_level='0', cn_view_level = '0', cn_write_level = '$join_level', cn_del_level = '90', cn_reply_level='90', cn_comment_level='$join_level', cn_upload_level='$join_level', cn_download_level='$join_level' "; 
                  break;
    }
    if (!$value) {
        $sql = " insert into $nc[tbl_menu]
                         set $sql_common,
                             $sql_level,
                             cb_id = '$cb_id' ";
        mysql_query($sql);
    } else {
        if ($cn_type[$i] == "X") {
            $sql = " delete from $nc[tbl_menu] where cb_id = '$cb_id' and cn_id = '$value' ";
            $result = mysql_query($sql);
            if ($result) {
                $sql_add = " delete from $g4[write_prefix]{$cb_id} where ca_name = '$cn_name[$i]' ";
                mysql_query($sql_add);
            }
        } else {
            $sql = " update $nc[tbl_menu]
                        set $sql_common
                      where cb_id = '$cb_id'
                        and cn_id = '$value' ";
            $result = mysql_query($sql);
            if ($result && ($tmp_name[$i] != $cn_name[$i])) {
                if ( eregi("N|C|B|I|K|O|T|S|A|J|P", $cn_type[$i]) ) {
                    $sql_add = " update $g4[write_prefix]{$cb_id} set ca_name = '$cn_name[$i]' where ca_name = '$tmp_name[$i]' ";
                    mysql_query($sql_add);
                }
            }
        }
    }
    
   	// 'N', 'C', 'B', 'I', 'K', 'O', 'T', 'S', 'A', 'J', 'P', 'G', 'U', 'L'
    if ( eregi("N|C|B|I|K|O|T|S|A|J|P", $cn_type[$i]) ) {
        $ca_name .= $cn_name[$i]. "|";
    }
    $i++;
}


$sql = " update $g4[board_table] set bo_category_list = '$ca_name' where bo_table = '$cb_id' ";
sql_query($sql);

alert("클럽메뉴가 업데이트 되었습니다. 클럽 홈에서 변경된 것을 확인할 수 있습니다", "./cm_menu.php?doc=cm_menu.php&cb_id=$cb_id");
?>
