<?
include_once "./_common.php";

$g4[title] = "클럽메인 - $nc[nf_title]";
include_once "./head.sub.php";

// 클럽 레이아웃을 내 맘대로
$main_layout = stripslashes($nc[nf_maintext]);

// 클럽 게시글 검색화면을 싹~
$pattern = "|<\?=cb_club_search\(([^)]+)\);\?>|";
$main_layout = preg_replace_callback($pattern, "cb_club_search", $main_layout);

// 클럽 검색을
$pattern = "|<\?=cb_search\(([^)]+)\);\?>|";
$main_layout = preg_replace_callback($pattern, "cb_search", $main_layout);

// 검색 때문에 java script를 죽일 수  없다...ㅠ..ㅠ...
// $main_layout = strip_only($main_layout, "script");

// 클럽 최신글
$pattern = "|<\?=replace_cb_latest\(([^)]+)\);\?>|";
$main_layout = preg_replace_callback($pattern, "replace_cb_latest", $main_layout);

// 클럽공지사항 최신글
$pattern = "|<\?=replace_cb_notice_random\(([^)]+)\);\?>|";
$main_layout = preg_replace_callback($pattern, "replace_cb_notice_random", $main_layout);

// 클럽 목록
$pattern = "|<\?=club_list\(([^)]+)\);\?>|";
$main_layout = preg_replace_callback($pattern, "replace_club_list", $main_layout);

echo $main_layout;

include "$nc[cb_path]/tail.sub.php";
?>

<?
// 클럽목록 메인에 넣기
function replace_club_list($matches) {

    $latest_match = $matches[1];
    list($kind, $cc_id, $skin_dir, $rows, $subj_len, $latest_title)=explode(",",$latest_match); 

    $latest_data = club_list($kind, $cc_id, $skin_dir, $rows, $subj_len, $latest_title);

    return $latest_data;
}

// 클럽최신글을 메인에 넣기
function replace_cb_latest($matches) {

    $latest_match = $matches[1];
    list($cb_id, $skin, $ca_name, $line, $subj_len)=explode(",",$latest_match); 

    $latest_data = cb_latest($skin, $cb_id, $ca_name, $line, $subj_len);

    return $latest_data;
}

// 랜덤 공지/커버스토리 글을 메인에 넣기
function replace_cb_notice_random($matches) {

    $latest_match = $matches[1];
    list($skin, $ca_name, $line, $subj_len)=explode(",",$latest_match); 

    $latest_data = cb_notice_random($skin, $ca_name, $line, $subj_len);

    return $latest_data;
}

// 클럽 게시글 검색을 메인에 넣기
function cb_search($matches) {
    global $config, $g4, $nc, $cb;

    //$latest_match = $matches[1];
    //list($skin, $title, $line, $subj_len)=explode(",",$latest_match); 
    //$latest_data = cb_latest($skin, $cb[cb_id], $title, $line, $subj_length);

    ob_start();
    include "$nc[cb_path]/bbs/search.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

// 클럽 검색을 메인에 넣기
function cb_club_search($matches) {
    global $config, $g4, $nc, $cb;

    //$latest_match = $matches[1];
    //list($skin, $title, $line, $subj_len)=explode(",",$latest_match); 
    //$latest_data = cb_latest($skin, $cb[cb_id], $title, $line, $subj_length);

    // 목록이 안나오게
    $rows="none";
    
    ob_start();
    include "$nc[cb_path]/cb_list.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>
