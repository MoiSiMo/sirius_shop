<?php

/* On authorise les requêtes provenant de n'importe quel origine  */
require "../library/cors.php";
require "../library/connexiondb.php";
cors();

/* On spécifie que le document généré doit être au format json */
header('Content-Type: application/json');

/* Réponse par défaut
$response = [
    "error"         => true,
    "error_message" => "unknown Error",
    "data"          => NULL 
];*/
if(!isset($_REQUEST["NumProd"]) || empty($_REQUEST["NumProd"]) || !is_numeric($_REQUEST["NumProd"]))
{
    $response["error_message"] = "Erreur paramètre";
    echo json_encode($response);
    die();
}

 $NumProd = $_REQUEST["NumProd"];

 
/* Requête : on récupère le résultat d'afficher dans produits*/

$sth = $bdd->prepare('SELECT NumProd, NomProd , NumSCat, NumFour QtProd, QtMinProd FROM t_produits WHERE NumProd =:NumProd');

$sth->bindValue(":NumProd", $NumProd, PDO::PARAM_INT);

$result = $sth->execute();

if($result && $sth->rowCount()> 0)
{
    $item = $sth->fetch(PDO::FETCH_ASSOC);
    $response["data"] = $item;
    $response["error"] = false;
}
else
{
    $response["error_message"] = "L'entrée $NumProd n'a pas été trouvée !";
}

$sth->closeCursor();
   

/* On affiche le tableau après l'avoir encodé au format json */
/* Par définition, JSON est un format d'échange de données 
(data interchange format).*/
echo json_encode($response);

/* on termine l'execution du script */
die();

?> 