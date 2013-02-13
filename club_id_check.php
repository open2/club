<?
include_once("./_common.php");

include_once "$nc[cb_path]/head.sub.php";

if ($w == "cb_id") {
    $is_check = false;

    // cb_cb_test와 같이 못 만들게
    $cb_length = strlen($nc[cb_disc]);
    if (substr($cb_id_0, 0, $cb_length) == $nc[cb_disc])
  	    $is_check = true;

    $cb = get_club($cb_id);
	  if ($cb[cb_id]) {
	      $is_check = true;
	}
	
	// 게시판에 정보가 있는지 확인
	$sql    = " select count(*) from $g4[board_table] where bo_table = '$cb_id' ";
	$check  = mysql_fetch_array(mysql_query($sql));
	if ($check[0] > 0) {
	    $is_check = true;
	}
	
	if ($is_check) {
	    echo <<<HEREDOC
	    <script language="JavaScript"> 
	        alert("'{$cb_id}'은(는) 이미 등록된 클럽아이디 이므로 사용하실 수 없습니다."); 
	        parent.document.getElementById("cb_id_enabled").value = -1;
	        window.close();
	    </script>
HEREDOC;
	} else {
	    echo <<<HEREDOC
	    <script language="JavaScript"> 
	        alert("'{$cb_id}'은(는) 중복된 클럽아이디가 없습니다.\\n\\n사용하셔도 좋습니다.");
	        parent.document.getElementById("cb_id_enabled").value = 1;
	        window.close();
	    </script>
HEREDOC;
	}
}

if ($w == "cb_name") {
	$cb = check_club_name($cb_name);
	if ($cb[cnt]) {
	    echo <<<HEREDOC
	    <script language="JavaScript"> 
	        alert("'{$cb_name}'은(는) 이미 등록된 클럽명 이므로 사용하실 수 없습니다.");
	        parent.document.getElementById("cb_name_enabled").value = -1;
	        window.close();
	    </script>
HEREDOC;
	} else {
	    echo <<<HEREDOC
	    <script language="JavaScript"> 
	        alert("'{$cb_name}'은(는) 중복된 클럽명 없습니다.\\n\\n사용하셔도 좋습니다.");
	        parent.document.getElementById("cb_name_enabled").value = 1;
	        window.close();
	    </script>
HEREDOC;
	}
}

include_once("$nc[cb_path]/tail.sub.php");
?>
