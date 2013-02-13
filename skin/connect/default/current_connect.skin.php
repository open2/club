<?
//if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

//원본 수정없이 베이직스킨에 덮음
?>

<style>
.n_title1 { font-family:돋움; font-size:9pt; color:#FFFFFF; }
.n_title2 { font-family:돋움; font-size:9pt; color:#5E5E5E; }
</style>

<table width="100%"  border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td bgcolor="#CCCCCC">
      <table width="100%" border="0" cellspacing="1" bgcolor="#FFFFFF">
        <tr>
          <td style="padding:3px 10px 2px 10px">
          <table width="100%" border="0" cellspacing="0" cellpadding="1">

<?
for ($i=0; $i<count($list); $i++)
{
    echo <<<HEREDOC
    <tr>
        <td align='center'>{$list[$i][name]}</td>
    </tr>
    <tr><td height='1' background='{$connect_skin_path}/img/dot_bg.gif'></td></tr>
HEREDOC;
}

if ($i == 0)
    echo "<tr><td colspan=3 height=50 align=center>현재 접속자가 없습니다.</td></tr>";
?>
          </table>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
