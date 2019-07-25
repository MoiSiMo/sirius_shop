<?php
//On authorise les requêtes provenant de n'importe quel origine 
require "../library/cors.php";
require "../library/connexiondb.php";
cors();
/* On spécifie que le document généré doit être au format json */
header('Content-Type: application/json');

/* Réponse par défaut*/
$response = [
    "error"         => true,
    "error_message" => "Uknown Error",
    "data"          => NULL
];

$param=["NomSCat", "NumCat"];
for($i=0;  $i< count($param); $i++)
{
    $parami=$param[$i];
    if(!isset($_REQUEST[$parami]) || empty($_REQUEST[$parami]) )
  {
      $response["error_message"] = "Erreur paramètre: ".$parami;
      echo json_encode($response);
      die();
  }
}
        // on récupere les données
            $NomSCat = $_REQUEST["NomSCat"];
            $NumCat = $_REQUEST["NumCat"];
            
        
        $sth = $bdd->prepare('INSERT INTO `t_s_categories` ("NomSCat", "NumCat") VALUES (":NomCli", ":AdrCli")');
        $sth->bindValue(":NomSCat", $NomSCat, PDO::PARAM_STR);
        $sth->bindValue(":NumCat", $NumCat, PDO::PARAM_STR);
        
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
        echo json_encode($response);
        die();