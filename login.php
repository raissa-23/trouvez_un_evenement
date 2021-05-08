<?php
    $page="connexion";
    require ('header.php');
?>
<title>Connexion</title>
<div class="col-lg-8 ml-auto mr-auto container mt-5" style="margin-bottom: 200px;">
    <div class="card border-danger">
        <div class="card-header bg-danger text-white text-center" style="width: 100%;">
            <h5><b>Connectez-vous</b></h5>
        </div>
        <div class="card-body">
            <form action="traitement.php" method="POST" autocomplete="off">
                <table style="width: 100%;">
                    <tr>
                        <td class="pb-3" style="width: 50%; vertical-align: baseline;">
                            <!-- quand je clique sur  "Nom", ça me selectionne le champs par défaut -->
                            <label for="nom">Adresse e-mail *</label><br>
                            <input type="email" class="form-control" placeholder="Mdroumbaba" id="mail" name="mail" value="<?php  if(isset($_GET['mail'])) { echo $_GET['mail']; } ?>" />
                            <?php 
                                if( !empty($_GET['msg_erreur_mail']) )
                                {
                                    echo '<span style="color : red;">'.$_GET['msg_erreur_mail'].'<span>';
                                }
                            ?>
                        </td>
                        <td class="pb-3" style="vertical-align: baseline;">
                            <label for="prenom">Mot de passe *</label><br>
                            <input class="form-control" type="password" id="mot_de_passe" name="mot_de_passe" value="<?php if(isset($_GET['prenom'])) { echo $_GET['prenom']; } ?>" />
                            <?php 
                                if( !empty($_GET['msg_erreur_mot_de_passe'])  )
                                {
                                    echo '<span style="color : red;">'.$_GET['msg_erreur_mot_de_passe'].'<span>';
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left"  style="width: 100%; vertical-align: baseline;" colspan="2">
                            * Champs requis
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left"  style="width: 100%; vertical-align: baseline;" colspan="2">
                            Pas encore inscrit ? <a href="registration_page.php">Inscrivez-vous gratuitement!</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="width: 100%; vertical-align: baseline;" colspan="2">
                            <input class="btn-primary" type="submit" name="connexion" value="Me connecter">
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
