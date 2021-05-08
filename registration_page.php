<?php
	$page="page_inscription";
	require ('header.php');
?>
<title>Inscription</title>
<div class="col-lg-8 ml-auto mr-auto container mt-5" style="">
	<div class="card border-danger">
  		<div class="card-header bg-danger text-white text-center" style="width: 100%;">
    		<h5><b>Inscrivez-vous gratuitement !</b></h5>
  		</div>
  		<div class="card-body">
  			<form action="traitement.php" method="post" autocomplete="off">
		 		<table style="width: 100%;">
		 			<tr>
						<td class="pb-3" style="width: 50%; vertical-align: baseline;">
		 					<!-- quand je clique sur  "Nom", ça me selectionne le champs par défaut -->
							<label for="nom">Nom :</label><br>
							<input type="text" class="form-control" placeholder="Mdroumbaba" id="nom" name="nom" value="<?php  if(isset($_GET['nom'])) { echo $_GET['nom']; } ?>" />
							<?php 
								if( !empty($_GET['msg_erreur_nom']) )
								{
									echo '<span style="color : red;">'.$_GET['msg_erreur_nom'].'<span>';
								}
							?>
						</td>
						<td class="pb-3" style="vertical-align: baseline;">
							<label for="prenom">Prénom :</label><br>
							<input class="form-control" type="text" placeholder="Soprambaba" id="prenom" name="prenom" value="<?php if(isset($_GET['prenom'])) { echo $_GET['prenom']; } ?>" />
							<?php 
								if( !empty($_GET['msg_erreur_prenom'])  )
								{
									echo '<span style="color : red;">'.$_GET['msg_erreur_prenom'].'<span>';
								}
							?>
						</td>
					</tr>
					<tr>
						<td class="pb-3" style="width: 50%; vertical-align: baseline;">
							<label for="num">Numéro de téléphone :</label><br>
							<input type="text" class="form-control" placeholder="0XXXXXXXXX" id="num" name="telephone" value="<?php if(isset($_GET['telephone'])) { echo $_GET['telephone']; } ?>" />
							<?php 
								if( !empty($_GET['msg_erreur_telephone']) )
								{
									echo '<span style="color : red;">'.$_GET['msg_erreur_telephone'].'<span>';
								}
							?>
						</td>
						<td class="pb-3" style="vertical-align: baseline;">
							<label for="prenom">Date de naissance :</label><br>
							<input type="date" class="form-control" id="Date de naissance" name="date_naissance" value="<?php if( isset($_GET['date_naissance']) ) { echo $_GET['date_naissance']; } ?>" />
							<?php 
								if( !empty($_GET['msg_erreur_date_naissance'])  )
								{
									echo '<span style="color : red;">'.$_GET['msg_erreur_date_naissance'].'<span>';
								}
							?>
						</td>
					</tr>
					<tr>
						<td class="pb-3" colspan="2" style="vertical-align: baseline;">
							<label for="adresse"> Adresse :</label> <br>
							<input type="text" class="form-control" placeholder="1207 rue des olivier" id="adresse" name="adresse" value="<?php if(isset($_GET['adresse'])) { echo $_GET['adresse']; } ?>" />
							<?php 
								if( !empty($_GET['msg_erreur_adresse']) )
								{
									echo '<span style="color : red;">'.$_GET['msg_erreur_adresse'].'<span>';
								}
							?>
						</td>
					</tr>
					<tr>
						<td class="pb-3" style="width: 50%; vertical-align: baseline;">
							<label for="mail1">E-mail :</label><br>
							<input type="email" class="form-control" placeholder="tve@gmail.com" id="mail" name="mail" 
							value="<?php if(isset($_GET['mail'])) { echo $_GET['mail']; } ?>" />
							<?php 
								if( !empty($_GET['msg_erreur_mail']) )
								{
									echo '<span style="color : red;">'.$_GET['msg_erreur_mail'].'<span>';
								}
							?>
						</td>
						<td class="pb-3" style="vertical-align: baseline;">
							<label for="prenom">Confirmez votre e-mail : </label><br>
							<input type="email" class="form-control" id="mail2" name="confirmation_mail" value="<?php if(isset($_GET['confirmation_mail'])) echo $_GET['confirmation_mail']; ?>"/>
							<?php 
								if( !empty($_GET['msg_erreur_confirmation_mail']) )
								{
									echo '<span style="color : red;">'.$_GET['msg_erreur_confirmation_mail'].'<span>';
								}
							?>
						</td>
					</tr>
					<tr>
						<td class="pb-3" style="width: 50%; vertical-align: baseline;">
							<label for="mdp1">Mot de passe :</label><br>
							<input type="password" class="form-control"  id="mdp1" name="mot_de_passe" value=""/>
							<?php 
								if( !empty($_GET['msg_erreur_mot_de_passe']) )
								{
									echo '<span style="color : red;">'.$_GET['msg_erreur_mot_de_passe'].'<span>';
								}
							?>
						</td>
						<td class="pb-3" style="vertical-align: baseline;">
							<label for="mdp2">Confirmez votre mot de passe :</label><br>
							<input type="password" class="form-control"  id="mdp2" name="confirmation_mot_de_passe" value=""/>
							<?php 
								if( !empty($_GET['msg_erreur_confirmation_mot_de_passe']) )
								{
									echo '<span style="color : red;">'.$_GET['msg_erreur_confirmation_mot_de_passe'].'<span>';
								}
							?>
						</td>
					</tr>
					<tr>
						<td class="text-left"  style="width: 100%; vertical-align: baseline;" colspan="2">
							Déjà inscrit ? <a href="login.php">  connectez-vous !</a>
						</td>
					</tr>
					<tr>
						<td class="text-center" style="width: 100%; vertical-align: baseline;" colspan="2">
							<input type="submit" class="btn-primary" name="inscription" value="M'inscrire"/>
						</td>
					</tr>
				</table>
			</form>
  		</div>
  	</div>
</div>

<?php 
	require ('footer.php');
?> 