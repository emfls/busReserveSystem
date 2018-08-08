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
	$Query="select * from reserve where EMail = '$_SESSION[email]'";
	
	$Result=mysqli_query($Connect, $Query);
	if(!$Result){
		QueryError($Connect);
		exit;
	}
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<TITLE>�������� ����</TITLE>
		<meta charset="EUC-KR">
		<script src="script/jquery-3.1.1.min.js"></script>
		  <style type="text/css">
		  @font-face{
            font-family:'BMDOHYEON'; 
            src:url('fonts/BMDOHYEON_ttf.ttf')}
        html, body{
            font-family:'BMDOHYEON';
            background-color:transparent;
        }
        .sub{
                display:block; 
                width:50px; 
                height:30px; 
                border-radius:10px; 
                border: 2px solid #ffffff; 
                font-size:14px;
                font-weight:500;
                color:#ffffff; 
                text-decoration: none; 
                line-height:25px;  
                text-align:center;
                background-color: rgba(0, 0, 0, 0);
                font-weight: 900;
            }
        .sub:hover{
            color: red;
            border: 2px solid red;
            transition-property: all;
            transition-duration: 1s;
            transition-timing-function: linear;
        }
        form{
            position: relative;
            margin-left: 13%;
            margin-top: 2%;
            
        }
        fieldset{
            display: block;
            border-radius:20px;
            border: 1px solid gray;
            background-color: rgba(0, 0, 0, 0.32);
        }
        .field{
            position: relative;
            top: 50px;
            margin:0 auto;
            width:1000px;
        }
        body{
            position:static;
         width:100%;
         height:100%;
         min-width:1024px;
         min-height:768px;
		 background: transparent;
         background-size:cover;
         text-align:center;
         overflow : hidden;
        }
        
        .bottomField{
            margin:0 auto;
            position: relative;
            width: 800px;
            height: 460px;
        }
        
        .table{
            position: relative;
            /*margin-left: 240px;
            margin-top: 170px; */
            background-color: ;
            width: 780px;
            color: white;
            
        }
        
        .searchTable{
        	margin-left:130px;
            color: white;
        }
        
        .tableBox{
            margin: 0 auto;
            margin-top: 5px;
            overflow-y: auto;
            overflow-x: hidden;
            width: 800px;
            height:450px;
        }
        .tableBox::-webkit-scrollbar-track
        {
            border: 1px solid black;
            background-color: rgba(245, 245, 245, 0);
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
          border-radius: 10px;
        }

        .tableBox::-webkit-scrollbar
        {
            width: 10px;
            background-color: rgba(245, 245, 245, 0);
        }

        .tableBox::-webkit-scrollbar-thumb
        {
            background-color: rgba(244, 13, 13, 0.51);   
            border-radius: 10px;
          -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        }
        
        .returnButton{
            position:absolute;
            width: 50px;
            height: 40px;
            margin-left: -600px;
            margin-top: 330px;
        }
        .returnButton:hover{
            transform: translate(-10px);
            transition-property: all;
            transition-duration: 0.1s;
            transition-timing-function: linear;
        }
    </style>
    <script type="text/javascript">
    $(document).ready(function(){
		$('.returnButton').click(function(){
              
                window.top.$('div.fontBox').animate({left:0}, 800);
                window.top.$('span.reserveBtn').animate({left:0}, 800);
                window.top.$('span.cancel_reserveBtn').animate({left:0}, 800);
                window.top.$('iframe.reserveIFrame2').animate({left:'100%'}, 800);                             
            });
});
    </script>
	</HEAD>
	<BODY>
	<img src="image/%ED%99%94%EC%82%B4%ED%91%9C.png" class="returnButton">
		<fieldset class="field">
			<table width=750 class="searchTable">
				<tr align="center">
					<td><h2>���� ���� ���� ���</h2></td>
				</tr>
			</table>
		<fieldset class="bottomField">
			<div class="tableBox">
				<table class="table" align="center" border=1 cellspacing=0 cellpadding=4 >
				<tr align=center>
					<th width=80>�����</th>
					<th width=80>������</th>
					<th width=120>��߳�¥</th>
					<th width=120>��߽ð�</th>
					<th width=120>�ҿ�ð�</th>
					<th width=60>�ݾ�</th>
					<th width=60>�¼�</th>
					<th width=60>���</th>
				</tr>
				<?php
					$count = false;
					//���ǿ��� �޾ƿ� ������� ID���� �̿��Ͽ� ������ �ڷḦ ��ȸ
					while($Data=mysqli_fetch_array($Result)){
						
						sscanf($Data[takingInfo],"%3s&%3s-%2s-%2s&%2s:%2s-%2s",$starting,$ending,$startmonth,$startdate,$starthour,$startminute,$seatnum);
						//������ ���̽����� ���� ���� ������ ��ū���� ������ �۾�
						
						//���� ����
						$Query="select time, money from businfo where busStart='$starting' and busArrive='$ending'";
						
						$Result2=mysqli_query($Connect, $Query);
						if(!$Result2){
							QueryError($Connect);
							exit;
						}
						$Data2=mysqli_fetch_array($Result2);
						
						$startingnumber = $starting;
						if(!strcmp($starting,"001")) {
							$starting = "����";
						} elseif(!strcmp($starting,"002")) {
							$starting = "��õ";
						} elseif(!strcmp($starting,"003")) {
							$starting = "����";
						} elseif(!strcmp($starting,"004")) {
							$starting = "�λ�";
						} else {
							$starting = "���";
						} //����� �з� �۾�
						
						$endingnumber = $ending;
						if(!strcmp($ending,"001")) {
							$ending = "����";
						} elseif(!strcmp($ending,"002")) {
							$ending = "��õ";
						} elseif(!strcmp($ending,"003")) {
							$ending = "����";
						} elseif(!strcmp($ending,"004")) {
							$ending = "�λ�";
						} else {
							$ending = "���";
						} //������ �з� �۾�
						
						$startdates = $startdate;
						$startdate =  $startmonth ."�� " .$startdate ."��";
						$starttime =  $starthour .":" .$startminute ;
						
						echo ("
								<tr align=center>
						            <td width=80>$starting</td>
						            <td width=80>$ending</td>
						            <td width=120>$startdate</td>
						            <td width=120>$starttime</td>
									<td width=120>$Data2[time]</td>
									<td width=60>$Data2[money]</td>
						            <td width=60>$seatnum</td>
									<td width=60>
						                <input type=button value=\"���\" class=\"sub\" name=\"choice\" onclick=\"
											javascript:if(confirm('���� ������ ����ϰڽ��ϱ�?')){
												location.replace('UserDelSit.php?starting=$startingnumber&ending=$endingnumber&startmonth=$startmonth&startdate=$startdates&starthour=$starthour&startminute=$startminute&seatnum=$seatnum');
											}\">
						            </td>
						        </tr>
							"); // ����۾�
						$count = true;
						}
						if($count == false) {
							echo ("
								<tr align=center>
								<td colspan=8>������ �¼��� �����ϴ�.</td>
								</td>
								</tr>
							"); // ����۾�
						}?>
				</table>
			</div>
		</fieldset>
	</fieldset>
</BODY>
</HTML>