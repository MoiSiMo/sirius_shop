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
if(isset($_REQUEST["NomCli"]) && isset($_REQUEST["PreCli"]) && isset($_REQUEST["VilleCli"]) && isset($_REQUEST["CdePosCli"]) && isset($_REQUEST["TelFixCli"])&& isset($_REQUEST["TelPorCli"]))

{
        // on récupere les données
            $NomCli = $_REQUEST["NomCli"];
            $PreCli = $_REQUEST["PreCli"];
            $VilleCli = $_REQUEST["VilleCli"];
            $CdePosCli = $_REQUEST["CdePosCli"];
            $TelFixCli = $_REQUEST["TelFixCli"];
            $TelPorCli = $_REQUEST["TelPorCli"];
        // on insere les produits dans la table  

        $sql_Inserer_produits="INSERT INTO t_produits (NomCli, PreCli, VilleCli, CdePosCli, TelFixCli, TelPorCli ) VALUES (?,?,?,?,?)";

        // on prepare la requete    

        $request1 = $bdd->prepare($sql_Inserer_produits);

            $request1->bindParam(1, $NumFour, PDO::PARAM_INT);
            $request1->bindParam(2, $NomProd, PDO::PARAM_STR);
            $request1->bindParam(3, $NumSCat, PDO::PARAM_INT);
            $request1->bindParam(4, $QtProd, PDO::PARAM_INT);
            $request1->bindParam(5, $QtMinProd, PDO::PARAM_INT);
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
