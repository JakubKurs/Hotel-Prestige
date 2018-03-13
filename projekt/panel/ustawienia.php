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
		<link rel="stylesheet" href="style/style.css" type="text/css" >
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
							<a href="#">Panel Hotel Prestige</a>
						</li>
						<li class="breadcrumb-item active">Dodatkowe</li>
						<li class="breadcrumb-item active">Ustawienia Panelu</li>
					</ol>
					<div class="panel panel-primary">
						<div class="panel-heading" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							Dodaj komunikat
						</div>
						<div class="container-fluid">
						<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
							<div class="jd">
							<form action="functions/komunikat_wyslij.php" method="post">
								<div class="form-group">
									<label for="comment">Treść wiadomości:</label>
									<textarea class="form-control" style="mid-width: 50%" rows="3" name="tresc" id="tresc"></textarea>
									<span size="1"class="help-block">Pamiętaj aby treść wiadomości zawierała najważniejsze informacje. Obsługuje znaczniki HTML.</span>
								</div>
								<div class="form-group">
									<label for="sel1">Typ:</label>
										<select class="form-control" style="max-width: 50%; margin: 0" id="typ" name="typ">
											<option value="1">Informacja</option>
											<option value="0">Sukces</option>
											<option value="2">Ostrzeżenie</option>
											<option value="3">Poważny błąd</option>
										</select>
									<span size="1"class="help-block">Każdy typ posiada inny kolor.</span>
								</div>
								<button type="submit" class="btn btn-default">Ustaw</button>
							</form>
							</div>
						</div>
						</div>
						</div>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
							Ustaw status strony głównej
						</div>
						<div class="container-fluid">
						<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
							<div class="jd">
							<form action="functions/zablokuj_strone.php" method="post">
								<div class="form-group">
									<label for="comment">Wybierz opcje:</label>
									<div class="radio">
										<label><input type="radio" value="wlacz" name="optradio">Włącz</label>
									</div>
									<div class="radio">
										<label><input type="radio" value="wylacz" name="optradio">Wyłącz</label>
									</div>
								</div>
								<div class="modal fade" id="myModal" role="dialog">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Potwierdzenie</h4>
											</div>
											<div class="modal-body">
												<p>Czy napewno chcesz zmienić status strony głównej?</p>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Wróć</button>
												<button type="submit" class="btn btn-success">Potwierdź</button>
											</div>
										</div>
									</div>
								</div>
								<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Zapisz</button>
							</form>
							</div>
						</div>
						</div>
						</div>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
							Konfiguracja panelu
						</div>
						<div class="container-fluid">
						<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
							<div class="jd">
							<label for="comment">Opcja w trakcie budowy!</label>
							</div>
						</div>
						</div>
						</div>
					</div>
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
