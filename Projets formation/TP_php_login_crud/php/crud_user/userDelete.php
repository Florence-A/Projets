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
    <title>Suppression d'utilisateur</title>

</head>
<body>


<h1>Delete</h1>


<?php


$id = $_POST['delete'];

try{

    $co = new PDO ("mysql:host=localhost;dbname=premiere","root","");

    $co->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $requete = "DELETE FROM user WHERE user.id = $id";

    $stmt = $co->prepare($requete);

    $stmt->execute();

    echo "<h3>Utilisateur supprimé</h3>";

    echo "<a href=tableau.php>Retour</a>";
    
}

catch(PDOException $e){echo $e->getMessage();}

?>

</body>
</html>
