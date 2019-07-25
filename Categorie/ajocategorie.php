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

if(isset($_REQUEST["NomCat"]))

{
        // on récupere les données
            
            $NomSCat = $_REQUEST["NomCat"];
            
            
        // on insere les produits dans la table  
        try
        {
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql_Inserer_produits="INSERT INTO t_categories (NomCat) VALUES (?)";

        // on prepare la requete    

        $request1 = $bdd->prepare($sql_Inserer_produits);

            
            $request1->bindParam(1, $NomSCat, PDO::PARAM_STR);

           
        //on execute la requete  
            $request1->execute();

            $data = "ok";
            $response["data"] = $data;
            $response["error_message"] = "";
            $response["error"] = false;
            $response["msg"]="données enregistré";  
}
catch(Exception $e){
    $response["error_message"] = "erreur de données";
    $response["error"] = true;
}
            
} 
else 
{
$response["error_message"] = "pas de parametre";
}
$json=json_encode($response);

// on  affiche le json    
echo $json;
