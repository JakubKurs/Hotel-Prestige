<?php
	session_start();
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}
	require_once "config/config.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		# pobieranie danych z formularza
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
		if ($rezultat = @$polaczenie->query(
			# zapytanie do bazy danych
			sprintf("SELECT * FROM users WHERE login='%s' AND haslo='%s'",
			mysqli_real_escape_string($polaczenie,$login),
			mysqli_real_escape_string($polaczenie,$haslo))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				# ustawianie sesji logowania
				$_SESSION['zalogowany'] = true;
				# odbieranie danych z bazy danych
				$wiersz = $rezultat->fetch_assoc();
				$_SESSION['id'] = $wiersz['id'];
				$_SESSION['uzytkownik'] = $wiersz['login'];
				$_SESSION['nr_telefonu'] = $wiersz['nr_telefonu'];
				$_SESSION['adres'] = $wiersz['adres_zamieszkania'];
				$_SESSION['numer_konta'] = $wiersz['numer_konta'];
				$_SESSION['uprawnienia'] = $wiersz['uprawnienia'];
				$_SESSION['numer_konta'] = $wiersz['numer_konta'];
				unset($_SESSION['blad']);
				$rezultat->free_result();
				header('Location: zalogowany.php');
			} else {
				# jezeli zle dane logowania
				$_SESSION['bad_request'] = "Nieprawidlowe dane logowania!";
				header('Location: index.php');
			}
		}
		$polaczenie->close();
	}
?>