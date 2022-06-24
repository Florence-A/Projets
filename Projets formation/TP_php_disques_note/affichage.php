<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>Notation</title>

    <style>
        body{
    margin:auto;
    text-align:center;
    color:lightgray;
    background-color: darkslategrey;
    }
    .container {
        display:flex;
        justify-content: space-around;
        align-items: center;
        margin-top: 100px;
    }
    .case_album {
        border : solid lightgray 1px;
        padding : 10px;
        width : 250px;
    }
    </style>

</head>
<body>
    

<?php

try {

    $co = new PDO("mysql:host=localhost;dbname=album_note","root","");
    $co-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    ?>

    <h1> Albums disponibles à l'évaluation </h1>

<!-- MENU DEROULANT DES GROUPES     -->

    <form method=GET >

    <select name="groupes">

        <option>Selectionnez un groupe<option>

    <?php


    $reqd="SELECT DISTINCT album.groupe, album.titre, album.cover, track.titre FROM album,track
    WHERE track.id_album = album.id";
    $stmtd = $co->prepare($reqd);
    $stmtd->execute();
    $disques= $stmtd->fetchAll(PDO::FETCH_ASSOC);

    $req0="SELECT DISTINCT album.groupe, album.titre FROM album";
    $stmt0 = $co->prepare($req0);
    $stmt0->execute();
    $result0= $stmt0->fetchAll(PDO::FETCH_ASSOC);
    

    foreach($result0 as $k => $v){
        
        echo "
        
        <option value ='?selected=".$k."'>".$v['groupe']." - ".$v['titre']."</option>";
    }

    ?>
    </select>
    </form>

    <?php
    print_r($disques);
print_r($_GET);die;
    $req1="SELECT album.groupe, album.titre, album.cover FROM album";
    $stmt1 = $co->prepare($req1);
    $stmt1->execute();
    $result1= $stmt1->fetchAll(PDO::FETCH_ASSOC);


    echo "
    
    <div class = container>";

    if (isset($_GET['selectedG'])){

        $affichage = $_GET['selectedG'];

        

        foreach($selectedG as $group){

        }
    }

// RECUP ET AFFICHAGE DES INFOS ALBUM

    

    foreach ($result1 as $keys => $values){

        echo " <div class = 'case_album'>
        
        <h2>".$values['groupe']."</h2>

        <h3>".$values['titre']."</h3>
        
        <img src=".$values['cover'].">";

    // RECUP ET AFFICHAGE DES INFOS TRACKS

        $req2="SELECT track.titre FROM track
        INNER JOIN album ON track.id_album = album.id
        WHERE album.titre = ? ";


        $stmt2 = $co->prepare($req2);
        $stmt2->execute(array($values['titre']));
        $result2=$stmt2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result2 as $key => $vals){

            echo "<p>".$vals['titre']."</p>";
        }

    // RECUP ET AFFICHAGE DE LA NOTE MOYENNE

        $req3= "SELECT AVG(note) AS note FROM noter 
        INNER JOIN album ON noter.id = album.id
        WHERE album.titre = ?";

        $stmt3 = $co->prepare($req3);
        $stmt3->execute(array($values['titre']));
        $result3=$stmt3->fetch(PDO::FETCH_ASSOC);
     
        echo "<h3 style=color:lightsalmon>Note : ".sprintf('%.1f',$result3['note'])." / 10</h3>";
        echo "</div>";

    }

    echo "</div>";






}catch (PDOException $e) { echo $e->getMessage();}

?>
</body>
</html>
