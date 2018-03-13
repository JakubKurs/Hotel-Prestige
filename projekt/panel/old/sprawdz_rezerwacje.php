<?php
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
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
	</head>
	<body>
		<img src="style/logo_projekt.png" width="150" height="125" >
			<center>
			<script type="text/javascript">
				setTimeout(function(){
					var e = document.getElementById('paneluwaga');
   					e.parentNode.removeChild(e);
   				}, 3000);
			</script>
		<br>
		<div id="panel4">
			<font color="#0099ff"> 
				<p>
					<! Skrypt PHP (nickname) -->
					<?php
						echo "Witaj </font><font color=\"green\">".$_SESSION['uzytkownik'];
					?>
				</p>
			</font>
			<a href="wylogowywanie.php">Wyloguj się</a>
			</font>
			<div id="czas">
				<script type="text/javascript">
					function getTime() 
					{
  						return (new Date()).toLocaleTimeString();
					}
					document.getElementById('czas').innerHTML = getTime();
					setInterval(function() {
   					document.getElementById('czas').innerHTML = getTime();
					}, 1000);
				</script>
			</div>
		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<div id="panel5">
			Menu 
			<hr>
			<a href="zalogowany.php"><font color="#b46a1c">Strona Główna</font></a>
			<br>
			<a href="sprawdz_pokoj.php"><font color="#b46a1c">Sprawdź Pokój</font></a>
			<br>
			<a href="sprawdz_rezerwacje.php"><font color="green">Sprawdź Rezerwacje</font></a>
			<br>
			<a href="sprawdz_klienta.php"><font color="#b46a1c">Sprawdź Klienta</font></a>
			<br>
			<a href="status_uslug.php"><font color="#b46a1c">Status Usług</font></a>
			<br>
			&emsp;
		</div>
		<! Panel 1 -->
		<div id="panel">
			<br>
			#101
			&emsp;
		</div>
		<br>
		<! Panel 2 -->
		<div id="panel_pros">
			<br>
			#010
			&emsp;
		</div>
		<br>
			<?php
				$conn = new mysqli('localhost','rodot','rambov1337');
				// Check connection
				if ($conn->connect_error) {
   					die("
						<div id=\"down\">
							<p align=\"right\">
								<font color=\"red\">Panel Administracyjny Hotel Prestige ©&emsp;</font>
							</p>
						</div>
					");
				}
  				echo "<font color=\"green\">Polaczono!</font>";
				continue;
			?>
	</body>
</html>