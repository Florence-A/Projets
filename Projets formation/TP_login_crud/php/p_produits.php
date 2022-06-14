<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_crud.css">
    <title>Produits</title>

</head>
<body>

    <div id="bandeauDeco">

        <a href="p_deco.php">DECONNEXION</a>

    </div>


    <h1>Page Produits</h1>

    <h2>Bienvenue <?php echo $_SESSION['prenom']; ?> !</h2>


    <?php




    //BOUTON PARAMETRAGE ADMIN

    if ($_SESSION['role'] == 1) {

        echo "

        <a class='admin' href='crud_user/tableau.php'> Gestion des utilisateurs </a><br>

        <a class='admin' href='crud_produit/tableau.php'> Gestion des produits </a>";

    } else if ($_SESSION['role']==2 || $_SESSION['role']==0){

        echo "
        
        <style> .admin { display : none } </style>";

    }



    // AFFICHAGE PRODUITS

    try{

        $co = new PDO("mysql:host=localhost;dbname=premiere","root","");

        $co->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM produits;";

        $stmt = $co->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);



        ?>  <div class=container>  <?php
        

        foreach($result as $keys => $values){

            echo

            "<div class='article'>

            <h2>".$values['nom']."</h2>

            <p>".$values['prix']." €</p>

            <img class='img' src=".$values['image'].">

            <style>.img{width:200px;height:200px;}</style>

            </div>";

        }

        ?>  </div>  <?php


    }
    catch(PDOException $e){echo $e->getMessage();}



?>
    
</body>
</html>