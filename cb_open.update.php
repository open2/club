<?
include_once "./_common.php";

if (!$member[mb_id]) {
	error_msg("�α��� �Ŀ� �̿��ϼ���");
}

if (!$_POST[cb_id]) { alert("Ŭ�� ID�� �ݵ�� �Է��ϼ���."); }
if (!ereg("^([A-Za-z0-9_]{1,20})$", $_POST[cb_id])) { alert("Ŭ�� ���̵�� ������� ������, ����, _ �� ��� �����մϴ�. (20�� �̳�)"); }
if (!$_POST[cb_name]) { alert("Ŭ������ �Է��ϼ���."); }

$cb_id_0        = strip_tags($_POST[cb_id]);
$cb_id          = $nc[cb_disc]. $cb_id_0;
$is_open        = false;
$cb_name        = strip_tags($cb_name);
$cb_keyword     = strip_tags($cb_keyword);
$cb_content     = strip_tags($cb_content);
$cb_state       = 1;
$cb_join_level  = 20;
$cb_opendate    = $g4[time_ymdhis];
$cb_regdate     = $g4[time_ymdhis];
$cb_title_change_date = $g4[time_ymdhis];

// ȸ���� �ִ� Ŭ�� ������ ý
if ($is_admin != "super") {
    $limits = sql_total($nc[tbl_club], "cb_manager", $member[mb_id]);
    if ($nc[nf_limits] && $limits >= $nc[nf_limits]) {
        alert("�� ȸ���� �����Ҽ� �ִ� Ŭ������ $nc[nf_limits] �� ���� �Դϴ�.");
    }
}

// cb_cb_test �̷������δ� Ŭ���� �� �����
$cb_length = strlen($nc[cb_disc]);
if (substr($cb_id_0, 0, $cb_length) == $nc[cb_disc])
    alert("{$cb_id_0} �� �տ� Ŭ��Ȯ���� {$nc[cb_disc]} �� �����Ƿ� ������ �� �����ϴ�.");

// Ŭ�� ���̵� �ߺ� ý
//$chk_id = sql_total($nc[tbl_club], "cb_id", trim($_POST[cb_id]));
$chk_id = sql_total($nc[tbl_club], "cb_id", $cb_id);
if ($chk_id > 0) {
    alert("{$_POST[cb_id]} ��(��) �̹� �����ϴ� Ŭ�����̵� �Դϴ�.");
}

// �Խ��� ���̵� �ߺ� ý
$check_bo = sql_total($g4[board_table], "bo_table", $cb_id);
if ($check_bo) {
    alert("{$cb_id} ��(��) �̹� �����ϴ� �Խ��Ǿ��̵� �Դϴ�.");
}

// Ŭ���̸� �ߺ� �G
$chk_name = sql_total($nc[tbl_club], "cb_name", $cb_name);
if ($chk_name > 0) {
    alert("{$_POST[cb_name]} ��(��) �̹� �����ϴ� Ŭ���̸� �Դϴ�.");
}

// admin/sql_club.sql���� ���ǵ� �⺻ �޴��� ����
$sql_menu = "";
$menu     = explode("|", $nc[nf_menu_list]);
$i = 0;
foreach ($menu as $value) {
    // cb_type=1(����Ŭ��), 2(����Ŭ��), 3(���Ŭ��)
    switch ($cb_type) {
      case 2 :  $cn_list_level=20; $cn_view_level=20; $cn_write_level=20; 
                $cn_reply_level=90; $cn_comment_level=20; $cn_upload_level=20; $cn_download_level=20; 
                break;
      case 3 :  $cn_list_level=20; $cn_view_level=20; $cn_write_level=20; 
                $cn_reply_level=90; $cn_comment_level=20; $cn_upload_level=20; $cn_download_level=20; 
                break;
      case 1 :  
      default:  $cn_list_level=0; $cn_view_level=0; $cn_write_level=20; 
                $cn_reply_level=90; $cn_comment_level=20; $cn_upload_level=20; $cn_download_level=20; 
                break;
    }
    
	  //(`cn_id`,`cb_id`,`cn_name`,`cn_list_level`,`cn_view_level`,`cn_write_level`,`cn_del_level`,
	  // `cn_reply_level`,`cn_comment_level`,`cn_upload_level`,`cn_download_level`,
	  // `cn_type`,`cn_url`,`cn_idx`,`cn_1`,`cn_2`,`cn_3`,`cn_4`,`cn_5`)
    // �ʱ���� �޴� : ��������|Ŀ�����丮|�λ糪����|�����Խ���|������ (admin/sql_club.sql�� ��ġ���� �ּ���)
    switch ($value) {
      case '��������'   : $sql_menu .= " ('', '$cb_id', '$value', $cn_list_level, $cn_view_level, 90, 90, '$cn_reply_level','$cn_comment_level','$cn_upload_level','$cn_download_level', 'N', '', 1, 'Y', '', '', '', '') "; break;
      case 'Ŀ�����丮' : $sql_menu .= " ('', '$cb_id', '$value', $cn_list_level, $cn_view_level, 90, 90, '$cn_reply_level','$cn_comment_level','$cn_upload_level','$cn_download_level', 'C', '', 2, 'Y', '', '', '', '') "; break;
      case '������'     : $sql_menu .= " ('', '$cb_id', '$value', $cn_list_level, $cn_view_level, $cn_write_level, 90, '$cn_reply_level','$cn_comment_level','$cn_upload_level','$cn_download_level', 'I', '', 5, 'Y', '', '', '', '') "; break;
      case '�λ糪����' : 
      case '�����Խ���' : 
      default           : $sql_menu .= " ('', '$cb_id', '$value', $cn_list_level, $cn_view_level, $cn_write_level, 90, '$cn_reply_level','$cn_comment_level','$cn_upload_level','$cn_download_level', 'B', '', 4, 'Y', '', '', '', '') "; break;
    }
    if (count($menu)-1 != $i) {
        $sql_menu .= " , ";
    }
    
    $i++;
}
// if ����Ŭ�� : �����û �Խ��ǵ� �߰�
//if ($cb_type == 2)
//    $sql_menu .= " , ('', '$cb_id', '�����û�ϱ�', 20, 20, 20, 'B', '', 3, '', '', '', '', '') ";

