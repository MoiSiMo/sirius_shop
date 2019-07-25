    <?php

    require "../library/cors.php";
    require "../library/connexiondb.php";
    cors();
    header('Content-Type: application/json');
    /* Réponse par défaut*/
    $response = [
        "error"         => true,
        "error_message" => "unknown Error",
        "data"          => ""
    ];
    //on vérifie si les données existe
    if(isset($_REQUEST["NumFour"]) && isset($_REQUEST["NomProd"])&& 
    isset($_REQUEST["NumSCat"]) && isset($_REQUEST["QtProd"])&& 
    isset($_REQUEST["QtMinProd"]))
    {
            // on récupere les données
                $NumFour = $_REQUEST["NumFour"];
                $NomProd = $_REQUEST["NomProd"];
                $NumSCat = $_REQUEST["NumSCat"];
                $QtProd = $_REQUEST["QtProd"];
                $QtMinProd = $_REQUEST["QtMinProd"];
            // on insere les produits dans la table 
            
            //var_dump($_REQUEST);

        

                try{
                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql_Inserer_produits="INSERT INTO t_produits (NumFour, NomProd, NumSCat, QtProd, QtMinProd) VALUES (?,?,?,?,?)";

                    // on prepare la requete    
            
                    $request1 = $bdd->prepare($sql_Inserer_produits);
            
                        $request1->bindParam(1, $NumFour, PDO::PARAM_INT);
                        $request1->bindParam(2, $NomProd, PDO::PARAM_STR);
                        $request1->bindParam(3, $NumSCat, PDO::PARAM_INT);
                        $request1->bindParam(4 , $QtProd, PDO::PARAM_INT);
                        $request1->bindParam(5, $QtMinProd, PDO::PARAM_INT);
                    //on execute la requete  
                        $request1->execute();

                    $data = "ok";
                    $response["data"] = $data;
                    $response["error_message"] = "";
                    $response["error"] = false;
                    $response["msg"]="données enregistré"; 
                }
                catch(Exception $e){
                    $response["error_message"] = "erreur de données: " . $e->getMessage();
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
