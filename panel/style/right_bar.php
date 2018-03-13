<?php
	echo "
		<div class=\"col-sm-2 sidenav\">
			<div class=\"well\">
				<span class=\"glyphicon glyphicon-time\"></span> Aktualna godzina
				<div id=\"czas\">
					<script type=\"text/javascript\">
						function getTime() {
							return (new Date()).toLocaleTimeString();
						}
						document.getElementById('czas').innerHTML = getTime();
						setInterval(function() {
							document.getElementById('czas').innerHTML = getTime();
						}, 1000);
					</script>
				</div>
			</div>
			<div class=\"well\">
				<span class=\"glyphicon glyphicon-user\"></span> Informacje o koncie
				<div>
					Użytkownik: <span class=\"label label-default\">".$_SESSION['uzytkownik']."</span><br>";
					if($_SESSION['uprawnienia'] == "Administrator"){
						echo"Uprawnienia: <span class=\"label label-danger\">".$_SESSION['uprawnienia']."</span><br>";
					}else{
						echo"Uprawnienia: <span class=\"label label-default\">".$_SESSION['uprawnienia']."</span><br>";
					};
	echo "
				</div>
			</div>
		</div>
	";
?>