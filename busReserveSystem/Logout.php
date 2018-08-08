<?php
	session_start();
	 
	if(!$_SESSION[name]||!$_SESSION[email]){
		echo "<script>alert(\"로그인이 필요합니다.\");";
		echo "location.href='main.html';</script>";
	}else{
		session_destroy();
	
		echo "<script>alert(\"로그아웃 되었습니다.\");";
		echo "location.href='main.html';</script>";
	}
?>
<meta charset="EUC-KR">