<?
include_once "./_common.php";
include_once "../lib/club.lib.php";

// 최고 관리자만 설치를 할 수 있슴
if ($is_admin !== 'super') {
    alert("최고 관리자만 설치를 할 수 있습니다");
}

if ($_POST[agree] != 1) {
    alert("약관에 동의 하셔야만 설치 및 이용이 가능합니다.");
}

// 설치 디렉토리가 있으면 설치를 중단
$install_name = $cb_path . "/install_dir";

if(is_dir($install_name)){
    alert("이미 클럽이 설치되어 있습니다. $install_name 디렉토리를 삭제하신 후 다시 설치를 해주세요");
}

// 퍼미션을 다음과 같은 형식으로 얻는다. drwxrwxrwx
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

// 루트 디렉토리에 파일, 디렉토리 생성 가능한지 검사.
$perms = get_perms(fileperms("$cb_path/"));
if ($perms["world_read"].$perms["world_write"].$perms["world_execute"] != "rwx") {
    alert("클럽 디렉토리의 퍼미션을 707로 변경하여 주십시오.\\n\\n$> chmod 707 . \\n\\n그 다음 설치하여 주십시오.");
    exit;
}

// 테이블 생성 ------------------------------------
$file = implode("", file("./sql_club.sql"));
eval("\$file = \"$file\";");

$f = explode(";", $file);
for ($i=0; $i<count($f); $i++) {
    if (trim($f[$i]) == "") continue;
    mysql_query($f[$i]) or die(mysql_error());
}
// 테이블 생성 ------------------------------------


// 그룹 등록
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

// 디렉토리 생성
@mkdir("$g4[path]/data/club", 0707);
@chmod("$g4[path]/data/club", 0707);

// 클럽메인 html 초기화
$file = implode("", file("./cb_main.txt"));
$main_html = addslashes($file);
$sql = " update $nc[config_table] set nf_maintext = '$main_html'";
sql_query($sql);

// 개별클럽의 메인 html 초기화
$file = implode("", file("./club_main.txt"));
$club_html = addslashes($file);
$sql = " update $nc[config_table] set nf_club_text = '$club_html'";
sql_query($sql);

// 게시판 포인트 설정 (클럽 포인트를 그누보드와 동일하게)
$sql = " update $nc[config_table] set nf_read_point = $config[cf_read_point], nf_write_point = $config[cf_write_point], nf_comment_point = $config[cf_comment_point], nf_download_point = $config[cf_download_point] ";
sql_query($sql);

// 클럽약관을 db에
$service=addslashes(implode("", file("./service.txt")));
$sql = " update $nc[config_table] set nf_clause = '$service' ";
sql_query($sql);

// 클럽하우스를 생성하기 전에 클럽하우스 게시판 등을 지운다
$sql = " delete from $g4[board_table] where bo_table = '$nc[cb_clubhouse]' ";
sql_query($sql);
$sql = " delete from $g4[board_new_table] where bo_table = '$nc[cb_clubhouse]' ";
sql_query($sql);
$sql = " delete from $g4[board_new_table] where gr_id = '$nc[gr_id]' ";
sql_query($sql, FALSE);

sql_query("drop table $nc[bo_clubhouse]");
sql_query("drop table $nc[visit_clubhouse]");
sql_query("drop table $nc[visit_sum_clubhouse]");

// 클럽하우스를 생성한다
$cb_keyword     = "클럽하우스,운영,HELP,고객지원";
$cb_content     = "클럽하우스는 클럽운영자의 지원을 위한 클럽입니다";
$cb_type        = 1; // 공개클럽
$cc_id          = 180; // 기타
$cb_state       = 1;
$cb_join        = 'Y';
$cb_join_level  = 20; // 준회원

$nc[nf_bo_skin]   = "club";
$nc[nf_menu_list] = "공지사항|커버스토리|클럽홍보하기|인사나누기|자유게시판|갤러리";

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

// db 생성 오류를 막기 위해서
if (strtolower($g4['charset']) == 'utf-8') @mysql_query(" set names utf8 ");
else if (strtolower($g4['charset']) == 'euc-kr') @mysql_query(" set names euckr ");

include_once("../cb_open.update.php");

// 설치 디렉토리 변경
rename("../install", "../install_dir");

error_msg("설치를 완료했습니다.\n data/와 club/ 디렉토리의 퍼미션을 755로 다시 바꿔주세요.", ".", 1);
?>
