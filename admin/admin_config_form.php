<?
include_once "./_common.php";

$g4[title] = "클럽관리";
include_once "$nc[cb_path]/head.sub.php";
?>

<form name="adminconfigform" method="post" action="./admin_config_form.update.php" onSubmit="return form_check();">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" colspan="4"><strong>환경 설정</strong> (클럽DB버젼: <?=$nc[nf_version]?>)</td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="3" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 타이틀</td>
    <td colspan="3" class="list"><input type="text" name="nf_title" value="<?=$nc[nf_title]?>" style="width:80%;"></td>
  </tr>
  <tr>
    <td height="1" colspan="4" bgcolor="#EEEEEE"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 전체폭</td>
    <td class="list"><input type="text" name="nf_width" size="10" value="<?=$nc[nf_width]?>" required itemname="전체폭" style="text-align:right;">
      100 이하는 %</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 위치</td>
    <td class="list"><select name="nf_align">
        <option value="left">왼쪽정렬</option>
        <option value="center">중앙정렬</option>
        <option value="right">오른쪽정렬</option>
      </select></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 상단 title 높이</td>
    <td class="list"><input type="text" name="title_img_height" size="10" value="<?=$nc[title_img_height]?>" required itemname="상단 title 이미지 높이" style="text-align:right;">
    </td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu"></td>
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 개설 방식</td>
    <td colspan="3" class="list"><input type="checkbox" name="nf_opentype" value="1">
      관리자 승인후 개설</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 개설 레벨</td>
    <td colspan="3" class="list"><?=get_member_level_select('nf_open_level', 2, 10, $nc[nf_open_level]) ?>
      레벨부터 클럽을 만들 수 있습니다</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 생성 제한</td>
    <td colspan="3" class="list"><input type="text" name="nf_limits" size="10" value="<?=$nc[nf_limits]?>" style="text-align:right;">
      1인당 클럽 생성 제한수 (0은 무한대)</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽명 변경 제한</td>
    <td colspan="3" class="list"><input type="text" name="nf_title_change_limits" size="10" value="<?=$nc[nf_title_change_limits]?>" style="text-align:right;">
      지정된 기간이 지난 이후에 클럽명을 변경할 수 있습니다. (0은 항상변경가능, 기본은 30일)</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">글읽기 포인트</td>
    <td class="list"><input type="text" name="nf_read_point" id="nf_read_point" required itemname="글읽기 포인트" value="<?=$nc[nf_read_point]?>" size="10" style="text-align:right;"></td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">글쓰기 포인트</td>
    <td class="list"><input type="text" name="nf_write_point" id="nf_write_point" required itemname="글쓰기 포인트" value="<?=$nc[nf_write_point]?>" size="10" style="text-align:right;"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">코멘트쓰기 포인트</td>
    <td class="list"><input type="text" name="nf_comment_point" id="nf_comment_point" required itemname="코멘트쓰기 포인트" value="<?=$nc[nf_comment_point]?>" size="10" style="text-align:right;"></td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">다운로드 포인트</td>
    <td class="list"><input type="text" name="nf_download_point" id="nf_download_point" required itemname="다운로드 포인트" value="<?=$nc[nf_download_point]?>" size="10" style="text-align:right;"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">&nbsp;</td>
    <td class="list" colspan=3>
    클럽에 글쓰기, 글읽기 등을 할 때 회원 개개인에게 부여하는 포인트 입니다.<br>
    클럽포인트와 그누보드의 기본 설정 포인트는 동일 합니다. <br>
    따라서, <b>클럽의 포인트를 변경하면 그누보드의 기본 포인트가 변경 됩니다</b>. <br>
    이는 개별 클럽마다 포인트를 부여할 때 생길 수 있는 문제를 막기 위함 입니다.</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 포인트<br>사용 방식</td>
    <td class="list"><select name="nf_point_use">
        <option value="1">사용안함</option>
        <option value="2">가입적립방식</option>
        <option value="3">가입기부방식</option>
      </select>
      <table>
        <tr><td>가입적립방식 : 클럽가입시 지정 포인트를 클럽에 적립</td></tr>
        <tr><td>가입기부방식 : 클럽가입시 회원 포인트를 클럽에 기부</td></tr>
      </table>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">적립 포인트</td>
      
    <td class="list"><input type="text" name="nf_save_point" id="nf_save_point" value="<?=$nc[nf_save_point]?>" size="10" style="text-align:right;"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">글읽기 인기도</td>
    <td class="list"><input type="text" name="nf_read_popular" id="nf_read_popular" required itemname="글읽기 인기도" value="<?=$nc[nf_read_popular]?>" size="10" style="text-align:right;"></td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">글쓰기 인기도</td>
    <td class="list"><input type="text" name="nf_write_popular" id="nf_write_popular" required itemname="글쓰기 인기도" value="<?=$nc[nf_write_popular]?>" size="10" style="text-align:right;"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">코멘트쓰기 인기도</td>
    <td class="list"><input type="text" name="nf_comment_popular" id="nf_comment_popular" required itemname="코멘트쓰기 인기도" value="<?=$nc[nf_comment_popular]?>" size="10" style="text-align:right;"></td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">다운로드 인기도</td>
    <td class="list"><input type="text" name="nf_download_popular" id="nf_download_popular" required itemname="다운로드 인기도" value="<?=$nc[nf_download_popular]?>" size="10" style="text-align:right;"></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">&nbsp;</td>
    <td class="list" colspan=3>
    클럽의 활동에 따라서 클럽에 부여되는 인기도 입니다.<br>
    모든 클럽에 동일한 기준으로 적용되어서 인기도를 산정하게 됩니다.<br>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 게시판 스킨</td>
    <td class="list" colspan=3><select name="nf_bo_skin">
      <?
        $arr = get_skin_dir("board");
        for ($i=0; $i<count($arr); $i++) {
          if(stristr($arr[$i],'CLUB')) {    // 대소문자 무시하고 CLUB를 포함하고있다면 
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
          }
        }
      ?>
    </select> ※ 클럽 스킨과 연결해주는 스킨 ($g4[path]/skin/board/ 디렉토리에서 이름에 club이 있는 디렉토리만 목록으로)</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 로그인 스킨</td>
    <td width="300" class="list"><select name="nf_outlogin_skin">
      <?
        $arr = get_club_skin_dir("outlogin");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> ※ 클럽 로그인 스킨</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">&nbsp;</td>
    <td width="300" class="list">&nbsp;</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">공지사항 스킨</td>
    <td width="300" class="list"><select name="nf_bo_notice_skin">
      <?
        $arr = get_club_skin_dir("notice");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> ※ 클럽 생성시 기본 스킨</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">커버스토리 스킨</td>
    <td width="300" class="list"><select name="nf_bo_coverstory_skin">
      <?
        $arr = get_club_skin_dir("coverstory");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> ※ 클럽 생성시 기본 스킨</td>
  </tr>  
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">게시판 스킨</td>
    <td width="300" class="list"><select name="nf_bo_board_skin">
      <?
        $arr = get_club_skin_dir("board");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> ※ 클럽 생성시 기본 스킨</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">갤러리 스킨</td>
    <td width="300" class="list"><select name="nf_bo_gallery_skin">
      <?
        $arr = get_club_skin_dir("gallery");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> ※ 클럽 생성시 기본 스킨</td>
  </tr>  
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">지식 스킨</td>
    <td width="300" class="list"><select name="nf_bo_jisik_skin">
      <?
        $arr = get_club_skin_dir("jisik");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> ※ 클럽 생성시 기본 스킨</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">한줄 스킨</td>
    <td width="300" class="list"><select name="nf_bo_oneline_skin">
      <?
        $arr = get_club_skin_dir("oneline");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> ※ 클럽 생성시 기본 스킨</td>
  </tr>  
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">1:1 스킨</td>
    <td width="300" class="list"><select name="nf_bo_1to1_skin">
      <?
        $arr = get_club_skin_dir("1to1");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> ※ 클럽 생성시 기본 스킨</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">스케쥴 스킨</td>
    <td width="300" class="list"><select name="nf_bo_schedule_skin">
      <?
        $arr = get_club_skin_dir("schedule");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> ※ 클럽 생성시 기본 스킨</td>
  </tr>  
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">링크 스킨</td>
    <td width="300" class="list"><select name="nf_bo_link_skin">
      <?
        $arr = get_club_skin_dir("link");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> ※ 클럽 생성시 기본 스킨</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">자료실 스킨</td>
    <td width="300" class="list"><select name="nf_bo_pds_skin">
      <?
        $arr = get_club_skin_dir("pds");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> ※ 클럽 생성시 기본 스킨</td>
  </tr>  
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">장터 스킨</td>
    <td width="300" class="list"><select name="nf_bo_mart_skin">
      <?
        $arr = get_club_skin_dir("mart");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> ※ 클럽 생성시 기본 스킨</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">&nbsp;</td>
    <td width="300" class="list">&nbsp;</td>
  </tr>  
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>

  
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">최근게시글 스킨</td>
    <td width="300" class="list"><select name="nf_latest_default_skin">
      <?
        $arr = get_club_skin_dir("latest");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select> ※ 클럽 생성시 기본 최신글 스킨</td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">접속자 스킨</td>
    <td width="300" class="list"><select name="nf_connect_default_skin">
      <?
        $arr = get_club_skin_dir("connect");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select></td>
    <td width="130" bgcolor="#f7f7f7" class="gmenu"></td>
    <td width="300" class="list">
    </td>
  </tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">검색 스킨</td>
    <td width="300" class="list"><select name="nf_search_default_skin">
      <?
        $arr = get_club_skin_dir("search");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
      ?>
    </select></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 메인<BR>HTML EDITOR</td>
    <td colspan="3" class="list"><input type="checkbox" name="nf_maintext_html" value="1">
      클럽메인에 HTML 편집기를 쓸 경우에 CHECK 해주세요</td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 메인 구성</td>
    <td colspan="3" class="list">
    <textarea name="nf_maintext" rows="10" style="width:80%;"><?=stripslashes($nc[nf_maintext])?></textarea>
    <br>클럽의 초기화면에 나올 레이아웃 구성 입니다.
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 필터링</td>
    <td colspan="3" class="list">
    <textarea name="nf_filter" rows="3" style="width:80%;"><?=$nc[nf_filter]?></textarea>
    <br>입력된 단어가 포함된 내용은 사용할 수 없습니다. 단어와 단어 사이는 ,로 구분합니다.
    </td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 메인 random 기간</td>
    <td colspan="3" class="list"><input type="text" name="nf_random_days" size="95" value="<?=$nc[nf_random_days]?>">
    <br>클럽 메인의 랜덤공지사항, 랜덤커버스토리를 추출하는 기간을 지정</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 초기 메뉴 </td>
    <td colspan="3" class="list"><input type="text" name="nf_menu_list" size="95" value="<?=$nc[nf_menu_list]?>">
      '|'로 구분</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 초기<BR>HTML 사용</td>
    <td colspan="3" class="list"><input type="checkbox" name="nf_club_text_use" value="1" <?=$nc[nf_club_text_use]?'checked':'';?>>
      생성된 클럽의 초기화면의 html 메인 코드를 지정하려는 경우 CHECK 해주세요</td>
  </tr>
  <tr>
    <td width="130" bgcolor="#f7f7f7" class="gmenu">클럽 초기 html</td>
    <td colspan="3" class="list">
      <textarea name="nf_club_text" rows="10" style="width:80%;"><?=stripslashes($nc[nf_club_text])?></textarea>
      <br>생성된 클럽의 초기메인에 나올 html 코드를 지정해줍니다.</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="1" colspan="4"></td>
  </tr>
  <tr>
    <td bgcolor="#f7f7f7" class="gmenu">클럽 이용 약관 </td>
    <td colspan="3" class="list"><textarea name="nf_clause" rows="10" style="width:80%;"><?=$nc[nf_clause]?></textarea></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="2" colspan="4"></td>
  </tr>
  <tr>
    <td colspan="4" align="center" style="padding:5px 10px 5px 10px;"><input type="submit" name="Submit" value=" 확  인 "></td>
  </tr>
