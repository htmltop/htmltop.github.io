<?php
    include "connect_base.php";
    session_start();
    
    if(!isset($_COOKIE["pseudo"])){
        header("Location: inscription.php");
        exit();
    }
    
    $destinataire = $_GET["pseudo"];
    $auteur = $_COOKIE["pseudo"];
    
    // Mettre à jour l'état des messages à 0 lorsque le destinataire accède à la discussion
    $etat2 = $db->prepare("UPDATE message SET etat = 0 WHERE id_destinataire = :moi AND id_auteur = :autre AND etat = 1");
    $etat2->execute(["moi" => $auteur, "autre" => $destinataire]);
    
    if(isset($_POST["envoi"])){
        $texte = $_POST["message"];
    
        $message = $db->prepare("INSERT INTO message (message, id_destinataire, id_auteur, etat) VALUES(:message, :id_destinataire, :id_auteur, 1)");
        $message->execute([
            "message" => $texte,
            "id_destinataire" => $destinataire,
            "id_auteur" => $auteur
        ]);
    
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
    
    $_SESSION["pseudo"] = $_GET["pseudo"];
    
    $quer = $db->prepare("UPDATE utilisateur SET verif = 0 WHERE pseudo = :pseudo");
    $quer->execute(["pseudo" => $_COOKIE["pseudo"]]);
    
    $aut = $db->prepare("UPDATE utilisateur SET ligne = 1 WHERE pseudo = :pseudo");
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
            height: 100%;
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

        .header{
           width:65%;
           display: flex;
           justify-content: space-between;
        }
        .retour{
            width: 7rem;
            height: 7rem;
            background-color: #101728;
            border: none;
            cursor: pointer;
        }
        .iden{
            display: flex;
            justify-content: space-between;
        }
        .fleche{
            width: 130%;
            height: 100%;
        }
        .pseu{
            font-size: 3rem;
            color: #A569BD;
        }
        .profil{
            width: 7.5rem;
            height: 7.5rem;
            margin-right: 9rem;
            border-radius: 100%;
        }
        .section{
            height: 78%;
            max-height: 85%;
            width: 100%;
            overflow: auto;
            background-color:#101728;
            position: absolute;
            bottom: 0;
            margin-bottom: 12%;

            display: flex;
            flex-direction: column;
        }
        .moi{
            min-width: 25%;
            max-width: 75%;
            min-height: 6rem;
            max-height: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            border-radius: 50px;
            background: linear-gradient(to right, rgb(36, 0, 70), rgb(138, 0, 96));
            float: right;
            margin-bottom: 3%;
            overflow: hidden;


            /*text-overflow: ellipsis;
            white-space: nowrap;*/
        }
        .toi{
            min-width: 25%;
            max-width: 75%;
            min-height: 6rem;
            max-height: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            border-radius: 50px;
            background: linear-gradient(to right, rgb(193, 58, 247), rgb(137, 63, 235));
            float: left;
            margin-bottom: 3%;
            overflow: hidden;

            /*text-overflow: ellipsis;
            white-space: nowrap;*/
        }
        p{
            color: white;
            font-size: 2.5rem;
            height: 10px auto;
            margin-top: 2rem;
        }

        .clavier{
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 7%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            
            background-color:#101728;
        }
        .inpcla{
            height: 100%;
            width: 76%;
            border-radius: 100px;
            border: none;
            font-size: 2.5rem;
        }
        .envoi{
            width: 7.2rem;
            height: 7.2rem;

            border-radius: 100%;
            background-image: url("image/envoi.png");
            background-size: 100%;
            background-repeat: no-repeat;
            border: none;
        }
        form{
            display: flex;
            align-items: center;
        }

        .message{
            width: 100%;
        }
        .imgp{
            width: 4rem;
            height: 4rem;
        }
        .vert{
            display: flex;
            align-items: center;
        }
        .imgvoc{
            width: 6.5rem;
            height: 6.5rem;
            border: none;
        }
        .butvoc{
            border: none;
            
            background: transparent;
        }
    </style>
    <body>
        <div class = "logo">
            <img src = "image/logo.png" class = "logoimg">
            <h1>Punch</h1>
        </div>
        
        <br><br><br><br><br><br><br>
        <div class = "header">
            <button onclick = "retour()" class = "retour">
                <img src = "image/fleche.png" class = "fleche">
            </button>
            <div class = "iden">
                <?php
                    $tcho = $db->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
                    $tcho->execute(["pseudo" => $_GET["pseudo"]]);
                    $tho = $tcho->fetch();
                ?>
                <a href="profil_utilisateur.php?pseudo=<?= $tho["pseudo"] ?>&bio=<?= $tho["bio"] ?>&situ_amour=<?= $tho["situation_amoureuse"] ?>&situ_prof=<?= $tho["proffessions"] ?>&centre=<?= $tho["centre_interet"] ?>&profil=<?= htmlspecialchars($tho["profil"]) ?>">
                    <img src = <?php 
                        if(empty($_GET["profil"])){
                            echo("image/profil_fond.png");
                        }
                        else{
                            echo($_GET["profil"]);
                        }
                    ?> class = "profil">
                </a>
                <h1 class = "pseu"><?php 
                    if(isset($_GET["pseudo"])){
                        echo($_GET["pseudo"]);
                    }
                    else{
                        header("Location: message.php");
                        exit();
                    }
                ?></h1>


                <div id = "ligne" class = "vert">
                </div>


            </div>
        </div>
        <br>

        <div class = "section" id = "message">

        </div>
        <form method = "post">
            <div class = "clavier">
                <input type = "text" placeholder="Votre message..." class = "inpcla" name = "message" autocomplete = "off" id = "inpvoc">
                <button type="button" onclick = "vocal()" class = "butvoc">
                    <img src = "image/micro.png" class = "imgvoc">
                </button>
                <input type = "submit" name = "envoi" class = "envoi" value = "">
            </div>
        </form>
    </body>
    <script>
        let voco = new webkitSpeechRecognition();
        
        function vocal(){
            event.preventDefault();
            voco.start();
        }
        let inpvoc = document.getElementById("inpvoc");
        
        voco.onresult = (event) => {
			let texte = event.results[0][0].transcript;
			inpvoc.value = texte;
        }
        
        function retour(){
            location.href = "message.php";
        }

        function load_message() {
            $('#message').load('ifram.php'); 
            let message = document.getElementById("message");
            message.scrollTop = message.scrollHeight;
        }
        function load_ligne() {
            $('#ligne').load('ligne.php'); 
        }
        setInterval(load_message, 1000);  
        setInterval(load_ligne, 1000);
    </script>
</html>