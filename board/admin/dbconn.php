<?
    $connect=mysql_connect( "localhost", "root", "apmsetup") or  die( "SQL server에 연결할 수 없습니다."); 

    mysql_select_db("cafe202",$connect);
/*아래 set하는 부분은 apmsetup으로 해서 나오는 문제이니 서버에서 실행시 제거하고실행*/
    mysql_set_charset("utf8", $connect); 

?>