// ������ ������ ���� �̶��.
if ($nc[nf_opentype] == 1) {
    $cb_state     = "4";
    $cb_opendate  = "";
}

if ($cb_type == 2 || $cb_type == 3) {
    $cb_join_level = 1;
}

$sql = " insert into $nc[club_table]
                 set cb_id = '$cb_id',
                    cb_name = '$cb_name',
                    cb_manager = '$member[mb_id]',
                    cc_id = '$cc_id',
                    cb_type = '$cb_type',
                    cb_state = '$cb_state',
                    cb_join = 'Y',
		          			cb_join_level = '$cb_join_level',
          					cb_ask_use = 'N',
	          				cb_latest_use = 'Y',
	          				cb_latest_cols = '2',
          					cb_latest_rows = '5',
                    cb_latest_len = '40',
                    cb_top_method = '1',
                    cb_top_skin = 'images/tskin_bg_07.gif',
	          				cb_box_line_skin = '#E2E2E2',
          					cb_box_bg_skin = '#F7F7F7',
          					cb_title_color_skin = '#C9E4AF',
	          				cb_notice_skin = '$nc[nf_bo_notice_skin]',
	          				cb_coverstory_skin = '$nc[nf_bo_coverstory_skin]',
	          				cb_board_skin = '$nc[nf_bo_board_skin]',
          					cb_gallery_skin = '$nc[nf_bo_gallery_skin]',
          					cb_jisik_skin = '$nc[nf_bo_jisik_skin]',
          					cb_oneline_skin = '$nc[nf_bo_oneline_skin]',
          					cb_1to1_skin = '$nc[nf_bo_1to1_skin]',
          					cb_schedule_skin = '$nc[nf_bo_schedule_skin]',
          					cb_link_skin = '$nc[nf_bo_link_skin]',
	          				cb_pds_skin = '$nc[nf_bo_pds_skin]',
	          				cb_mart_skin = '$nc[nf_bo_mart_skin]',
	          				cb_latest_skin = '$nc[nf_latest_default_skin]',
	          				cb_coverstory_latest_skin = '$nc[nf_latest_default_skin]',
	          				cb_notice_latest_skin = '$nc[nf_latest_default_skin]',
	          				cb_board_latest_skin = '$nc[nf_latest_default_skin]',
	          				cb_gallery_latest_skin = '$nc[nf_latest_default_skin]',
	          				cb_jisik_latest_skin = '$nc[nf_latest_default_skin]',
	          				cb_oneline_latest_skin = '$nc[nf_latest_default_skin]',
	          				cb_1to1_latest_skin = '$nc[nf_latest_default_skin]',
	          				cb_schedule_latest_skin = '$nc[nf_latest_default_skin]',
	          				cb_link_latest_skin = '$nc[nf_latest_default_skin]',
	          				cb_mart_latest_skin = '$nc[nf_latest_default_skin]',
	          				cb_pds_latest_skin = '$nc[nf_latest_default_skin]',
          					cb_connect_skin = '$nc[nf_connect_default_skin]',
                    cb_recommend = 'N',
                    cb_point = '$cb_point',
                    cb_total_member = '1',
                    cb_opendate = '$cb_opendate',
                    cb_regdate = '$cb_regdate',
                    cb_title_change_date = '$cb_title_change_date',
                    cb_1 = '$cb_1',
                    cb_2 = '$cb_2',
                    cb_3 = '$cb_3',
                    cb_4 = '$cb_4',
                    cb_5 = '$cb_5' ";
$result = sql_query($sql);

