<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style_crud.css">
    <title>Crud Produits</title>

</head>
<body>

    <div id="bandeauDeco">
    
        <a href="../p_deco.php">DECONNEXION</a>
    
    </div>


    <h1>Produits</h1>


    <br><br><form action="produitAdd.php" method="POST">
            
            <input type="text" name="nom" placeholder="Nom">

            <input type="number" name="prix" placeholder="Prix" min=0>

            <input type="submit" value="Ajouter">

        </form>


    <?php
    

    try {

        // RECUPERATION DES PRODUITS

        $co = new PDO("mysql:host=localhost;dbname=premiere","root","");

        $co->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM produits";
        
        $stmt = $co->prepare($sql);

        $stmt->execute();


        // MISE EN FORME ET AFFICHAGE DU TABLEAU

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>
        
        <table>

            <tr> <!-- EN-TETE TABLEAU -->

                <td>NOM</td>
                <td>PRIX</td>
                <td colspan=2 >GESTION</td>
            </tr>

            <?php

            foreach($result as $keys => $values){


                    // LIGNES PRODUITS

                echo "

                <tr>
                    <td>".$values['nom']."</td> 
                    <td>".$values['prix']."€</td>";


                    $id=$values['id'];
                    ?>


                    <!-- ICONES MODIFIER ET SUPPRIMER -->

                    <form method="POST" action="produitModif.php">
                        
                        <td> <input name="modif" type="submit" class='icone modif' value=<?= $id ?>> </td>

                    </form>

                    <form method="POST" action="produitDelete.php">

                        <td> <input name="delete" type="submit" class='icone delete' value=<?= $id ?>> </td>
                            
        
                    </form>

                </tr>

            <?php
            }
            ?>

        </table>

    <?php
    }
    catch(PDOException $e){echo $e->getMessage();}
    ?>

    <br>

    <a href=../p_produits.php>Retour site</a>
    
    
</body>

</html>