<?php
    $page="nouveau_even";
    require ('header.php');
?>
<title>Nouveau événement</title>
<div class="col-lg-8 ml-auto mr-auto container mt-5" style="">
    <div class="card border-danger">
        <div class="card-header bg-danger text-white text-center" style="width: 100%;">
            <h5><b>Ajouter un nouvel événement !</b></h5>
        </div>
        <div class="card-body">
            <form action="refresh_event.php" enctype="multipart/form-data" method="post" autocomplete="off">
                <hr>
                <h5>Informations sur l'événement<H5>
                <hr>
                <table style="width: 100%;">
                    <tr>
                        <td class="pb-3" style="width: 50%; vertical-align: baseline;">
                            Titre :<br>
                            <input  type="text" class="form-control" name="titre" value="<?php if(isset($_POST['titre'])) echo $_POST['titre']; ?>"/>
                        </td>
                        <td class="pb-3" style="vertical-align: baseline;">
                            Informations pratiques :<br>
                            <input type="text"  class="form-control"  name="information" value="<?php if(isset($_POST['information'])) echo $_POST['information'];?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="pb-3" style="width: 100%; vertical-align: baseline;">
                            Description :<br>
                            <textarea class="form-control"  name="description_even" value="<?php if(isset($_POST['description_even'])) echo $_POST['description_even']; ?>"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="pb-3" style="width: 50%; vertical-align: baseline;">
                            Mots clés :<br>
                            <input type="text" class="form-control" name="mot_cles" value="<?php if(isset($_POST['mot_cles'])) echo $_POST['mot_cles']; ?>"/>
                        </td>
                        <td class="pb-3" style="vertical-align: baseline;">
                            Tarif  :<br>
                             <input type="text"  class="form-control" name="tarif" value="<?php if(isset($_POST['tarif'])) echo $_POST['tarif']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="pb-3" style="width: 50%; vertical-align: baseline;">
                            Date de debut : <br>
                            <input type="date" class="form-control" name="date_debut" value="<?php if(isset($_POST['date_debut'])) echo $_POST['date_debut']; ?>"/>
                        </td>
                        <td class="pb-3" style="vertical-align: baseline;">
                            Heure debut  :<br>
                            <input type="time" class="form-control" name="heure_debut" value="<?php if(isset($_POST['heure_debut'])) echo $_POST['heure_debut']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="pb-3" style="width: 50%; vertical-align: baseline;">
                            Date de fin : <br>
                            <input type="date" class="form-control" name="date_fin" value="<?php if(isset($_POST['date_fin'])) echo $_POST['date_fin']; ?>"/>
                        </td>
                        <td class="pb-3" style="vertical-align: baseline;">
                             Heure de fin  :<br>
                            <input type="time" class="form-control" name="heure_fin" value="<?php if(isset($_POST['heure_fin'])) echo $_POST['heure_fin']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="pb-3" colspan="2" style="width: 100%; vertical-align: baseline;">
                            Images : <br>
                            <input type="file" class="form-control" name="image[]" multiple="true"/>
                        </td>
                    </tr>
                </table>
                <hr>
                <h5>D'ou aura lieu cet événement ?</h5>
                <hr>
                <table style="width: 100%;">
                    <tr>
                        <td class="pb-3" style="width: 50%; vertical-align: baseline;">
                            Place : <br>
                            <input type="text" class="form-control" placeholder=" faculté de médecine" name="place" value="<?php if(isset($_POST['place'])) echo $_POST['place']; ?>"/>
                        </td>
                        <td class="pb-3" style="vertical-align: baseline;">
                            Adresse  :<br>
                            <input type="text" class="form-control" placeholder=" 2 Rue de l'école de Médecine, 34000 Montpellier" name="adresse" value="<?php if(isset($_POST['adresse'])) echo $_POST['adresse']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="pb-3" style="width: 50%; vertical-align: baseline;">
                            Département : <br>
                            <input type="text" class="form-control" placeholder=" Hérault" name="dep" value="<?php if(isset($_POST['dep'])) echo $_POST['dep'];?>"/>
                        </td>
                        <td class="pb-3" style="vertical-align: baseline;">
                            Région  :<br>
                            <input  type="text" class="form-control"  placeholder="Occitanie"  name="region" value="<?php if(isset($_POST['region'])) echo $_POST['region']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="pb-3" style="width: 50%; vertical-align: baseline;">
                            Ville : <br>
                             <input type="text" class="form-control" placeholder=" ville" name="ville" value="<?php if(isset($_POST['ville'])) echo $_POST['ville']; ?>"/>
                        </td>
                        <td class="pb-3" style="vertical-align: baseline;">
                            Quartier  :<br>
                            <input type="text" class="form-control" placeholder=" quartier" name="quartier" value="<?php if(isset($_POST['quartier'])) echo $_POST['quartier']; ?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td  colspan="2" class="pb-3" style="width: 100%; vertical-align: baseline;">
                            <input class="btn-primary" type="submit" value="Envoyer">
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



