<?php
	if(isset($wiadomosc2[0])){
		echo "
			<div class=\"".$typs." alert-dismissible fade in\">
			<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
			<strong><span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\"></span>".$infoheader."</strong><br>".$wiadomosc2[0]."
			<br><font size=\"1px\"><span style=\"float: right; margin-bottom: 2px\">Data dodania: ".$data2[0]."</font></span>
			</div>
		";
	}
?>