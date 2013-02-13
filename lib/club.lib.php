<?
// ���� �޼���
function error_msg($msg, $url="", $target=0)
{
	global $nc, $cb, $cb_path;
	
	if(isset($nc[cb_path])) {
	    $cb_path = $nc[cb_path];
	}
	if ($target == 1) { $target = "parent"; }
	else if ($target >= 2) { $target = "top"; }
	
	goto_url("$cb_path/_error.php?target=$target&msg=". urlencode($msg). "&url=". urlencode($url));
	exit();
}

// Ŭ�� ����
function get_club($cb_id)
{
	global $g4, $nc;
	
	$sql = " select *
	           from $nc[club_table] as a, $nc[cb_info_table] as b
			  where a.cb_id = '$cb_id'
			    and a.cb_id = b.cb_id ";
	return sql_fetch_array(sql_query($sql));
}

// ī�װ� ����
function get_category($cc_id)
{
	global $nc;
	
	$sql = " select *
	           from $nc[category_table]
			  where cc_id = '$cc_id' ";
	return sql_fetch_array(sql_query($sql));
}

// Ŭ�� ȸ�� ����
function get_club_member($cb_id, $mb_id)
{
    global $g4, $nc, $cb;
    
    if (!$mb_id) {
        return;
    }
    $sql = " select a.*, b.ml_name, b.ml_1, b.ml_2, b.ml_3, b.ml_4, b.ml_5
               from $nc[member_table] as a left join $nc[mb_level_table] as b on (a.cm_level = b.cm_level)
              where mb_id = '$mb_id'
                and a.cb_id = '$cb_id'
              ";
    $cm =  sql_fetch_array(sql_query($sql));

    // ȸ���� �ƴ϶�� ������ �湮�� �������� ��
    if (!$cm[mb_id]) {
        $cm[cm_level] = 0;

        // ���δ�� �ܰ����� Ȯ��
        if ($cb[cb_type] == 2) {
            $sql = " select count(*) as cnt from $nc[member_table] where mb_id='$mb_id' and cb_id = '$cb_id' ";
            $result = sql_fetch($sql);
            if ($result[cnt]) {
                $cm[member_join_wait] = 1;
                $cm[mb_id] = $mb_id;
            }
        }
    }

    return $cm;
}

// �����̻�
function is_manager()
{
    global $nc, $cb, $cm, $is_admin;
    
    $is = "";
    if (!$cb[cb_id]) {
        return $is;
    }

    // �״����� �������� ���, ������ manager, ������ 100���� �ο�
    if ($is_admin == "super") {
        $is = "manager";
        $cm[cm_level] = 100;
        return $is;
    }

    if ($cm[mb_id]) {
        $row = sql_fetch(" select cb_manager from $nc[club_table] where cb_manager = '$cm[mb_id]' and cb_id = '$cb[cb_id]' ");
        if ($row[cb_manager])
            $is = "manager";
        else if ($cm[cm_level] >= 90) 
            $is = "staff";
    }

    return $is;
}

// Ŭ�� �̸� �ߺ� �˻�
function check_club_name($cb_name) {
    global $g4, $nc;
    
    $cb_name = trim($cb_name);
    
    $sql = " select count(*) as cnt
               from $nc[club_table]
              where cb_name = '$cb_name' ";

    return mysql_fetch_array(mysql_query($sql));
}

// �湮�� ī��Ʈ
function get_count($cb_id)
{
    global $nc;
    
    $table = $nc[tbl_visit]. "_sum_". $cb_id;
    $row  = sql_fetch(" select * from $table where vs_date = now() ");
    $row1 = sql_fetch(" select sum(vs_count) as total from $table ");
    return $vs = Array("date"=>$row[vs_date], "today"=>$row[vs_count], "total"=>$row1[total]);
}

// ��ü �Խñ�
function get_total_count($cb_id)
{
    global $g4, $nc;
    
    if (!$cb_id) { return; }
    $table = $g4[write_prefix] . $cb_id;
    $sql = " select distinct wr_parent 
               from $table ";
    $result = sql_query($sql);
    return $total_count = mysql_num_rows($result);
}

function get_my_club($mb_id)
{
    global $nc;
    
    $sql = " select a.cb_id, a.cm_level, b.cb_name, b.cb_manager
               from $nc[tbl_member] as a
          left join $nc[tbl_club] as b
                 on a.cb_id = b.cb_id
              where a.mb_id = '$mb_id'
           order by a.cm_logdate desc ";
    $result = mysql_query($sql);
    
    for ($i=0; $row=mysql_fetch_array($result); $i++) {
        if ($row[cb_manager] == $mb_id) 
          $option .= "<option value='$row[cb_id]'>$row[cb_name] (Ŭ���Ŵ���)</option>\n";
        else
          $option .= "<option value='$row[cb_id]'>$row[cb_name]</option>\n";
    }
    return $option;
}

