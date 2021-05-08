<?php
    $page="geolocalisation";
    require ('header.php');
?>
<title>Carte géographique</title>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<style>
    h2
    {
    color:red;
    padding-left:30px;
    font-style: italic;
    font-variant: small-caps;
    font-size: 25px;
    }
    .containeur_carte
    {
        width:50%;
        margin-left:auto;
        margin-right:auto;
    }
</style>
<style type="text/css">
    /* Always set the map height explicitly to define the size of the div
    * element that contains the map. */
    #map {
        height: 100%;
    }
</style>
<?php
$date_debut =  "2021-01-01";
$date_fin = "2021-12-31";
if(isset($_GET['date_debut']))
{
    $date_debut = $_GET['date_debut'];
}
if(isset($_GET['date_fin']))
{
    $date_fin = $_GET['date_fin'];
}
//On recupère l'ensemble des événement dans [date_debut; date_fin].
$req=" SELECT * FROM evenement,adresse
        where adresse.adresse_id=evenement.adresse_id 
        AND evenement.date_debut >= '".$date_debut."' AND evenement.date_fin <= '".$date_fin."'";    
$rep = getBD()->query($req);
?>
 
<script>
    const citymap = {
        <?php 
            while ($ligne = $rep->fetch())
            {
                if( isset($ligne['latlon']) )
                {
                    //on recupère la lagitude et la lngitude grace à la fonction explode : on scinde la chaine de caractère par la virgule.
                    $lat = explode(",",$ligne['latlon'])[0];
                    $lng = explode(",",$ligne['latlon'])[1];
                    //on remplace tous les " par des \" pour échaper à l'erreur des guillemets
                    $titre = str_replace('"','\"' ,$ligne['titre']);
                    $tarif = '';
                    if( $ligne['tarif'] != '' ) 
                        $tarif = '<br><b>Tarif : </b>'.$ligne['tarif'];

                    //Convertit les date au jourmat JJ-MM-AAA  et les heure au format H:min
                    $date_d = date_create($ligne['date_debut']);
                    $date_d = date_format($date_d, 'd-m-Y');
                    $date_f = date_create($ligne['date_fin']);
                    $date_f = date_format($date_f, 'd-m-Y');
                    $heure_d = date_create($ligne['heure_debut']);
                    $heure_d = date_format($heure_d, 'H:i');
                    $heure_f = date_create($ligne['heure_fin']);
                    $heure_f = date_format($heure_f, 'H:i');

                    $debut_evenement = "<br>Du ".$date_d." à ".$heure_d;
                    $fin_evenement = " au ".$date_f." à ".$heure_f;

                    echo $ligne['evenement_id'].": {"; 
                        echo "center : { lat: ".$lat.", lng: ".$lng." }, ";
                        echo "population: 0.01, ";
                        echo 'nom_evenement : "'.$titre.$tarif.$debut_evenement.$fin_evenement.'"';
                    echo '},';
                }
            }
        ?>
    };
    //visite guidée
    function initMap() {
        // Create the map.
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            //Cordonnées de montpellier
            center: { lat: 43.60919500851944, lng: 3.876221984863304},
            mapTypeId: "terrain",
        });

        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
          });

        infoWindow.open(map);
      
        // Construct the circle for each value in citymap.
        // Note: We scale the area of the circle based on the population.
        for (const city in citymap) {
            // Add the circle for this city to the map.
            const cityCircle = new google.maps.Circle({
                strokeColor: "#FF0000",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#FF0000",
                fillOpacity: 0.35,
                map,
                center: citymap[city].center,
                radius: Math.sqrt(citymap[city].population) * 100,
            });

            google.maps.event.addListener(cityCircle, 'click', function(ev)
            {
                infoWindow.setPosition(cityCircle.getCenter());
                infoWindow.setContent(citymap[city].nom_evenement);
                infoWindow.open(map);
            });
        }
    }
</script>


<div class="col-lg-8 ml-auto mr-auto container mt-5" style="">
    <div class="card border-danger">
        <div class="card-header bg-danger text-white text-center" style="width: 100%;">
            <h5><b>Consultez la carte géographique !</b></h5>
        </div> 
        <div class="card-body">
            <form method="GET" action="">
                <table style="width: 100%;">
                    <tr>
                        <td class="p-2">Date de début : <br>
                            <input class="form-control" type="date" name="date_debut" value="<?php echo $date_debut; ?>">
                        </td>
                        <td class="p-2">Date de fin : <br>
                            <input class="form-control" type="date" name="date_fin" value="<?php echo $date_fin; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-2">
                            <button type="submit" class="btn-primary btn" style="margin-top: 10px;">Afficher les événements</button>
                        </td>
                    </tr>
                </table>
                <hr>
            </form>
            <!-- Div qui va cintenir la carte -->
            <div id="map" style=" height: 500px; margin-right: auto; margin-left: auto;"></div>
        </div>
    </div>
</div>
        
<?php   
    require ('footer.php');
?>
<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDID5H251Cv_Er7T0nWUCyasXCGSYUzoUA&callback=initMap&libraries=&v=weekly"
async
></script>
<!--https://developers.google.com/maps/documentation/javascript/examples/marker-simple-->


    
   
