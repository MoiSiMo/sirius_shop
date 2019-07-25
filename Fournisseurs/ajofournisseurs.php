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

    if(isset($_REQUEST["NomFour"]) && isset($_REQUEST["AdrFour"])&& 
        isset($_REQUEST["CdePostFour"]) && isset($_REQUEST["VilleFour"])&& 
        isset($_REQUEST["TelFixFour"])&&isset($_REQUEST["TelFixFour2"])&&
        isset($_REQUEST["FaxFour"])&&isset($_REQUEST["EmailFour"])
        &&isset($_REQUEST["SiteFour"]))
        {
            // on récupere les données
            $NomFour = $_REQUEST["NomFour"];
            $AdrFour = $_REQUEST["AdrFour"];
            $CdePostFour = $_REQUEST["CdePostFour"];
            $VilleFour = $_REQUEST["VilleFour"];
            $TelFixFour = $_REQUEST["TelFixFour"];
            $TelFixFour2 = $_REQUEST["TelFixFour2"];
            $FaxFour = $_REQUEST["FaxFour"];
            $EmailFour = $_REQUEST["EmailFour"];
            $SiteFour = $_REQUEST["SiteFour"];
            
            try{
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql="INSERT INTO `t_fournisseurs`(NomFour, AdrFour, CdePostFour, VilleFour,TelFixFour,TelFixFour2,FaxFour,EmailFour, SiteFour) VALUES (?,?,?,?,?,?,?,?,?)";
                $sth = $bdd->prepare($sql);

                $sth->bindValue(1, $NomFour, PDO::PARAM_STR);
                $sth->bindValue(2, $AdrFour, PDO::PARAM_STR);
                $sth->bindValue(3, $CdePostFour, PDO::PARAM_INT);
                $sth->bindValue(4, $VilleFour, PDO::PARAM_STR);
                $sth->bindValue(5, $TelFixFour, PDO::PARAM_INT);
                $sth->bindValue(6, $TelFixFour2, PDO::PARAM_INT);
                $sth->bindValue(7, $FaxFour, PDO::PARAM_INT);
                $sth->bindValue(8, $EmailFour, PDO::PARAM_STR);
                $sth->bindValue(9, $SiteFour, PDO::PARAM_STR);
                
                $result = $sth->execute();


                $data = "ok";
                $response["data"] = $data;
                $response["error_message"] = "";
                $response["error"] =true;
            }
            catch(Exception $e){

                $response["error_message"] = "erreur de param" .$e->getMessage();
                $response["error"] = true;
            }
        }
            else
            {

                $response["error_message"] = "ERROR QUERY";
            }

                
            
            
                    echo json_encode($response);
            ?>
       