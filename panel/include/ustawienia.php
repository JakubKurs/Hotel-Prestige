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
	$wynik = mysql_query("SELECT * FROM config")
		or die("Kurwa nie dziala");
	if(mysql_num_rows($wynik) > 0){
		while($r = mysql_fetch_assoc($wynik)){
			echo "<div class=\"panel panel-default\">";
			echo "<div class=\"panel-body\">";
			echo "<div class=\"form-group\">";
			echo "<label for=\"comment\">".$r['opis']."</label>";
			echo "</div>";
			echo "<div class=\"form-group\">";
			if($r['status'] == "on"){
				echo "<label class=\"checkbox-inline\"><input type=\"checkbox\" value=\"\" checked>Włącz</label>";
				echo "<label class=\"checkbox-inline\"><input type=\"checkbox\" value=\"\">Wyłącz</label>";
			}elseif($r['status'] == "off"){
				echo "<label class=\"checkbox-inline\"><input type=\"checkbox\" value=\"\">Włącz</label>";
				echo "<label class=\"checkbox-inline\"><input type=\"checkbox\" value=\"\" checked>Wyłącz</label>";
			}
			echo "<a href=\"komunikaty.php?a=del&amp;id={$r['id']}\">Usun</a> <a href=\"komunikaty.php?a=edit&amp;id={$r['id']}\">Edytuj</a>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
		}
	}
?>