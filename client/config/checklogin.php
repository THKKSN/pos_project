<?php
function check_login()
{
if(strlen($_SESSION['_id'])==0)
	{
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="index.php";
		$_SESSION["_id"]="";
		header("Location: http://$host$uri/$extra");
	}
}
?>
