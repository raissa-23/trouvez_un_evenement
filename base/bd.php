<?php
	//fichier 2. Connexion à la base de données
	function getBD(){
		$bdd= new PDO('mysql:host=localhost;dbname=trouvez_votre_evenement;charset=utf8', 'root', '');
		return $bdd;
		}
	
	?>