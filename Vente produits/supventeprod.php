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

if(!isset($_REQUEST["NumVenProd"]) || empty($_REQUEST["NumVenProd"]) || !is_numeric($_REQUEST["NumVenProd"]))
{
    $response["error_message"] = "Erreur paramètre";
    echo json_encode($response);
    die();
}

$NumVenProd = $_REQUEST["NumVenProd"];

/* Requête : on récupère le premier résultat dans studebts*/
$sth = $bdd->prepare('DELETE FROM t_ventesproduits WHERE NumVenProd = :NumVenProd');
$sth->bindValue(":NumVenProd", $NumVenProd, PDO::PARAM_INT);
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