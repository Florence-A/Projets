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
    <title>Ajout d'utilisateur</title>

</head>
<body>

<?php

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = $_POST['email'];
$mdp = $_POST['mdp'];
$id_role = $_POST['id_role'];
$bureau = $_POST['bureau'];



if (!preg_match('!^ *$!s',$nom) 
&& !preg_match('!^ *$!s',$prenom) 
&& !preg_match('!^ *$!s',$mail) 
&& !preg_match('!^ *$!s',$mdp)
&& !preg_match('!^ *$!s',$id_role)
&& !preg_match('!^ *$!s',$bureau)){


    try{


        $co = new PDO("mysql:host=localhost;dbname=premiere","root","");

        $co->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $requete = "INSERT INTO user (email,password,nom,prenom,bureau,id_role) VALUES (?,?,?,?,?,?)";

        $stmt=$co->prepare($requete);

        $stmt->execute(array($mail,$mdp,$nom,$prenom,$bureau,$id_role));

        echo "<h3>Utilisateur créé</h3><br>";

        echo "<a href=tableau.php>Retour</a>";

    }

    catch(PDOException $e){ echo $e->getMessage();}


} else {

    echo "<h2>Oups</h2>";

    echo "<p>Un des champ ne semble pas rempli, merci de réessayer</p>";

    echo "<a href=tableau.php>Retour</a>";

}

?>

</body>
</html>