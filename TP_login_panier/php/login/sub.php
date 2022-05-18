<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/sp_style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    

<?php

$pseudo = $_POST['pseudo'];

$mail = $_POST['mail'];

$mdp = $_POST['mdp'];

$mdp_hash = password_hash($mdp,PASSWORD_DEFAULT);



if (!preg_match('!^ *$!s',$pseudo)
&& !preg_match('!^ *$!s',$mail) 
&& !preg_match('!^ *$!s',$mdp)){


    try {

        $co = new PDO("mysql:host=localhost;dbname=smile_posting","root","");

        $co->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $requete = "INSERT INTO client (mail,mdp,pseudo,role) VALUES (?,?,?,?)";

        $co->beginTransaction();

        $stmt = $co->prepare($requete);

        $stmt->execute([$mail,$mdp_hash,$pseudo,0]);

        $co->commit();

        echo "<h2>Inscription validée</h2>
        
            <p>Vous pouvez vous connecter avec vos nouveaux identifiants !</p>

            <p>:)</p>
            
            <a href='formCo.php'>Connexion</a>";


    } catch(PDOException $e){ 
        
        echo $e->getMessage();

        echo "<h2>Oups...</h2>

            <p>Une erreur est survenue</p>
        
            <p>Cette adresse mail est déjà utilisée.</p>
            
            <a href='accueil.php'>Retour</a>";
        
        $co->rollBack(); 
    }

}


?>

</body>
</html>