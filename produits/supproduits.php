<?php
/* On authorise les requêtes provenant de n'importe quel origine  */
require "../library/cors.php";
require "../library/connexiondb.php";
cors();

/* On spécifie que le document généré doit être au format json */
header('Content-Type: application/json');

/* Réponse par défaut*/
$response = [
    "error"         => true,
    "error_message" => "unknown Error",
    "data"          => NULL,
];

if(!isset($_REQUEST["NumProd"]) || empty($_REQUEST["NumProd"]) || !is_numeric($_REQUEST["NumProd"]))
{
    $response["error_message"] = "Erreur paramètre";
    echo json_encode($response);
    die();
}

$NumProd = $_REQUEST["NumProd"];

/* Requête : on récupère le premier résultat dans studebts*/
$sth = $bdd->prepare('DELETE NumProd, NumFour, NomProd , NumSCat, QtProd, QtMinProd FROM t_produits WHERE NumProd = :NumProd');
$sth->bindValue(":NumProd", $NumProd, PDO::PARAM_INT);
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
?>