//ȸ�� ��� �ɼ�
function get_level_option($cb_id)
{
    global $nc;
    
    $sql = " select *
               from $nc[mb_level_table]
              where cb_id = '$cb_id'
           order by cm_level asc ";
    $result = sql_query($sql);
    
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $option .= "<option value='$row[cm_level]'>$row[ml_name]</option>\n";
    }
    return $option;
}

// �޴� ����
function get_menu($cb_id, $cn_name)
{
    global $nc;
    
    return sql_fetch(" select * from $nc[tbl_menu] where cb_id = '$cb_id' and cn_name = '$cn_name' ");
}

function get_club_skin_dir($skin, $len='')
{
    global $nc;

    $result_array = array();

    $dirname = "$nc[cb_path]/skin/$skin/";
    $handle = opendir($dirname);
    while ($file = readdir($handle)) 
    {
        if($file == "."||$file == "..") continue;

        if (is_dir($dirname.$file)) $result_array[] = $file;
    }
    closedir($handle);
    sort($result_array);

    return $result_array;
}

// ��� �̹��� ��������
function get_background($img)
{
    global $g4, $nc, $cb;
    
    $background = $nc[cb_path] . "/" . $cb[cb_top_skin];
    if ($cb[cb_top_method] == 2 && $cb[cb_top_img]) {
        $img_dir = "$g4[path]/data/club/$cb[cb_id]";
        if (file_exists("$img_dir/$cb[cb_top_img]")) {
            $background = "$img_dir/". urlencode($cb[cb_top_img]);
        }
    }
    return $background;
}

// Ŀ�����丮
function get_coverstory($cb_id, $skin="default")
{
    global $cb, $nc;
    
    $skin_path = "$nc[cb_path]/skin/coverstory/$skin";
    
    $sql = " select * from $nc[tbl_coverstory] where cb_id = '$cb_id' and cs_use = 'Y' order by cs_regdate desc limit 1 ";
    $row = sql_fetch($sql);
    
    $image = "./images/cover.jpg";
    if ( file_exists("./data/$cb_id/$row[cs_img]") && $row[cs_img] ) {
        $image = "./data/$cb_id/". urlencode($row[cs_img]);
    }
    
    if (!$row[cs_id]) {
        $row[cs_subject] = "Ŀ�����丮�� �ۼ��� �ּ���";
    }
    
    ob_start();
    include "$skin_path/coverstory.skin.php";
    $content = ob_get_contents();
    ob_end_clean();
    
    return $content;
}

// Ŭ�� �޴� ǥ��
function get_club_menu($cb_id, $cn_name, $cn_type, $cn_url="", $cn_datetime, $cn_hours=24)
{
    global $nc, $g4, $cb;
    
    // ���ο� ���� �ִ� �޴��� ���ؼ�
    $diff = time() - strtotime($cn_datetime);
    if ($diff < 3600*$cn_hours)
        $newimg = "<img src='$nc[cb_path]/images/icon_new.gif' border='0' align='absmiddle'>";

    $pre_style = "<tr><td align='left' class='cmenu'>";
    $title = get_text($cn_name) . "-" . $cb[cb_name];
    $a_href = "<a href='$g4[bbs_path]/board.php?bo_table=$cb_id&sca=". urlencode($cn_name). "' target='CLUB_BODY' title='" . $title . "'>". get_text($cn_name). "</a> " . $newimg;

    switch ($cn_type) {
	  case "G" :
		$str = "$pre_style". get_text($cn_name). "</td></tr>\n";
        break;
    case "N" :
		$str = "$pre_style<img src='$nc[cb_path]/images/ico_note_notice.gif' border='0' align='absmiddle'> $a_href</td></tr>\n";
        break;
    case "C" :
		$str = "$pre_style<img src='$nc[cb_path]/images/ico_note_coverstory.gif' border='0' align='absmiddle'> $a_href</td></tr>\n";
        break;
    case "B" :
		$str = "$pre_style<img src='$nc[cb_path]/images/ico_note.gif' border='0' align='absmiddle'> $a_href</td></tr>\n";
        break;
    case "I" :
		$str = "$pre_style<img src='$nc[cb_path]/images/ico_note_album.gif' border='0' align='absmiddle'> $a_href</td></tr>\n";
        break;
    case "K" :
		$str = "$pre_style<img src='$nc[cb_path]/images/ico_note_knowledge.gif' border='0' align='absmiddle'> $a_href</td></tr>\n";
        break;
    case "O" :
		$str = "$pre_style<img src='$nc[cb_path]/images/ico_note_oneline.gif' border='0' align='absmiddle'> $a_href</td></tr>\n";
        break;
    case "T" :
		$str = "$pre_style<img src='$nc[cb_path]/images/ico_note_1to1.gif' border='0' align='absmiddle'> $a_href</td></tr>\n";
        break;
    case "S" :
		$str = "$pre_style<img src='$nc[cb_path]/images/ico_note_schedule.gif' border='0' align='absmiddle'> $a_href</td></tr>\n";
        break;
    case "A" :
		$str = "$pre_style<img src='$nc[cb_path]/images/ico_note_link.gif' border='0' align='absmiddle'> $a_href</td></tr>\n";
        break;
    case "J" :
		$str = "$pre_style<img src='$nc[cb_path]/images/ico_note_mart.gif' border='0' align='absmiddle'> $a_href</td></tr>\n";
        break;
    case "P" :
		$str = "$pre_style<img src='$nc[cb_path]/images/ico_note_pda.gif' border='0' align='absmiddle'> $a_href</td></tr>\n";
        break;
    case "U" :
    if (!$cn_url) $error_msg = " <b>(LINK����)</b>";
		$str = "$pre_style<img src='$nc[cb_path]/images/ico_note_link.gif' border='0' align='absmiddle'> <a href='" . set_http($cn_url) ."' target='_blank'>". get_text($cn_name) . $error_msg. "</td></tr>\n";
        break;
    case "L" :
		$str = "<tr><td height='1' background='$nc[cb_path]/images/bg_dot02.gif'></td></tr>\n";
        break;
    default :
    	$str = "$pre_style<img src='$nc[cb_path]/images/ico_note.gif' border='0' align='absmiddle'> $a_href</td></tr>\n";
        break;
    }
	
	return $str;
}

