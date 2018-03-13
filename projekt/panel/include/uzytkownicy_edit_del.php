<?php
	$a = trim($_GET['a']); 
	$id = trim($_GET['id']); 
	$login = trim($_GET['user']);
	$modal = trim($_GET['modal']);
	$imieinazwisko = trim($_GET['imieinazwisko']);
	$data_urodzenia = trim($_GET['dataurodzenia']);
	$telefon = trim($_GET['telefon']);
	$upr = trim($_GET['upr']);
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
			$email = $r['email'];
			$adres_zamieszkania_sql = $r['adres_zamieszkania'];
			$haslo = $r['haslo'];
		}
	}
	if($a == 'del' and !empty($id)) { 
		echo '
			<div class="modal fade" id="delete" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Potwierdzenie</h4>
						</div>
						<div class="modal-body">
							<form action="uzytkownicy.php?a=del" method="post"> 
								<input type="hidden" name="a" value="del" /> 
								<input type="hidden" name="id" value="'.$id.'" /> 
								<div class="form-group">
									Czy napewno chcesz usunąć użytkownika <span class="label label-warning">'.$imieinazwisko.'</span> z bazy danych?<br>
									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" class="close" data-dismiss="modal">Anuluj</button>
									<button type="submit" class="btn btn-success">Tak</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<script> $("#delete").modal(\'show\');</script>
		';
	}else if($a == 'edit' and !empty($id)) { 
		$wynik = mysql_query("SELECT * FROM projekt_admin.users WHERE id='$id'") 
			or die('Błąd zapytania'); 
		if(mysql_num_rows($wynik) > 0) { 
			$r = mysql_fetch_assoc($wynik); 
			echo '
				<div class="modal fade" id="edit" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Edytuj użytkownika '.$imieinazwisko.'</h4>
							</div>
							<div class="modal-body">
								<form action="uzytkownicy.php?a=save" method="post"> 
									<input type="hidden" name="a" value="save" /> 
									<input type="hidden" name="id" value="'.$id.'" /> 
									<div class=\"form-group\">
										<label class=\"col-lg-3 control-label\">Imie i nazwisko:</label>
										<div class=\"col-lg-8\">
											<input class="form-control" type="text" value="'.$imieinazwisko.'" placeholder="Imie i nazwisko" name="imie_i_nazwisko" id="imie_i_nazwisko">
										</div>
									</div>
									<div class=\"form-group\">
										<label class=\"col-lg-3 control-label\">Login:</label>
										<div class=\"col-lg-8\">
											<input class="form-control" type="text" value="'.$login.'" placeholder="Login" name="login" id="login">
										</div>
									</div>
									<div class=\"form-group\">
										<label class=\"col-lg-3 control-label\">Data urodzenia:</label>
										<div class=\"col-lg-8\">
											<input class="form-control" type="text" value="'.$data_urodzenia.'" placeholder="Data urodzenia (rrrr-mm-dd)" name="data_urodzin" id="data_urodzin">
										</div>
									</div>
									<div class=\"form-group\">
										<label class=\"col-lg-3 control-label\">Numer telefonu:</label>
										<div class=\"col-lg-8\">
											<input class="form-control" type="text" value="'.$telefon.'" placeholder="Numer telefonu (123456789)" name="nr_telefonu" id="nr_telefonu">
										</div>
									</div>
									<div class=\"form-group\">
										<label class=\"col-lg-3 control-label\">Adres zamieszkania:</label>
										<div class=\"col-lg-8\">
											<input class="form-control" type="text" value="'.$adres_zamieszkania_sql.'" placeholder="Miasto, ulica" name="adres_zamieszkania" id="adres_zamieszkania">
										</div>
									</div>
									<div class=\"form-group\">
										<label class=\"col-lg-3 control-label\">Email:</label>
										<div class=\"col-lg-8\">
											<input class="form-control" type="text" value="'.$email.'" placeholder="Adres email" name="email" id="email">
										</div>
									</div>
									<div class=\"form-group\">
										<label class=\"col-lg-3 control-label\">Haslo:</label>
										<div class=\"col-lg-8\">
											<input class="form-control" type="password" value="'.$haslo.'" placeholder="Haslo" name="haslo" id="haslo">
										</div>
									</div>
									<div class=\"form-group\">
										<div class=\"col-lg-8\">
											<label for="sel1">Uprawnienia:</label>
											<select class="form-control" id="uprawnienia" name="uprawnienia">';
											if($upr == "Administrator"){
												echo '
													<option value="Administrator" selected>Administrator</option>
													<option value="Uzytkownik">Użytkownik</option>
												';
											}else{
												echo '
													<option value="Administrator">Administrator</option>
													<option value="Uzytkownik" selected>Użytkownik</option>
												';
											};
											echo '
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" class="close" data-dismiss="modal">Anuluj</button>
										<button type="submit" class="btn btn-success">Zakończ edycje</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<script> $("#edit").modal(\'show\');</script>
			';
		} 
	}elseif($a == 'add') { 
		echo '
			<div class="modal fade" id="add" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Dodaj użytkownika</h4>
						</div>
						<div class="modal-body">
							<form action="uzytkownicy.php?a=addus" method="post"> 
								<input type="hidden" name="a" value="addus" /> 
								<div class=\"form-group\">
									<label class=\"col-lg-3 control-label\">Imię i nazwisko:</label>
									<div class=\"col-lg-8\">
										<input class="form-control" type="text" placeholder="Imie i nazwisko" name="imie_i_nazwisko" id="imie_i_nazwisko">
									</div>
								</div>
								<div class=\"form-group\">
									<label class=\"col-lg-3 control-label\">Login:</label>
									<div class=\"col-lg-8\">
										<input class="form-control" type="text" placeholder="Login" name="login" id="login">
									</div>
								</div>
								<div class=\"form-group\">
									<label class=\"col-lg-3 control-label\">Data urodzenia:</label>
									<div class=\"col-lg-8\">
										<input class="form-control" type="text" placeholder="Data urodzenia (rrrr-mm-dd)" name="data_urodzin" id="data_urodzin">
									</div>
								</div>
								<div class=\"form-group\">
									<label class=\"col-lg-3 control-label\">Numer telefonu:</label>
									<div class=\"col-lg-8\">
										<input class="form-control" type="text" placeholder="Numer telefonu (123456789)" name="nr_telefonu" id="nr_telefonu">
									</div>
								</div>
								<div class=\"form-group\">
									<label class=\"col-lg-3 control-label\">Adres zamieszkania:</label>
									<div class=\"col-lg-8\">
										<input class="form-control" type="text" placeholder="Miasto, ulica" name="adres_zam" id="adres_zam">
									</div>
								</div>
								<div class=\"form-group\">
									<label class=\"col-lg-3 control-label\">Email:</label>
									<div class=\"col-lg-8\">
										<input class="form-control" type="text" placeholder="email@email.pl" name="email" id="email">
									</div>
								</div>
								<div class=\"form-group\">
									<label class=\"col-lg-3 control-label\">Hasło:</label>
									<div class=\"col-lg-8\">
										<input class="form-control" type="password" placeholder="haslo" name="haslo" id="haslo">
									</div>
								</div>
								<div class=\"form-group\">
									<div class=\"col-lg-8\">
										<label for="sel1">Uprawnienia:</label>
										<select class="form-control" id="uprawnienia" name="uprawnienia">
											<option value="Administrator">Administrator</option>
											<option value="Uzytkownik" selected>Użytkownik</option>
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" class="close" data-dismiss="modal">Anuluj</button>
									<button type="submit" class="btn btn-success">Dodaj</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<script> $("#add").modal(\'show\');</script>
		';
	}elseif($a == 'save') { 
		$imie_i_nazwisko = $_POST['imie_i_nazwisko']; 
		$login = $_POST['login']; 
		$data_urodzin = $_POST['data_urodzin'];
		$nr_telefonu = $_POST['nr_telefonu'];
		$uprawnienia = $_POST['uprawnienia'];
		$email = $_POST['email'];
		$ids = $_POST['id']; 
		$adres_zamieszkania = $_POST['adres_zamieszkania'];
		$haslo = $_POST['haslo'];
		mysql_query("UPDATE projekt_admin.users SET imie_i_nazwisko='$imie_i_nazwisko', login='$login', data_urodzenia='$data_urodzin', nr_telefonu='$nr_telefonu', adres_zamieszkania='$adres_zamieszkania', uprawnienia='$uprawnienia', haslo='$haslo', email='$email' WHERE id='$ids'") 
			or die('Błąd zapytania'); 
	}elseif($a == 'del') {
		$ids = $_POST['id']; 
		mysql_query("DELETE FROM projekt_admin.users WHERE id='$ids'");
		header('Location: uzytkownicy.php?del');
	}elseif($a == 'addus') {
		$numer_konta = mt_rand(10000,99999);
		$imie_i_nazwisko = $_POST['imie_i_nazwisko']; 
		$login = $_POST['login']; 
		$data_urodzin = $_POST['data_urodzin'];
		$nr_telefonu = $_POST['nr_telefonu'];
		$uprawnienia = $_POST['uprawnienia'];
		$adres = $_POST["adres_zam"];
		$email = $_POST['email'];
		$haslo = $_POST['haslo'];
		mysql_query("INSERT INTO projekt_admin.users SET numer_konta='$numer_konta', imie_i_nazwisko='$imie_i_nazwisko', data_urodzenia='$data_urodzin', nr_telefonu='$nr_telefonu', adres_zamieszkania='$adres', email='$email', login='$login', haslo='$haslo', uprawnienia='$uprawnienia'")
			or die(mysql_error());
		header('Location: uzytkownicy.php?add=success');
	}
?>