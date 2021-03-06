<?
include_once "./_common.php";

if (!$member[mb_id]) {
	error_msg("로그인 후에 이용하세요");
}

if (!$_POST[cb_id]) { alert("클럽 ID는 반드시 입력하세요."); }
if (!ereg("^([A-Za-z0-9_]{1,20})$", $_POST[cb_id])) { alert("클럽 아이디는 공백없이 영문자, 숫자, _ 만 사용 가능합니다. (20자 이내)"); }
if (!$_POST[cb_name]) { alert("클럽명을 입력하세요."); }

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

// 회원의 최대 클럽 생성수 첵
if ($is_admin != "super") {
    $limits = sql_total($nc[tbl_club], "cb_manager", $member[mb_id]);
    if ($nc[nf_limits] && $limits >= $nc[nf_limits]) {
        alert("한 회원이 생성할수 있는 클럽수는 $nc[nf_limits] 개 까지 입니다.");
    }
}

// cb_cb_test 이런식으로는 클럽을 못 만든다
$cb_length = strlen($nc[cb_disc]);
if (substr($cb_id_0, 0, $cb_length) == $nc[cb_disc])
    alert("{$cb_id_0} 의 앞에 클럽확장자 {$nc[cb_disc]} 가 있으므로 생성할 수 없습니다.");

// 클럽 아이디 중복 첵
//$chk_id = sql_total($nc[tbl_club], "cb_id", trim($_POST[cb_id]));
$chk_id = sql_total($nc[tbl_club], "cb_id", $cb_id);
if ($chk_id > 0) {
    alert("{$_POST[cb_id]} 은(는) 이미 존재하는 클럽아이디 입니다.");
}

// 게시판 아이디 중복 첵
$check_bo = sql_total($g4[board_table], "bo_table", $cb_id);
if ($check_bo) {
    alert("{$cb_id} 은(는) 이미 존재하는 게시판아이디 입니다.");
}

// 클럽이름 중복 췍
$chk_name = sql_total($nc[tbl_club], "cb_name", $cb_name);
if ($chk_name > 0) {
    alert("{$_POST[cb_name]} 은(는) 이미 존재하는 클럽이름 입니다.");
}

// admin/sql_club.sql에서 정의된 기본 메뉴를 생성
$sql_menu = "";
$menu     = explode("|", $nc[nf_menu_list]);
$i = 0;
foreach ($menu as $value) {
    // cb_type=1(공개클럽), 2(승인클럽), 3(비밀클럽)
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
    // 초기생성 메뉴 : 공지사항|커버스토리|인사나누기|자유게시판|갤러리 (admin/sql_club.sql과 일치시켜 주세요)
    switch ($value) {
      case '공지사항'   : $sql_menu .= " ('', '$cb_id', '$value', $cn_list_level, $cn_view_level, 90, 90, '$cn_reply_level','$cn_comment_level','$cn_upload_level','$cn_download_level', 'N', '', 1, 'Y', '', '', '', '') "; break;
      case '커버스토리' : $sql_menu .= " ('', '$cb_id', '$value', $cn_list_level, $cn_view_level, 90, 90, '$cn_reply_level','$cn_comment_level','$cn_upload_level','$cn_download_level', 'C', '', 2, 'Y', '', '', '', '') "; break;
      case '갤러리'     : $sql_menu .= " ('', '$cb_id', '$value', $cn_list_level, $cn_view_level, $cn_write_level, 90, '$cn_reply_level','$cn_comment_level','$cn_upload_level','$cn_download_level', 'I', '', 5, 'Y', '', '', '', '') "; break;
      case '인사나누기' : 
      case '자유게시판' : 
      default           : $sql_menu .= " ('', '$cb_id', '$value', $cn_list_level, $cn_view_level, $cn_write_level, 90, '$cn_reply_level','$cn_comment_level','$cn_upload_level','$cn_download_level', 'B', '', 4, 'Y', '', '', '', '') "; break;
    }
    if (count($menu)-1 != $i) {
        $sql_menu .= " , ";
    }
    
    $i++;
}
// if 승인클럽 : 등업신청 게시판도 추가
//if ($cb_type == 2)
//    $sql_menu .= " , ('', '$cb_id', '등업신청하기', 20, 20, 20, 'B', '', 3, '', '', '', '', '') ";

// 관리자 승인후 개설 이라면.
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
                  VALUES ('', '$cb_id', -100, '회원정지', '', '', '', '', ''),
                         ('', '$cb_id', 10, '가입대기', '', '', '', '', ''),
                         ('', '$cb_id', 20, '준회원', '', '', '', '', ''),
                         ('', '$cb_id', 30, '정회원', '', '', '', '', ''),
                         ('', '$cb_id', 40, '우대회원', '', '', '', '', ''),
                         ('', '$cb_id', 50, 'VIP회원', '', '', '', '', ''),
                         ('', '$cb_id', 90, '스텝', '', '', '', '', ''),
                         ('', '$cb_id', 100, '매니저', '', '', '', '', '') ";
    sql_query($sql);

    // 클럽메인의 html code를 update
    $cb_latest_text = stripslashes($nc[nf_club_text]);
    $sql = " update $nc[club_table] set cb_latest_text = '$cb_latest_text' where cb_id = '$cb_id' ";
    sql_query($sql);
    if ($nc[nf_club_text_use]) {
        $sql = " update $nc[club_table] set cb_latest_use = 'N' where cb_id = '$cb_id' ";
        sql_query($sql);
    }

    // 카테고리에 있는 클럽의 갯수를 업데이트
    $sql = " select count(*) as cnt from $nc[club_table] where cc_id = '$cc_id' ";
    $res = sql_fetch($sql);
    $sql = " update $nc[category_table] set cc_total = '$res[cnt]' where cc_id = '$cc_id' ";
    sql_query($sql);
    
	$is_open = true;
}

// 클럽하우스 install을 위해서
if ($cb_path)
    $nc[cb_path] = $cb_path;
if ($g4_path)
    $g4[path] = $g4_path;

$bo_table = $cb_id;
include_once "$nc[cb_path]/include/club_create.inc.php";

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
@mkdir("$g4[path]/data/club/$cb_id", 0707);
@chmod("$g4[path]/data/club/$cb_id", 0707);

// 클럽하우스 회원여부 확인
$sql = "select count(*) as cnt from $nc[tbl_member] where cb_id = '$nc[cb_clubhouse]' and mb_id = '$member[mb_id]' ";
$result = sql_fetch($sql);

if ($result[cnt] == 0) { //클럽하우스 회원이 아닌경우에만 회원가입
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

// 클럽하우스 install을 할 때는 그냥 나간다
if (!$cb_path)
    frame_url($url);
?>
