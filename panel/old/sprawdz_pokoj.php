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

		<div id="panel5">
			Menu 
			<hr>
			<a href="zalogowany.php"><font color="#b46a1c">Strona Główna</font></a>
			<br>
			<a href="sprawdz_pokoj.php"><font color="green">Sprawdź Pokój</font></a>
			<br>
			<a href="sprawdz_rezerwacje.php"><font color="#b46a1c">Sprawdź Rezerwacje</font></a>
			<br>
			<a href="sprawdz_klienta.php"><font color="#b46a1c">Sprawdź Klienta</font></a>
			<br>
			<a href="status_uslug.php"><font color="#b46a1c">Status Usług</font></a>
			<br>
			&emsp;
		</div>
		<! Panel 1 -->
		<div id="panel424">
			<form action="sprawdz_pokoj_Z.php?zajete" method="post">
				<input type="submit" value="Zajete" />
			</form>
			<form action="sprawdz_pokoj_W.php?wolne" method="post">
				<input type="submit" value="Wolne" />
			</form>
			<?php 
 				$adres_ip_serwera_mysql_z_baza_danych = 'localhost';
 				$nazwa_bazy_danych = 'projekt';
 				$login_bazy_danych = 'root';
 				$haslo_bazy_danych = 'rambov1337';
				if ( !mysql_connect($adres_ip_serwera_mysql_z_baza_danych,
              				$login_bazy_danych,$haslo_bazy_danych) ) {
    					echo 'Nie moge polaczyc sie z baza danych';
 	 				exit (0);
 				}
 				if ( !mysql_select_db($nazwa_bazy_danych) ) {
    					echo 'Blad otwarcia bazy danych';
 	 				exit (0);
 				}
 				$zapytanie = "SELECT * FROM pokoje ORDER BY nr_pokoju ASC";
 				$wynik = mysql_query($zapytanie);
				echo "<table style=\"width:100%\">";
				echo "<td><font color=\"#005ce6\">Nr. Pokoju</td>";
				echo "<td><font color=\"#005ce6\">Max. Osoby</td>";
				echo "<td><font color=\"#005ce6\">Rodzaj Pokoju</td>";
				echo "<td><font color=\"#005ce6\">Status</td>";
				echo "</tr>";
 				while ( $row = mysql_fetch_row($wynik) ) {
 					echo "</tr>";
 					echo "<td >" . $row[0] . "</td>";
 					echo "<td >" . $row[1] . "</td>";
 					echo "<td >" . $row[2] . "</td>";
 					echo "<td >" . $row[3] . "</td>";
 					echo "</tr>";
				 }
 				echo "</table>";
 				if ( !mysql_close() ) {
    					echo 'Nie moge zakonczyc polaczenia z baza danych';
    					exit (0);
 				}
 			?>
		</div>
		<br>
		<! Panel 2 -->
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