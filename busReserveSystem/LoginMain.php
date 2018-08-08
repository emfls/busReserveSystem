<?php
ob_start();
	session_start();
	
	// 데이터 베이스 접속
	include 'include/DBConnect.php';
	include 'include/function.php';
	
	//데이터 베이스 이름 정의 = 'use testdb'
	$selectDB = mysqli_select_db($Connect, "bussystem");
	if(!$selectDB) {
		QueryError($Connect);
		exit;
	}
	//질의 수행
	$Query="select name from user where EMail = '$_SESSION[email]'";
	
	$Result=mysqli_query($Connect, $Query);
	if(!$Result){
		QueryError($Connect);
		exit;
	}
	$Data=mysqli_fetch_array($Result);	// 질의를 수행한 것을 array형태로 저장한다.
	$username = $Data[name];		//array에서 자신의 이름을 불러온다.
	$_SESSION[name] = $username;	//세션에 자신의 이름도 저장
?>
<!DOCTYPE html>
<HTML>
<HEAD>
    <TITLE></TITLE>
    <meta charset="EUC-KR">
	<script src="script/jquery-3.1.1.min.js"></script>
    <style type="text/css">
    @font-face{
            font-family:'Daum_SemiBold'; 
            src:url('fonts/Daum_SemiBold.ttf')}
        html, body{
            font-family:'Daum_SemiBold';
        }
        .m-img{margin-left: 10%}
        img{
            margin-top: 18%;
            background-color: rgba(0, 0, 0, 0.32);
            border-radius: 22px;
        }
        body{
            font-family: "BMDOHYEON";
            position:static;
         width:100%;
         height:100%;
         min-width:1024px;
         min-height:768px;
         background-image: url(image/slider_image_1.jpg);
         background-size:cover;
         text-align:center;
         overflow: hidden;
        }
        
        img:hover {
              animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
              transform: translate3d(0, 0, 0);
              backface-visibility: hidden;
              perspective: 1000px;
            }

            @keyframes shake {
              10%, 90% {
                transform: translate3d(-1px, 0, 0);
              }

              20%, 80% {
                transform: translate3d(2px, 0, 0);
              }

              30%, 50%, 70% {
                transform: translate3d(-4px, 0, 0);
              }

              40%, 60% {
                transform: translate3d(4px, 0, 0);
              }
            }
        .fontBox{
            position: relative;
            font-weight:400;
            text-decoration: none;
            color: white;
            margin-right: 25px;
        }
        
        span.reserveBtn{
            position: relative;
            left:0;
        }
        
        span.cancel_reserveBtn{
            position: relative;
            left:0;
        }
        
        /*  */
        .reserveIFrame{
            position: absolute;
            border:0;
            top:0;
            left:100%;
            width:100%;
            height:100%;
            overflow: hidden;
        }

	.reserveIFrame2{
            position: absolute;
            border:0;
            top:0;
            left:100%;
            width:100%;
            height:100%;
            overflow: hidden;
            border:10px solid red;
            background-color:rgba(255, 255, 255, 0.4);
        }
        
        .topField{
            position: absolute;
            top: 0%;
            left: 0%;
            height: 3%;
            width: 100%;
            margin: 0 auto;
            background-color: rgba(0, 0, 0, 0.46);
            border: 0px;
        }
        
        .topBar{
            width: 100%;
            color: white;
        }
        table tr td a:hover{
            color: #06fff5;
        }

        #userInfo, #logout{
            z-index:10;
        }
    </style>

	<script>
        $(document).ready(function(){
            $('span.reserveBtn').on("click", animate);
            $('span.cancel_reserveBtn').on("click", animate2);
        });
            
        function animate(){
            $('div.fontBox').animate({left:-800}, 600);
            $('span.reserveBtn').animate({left:-800}, 600);
            $('span.cancel_reserveBtn').animate({left:-1100}, 600);
            $('iframe.reserveIFrame').animate({left:0}, 600);
        }
            
        function animate2(){
            $('div.fontBox').animate({left:-800}, 600);
            $('span.reserveBtn').animate({left:-800}, 600);
            $('span.cancel_reserveBtn').animate({left:-1100}, 600);
            $('iframe.reserveIFrame2').animate({left:0}, 600);
        }
        
        function Reverse_animate(){
            $('div.fontBox').animate({left:0}, 800);
            $('span.reserveBtn').animate({left:0}, 800);
            $('span.cancel_reserveBtn').animate({left:0}, 800);
            $('iframe.reserveIFrame').animate({left:'100%'}, 800);
        }
             
        
    </script>
</HEAD>
<BODY >
<fieldset class="topField">
        <table class="topBar">
            <tr>
                <td align=left><?=$username?>님 반갑습니다.</td>
                <td align=right><a href="edit.php" id="userInfo" class="fontBox">회원정보</a><a href="Logout.php" id="logout" class="fontBox">로그아웃</a></td>
            </tr>
        </table>
        
    </fieldset>
<span class="reserveBtn">
        <img id="y" src="image/getBus.png" width="180px" height="130px" >
    </span>
    
    <span class="cancel_reserveBtn">
        <img src="image/setbus.png" width="180px" height="130px" class="m-img">
    </span>
    
    <iframe class="reserveIFrame" src="Reservation_Bus.php">
        
    </iframe>
    
    <iframe class="reserveIFrame2" src="CheckBus.php">
        
    </iframe>
</BODY>
</HTML>