<?
/*******************************************************************************
** ���� ����, ���, �ڵ�
*******************************************************************************/
define("_NCCLUB_", TRUE);

// Ŭ���� ������
$nc[gr_id]          = "club";           // �׷���̵�
$nc[gr_subject]     = "Ŭ��";           // �׷�����
$nc[de_cb_skin]     = "club";           // �ʱ� Ŭ�� �Խ��� ��Ų
$nc[cb_disc]        = "cb_";            // Ŭ�� �Խ��� bo_table ������, ������� �ʴ´ٸ� ����μ���

// Ŭ�� ���̺�
$nc[config_table]     = $nc[tbl_config]     = "nc_config";          // Ŭ�� ����
$nc[category_table]   = $nc[tbl_category]   = "nc_category";        // Ŭ�� ī�װ�
$nc[club_table]       = $nc[tbl_club]       = "nc_club";            // Ŭ�� ����
$nc[cb_info_table]    = $nc[tbl_cb_info]    = "nc_club_info";       // Ŭ�� ����
$nc[coverstory_table] = $nc[tbl_coverstory] = "nc_coverstory";      // Ŭ�� Ŀ�����丮
$nc[member_table]     = $nc[tbl_member]     = "nc_member";          // Ŭ�� ȸ��
$nc[mb_level_table]   = $nc[tbl_mb_level]   = "nc_member_level";    // Ŭ�� ȸ������
$nc[menu_table]       = $nc[tbl_menu]       = "nc_menu";            // Ŭ�� �޴�
$nc[visit_table]      = $nc[tbl_visit]      = "nc_visit";           // Ŭ�� �湮��
$nc[cb_history_table] = $nc[tbl_cb_history] = "nc_club_history";    // Ŭ�� �����丮

// Ŭ�� �ּҿ� ���� �� ���
$nc[cb_url_path]    = $g4[url] . "/" . "club";

//Ŭ���Ͽ콺 ����
$nc[cb_clubhouse]         = $nc[cb_disc] . "clubhouse";
$nc[bo_clubhouse]         = $g4[write_prefix] . $nc[cb_clubhouse];
$nc[visit_clubhouse]      = "nc_visit_" . $nc[cb_disc] . "clubhouse";
$nc[visit_sum_clubhouse]  = "nc_visit_sum_" . $nc[cb_disc] . "clubhouse";

$nc[cm_join_query_count]  = 3; // Ŭ������ ������ ����

// Ŭ������ ��Ų ����
$nc[member_skin_path]= $nc[cb_path] . "/skin_main/member/" . "default";

// Ŭ����Ų ���� (���ǰ� ���� ������ Ŭ�� �޴��� �ȳ��ɴϴ� - �ش� ��Ų�� ������� ����, notice/coverstory ��Ų�� ������ �־�� �մϴ�.)
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
