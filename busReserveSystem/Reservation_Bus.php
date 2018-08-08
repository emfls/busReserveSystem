<!DOCTYPE html>
<?php 
   //�����ͺ��̽� ����
   include './include/DBConnect.php';
   include './include/function.php';
   
   $SelectDB=mysqli_select_db($Connect, "bussystem");
   if(!SelectDB){
      QueryError($Connect);
      exit;
   }
   //���� ����
   $Query="select * from reserve";
   
   $Result=mysqli_query($Connect, $Query);
   if(!$Result){
      QueryError($Connect);
      exit;
   }
?>
<HTML>
<HEAD>
    <TITLE></TITLE>
    <link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.css">
	<script src="script/jquery-3.1.1.min.js"></script>
	<script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <meta charset="EUC-KR">
    <style type="text/css">
    @font-face{
            font-family:'Daum_SemiBold'; 
            src:url('fonts/Daum_SemiBold.ttf')}
        html, body{
            font-family:'Daum_SemiBold';
        }
        .sub{
                display:block; 
                width:50px; 
                height:30px; 
                border-radius:10px; 
                border: 2px solid #ffffff; 
                font-size:14px;
                color:#ffffff; 
                text-decoration: none; 
                line-height:25px;  
                text-align:center;
                background-color: rgba(0, 0, 0, 0);
            }
        .sub:hover{
            color: #06fff5;
            border: 2px solid #06fff5; 
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
            top: 60px;
            margin:0 auto;
            width:1000px;
        }
        body{
            position:static;
            top:0;
            left:0;
            padding:0;
            margin:0;
			width:100%;
			height:100%;
			background-color:transparent;
			background-size:cover;
			text-align:center;
            overflow: hidden;
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
        
        iframe.reservePopup{
            position: relative;
            top:20px;
            width:65%;
            height:68%;
            margin:0;
            padding:0;
            border:0;
            border:5px solid blue;
            overflow: hidden;
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
        .ui-widget {font-size: 12px;}
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
        
        table tr td a:hover{
            color: #06fff5;
        }
        
        .departure{
            height: 25px;
        }
        
        .arrival{
            height: 25px;
        }
        
        .select-style {
            border: 1px solid #ccc;
            width: 70px;
            border-radius: 3px;
            overflow: hidden;
        }

        .select-style select {
            padding: 5px 8px;
            width: 130%;
            border: none;
            box-shadow: none;
            background: transparent;
            background-image: none;
            -webkit-appearance: none;
        }

		.select-style select:focus {
            outline: none;
        }
    </style>
    
    <script type="text/javascript">
    $(document).ready(function(){
        //select ���ÿ� ���� �ٸ� select �׸��� �޶����� �Լ�
        $(function(){  
            $('input[type="time"][value="now"]').each(function(){    
                var d = new Date(),        
                h = d.getHours(),
                m = d.getMinutes();
                if(h < 10) h = '0' + h; 
                if(m < 10) m = '0' + m; 
                $(this).attr({
                    'value': h + ':' + m
                });
            });
        });
	    $(".departure").change(function(){
	        $("select[name='arrival'] option").remove();
	        var value=$(".departure option:selected").text();
	        var arr=["����","����","��õ","����","�λ�","���"];
	        for(var i=0; i<arr.length; i++){
	            if(value!=arr[i]){
	                $(".arrival").append("<option value='00"+i+"'>"+arr[i]+"</option>");
	            }
	        }
	    });
	    $('.returnButton').click(function(){
	        window.top.$('div.fontBox').animate({left:0}, 800);
	        window.top.$('span.reserveBtn').animate({left:0}, 800);
	        window.top.$('span.cancel_reserveBtn').animate({left:0}, 800);
	        window.top.$('iframe.reserveIFrame').animate({left:'100%'}, 800);                             
	    });
    });
    
    function check(form){
        var date = document.getElementsByName("date");
        var time = document.getElementsByName("time");
        var departure=$(".departure option:selected").text();
        var arrival=$(".arrival option:selected").text();

        var date_v=date[0].value;
        var time_v=time[0].value;

        if(date_v == "") {
            alert("��¥�� �Է��ϼ���!");
            return;
        } else if(time_v == "") {
            alert("�ð��� �Է��ϼ���!");
            return;
        } else if(departure == "����"){
            alert("������� �����ϼ���.");
            return;
        }else if(arrival=="����"){
            alert("�������� �����ϼ���.");
            return;
        }
            
        var nowDate=new Date();
            
        //��¥ '-'�� ���� ���ڿ��� ���ڷ� ��ȯ
        var dateArr=date_v.split('-');
        for(i=0; i<dateArr.length; i++){
            dateArr[i]=Number(dateArr[i]); 
        }
            
        //�ð� ':'�� ���� ���ڿ��� ���ڷ� ��ȯ
        var timeArr=time_v.split(":");
        for(i=0; i<timeArr.length; i++){
           timeArr[i]=Number(timeArr[i]); 
        }
            
        //���� ��¥�� �ð��� �˻�
        if(nowDate.getFullYear()>dateArr[0]){
            alert("���� ���� ���� �Ұ��մϴ�.");
            return;
        }else if(nowDate.getMonth()+1>dateArr[1]){
            alert("���� ���� ���� �Ұ��մϴ�.");
            return;
        }else if(nowDate.getDate()>dateArr[2]){
            alert("���� ���� ���� �Ұ��մϴ�.");
            return;
        }else if(nowDate.getDate()>=dateArr[2]&&nowDate.getHours()>timeArr[0]){
            alert("���� �ð��� ���� �Ұ��մϴ�.");
            return;
        }else if(nowDate.getDate()>=dateArr[2]&&nowDate.getSeconds()>timeArr[1]){
            alert("���� �ð��� ���� �Ұ��մϴ�.");
            return;
        }

        alert("Seat_Checking.php?year=" + dateArr[0] + "&month=" + dateArr[1] + "&date=" + dateArr[2] + "&hours=" + timeArr[0] + "&seconds=" + timeArr[1] + "&departure=" +  departure + "&arrival=" +   arrival);
        
        window.open("Seat_Checking.php?year=" + dateArr[0] + "&month=" + dateArr[1] + "&date=" + dateArr[2] + "&hours=" + timeArr[0] + "&minute=" + timeArr[1] + "&departure=" +  departure + "&arrival=" +   arrival , "�ڸ�Ȯ��", "width=1 height=1 left=500 top=-800 directories=no");
    }
    </script>
</HEAD>

<BODY>
     <div class="firstDiv">
        <img src="image/ȭ��ǥ.png" class="returnButton">   
        <fieldset class="field">
    <form name="busDate" id="busDate" action="" method="post">
        
        <table width=750 class="searchTable">
            <tr>
                <td>
                    <span>��¥ <input type="date" name="date" class="date"></span>
                </td>
                <td>
                    <span>�ð� <input type=time name="time" class="time"></span>
                </td>
                <td>
                    
                        <span>�����</span>
                        <select id="" class="departure" name="departure">
                                <option value="0" selected>����</option>
                                <option value="001" >����</option>
                                <option value="002" >��õ</option>
                                <option value="003" >����</option>
                                <option value="004" >�λ�</option>
                                <option value="005" >���</option>
                        </select>
                </td>
                 <td>       
                        <span>������</span>
                        <select id="" class="arrival" name="arrival">
                                <option value="0" selected>����</option>
                        </select>
                
                </td>
                <td>
                      <input type="button" value="��ȸ" class="sub" onclick="javascript:check(this.form)">
                </td>

            </tr>
        </table>
    </form>
            
            <fieldset class="bottomField">
                
        <div class="tableBox">
    <table class="table" align="center" border=1 cellspacing=0 cellpadding=4 id="appendtable">
        <tr align=center>
            <th width=10%>�����</th>
            <th width=10%>������</th>
            <th width=10%>��߽ð�</th>
            <th width=10%>�����ð�</th>
            <th width=10%>�ҿ�ð�</th>
            <th width=10%>�ݾ�</th>
            <th width=10%>�ܿ��¼�</th>
            <th width=10%>����</th>
        </tr>
        
        <?php /* 
               while($Data=mysqli_fetch_array($Result)){
                  echo ("
                        <tr align=center>
                              <td width=10%>$Data[�����]</td>
                              <td width=10%>$Data[������]</td>
                              <td width=10%>$Data[��߽ð�]</td>
                              <td width=10%>$Data[�����ð�]</td>
                              <td width=10%>$Data[�ҿ�ð�]</td>
                              <td width=10%>$Data[�ݾ�]</td>
                                    <td width=10%>$Data[�ܿ��¼�]</td>
                              <td width=10%>
                                  <input type=\"butto\" class=\"sub\" value=\"����\" onclick=\"javascript:location.replace('�¼�����.php?val=$Data[�����]&$Data[������]&$Data[��߽ð�]')\">
                              </td>
                          </tr>
                     ");
               }*/
	?>
    </table>
    	<!-- <iframe class="reservePopup" src="reserve.html">
                
        </iframe> -->
    </div>
        </fieldset>
</fieldset>
</div>  
</BODY>
</HTML>