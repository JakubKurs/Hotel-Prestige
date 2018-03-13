<?php
	session_start();
	if (!isset($_SESSION['zalogowany'])){
		include_once "config/reasons.php";
		$_SESSION['bad_request'] = $reason_6;
		header('Location: index.php?bad_request');
		exit();
	}else{
		include_once "config/config.php";
		include_once "include/wiadomosc.php";
		include_once "include/rezerwacje_ilosc.php";
		$adres_ip_serwera_mysql_z_baza_danych = $host;
		$nazwa_bazy_danych = $db_name;
		$login_bazy_danych = $db_user;
		$haslo_bazy_danych = $db_password;
		$numer_konta = $_SESSION['numer_konta'];
		if ( !mysql_connect($adres_ip_serwera_mysql_z_baza_danych,
			$login_bazy_danych,$haslo_bazy_danych) ) {
				$lacznie_rezerwacji = "ERROR";
				exit (0);
			}
		if ( !mysql_select_db($nazwa_bazy_danych) ) {
			$lacznie_rezerwacji = "ERROR";
			exit (0);
		}
		$wynik = mysql_query("SELECT uprawnienia FROM users WHERE numer_konta=$numer_konta")
			or die("Kurwa nie dziala");
		if(mysql_num_rows($wynik) > 0){
			while($r = mysql_fetch_assoc($wynik)){
				$uprawnienia = $r['uprawnienia'];
			}
		}
	}
	if($uprawnienia !== "Administrator"){
		$_SESSION['uprawnienia'] = "Uzytkownik";
		header('Location: index.php');
	}
?>
<!DOCTYPE HTML>
<html lang="pl-PL">
	<head>
		<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-2">
		<link href="/projekt/images/favicon.ico" rel="icon" type="image/x-icon" />
		<title>Panel | Hotel Prestige</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body oncontextmenu="return false;">
		<script>
			document.onkeydown = function(e) {
				if(event.keyCode == 123) {
					return false;
				}
				if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
					return false;
				}
				if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
					return false;
				}
				if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
					return false;
				}
			}
		</script>
		<?php
			include "include/wiadomosc_edit_del.php";
		?>
		<?php
			include "style/navbar.php";
		?>
		<div class="container-fluid text-center">    
			<div class="row content">
				<?php
					include "style/left_bar.php";
				?>
				<div class="col-sm-8 text-left"> 
					<?php
						include "include/wiadomosc_info.php";
					?>
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="zalogowany.php">Panel Hotel Prestige</a>
						</li>
						<li class="breadcrumb-item active">Dodatkowe</li>
						<li class="breadcrumb-item active">Wszystkie komunikaty</li>
					</ol>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
						<input class="form-control" id="myInput" type="text" placeholder="Szukaj...">
					</div>
					<br>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Data i Godzina</th>
								<th>Wiadomosc</th>
								<th>Typ</th>
								<th>Dodajacy</th>
								<th>Edytuj</th>
							</tr>
						</thead>
						<tbody id="Lista">
						<?php
							include "include/wiadomosc_lista.php";
						?>
						</tbody>
					</table>
					<script>
						$(document).ready(function(){
							$("#myInput").on("keyup", function() {
								var value = $(this).val().toLowerCase();
								$("#Lista tr").filter(function() {
									$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
								});
							});
						});
					</script>
				</div>
				<?php
					include "style/right_bar.php";
				?>
			</div>
				<hr>
				<footer>
					Copyright 2018 
				</footer>
		</div>
	</body>
</html>
