<?
include_once "./_common.php";

// Ŭ���� �������� �ʰų� $cb_id�� �������
if (!$cb[cb_id]) {
    error_msg("�ش� Ŭ���� �������� �ʽ��ϴ�.", "$nc[cb_url_path]/club_index.php");
}

if (!is_manager()) {
    error_msg("���ܱ��� �̻� ���� �����մϴ�.");
}

// Ŭ���� �ߺ� �˻�
if ($cb_name != $tmp_cb_name) {
    $chk_name = sql_total($nc[tbl_club], "cb_name", $cb_name);
    if ($check > 0) {
        error_msg("�̹� ������� Ŭ�����Դϴ�.\\n\\n�ٸ� Ŭ������ �����ϼ���.");
    }
}

// ī�װ� ������Ʈ
if ($cc_id != $tmp_cc_id) {
    sql_query(" update $nc[category_table] set cc_total = cc_total - 1 where cc_id = '$tmp_cc_id' ");
    sql_query(" update $nc[category_table] set cc_total = cc_total + 1 where cc_id = '$cc_id' ");
}

// � ���¿� ���� ī�װ� ������Ʈ
if ($cb_state != $tmp_cb_state && $cb_state == 3) {
    sql_query(" update $nc[category_table] set cc_total = cc_total - 1 where cc_id = '$cc_id' ");
}

//���,��� ���� ����� �ٲٸ� +1 by Daeng2 
if ($cb_state != $tmp_cb_state && $cb_state == 1) { 
    sql_query(" update $nc[category_table] set cc_total = cc_total + 1 where cc_id = '$cc_id' "); 
} 

$cb_left_textarea = addslashes($cb_left_textarea);
$cb_tail_textarea = addslashes($cb_tail_textarea);

$sql = " update $nc[tbl_club]
              set 
                  cc_id = '$cc_id',
                  cb_type = '$cb_type',
                  cb_state = '$cb_state',
                  cb_connect_view = '$cb_connect_view',
                  cb_left_textarea = '$cb_left_textarea',
                  cb_tail_textarea = '$cb_tail_textarea'
            where cb_id = '$cb_id' ";
sql_query($sql);

//Ŭ������ ����Ǿ��� ��
if ($cb_name !== $cb[cb_name]) {
  $sql = " update $nc[tbl_club]
              set 
                  cb_name = '$cb_name',
                  cb_title_change_date = '$g4[time_ymdhis]'
            where cb_id = '$cb_id' ";
}
$result = sql_query($sql);

if ($result) {
    $sql = " update $nc[tbl_cb_info]
                set cb_keyword = '$cb_keyword',
                    cb_ask_body = '$cb_ask_body',
                    cb_content = '$cb_content'
              where cb_id = '$cb_id' ";
    sql_query($sql);

    // �Խ��� ������ ����
    $sql = " update $g4[board]
                set bo_name = '$cb_name'
              where bo_table = '$cb_id' ";
    sql_query($sql);
}

frame_url("./club_manager.php?doc=$doc&cb_id=$cb_id");
?>            
