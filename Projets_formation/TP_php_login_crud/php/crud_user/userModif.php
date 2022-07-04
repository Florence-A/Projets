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
    <title>Modification d'utilisateur</title>

</head>
<body>


<h1>Modifier</h1>


<table> <!-- LIGNE UTILISATEUR SELECTIONNEE -->

<?php

$id = $_POST['modif']; 


// RECUPERATION DES INFOS DE L'UTILISATEUR

    try{

        $co = new PDO("mysql:host=localhost;dbname=premiere","root","");

        $co->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM user WHERE user.id = $id";

        $stmt = $co->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);



        foreach($result as $keys => $values){

            echo 

                "<tr>

                    <td>".$values['id']."</td> 
                    <td>".$values['nom']."</td> 
                    <td>".$values['prenom']."</td> 
                    <td>".$values['email']."</td> 
                    <td>".$values['password']."</td> 
                    <td>".$values['bureau']."</td> 
                    <td>".$values['id_role']."</td>

                </tr>";
        }

    } catch(PDOException $e){ echo $e->getMessage();}

?>

</table>


<!-- AFFICHAGE DU PROFIL ET DU FORMULAIRE DE MODIFICATION -->

<br><br>

<p>Remplissez uniquement les champs à modifier :</p>

<br>

<form method=POST action="userModifBdd.php">

    <input name="nom" type="texte" placeholder="<?php echo $values['nom']?>">

    <input name="prenom" type="texte" placeholder="<?php echo $values['prenom']?>">

    <input name="email" type="texte" placeholder="<?php echo $values['email']?>">

    <input name="password" type="texte" placeholder="<?php echo $values['password']?>">

    <input name="bureau" type="number" placeholder="<?php echo $values['bureau']?>" max=2 min=0>

    <input name="id_role" type="number" placeholder="<?php echo $values['id_role']?>" max=2 min=1>

    <br><br>

    <input name="id" type="submit" class="icone" id="ok" value=<?php echo $id ?>>

</form>

<br>

<a href=../p_produits.php>Retour site</a>


</body>
</html>