<?
include_once("./head.php");
?>

<?
// $doc url�� ������, ��õ Ŭ���� 5�� �����ش�.
if (!$doc) {
	//$doc = "./cb_list.php?cb_recommend=Y&rows=5&main=Y";
  //$new = "0"; 
	$doc = "./club_index_inc.php";
}
?>
          <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" scrolling="no" src="<?=$doc?>" name="CLUB_BODY" id="CLUB_BODY" ALLOWTRANSPARENCY="true"></iframe> 
<? 
include_once("./tail.php");
?>
