
            <?php
            $host='localhost';
            $dbname='sirius_school';
            $charset='utf8';
            $dbuser='root';
            $dbpwd='';
            
            //DEFINIE L'ERREUR
            define('DEBUG',true);
            
            
            // SI IL Y A PAS D'ERREUR ALORS ERREUR REPORT ZERO
            if(!DEBUG){
            
                error_reporting(0);
            }
            // ESSAYE DE TE CONNECTER SUR LA BASE DES DONNEES
            try {
                $bdd= new PDO("mysql:host=$host;dbname=$dbname;charset=$charset",$dbuser,$dbpwd);
            } 
            
            //SI TU N'Y ARRIVE PAS , TROUVE MOI L'ERREUR
            catch (exception $e) {
                
                //SI IL Y A L'ERREUR
                if(DEBUG){
            
                    //STOP ET AFFICHE MOI L'ERREUR 
                    
                    die('error:'. $e->getMessage());
                }
                else{
                    
                    //SI NON AFFICHER MOI CONNEXION ERROR 
                     die('connexion error');
                }
            }
            
            $reponse = [
            "error"         => false,
            "error_message" => "",
            "data"          => [$first_name,$last_name]
        ];
/* on vonvertir en json le tableau et on l'affiche */
        echo json_encode($reponse);
die();
        
?>