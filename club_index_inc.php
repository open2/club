<?
include_once "./_common.php";

$g4[title] = "Ŭ������ - $nc[nf_title]";
include_once "./head.sub.php";

// Ŭ�� ���̾ƿ��� �� �����
$main_layout = stripslashes($nc[nf_maintext]);

// Ŭ�� �Խñ� �˻�ȭ���� ��~
$pattern = "|<\?=cb_club_search\(([^)]+)\);\?>|";
$main_layout = preg_replace_callback($pattern, "cb_club_search", $main_layout);

// Ŭ�� �˻���
$pattern = "|<\?=cb_search\(([^)]+)\);\?>|";
$main_layout = preg_replace_callback($pattern, "cb_search", $main_layout);

// �˻� ������ java script�� ���� ��  ����...��..��...
// $main_layout = strip_only($main_layout, "script");

// Ŭ�� �ֽű�
$pattern = "|<\?=replace_cb_latest\(([^)]+)\);\?>|";
$main_layout = preg_replace_callback($pattern, "replace_cb_latest", $main_layout);

// Ŭ���������� �ֽű�
$pattern = "|<\?=replace_cb_notice_random\(([^)]+)\);\?>|";
$main_layout = preg_replace_callback($pattern, "replace_cb_notice_random", $main_layout);

// Ŭ�� ���
$pattern = "|<\?=club_list\(([^)]+)\);\?>|";
$main_layout = preg_replace_callback($pattern, "replace_club_list", $main_layout);

echo $main_layout;

include "$nc[cb_path]/tail.sub.php";
?>

<?
// Ŭ����� ���ο� �ֱ�
function replace_club_list($matches) {

    $latest_match = $matches[1];
    list($kind, $cc_id, $skin_dir, $rows, $subj_len, $latest_title)=explode(",",$latest_match); 

    $latest_data = club_list($kind, $cc_id, $skin_dir, $rows, $subj_len, $latest_title);

    return $latest_data;
}

// Ŭ���ֽű��� ���ο� �ֱ�
function replace_cb_latest($matches) {

    $latest_match = $matches[1];
    list($cb_id, $skin, $ca_name, $line, $subj_len)=explode(",",$latest_match); 

    $latest_data = cb_latest($skin, $cb_id, $ca_name, $line, $subj_len);

    return $latest_data;
}

// ���� ����/Ŀ�����丮 ���� ���ο� �ֱ�
function replace_cb_notice_random($matches) {

    $latest_match = $matches[1];
    list($skin, $ca_name, $line, $subj_len)=explode(",",$latest_match); 

    $latest_data = cb_notice_random($skin, $ca_name, $line, $subj_len);

    return $latest_data;
}

// Ŭ�� �Խñ� �˻��� ���ο� �ֱ�
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

// Ŭ�� �˻��� ���ο� �ֱ�
function cb_club_search($matches) {
    global $config, $g4, $nc, $cb;

    //$latest_match = $matches[1];
    //list($skin, $title, $line, $subj_len)=explode(",",$latest_match); 
    //$latest_data = cb_latest($skin, $cb[cb_id], $title, $line, $subj_length);

    // ����� �ȳ�����
    $rows="none";
    
    ob_start();
    include "$nc[cb_path]/cb_list.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>
