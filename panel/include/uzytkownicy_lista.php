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
	$wynik = mysql_query("SELECT * FROM users")
		or die("Kurwa nie dziala");
	if(mysql_num_rows($wynik) > 0){
		while($r = mysql_fetch_assoc($wynik)){
			if($r['uprawnienia'] == "Administrator"){
				echo "<td>Administrator</td>";
			}else{
				echo "<td>Uzytkownik</td>";
			}
			echo "<td>".$r['numer_konta']."</td>";
			echo "<td>".$r['imie_i_nazwisko']."</td>";
			echo "<td>".$r['data_urodzenia']."</td>";
			echo "<td>".$r['nr_telefonu']."</td>";
			echo "<td>".$r['adres_zamieszkania']."</td>";
			echo "<td>".$r['email']."</td>";
			if($r['numer_konta'] == $_SESSION['numer_konta']){
				echo "<td><a href=\"uzytkownicy.php?imieinazwisko={$r['imie_i_nazwisko']}&amp;dataurodzenia={$r['data_urodzenia']}&amp;user={$r['login']}&amp;telefon={$r['nr_telefonu']}&amp;upr={$r['uprawnienia']}&amp;a=edit&amp;id={$r['id']}\">Edytuj</a> </td>";
				echo "<tr>";
			}else{
				echo "<td><a href=\"uzytkownicy.php?imieinazwisko={$r['imie_i_nazwisko']}&amp;user={$r['login']}&amp;a=del&amp;id={$r['id']}\">Usun</a> <a href=\"uzytkownicy.php?imieinazwisko={$r['imie_i_nazwisko']}&amp;dataurodzenia={$r['data_urodzenia']}&amp;user={$r['login']}&amp;telefon={$r['nr_telefonu']}&amp;upr={$r['uprawnienia']}&amp;a=edit&amp;id={$r['id']}\">Edytuj</a> </td>";
				echo "<tr>";
			}
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