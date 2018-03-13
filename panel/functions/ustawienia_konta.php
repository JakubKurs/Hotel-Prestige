<?php
	session_start();
	include "../config/config.php";
	$i_i_n = $_POST['imie_i_nazwisko'];
	$d_u = $_POST['data_urodzenia'];
	$az = $_POST['adres_zamieszkania'];
	$nt = $_POST['nr_telefonu'];
	$em = $_POST['email'];
	$nk = $_SESSION['numer_konta'];
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
		echo "error1";
		exit (0);
	}
	mysql_query("UPDATE users SET data_urodzenia='$d_u', adres_zamieszkania='$az', nr_telefonu='$nt', email='$em' WHERE numer_konta='$nk'") 
		or die('Błąd zapytania'); 
	header('Location: ../ustawienia_konta.php?check=success');
?>