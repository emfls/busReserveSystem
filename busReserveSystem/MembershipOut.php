<?php
	// ���ǽ���(warring ���� ����)
	@session_start();
	
	//�����ͺ��̽� ����
	include './include/DBConnect.php';
	include './include/function.php';
	
	$SelectDB=mysqli_select_db($Connect, "bussystem");
	if(!SelectDB){
		QueryError($Connect);
		exit;
	}
	
	//���� ����
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
	
	echo("<script>alert('ȸ��Ż�� �Ǿ����ϴ�.');");
	echo "location.href='main.html';</script>";
	
?>
<meta charset="EUC-KR">