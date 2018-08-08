<?php

//데이터베이스 접속
include './include/DBConnect.php';
include './include/function.php';

//전달된 데이터 추출
$user_name=$_POST['name'];
$user_birthday=$_POST['birthday'];
$user_email=$_POST['email'];
$user_password=$_POST['password'];
$user_phonenumber=$_POST['phonenumber'];

$SelectDB=mysqli_select_db($Connect, "bussystem");
if(!SelectDB){
	QueryError($Connect);
	exit;
}

$Query="update user set name='$user_name' where EMail='$user_email'";
$Result=mysqli_query($Connect, $Query);
if(!$Result){
	QueryError($Connect);
	exit;
}
$Query="update user set birthday='$user_birthday' where EMail='$user_email'";
$Result=mysqli_query($Connect, $Query);
if(!$Result){
	QueryError($Connect);
	exit;
}
$Query="update user set Password='$user_password' where EMail='$user_email'";
$Result=mysqli_query($Connect, $Query);
if(!$Result){
	QueryError($Connect);
	exit;
}
$Query="update user set phoneNumber='$user_phonenumber' where EMail='$user_email'";
$Result=mysqli_query($Connect, $Query);
if(!$Result){
	QueryError($Connect);
	exit;
}

echo("<script>alert('회원정보 수정이 완료되었습니다.');</script>");

//UserList.php 호출
echo("<meta http-equiv='Refresh' content='0; URL=LoginMain.php'>");

?>