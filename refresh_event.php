<?php
    session_start();        
    require('base/bd.php');

    if((!isset($_FILES['image'])) || ($_POST['adresse']=="") || ($_POST['information']=="") || ($_POST['mot_cles']=="") || ($_POST['tarif']=="") || ($_POST['date_debut']=="") || ($_POST['place']=="") || ($_POST['adresse']=="") || ($_POST['dep']=="") || ($_POST['region']=="") || ($_POST['ville']==""))
    {
        echo '<meta http-equiv="Refresh" content="0; new_event.php?adresse='.$_POST['adresse'].'&lien='.$_POST['lien'].'&information_pratique='.$_POST['information'].'&mot_cles='.$_POST['mot_cles'].'&tarif='.$_POST['tarif'].'&date_debut='.$_POST['date_debut'].'"/>';
    }
                
    else 
    {  
        $place=$_POST['place'];
        $adr=$_POST['adresse'];
        $departement=$_POST['dep'];
        $region=$_POST['region'];
        $quartier=$_POST['quartier'];
        $ville=$_POST['ville'];
        //verifions si l'adresse existe deja dans notre base, si oui on recupere son identifiant
        $req = getBD()->query ('select * from adresse where place="'.$place.'" and adresse="'.$adr.'" and
        departement="'.$departement.'" and region="'.$region.'" and quartier="'.$quartier.'" and ville="'.$ville.'"');
        $adresse=$req->fetch();

        //Si l'adresse n'existe pas, on l'ajoute dans notre base 
        if($adresse==false)
        {
            $req="INSERT INTO adresse (place,adresse,departement,region,quartier,ville) VALUES('".$place."','"
            .$adr."','".$departement."','".$region."','".$quartier."','".$ville."')";
            $adresse = getBD()->query($req);
            
            $req = getBD()->query ('select * from adresse where place="'.$place.'" and adresse="'.$adr.'" and
            departement="'.$departement.'" and region="'.$region.'" and quartier="'.$quartier.'" and ville="'.$ville.'"');
            $adresse=$req->fetch();
        }
        $req='select utilisateur_id from utilisateur where email="'.$_SESSION['utilisateur']["mail"].'"';
        $rep = getBD()->query($req);
        $utilisateur=$rep->fetch();

        //insertion de l'evenment 
        $req = " INSERT INTO evenement (utilisateur_id,adresse_id , information_pratique, titre, description_even, mot_cles, tarif, date_debut, heure_debut, date_fin, heure_fin)
        VALUES('".$utilisateur['utilisateur_id']."','".$adresse['adresse_id']."','".$_POST['information']."','".$_POST['titre']."','".$_POST['description_even']."',
        '".$_POST['mot_cles']."','".$_POST['tarif']."','".$_POST['date_debut']."','".$_POST['heure_debut']."','".$_POST['date_fin']."','".$_POST['heure_fin']."')"; 
        getBD()->query($req);


        // ON recupère les informations de l'évenement
        $req = " SELECT * FROM evenement WHERE utilisateur_id = '".$utilisateur['utilisateur_id']."' AND adresse_id = '".$adresse['adresse_id']."' AND information_pratique = '".$_POST['information']."' AND titre='".$_POST['titre']."' AND description_even= '".$_POST['description_even']."' AND
        mot_cles = '".$_POST['mot_cles']."' AND tarif = '".$_POST['tarif']."' AND date_debut = '".$_POST['date_debut']."' AND heure_debut = '".$_POST['heure_debut']."' AND date_fin = '".$_POST['date_fin']."' AND heure_fin = '".$_POST['heure_fin']."'"; 
     
        $rep = getBD()->query($req);
        $evenement = $rep->fetch();

        //On parcourt la liste des images envoyées par l'utilisateur.
        for ($i = 0; $i < sizeof($_FILES['image']['tmp_name']) ; $i++)
        { 
            //on verifie si l'image existe déja dans la base
            $query = 'select * from image where lien_image="'.$_FILES['image']['tmp_name'][$i].'"';
     
            $req = getBD()->query ($query);
            $image = $req->fetch();
            if( $image == false )
            {
                //Insertion de l'image
                $req = " INSERT INTO image (lien_image) VALUES('".$_FILES['image']['tmp_name'][$i]."')";
                getBD()->query($req);
                // ON recupère les informations de l'image
                $req = " SELECT * FROM image WHERE lien_image = '".$_FILES['image']['tmp_name'][$i]."' ";
                $rep = getBD()->query($req);
                $image = $rep->fetch();
            }
            //Insertion de la table posseder
            $req = " INSERT INTO posseder (evenement_id, image_id) VALUES('".$evenement['evenement_id']."','".$image['image_id']."')";

            $result = getBD()->query($req);
        }
        echo '<meta http-equiv="Refresh" content="0; index.php"/>';
    }
?>