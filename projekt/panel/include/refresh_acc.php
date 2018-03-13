<?php
	session_start();
	include_once "../config/config.php";
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
	if(mysql_num_rows($zapytanie) > 0){
		while($r = mysql_fetch_assoc($zapytanie)){
			$_SESSION['id'] = $r['id'];
			$_SESSION['uzytkownik'] = $r['login'];
			$_SESSION['nr_telefonu'] = $r['nr_telefonu'];
			$_SESSION['adres'] = $r['adres_zamieszkania'];
			$_SESSION['numer_konta'] = $r['numer_konta'];
			$_SESSION['uprawnienia'] = $r['uprawnienia'];
			$_SESSION['numer_konta'] = $r['numer_konta'];
			header('Location: ../zalogowany.php?refresh_acc');
		}
	}
?>