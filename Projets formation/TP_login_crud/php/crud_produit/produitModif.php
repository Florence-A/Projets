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
    <title>Modification de produit</title>

</head>
<body>


<h1>Modifier</h1>


<table> <!-- LIGNE PRODUIT SELECTIONNEE -->

<?php

$id = $_POST['modif']; 


// RECUPERATION DES INFOS DU PRODUIT

    try{

        $co = new PDO("mysql:host=localhost;dbname=premiere","root","");

        $co->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM produits WHERE produits.id = $id";

        $stmt = $co->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);



        foreach($result as $keys => $values){

            echo 

                "<tr>

                    <td>".$values['nom']."</td> 
                    <td>".$values['prix']."€</td> 

                </tr>";
        }

    } catch(PDOException $e){ echo $e->getMessage();}

?>

</table>


<!-- AFFICHAGE DU PRODUIT ET DU FORMULAIRE DE MODIFICATION -->

<br><br>

<p>Remplissez uniquement les champs à modifier :</p>

<br>

<form method=POST action="produitModifBdd.php">

    <input name="nom" type="texte" placeholder="<?php echo $values['nom']?>">

    <input name="prix" type="number" placeholder="<?php echo $values['prix']?>€" min=0>

    <br><br>

    <input name="id" type="submit" class="icone" id="ok" value=<?php echo $id ?>>

</form>

<br>

<a href=../p_produits.php>Retour site</a>


</body>
</html>