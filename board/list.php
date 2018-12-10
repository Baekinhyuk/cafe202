<html>
<head>
<meta charset="utf-8">

<link href="css/board_inhyuk.css?ver=1" rel="stylesheet" type="text/css" media="all">
<script>
	function golist(href)
	{
		document.location.href = href;
	};
	function newwrite(href)
	{
		document.location.href = href;
	}
</script>
</head>
<?
	include "dbconn.php";
	$scale=5;			// 한 화면에 표시되는 글 수
	$table = "cafe202.freeboard";
    if ($mode=="search") //검색모드
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     	history.go(-1);
				</script>
			");
			exit;
		}

		$sql = "select * from $table where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from $table order by num desc";
	}

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
		<table style ="border: 0px" width = "100%">
			<tr>
				<td width ="85%">
					<div id="col2">
						<div id="title">
							자유게시판
						</div>

					<form  name="board_form" method="post" action="list.php?table=<?=$table?>&mode=search">
					<div id="list_search">
						<div id="list_search1">▶ 총 <?= $total_record ?> 개의 게시물이 있습니다.  </div>
						<div id="list_select">SELECT</div>
						<div id="list_selectlist">
							<select name="find">
													<option value='subject'>제목</option>
													<option value='content'>내용</option>
													<option value='name'>글쓴이</option>
							</select></div>
						<div id="list_inputtext"><input type="text" name="search"></div>
					</div>
					</form>
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
						echo "<a href='list.php?table=$table&page=$i'> $i </a>";
					}
					}
					?>
					&nbsp;&nbsp;&nbsp;&nbsp;다음 ▶
					</div>

					<div id="button">
						<input type='button' value="목록" class="result_btn" onclick="golist('list.php?table=<?=$table?>&page=<?=$page?>')"/>&nbsp;
						<input type='button' value="글쓰기" class="result_btn" onclick="newwrite('write_form.php?table=<?=$table?>')"/>
					</div>
					</div>
					</div>
					<div class="clear"></div>
					</div>
					</td>
			</tr>
		</table>
</body>
</html>
