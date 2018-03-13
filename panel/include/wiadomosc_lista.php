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
	$wynik = mysql_query("SELECT * FROM info")
		or die("Kurwa nie dziala");
	if(mysql_num_rows($wynik) > 0){
		while($r = mysql_fetch_assoc($wynik)){
			if($r['typ'] == "0"){
				$wiadomosc_class = "success";
				$wiadomosc_typ = "Sukces";
			}else if($r['typ'] == "1"){
				$wiadomosc_class = "info";
				$wiadomosc_typ = "Informacja";
			}else if($r['typ'] == "2"){
				$wiadomosc_class = "warning";
				$wiadomosc_typ = "Ostrzeżenie";
			}else if($r['typ'] == "3"){
				$wiadomosc_class = "danger";
				$wiadomosc_typ = "Poważny błąd";
			}
			echo "<tr class=\"".$wiadomosc_class."\">";
			echo "<td>".$r['data']." ".$r['godzina']."</td>";
			echo "<td>".$r['wiadomosc']."</td>";
			echo "<td>".$wiadomosc_typ."</td>";
			echo "<td>".$r['dodajacy']."</td>";
			echo "<td><a href=\"komunikaty.php?a=del&amp;id={$r['id']}\">Usun</a> <a href=\"komunikaty.php?a=edit&amp;id={$r['id']}\">Edytuj</a> </td>";
			echo "<tr>";
		}
	}else{
		echo "<tr class=\"info\">";
		echo "<td>Brak wynikow</td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<tr>";
	}
?>