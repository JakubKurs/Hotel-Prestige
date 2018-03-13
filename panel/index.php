<?php
	session_start();
	include_once "config/reasons.php";
	if (isset($_SESSION['zalogowany'])){
		header('Location: zalogowany.php');
	}
?>
<html lang="pl-PL">
	<head>
		<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-2">
		<title>Panel</title>
		<link rel="stylesheet" href="style/style.css" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div id="header">
	
		</div>
			<div id="panel_bad">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Brak dostępu
					</div>
					<div class="panel-body">
						Brak uprawnień do wyświetlenia! Powód:
						<?php 
							if(!isset($_SESSION['bad_request'])){
								echo $reason_99;
							}else{
								echo $_SESSION['bad_request'];
							}
						?>
						<script type="text/javascript">
							setTimeout("location.href='http://89.77.240.214/projekt/';",5000);
						</script>
					</div>
				</div>
			</div>
	</body>
</html>
