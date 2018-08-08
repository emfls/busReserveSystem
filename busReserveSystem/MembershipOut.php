<?php
	// 세션시작(warring 에러 무시)
	@session_start();
	
	//데이터베이스 접속
	include './include/DBConnect.php';
	include './include/function.php';
	
	$SelectDB=mysqli_select_db($Connect, "bussystem");
	if(!SelectDB){
		QueryError($Connect);
		exit;
	}
	
	//질의 수행
	$Query="delete from user where EMail = '$_SESSION[email]'";
	
	$Result=mysqli_query($Connect, $Query);
	if(!$Result){
		QueryError($Connect);
		exit;
	}
	
	$Query="delete from reserve where EMail = '$_SESSION[email]'";
	
	$Result=mysqli_query($Connect, $Query);
	if(!$Result){
		QueryError($Connect);
		exit;
	}
	
	session_destroy();
	
	echo("<script>alert('회원탈퇴 되었습니다.');");
	echo "location.href='main.html';</script>";
	
?>
<meta charset="EUC-KR">