if ($result) {
	$sql = " insert into $nc[tbl_cb_info]
					 set cb_id = '$cb_id',
					 	 cb_keyword = '$cb_keyword',
					 	 cb_ask_body = '$cb_ask_body',
					 	 cb_content = '$cb_content' ";
	sql_query($sql);
	
	$sql = " insert into $nc[tbl_member]
					 set cb_id = '$cb_id',
						 mb_id = '$member[mb_id]',
						 cm_level = '100',
						 cm_visit = '1',
						 cm_reply = '',
						 cm_logdate = '$g4[time_ymdhis]',
						 cm_regdate = '$g4[time_ymdhis]',
						 cm_1 = '$cm_1',
						 cm_2 = '$cm_2',
						 cm_3 = '$cm_3',
						 cm_4 = '$cm_4',
						 cm_5 = '$cm_5' ";
	sql_query($sql);

	$sql = " INSERT INTO $nc[tbl_menu]
	                     (`cn_id`, `cb_id`, `cn_name`, `cn_list_level`, `cn_view_level`, `cn_write_level`, `cn_del_level`, `cn_reply_level`,`cn_comment_level`,`cn_upload_level`,`cn_download_level`, `cn_type`, `cn_url`, `cn_idx`, `cn_1`, `cn_2`, `cn_3`, `cn_4`, `cn_5`)
	              VALUES $sql_menu ";
    sql_query($sql);
    
    $sql = " INSERT INTO $nc[tbl_mb_level]
                         (`ml_id`, `cb_id`, `cm_level`, `ml_name`, `ml_1`, `ml_2`, `ml_3`, `ml_4`, `ml_5`)
                  VALUES ('', '$cb_id', -100, 'ȸ������', '', '', '', '', ''),
                         ('', '$cb_id', 10, '���Դ��', '', '', '', '', ''),
                         ('', '$cb_id', 20, '��ȸ��', '', '', '', '', ''),
                         ('', '$cb_id', 30, '��ȸ��', '', '', '', '', ''),
                         ('', '$cb_id', 40, '���ȸ��', '', '', '', '', ''),
                         ('', '$cb_id', 50, 'VIPȸ��', '', '', '', '', ''),
                         ('', '$cb_id', 90, '����', '', '', '', '', ''),
                         ('', '$cb_id', 100, '�Ŵ���', '', '', '', '', '') ";
    sql_query($sql);

    // Ŭ�������� html code�� update
    $cb_latest_text = stripslashes($nc[nf_club_text]);
    $sql = " update $nc[club_table] set cb_latest_text = '$cb_latest_text' where cb_id = '$cb_id' ";
    sql_query($sql);
    if ($nc[nf_club_text_use]) {
        $sql = " update $nc[club_table] set cb_latest_use = 'N' where cb_id = '$cb_id' ";
        sql_query($sql);
    }

    // ī�װ��� �ִ� Ŭ���� ������ ������Ʈ
    $sql = " select count(*) as cnt from $nc[club_table] where cc_id = '$cc_id' ";
    $res = sql_fetch($sql);
    $sql = " update $nc[category_table] set cc_total = '$res[cnt]' where cc_id = '$cc_id' ";
    sql_query($sql);
    
	$is_open = true;
}

// Ŭ���Ͽ콺 install�� ���ؼ�
if ($cb_path)
    $nc[cb_path] = $cb_path;
if ($g4_path)
    $g4[path] = $g4_path;

$bo_table = $cb_id;
include_once "$nc[cb_path]/include/club_create.inc.php";

// ���丮�� ���ٸ� �����մϴ�. (�۹̼ǵ� �����ϱ���.)
@mkdir("$g4[path]/data/club/$cb_id", 0707);
@chmod("$g4[path]/data/club/$cb_id", 0707);

// Ŭ���Ͽ콺 ȸ������ Ȯ��
$sql = "select count(*) as cnt from $nc[tbl_member] where cb_id = '$nc[cb_clubhouse]' and mb_id = '$member[mb_id]' ";
$result = sql_fetch($sql);

if ($result[cnt] == 0) { //Ŭ���Ͽ콺 ȸ���� �ƴѰ�쿡�� ȸ������
    $sql = " INSERT INTO $nc[tbl_member] (`cm_id`, `cb_id`, `mb_id`, `cm_level`, `cm_point`, `cm_visit`, `cm_logdate`, `cm_regdate`, `cm_query`, `cm_reply`, `cm_1`, `cm_2`, `cm_3`, `cm_4`, `cm_5`) 
              VALUES 
              ('', '$nc[cb_clubhouse]', '$member[mb_id]', 30, 0, 1, '$g4[time_ymdhis]', '$g4[time_ymdhis]', '', '', '', '', '', '', '') ";
    sql_query($sql);
}

if ($nc[nf_opentype] == 1) {
    $url = "./club_index.php";
} else {
    $url = "./club_main.php?cb_id=$cb_id";
}

// Ŭ���Ͽ콺 install�� �� ���� �׳� ������
if (!$cb_path)
    frame_url($url);
?>
