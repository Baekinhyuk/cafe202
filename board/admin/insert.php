<? session_start(); ?>

<meta charset="utf-8">
<?

	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

	include "dbconn.php";       // dconn.php 파일을 불러옴

	if ($mode=="modify"){
		$sql = "UPDATE $table set name='$name',password='$password',subject='$subject',content='$content',regist_day='$regist_day' where num=$num";
	}
	else{
		$sql = "insert into $table (name, password, subject, content, regist_day, hit) ";
		$sql .= "values('$name', '$password', '$subject', '$content', '$regist_day', 0)";
	}
	mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행

	mysql_close();                // DB 연결 끊기

	echo "
	   <script>
	    location.href = 'list.php?table=$table&page=$page';
	   </script>
	";
?>
