<?
/*******************************************************************************
** 공통 변수, 상수, 코드
*******************************************************************************/
define("_NCCLUB_", TRUE);

// 클럽의 설정값
$nc[gr_id]          = "club";           // 그룹아이디
$nc[gr_subject]     = "클럽";           // 그룹제목
$nc[de_cb_skin]     = "club";           // 초기 클럽 게시판 스킨
$nc[cb_disc]        = "cb_";            // 클럽 게시판 bo_table 구분자, 사용하지 않는다면 비워두세요

// 클럽 테이블
$nc[config_table]     = $nc[tbl_config]     = "nc_config";          // 클럽 설정
$nc[category_table]   = $nc[tbl_category]   = "nc_category";        // 클럽 카테고리
$nc[club_table]       = $nc[tbl_club]       = "nc_club";            // 클럽 정의
$nc[cb_info_table]    = $nc[tbl_cb_info]    = "nc_club_info";       // 클럽 정보
$nc[coverstory_table] = $nc[tbl_coverstory] = "nc_coverstory";      // 클럽 커버스토리
$nc[member_table]     = $nc[tbl_member]     = "nc_member";          // 클럽 회원
$nc[mb_level_table]   = $nc[tbl_mb_level]   = "nc_member_level";    // 클럽 회원레벨
$nc[menu_table]       = $nc[tbl_menu]       = "nc_menu";            // 클럽 메뉴
$nc[visit_table]      = $nc[tbl_visit]      = "nc_visit";           // 클럽 방문자
$nc[cb_history_table] = $nc[tbl_cb_history] = "nc_club_history";    // 클럽 히스토리

// 클럽 주소에 쓰일 웹 경로
$nc[cb_url_path]    = $g4[url] . "/" . "club";

//클럽하우스 정의
$nc[cb_clubhouse]         = $nc[cb_disc] . "clubhouse";
$nc[bo_clubhouse]         = $g4[write_prefix] . $nc[cb_clubhouse];
$nc[visit_clubhouse]      = "nc_visit_" . $nc[cb_disc] . "clubhouse";
$nc[visit_sum_clubhouse]  = "nc_visit_sum_" . $nc[cb_disc] . "clubhouse";

$nc[cm_join_query_count]  = 3; // 클럽가입 질문의 갯수

// 클럽메인 스킨 정의
$nc[member_skin_path]= $nc[cb_path] . "/skin_main/member/" . "default";

// 클럽스킨 정의 (정의가 되지 않으면 클럽 메뉴에 안나옵니다 - 해당 스킨은 사용하지 않음, notice/coverstory 스킨은 무조건 있어야 합니다.)
$cb_board_skin_path = "$nc[cb_path]/skin/board/";
$cb_notice_skin_path = $cb_board_skin_path;
$cb_coverstory_skin_path = $cb_board_skin_path;
$cb_gallery_skin_path = "$nc[cb_path]/skin/gallery/"; 

//$cb_notice_skin_path = "$nc[cb_path]/skin/notice/";
//$cb_coverstory_skin_path = "$nc[cb_path]/skin/coverstory/";
//$cb_jisik_skin_path = "$nc[cb_path]/skin/jisik/";
//$cb_1to1_skin_path = "$nc[cb_path]/skin/1to1/"; 
$cb_oneline_skin_path = "$nc[cb_path]/skin/oneline/";
//$cb_schedule_skin_path = "$nc[cb_path]/skin/schedule/";
//$cb_link_skin_path = "$nc[cb_path]/skin/link/";
//$cb_mart_skin_path = "$nc[cb_path]/skin/mart/";
//$cb_pds_skin_path = "$nc[cb_path]/skin/pds/";
?>
