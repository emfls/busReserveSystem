<meta charset="EUC-KR">
<?php
	
	// 데이터 베이스 접속
	include 'include/DBConnect.php';
	include 'include/function.php';
	
	//데이터 베이스 이름 정의 = 'use testdb'
	$selectDB = mysqli_select_db($Connect, "bussystem");
	if(!$selectDB) {
		QueryError($Connect);
		exit;
	}
	
	// 전달된 데이터 추출
	$name = $_REQUEST["name"];
	$birthday = $_REQUEST["birthday"];
	$email = $_REQUEST["email"];
	$password = $_REQUEST["password"];
	$phonenumber = $_REQUEST["phonenumber"];
	
	// 질의 수행 (추후 데이터 베이스 수정)
	$Query = "insert into user values('$email','$password','$birthday','$name','$phonenumber');";
	$stmt = mysqli_prepare($Connect, $Query);
	
	// 질의 수행중 에러날시 예외 처리
	if(!$stmt) {
		$ErrNo = @mysqli_connect_errno($stmt);
		$ErrStr = @mysqli_connect_error($stmt);
		$ErrNoStr = "DB연결에러 : " .$ErrNo ."-" .$ErrStr;
		echo("<Script language=\"javascript\">
				alert(\"$ErrNoStr\");
				window.close();
				</Script>");
	}
	
	//질의 실행 및 예외처리
	if(!mysqli_stmt_execute($stmt)) {
		die("질의 수행에 실패했습니다.");
		exit();
	}
	
	//sql 연결 종료
	mysqli_close($Connect);

	echo("<script>");
	echo("alert('회원가입이 완료되었습니다!');");
	echo("location.href='main.html' </script>");
	// 회원가입이 완료되었다고 출력하고 로그인 화면으로 돌아감 (수정 필요)
?>