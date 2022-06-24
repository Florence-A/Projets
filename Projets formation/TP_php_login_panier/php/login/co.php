<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/sp_style.css" rel="stylesheet">
    <title>Accueil</title>
</head>
<body>

<?php

$mail = $_POST['mail'];
$mdp = $_POST['mdp'];


try {

    $co = new PDO('mysql:host=localhost;dbname=smile_posting','root','');
    $co->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $requete = "SELECT * FROM client WHERE client.mail = '$mail'";
    $stmt = $co->prepare($requete);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $keys => $values){}

    // VERIFICATION MDP HASHE
    $mdp_hash = $values['mdp'];
    $verif = password_verify($mdp,$mdp_hash);

    


    //OUVERTURE SESSION SI OK

    if($verif || $mdp = $values['mdp']){

        $_SESSION['pseudo'] = $values['pseudo'];
        $_SESSION['role'] = $values['role'];
        $_SESSION['id_c'] = $values['id_c'];

        

    } else {

        echo "Mot de passe incorrect<br>";
        echo "<a href='accueil.php'> Retour </a>";

    }


}catch(PDOException $e){ 

    echo  $e->getMessage()."<br>";
    echo "Adresse mail non reconnue<br>";
    echo "<a href='accueil.php'> Retour </a>";
    

}
?>

</body>
</html>