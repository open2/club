<? 
//
// ������(korone)�� , ���Ծƺ�(eagletalon)�Բ��� ����� �ּ̽��ϴ�.
//
include_once "./_common.php";

$g4[title] = "Ŭ�� HISTORY";
include_once "$nc[cb_path]/head.sub.php";

$handle = @fopen("$nc[cb_path]/HISTORY_CLUB", "r");
if ($handle) {
    $buffer = fgetss($handle, 4096);
    fclose($handle);
}

echo "������� : <b>";
echo "$buffer";
echo "</b>";
?> 

<table width=100% border="0" align="left" cellpadding="0" cellspacing="0"> 
<tr> 
    <td> 
        <textarea name="textarea" style='width:100%; line-height:150%; padding:10px;' rows="25" class=tx readonly><?=implode("", file("$nc[cb_path]/HISTORY_CLUB"));?></textarea> 
    </td> 
</tr> 
<tr>
    <td>
    ������������� HISTORY ������ ù���� �о �״�� �����ִ� �� �Դϴ�.<br>
    �������� �߽����� ���������� ������� �ʾҴٸ� HISTORY_CLUB ������ ���� �Ͻñ� �ٶ��ϴ�.
    </td>
</tr>
</table> 

<?
include_once("$nc[cb_path]/tail.sub.php");
?>
