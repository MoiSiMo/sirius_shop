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

$param=["NomSCat", "NumCat"];
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

$NomSCat = $_REQUEST["NomSCat"];
$NumCat = $_REQUEST["NumCat"];



/* Requête : on récupère le premier résultat dans studebts*/
$sth = $bdd->prepare('UPDATE t_s_categories SET NomSCat=:NomSCat, NumCat=:NumCat WHERE NumSCat = :NumSCat;');
$sth->bindValue(":NomSCat", $NomSCat, PDO::PARAM_STR);
$sth->bindValue(":NumCat", $NumCat, PDO::PARAM_STR);

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