<?
        // 아이콘 위치를 재정의
        $list[$i]['icon_new'] = ""; 
        if ($list[$i]['wr_datetime'] >= date("Y-m-d H:i:s", $g4['server_time'] - ($board['bo_new'] * 3600))) 
            $list[$i]['icon_new'] = "<img src='$board_skin_path/img/icon_new.gif' align='absmiddle'>"; 

        $list[$i]['icon_hot'] = ""; 
        if ($list[$i]['wr_hit'] >= $board['bo_hot']) 
            $list[$i]['icon_hot'] = "<img src='$board_skin_path/img/icon_hot.gif' align='absmiddle'>"; 

        $list[$i]['icon_link'] = "";
        if ($list[$i]['wr_link1'] || $list[$i]['wr_link2'])
            $list[$i]['icon_link'] = "<img src='$board_skin_path/img/icon_link.gif' align='absmiddle'>";

        $list[$i]['icon_secret'] = ""; 
        if (strstr($list[$i]['wr_option'], "secret")) 
            $list[$i]['icon_secret'] = "<img src='$board_skin_path/img/icon_secret.gif' align='absmiddle'>"; 

        if ($list[$i]['file']['count']) 
            $list[$i]['icon_file'] = "<img src='$board_skin_path/img/icon_file.gif' align='absmiddle'>"; 
            
        $list['icon_reply'] = "";
        if ($list['reply'])
            $list['icon_reply'] = "<img src='$board_skin_path/img/icon_reply.gif' align='absmiddle'>";

        $list['icon_link'] = "";
        if ($list['wr_link1'] || $list['wr_link2'])
            $list['icon_link'] = "<img src='$board_skin_path/img/icon_link.gif' align='absmiddle'>";
?>
