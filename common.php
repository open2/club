<?
// 변수값들을 초기화
$nc = Array();    // 기본설정
$cb = Array();    // 클럽기본 정보
$cm = Array();    // 클럽회원 정보
$cn = Array();    // 클럽메뉴 권한

// 클럽 경로
$nc['cb_path'] = $cb_path;

//경로의 오류를 없애기 위해 $cb_path 변수는 해제
unset($cb_path);

// 클럽 설정을 읽습니다.
include_once("$nc[cb_path]/club.config.php");

// 설정파일의 클럽설정과 db의 클럽설정을 합칩니다
$cfg  = sql_fetch(" select * from $nc[config_table] ", FALSE);
if (!$cfg[nf_title]) {
    alert("클럽이 설치되어있지 않습니다.\\n\\n프로그램 설치 후 실행하시기 바랍니다.", "$nc[cb_path]/install/install.php");
    exit;
}
$nc   = array_merge($nc, $cfg);

// 클럽의 라이브러리 파일
include_once "$nc[cb_path]/lib/club.lib.php";

// 사용하는 변수 escape
$cb_id_0  = strip_tags($cb_id);
$doc      = strip_tags($doc);

// 클럽의 범용성 확보를 위한 꽁수 (cb_clubhouse도 가능하고, clubhouse도 가능하다)
// 클럽 이름을 cb_cb_ 이딴식으로 하면 절대로 안된다. ㅎㅎ
$cb_id = get_cb_id($cb_id_0);

// 클럽 정보를 읽습니다.
if ($cb_id_0 || $bo_table) {
    if ($cb_id_0) {
        $bo_table = $cb_id;
    } else {
        $cb_id = $bo_table;
    }

    $cb = get_club($cb_id);
    $cm = get_club_member($cb_id, $member[mb_id]);
}

// 회원이라면 staff/manager인지 확인
if ($member[mb_id]) {
    $is_manager = is_manager();
}

// 카테고리를 지정합니다.
if ($view[ca_name]) {
    $cate = $view[ca_name];
} else {
    $cate = $sca;
}

// 메뉴권한을 읽습니다
$cn = get_menu($cb[cb_id], $cate);

// 클럽스킨 정의 (정의가 되지 않으면 클럽 메뉴에 안나옵니다 - 해당 스킨은 사용하지 않음)
$cb_notice_skin_path = "$cb_notice_skin_path/$cb[cb_notice_skin]";
$cb_coverstory_skin_path = "$cb_coverstory_skin_path/$cb[cb_coverstory_skin]";
$cb_board_skin_path = "$cb_board_skin_path/$cb[cb_board_skin]";

if ($cb_oneline_skin_path)
    if ($cb[cb_oneline_skin])
        $cb_oneline_skin_path = "$cb_oneline_skin_path/$cb[cb_oneline_skin]";
    else if ($nc[nf_bo_oneline_skin])
        $cb_oneline_skin_path = "$cb_oneline_skin_path/$nc[nf_bo_oneline_skin]";
    else
        $cb_oneline_skin_path = "";

if ($cb_gallery_skin_path)
    if ($cb[cb_gallery_skin])
        $cb_gallery_skin_path = "$cb_gallery_skin_path/$cb[cb_gallery_skin]";
    else if ($nc[nf_bo_oneline_skin])
        $cb_gallery_skin_path = "$cb_gallery_skin_path/$nc[nf_bo_gallery_skin]";
    else
        $cb_gallery_skin_path = "";

if ($cb_jisik_skin_path)
    if ($cb[cb_jisik_skin])
        $cb_jisik_skin_path = "$cb_jisik_skin_path/$cb[cb_jisik_skin]";
    else if ($nc[nf_bo_jisik_skin])
        $cb_jisik_skin_path = "$cb_jisik_skin_path/$nc[nf_bo_jisik_skin]";
    else
        $cb_jisik_skin_path = "";

if ($cb_1to1_skin_path)
    if ($cb[cb_1to1_skin])
        $cb_1to1_skin_path = "$cb_1to1_skin_path/$cb[cb_1to1_skin]";
    else if ($nc[nf_bo_1to1_skin])
        $cb_1to1_skin_path = "$cb_1to1_skin_path/$nc[nf_bo_1to1_skin]";
    else
        $cb_1to1_skin_path = "";

if ($cb_schedule_skin_path)
    if ($cb[cb_schedule_skin])
        $cb_schedule_skin_path = "$cb_schedule_skin_path/$cb[cb_schedule_skin]";
    else if ($nc[nf_bo_schedule_skin])
        $cb_schedule_skin_path = "$cb_schedule_skin_path/$nc[nf_bo_schedule_skin]";
    else
        $cb_schedule_skin_path = "";

if ($cb_link_skin_path)
    if ($cb[cb_link_skin])
        $cb_link_skin_path = "$cb_link_skin_path/$cb[cb_link_skin]";
    else if ($nc[nf_bo_link_skin])
        $cb_link_skin_path = "$cb_link_skin_path/$nc[nf_bo_link_skin]";
    else
        $cb_link_skin_path = "";

if ($cb_mart_skin_path)
    if ($cb[cb_mart_skin])
        $cb_mart_skin_path = "$cb_mart_skin_path/$cb[cb_mart_skin]";
    else if ($nc[nf_bo_mart_skin])
        $cb_mart_skin_path = "$cb_mart_skin_path/$nc[nf_bo_mart_skin]";
    else
        $cb_mart_skin_path = "";

if ($cb_pds_skin_path)
    if ($cb[cb_pds_skin])
        $cb_pds_skin_path = "$cb_pds_skin_path/$cb[cb_pds_skin]";
    else if ($nc[nf_bo_pds_skin])
        $cb_pds_skin_path = "$cb_pds_skin_path/$nc[nf_bo_pds_skin]";
    else
        $cb_pds_skin_path = "";
?>
