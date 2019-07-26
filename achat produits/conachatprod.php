<?php

/* On ajoute la finction cors qui permet le cross-origin */
/* pour authoriser l'appel du fichier entre backend et frontend*/
require "../library/cors.php";
/*on appelle la fonction cors*/
cors();

/* connexion à la db */
require "../library/connexiondb.php";

/* on a ajouté le type du fichier */
header('Content-Type: application/json');

/* Réponse par défaut
$response = [
    "error"         => true,
    "error_message" => "unknown Error",
    "data"          => NULL
];*/

if(!isset($_REQUEST["NumAchProd"]) || empty($_REQUEST["NumAchProd"]) || !is_numeric($_REQUEST["NumAchProd"]))
{
    $response["error_message"] = "Erreur paramètre";
    echo json_encode($response);
    die();
}

$NumAchProd = $_REQUEST["NumAchProd"];

/* Requête : on récupère le résultat d'afficher dans produits*/
$sth = $bdd->prepare('SELECT * FROM t_achatsproduits WHERE NumAchProd = :NumAchProd');
$sth->bindValue(":NumAchProd", $NumAchProd, PDO::PARAM_INT);
$result = $sth->execute();

if($result && $sth->rowCount()> 0)
{
    $item = $sth->fetchAll(PDO::FETCH_ASSOC);
    $response["data"] = $item;
    $response["error"] = false;
}
else
{
    $response["error_message"] = "L'entrée $NumAchProd n'a pas été trouvée !";
}

$sth->closeCursor();
   

/* On affiche le tableau après l'avoir encodé au format json */
/* Par définition, JSON est un format d'échange de données 
(data interchange format).*/
echo json_encode($response);

/* on termine l'execution du script */
die();

?>