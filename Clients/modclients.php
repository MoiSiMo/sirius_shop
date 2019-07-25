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

$param=["NumCli", "NomCli", "AdrCli", "VilleCli", "CdePosCli", "TelFixCli", "TelPorCli", "NumTVA", "EmailCli", "FaxCli"];
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

$NomCli = $_REQUEST["NomCli"];
$AdrCli = $_REQUEST["AdrCli"];
$VilleCli = $_REQUEST["VilleCli"];
$CdePosCli = $_REQUEST["CdePosCli"];
$TelFixCli = $_REQUEST["TelFixCli"];
$TelPorCli = $_REQUEST["TelPorCli"];
$NumTVA = $_REQUEST["NumTVA"];
$EmailCli = $_REQUEST["EmailCli"];
$FaxCli = $_REQUEST["FaxCli"];


/* Requête : on récupère le premier résultat dans studebts*/
$sth = $bdd->prepare('UPDATE t_clients SET NomCli=:NomCli, AdrCli=:AdrCli, VilleCli=:VilleCli, CdePosCli=:CdePosCli, TelFixCli=:TelFixCli, TelPorCli=:TelPorCli, NumTVA=:NumTVA, EmailCli=:EmailCli, FaxCli=:FaxCli WHERE NumCli = :NumCli;');
$sth->bindValue(":NomCli", $NomCli, PDO::PARAM_STR);
$sth->bindValue(":AdrCli", $AdrCli, PDO::PARAM_STR);
$sth->bindValue(":VilleCli", $VilleCli, PDO::PARAM_STR);
$sth->bindValue(":CdePosCli", $CdePosCli, PDO::PARAM_STR);
$sth->bindValue(":TelFixCli", $TelFixCli, PDO::PARAM_STR);
$sth->bindValue(":TelPorCli", $TelPorCli, PDO::PARAM_STR);
$sth->bindValue(":NumTVA", $NumTVA, PDO::PARAM_STR);
$sth->bindValue(":EmailCli", $EmailCli, PDO::PARAM_STR);
$sth->bindValue(":FaxCli", $FaxCli, PDO::PARAM_STR);
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