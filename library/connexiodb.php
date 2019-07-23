<?php
require "../libs/cors.php";
require "../libs/connectiondb.php";
cors();
/* on a ajouté le type du fichier */
header('Content-Type: application/json');


//partie sql

$sql="SELECT first_name,last_name FROM `students`WHERE id_students=1";
$reponse=$bdd->prepare($sql);
$reponse->execute();
if($reponse->rowCount()== 0)
        {
            $erreur="Pas d'infos disponibles";
        }
        else
        {
         while($row = $reponse->fetch())
            {
                $first_name= $row["first_name"];
                $last_name= $row["last_name"]; 
            }
           $reponse = [
            "error"         => false,
            "error_message" => "",
            "data"          => [$first_name,$last_name]
        ];
/* on vonvertir en json le tableau et on l'affiche */
        echo json_encode($reponse);
die();
        }
?>