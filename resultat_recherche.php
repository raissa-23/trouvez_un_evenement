
<?php
{
    try
    {
        $req=" SELECT * 
        FROM evenement,adresse
        where adresse.adresse_id=evenement.adresse_id
        AND ( 0 ";
        if( $_GET['lieu'] != "" )
            $req.= 'OR adresse.adresse LIKE "%'.$_GET['lieu'].'%"';
        if( $_GET['even'] != "" )
            $req.= 'OR evenement.titre LIKE "%'.$_GET['even'].'%"';
        if( $_GET['date'] != "" )
            $req.= 'OR evenement.date_debut LIKE "%'.$_GET['date'].'%"';
        if( $_GET['heure'] != "" )
            $req.= 'or evenement.heure_debut LIKE "%'.$_GET['heure'].'%" ';
        if( $_GET['tarif'] != "" )
            $req.= 'or evenement.tarif LIKE "%'.$_GET['tarif'].'%" ';
        $req.=") GROUP by evenement.date_debut DESC";
        $rep = getBD()->query($req);
    }
    catch( Exception $e)
    {
        die ('Erreur :'.$e->getMessage());
    }
}
echo '<div class="p-2">';
$existe_resultat = 0;
while ($ligne = $rep ->fetch())
{	
    $existe_resultat = 1;
    echo '<table class="table table-bordered table-sm card mb-3" style="width: 100%;">';
        echo '<tr>';
            echo '<td colspan="2" class="text-center" style="border-top: 0px; border-left: 0px; border-right: 0px; background : #55d6aa;">';
                echo "<h5><b>".$ligne['titre']."</b></h5>";
            echo '</td>';
        echo '</tr>';
        if($ligne['information_pratique']!="")
        {
            echo '<tr>';
                echo '<td style="width: 20%; font-weight: bold;">';
                    echo 'Information pratique :';
                echo '</td>';
                echo '<td style="width: 80%;">';
                    echo $ligne['information_pratique'];
                echo '</td>';
            echo '</tr>';
        }
        if($ligne['description_even']!="")
        {
            echo '<tr>';
                echo '<td style="width: 20%; font-weight: bold;">';
                    echo 'Description de l\'événement : ';
                echo '</td>';
                echo '<td style="width: 80%;">';
                    echo $ligne['description_even'];
                echo '</td>';
            echo '</tr>';
        }
        if( $ligne['detail']!="" )
        {
            echo '<tr>';
                echo '<td style="width: 20%; font-weight: bold;">';
                    echo 'Détails :';
                echo '</td>';
                echo '<td style="width: 80%;">';
                    echo $ligne['detail'];
                echo '</td>';
            echo '</tr>';
        }
        if( $ligne['tarif']!="" )
        {
            echo '<tr>';
                echo '<td style="width: 20%; font-weight: bold; ">';
                    echo 'Tarif :';
                echo '</td>';
                echo '<td style="width: 80%;">';
                    echo $ligne['tarif'];
                echo '</td>';
            echo '</tr>';
        }
        echo '<tr>';
            echo '<td style="width: 20%; font-weight: bold;">';
                echo 'Date de l\'événement :';
            echo '</td>';
            echo '<td style="width: 80%;">';
                echo "Du ".$ligne['date_debut']." à ".$ligne['heure_debut']." au ".$ligne['date_fin']." à ".$ligne['heure_fin'];
            echo '</td>';
        echo '</tr>';
        if( $ligne['adresse']!="" || $ligne['place']!="" || $ligne['quartier']!="" || $ligne['ville']!="" || $ligne['departement'] != "" || $ligne['region'] != "")
        {
            echo '<tr>';
                echo '<td style="width: 20%; font-weight: bold; ">';
                    echo 'Lieu de l\'événement : ';
                echo '</td>';
                echo '<td style="width: 80%;">';
                    echo $ligne['adresse']." ".$ligne['place']." ".$ligne['quartier']." ".$ligne['ville']." ".$ligne['departement']." ".$ligne['region'];
                echo '</td>';
            echo '</tr>';
        }
        if( $ligne['lien']!="" )
        {
            echo '<tr>';
                echo '<td style="width: 20%; font-weight: bold; ">';
                    echo 'Pour plus d\'informations : ';
                echo '</td>';
                echo '<td style="width: 80%;">';
                    echo "<a href='".$ligne['lien']."' >".$ligne['lien']."</a>";
                echo '</td>';
            echo '</tr>';
        }
    echo '</table>';
}
if( $existe_resultat == 0 )
{
    print '<i class="fas fa-times"></i>  <i>-- Pas de résulat --<i>';
}
echo "</div>";
?>