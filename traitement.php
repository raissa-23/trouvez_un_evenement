<!-- fichier 4/ -->
<?php
    session_start();
    //Afin d'envoyer des messages d'erreurs en utf8
    echo '<meta charset="utf-8">';
    //se connecter à notre base de données
    require('base/bd.php');

    //INSCRIPTION
    if(isset($_POST['inscription'])) 
    {
        //verifions si tous les champs sont remplis
        $existe_erreur = 0;
        $msg_erreur_nom = '';
        $msg_erreur_prenom = '';
        $msg_erreur_date_naissance = '';
        $msg_erreur_telephone = '';
        $msg_erreur_adresse = '';
        $msg_erreur_mail = '';
        $msg_erreur_confirmation_mail = '';
        $msg_erreur_mot_de_passe = '';
        $msg_erreur_confirmation_mot_de_passe = '';

        //Gestion des erreurs de saisies
        if( strlen($_POST['nom']) <= 2 || strlen($_POST['nom']) > 100  )
        {
            $msg_erreur_nom = "Le nom ne doit comporter entre 2 et 100 caractères";
            $existe_erreur = 1;
        }
        if( strlen($_POST['prenom']) <= 2 || strlen($_POST['prenom']) > 100  )
        {
            $msg_erreur_prenom = "Le prénom ne doit comporter entre 2 et 100 caractères";
            $existe_erreur = 1;
        }
        if( strlen($_POST['date_naissance']) <= 0 )
        {
            $msg_erreur_date_naissance = "La date de naissance est obligatoire";
            $existe_erreur = 1;
        }
        if( strlen($_POST['telephone']) <= 0 || !preg_match("#[0][1-9][- \.?]?([0-9][0-9][- \.?]?){4}$#", $_POST['telephone']) )
        {
            $msg_erreur_telephone = "Le numéro de téléphone doit etre au format 0XXXXXXXXX";
            $existe_erreur = 1;
        }
        if( strlen($_POST['adresse']) <= 0 )
        {
            $msg_erreur_adresse = "L'adresse est obligatoire";
            $existe_erreur = 1;
        }
        if( !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) || strlen($_POST['mail']) <= 0 )
        {
            $msg_erreur_mail = "L' é-mail est invalide";
            $existe_erreur = 1;
        }
        //On vérifie si l'é-mail existe déjà !
        $req = getBD()->query ('select * from utilisateur where email="'.$_POST['mail'].'"');
        $mail_existe = $req->rowCount();
        if($mail_existe != 0)
        {
            $msg_erreur_mail = "L' é-mail existe déjà, <a href='login.php?mail=".$_POST['mail']."'> connectez-vous ! </a>";
            $existe_erreur = 1;
        }
        if( $_POST['mail'] != $_POST['confirmation_mail'])
        {
            $msg_erreur_confirmation_mail = 'L\'émail ne correspond pas' ;
            $existe_erreur = 1;
        }
        if( strlen($_POST['mot_de_passe']) < 4 )
        {
            $msg_erreur_mot_de_passe = 'Le mot de passe doit avoir plus de 3 caractères';
            $existe_erreur = 1;
        }
        if( $_POST['mot_de_passe'] != $_POST['confirmation_mot_de_passe'] )
        {
            $msg_erreur_confirmation_mot_de_passe = 'Le mot de passe ne correspond pas';
            $existe_erreur = 1;
        }

        if( $existe_erreur == 1 )
        {
            echo '<meta http-equiv="Refresh" content="0; registration_page.php?nom='.$_POST['nom'].'&prenom='.$_POST['prenom'].'&date_naissance='.$_POST['date_naissance'].'&telephone='.$_POST['telephone'].'&adresse='.$_POST['adresse'].'&mail='.$_POST['mail'].'&confirmation_mail='.$_POST['confirmation_mail'].'&msg_erreur_nom='.$msg_erreur_nom.'&msg_erreur_prenom='.$msg_erreur_prenom.'&msg_erreur_date_naissance='.$msg_erreur_date_naissance.'&msg_erreur_telephone='.$msg_erreur_telephone.'&msg_erreur_adresse='.$msg_erreur_adresse.'&msg_erreur_mail='.$msg_erreur_mail.'&msg_erreur_confirmation_mail='.$msg_erreur_confirmation_mail.'&msg_erreur_mot_de_passe='.$msg_erreur_mot_de_passe.'&msg_erreur_confirmation_mot_de_passe='.$msg_erreur_confirmation_mot_de_passe.'"/>';
        }
        else
        {
            // Après avoir, passées toutes les vérifications, Nous allons inserez les informations dans la base de données :
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $date_naissance = $_POST['date_naissance'];
            $telephone = $_POST['telephone'];
            $adresse = $_POST['adresse'];
            $mail = $_POST['mail'];
            //Hachage du mot de passe :
            $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
            $req = " INSERT INTO utilisateur (nom, prenom, date_naissance, numero_tel, adresse, email, mdp) 
            VALUES('".$nom."','".$prenom."','".$date_naissance."','".$telephone."','".$adresse."','".$mail."','".$mot_de_passe."')";
            $rep = getBD()->query($req);

            //Après l'enregistrement des données, connexion :
            $_SESSION['utilisateur'] = array(
                "nom" => $nom, 
                "prenom" => $prenom,
                "naissance" => $date_naissance,
                "numero" => $_POST['telephone'],
                "adresse" => $adresse,
                "mail" => $mail,
            );
            echo '<meta http-equiv="Refresh" content="0; index.php?msg_success=<strong>Inscription reussi !</strong> Vous pouvez maintenant Ajouter un nouvel événement" />';
        }
    }

    //CONNEXION : 
    if( isset($_POST['connexion']) ) 
    {

        $existe_erreur = 0;
        $msg_erreur_mail = '';
        $msg_erreur_mot_de_passe = '';
        
        $mail = $_POST['mail'];
        $mot_de_passe_hach = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
        //Gestion des erreurs de saisies
        
        if( !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) || strlen($_POST['mail']) <= 0 )
        {
            $msg_erreur_mail = "L' é-mail est invalide";
            $existe_erreur = 1;
        }
        //On vérifie si l'é-mail existe déjà !
        $req = getBD()->query ('select * from utilisateur where email="'.$_POST['mail'].'"');
        $req->execute(array($mail));
        $mail_existe = $req->rowCount();
        if($mail_existe == 0)
        {
            $msg_erreur_mail = "L' é-mail n'existe pas</a>";
            $existe_erreur = 1;
        }
        //On vérifie si le mot de passse est correct
        $req = getBD()->query ('select * from utilisateur where email="'.$_POST['mail'].'"');
        $rep = $req->fetch();
        $hash = $rep['mdp'];
        
        if( strlen($_POST['mot_de_passe']) <= 0 )
        {
            $msg_erreur_mot_de_passe = 'Le mot de passe est obligatoire';
            $existe_erreur = 1;
        }
        elseif ( !password_verify($_POST['mot_de_passe'], $hash)) {
            $msg_erreur_mot_de_passe = 'Le mot de passe est incorrect';
            $existe_erreur = 1;
        }          
        if( $existe_erreur == 1 )
        {
            echo '<meta http-equiv="Refresh" content="0; login.php?mail='.$_POST['mail'].'&msg_erreur_mail='.$msg_erreur_mail.'&msg_erreur_mot_de_passe='.$msg_erreur_mot_de_passe.'"/>';
        }
        else
        {
            // Après avoir passé toutes les vérifications, connexion
            $_SESSION['utilisateur'] = array(
                "nom"       => $rep['nom'], 
                "prenom"    => $rep['prenom'],
                "naissance" => $rep['date_naissance'],
                "numero"    => $rep['numero_tel'],
                "adresse"   => $rep['adresse'],
                "mail"      => $rep['email'],
            );
            echo '<meta http-equiv="Refresh" content="0; index.php?msg_success=<strong>Connexion reussie !</strong> Vous pouvez maintenant Ajouter un nouvel événement." />';
        }
    }
    //DECONNEXION
    if( isset($_POST['deconnection']) ) 
    {
        session_destroy();
        echo '<meta http-equiv="Refresh" content="0; index.php?msg_success=<strong>Déconnexion reussie !</strong>" />';
    }
    //INSCRIPTION
    if(isset($_POST['modifier_profil'])) 
    {
        //verifions si tous les champs sont remplis
        $existe_erreur = 0;
        $msg_erreur_nom = '';
        $msg_erreur_prenom = '';
        $msg_erreur_date_naissance = '';
        $msg_erreur_telephone = '';
        $msg_erreur_adresse = '';
        $msg_erreur_mot_de_passe = '';
        $msg_erreur_confirmation_mot_de_passe = '';

        //Gestion des erreurs de saisies
        if( strlen($_POST['nom']) <= 2 || strlen($_POST['nom']) > 100  )
        {
            $msg_erreur_nom = "Le nom ne doit comporter entre 2 et 100 caractères";
            $existe_erreur = 1;
        }
        if( strlen($_POST['prenom']) <= 2 || strlen($_POST['prenom']) > 100  )
        {
            $msg_erreur_prenom = "Le prénom ne doit comporter entre 2 et 100 caractères";
            $existe_erreur = 1;
        }
        if( strlen($_POST['date_naissance']) <= 0 )
        {
            $msg_erreur_date_naissance = "La date de naissance est obligatoire";
            $existe_erreur = 1;
        }
        if( strlen($_POST['telephone']) <= 0 || !preg_match("#[0][1-9][- \.?]?([0-9][0-9][- \.?]?){4}$#", $_POST['telephone']) )
        {
            $msg_erreur_telephone = "Le numéro de téléphone doit etre au format 0XXXXXXXXX";
            $existe_erreur = 1;
        }
        if( strlen($_POST['adresse']) <= 0 )
        {
            $msg_erreur_adresse = "L'adresse est obligatoire";
            $existe_erreur = 1;
        }
        //On vérifie si le mot de passse est correct
        $req = getBD()->query ('select * from utilisateur where email="'.$_SESSION['utilisateur']['mail'].'"');
        $rep = $req->fetch();
        $hash = $rep['mdp'];

        if( strlen($_POST['mot_de_passe']) <= 4 )
        {
            $msg_erreur_mot_de_passe = 'Le mot de passe doit avoir plus de 3 caractères';
            $existe_erreur = 1;
        }
        elseif ( !password_verify($_POST['mot_de_passe'], $hash)) {
            $msg_erreur_mot_de_passe = 'Le mot de passe est incorrect';
            $existe_erreur = 1;
        }
        if( $_POST['mot_de_passe'] != $_POST['confirmation_mot_de_passe'] )
        {
            $msg_erreur_confirmation_mot_de_passe = 'Le mot de passe ne correspond pas';
            $existe_erreur = 1;
        }

        if( $existe_erreur == 1 )
        {
            echo '<meta http-equiv="Refresh" content="0; profil.php?nom='.$_POST['nom'].'&prenom='.$_POST['prenom'].'&date_naissance='.$_POST['date_naissance'].'&telephone='.$_POST['telephone'].'&adresse='.$_POST['adresse'].'&msg_erreur_nom='.$msg_erreur_nom.'&msg_erreur_prenom='.$msg_erreur_prenom.'&msg_erreur_date_naissance='.$msg_erreur_date_naissance.'&msg_erreur_telephone='.$msg_erreur_telephone.'&msg_erreur_adresse='.$msg_erreur_adresse.'&msg_erreur_mot_de_passe='.$msg_erreur_mot_de_passe.'&msg_erreur_confirmation_mot_de_passe='.$msg_erreur_confirmation_mot_de_passe.'"/>';
        }
        else
        {
            // Après avoir, passées toutes les vérifications, Nous allons mettre à jour les informations dans la base de données :
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $date_naissance = $_POST['date_naissance'];
            $telephone = $_POST['telephone'];
            $adresse = $_POST['adresse'];
            $req = " UPDATE  utilisateur SET 
            nom = '".$nom."', 
            prenom  = '".$prenom."', 
            date_naissance  = '".$date_naissance."', 
            numero_tel  = '".$telephone."', 
            adresse  = '".$adresse."'
            WHERE email = '".$_SESSION['utilisateur']['mail']."'";
            $rep = getBD()->query($req);
            //Après l'enregistrement des données, connexion :
            $_SESSION['utilisateur'] = array(
                "nom" => $nom, 
                "prenom" => $prenom,
                "naissance" => $date_naissance,
                "numero" => $_POST['telephone'],
                "adresse" => $adresse,
                "mail" => $_SESSION['utilisateur']['mail'],
            );
            echo '<meta http-equiv="Refresh" content="0; profil.php?msg_success=<strong>Profil modifié avec succès!</strong>" />';
        }
    }


?>