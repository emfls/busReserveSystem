<?php
	$Connect = mysqli_connect("localhost","busadmin",'buspass');
	if(!$Connect) {
		$ErrNo = @mysqli_connect_errno();
		$ErrStr = @mysqli_connect_error();
		$ErrNoStr = "DB���ῡ�� : " .$ErrNo ."-" .$ErrStr;
	
		echo("<Script language=\"javascript\">
				alert(\"$ErrNoStr\");
				window.close();
				</Script>");
	}
?>