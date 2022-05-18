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
    <title>Ajout de produit</title>

</head>
<body>

<?php

$nom = $_POST['nom'];
$prix = $_POST['prix'];



if (!preg_match('!^ *$!s',$nom) 
&& !preg_match('!^ *$!s',$prix)){


    try{


        $co = new PDO("mysql:host=localhost;dbname=premiere","root","");

        $co->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $requete = "INSERT INTO produits (nom,prix) VALUES (?,?)";

        $stmt=$co->prepare($requete);

        $stmt->execute(array($nom,$prix));

        echo "<h3>Produit créé</h3><br>";

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