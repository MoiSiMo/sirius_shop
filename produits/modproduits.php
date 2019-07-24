<?php
/*



*/

/* On authorise les requêtes provenant de n'importe quel origine  */
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

$param=["NumProd","NumFour", "NomProd", "NumSCat", "QtProd", "QtMinProd"];
for($i=0;  $i< count($param); $i++)
{
    $parami=$param[$i];
    if(!isset($_REQUEST[$parami]) || empty($_REQUEST[$parami]) || !is_numeric($_REQUEST[$parami]))
  {
      $response["error_message"] = "Erreur paramètre";
      echo json_encode($response);
      die();
  }
}




$NumProd = $_REQUEST["NumProd"];
$NumFour = $_REQUEST["NumFour"];
$NomProd = $_REQUEST["NomProd"];
$NumSCat = $_REQUEST["NumSCat"];
$QtProd = $_REQUEST["QtProd"];
$QtMinProd = $_REQUEST["QtMinProd"];


/* Requête : on récupère le premier résultat dans studebts*/
$sth = $bdd->prepare('UPDATE t_produits SET NumFour=[:NumFour],NomProd=[:NomProd],NumSCat=[:NomProd],QtProd=[:NomProd],QtMinProd=[:NomProd] WHERE NumProd = :NumProd;');
$sth->bindValue(":NumProd", $NumProds, PDO::PARAM_INT);
$sth->bindValue(":NumFour", $NumFour, PDO::PARAM_INT);
$sth->bindValue(":NomProd", $NomProd, PDO::PARAM_STR);
$sth->bindValue(":NumSCat", $NumSCat, PDO::PARAM_INT);
$sth->bindValue(":QtProd", $QtProd, PDO::PARAM_INT);
$sth->bindValue(":QtMinProd", $QtMinProd, PDO::PARAM_INT);
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