<?
// ���������� �ʱ�ȭ
$nc = Array();    // �⺻����
$cb = Array();    // Ŭ���⺻ ����
$cm = Array();    // Ŭ��ȸ�� ����
$cn = Array();    // Ŭ���޴� ����

// Ŭ�� ���
$nc['cb_path'] = $cb_path;

//����� ������ ���ֱ� ���� $cb_path ������ ����
unset($cb_path);

// Ŭ�� ������ �н��ϴ�.
include_once("$nc[cb_path]/club.config.php");

// ���������� Ŭ�������� db�� Ŭ�������� ��Ĩ�ϴ�
$cfg  = sql_fetch(" select * from $nc[config_table] ", FALSE);
if (!$cfg[nf_title]) {
    alert("Ŭ���� ��ġ�Ǿ����� �ʽ��ϴ�.\\n\\n���α׷� ��ġ �� �����Ͻñ� �ٶ��ϴ�.", "$nc[cb_path]/install/install.php");
    exit;
}
$nc   = array_merge($nc, $cfg);

// Ŭ���� ���̺귯�� ����
include_once "$nc[cb_path]/lib/club.lib.php";

// ����ϴ� ���� escape
$cb_id_0  = strip_tags($cb_id);
$doc      = strip_tags($doc);

// Ŭ���� ���뼺 Ȯ���� ���� �Ǽ� (cb_clubhouse�� �����ϰ�, clubhouse�� �����ϴ�)
// Ŭ�� �̸��� cb_cb_ �̵������� �ϸ� ����� �ȵȴ�. ����
$cb_id = get_cb_id($cb_id_0);

// Ŭ�� ������ �н��ϴ�.
if ($cb_id_0 || $bo_table) {
    if ($cb_id_0) {
        $bo_table = $cb_id;
    } else {
        $cb_id = $bo_table;
    }

    $cb = get_club($cb_id);
    $cm = get_club_member($cb_id, $member[mb_id]);
}

// ȸ���̶�� staff/manager���� Ȯ��
if ($member[mb_id]) {
    $is_manager = is_manager();
}

// ī�װ��� �����մϴ�.
if ($view[ca_name]) {
    $cate = $view[ca_name];
} else {
    $cate = $sca;
}

// �޴������� �н��ϴ�
$cn = get_menu($cb[cb_id], $cate);

// Ŭ����Ų ���� (���ǰ� ���� ������ Ŭ�� �޴��� �ȳ��ɴϴ� - �ش� ��Ų�� ������� ����)
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
