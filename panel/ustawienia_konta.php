<?php
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		include_once "config/reasons.php";
		$_SESSION['bad_request'] = $reason_6;
		header('Location: index.php?bad_request');
		exit();
	}else{
		include_once "config/config.php";
		include_once "include/wiadomosc.php";
		include_once "include/rezerwacje_ilosc.php";
		$check_edit = trim($_GET['check']); 
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
						<li class="breadcrumb-item active">Ustawienia konta</li>
					</ol>
					<div class="container">
						<div class="row">
							<div class="col-md-9 personal-info">
								<?php
									if($check_edit == "success"){
										echo "<div class=\"alert alert-success\">";
											echo "Ustawienia zostały zapisane.";
										echo "</div>";
									}
								?>
								<h3>Ustawienia konta</h3>
								<?php
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
									$wynik = mysql_query("SELECT * FROM users WHERE numer_konta=$numer_konta")
										or die("Kurwa nie dziala");
									if(mysql_num_rows($wynik) > 0){
										while($r = mysql_fetch_assoc($wynik)){
											$imie_i_nazwisko = $r['imie_i_nazwisko'];
											$data_urodzenia = $r['data_urodzenia'];
											$adres_zamieszkania = $r['adres_zamieszkania'];
											$nr_telefonu = $r['nr_telefonu'];
											$email = $r['email'];
										}
										echo "
											<form action=\"functions/ustawienia_konta.php\" method=\"post\" class=\"form-horizontal\" role=\"form\">	
												<div class=\"form-group\">
													<label class=\"col-lg-3 control-label\">Imie i nazwisko:</label>
													<a href=\"#\" data-toggle=\"tooltip\" title=\"Imie i nazwisko moze zmienić tylko administrator\" style=\"color:red\"><span class=\"glyphicon glyphicon-question-sign\"></span></a>
													<div class=\"col-lg-8\">
														<input class=\"form-control\" type=\"text\" value=\"".$imie_i_nazwisko."\"placeholder=\"Imię\" name=\"imie_i_nazwisko\" id=\"imie_i_nazwisko\" disabled>
													</div>
												</div>
												<div class=\"form-group\">
													<label class=\"col-lg-3 control-label\">Data urodzenia:</label>
													<a href=\"#\" data-toggle=\"tooltip\" title=\"Date urodzenia zapisz w formacie rrrr-mm-dd\"><span class=\"glyphicon glyphicon-question-sign\"></span></a>
													<div class=\"col-lg-8\">
														<input class=\"form-control\" type=\"text\" value=\"".$data_urodzenia."\"placeholder=\"Data urodzenia\" name=\"data_urodzenia\" id=\"data_urodzenia\">
													</div>
												</div>
												<div class=\"form-group\">
													<label class=\"col-lg-3 control-label\">Adres zamieszkania:</label>
													<a href=\"#\" data-toggle=\"tooltip\" title=\"Adres zamieszkania podaj w formacie Miasto, ulica\"><span class=\"glyphicon glyphicon-question-sign\"></span></a>
													<div class=\"col-lg-8\">
														<input class=\"form-control\" type=\"text\" value=\"".$adres_zamieszkania."\" placeholder=\"Gdańsk\" name=\"adres_zamieszkania\" id=\"adres_zamieszkania\">
													</div>
												</div>
												<div class=\"form-group\">
													<label class=\"col-lg-3 control-label\">Numer telefonu:</label>
													<a href=\"#\" data-toggle=\"tooltip\" title=\"Podaj swój numer telefonu\"><span class=\"glyphicon glyphicon-question-sign\"></span></a>
													<div class=\"col-lg-8\">
														<input class=\"form-control\" type=\"text\" value=\"".$nr_telefonu."\" placeholder=\"Numer telefonu\" name=\"nr_telefonu\" id=\"nr_telefonu\">
													</div>
												</div>
												<div class=\"form-group\">
													<label class=\"col-lg-3 control-label\">Adres E-mail:</label>
													<a href=\"#\" data-toggle=\"tooltip\" title=\"Adres email służy do kontaktu z tobą\"><span class=\"glyphicon glyphicon-question-sign\"></span></a>
													<div class=\"col-lg-8\">
														<input class=\"form-control\" type=\"text\" value=\"".$email."\" placeholder=\"Adres E-mail\" name=\"email\" id=\"email\">
													</div>
												</div>
												<div class=\"form-group\">
													<label class=\"col-md-3 control-label\"></label>
													<div class=\"col-md-8\">
														<input type=\"submit\" class=\"btn btn-default\" value=\"Zapisz\">
														<a href=\"include/refresh_acc.php\" type=\"button\" class=\"btn btn-default\">Odśwież konto</a>
														<span></span>
													</div>
												</div>
											</form>
										";
									}
								?>
								<script>
									$(document).ready(function(){
										$('[data-toggle="tooltip"]').tooltip();   
									});
								</script>
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
