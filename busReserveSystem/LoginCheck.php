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
$password = $_REQUEST["pass"];
 
// ���� ���� (���� ������ ���̽� ����)
$Query = "select name from user where EMail = '$email' and Password = '$password' ";
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
if($resultvalue==true) {      // �ش�Ǵ� id���� ����Ʈ ���� ���� ���
	session_start();         // ���ǵ���
	$_SESSION[email] = $email;   // ���Ǵ���
	echo("<script>");
	echo("location.href='LoginMain.php' </script>");
} else {               // �ش�Ǵ� id�� ����Ʈ ���� ���� ���
	echo("<script>");
	echo("alert(\"ID�� ��й�ȣ�� Ȯ���ϼ���!\");");
	echo("history.back(); </script>");
	// �Ķ���ͷκ��� ���� �������� id�� �̸��� ���� ���� ���� �����ͼ� �� ���� ������ ������ db������ �ִ��� Ȯ�� ��
	// ������ �ߺ� ǥ��, ������ ���� ǥ��
}
?>
<meta charset="EUC-KR">