<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style_crud.css">
    <title>Modification</title>

</head>
<body>

<h3>Effectué</h3>


<?php

// RECUPERATION DES NOUVELLES INFOS DU $_POST

$id = $_POST['id'];
$newNom = $_POST['nom'];
$newPrenom = $_POST['prenom'];
$newMail = $_POST['email'];
$newPass = $_POST['password'];
$newBu = $_POST['bureau'];
$newRole = $_POST['id_role'];



    // DEFINITION FONCTION POUR REMPLACER


    function remplace($champ,$modif){

        if(isset($modif) && !preg_match('!^ *$!s',$modif)){

            try {

                $id = $_POST['id'];

                $co = new PDO ("mysql:host=localhost;dbname=premiere","root","");

                $co->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
                $requete = "UPDATE `user` SET `$champ` = '$modif' WHERE `user`.`id` = $id;";
            
                $stmt = $co->prepare($requete);
            
                $stmt->execute();

            } catch(PDOException $e){ echo $e ->getMessage() ;}
        }
    }


    // RECUPERATION DES DONNEES A MODIFIER

    try{

    $co = new PDO ("mysql:host=localhost;dbname=premiere","root","");

    $co->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM user WHERE user.id = $id";

    $stmt = $co->prepare($sql);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e){ echo $e ->getMessage() ;}


    // REMPLACEMENT

    foreach($result as $keys => $values){
        
        remplace('nom',$newNom);

        remplace('prenom',$newPrenom);

        remplace('email',$newMail);

        remplace('password',$newPass);

        remplace('bureau',$newBu);

        remplace('id_role',$newRole);
    }
?>

<a href='tableau.php'>Retour</a>


</body>
</html>