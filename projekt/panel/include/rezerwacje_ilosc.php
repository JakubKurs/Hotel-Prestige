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
 	$zapytanie = ("SELECT COUNT(*) FROM reservations");
	$wynik = mysql_query($zapytanie);
	$lacznie_rezerwacji = mysql_fetch_row($wynik);
?>