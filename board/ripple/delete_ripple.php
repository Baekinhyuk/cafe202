<?
      include "../dbconn.php";

      $sql = "delete from cafe202.freeboard_ripple where num=$ripple_num";
      mysql_query($sql, $connect);
      mysql_close();

      echo "
	   <script>
	    location.href = '../view.php?table=$table&num=$board_num';
	   </script>
	  ";
?>
