<?php
	$id = $_SESSION['id'];
	$adres_ip_serwera_mysql_z_baza_danych = $host;
	$nazwa_bazy_danych = $db_name;
	$login_bazy_danych = $db_user;
	$haslo_bazy_danych = $db_password;
	if ( !mysql_connect($adres_ip_serwera_mysql_z_baza_danych,
		$login_bazy_danych,$haslo_bazy_danych) ) {
		$lacznie_rezerwacji = "ERROR";
		echo "error1";
		exit (0);
	}
	if ( !mysql_select_db($nazwa_bazy_danych) ) {
		$lacznie_rezerwacji = "ERROR";
		echo "error2";
		exit (0);
	}
	$zapytanie = mysql_query("SELECT * FROM users WHERE id='$id'") 
		or die('Błąd zapytania'); 
	if(mysql_num_rows($wynik) > 0){
		while($r = mysql_fetch_assoc($zapytanie)){
			$uprawnienia = $r['uprawnienia'];
		}
	}
	echo "
		<nav class=\"navbar navbar-inverse\">
			<div class=\"container-fluid\">
				<div class=\"navbar-header\">
					<a class=\"navbar-brand\" href=\"index.php\">HOTEL <span style=\"color:#f2f2f2;\"> PRE</span>STIGE</a>
				</div>
				<ul class=\"nav navbar-nav\">
					<li><a href=\"zalogowany.php\">Strona główna</a></li>";
					if($uprawnienia == "Administrator"){
						echo "
						<li class=\"dropdown\"><a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">Administracyjne <span class=\"caret\"></span></a>
							<ul class=\"dropdown-menu\">
								<li><a href=\"ustawienia.php\">Ustawienia Panelu</a></li>
								<li><a href=\"komunikaty.php\">Wszystkie komunikaty</a></li>
								<li><a href=\"uzytkownicy.php\">Użytkownicy</a></li>
							</ul>
						</li>
						<li><a href=\"rezerwacje.php\">Rezerwacje</a></li>
						";
					}
				echo "
				</ul>
				<ul class=\"nav navbar-nav navbar-right\">
					<li class=\"dropdown\"><a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\"><span class=\"glyphicon glyphicon-user\"></span> ".$_SESSION['uzytkownik']."</a>
					<ul class=\"dropdown-menu\">
						<li><a href=\"ustawienia_konta.php\"><span class=\"glyphicon glyphicon-cog\"></span> Ustawienia konta</a></li>
					</ul>
					</li>
					<li><a href=\"wylogowywanie.php\"><span class=\"glyphicon glyphicon-remove-sign\"></span> Wyloguj</a></li>
				</ul>
			</div>
		</nav>  
	";
?>