<?php
//On authorise les requêtes provenant de n'importe quel origine 
require "../library/cors.php";
require "../library/connexiondb.php";
cors();

/* On spécifie que le document généré doit être au format json */
header('Content-Type: application/json');

/* Réponse par défaut
$response = [
    "error"         => true,
    "error_message" => "Uknown Error",
    "data"          => NULL
];*/

$param=["NumAchProd", "NumProd", "QteAch", "PrixUnitAch"];
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
$NumAchProd = $_REQUEST["NumAchProd"];
$NumProd = $_REQUEST["NumProd"];
$QteAch = $_REQUEST["QteAch"];
$PrixUnitAch = $_REQUEST["PrixUnitAch"];


/* Requête : on récupère le premier résultat dans studebts*/
$sth = $bdd->prepare('UPDATE `t_achatsproduits` SET NumProd=:NumProd, QteAch=:QteAch, PrixUnitAch=:PrixUnitAch WHERE NumAchProd = :NumAchProd;');
$sth->bindValue(":NumAchProd", $NumAchProd, PDO::PARAM_INT);
$sth->bindValue(":NumProd", $NumProd, PDO::PARAM_INT);
$sth->bindValue(":QteAch", $QteAch, PDO::PARAM_INT);
$sth->bindValue(":PrixUnitAch", $PrixUnitAch, PDO::PARAM_INT);

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