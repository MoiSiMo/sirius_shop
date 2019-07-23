<?php

/* On authorise les requêtes provenant de n'importe quel origine  */
require "../libs/cors.php";
require "../libs/connexiondb.php";
cors();

/* On spécifie que le document généré doit être au format json */
header('Content-Type: application/json');

/* Réponse par défaut*/
$response = [
    "error"         => true,
    "error_message" => "unknown Error",
    "data"          => NULL
];

if(!isset($_REQUEST["id_produits"]) || empty($_REQUEST["id_produits"]) || !is_numeric($_REQUEST["id_produits"]))
{
    $response["error_message"] = "Erreur paramètre";
    echo json_encode($response);
    die();
}

$id_computers = $_REQUEST["id_produits"];

/* Requête : on récupère le résultat d'effacer dans produits*/
$sth = $bdd->prepare('DELETE FROM produits WHERE id_produits = :id_produits');
$sth->bindValue(":id_produits", $id_produits, PDO::PARAM_INT);
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
