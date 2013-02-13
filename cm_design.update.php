<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("해당 클럽이 존재하지 않습니다.");
}

if (!$is_manager) {
    error_msg("스텝권한 이상만 접근 가능합니다.");
}

// 가변 파일 업로드
$upload = array();
$sql	= array();
$is_up  = false;
for ($i=0; $i<count($_FILES[cb_top_img][name]); $i++) {
    
    $tmp_file = $_FILES[cb_top_img][tmp_name][$i];
    $filename = $_FILES[cb_top_img][name][$i];
    $filesize = $_FILES[cb_top_img][size][$i];

    if (is_uploaded_file($tmp_file)) 
    {

        // 프로그램 원래 파일명
        $upload[$i][source] = $filename;
        $upload[$i][size]	= $filesize;

        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
        $filename = preg_replace("/\.(php|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        // 접미사를 붙인 파일명
        $upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.urlencode($filename);

        $dest_file = "$g4[path]/data/club/$cb_id/" . $upload[$i][file];

        // 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
        @mkdir("$g4[path]/data/club/$cb_id", 0707);
        @chmod("$g4[path]/data/club/$cb_id", 0707);
        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        move_uploaded_file($tmp_file, $dest_file) or die($_FILES[cb_top_img][error][$i]);
        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, 0606);
        
        $is_up = true;
    }
    
    if ($is_up == true || $cb_img_del == 1) {
        @unlink("$g4[path]/data/club/$cb_id/$cb_top_img");
        $sql_file = " cb_top_img = '{$upload[$i][file]}',
                      cb_top_img_src = '{$upload[$i][source]}', ";
    }
    
}

$sql = " update $nc[club_table]
            set cb_top_method = '$cb_top_method',
                $sql_file
                cb_top_skin = '$cb_top_skin',
                cb_box_line_skin = '$cb_box_line_skin',
                cb_title_color_skin = '$cb_title_color_skin',
                cb_box_bg_skin = '$cb_box_bg_skin'
          where cb_id = '$cb_id' ";
sql_query($sql);

frame_url("./club_manager.php?doc=$doc&cb_id=$cb_id");
?>      
