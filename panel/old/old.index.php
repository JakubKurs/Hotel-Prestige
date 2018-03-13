<?php
	session_start();
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: zalogowany.php');
		exit();
	}
?>
<!DOCTYPE HTML>
<html lang="pl-PL">
	<head>
		<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-2">
		<link href="/projekt/images/favicon.ico" rel="icon" type="image/x-icon" />
		<title>Panel | Hotel Prestige</title>
		<link rel="stylesheet" href="style/panel.css" type="text/css" />
		<script>
			function ukryj() 
			{
 			document.getElementById("panel_pros").style.display="none";
			}
		</script>
	</head>
	<body>
		<div id="header">
			<center>
			<img src="style/logo_projekt.png" width="200" height="150" >
			</center>
			<br>
		</div>
		<center>
		<?php
				if(isset($_SESSION['blad']))	echo "<div id=\"panel_pros\">".$_SESSION['blad']."<br>&nbsp;</div>";
		?>
			&nbsp;
		</center>
		<script>
			setTimeout("ukryj()",5000);
		</script>
		<center>
			<div id="logowanie_panel">
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<div id="panel">
					<form action="logowanie.php" method="post">
						Login: <br /> <input type="text" name="login" /> <br />
						Hasło: <br /> <input type="password" name="haslo" /> <br /><br />
						<input type="submit" value="Zaloguj się" />
					</form>
					<br>
				</div>
			<br>
			</div>
		</center>
	</body>
</html>