</table>
</form>
<br><br><br><br><br><br>
<script language="JavaScript" type="text/JavaScript">
    var f = document.adminconfigform;
    
    f.nf_bo_skin.value        = "<?=$nc[nf_bo_skin]?>";
    f.nf_outlogin_skin.value  = "<?=$nc[nf_outlogin_skin]?>";
    
    f.nf_align.value          = "<?=$nc[nf_align]?>";
    f.nf_point_use.value      = "<?=$nc[nf_point_use]?>";
    f.nf_save_point.value     = "<?=$nc[nf_save_point]?>";
    
    f.nf_bo_notice_skin.value  = "<?=$nc[nf_bo_notice_skin]?>";
    f.nf_bo_coverstory_skin.value  = "<?=$nc[nf_bo_coverstory_skin]?>";
    f.nf_bo_board_skin.value  = "<?=$nc[nf_bo_board_skin]?>";
    f.nf_bo_gallery_skin.value  = "<?=$nc[nf_bo_gallery_skin]?>";
    f.nf_bo_jisik_skin.value  = "<?=$nc[nf_bo_jisik_skin]?>";
    f.nf_bo_oneline_skin.value  = "<?=$nc[nf_bo_oneline_skin]?>";
    f.nf_bo_1to1_skin.value  = "<?=$nc[nf_bo_1to1_skin]?>";
    f.nf_bo_schedule_skin.value  = "<?=$nc[nf_bo_schedule_skin]?>";
    f.nf_bo_link_skin.value  = "<?=$nc[nf_bo_link_skin]?>";
    f.nf_bo_pds_skin.value  = "<?=$nc[nf_bo_pds_skin]?>";
    f.nf_bo_mart_skin.value  = "<?=$nc[nf_bo_mart_skin]?>";

    f.nf_latest_default_skin.value  = "<?=$nc[nf_latest_default_skin]?>";
    f.nf_connect_default_skin.value  = "<?=$nc[nf_connect_default_skin]?>";
    f.nf_search_default_skin.value  = "<?=$nc[nf_search_default_skin]?>";

    <? if ($nc[nf_opentype] == 1) { echo "f.nf_opentype.checked = true;"; } ?>
    <? if ($nc[nf_maintext_html] == 1) { echo "f.nf_maintext_html.checked = true;"; } ?>

    function form_check()
    {
        if (f.nf_point_use.value == 2) {
            if (f.nf_save_point.value == "" || f.nf_save_point.value == 0) {
                alert("적립포인트를 입력하세요");
                f.nf_save_point.focus();
                return false;
            } else {
                return;
            }
        } else {
            return;
        }
    }
</script>

<?
include_once("$nc[cb_path]/tail.sub.php");
?>
