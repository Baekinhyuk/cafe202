<?php
	include "dbconn.php";
	$table = "cafe202.admin";
  $sql = "select * from $table";

	$result = mysql_query($sql, $connect);
  $row = mysql_fetch_array($result); //저장되어있는 아이디 비번을 한 array로 가져옴

  $admin_id = $row[id];
  $admin_password = $row[password];
?>
<html>
<head>
<meta charset="utf-8">
<script>
var savepassword = '<?echo($admin_password);?>';
var saveid = '<?echo($admin_id);?>';
function check_input()
 {
    if (!document.getElementById('name').value)
    {
        alert("아이디를 입력하세요!");
        return;
    }
    if (!document.getElementById('password').value)
    {
        alert("비밀번호를 입력하세요!");
        return;
    }
    if(document.getElementById('password').value == savepassword && document.getElementById('name').value == saveid){
      gohref('admin/list.php');
    }
    else {
      alert("회원정보가 일치하지 않습니다.");
    }
};
function gohref(href)
{
  document.location.href = href;
};
</script>
</head>

<body>
  <table border="0" bordercolor="black" width ="40%" style="position:absolute; top:50%; left:50%; overflow:hidden;margin-top:-150px; margin-left:-250px;"align = "center" >
		<tr align ="center">
			<td colspan="2" width ="40%"><h1>관리자 모드</h1></td>
		</tr>
		<tr bgcolor="#eeeeee" align ="center">
      <td width ="20%">아이디</td>
      <td width ="30%"><input type="text" id="name"/></td>
    </tr>
    <tr bgcolor="#eeeeee" align ="center">
      <td width ="20%">비밀번호</td>
      <td width ="30%"><input type="password" id="password"/></td>
    </tr>
    <tr align ="center">
      <td colspan="2" width ="40%"><input type="image" src="img/login_btn.png" onclick="check_input()"/></td>
    </tr>
  </table>
</body>
</html>
