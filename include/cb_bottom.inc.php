<table width="<?=$nc[nf_width]?>" border="0" align="<?=$nc[nf_align]?>" cellspacing="0" cellpadding="0" style='margin:0px auto' >
<tr>
	<td height="20"></td>
</tr>
<? if ($cb[cb_tail_textarea]) { ?>
<tr>
	<td style="height:25px; text-align:center; border-top:1px solid #EEEEEE; padding-top:15px;">
    <? 
		$tail_text = stripslashes($cb[cb_tail_textarea]);
		echo strip_only($tail_text, "script");
    ?>
    </td>
</tr>
<? } else { ?>
<tr>
	<td style="height:25px; text-align:center; border-top:1px solid #EEEEEE; padding-top:15px;">
    Ŭ������ 
    - <a href="<?=$nc[cb_path]?>/club_index.php?doc=bbs/club_rule.php">Ŭ���̿���</a> 
    - Ŭ���̿����Ѿȳ�
    - ����������޹�ħ 
    - å���� �Ѱ�� ��������
    </td>
</tr>
<tr>
	<td height="20" align="center">Copyright �� <strong>Naraorum, �ƺ��Ҵ�, whitefree</strong>. All Rights Reserved.</td>
</tr>
<? } ?>
<tr>
	<td height="20"></td>
</tr>
</table>
