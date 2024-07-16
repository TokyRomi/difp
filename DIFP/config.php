<?php

    $servername = "localhost";
    $username = "root";
    $password = "";

    function connexionBDD($servername, $username, $password){
        try{
            $bdd = new PDO("mysql:host=$servername; dbname=difp", $username, $password);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion reussie !";
            return $bdd;
            
        }
        catch(PDOException $e){
            echo "Erreur : ".$e->getMessage();
            return null;
        }
    }
     $bdd = connexionBDD($servername, $username, $password );


     
    
?>


