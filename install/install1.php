<?
include_once "./_common.php";
include_once "../lib/club.lib.php";

// �ְ� �����ڸ� ��ġ�� �� �� �ֽ�
if ($is_admin !== 'super') {
    alert("�ְ� �����ڸ� ��ġ�� �� �� �ֽ��ϴ�");
}

if ($_POST[agree] != 1) {
    alert("����� ���� �ϼž߸� ��ġ �� �̿��� �����մϴ�.");
}

// ��ġ ���丮�� ������ ��ġ�� �ߴ�
$install_name = $cb_path . "/install_dir";

if(is_dir($install_name)){
    alert("�̹� Ŭ���� ��ġ�Ǿ� �ֽ��ϴ�. $install_name ���丮�� �����Ͻ� �� �ٽ� ��ġ�� ���ּ���");
}

// �۹̼��� ������ ���� �������� ��´�. drwxrwxrwx
function get_perms($mode)
{
    /* Determine Type */
    if( $mode & 0x1000 )
        $perms["type"] = 'p'; /* FIFO pipe */
    else if( $mode & 0x2000 )
        $perms["type"] = 'c'; /* Character special */
    else if( $mode & 0x4000 )
        $perms["type"] = 'd'; /* Directory */
    else if( $mode & 0x6000 )
        $perms["type"] = 'b'; /* Block special */
    else if( $mode & 0x8000 )
        $perms["type"] = '-'; /* Regular */
    else if( $mode & 0xA000 )
        $perms["type"] = 'l'; /* Symbolic Link */
    else if( $mode & 0xC000 )
        $perms["type"] = 's'; /* Socket */
    else
        $perms["type"] = 'u'; /* UNKNOWN */

    /* Determine permissions */
    $perms["owner_read"]    = ($mode & 00400) ? 'r' : '-';
    $perms["owner_write"]   = ($mode & 00200) ? 'w' : '-';
    $perms["owner_execute"] = ($mode & 00100) ? 'x' : '-';
    $perms["group_read"]    = ($mode & 00040) ? 'r' : '-';
    $perms["group_write"]   = ($mode & 00020) ? 'w' : '-';
    $perms["group_execute"] = ($mode & 00010) ? 'x' : '-';
    $perms["world_read"]    = ($mode & 00004) ? 'r' : '-';
    $perms["world_write"]   = ($mode & 00002) ? 'w' : '-';
    $perms["world_execute"] = ($mode & 00001) ? 'x' : '-';

    /* Adjust for SUID, SGID and sticky bit */
    if( $mode & 0x800 )
        $perms["owner_execute"] = ($perms["owner_execute"]=='x') ? 's' : 'S';
    if( $mode & 0x400 )
        $perms["group_execute"] = ($perms["group_execute"]=='x') ? 's' : 'S';
    if( $mode & 0x200 )
        $perms["world_execute"] = ($perms["world_execute"]=='x') ? 't' : 'T';

    return $perms;
}

// ��Ʈ ���丮�� ����, ���丮 ���� �������� �˻�.
$perms = get_perms(fileperms("$cb_path/"));
if ($perms["world_read"].$perms["world_write"].$perms["world_execute"] != "rwx") {
    alert("Ŭ�� ���丮�� �۹̼��� 707�� �����Ͽ� �ֽʽÿ�.\\n\\n$> chmod 707 . \\n\\n�� ���� ��ġ�Ͽ� �ֽʽÿ�.");
    exit;
}

// ���̺� ���� ------------------------------------
$file = implode("", file("./sql_club.sql"));
eval("\$file = \"$file\";");

$f = explode(";", $file);
for ($i=0; $i<count($f); $i++) {
    if (trim($f[$i]) == "") continue;
    mysql_query($f[$i]) or die(mysql_error());
}
// ���̺� ���� ------------------------------------


// �׷� ���
$sql_group = " gr_subject      = '$nc[gr_subject]',
               gr_admin        = '$gr_admin',  
               gr_use_access   = '$gr_use_access',
               gr_1            = '$gr_1',
               gr_2            = '$gr_2',
               gr_3            = '$gr_3',
               gr_4            = '$gr_4',
               gr_5            = '$gr_5',
               gr_6            = '$gr_6',
               gr_7            = '$gr_7',
               gr_8            = '$gr_8',
               gr_9            = '$gr_9',
               gr_10           = '$gr_10' ";

