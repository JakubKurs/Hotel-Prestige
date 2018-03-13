<?php 
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		$_SESSION['bad_request'] = 'Musisz się zalogować!';
		header('Location: index.php?bad_request');
		exit();
	}else{
		include_once "../config/config.php";
		$godzina = date("H:i:s");
		$data = date("Y/m/d");
		$tresc = $_POST['tresc']; 
		$typ = $_POST['typ']; 
		$user = $_SESSION['uzytkownik'];
		if($tresc and $user){
			$connection = @mysql_connect($host, $db_user, $db_password) 
			or die('Brak połączenia z serwerem MySQL'); 
			$db = @mysql_select_db($db_name, $connection) 
			or die('Nie mogę połączyć się z bazą danych'); 
			$ins = @mysql_query("INSERT INTO info SET wiadomosc='$tresc', typ='$typ', dodajacy='$user', data='$data', godzina='$godzina'"); 
			if($ins) header('location: ../ustawienia.php'); 
			else echo "Błąd nie udało się dodać nowego rekordu"; 
			mysql_close($connection); 
		}else{
			$_SESSION['komunikat_error'] = "Musisz wpisać streść wiadomości";
			header('location: ../ustawienia.php');
		}
	}
?>