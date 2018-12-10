<?
	//session_start();
	include "dbconn.php";

	$sql = "select * from cafe202.freeboard where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);
      // 하나의 레코드 가져오기

	$item_num     = $row[num];
	$item_password      = $row[password];
	$item_name    = $row[name];
	$item_hit     = $row[hit];

  $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	$item_content = $row[content];
	//html에서 보여주는 것이므로
	$item_content = str_replace(" ", "&nbsp;", $item_content);
	$item_content = str_replace("\n", "<br>", $item_content);
	$is_html      = $row[is_html];

	$new_hit = $item_hit + 1;

	$sql = "update $table set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<link href="../css/board_inhyuk.css?ver=1" rel="stylesheet" type="text/css" media="all">
<link href="../css/ripple_inhyuk.css?ver=1" rel="stylesheet" type="text/css" media="all">
<script>
	var savepassword = '<?echo($item_password);?>';
	var char = 5;
	function golist(href)
	{
		document.location.href = href;
	};
	function modify(href)
	{
		document.location.href = href;
	};
	function del(href)
	{
		document.location.href = href;
	};
	function newwrite(href)
	{
		document.location.href = href;
	}
</script>
</head>

<body>

	<div id="col2">
		<div id="view_comment"> &nbsp;</div>

		<div id="view_title">
			<div id="view_title1"><?= $item_subject ?></div><div id="view_title2"><?= $item_nick ?> | 조회 : <?= $item_hit ?>
			                      | <?= $item_date ?> </div>
		</div>

		<div id="view_content">
			<?= $item_content ?>
		</div>



		<div id="ripple">
			<div id="ripple1">덧글</div>
			<div id="ripple2">
		<?
			$ripple_table = "cafe202.freeboard_ripple";
			$sql = "select * from $ripple_table where freeboardnum='$item_num'";
			$ripple_result = mysql_query($sql);

		while ($row_ripple = mysql_fetch_array($ripple_result))
		{
			$ripple_num     = $row_ripple[num];
			$ripple_name      = $row_ripple[name];
			$ripple_password    = $row_ripple[password];
			$ripple_content = str_replace("\n", "<br>", $row_ripple[content]);
			$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
			$ripple_date    = $row_ripple[regist_day];
		?>
				<div id="ripple_title">
				<ul>
				<li><?= $ripple_name ?> &nbsp;&nbsp;&nbsp; <?= $ripple_date ?></li>
				<li id="mdi_del">
					<!--
					<label>비밀번호</label> <input type="password" style="width:100px" value="<?=$ripple_password_chk?>"/>-->
					<?
						//if($userid=="admin" || $userid==$ripple_id)
										echo "<a href='ripple/delete_ripple.php?ripple_num=$ripple_num&table=<?=$ripple_table?>&board_num=$item_num'>삭제</a>";
					?>
				</li>
				</ul>
				</div>
				<div id="ripple_content"> <?= $ripple_content ?></div>
		<?
		}
		?>
				<form  name="ripple_form" method="post" action="../ripple/insert_ripple.php?table=<?=$ripple_table?>&name=<?=$ripple_name?>&password=<?=$ripple_password?>&num=<?=$item_num?>">
				<input type="hidden" name="num" value="<?= $item_num ?>">
				<div id="ripple_insert">
						<div id="ripple_textarea">
							<div class="col1"> 글쓴이 <input type="text" name="name" value="<?=$ripple_name?>" >  비밀번호 <input type="password" name="password" value="<?=$ripple_password?>" ></div>
						<textarea rows="3" cols="80" name="ripple_content"></textarea>
					</div>
					<div id="ripple_button"><input type="image" src="../img/memo_ripple_button.png"></div>
				</div>
				</form>

			</div> <!-- end of ripple2 -->




	<div id="view_button">
		<label>비밀번호</label> <input type="password" id="password"/>
		<input type='button' value="목록" class="result_btn" onclick="golist('list.php?table=<?=$table?>&page=<?=$page?>')"/>
		<input type='button' value="수정" class="result_btn" onclick="modify('write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>')"/>
		<input type='button' value="삭제" class="result_btn" onclick="del('delete.php?table=<?=$table?>&num=<?=$num?>')"/>
		<input type='button' value="글쓰기" class="result_btn" onclick="newwrite('write_form.php?table=<?=$table?>')"/>
	</div>

		<div class="clear"></div>

	</div>
  </div>
</div>
</body>
</html>
