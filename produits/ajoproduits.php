<?php
require "../library/cors.php";
require "../library/connexiondb.php";
cors();

header('Content-Type: application/json');

/* Réponse par défaut*/
$response = [
    "error"         => true,
    "error_message" => "unknown Error",
    "data"          => NULL
];
//on vérifie si les données existe
if(isset($_REQUEST["NumFour"]) && isset($_REQUEST["NomProd"])&& isset($_REQUEST["NumSCat"]))

{
// on récupere les données
    $NomProd = $_REQUEST["NomProd"];
    $NumFour = $_REQUEST["NumFour"];
    $NumSCat = $_REQUEST["NumSCat"];
// on insere les produits dans la table  

$sql_Inserer_produits = " INSERT INTO t_produits 
(NumFour, NomProd, NumSCat) VALUES (?,?,?)";

// on prepare la requete    

$request1 = $bdd->prepare($sql_Inserer_produits);

    $request1->bindParam(1, $NumFour, PDO::PARAM_INT);
    $request1->bindParam(2, $NomProd, PDO::PARAM_STR);
    $request1->bindParam(3, $NumSCat, PDO::PARAM_INT);
  //on execute la requete  
    $request1->execute();

    $data = "ok";
    $response["data"] = $data;
    $response["error_message"] = "";
    $response["error"] = false;
    $response["msg"]="données enregistré";   

    //on encode le php par json 
    $json=json_encode($response);

    // on  affiche le json    
    echo $json;

    die();

    }  else {
        $response["error_message"] = "pas de données";
    }
?>