$sql = " insert into $g4[group_table]
            set gr_id = '$nc[gr_id]',
                $sql_group ";
mysql_query($sql);

// ���丮 ����
@mkdir("$g4[path]/data/club", 0707);
@chmod("$g4[path]/data/club", 0707);

// Ŭ������ html �ʱ�ȭ
$file = implode("", file("./cb_main.txt"));
$main_html = addslashes($file);
$sql = " update $nc[config_table] set nf_maintext = '$main_html'";
sql_query($sql);

// ����Ŭ���� ���� html �ʱ�ȭ
$file = implode("", file("./club_main.txt"));
$club_html = addslashes($file);
$sql = " update $nc[config_table] set nf_club_text = '$club_html'";
sql_query($sql);

// �Խ��� ����Ʈ ���� (Ŭ�� ����Ʈ�� �״������ �����ϰ�)
$sql = " update $nc[config_table] set nf_read_point = $config[cf_read_point], nf_write_point = $config[cf_write_point], nf_comment_point = $config[cf_comment_point], nf_download_point = $config[cf_download_point] ";
sql_query($sql);

// Ŭ������� db��
$service=addslashes(implode("", file("./service.txt")));
$sql = " update $nc[config_table] set nf_clause = '$service' ";
sql_query($sql);

// Ŭ���Ͽ콺�� �����ϱ� ���� Ŭ���Ͽ콺 �Խ��� ���� �����
$sql = " delete from $g4[board_table] where bo_table = '$nc[cb_clubhouse]' ";
sql_query($sql);
$sql = " delete from $g4[board_new_table] where bo_table = '$nc[cb_clubhouse]' ";
sql_query($sql);
$sql = " delete from $g4[board_new_table] where gr_id = '$nc[gr_id]' ";
sql_query($sql, FALSE);

sql_query("drop table $nc[bo_clubhouse]");
sql_query("drop table $nc[visit_clubhouse]");
sql_query("drop table $nc[visit_sum_clubhouse]");

// Ŭ���Ͽ콺�� �����Ѵ�
$cb_keyword     = "Ŭ���Ͽ콺,�,HELP,������";
$cb_content     = "Ŭ���Ͽ콺�� Ŭ������� ������ ���� Ŭ���Դϴ�";
$cb_type        = 1; // ����Ŭ��
$cc_id          = 180; // ��Ÿ
$cb_state       = 1;
$cb_join        = 'Y';
$cb_join_level  = 20; // ��ȸ��

$nc[nf_bo_skin]   = "club";
$nc[nf_menu_list] = "��������|Ŀ�����丮|Ŭ��ȫ���ϱ�|�λ糪����|�����Խ���|������";

$nc[nf_bo_notice_skin] = "default";
$nc[nf_bo_coverstory_skin] = "default";
$nc[nf_bo_board_skin] = "default";
$nc[nf_bo_gallery_skin] = "default";
$nc[nf_bo_jisik_skin] = "default";
$nc[nf_bo_oneline_skin] = "default";
$nc[nf_bo_1to1_skin] = "default";
$nc[nf_bo_schedule_skin] = "default";
$nc[nf_bo_link_skin] = "default";
$nc[nf_bo_pds_skin] = "default";
$nc[nf_bo_mart_skin] = "default";
$nc[nf_latest_default_skin] = "default";
$nc[nf_connect_default_skin] = "default";

// db ���� ������ ���� ���ؼ�
if (strtolower($g4['charset']) == 'utf-8') @mysql_query(" set names utf8 ");
else if (strtolower($g4['charset']) == 'euc-kr') @mysql_query(" set names euckr ");

include_once("../cb_open.update.php");

// ��ġ ���丮 ����
rename("../install", "../install_dir");

error_msg("��ġ�� �Ϸ��߽��ϴ�.\n data/�� club/ ���丮�� �۹̼��� 755�� �ٽ� �ٲ��ּ���.", ".", 1);
?>
