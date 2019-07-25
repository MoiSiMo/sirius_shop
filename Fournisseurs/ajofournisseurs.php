<?php
//On authorise les requêtes provenant de n'importe quel origine 
require "../library/cors.php";
require "../library/connexiondb.php";
cors();
/* On spécifie que le document généré doit être au format json */
header('Content-Type: application/json');

/* Réponse par défaut*/
$response = [
    "error"         => true,
    "error_message" => "Uknown Error",
    "data"          => NULL
];

$param=["NomFour", "AdrFour", "CdePostFour", "VilleFour", "TelFixFour", "TelFixFour2", "FaxFour", "EmailFour", "SiteFour"];
for($i=0;  $i< count($param); $i++)
{
    $parami=$param[$i];
    if(!isset($_REQUEST[$parami]) || empty($_REQUEST[$parami]) )
  {
      $response["error_message"] = "Erreur paramètre: ".$parami;
      echo json_encode($response);
      die();
  }
}
        // on récupere les données
        
        $NomFour = $_REQUEST["NomFour"];
        $AdrFour = $_REQUEST["AdrFour"];
        $CdePostFour = $_REQUEST["CdePostFour"];
        $VilleFour = $_REQUEST["VilleFour"];
        $TelFixFour = $_REQUEST["TelFixFour"];
        $TelFixFour2 = $_REQUEST["TelFixFour2"];
        $FaxFour = $_REQUEST["FaxFour"];
        $EmailFour = $_REQUEST["EmailFour"];
        $SiteFour = $_REQUEST["SiteFour"];
        
        $sth = $bdd->prepare('INSERT INTO `t_fournisseurs` ("NomFour", "AdrFour", "CdePostFour", "VilleFour", "TelFixFour", "TelFixFour2", "FaxFour", "EmailFour", "SiteFour") VALUES (":NomFour", ":AdrFour", ":CdePostFour", ":VilleFour", ":TelFixFour", ":TelFixFour2", ":FaxFour", ":EmailFour", ":SiteFour");');
        
        $sth->bindValue(":NomFour", $NomFour, PDO::PARAM_STR);
        $sth->bindValue(":AdrFour", $AdrFour, PDO::PARAM_STR);
        $sth->bindValue(":CdePostFour", $CdePostFour, PDO::PARAM_INT);
        $sth->bindValue(":VilleFour", $VilleFour, PDO::PARAM_STR);
        $sth->bindValue(":TelFixFour", $TelFixFour, PDO::PARAM_STR);
        $sth->bindValue(":TelFixFour2", $TelFixFour2, PDO::PARAM_STR);
        $sth->bindValue(":FaxFour", $FaxFour, PDO::PARAM_STR);
        $sth->bindValue(":EmailFour", $EmailFour, PDO::PARAM_STR);
        $sth->bindValue(":SiteFour", $SiteFour, PDO::PARAM_STR);
        $result = $sth->execute();

        if($result)
        {
            $data = "ok";
            $response["data"] = $data;
            $response["error_message"] = "";
            $response["error"] = false;
        }
        else
        {
            $response["error_message"] = "ERROR QUERY";
        }
        $sth->closeCursor();
        echo json_encode($response);
        die();