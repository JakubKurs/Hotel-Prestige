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
 	$data = ("SELECT data FROM info ORDER BY id DESC");
	$data1 = mysql_query($data);
	$data2 = mysql_fetch_row($data1);
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