<meta charset="EUC-KR">
<?php

	// ��������
	$resultvalue=false;
	
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
	$email = $_REQUEST["email"];
	
	// ���� ���� (���� ������ ���̽� ����)
	$Query = "select email from user where EMail = '$email' ";
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
	
	// ���� ������ 
	while(!is_null(mysqli_stmt_fetch($stmt))) {
		$resultvalue=true;
	}
	
	//sql ���� ����
	mysqli_close($Connect);
	
	if($resultvalue==true) {		// �ش�Ǵ� id���� ����Ʈ ���� ���� ���
		echo("<script>");
		echo("opener.document.all.EMailCheckText.innerText=\"�ߺ���\";");
		echo("opener.document.all.EMailCheckText.style.color='RED';");
		echo("window.close(); </script>");
	} else {					// �ش�Ǵ� id�� ����Ʈ ���� ���� ���
		echo("<script>");
		echo("opener.document.all.EMailCheckText.innerText=\"������\";");
		echo("opener.document.all.EMailCheckText.style.color='yellow';");
		echo("window.close(); </script>");
		// �Ķ���ͷκ��� ���� �������� id�� �̸��� ���� ���� ���� �����ͼ� �� ���� ������ ������ db������ �ִ��� Ȯ�� ��
		// ������ �ߺ� ǥ��, ������ ���� ǥ��
	}
?>