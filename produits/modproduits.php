<?php
/*



*/

/* On authorise les requêtes provenant de n'importe quel origine  */
require "../libs/cors.php";
require "../libs/connexiondb.php";
cors();

/* On spécifie que le document généré doit être au format json */
header('Content-Type: application/json');

/* Réponse par défaut*/
$response = [
    "error"         => true,
    "error_message" => "Uknown Error",
    "data"          => NULL
];

if(!isset($_REQUEST[""]) || empty($_REQUEST["id_computers"]) || !is_numeric($_REQUEST["id_computers"]))
{
    $response["error_message"] = "Erreur paramètre";
    echo json_encode($response);
    die();
}

$id_computers = $_REQUEST["id_computers"];

/* Requête : on récupère le premier résultat dans studebts*/
$sth = $bdd->prepare('DELETE FROM computers WHERE id_computers = :id_computers');
$sth->bindValue(":id_computers", $id_computers, PDO::PARAM_INT);
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