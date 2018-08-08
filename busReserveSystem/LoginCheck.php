<?php
// 변수선언
$resultvalue=false;
 
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
$email = $_REQUEST["email"];
$password = $_REQUEST["pass"];
 
// 질의 수행 (추후 데이터 베이스 수정)
$Query = "select name from user where EMail = '$email' and Password = '$password' ";
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
 
// 질의 실행한
while(!is_null(mysqli_stmt_fetch($stmt))) {
	$resultvalue=true;
}
 
//sql 연결 종료
mysqli_close($Connect);
if($resultvalue==true) {      // 해당되는 id값의 리절트 값이 있을 경우
	session_start();         // 세션동작
	$_SESSION[email] = $email;   // 세션대입
	echo("<script>");
	echo("location.href='LoginMain.php' </script>");
} else {               // 해당되는 id의 리절트 값이 없을 경우
	echo("<script>");
	echo("alert(\"ID와 비밀번호를 확인하세요!\");");
	echo("history.back(); </script>");
	// 파라메터로부터 이전 페이지의 id의 이름을 가진 곳의 값을 가져와서 그 값을 가지는 유저의 db정보가 있는지 확인 후
	// 있으면 중복 표시, 없으면 인증 표시
}
?>
<meta charset="EUC-KR">