// Ŭ�� �޴� �ɼ��� ���� (get_category_option �Լ�)
function get_club_menu_option($bo_table, $cm_level)
{
    global $g4, $nc;
    
    $sql = " select bo_category_list from $g4[board_table] where bo_table = '$bo_table' ";
    $row = sql_fetch($sql);
    $arr = explode("|", $row[bo_category_list]); // �����ڰ� , �� �Ǿ� ����
    
    $str = "";
    foreach ($arr as $value) {
        $ca = get_menu($bo_table, $value);
        if (!$ca[cn_id]) { continue; }
        if ($ca[cn_write_level] <= $cm_level) {
            $str .= "<option value='$ca[cn_name]'>$ca[cn_name]</option>\n";
        }
    }
    return $str;
}

// ������ ��
function sql_total($table, $column, $data, $que="")
{
    $sql = " select count(*) as cnt
               from $table
              where $column = '$data'
                    $que ";
    $row = sql_fetch($sql);
    return $row[cnt];
}

// ȸ�� ǥ��
function view_member($mb_id)
{
	global $config;
	
	$mb 			= get_member($mb_id);
	$mb_homepage	= get_text(addslashes($mb[mb_homepage]));
	$tmp_name		= get_text(cut_str($mb[mb_nick], $config[cf_cut_name])); // ������ �ڸ��� ��ŭ�� �̸� ���
	$mb_name 		= get_sideview($mb[mb_id], $tmp_name, $mb[mb_email], $mb_homepage);
	
	return $mb_name;
}

function view_club_menu($cb_id)
{
    global $nc, $g4;
    
    $sql    = " select * from $nc[tbl_menu] where cb_id = '$cb_id' order by cn_idx asc ";
    $result = sql_query($sql);
    
    $str = "";
    for ($i=0; $row=mysql_fetch_array($result); $i++) {
        $str .= get_club_menu($cb_id, $row[cn_name], $row[cn_type], $row[cn_url], $row[cn_datetime]);
    }
    $str .= "<tr><td height=1></td></tr>";
    
    return $str;
}

