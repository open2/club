<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("�ش� Ŭ���� �������� �ʽ��ϴ�.");
}

if (!$is_manager) {
    error_msg("���ܱ��� �̻� ���� �����մϴ�.");
}

// ���� ���� ���ε�
$upload = array();
$sql	= array();
$is_up  = false;
for ($i=0; $i<count($_FILES[cb_top_img][name]); $i++) {
    
    $tmp_file = $_FILES[cb_top_img][tmp_name][$i];
    $filename = $_FILES[cb_top_img][name][$i];
    $filesize = $_FILES[cb_top_img][size][$i];

    if (is_uploaded_file($tmp_file)) 
    {

        // ���α׷� ���� ���ϸ�
        $upload[$i][source] = $filename;
        $upload[$i][size]	= $filesize;

        // �Ʒ��� ���ڿ��� �� ������ -x �� �ٿ��� ����θ� �˴��� ������ ���� ���ϵ��� ��
        $filename = preg_replace("/\.(php|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        // ���̻縦 ���� ���ϸ�
        $upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.urlencode($filename);

        $dest_file = "$g4[path]/data/club/$cb_id/" . $upload[$i][file];

        // ���丮�� ���ٸ� �����մϴ�. (�۹̼ǵ� �����ϱ���.)
        @mkdir("$g4[path]/data/club/$cb_id", 0707);
        @chmod("$g4[path]/data/club/$cb_id", 0707);
        // ���ε尡 �ȵȴٸ� �����޼��� ����ϰ� �׾�����ϴ�.
        move_uploaded_file($tmp_file, $dest_file) or die($_FILES[cb_top_img][error][$i]);
        // �ö� ������ �۹̼��� �����մϴ�.
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
