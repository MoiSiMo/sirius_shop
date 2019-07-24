<?php
require "../library/cors.php";
require "../library/connexiondb.php";
cors();

header('Content-Type: application/json');

$reponse = [
    "error"         => true,
    "error_message" => "unknown Error",
    "data"          => NULL
];

if(!isset($_REQUEST["NumProd"]) && isset($_REQUEST["NumFour"]) && isset($_REQUEST["NomProd"])&& isset($_REQUEST["NumSCat"]))
{
    $reponse["error_message"] = "Erreur paramètre";
    echo json_encode($reponse);
    die();
}
else{
    $NomProd = $_REQUEST["NomProd"];
    $NumProd = $_REQUEST["NumProd"];
    $NumFour = $_REQUEST["NumFour"];
    $NumSCat = $_REQUEST["NumSCat"];
}
$sql_Inserer_produits = "INSERT INTO produits (NumProd,NumFour,NomProd,NumSCat)VALUES (?,?,?,?)";
    $request1 = $bdd->prepare($sql_Inserer_produits);
    $request1->bindParam(1, $NumProd, PDO::PARAM_INT);
    $request1->bindParam(2, $NumFour, PDO::PARAM_INT);
    $request1->bindParam(3, $NomProd, PDO::PARAM_STR);
    $request1->bindParam(3, $NumSCat, PDO::PARAM_STR);
    
    $stt=$request1->execute();

    if($stt)

        {
            $data = "ok";
            $reponse["data"] = $data;
            $reponse["error_message"] = "";
            $reponse["error"] = false;
        }
        else
        {
            $reponse["error_message"] = "ERROR QUERY";
        }
        
        
        $sth->closeCursor();
        echo json_encode($reponse);
        die();
    
?>
