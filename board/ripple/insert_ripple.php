<?
   session_start();
?>
<meta charset="utf-8">
<?
   if(!$ripple_content) {
     echo("
	   <script>
	     window.alert('내용을 입력하세요.')
	     history.go(-1)
	   </script>
	 ");
	 exit;
   }

   include "../dbconn.php";       // dconn.php 파일을 불러옴

   $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

   // 레코드 삽입 명령
   $sql = "insert into $table (freeboardnum, name, password, content, regist_day) ";
   $sql .= "values('$num', '$name', '$password', '$ripple_content', '$regist_day')";

   mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행

   mysql_close();                // DB 연결 끊기
   $table = "cafe202.freeboard";
   echo "
	   <script>
	    location.href = '../view.php?table=$table&num=$num';
	   </script>
	";
?>
