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
    <title>Crud Utilisateurs</title>

</head>
<body>

    <div id="bandeauDeco">
    
        <a href="../p_deco.php">DECONNEXION</a>
    
    </div>


    <h1>Utilisateurs</h1>


    <br><br><form action="userAdd.php" method="POST">
            
            <input type="text" name="nom" placeholder="Nom">

            <input type="text" name="prenom" placeholder="Prénom">

            <input type="text" name="email" placeholder="Email">

            <input type="password" name="mdp" placeholder="Mot de passe">

            <input type="number" name="bureau" placeholder="bureau" min=0 max=2>

            <input type="number" name="id_role" placeholder="id_role" min=1 max=2>

            <input type="submit" value="Ajouter">

        </form>


    <?php
    

    try {

        // RECUPERATION DES UTILISATEURS

        $co = new PDO("mysql:host=localhost;dbname=premiere","root","");

        $co->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM user";
        
        $stmt = $co->prepare($sql);

        $stmt->execute();


        // MISE EN FORME ET AFFICHAGE DU TABLEAU

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>
        
        <table>

            <tr> <!-- EN-TETE TABLEAU -->

                <td>ID</td>
                <td>NOM</td>
                <td>PRENOM</td> 
                <td>MAIL</td> 
                <td>MDP</td> 
                <td>BUREAU</td> 
                <td>N°ROLE</td>
                <td colspan=2 >GESTION</td>
            </tr>

            <?php

            foreach($result as $keys => $values){


                    // LIGNES UTILISATEURS

                echo "
                <tr>
                    <td>".$values['id']."</td> 
                    <td>".$values['nom']."</td> 
                    <td>".$values['prenom']."</td> 
                    <td>".$values['email']."</td> 
                    <td>".$values['password']."</td> 
                    <td>".$values['bureau']."</td> 
                    <td>".$values['id_role']."</td>";

                    $id=$values['id'];
                    ?>


                    <!-- ICONES MODIFIER ET SUPPRIMER -->

                    <form method="POST" action="userModif.php">
                        
                        <td> <input name="modif" type="submit" class='icone modif' value=<?= $id ?>> </td>

                    </form>

                    <form method="POST" action="userDelete.php">

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