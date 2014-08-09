<?php 
	echo "<br><b>Courrier(s) pour BTK".$_GET["laref"]."</b><br><br>";
	if($simple_exits)
		echo "<br>- <font color='green'><b>Courrier Simple</b> = OUI <i>(déjà envoyé)</i></font> : <a href=".$file_url_simple."><u>LE VOIR</u></a>";
	else echo "<br>- Il n'y a aucun Courrier Simple envoyé à ce jour !<br>";

	if($recommande_exits)
		echo "<br>- <font color='green'><b>Courrier Recommandé</b> = OUI <i>(déjà envoyé)</i></font> : <a href=".$file_url_recomande."><u>LE VOIR</u></a>";
	else echo "<br>- Il n'y a aucun Courrier Recommandé envoyé à ce jour !";

