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
    <title>Connexion</title>

</head>
<body>

<?php

// RECUP DES INPUT DS POST

$mail = $_POST['email_u'];

$mdp = $_POST['mdp_u'];


// VERIFICATION CHP VIDES

if (!preg_match('!^ *$!s',$mail) && !preg_match('!^ *$!s',$mdp)){


    try{ // CONNEXION BDD

        $co = new PDO("mysql:host=localhost;dbname=premiere","root","");

        $co->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM user WHERE email='$mail' AND password='$mdp';";

        $stmt = $co->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


        // PARCOURS LIGNE USER 

        foreach($result as $keys => $values){

           $role=$values['id_role'];

           $prenom=$values['prenom'];
        }


        // REMPLISSAGE SESSION ET REDIRECTION VERS SITE

        if (!empty($result)){

            $_SESSION['mail'] = $mail;

            $_SESSION['role'] = $role;

            $_SESSION['prenom'] = $prenom;

            header("Location:p_produits.php");



        } else {

            echo "<p>Mot de passe et/ou e-mail incorrect(s) <br>
            
            Veuillez réessayer </p>";

            echo "<a href='../html/p_accueil.html'>Retour</a>";

        }

    } catch(PDOException $e){ echo $e->getMessage();};



} else {

    echo "<p>Mot de passe et/ou e-mail incorrect(s) <br>

            Veuillez réessayer </p>";

    echo "<a href='../html/p_accueil.html'>Retour</a>";
}

?>

</body>
</html>