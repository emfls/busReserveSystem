<meta charset="EUC-KR">
<?php
	
	// ������ ���̽� ����
	include 'include/DBConnect.php';
	include 'include/function.php';
	
	//������ ���̽� �̸� ���� = 'use testdb'
	$selectDB = mysqli_select_db($Connect, "bussystem");
	if(!$selectDB) {
		QueryError($Connect);
		exit;
	}
	
	// ���޵� ������ ����
	$name = $_REQUEST["name"];
	$birthday = $_REQUEST["birthday"];
	$email = $_REQUEST["email"];
	$password = $_REQUEST["password"];
	$phonenumber = $_REQUEST["phonenumber"];
	
	// ���� ���� (���� ������ ���̽� ����)
	$Query = "insert into user values('$email','$password','$birthday','$name','$phonenumber');";
	$stmt = mysqli_prepare($Connect, $Query);
	
	// ���� ������ �������� ���� ó��
	if(!$stmt) {
		$ErrNo = @mysqli_connect_errno($stmt);
		$ErrStr = @mysqli_connect_error($stmt);
		$ErrNoStr = "DB���ῡ�� : " .$ErrNo ."-" .$ErrStr;
		echo("<Script language=\"javascript\">
				alert(\"$ErrNoStr\");
				window.close();
				</Script>");
	}
	
	//���� ���� �� ����ó��
	if(!mysqli_stmt_execute($stmt)) {
		die("���� ���࿡ �����߽��ϴ�.");
		exit();
	}
	
	//sql ���� ����
	mysqli_close($Connect);

	echo("<script>");
	echo("alert('ȸ�������� �Ϸ�Ǿ����ϴ�!');");
	echo("location.href='main.html' </script>");
	// ȸ�������� �Ϸ�Ǿ��ٰ� ����ϰ� �α��� ȭ������ ���ư� (���� �ʿ�)
?>