// �ܺηα���
function cb_outlogin($skin_dir="default")
{
    global $config, $member, $g4, $urlencode, $is_admin, $nc, $cb, $cm;

    $nick  = cut_str($member['mb_nick'], $config[cf_cut_name]);
    $point = number_format($member['mb_point']);

    $cb_outlogin_skin = "$nc[cb_path]/skin/outlogin/$skin_dir";

    // ���� ���� ������ �ִٸ�
    if ($member[mb_id]) {

        // �Ҵ����� �� ���� ������ ����� �ʿ䰡 ����
        if ($g4['b4_version']) {
            $memo_not_read = $member[mb_memo_unread];
        } else {
        // �Ϲ������� ���
            $sql = " select count(*) as cnt from {$g4['memo_table']} where me_recv_mb_id = '{$member['mb_id']}' and me_read_datetime = '0000-00-00 00:00:00' ";
            $row = sql_fetch($sql);
            $memo_not_read = $row['cnt'];
        }

        $is_auth = false;
        $sql = " select count(*) as cnt from $g4[auth_table] where mb_id = '$member[mb_id]' ";
        $row = sql_fetch($sql);
        if ($row['cnt']) 
            $is_auth = true;
    }

    ob_start();
    if ($member['mb_id'])
        include_once "$cb_outlogin_skin/outlogin.skin.2.php";
    else // �α��� ���̶��
        include_once "$cb_outlogin_skin/outlogin.skin.1.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

// �ֽű� ���� (g4 �ֽű� ���̺귯�� ����)
function cb_latest($skin_dir="", $bo_table, $ca_name, $rows=10, $subject_len=40)
{
    global $g4, $nc, $cm, $cb;

    $skin_dir = trim($skin_dir);
    if ($skin_dir)
        $latest_skin_path = "$nc[cb_path]/skin/latest/$skin_dir";
    else
        $latest_skin_path = "$nc[cb_path]/skin/latest/default";

    $list = array();

    $sql = " select * from {$g4[board_table]} where bo_table = '$bo_table'";
    $board = sql_fetch($sql);

    $ca_name = trim($ca_name);
    if ($ca_name) {
        $board[bo_subject] = $ca_name;
    }

    $tmp_write_table = $g4[write_prefix] . $bo_table; // �Խ��� ���̺� ��ü�̸�
    //$sql = " select * from $tmp_write_table where wr_is_comment = 0 and ca_name = '$ca_name' order by wr_id desc limit 0, $rows ";
    // ���� �ڵ� ���� �ӵ��� ����
    if ($ca_name == "") {
        $sql = " select * from $tmp_write_table where wr_is_comment = 0 order by wr_num limit 0, $rows ";
    } else {
        $sql = " select * from $tmp_write_table where wr_is_comment = 0 and ca_name = '$ca_name' order by wr_num limit 0, $rows ";
    }

    $result = sql_query($sql);
    for ($i=0; $row = sql_fetch_array($result); $i++) {
        // �״����� �Ҵ��ѿ����� gallery info�� ���������� �ΰ� �μ��� �ʿ�
        if ($g4['b4_version']) 
            $list[$i] = get_list($row, $board, $latest_skin_path, $subject_len, 1);
        else
            $list[$i] = get_list($row, $board, $latest_skin_path, $subject_len);

        $list[$i][href]=$list[$i][href]."&sca=$ca_name";

        $sql = " select * from $nc[menu_table] where cb_id = '$bo_table' and cn_name = '$row[ca_name]' ";
        $cn[$i] = sql_fetch($sql);
    }
    
    ob_start();
    include "$latest_skin_path/latest.skin.php";
    $content = ob_get_contents();

    ob_end_clean();

    return $content;
}

// ���� ����/Ŀ�����丮�� ���� (g4 �ֽű� ���̺귯�� ����)
function cb_notice_random($skin_dir="", $ca_name, $rows=10, $subject_len=40)
{
    global $g4, $nc;

    $skin_dir = trim($skin_dir);
    if ($skin_dir)
        $latest_skin_path = "$nc[cb_path]/skin/latest/$skin_dir";
    else
        $latest_skin_path = "$nc[cb_path]/skin/latest/default";

    $list = array();

    $ca_name = trim($ca_name);

    // random�ϰ� �Խñ��� ���Ѵ�
    if ($nc[nf_random_days] > 0) {
        $timelimits = date("Y-m-d", $g4[server_time] - ($nc[nf_random_days] * 86400));
        $notine_datime = " and cb_count_notice_datetime > '$timelimits' ";
        $coverstory_datime = " and cb_count_coverstory_datetime > '$timelimits' ";
    }

    if ($ca_name=="��������") {
        $sql = " select cb_id from $nc[club_table] where cb_count_notice > 0 $notine_datime order by rand() limit $rows ";
        $cn_type="N";
    } else if ($ca_name=="Ŀ�����丮") {
        $sql = " select cb_id from $nc[club_table] where cb_count_coverstory > 0 $coverstory_datime order by rand() limit $rows ";
        $cn_type="C";
    } else
        return;
    $result = sql_query($sql);

    for ($i=0; $row = sql_fetch_array($result); $i++) {
          // �Խ��� ������ ���ϰ�
          $sql = " select * from {$g4[board_table]} where bo_table = '$row[cb_id]'";
          $board = sql_fetch($sql);
  
          // ī�װ� ������ ���ϰ�
          $cn = sql_fetch(" select * from $nc[menu_table] where cb_id = '$row[cb_id]' and cn_type = '$cn_type' ");

          // �Խñ� ������ ���ϰ�
          $tmp_write_table = $g4[write_prefix] . $board[bo_table]; // �Խ��� ���̺� ��ü�̸�
          $sql = " select * from $tmp_write_table where wr_is_comment = 0 and ca_name='$cn[cn_name]' order by wr_num limit 1 ";
          $row2 = sql_fetch($sql);
          $list[$i] = get_list($row2, $board, $latest_skin_path, $subject_len, 1);
          $list[$i][href]=$list[$i][href]."&sca=$ca_name";
          
          $sql = " select * from $nc[menu_table] where cb_id = '$bo_table' and cn_name = '$row[ca_name]' ";
          $cn[$i] = sql_fetch($sql);

    }
    
    ob_start();
    include "$latest_skin_path/latest.skin.php";
    $content = ob_get_contents();

    ob_end_clean();

    return $content;
}

// Ŭ�� ���� ȭ���� �ֱٱ� (��. Ŭ�� ��ü�� �ֱٱ�)
// ���� ������� (����� cb_�� �����ϴ� ���̺��� ������ ������)
function cb_latest_main($skin_dir="", $rows=10, $subject_len=40, $latest_title="Ŭ�� �ֽű�")
{
    global $g4, $nc, $member, $is_admin;

    if ($skin_dir)
        $latest_skin_path = "$nc[cb_path]/skin_main/latest/$skin_dir";
    else
        $latest_skin_path = "$nc[cb_path]/skin_main/latest/default";

    $list = array();
    $list_bo = array(); // ���̺� �̸�
        
    $big_rows = $rows * 2; // Ȥ�� ���߿� �Ʒ��κ��� �������� ���� �����ְ� rows�� 2�踦 ���� �ɴϴ�.
    $sql = " select * from $g4[board_new_table] where bo_table like '{$nc[cb_disc]}%' and wr_id = wr_parent $kind_sql order by bn_id desc limit 0, $big_rows ";
    $result = sql_query($sql);

    $i = 0;
    while($row = sql_fetch_array($result)) {
        if($i >= $rows) {
            break; 
        }    
        $sql = " select * from $g4[board_table] where bo_table = '$row[bo_table]' ";
        $board = sql_fetch($sql);
        $tmp_write_table = $g4[write_prefix] . $row[bo_table]; // �Խ��� ���̺� ��ü�̸�
        $sql = " select * from $tmp_write_table where wr_id = '$row[wr_id]' ";
        $row2 = sql_fetch($sql);
        $list_temp = get_list($row2, $board, $latest_skin_path, $subject_len);
        //$list[$i] = get_list($row2, $board, $latest_skin_path, $subject_len);
        //$list_bo[$i] = $row[bo_table];
        $sql = " select * from $nc[tbl_menu] where cb_id = '$row[bo_table]' and cn_name = '$row2[ca_name]' ";
        $cn_temp = sql_fetch($sql);

        // ������ ���� �Խñ��� ���� ���ϰ� �Ѵ�
        $latest_flag=0;
        if ($cn_temp[cn_list_level]) {
            // �ش�Ŭ���� ȸ�� ������ ����
            if ($member[mb_id]) {
                $cm = get_club_member($row[bo_table], $member[mb_id]);
                if ($cm[cm_level] >= $cn_temp[cn_list_level]) {
                      $latest_flag=1;
                }
            }
        } else {
              $latest_flag=1;
        }

        // �����ڴ� ���� �� ����
        if ($is_admin=="super")
            $latest_flag=1;

        if ($latest_flag) {
            $list[$i] = $list_temp;;
            $list_bo[$i] = $row[bo_table];
            $cn[$i] = $cn_temp;
            $i++;
        }
    }
    
    ob_start();
    include "$latest_skin_path/latest.skin.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

// Ŭ�� ���� ȭ���� �α�� (��. Ŭ�� ��ü�� �α��)
// ���� ������� (����� cb_�� �����ϴ� ���̺��� ������ ������)
function cb_pop_main($skin_dir="", $rows=10, $subject_len=40, $latest_title="Ŭ�� �α��", $pop_days=7)
{
    global $g4, $nc;

    if ($skin_dir)
        $latest_skin_path = "$nc[cb_path]/skin_main/latest/$skin_dir";
    else
        $latest_skin_path = "$nc[cb_path]/skin_main/latest/default";

    $tmp_list = array();
    
    // �˻��� Ŭ���� ����� ����ϴ�
    $sql = "select count(*) as cnt from $nc[tbl_club] where cb_type = 1 or cb_state = 1 and cb_last_update_datetime > '" . date('Y-m-d H:i:s', $g4[server_time] - (86400 * $pop_days)) . "' order by rand() limit $rows";
    $result = sql_fetch($sql);
    if ($result[cnt] >= $rows) $limits = intval(3 * $result[cnt] / $rows); else $limits = $rows;
    $sql = "select cb_id from $nc[tbl_club] where cb_type = 1 or cb_state = 1 order by rand() limit $rows";
    $result = sql_query($sql);
    
    // ��ü Ŭ�� ���̺��� ���� ������ �����ϴ� �Խñ۵��� ã���ϴ�
    $k=0;
    for ($i=0; $row = sql_fetch_array($result); $i++) {
        $tmp_write_table = $g4[write_prefix] . $row[cb_id]; // �Խ��� ���̺� ��ü�̸�
        $sql1 = " select * from $tmp_write_table where wr_is_comment = 0 and wr_datetime > '" . date('Y-m-d H:i:s', $g4[server_time] - (86400 * $pop_days)) . "' order by wr_hit desc limit $limits ";
        $result1 = sql_query($sql1);
        for ($j=0; $row1 = sql_fetch_array($result1); $j++) {
            $tmp_list[$k]['bo_table'] = $row['cb_id'];
            $tmp_list[$k]['wr_subject'] = cut_str($row1['wr_subject'], $subject_len);
            $tmp_list[$k]['wr_id'] = $row1['wr_id'];
            $tmp_list[$k]['ca_name'] = $row1['ca_name'];
            $k++;
        }
        
        // �Խñ� ������ ���ϴ� ��ŭ�̸� break
        if ($k > $rows)
            break;
    }

    // ������ rows���� ����
    if (count($tmp_list) > $rows) $return_rows = $rows; else $return_rows = count($tmp_list);
    
    // �ʿ��� ��ŭ�� �迭�� random�ϰ� �����ϱ� ���ؼ� shuffle
    shuffle($tmp_list);

    for ($i=0; $i < $return_rows; $i++) {
      $list_bo[$i] = $tmp_list[$i]['bo_table'];
      $list[$i]['subject'] = $tmp_list[$i]['wr_subject'];
      $list[$i]['wr_id'] = $tmp_list[$i]['wr_id'];
      $list[$i]['ca_name'] = $tmp_list[$i]['ca_name'];
      $list[$i]['href'] = $g4['bbs_path'] . "/board.php?bo_table=" . $tmp_list[$i]['bo_table'] . "&wr_id=" . $tmp_list[$i]['wr_id'];
    }

    ob_start();
    include "$latest_skin_path/latest.skin.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

// Ŭ�� ���� ȭ���� Ŭ�� �������� ( = Ŭ�� �Ͽ콺�� ��������)
function cb_club_notice($skin_dir="", $rows=10, $subject_len=40, $latest_title="Ŭ�� �α��")
{
    global $g4, $nc, $cb;

    if ($skin_dir)
        $latest_skin_path = "$nc[cb_path]/skin_main/latest/$skin_dir";
    else
        $latest_skin_path = "$nc[cb_path]/skin_main/latest/default";

    $tmp_list = array();

    $sql = " select cn_name from $nc[tbl_menu] where cn_type = 'N' ";
    $cn_name = sql_fetch($sql);
    
    $tmp_write_table = $g4[write_prefix] . $nc[cb_clubhouse]; // �Խ��� ���̺� ��ü�̸�
    
    $sql = " select * from $tmp_write_table where ca_name = '$cn_name[cn_name]' and wr_is_comment='0' order by wr_num asc limit $rows";
    $result = sql_query($sql, false);

    if (!$result)
        return;

    $sql = " select * from {$g4[board_table]} where bo_table = '$nc[cb_clubhouse]'";
    $board = sql_fetch($sql);
    
    for ($i=0; $row = sql_fetch_array($result); $i++) {
        $list[$i] = get_list($row, $board, $latest_skin_path, $subject_len);
        $list_bo[$i] = "$nc[cb_clubhouse]";
    }

    // more...
    $more_url = $nc[cb_path] . "/club_main.php?cb_id=". strip_cb_id($nc[cb_clubhouse]) . "&sca=" .$cn_name[cn_name];

    ob_start();
    include "$latest_skin_path/latest.skin.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}


// Ŭ���� ���
function club_list($kind="new", $cc_id="", $skin_dir="", $rows=10, $subject_len=40, $latest_title="") {
    global $g4, $nc, $member, $is_admin;

    $kind=trim($kind);
    $skin_dir=trim($skin_dir);

    if ($cc_id=='0')
        $cc_id="";

    if ($skin_dir)
        $club_list_skin_path= $nc[cb_path] . "/skin_main/club_list/" . $skin_dir;
    else
        $club_list_skin_path = $nc[cb_path] . "/skin_main/club_list/default";

    switch ($kind) {
        case "rand"     : $sql_where = " order by rand() ";
                          $more_url = "$nc[cb_path]/club_index.php?doc=cb_list.php";
                          if (!$latest_title) $latest_title = "����Ŭ��";
                          break;
        case "suggest"  : $sql_where = " and cb_recommend='Y' order by rand() ";
                          $more_url = "$nc[cb_path]/club_index.php?doc=cb_list.php?cb_recommend=Y";
                          if (!$latest_title) $latest_title = "��õŬ��";
                          break;
        case "point"    : $sql_where = " order by cb_point desc ";
                          $more_url = "$nc[cb_path]/club_index.php?doc=cb_list.php?ssort=cb_point&sorder=desc&rank=1";
                          if (!$latest_title) $latest_title = "�α�Ŭ��(����Ʈ)";
                          break;
        case "update"    : $sql_where = " order by cb_last_update_datetime desc ";
                          $more_url = "$nc[cb_path]/club_index.php?doc=cb_list.php?ssort=cb_point&sorder=desc&rank=1";
                          if (!$latest_title) $latest_title = "�ֱ� update Ŭ��";
                          break;
        case "member"  :  $sql_where = " order by cb_total_member desc ";
                          $more_url = "$nc[cb_path]/club_index.php?doc=cb_list.php?ssort=cb_total_member&sorder=desc&rank=1";
                          if (!$latest_title) $latest_title = "�α�Ŭ��(ȸ����)";
                          break;
        case "my"      :  
                          if (!$latest_title) $latest_title = "����Ŭ��";
                          $more_url = "$nc[cb_path]/club_index.php?doc=cb_myclub_list.php";
                          if (!$member[mb_id]) {
                              $sql_where = " and 0 ";
                              break;
                          }
                          $sql1 = " select cb_id from $nc[member_table] where mb_id='$member[mb_id]' limit $rows ";
                          $result1 = sql_query($sql1);
                          if (!result1)
                              break;
                          $sql_1 = " cb_id in ( ";
                          for ($i=0; $row1 = sql_fetch_array($result1); $i++) {
                              if ($i!==0)
                                  $sql_1 .=",";
                              $sql_1 .= "'" . $row1[cb_id] . "'";
                          }
                          $sql_1 .= " ) ";
                          $sql_where = " and $sql_1 order by cb_last_update_datetime desc ";
                          break;
        case "new"      :
        default         : $sql_where = " order by cb_no desc ";
                          $more_url = "$nc[cb_path]/club_index.php?doc=cb_list.php?cb_recommend=N&ssort=cb_regdate";
                          if (!$latest_title) $latest_title = "�ű�Ŭ��";
                          break;
    }
    $sql_common = " select * from $nc[club_table] where ";
    if ($is_admin)
        $sql_cond = " 1 ";
    else
        $sql_cond = " cb_type= '1' and cb_state='1' ";

    if ($cc_id)
        $sql_cond .= " and cc_id='$cc_id' ";
    
    $sql = "$sql_common $sql_cond $sql_where limit $rows ";
    $result = sql_query($sql);

    for ($i=0; $row = sql_fetch_array($result); $i++) {
        $list[$i] = $row;
        $list[$i][cb_name_org] = $row[cb_name];
        $list[$i][cb_name] = conv_subject($row[cb_name], $subject_len);
        
        // ī�װ��� �����;�¡...
        $sql2 = " select * from $nc[category_table] where cc_id = $row[cc_id] ";
        $row2 = sql_fetch($sql2);
        $list[$i][cc_name] = $row2[cc_name];
    }

    ob_start();
    include "$club_list_skin_path/club_list.skin.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}


function frame_url($url, $target="parent") {
    echo "<script language='JavaScript' type='text/JavaScript'>
    window.$target.location.href = '$url';
    </script>";
    exit;
}

// ���� �����ڼ�
function cb_current_connect($cb_name, $skin_dir="")
{
    global $config, $g4, $member, $is_admin, $nc, $cb; 

    if ($cb_name == "")
        alert("cb_name�� ���޵��� �ʾҽ��ϴ�.");
        
    // ȸ��, �湮�� ī��Ʈ
    $sql = " select sum(IF(mb_id<>'',1,0)) as mb_cnt, count(*) as total_cnt 
                from $g4[login_table]  
                where mb_id <> '$config[cf_admin]' and lo_location like '$cb_name - Ŭ��%' ";
//                where lo_location like '$cb_name - Ŭ��%' ";
    $row2 = sql_fetch($sql);

    $list = array();
    //ȸ�� �̸� �������
    $sql2 = " select a.mb_id, mb_sex, b.mb_level, b.mb_nick, b.mb_name, b.mb_email, b.mb_homepage, b.mb_open, a.lo_ip, a.lo_location, a.lo_url 
                from $g4[login_table] a left join $g4[member_table] b on (a.mb_id = b.mb_id) 
                where a.mb_id <> '$config[cf_admin]'  and lo_location like '$cb_name - Ŭ��%' order by a.lo_datetime desc"; 
//                where lo_location like '$cb_name - Ŭ��%' order by a.lo_datetime desc"; 
    $result = sql_query($sql2);

    for ($i=0; $row=sql_fetch_array($result); $i++) {
         $list[$i] = $row;
	
         if ($row[mb_id])
       	    $list[$i][name] =  "<b>"."$row[mb_nick]"."</b>"." "."$level_icon"." "."$sex_icon";
         else
            $list[$i][name] = "�մ�&nbsp;"."(".preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", "\\1.��.\\3.\\4", $row[lo_ip]).")";

         $list[$i][num] = sprintf("%03d",$i+1);
    }

    echo "<script language=\"javascript\" src=\"$g4[path]/js/sideview.js\"></script>\n";

    if ($skin_dir)
        $connect_skin_path = "$nc[cb_path]/skin/connect/$skin_dir";
    else
        $connect_skin_path = "$nc[cb_path]/skin/connect/$cb[cb_connect_skin]";

    ob_start();
    include ("$connect_skin_path/current_connect.skin.php");    
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

// �α�˻��� ���
// $skin_dir : ��Ų ���丮
// $pop_cnt : �˻��� �
// $date_cnt : ���� ����
function cb_popular($skin_dir='basic', $pop_cnt=7, $date_cnt=3)
{
    global $config, $g4, $nc, $cb;

    if ($skin_dir)
        $popular_skin_path = "$nc[cb_path]/skin/connect/$skin_dir";
    else
        $popular_skin_path = "$nc[cb_path]/skin/connect/$cb[cb_connect_skin]";

    $date_gap = date("Y-m-d", $g4[server_time] - ($date_cnt * 86400));
    $sql = " select pp_word, count(*) as cnt from $g4[popular_table]
              where pp_date between '$date_gap' and '$g4[time_ymd]'
              group by pp_word
              order by cnt desc, pp_word
              limit 0, $pop_cnt ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) 
    {
        $list[$i] = $row;
        // ��ũ��Ʈ���� �������
        $list[$i][pp_word] = get_text($list[$i][pp_word]);
    }

    ob_start();
    include_once ("$popular_skin_path/popular.skin.php");
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

function get_random_club_url() {

    // ���̺� �̸��� �������� ���� g4, nc ȯ�溯���� ����Ѵ�.
    // ���� Ŭ���� �����ϱ� ���� $member �� $cb �� �����´�.
    global $g4, $nc, $cb;

    // ���ǽ� (���� Ŭ���� �ƴϰ�, �����Ǿ�����, ����̰�, ���� ȸ�������� ����)
    $where = "cb_id <> '{$cb[cb_id]}' and cb_type = 1 and cb_state = 1 and cb_join = 'Y' ";

    // ���� �ӹ��� �ִ� Ŭ���� ������ �ٸ� Ŭ���� ������ ���Ѵ�.
    $res = sql_fetch("select count(*) as cnt from {$nc[tbl_club]} where $where ");

    // 0���� ������ ���� Ŭ�� ���� �߿��� ���� ���� �̴´�.
    $rnd = mt_rand(0, $res[cnt]-1);

    // �������� ��ġ�� Ŭ�� ���̵� ã�´�.
    $res = sql_fetch("select cb_id from {$nc[tbl_club]} where $where  limit $rnd, 1");

    if ($res[cb_id])
        $cb_url = $nc[cb_url_path] . "/club_main.php?cb_id=" . $res[cb_id];
    
    // ��� �ּҸ� �����Ѵ�.
    return $cb_url;
}

// ���Ŭ���� �ʴ� �޾Ҵ����� Ȯ��
function get_club_invite($cb_id, $mb_id) {
    global $nc;

    $sql = " select count(*) as cnt from $nc[cb_history_table] where cb_id = '$cb_id' and history_mb_id = '$mb_id' and history_notice = '���Ŭ�������ʴ�' ";
    $result = sql_fetch($sql);
    
    if ($result[cnt] > 0)
        return $mb_id;
    else
        return "";
}

// Ŭ�� �絵�� ���������� Ȯ��
function get_club_transfer($cb_id) {
    global $nc;

    $sql = " select history_mb_id from $nc[cb_history_table] where cb_id = '$cb_id' and history_notice = 'Ŭ���絵��û' limit 1";
    $result = sql_fetch($sql);

    if ($result)
        return $result[history_mb_id];
    else
        return "";
}

// http://kr.php.net/manual/en/function.preg-replace-callback.php
// http://sir.co.kr/bbs/board.php?bo_table=g4_qa&wr_id=152310
// Ŭ���ֽű��� ã�Ƽ� �ٲ��ݴϴ� - cb_main.php ��� ����
if (!function_exists('replace_latest')) {    
function replace_latest($matches) {
    global $cb;

    $latest_match = $matches[1];
    list($skin, $title, $line, $subj_len)=explode(",",$latest_match); 

    $latest_data = cb_latest($skin, $cb[cb_id], $title, $line, $subj_len);

    return $latest_data;
}
}

// ������ tag�� ���� �մϴ�
if (!function_exists('strip_only')) {    
function strip_only($str, $tags) {
    if(!is_array($tags)) {
        $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
        if(end($tags) == '') array_pop($tags);
    }
    foreach($tags as $tag) $str = preg_replace('#</?'.$tag.'[^>]*>#is', '', $str);
    return $str;
}
}

// cb_id �ļ��θ��� (clubhouse -> cb_clubhouse, cb_clubhouse -> cb_clubhouse)
function get_cb_id($cb_id_0) {
    global $nc, $cb_id;

    $cb_length = strlen($nc[cb_disc]);
    if (substr($cb_id_0, 0, $cb_length) !== $nc[cb_disc])
        $cb_id = $nc[cb_disc] . $cb_id;
    else
        $cb_id = $cb_id_0;
    
    return $cb_id;
}

function strip_cb_id($cb_id_0) {
    global $nc;
    
    $cb_length = strlen($nc[cb_disc]);
    if (substr($cb_id_0, 0, $cb_length) !== $nc[cb_disc])
        $cb_id = $cb_id_0;
    else
        $cb_id = substr($cb_id_0, strlen($nc[cb_disc]));
    
    return $cb_id;
}

// $sca ������ urldecode �ϱ� (��âȭ��)
// http://sir.co.kr/bbs/board.php?bo_table=g4_qa&wr_id=155247
function strip_sca($qstr) {

    $result = preg_replace("`sca=([^&]+)(&?)`e", "'sca=' . str_replace(\"\\\\\\\", \"\", urldecode('\\1')) . '\\2'", $qstr); 

    return $result;
}
?>
