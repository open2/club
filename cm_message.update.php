<?
include_once "./_common.php";

if (!$cb[cb_id]) {
    error_msg("�ش� Ŭ���� �������� �ʽ��ϴ�.");
}

if ($cm_level) {
    $sql_level = " and cm_level = '$cm_level' ";
}

$me_memo=trim($_POST[me_memo]);
if (!strip_tags($me_memo))
    error_msg("�߼��� ������ �������� �ʽ��ϴ�.");

$memo4 = $_POST[memo4]; // 1: ����4, 0: �״�����
$me_subject = $_POST[me_subject]; // ������ ����4���� �ִ� ����

$sql    = " select *
              from $nc[tbl_member] as a, $g4[member_table] as b
             where ( a.mb_id = b.mb_id and a.cb_id = '$cb_id' )
               and ( b.mb_leave_date = '' and b.mb_intercept_date = '' )
                   $sql_level
          order by a.cm_regdate desc ";
$result = sql_query($sql);

echo "<br>���� �Ϸ� �޼����� ���ö����� ��ٸ�����.<br>";
$tot = 1;

for ($i=0; $row=mysql_fetch_array($result); $i++) {
    
    if ($memo4 == 0) {
        $tmp_row = sql_fetch(" select max(me_id) as max_me_id from $g4[memo_table] ");
        $me_id = $tmp_row[max_me_id] + 1;

        // ���� INSERT
        $sql = " insert into $g4[memo_table]
                        ( me_id, me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo )
                 values ( '$me_id', '$row[mb_id]', '$member[mb_id]', '$g4[time_ymdhis]', '$me_memo' ) ";
        sql_query($sql);
    } else if ($memo4 == 1) {
      // ����4 �������� �б�
      include_once("$g4[path]/memo.config.php");

      $me_memo = addslashes($me_memo);
      
      // ���� INSERT (������)
      $sql = " insert into $g4[memo_recv_table]
                      ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_subject, memo_type, memo_owner, me_file_local, me_file_server, me_option )
               values ('$row[mb_id]', '$member[mb_id]', '$g4[time_ymdhis]', '$me_memo', '$me_subject', 'recv', '$row[mb_id]', '', '', '$html,$secret,$mail' ) ";
      sql_query($sql);
      $me_id = mysql_insert_id();
                
      // ���� INSERT (�߽��� - me_id�� �߽����� me_id�� �����ϰ� ����)
      $sql = " insert into $g4[memo_send_table]
                      ( me_id,  me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_subject, memo_type, memo_owner, me_file_local, me_file_server, me_option )
               values ( $me_id,  '$row[mb_id]', '$member[mb_id]', '$g4[time_ymdhis]', '$me_memo', '$me_subject', 'send', '$member[mb_id]', '', '', '$html,$secret,$mail' ) ";
      sql_query($sql);

    } else {
        error_msg("���� type�� �������� �ʾҽ��ϴ�.");
    }

    // �ǽð� ���� �˸� ���
    $sql = " update $g4[member_table]
                set mb_memo_call = '$member[mb_id]'
              where mb_id = '$row[mb_id]' ";
    sql_query($sql);
    
    echo "$tot : " . $row[mb_id]. " �Կ��� ���� �߼�<br>";
    $tot++;
    
}

$tot2 = $tot-1; // ��ü �߼����� ����
alert("$tot2 ���� ���� ���� �Ϸ�", "./$doc?cb_id=$cb_id");
?>
