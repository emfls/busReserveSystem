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
$Query="select * from user where EMail = '$_SESSION[email]'";

$Result=mysqli_query($Connect, $Query);
if(!$Result){
	QueryError($Connect);
	exit;
}
while ( $Data = mysqli_fetch_array ( $Result ) ) {
	$user_email=$Data[0];
	$user_Password=$Data[1];
	$user_birthday=$Data[2];
	$user_name=$Data[3];
	$user_phoneNumber=$Data[4];
}
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<TITLE>ȸ������ ����</TITLE>
		<meta charset="EUC-KR">
		<link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.css">
		<script src="script/jquery-3.1.1.min.js"></script>
		<script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>
		<!-- JQuery API ���� -->
		<script>
			$(function() {
				$("#birthday").datepicker();
			});
		</script>
		<style type="text/css">
		 .SelectBox { 
	        width:80px; 
	        height: 35px;
	        color: gray;
	        font-size:25px;
	        border-color:#cdc3b7
	    }
        .sub{
                width:70px; 
                height:45px; 
                border-radius:10px; 
                border: 2px solid #ffffff; 
                font-size:25px;
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
        .check{
                width:120px; 
                height:45px; 
                border-radius:10px; 
                border: 2px solid #ffffff; 
                font-size:25px;
                font-weight:500;
                color:#ffffff; 
                text-decoration: none; 
                line-height:25px;  
                text-align:center;
                background-color: rgba(0, 0, 0, 0);
                font-weight: 900;
                
            }
        .check:hover{
            color: red;
            border: 2px solid red;
            transition-property: all;
            transition-duration: 1s;
            transition-timing-function: linear;
        }
        
	   	.radio{
	      color:white;
	      font-size:25px;
	      position:relative;
	    }
	    .radio span{
	      position:relative;
	      padding-left:20px;
	    }
	    .radio span:after{
	      content:'';
	      width:20px;
	      height:20px;
	      border:3px solid;
	      position:absolute;
	      left:0;
	      top:10px;
	      border-radius:100%;
	      -ms-border-radius:100%;
	      -moz-border-radius:100%;
	      -webkit-border-radius:100%;
	      box-sizing:border-box;
	      -ms-box-sizing:border-box;
	      -moz-box-sizing:border-box;
	      -webkit-box-sizing:border-box;
	    }
	    .radio input[type="radio"]{
	      cursor: pointer; 
	      position:absolute;
	      width:100%;
	      height:100%;
	      z-index: 1;
	      opacity: 0;
	      filter: alpha(opacity=0);
	      -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"
	    }
	    .radio input[type="radio"]:checked + span{
	      color:red;  
	    }
	    .radio input[type="radio"]:checked + span:before{
	      content:'';
	      width:10px;
	      height:10px;
	      position:absolute;
	      background:red;
	      left:5px;
	      top:15px;
	      border-radius:100%;
	      -ms-border-radius:100%;
	    }
        
        form{
            position: relative;
            margin-left: 5%;
            margin-top: 1%;
        }
        fieldset{
            display: block;
            border-radius:20px;
            border: 1px solid gray;
            background-color: rgba(0, 0, 0, 0.32);
        }
        .field{
            position: relative;
            top: 70px;
            margin:0 auto;
            width:800px;
        }
        body{
         position:static;
         width:100%;
         height:100%;
         min-width:1024px;
         min-height:768px;
         background-image: url(image/slider_image_1.jpg);
         background-size:cover;
         text-align:center;
         overflow : hidden;
        }
        
        .bottomField{
            margin:0 auto;
            position: relative;
            width: 700px;
            height: 400px;
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
        	margin-left:10px;
            color: white;
        }
        
        .tableBox{
            margin: 0 auto;
            margin-top: 5px;
            overflow-y: auto;
            overflow-x: hidden;
            width: 650px;
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
        .TextBox{ height:30px; font-size:18px; border-color:#cdc3b7}
		h2 { font-size:50px; margin:10px; color:white; }
    </style>
	<Script>
		var Name = document.getElementsByName("name");
		var BirthDay = document.getElementsByName("birthday");
		var password = document.getElementsByName("password");
		var passwordrepeat = document.getElementsByName("passwordrepeat");
		var phonenumber = document.getElementsByName("phonenumber");
		var resultvalue = false;
		// ������Ʈ �ڹ� ������ �����ϴ� ����
		
		function PreviousGo() {
			location.href = "LoginMain.php";
		} // ���� ��ư ���� �� �α��� ȭ������ �Ѿ��.
		
		function levelSet() { // ��й�ȣ ���ȷ����� Ȯ���ϴ� �Լ�
			var PasswordLevel = document.getElementById("Levelpassword");
			if(password[0].value.length <= 6) {
				PasswordLevel.innerText = "���ȳ���";
				PasswordLevel.style.color = "Red"
			} else if(password[0].value.length <= 12) {
				PasswordLevel.innerText = "���Ⱥ���";
				PasswordLevel.style.color = "yellow"
			} else {
				PasswordLevel.innerText = "���ȳ���";
				PasswordLevel.style.color = "Green"
			}
		}
		
		function RepeatCheck() { // ��й�ȣ�� ��ġ�ϴ��� ���ϴ��� Ȯ���ϴ� �Լ�
			var PasswordRepeat = document.getElementById("passwordRepeatCheck");
			if(passwordrepeat[0].value == "" || 
					password[0].value != passwordrepeat[0].value) {
				PasswordRepeat.innerText = "��й�ȣ ����ġ";
				PasswordRepeat.style.color = "Red"
			} else {
				PasswordRepeat.innerText = "��й�ȣ ��ġ";
				PasswordRepeat.style.color = "yellow"
			}
		}
		
		function requesting() {
			location.href='LoginMain.php';
		} // ���� �α��� ȭ������ �̵��ϴ� �Լ�
		
		function CheckElement(form) {
			if(Name[0].value == "") {
				alert("�̸��� �Է��ϼ���!");
				return;
			} else if(BirthDay[0].value == "") {
				alert("��������� �Է��ϼ���!");
				return;
			} else if(password[0].value == "") {
				alert("��й�ȣ�� �Է��ϼ���!");
				return;
			} else if(passwordrepeat[0].value == "" ||
					password[0].value != passwordrepeat[0].value) {
				alert("��й�ȣ�� ���Է��� ��й�ȣ�� ��ġ���� �ʽ��ϴ�!");
				return;
			} else if(phonenumber[0].value == "") {
				alert("�޴��� ��ȣ�� �Է��ϼ���!");
				return;
			} // �ʼ� ������Ʈ�� �ԷµǾ����� Ȯ���Ͽ� �˷��ִ� ���
			form.submit();
		}

		function CheckOutMembership() {
			if(confirm('ȸ�� Ż�� �Ͻðڽ��ϱ�?')){
				location.replace('MembershipOut.php');
			}
		}
	</Script>
	</HEAD>
	<BODY>
		<fieldset class="field">
			<table width=750 class="searchTable">
				<tr align="center">
					<td><h2>ȸ�� ��������</h2></td>
				</tr>
			</table>
		<fieldset class="bottomField">
			<div class="tableBox">
				<form id="Mebershipform" action="Edit_Mebership.php" method="post">
					<table class="table" align="center" cellspacing=0 cellpadding=4 border="0">
						<tr valign="top">
							<!--  �̸� �Է� â -->
								<td align = "center" width="160"> <b class="TextBox"> �̸� : </b> </td>
								<td align = "left">
									<input type="text" value=<?php echo $user_name?> name="name" autocomplete="on" class="TextBox" size="15px" maxlength="20" placeholder="�̸��Է�">
								</td>
						</tr>
						<tr valign="top">
						<!--  ������� �Է� â -->
							<td align = "center" width="160"> <b class="TextBox"> BirthDay : </b> </td>
							<td align = "left">
								<input type="text" id="birthday" value=<?php echo $user_birthday?> autocomplete="on" name="birthday" class="TextBox" placeholder="���� �Է�">
							</td>
						</tr>
						<tr valign="top">
						<!-- E-Mail �Է� â  -->
							<td align = "center" width="160"> <b class="TextBox"> E-MAIL : </b> </td>
							<td align = "left">
								<input type="text" name="email" value=<?php echo $user_email?> autocomplete="on" maxlength="20" class="TextBox" placeholder="E-MAIL �Է�" readonly>
							</td>
						</tr>
						<tr valign="top">
						<!--  ��й�ȣ �Է� â -->
							<td align = "center" width="160"> <b class="TextBox"> Password : </b> </td>
							<td align = "left">
								<input type = "password" value=<?php echo $user_Password?> name="password"  class="TextBox" maxlength="20" placeholder="��й�ȣ �Է�" onkeyup="levelSet()">
								<b> <a id="Levelpassword" class="TextBox"> </a> </b>
							</td>
						</tr>
						<tr valign="top">
						<!-- ��й�ȣ ���Է� â -->
							<td align = "center" width="160"> <b class="TextBox"> PasswordRepeat : </b></td>
							<td align = "left">
								<input type = "password" name="passwordrepeat" class="TextBox" maxlength="20" placeholder="��й�ȣ ���Է�" onkeyup="RepeatCheck()">
								<b> <a id="passwordRepeatCheck" class="TextBox"> ��й�ȣ ����ġ </a> </b>
							</td>
						<tr valign="top">
						<!--  ��ȭ��ȣ �Է� â -->
							<td align = "center" width="160"> <b class="TextBox"> PhoneNumber : </b> </td>
							<td align = "left">
								<select  name="callname"  id="callname" class="SelectBox">
									<option value="SKT">SKT</option>
									<option value="KT">KT</option>
									<option value="LGT">LGT</option>
								</select>
								<input type = "number" value=<?php echo $user_phoneNumber?> name="phonenumber" autocomplete="on" class="TextBox" maxlength="11" placeholder="- ���� ���ڸ� �Է�">
							</td>
						</tr>
					</table>
					<p/>
					<input type="button" value="����" id="PreviousButton" class="sub" onClick="javascript:PreviousGo()">&nbsp; &nbsp;
					<input type="button" value="����" id="CheckButton" class="sub" onClick="javascript:CheckElement(this.form)">&nbsp; &nbsp;
					<input type="reset" value="���" id="NoButton" class="sub">
					<p/>
					<input type="button" value="ȸ��Ż��" id="CheckButton" class="check" onClick="javascript:CheckOutMembership()">
				</form>
			</div>
		</fieldset>
	</fieldset>
</BODY>
</HTML>