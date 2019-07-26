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

$param=["NumVenProd","NumLisFact", "NumProd", "NumCli", "NumAchProd", "PrixVenUnit", "TauxTva", "QteVen"];
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
            
            $NumVenProd = $_REQUEST["NumVenProd"];
            $NumLisFact = $_REQUEST["NumLisFact"];
            $NumProd = $_REQUEST["NumProd"];
            $NumCli = $_REQUEST["NumCli"];
            $NumAchProd = $_REQUEST["NumAchProd"];
            $PrixVenUnit = $_REQUEST["PrixVenUnit"];
            $TauxTva = $_REQUEST["TauxTva"];
            $QteVen = $_REQUEST["QteVen"];


/* Requête : on récupère le premier résultat dans studebts*/
$sth = $bdd->prepare('UPDATE t_ventesproduits SET NumLisFact=:NumLisFact, NumProd=:NumProd, NumCli=:NumCli, NumAchProd=:NumAchProd, PrixVenUnit=:PrixVenUnit, TauxTva=:TauxTva, QteVen=:QteVen WHERE NumLisFact = :NumLisFact;');
$sth->bindValue(":NumVenProd", $NumVenProd, PDO::PARAM_INT);
$sth->bindValue(":NumLisFact", $NumLisFact, PDO::PARAM_INT);
$sth->bindValue(":NumProd", $NumProd, PDO::PARAM_INT);
$sth->bindValue(":NumCli", $NumCli, PDO::PARAM_INT);
$sth->bindValue(":NumAchProd", $NumAchProd, PDO::PARAM_INT);
$sth->bindValue(":PrixVenUnit", $PrixVenUnit, PDO::PARAM_INT);
$sth->bindValue(":TauxTva", $TauxTva, PDO::PARAM_INT);
$sth->bindValue(":QteVen", $QteVen, PDO::PARAM_INT);

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