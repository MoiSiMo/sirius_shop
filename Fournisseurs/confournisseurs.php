<?php

/* On ajoute la finction cors qui permet le cross-origin */
/* pour authoriser l'appel du fichier entre backend et frontend*/
require "../library/cors.php";
/* connexion à la db */
require "../library/connexiondb.php";

/*on appelle la fonction cors*/
cors();

/* on a ajouté le type du fichier */
header('Content-Type: application/json');

/* Réponse par défaut
$response = [
    "error"         => true,
    "error_message" => "unknown Error",
    "data"          => NULL
];*/

if(!isset($_REQUEST["NumFour"]) || empty($_REQUEST["NumFour"]) || !is_numeric($_REQUEST["NumFour"]))
{
    $response["error_message"] = "Erreur paramètre";
    echo json_encode($response);
    die();
}

$NumFour = $_REQUEST["NumFour"];

/* Requête : on récupère le résultat d'afficher dans produits*/
$sth = $bdd->prepare('SELECT * FROM t_fournisseurs WHERE NumFour =:NumFour');
$sth->bindValue(":NumFour", $NumFour, PDO::PARAM_INT);
$result = $sth->execute();

if($result && $sth->rowCount()> 0)
{
    $item = $sth->fetchAll(PDO::FETCH_ASSOC);
    $response["data"] = $item;
    $response["error"] = false;
}
else
{
    $response["error_message"] = "L'entrée $NumFour n'a pas été trouvée !";
}

$sth->closeCursor();
   

/* On affiche le tableau après l'avoir encodé au format json */
/* Par définition, JSON est un format d'échange de données 
(data interchange format).*/
echo json_encode($response);

/* on termine l'execution du script */
die();