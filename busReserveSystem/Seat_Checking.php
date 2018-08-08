<?php

	// 데이터 베이스 접속
	include 'include/DBConnect.php';
	include 'include/function.php';
	
	//데이터 베이스 이름 정의 = 'use testdb'
	$SelectDB=mysqli_select_db($Connect, "bussystem");
	if(!SelectDB){
		QueryError($Connect);
		exit;
	}
	
	// 전달된 데이터 추출 및 데이터 처리
	$year = $_REQUEST[year];
	$month = $_REQUEST[month];
	$date = $_REQUEST[date];
	$hours = $_REQUEST[hours];
	$minute = $_REQUEST[minute];
	$departure = $_REQUEST[departure];
	$arrival = $_REQUEST[arrival];
	$starttime = $hours .":" .$minute;
	
	if(!strcmp($departure, "서울")) {
		$departurenumber = "001";
		str_pad($departurenumber,3,"0",STR_PAD_LEFT);
	} elseif(!strcmp($departure, "인천")) {
		$departurenumber = "002";
		str_pad($departurenumber,3,"0",STR_PAD_LEFT);
	} elseif(!strcmp($departure, "대전")) {
		$departurenumber = "003";
		str_pad($departurenumber,3,"0",STR_PAD_LEFT);
	} elseif(!strcmp($departure, "부산")) {
		$departurenumber = "004";
		str_pad($departurenumber,3,"0",STR_PAD_LEFT);
	} else {
		$departurenumber = "005";
		str_pad($departurenumber,3,"0",STR_PAD_LEFT);
	}
	
	if(!strcmp($arrival, "서울")) {
		$arrivalnumber = "001";
		str_pad($arrivalnumber,3,"0",STR_PAD_LEFT);
	} elseif(!strcmp($arrival, "인천")) {
		$arrivalnumber = "002";
		str_pad($arrivalnumber,3,"0",STR_PAD_LEFT);
	} elseif(!strcmp($arrival, "대전")) {
		$arrivalnumber = "003";
		str_pad($arrivalnumber,3,"0",STR_PAD_LEFT);
	} elseif(!strcmp($arrival, "부산")) {
		$arrivalnumber = "004";
		str_pad($arrivalnumber,3,"0",STR_PAD_LEFT);
	} else {
		$arrivalnumber = "005";
		str_pad($arrivalnumber,3,"0",STR_PAD_LEFT);
	}
	echo("<script>");
	
	//질의 수행
	$Query="select time, money from businfo where busStart='$departurenumber' and busArrive='$arrivalnumber'";
	echo("alert(\"$Query\");");
	
	$Result=mysqli_query($Connect, $Query);
	if(!$Result){
		QueryError($Connect);
		exit;
	}
	
	$Data=mysqli_fetch_array($Result);
	$gettime = $Data[time];
	$money = $Data[money];
	sscanf($gettime, "%2d:%2d",$endhour,$endmine);
	
	$dateArray=array(9,11,14,18,20);
	
	for($i=0; $i < count($dateArray); $i++){
		if($hours < $dateArray[$i]){
			$cnt=$i;
			break;
		}
	}
	
	for($j=$cnt; $j < count($dateArray); $j++){
		//질의 수행
		$Query="select * from reserve where takingInfo like '' ";
		echo("alert(\"$Query\");");
		
		//32 - 나오는 자릿수
		$Result=mysqli_query($Connect, $Query);
		if(!$Result){
			QueryError($Connect);
			exit;
		}
		
		$endtime = $dateArray[$j] + $endhour;
		echo("	
				// 출발지 생성하는 작업
				var td1 = document.createElement(\"td\");			// Create a <td> element
				var t = document.createTextNode('$departure');		// Create a text node
				td1.appendChild(t);								// Append the text to <td>
				// 도착지 생성하는 작업
				var td2 = document.createElement(\"td\");			// Create a <td> element
				var t = document.createTextNode('$arrival');		// Create a text node
				td2.appendChild(t);								// Append the text to <td>
				// 출발시간 생성하는 작업
				var td3 = document.createElement(\"td\");			// Create a <td> element
				var t = document.createTextNode($dateArray[$j]+':00');		// Create a text node
				td3.appendChild(t);								// Append the text to <td>
				// 도착시간 생성하는 작업
				var td4 = document.createElement(\"td\");			// Create a <td> element
				var t = document.createTextNode($endtime +':00');		// Create a text node
				td4.appendChild(t);								// Append the text to <td>
				// 소요시간 생성하는 작업
				var td5 = document.createElement(\"td\");			// Create a <td> element
				var t = document.createTextNode('$gettime');		// Create a text node
				td5.appendChild(t);								// Append the text to <td>
				// 금액 생성하는 작업
				var td6 = document.createElement(\"td\");			// Create a <td> element
				var t = document.createTextNode($money);		// Create a text node
				td6.appendChild(t);								// Append the text to <td>
		
					
				// tr태그 생성 작업
				var tr = document.createElement(\"tr\");			// Create a <tr> element
				// tr에 넣는 작업
				tr.appendChild(td1);								// Append <td> to <tr>
				tr.appendChild(td2);								// Append <td> to <tr>
				tr.appendChild(td3);								// Append <td> to <tr>
				tr.appendChild(td4);
				tr.appendChild(td5);
				tr.appendChild(td6);
				//최종적으로 추가하는 작업
				opener.document.all.appendtable.appendChild(tr);		// Append <tr> to <body>
				");
	}
	
	
	
	//echo("for(var i=cnt; i<dateArray.length; i++){");
	//echo("$('.table >tbody:last').append('<tr align=center>');");
	//echo("$('.table >tbody:last').append('<td width=10%>'+departure+'</td>');");
	//echo("$('.table >tbody:last').append('<td width=10%>'+arrival+'</td>');");
	//echo("$('.table >tbody:last').append('<td width=10%>'+dateArray[i]+':00'+'</td>');");
	//echo("$('.table >tbody:last').append('<td width=10%>'+'도착시간'+'</td>');");
	////echo("$('.table >tbody:last').append('<td width=10%>'+'소요시간'+'</td>');");
	//echo("$('.table >tbody:last').append('<td width=10%>'+'금액'+'</td>');");
	//echo("$('.table >tbody:last').append('<td width=10%>'+'잔여좌석'+'</td>');");
	//echo("$('.table >tbody:last').append('<td width=10% align=center><input type=\"button\" class=\"sub\" value=\"선택\" onclick=\"\"></td>');");
	//echo("$('.table >tbody:last').append('</tr>');");
	//echo("}");
	//echo("alert('$year');");
	//echo("alert('$month');");
	//echo("alert('$date');");
	//echo("alert('$hours');");
	//echo("alert('$minute');");
	//echo("alert('$departure');");
	//echo("alert('$arrival');");
	echo("</script>");
	

?>
<meta charset="EUC-KR">
<link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.css">
<script src="script/jquery-3.1.1.min.js"></script>
<script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>