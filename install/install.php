<?
include_once "./_common.php";
include_once "$cb_path/lib/club.lib.php";
?>

<title>NC Ŭ�� ��ġ</title>
<script language="JavaScript" type="text/JavaScript">
    function agree_form()
    {
        f = document.form;
        
        if (f.agree.checked != true) {
            alert("�̿����� ���� �ؾ߸� ��ġ�� �����մϴ�.");
        } else {
            f.submit();
        }
    }
</script>
<style type="text/css">
body, table, tr, td, form, select, input, textarea, p, font, a, b, strong {
	font-family: "����", Verdana, Tahoma;
	font-size: 12px;
	color: #333333;
}

a:link {
	color: #333333;
	text-decoration: none;
}

a:visited {
	color: #333333;
	text-decoration: none;
}

a:active {
	color: #333333;
	text-decoration: none;
}

a:hover {
	color: #333333;
	text-decoration: underline;
}

a.title:link {
	color: #ffffff;
	text-decoration: none;
}

a.title:visited {
	color: #ffffff;
	text-decoration: none;
}

a.title:active {
	color: #333333;
	text-ffffff: none;
}

a.title:hover {
	color: #ffffff;
	text-decoration: underline;
}

a.boxtext:link {
	color: #ffffff;
	text-decoration: none;
}

a.boxtext:visited {
	color: #ffffff;
	text-decoration: none;
}

a.boxtext:active {
	color: #333333;
	text-ffffff: none;
}

a.boxtext:hover {
	color: #ffffff;
	text-decoration: underline;
}
</style>
</head>

<body>
<br><br><br>
<form name="form" method="post" action="./install1.php">
<input type="hidden" name="cb_id"   value="clubhouse">
<input type="hidden" name="cb_name" value="Ŭ���Ͽ콺">
<table  border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center">NC Ŭ���� ��ġ�մϴ�. �Ʒ��� �̿� ����� ���� �ؾ߸� ��ġ �� ����� �����մϴ�. </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    <textarea name="textarea" cols="100" rows="15"><?=implode("", file("../LICENSE_CLUB"));?>
    </textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><input type="checkbox" name="agree" id="agree" value="1">
    <label for=agree>���� ����Ʈ���� �̿� ����� ��� �� �о� ���Ұ� ��� ���뿡 ���� �մϴ�.</label>
    </td>
  </tr>
  </form>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><input type="button" name="Button" value=" ��  ġ " onClick="agree_form();"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
