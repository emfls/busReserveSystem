<?php
	function QueryError($Connect) {
		$ErrNo = @mysqli_connect_errno();
		$ErrStr = @mysqli_connect_error();
		$ErrNoStr = "DB¿¡·¯ : " .$ErrNo ."-" .$ErrStr;
		
		echo("<Script language=\"javascript\">
				alert(\"$ErrNoStr\");
				window.close();
				</Script>");
	}
?>