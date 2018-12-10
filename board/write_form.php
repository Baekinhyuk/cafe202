<?
	session_start();
	include "dbconn.php";

	if ($mode=="modify")
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);

		$row = mysql_fetch_array($result);

		$item_subject     = $row[subject];
		$item_content     = $row[content];
		$item_name = $row[name];
		$item_password = $row[password];
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<link href="css/board_inhyuk.css?ver=1" rel="stylesheet" type="text/css" media="all">
<script>
  function check_input()
   {
      if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.board_form.subject.focus();
          return;
      }

      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
   }
</script>
</head>

<body>

	<div id="col2">
		<div class="clear"></div>
		<div id="write_form_title">
			글쓰기
		</div>
		<div class="clear"></div>

<?
	if($mode=="modify")
	{

?>
		<form  name="board_form" method="post" action="insert.php?table=<?=$table?>&mode=modify&num=<?=$num?>" enctype="multipart/form-data">
<?
	}
	else
	{
?>
		<form  name="board_form" method="post" action="insert.php?table=<?=$table?>" enctype="multipart/form-data">
<?
	}
?>
		<div id="write_form">
			<div class="write_line"></div>
			<div id="write_row1"><div class="col1"> 제목   </div>
			                     <div class="col2"><input type="text" size="80" name="subject" value="<?=$item_subject?>" ></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row2"><div class="col1"> 내용   </div>
			                     <div class="col2"><textarea rows="15" cols="81" name="content"><?=$item_content?></textarea></div>

			<div class="write_line"></div>

			<div class="clear"></div>
			</div>

			<div id="write_row1">
				<div class="col1"> 글쓴이 </div><div class="col2"><input type="text" name="name" value="<?=$item_name?>" ></div>
				<div class="col1"> 비밀번호 </div><div class="col2"><input type="password" name="password" value="<?=$item_password?>" ></div>
			</div>

		<div id="write_button"><a href="#"><img src="img/ok.png" onclick="check_input()"></a>&nbsp;
								<a href="list.php?table=<?=$table?>&page=<?=$page?>"><img src="img/list.png"></a>
		</div>

		</form>

	</div>

</body>
</html>
