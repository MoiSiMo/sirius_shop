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
if(isset($_REQUEST["NumCat"]) || empty($_REQUEST["NumCat"]))
{
        // on récupere les données
            $NomCat = $_REQUEST["NomCat"];
    
        // on insere les produits dans la table  

        $sql_Inserer_produits="INSERT INTO t_categories (NomCat) VALUES (?)";
        // on prepare la requete    

        $request1 = $bdd->prepare($sql_Inserer_produits);

            $request1->bindParam(1, $NomCat, PDO::PARAM_SRT);
            
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

}  
else 
{
    $response["error_message"] = "pas de données";
}
?>
