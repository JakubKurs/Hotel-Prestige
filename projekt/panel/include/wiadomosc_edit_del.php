<?php
	$a = trim($_GET['a']); 
	$id = trim($_GET['id']); 
	$modal = trim($_GET['modal']);
	if($a == 'del' and !empty($id)) { 
		echo '
			<div class="modal fade" id="delete" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Edytuj wiadomość</h4>
						</div>
						<div class="modal-body">
							<form action="komunikaty.php?a=del" method="post"> 
								<input type="hidden" name="a" value="del" /> 
								<input type="hidden" name="id" value="'.$id.'" /> 
								<div class="form-group">
									Czy napewno chcesz usunąć wiadomość?
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
		$wynik = mysql_query("SELECT * FROM projekt_admin.info WHERE id='$id'") 
			or die('Błąd zapytania'); 
		if(mysql_num_rows($wynik) > 0) { 
			$r = mysql_fetch_assoc($wynik); 
			echo '
				<div class="modal fade" id="edit" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Edytuj wiadomość</h4>
							</div>
							<div class="modal-body">
								<form action="komunikaty.php?a=save" method="post"> 
									<input type="hidden" name="a" value="save" /> 
									<input type="hidden" name="id" value="'.$id.'" /> 
									<div class="form-group">
										<label for="comment">Treść wiadomości:</label>
										<textarea class="form-control" style="mid-width: 50%" rows="3" name="tresc" id="tresc">'.$r['wiadomosc'].'</textarea>
										<span size="1"class="help-block">Pamiętaj aby treść wiadomości zawierała najważniejsze informacje.</span>
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
	}elseif($a == 'save') { 
		$ids = $_POST['id']; 
		$tresc = $_POST['tresc']; 
		$edytujacy = $_SESSION['uzytkownik'];
		mysql_query("UPDATE projekt_admin.info SET wiadomosc='$tresc', dodajacy='$edytujacy' WHERE id='$ids'") 
			or die('Błąd zapytania'); 
		header('Location: komunikaty.php?save');
	}elseif($a == 'del') {
		$ids = $_POST['id']; 
		mysql_query("DELETE FROM projekt_admin.info WHERE id='$ids'");
		header('Location: komunikaty.php?del');
	}
?>