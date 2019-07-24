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

$NomFour = $_REQUEST["NomFour"];
$AdrFour = $_REQUEST["AdrFour"];
$CdePostFour = $_REQUEST["CdePostFour"];
$VilleFour = $_REQUEST["VilleFour"];
$TelFixFour = $_REQUEST["TelFixFour"];
$TelFixFour2 = $_REQUEST["TelFixFour2"];
$FaxFour = $_REQUEST["FaxFour"];
$EmailFour = $_REQUEST["EmailFour"];
$SiteFour = $_REQUEST["SiteFour"];


/* Requête : on récupère le premier résultat dans studebts*/
$sth = $bdd->prepare('UPDATE t_produits SET NumFour=:NumFour, NomProd=:NomProd, NumSCat=:NumSCat, QtProd=:QtProd, QtMinProd=:QtMinProd WHERE NumProd = :NumProd;');
$sth->bindValue(":NomFour", $NomFour, PDO::PARAM_INT);
$sth->bindValue(":AdrFour", $AdrFour, PDO::PARAM_INT);
$sth->bindValue(":CdePostFour", $CdePostFour, PDO::PARAM_STR);
$sth->bindValue(":VilleFour", $VilleFour, PDO::PARAM_INT);
$sth->bindValue(":TelFixFour", $TelFixFour, PDO::PARAM_INT);
$sth->bindValue(":TelFixFour2", $TelFixFour2, PDO::PARAM_INT);
$sth->bindValue(":FaxFour", $FaxFour, PDO::PARAM_INT);
$sth->bindValue(":EmailFour", $EmailFour, PDO::PARAM_INT);
$sth->bindValue(":SiteFour", $SiteFour, PDO::PARAM_INT);
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
   

/* On affiche le tableau après l'avoir encodé au format json */
/* Par définition, JSON est un format d'échange de données 
(data interchange format).*/
echo json_encode($response);

/* on termine l'execution du script */
die();