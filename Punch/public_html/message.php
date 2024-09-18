<?php
    session_start();
    include "connect_base.php";

    if(isset($_COOKIE["pseudo"]) == null){
        header("Location: inscription.php");
        exit();
    }

    $quer = $db->prepare("UPDATE utilisateur SET verif = 1 WHERE pseudo = :pseudo");
    $quer->execute(["pseudo" => $_COOKIE["pseudo"]]);

    $aut = $db->prepare("UPDATE utilisateur SET ligne = 0 WHERE pseudo = :pseudo");
    $aut->execute(["pseudo" => $_COOKIE["pseudo"]]);
?>
<html lang = "fr">
    <head>
        <meta charset = "utf-8">
        <title>Message</title>
        <link rel = "icon" href = "image/logo.png">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <style>
        body, html{
            height: 110%;
        }
        body{
            background-color: #101728;
        }
        .logo{
            float: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logoimg{
            height: 4rem;
            width: 4rem;
            margin-left: 40px;
        }
        h1{
            color: white;
            font-size: 3rem;
        }

        .footer{
            width: 101%;
            height: 8.3%;
            background-color: #241A44;
            position: fixed;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
        }
        .butnav{
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
            width: cover;
            height: 100%;
            background-color: #241A44;
        }
        .imgnav{
            width: 85%;
            height: 85%;
        }
        .message{
            color: white;
            font-size: 4rem;
            font-family:Georgia, 'Times New Roman', Times, serif;
        }

        .bmessage{
            width: 100%;
            height: 12rem;
            border-bottom: white solid 1px;
            display: flex;
            align-items: flex-start;
            /*justify-content: space-evenly;*/
            text-decoration: none;
        }
        .profil{
            height: 95%;
            width: 140%;
            border-radius: 100%;
        }
        .pseudo{
            font-size: 3rem;
            color: #613DD1;
            margin-left: 10%;
        }
        .boiteprofil{
            display: flex;
            align-items: center;
            height: 90%;
            width: 17%;
        }

        .mess{
            color: white;
            font-size: 2rem;
            margin-top: 7rem;
            width: 25rem;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .tete{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        h2{
            font-size: 3rem;
            color: #1BEEFF;
        }
        .butinv{
            background-color:#101728;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .friendaj{
            width: 100%;
            height: 100%;
            display: none; 
        }
        .friendaj:empty{
            border-radius: 1px;
        }
        .friendboite{
            width: 100%;
            height: 12rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .ajprofil{
            display: flex;
            align-items: center;
            height: 85%;
            width: 15%;
        }
        h3{
            font-size: 3rem;
            color: #2BBBFF;
        }
        .accbut{
            width: 25%;
            height: 40%;
            border-radius: 30px;
            cursor: pointer; 
            background: linear-gradient(to right, rgb(132, 0, 255), rgb(0, 255, 191));
            border: none;
            font-size: 2rem;
            color: white;
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: arial;
        }
        .compte{
            background-color: white;
            min-width: 2.5rem;
            width: cover;
            height: 2.5rem;
            max-width: 7rem;
            border-radius: 100%;
            border: none;
        }
        .paracom{
            font-size: 2rem;
            color: #613DD1;
            margin-top: 10%;
        }
        .imgp{
            width: 4rem;
            height: 4rem;
        }
        .bp{
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
        
        .mess-unread {
            color: #B99EFF;
            font-size: 2.3rem;
            font-weight: bold;
        }
        

    </style>
    <body>
        <div class = "logo">
            <img src = "image/logo.png" class = "logoimg">
            <h1 translate="no">Punch</h1>
        </div>

        <br><br><br><br><br><br>
        <div class = "tete">
            <button onclick = "fermerure()" class = "butinv">
                <h1 class ="message">Message: </h1>
            </button>

            <button onclick = "ouverture()" class = "butinv">
                <h2>Invitation</h2>
                <?php
                    $compte = $db->prepare("SELECT COUNT(*) as count FROM friend WHERE accepteur = :acc AND etat = 1");
                    $compte->execute(["acc" => $_COOKIE["pseudo"]]);
                    
                    $compteResult = $compte->fetch();
                ?>
                <div class = "compte">
                    <p class = "paracom"><?= htmlspecialchars($compteResult["count"]) ?></p>
                </div>
            </button>

        </div>

        <div class = "base" id = "base">        
            <?php
                /*$select = $db->prepare("SELECT * FROM friend WHERE demandeur = :demandeur OR accepteur = :accepteur AND etat = :etat");
                $select->execute([
                    "demandeur" => $_COOKIE["pseudo"],
                    "accepteur" => $_COOKIE["pseudo"],
                    "etat" => 0
                ]);
                */
                $select = $db->prepare("
                SELECT f.*, u.*, MAX(m.time) as last_message_date
                FROM friend f
                JOIN utilisateur u ON (u.pseudo = f.demandeur OR u.pseudo = f.accepteur)
                LEFT JOIN message m ON (
                    (m.id_destinataire = :pseudo AND m.id_auteur = u.pseudo) OR
                    (m.id_destinataire = u.pseudo AND m.id_auteur = :pseudo)
                )
                WHERE (f.demandeur = :pseudo OR f.accepteur = :pseudo) AND f.etat = 0
                GROUP BY f.id
                ORDER BY last_message_date DESC
                ");
                $select->execute([
                    "pseudo" => $_COOKIE["pseudo"]
                ]);
            
                while($mess = $select->fetch()){
                    $que = $db->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
                    $profil = "image/profil_fond.png";
                    if($_COOKIE["pseudo"] == $mess["demandeur"]){
                        $profil = $mess["accepteur"];
                    }
                    else{
                        $profil = $mess["demandeur"];
                    }

                    $que->execute(["pseudo" => $profil]);
                    $quea = $que->fetch();
                    if($mess["etat"] == 0){
                        ?>
                            <a href="action.php?action=message&pseudo=<?=htmlspecialchars($quea["pseudo"])?>&profil=<?=htmlspecialchars($quea["profil"])?>" class="bmessage">
                                <div class = "boiteprofil">
                                    <img src = <?php
                                        if(empty($quea["profil"])){
                                            echo("image/profil_fond.png");
                                        } else {
                                            echo($quea["profil"]);
                                        }
                                    ?> class = "profil">
                                </div>

                                <p class = "pseudo"><?php 
                                    if($_COOKIE["pseudo"] == $mess["demandeur"]){
                                        echo($mess["accepteur"]);
                                        $nam = $mess["accepteur"];
                                    }
                                    else{
                                        echo($mess["demandeur"]);
                                        $nam = $mess["demandeur"];
                                    }
                                ?></p>
                                    <p class="mess <?php
                                            // Vérifie si le message a été envoyé par quelqu'un d'autre et s'il est non lu
                                            $dermess = $db->prepare("SELECT * FROM message WHERE (id_destinataire = :pseudo AND id_auteur = :auteur) OR (id_destinataire = :auteur AND id_auteur = :pseudo) ORDER BY id DESC LIMIT 1");
                                            $dermess->execute([
                                                "pseudo" => $_COOKIE["pseudo"],
                                                "auteur" => $nam
                                            ]);

                                            $me = $dermess->fetch();

                                            if ($me && $me["etat"] == 1 && $me["id_auteur"] != $_COOKIE["pseudo"]) {
                                                echo 'mess-unread';
                                            }
                                        ?>">
                                            <?php
                                            if ($me) {
                                                if ($me["id_auteur"] == $_COOKIE["pseudo"]) {
                                                    echo("Vous: " . htmlspecialchars($me["message"]));
                                                } else {
                                                    echo(htmlspecialchars($nam) . ": " . htmlspecialchars($me["message"]));
                                                }
                                            } else {
                                                echo("Aucun message");
                                            }
                                            ?>
                                    </p>
                                <?php
                                    $_SERVER["pseudo"] = $nam;
                                ?>
                                <!--<div class = "bp" id = "ligne">
                                </div>-->
                            </a>
                        <?php
                    }
                }
            ?>
        </div>


        <div class = "friendaj" id = "aj">
            <?php
                $connect = $db -> prepare("SELECT * FROM friend WHERE accepteur = :pseudo");
                $connect -> execute(["pseudo" => $_COOKIE["pseudo"]]);

                while($utile = $connect->fetch()){
                    $punch = $db->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
                    $punch->execute(["pseudo" => $utile["demandeur"]]);
                    $result = $punch -> fetch();

                    if($utile["etat"] == 1){
                    ?>
                        <div class = "friendboite">
                            <div class = "ajprofil">
                            <a href="profil_utilisateur.php?pseudo=<?= $result["pseudo"] ?>&bio=<?= $result["bio"] ?>&situ_amour=<?= $result["situation_amoureuse"] ?>&situ_prof=<?= $result["proffessions"] ?>&centre=<?= $result["centre_interet"] ?>&profil=<?= htmlspecialchars($result["profil"]) ?>">
                                <img src = <?php 
                                    if($result["profil"]){
                                        echo ($result["profil"]);
                                    }
                                    else{
                                        echo ("image/profil_fond.png");
                                    }
                                ?> class = "profil">
                            </a>
                            </div>
                            <h3><?=$utile["demandeur"]?></h3>
                            <a href = "action.php?action=accept&nom=<?=$utile["demandeur"]?>" class = "accbut">
                                Accepter
                            </a>
                        </div>
                <?php
                    }
                }
            ?>

        </div>

        <div class = "footer">
            <button onclick = "message()" class = "butnav">
                <img src = "image/message_bleu.png" class = "imgnav">
            </button>
            <button onclick = "profil()" class = "butnav">
                <img src = "image/profil.png" class = "imgnav">
            </button>
            <button onclick = "ajout()" class = "butnav">
                <img src = "image/ajout.png" class = "imgnav">
            </button>
        </div>
    </body>
    <script>
        function profil(){
            location.href = "profil.php";
        }
        function ajout(){
            location.href = "ajout_profil.php";
        }

        let base = document.getElementById("base");
        let aj = document.getElementById("aj");

        function ouverture(){
            base.style.display = "none";
            aj.style.display = "block";
        }
        function fermerure(){
            base.style.display = "block";
            aj.style.display = "none";
        }

        /*function load_ligne() {
            $('#ligne').load('ligne.php'); 
        }
        setInterval(load_ligne, 500);*/
    </script>
</html>