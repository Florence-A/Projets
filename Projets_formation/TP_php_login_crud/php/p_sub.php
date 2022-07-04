<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_crud.css">
    <title>Inscription</title>

</head>


<?php

// RECUPERATION DES VALEURS DU FORMULAIRE D'INSCRIPTION

$nom = $_POST['nom'];

$prenom = $_POST['prenom'];

$mail = $_POST['email'];

$mdp = $_POST['mdp'];


// CHECK DES VIDES //

if (!preg_match('!^ *$!s',$nom) 
&& !preg_match('!^ *$!s',$prenom) 
&& !preg_match('!^ *$!s',$mail) 
&& !preg_match('!^ *$!s',$mdp)){


    // CHECK DU FORMAT MAIL //

    if(filter_var($mail,FILTER_VALIDATE_EMAIL)){


        // CHECK NOM PRENOM SANS CHIFFRES //

        if(!ctype_digit($nom) && !ctype_digit($prenom)){


            // CHECK DE LA LONGUEUR MDP //

            if(strlen($mdp)<6){

                echo "<p>Merci de choisir un mot de passe de 6 carctères minimum !</p>";

                echo "<a href='../html/p_accueil.html'>Retour</a>";

            } else {


                // CONNEXION A BDD //

                try{

                    $co = new PDO("mysql:host=localhost;dbname=premiere","root","");

                    $co->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


                        try{

                            // REQUETE

                            $requete = "INSERT INTO user (id,email,password,nom,prenom,bureau,id_role) 

                                        VALUES (NULL,'$mail','$mdp','$nom','$prenom',0,2)";


                            $co->exec($requete);


                            // REDIRECTION

                            echo "<p>Votre inscription a bien été prise en compte !<br>

                            Merci de vous connecter avec vos nouveaux identifiants.<p>";

                            echo "<a href='../html/p_accueil.html'>Se connecter</a>";
                            

                        }
                        catch(Exception $ex){
                            
                            echo "<p>Oups</p>";

                            echo "<p>Une erreur est survenue, l'adresse mail est déjà prise.</p>";

                            echo "<a href='../html/p_accueil.html'>Retour</a>";
                        }


                    } catch (PDOException $e) { echo $e->getMessage();}
            }
        


        // SI NOM PRENOM INVALIDES //

        } else {

            echo "<p>Merci de renseigner les champs Nom et Prénom correctement</p>";

            echo "<a href='../html/p_accueil.html'>Retour</a>";
        }

    // SI MAIL INVALIDE //

    } else {

        echo "<p>Merci de renseigner un e-mail valide</p>";

        echo "<a href='../html/p_accueil.html'>Retour</a>";
    }

// SI VIDES //

} else {

    echo "<p>Merci de renseigner tous les champs</p><br><br>";
    
    echo "<a href='../html/p_accueil.html'>Retour</a>";
}

?>
</html>