<meta charset="EUC-KR">
<?php

//데이터베이스 접속
include './include/DBConnect.php';
include './include/function.php';

$starting=$_REQUEST['starting'];
$ending=$_REQUEST['ending'];
$startmonth=$_REQUEST['startmonth'];
$startdate=$_REQUEST['startdate'];
$starthour=$_REQUEST['starthour'];
$startminute=$_REQUEST['startminute'];
$seatnum=$_REQUEST['seatnum'];

$takingInfo = $starting ."&" .$ending ."-" .$startmonth ."-" .$startdate ."&" .$starthour .":" .$startminute ."-" .$seatnum;

//echo("<script>");
//echo("alert('$takingInfo');");
//echo("</script>");

$SelectDB=mysqli_select_db($Connect, "bussystem");

if(!SelectDB){
	QueryError($Connect);
	exit;
}

// 수정할 단계
$Query="delete from reserve where takingInfo='$takingInfo'";
$Result=mysqli_query($Connect, $Query);
if(!$Result){
	QueryError($Connect);
	exit;
}

echo("<script>");
echo("location.href=\"Complete.html\"");
echo("</script>");

?>