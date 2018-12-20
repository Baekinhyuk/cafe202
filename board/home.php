<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<link href="css/board_inhyuk.css?ver=1" rel="stylesheet" type="text/css" media="all">
<script>
</script>
</head>

<?
	include "dbconn.php";
	$scale=3;			// 한 화면에 표시되는 글 수
	$table = "cafe202.freeboard";
  $sql = "select * from $table order by num desc";
	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result); // 전체 글 수
	// 전체 페이지 수($total_page) 계산
	if ($total_record % $scale == 0)
		$total_page = floor($total_record/$scale);
	else
		$total_page = floor($total_record/$scale) + 1;
	if (!$page)                 // 페이지번호($page)가 0 일 때
		$page = 1;              // 페이지 번호를 1로 초기화
	// 표시할 페이지($page)에 따라 $start 계산
	$start = ($page - 1) * $scale;
	$number = $total_record - $start;
?>

<body>
	<table border="0" bordercolor="black" width ="100%" align = "center" >
		<tr align ="center">
      <td colspan="3" width ="70%"><h1>※추천메뉴※</h1></td>
      <td align ="center" width ="10%"><a target="right" href="menu.php">+more</a></td>
    </tr>
	</table>
	<table border="0" bordercolor="black" width ="100%" align = "center" >
		<tr align ="center">
			<td width ="20%"><a target="right" href="menu/menu_q4.php"><img src="img/큐브아포카토.jpg" width="200px" height="250px" border="0"></a></td>
			<td width ="20%"><a target="right" href="menu/menu_choco.php"><img src="img/초코라떼.jpg" width="200px" height="250px" border="0"></a></td>
			<td width ="20%"><a target="right" href="menu/menu_milk.php"><img src="img/연유라뗴.jpg" width="200px" height="250px" border="0"></a></td>
			<td width ="20%"><a target="right" href="menu/menu_oreo.php"><img src="img/오레오 바나나 쉐이크.jpg" width="200px" height="250px" border="0"></a></td>
		</tr>
		<tr align ="center">
			<td width ="20%">큐브 아포카토</td>
			<td width ="20%">초코라떼</td>
			<td width ="20%">연유라떼</td>
			<td width ="20%">오레오바나나쉐이크</td>
		</tr>
		<tr align ="center">
			<td width ="20%">3900</td>
			<td width ="20%">3900</td>
			<td width ="20%">3900</td>
			<td width ="20%">3900</td>
		</tr>
	</table>

  <table border="0" bordercolor="black" width ="100%" align = "center" >
    <tr align ="center">
      <td colspan="3" width ="70%"><h1>※자유게시판※</h1></td>
      <td align ="center" width ="10%"><a target="right" href="list.php">+more</a></td>
    </tr>
  </table>
  <table style ="border: 0px" width = "100%">
    <tr>
      <td width ="85%">
        <div id="col2">

        <div class="clear"></div>

        <!--게시판 위에 바 -->
        <div id="list_top_title">
          <table align = "center" width ="100%">
          <tr>
            <td width ="10%" id="list_title1">번호</td>
            <td width ="60%" id="list_title2">제목</td>
            <td width ="10%" id="list_title3">글쓴이</td>
            <td width ="10%" id="list_title4">등록일</td>
            <td width ="10%" id="list_title5">조회</td>
          </tr>
        </table>
        </div>

        <!--게시판 안에 내용들 -->
        <div id="list_content">
        <?
        for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
        {
          mysql_data_seek($result, $i);
          // 가져올 레코드로 위치(포인터) 이동
          $row = mysql_fetch_array($result);
          // 하나의 레코드 가져오기

        $item_num     = $row[num];
        $item_name    = $row[name];
        $item_password    = $row[password];
        $item_hit     = $row[hit];
        $item_date    = $row[regist_day];
        $item_date = substr($item_date, 0, 10);
        $item_subject = str_replace(" ", "&nbsp;", $row[subject]);
        ?>
        <table align = "center" width ="100%" style ="border-bottom: 1px solid #444444" >
        <tr height="30">
          <td width ="10%" id="list_item1"><?= $number ?></td>
          <td width ="60%" id="list_item2"><a href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>"><?= $item_subject ?></a></td>
          <td width ="10%" id="list_item3"><?= $item_name ?></td>
          <td width ="10%" id="list_item4"><?= $item_date ?></td>
          <td width ="10%" id="list_item5"><?= $item_hit ?></td>
        </tr>
      </table>
        <?
           $number--;
        }
        ?>
          <div id="page_button">
            <div id="page_num"> ◀ 이전 &nbsp;&nbsp;&nbsp;&nbsp;
        <?
        // 게시판 목록 하단에 페이지 링크 번호 출력
        for ($i=1; $i<=$total_page; $i++)
        {
        if ($page == $i)     // 현재 페이지 번호 링크 안함
        {
          echo "<b> $i </b>";
        }
        else
        {
          echo "<a href='home.php?table=$table&page=$i'> $i </a>";
        }
        }
        ?>
        &nbsp;&nbsp;&nbsp;&nbsp;다음 ▶
        </div>
        </div>
        </div>
        <div class="clear"></div>
        </div>
        </td>
    </tr>
  </table>
<!--Start of Tawk.to Script-->
   <script type="text/javascript">
   var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
   (function(){
   var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
   s1.async=true;
   s1.src='https://embed.tawk.to/5bc0537e08387933e5bb0d26/default';
   s1.charset='UTF-8';
   s1.setAttribute('crossorigin','*');
   s0.parentNode.insertBefore(s1,s0);
   })();
   </script>
   <!--End of Tawk.to Script-->
</body>
</html>
