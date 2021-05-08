<?php
	$page="index";
	require ('header.php');
?>
<title>Trouve ton événement</title>
<div class="col-lg-8 ml-auto mr-auto container mt-5" style="margin-bottom: 240px;">
	<?php 
		if(!empty($_GET['msg_success']))
		{
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
				echo $_GET['msg_success'];
		  		echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
		    		echo '<span aria-hidden="true">&times;</span>';
		  		echo '</button>';
			echo '</div>';
		}
	?>
	<div class="card border-danger">
  		<div class="card-header bg-danger text-white text-center" style="width: 100%;">
    		<h5><b>Faites une recherche sur votre événement</b></h5>
  		</div>
  		<div class="card-body">
  			<form method="GET" action="" style="width: 100%;">
	    	<blockquote class="blockquote mb-0">
	    		<?php 
	    		if( isset($_GET['rechercher']) && (strlen($_GET['even']) <= 2 || strlen($_GET['date']) < 10))
	    		{
	    			echo '<div class="alert alert-danger" role="alert">';
	    				echo '<small>Le nom de l\'événement doit avoir plus de 2 caractères et la date est obligatoire !</small>';
	    			echo '</div>';
	    		}
				?>
	    		<table style="width: 100%;">
	    			<tr>
	    				<td class="p-2">
	    					<input type="text" id="even" class="form-control" placeholder="saisir votre évenement" name="even" autocomplete="off"
	    					value="<?php if( isset($_GET['even']) ) echo $_GET['even']; ?>"
	    					>
	    				</td>
	    				<td class="p-2">
	    					<input type="text" id="lieu" class="form-control" placeholder=" lieu de l'événement..." name="lieu" autocomplete="off"
	    					value="<?php if( isset($_GET['lieu']) ) echo $_GET['lieu']; ?>"
	    					>
	    				</td>
	    				<td class="p-2">
	    					<input type="date" id="date" class="form-control" placeholder=" date..." name="date" autocomplete="off"
	    					value="<?php if( isset($_GET['date']) ) echo $_GET['date']; ?>"
	    					>
	    				</td>
	    				<td class="p-2">
	    					<input type="time" id="heure" class="form-control" placeholder="heure..." name="heure" autocomplete="off"
	    					value="<?php if( isset($_GET['time']) ) echo $_GET['time']; ?>"
	    					>
	    				</td>
	    				<td class="p-2">
	    					<input type="text" id="tarif" class="form-control" placeholder="tarif/gratuit... " name="tarif" autocomplete="off"
	    					value="<?php if( isset($_GET['tarif']) ) echo $_GET['tarif']; ?>"
	    					>
	    				</td>
	    			</tr>
	    		</table>
	    		<div>
	    			<cite  class="blockquote-footer" title="Source Title"><u>L'événement et la date sont obligatoires pour votre recherche</u></cite>
	    		</div>
	      		<div style="display: block ruby; text-align: center;" class="mt-3">
	      			<input class="btn btn-primary" type="submit" value="Rechercher" name="rechercher">
	      			<input class="btn btn-secondary" type="button" value="Rénitialiser" onclick="reinitialiser();">
	      		</div>
	    	</blockquote>
	    	</form>
	    	<?php 
	    		//On affiche le résultat seulement si le champs événement a plus de 2 carctère et que la date est valide
	    		if(!empty($_GET['even']) && !empty($_GET['date']))
	    		{
		    		if(strlen($_GET['even']) > 2 && strlen($_GET['date'])>=10)
		    		{
		    			echo '<div class="mt-4">';
		    				echo '<h5>Résultat de votre recherche :</h5>';
		    			echo '</div>';
		    			echo '<div class="card">';
		    				//On fait appel à la page qui affiche le résultat de la recherche
		    				require ('resultat_recherche.php');
		    			echo '</div>';
		    		}
	    		}
	    	?>
			</div>
  		</div>
  		
	</div>
</div>
	<script type="text/javascript">
		function reinitialiser()
		{
			//On vide tous les champs : 
			document.getElementById('even').value = "";
			document.getElementById('lieu').value = "";
			document.getElementById('date').value = "";
			document.getElementById('time').value = "";
			document.getElementById('tarif').value = "";
		}
	</script>
</div>

<?php 
	require ('footer.php');
?>
			
			
	
