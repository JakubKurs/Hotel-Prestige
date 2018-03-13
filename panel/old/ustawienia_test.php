<?php
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		$_SESSION['bad_request'] = 'Musisz się zalogować!';
		header('Location: index.php?bad_request');
		exit();
	}else{
		include_once "config/config.php";
	}
?>
<!DOCTYPE HTML>
<html lang="pl-PL">
	<head>
		<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-2">
		<link href="/projekt/images/favicon.ico" rel="icon" type="image/x-icon" />
		<title>Panel | Hotel Prestige</title>
		<link rel="stylesheet" href="style/style.css" type="text/css" >
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php
 			$adres_ip_serwera_mysql_z_baza_danych = $host;
 			$nazwa_bazy_danych = $db_name;
 			$login_bazy_danych = $db_user;
 			$haslo_bazy_danych = $db_password;
			if ( !mysql_connect($adres_ip_serwera_mysql_z_baza_danych,
              			$login_bazy_danych,$haslo_bazy_danych) ) {
    				$lacznie_rezerwacji = "ERROR";
 	 			exit (0);
 			}
 			if ( !mysql_select_db($nazwa_bazy_danych) ) {
    				$lacznie_rezerwacji = "ERROR";
 	 			exit (0);
 			}
 			$zapytanie = ("SELECT COUNT(*) FROM rezerwacja");
			$wynik = mysql_query($zapytanie);
			$lacznie_rezerwacji = mysql_fetch_row($wynik);
 		?>
		<?php
 			$adres_ip_serwera_mysql_z_baza_danych = $host;
 			$nazwa_bazy_danych = $db_admin;
 			$login_bazy_danych = $db_user;
 			$haslo_bazy_danych = $db_password;
			if ( !mysql_connect($adres_ip_serwera_mysql_z_baza_danych,
              			$login_bazy_danych,$haslo_bazy_danych) ) {
    				$lacznie_rezerwacji = "ERROR";
 	 			exit (0);
 			}
 			if ( !mysql_select_db($nazwa_bazy_danych) ) {
    				$lacznie_rezerwacji = "ERROR";
 	 			exit (0);
 			}
 			$wiadomosc = ("SELECT wiadomosc FROM info ORDER BY id DESC");
			$wiadomosc1 = mysql_query($wiadomosc);
			$wiadomosc2 = mysql_fetch_row($wiadomosc1);
 			$typ = ("SELECT typ FROM info ORDER BY id DESC");
			$typ1 = mysql_query($typ);
			$typ2 = mysql_fetch_row($typ1);
 			$dodajacy = ("SELECT dodajacy FROM info ORDER BY id DESC");
			$dodajacy1 = mysql_query($dodajacy);
			$dodajacy2 = mysql_fetch_row($dodajacy1);
			if ($typ2[0] == "0") {
				$typs = "alert alert-success";
				$infoheader = " Sukces";
			}else if ($typ2[0] == "1") {
				$typs = "alert alert-info";
				$infoheader = " Informacja";
			}else if ($typ2[0] == "2") {
				$typs = "alert alert-warning";
				$infoheader = " Ostrzeżenie";
			}else if ($typ2[0] == "3") {
				$typs = "alert alert-danger";
				$infoheader = " Poważny błąd";
			}
 		?>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">HOTEL <span style="color:#f2f2f2;"> PRE</span>STIGE</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="zalogowany.php">Strona główna</a></li>
					<li class="dropdown"><li class="active"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Dodatkowe <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="ustawienia.php">Ustawienia Panelu</a></li>
						<li><a href="#">Page 1-2</a></li>
						<li><a href="#">Page 1-3</a></li>
					</ul>
					</li>
						<li><a href="#">Page 2</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo " ".$_SESSION['uzytkownik'] ?></a></li>
					<li><a href="wylogowywanie.php"><span class="glyphicon glyphicon-remove-sign"></span> Wyloguj</a></li>
				</ul>
			</div>
		</nav>
		<div class="container-fluid text-center">
			<div class="row content">
				<div class="col-sm-2 sidenav">
					<div class="panel panel-success">
						<div class="panel-heading"><center>Rezerwacje</center></div>
						<div class="panel-body">Łącznie rezerwacji<br><span class="badge"><?php echo $lacznie_rezerwacji[0];?></span></div>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading"><center>Menu</center></div>
						<div class="panel-body">Panel Content</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading"><center>Status usług</center></div>
						<div class="panel-body">Baza danych <span class="label label-success">Włączone</span></div>
					</div>
				</div>
				<div class="col-sm-8 text-left">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="#">Panel admina</a>
						</li>
						<li class="breadcrumb-item active">Dodatkowe</li>
						<li class="breadcrumb-item active">Ustawienia Panelu</li>
					</ol>
					<?php
						if(isset($wiadomosc2[0])){
							echo "<div class=\"".$typs." alert-dismissible fade in\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<strong><span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\"></span>".$infoheader."</strong><br>".$wiadomosc2[0]."
							</div>";
						}
					?>
					<div class="panel panel-primary">
						<div class="panel-heading">Dodaj komunikat</div>
						<div class="container-fluid">
						<div class="panel-body">
							<div class="jd">
							<form action="komunikat_wyslij.php" method="post">
								<div class="form-group">
									<label for="comment">Treść wiadomości:</label>
									<textarea class="form-control" rows="3" name="tresc" id="tresc"></textarea>
								</div>
								<div class="form-group">
									<label for="sel1">Typ:</label>
										<select class="form-control" style="max-width: 50%; margin: 0" id="typ" name="typ">
											<option value="1">Informacja</option>
											<option value="0">Sukces</option>
											<option value="2">Ostrzeżenie</option>
											<option value="3">Poważny błąd</option>
										</select>
										<button type="submit" style="right:60px; bottom:155px; position:absolute;" class="btn btn-default">Ustaw</button>
								</div>
							</form>
							</div>
						</div>
						</div>
					</div>
					<hr>
					<h3>Test</h3>
					<p>Lorem ipsum...</p>
				</div>
				<div class="col-sm-2 sidenav">
					<div class="well">
						<span class="glyphicon glyphicon-time"></span> Aktualna godzina
						<div id="czas">
							<script type="text/javascript">
								function getTime() {
									return (new Date()).toLocaleTimeString();
								}
								document.getElementById('czas').innerHTML = getTime();
								setInterval(function() {
									document.getElementById('czas').innerHTML = getTime();
								}, 1000);
							</script>
						</div>
					</div>
					<div class="well">
						<p>ADS</p>
					</div>
				</div>
			</div>
				<hr>
				<footer>
					Copyright 2018
				</footer>
		</div>
	</body>
</html>
