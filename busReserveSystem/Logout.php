<?php
	session_start();
	 
	if(!$_SESSION[name]||!$_SESSION[email]){
		echo "<script>alert(\"�α����� �ʿ��մϴ�.\");";
		echo "location.href='main.html';</script>";
	}else{
		session_destroy();
	
		echo "<script>alert(\"�α׾ƿ� �Ǿ����ϴ�.\");";
		echo "location.href='main.html';</script>";
	}
?>
<meta charset="EUC-KR">