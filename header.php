<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		
		<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="styles/style.css"/>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
		<style type="text/css">
			.nav li{
				margin-left: 0px;
			}
		</style>
	</head>
	<body style=" background-image: url(images/bg.jpg); -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; color: black; position:relative;  height:100%; /* needed for container min-height */">
		<?php
		session_start();
		require('base/bd.php');
		?>
			<div class="bg-info" style="width: 100%; ">
				<table style="width: 100%;">
					<tr>
						<td style="width: 33%; text-align: center;" class="pl-5 pt-4"><a href="index.php"><img src="images/logo2.png" alt="logo" class="logo"></a></td>
						<td style="width: 33%; text-align: center;" class="p-2 pt-5"><h1><b> <span class="text-danger">T</span>rouvez <span class="text-danger">V</span>otre <span class="text-danger">É</span>vénement</b></h1> </td>
						<td style="width: 33%; text-align: center;" class="pr-5 pt-4"><a href="index.php"><img src="images/logo1.png" alt="logo" class="logo1"></a></td>
					</tr>
				</table>
			</div>

			<div class="bg-info">
				<ul class="nav justify-content-center">
					<?php
						if($page!='index')
	                    {
	                       	echo '<li class="nav-item"><a style="border-right: 2px solid #dbdee9; color: white;" class="nav-link" href="index.php"><i class="fas fa-search"></i> Recherche</a></li>';
	                    }
						if(isset($_SESSION['utilisateur']))
						{
							echo '<li class="nav-item"><a style="border-right: 2px solid #dbdee9;  color: white;" class="nav-link" href="new_event.php"><i class="fas fa-plus-circle"></i> Ajouter un événement</a></li>';
						}
						/*
						else{
							echo '<li class="nav-item"><a style="border-right: 2px solid #dbdee9;  color: white;" class="nav-link" href="login.php"><i class="fas fa-plus-circle"></i> Ajouter un événement</a></li>';
						}
						*/
	                    if($page!="geolocalisation")
	                    {
	                       	echo '<li class="nav-item"><a style="border-right: 2px solid #dbdee9;  color: white;" class="nav-link" href="geolocation.php"><i class="fas fa-map-marked-alt"></i> Consulter la carte géographique</a></li>';
	                    }
	                    if (isset($_SESSION['utilisateur']))
	                    {
	                    	echo '<li class="nav-item">';
	                    		echo '<div class="dropdown">';
	                    			echo '<a class="nav-link dropdown-toggle" style=" color: white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="fas fa-user-circle"></i>  '.$_SESSION['utilisateur']["prenom"].' '.$_SESSION['utilisateur']["nom"].'</a>';
	                    			echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
	                    				echo '<a class="dropdown-item" href="profil.php"><i class="fas fa-user"></i> Mon profil</a>';
	                    				echo '<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" ><i class="fas fa-sign-out-alt"></i> Déconnexion</a>';
	                    			echo '</div>';
	                    		echo '</div>';
	                    	echo '</li>';
	                    }
	                    else
	                    {
	                    	if( $page != "page_inscription" )
	                        {
	                        	echo '<li style=""class="nav-item"><a class="nav-link " href="registration_page.php" style="border-right: 2px solid #dbdee9; color: white;" >S\'inscrire</a></li>';
	                        }
	                        if( $page != "connexion" )
	                        {
	                        	echo '<li class="nav-item"><a style=" color: white;" class="nav-link" href="login.php">Se connecter</a></li>';
	                        }
	                    }
	  				?>
				</ul>
			</div>
			
			<?php 
				if(isset($_SESSION['utilisateur']))
				{
					//Modal logout
					echo '<div class="modal fade " id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
						echo '<div class="modal-dialog">';
							echo '<div class="modal-content border-danger">';
								echo '<div class="modal-body text-center">';
									echo '<h5>Confirmez votre déconnexion</h5>';
								echo '</div>';
								echo '<div class="modal-footer">';
									echo '<form method="POST" action="traitement.php">';
										echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>';
										echo " &nbsp &nbsp ";
										echo '<button type="submit" name="deconnection" class="btn btn-primary">';
											echo '<i class="fas fa-sign-out-alt"></i>';
											echo ' Déconnecter';
										echo '</button>';
									echo '</form>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			?>
			
				
			




	