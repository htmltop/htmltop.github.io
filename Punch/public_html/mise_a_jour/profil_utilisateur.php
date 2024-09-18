<?php
    include "connect_base.php";
    session_start();

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
        <title>Profil</title>
        <link rel = "icon" href = "image/logo.png">
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
       .imgpseu{
            width: 80%;
            height: 15%;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        h2{
            font-size: 4rem;
            color: #5E17EB;
        }    
        .imgprofil{
            min-width: 200px;
            min-height: 200px;
            width:200px;
            height: 200px;
            max-width: 200px;
            max-width: 200px;
            border-radius: 100%;
        }
        .boitebio{
            width: 100%;
            height: 20%;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }       
        .bio{
            max-width: 75%;
            height: cover;
        }
        .pbio{
            font-size: 3rem;
            color: white;
            word-wrap: break-word; 
        }
        .supinfo{
            color: white;
            font-size: 4rem;
        }
        .parainfo{
            color: #CB6CE3;
            font-size: 3rem;
        }        
        .reponse{
            font-size: 3rem;
            color:#5E17EB;
        }       
        .info{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .retour{
            width: 6.5rem;
            height: 6rem;
            background-color: #101728;
            border: none;
            cursor: pointer;
        }
        .imgretour{
            width: 100%;
            height: 100%;
        }
    </style>
    <body>
        <div class = "logo">
            <button onclick = "retour()" class = "retour">
                <img src = "image/fleche.png" class = "imgretour">
            </button>
            <img src = "image/logo.png" class = "logoimg">
            <h1 translat ="no">Punch</h1>
        </div>
        <br>
        <div class = "imgpseu" id = "pseu">
            <div class = "ajoutprofil">
                <img src = <?php 
                if(!empty($_GET["profil"])){
                    echo($_GET["profil"]);
                }
                else{
                    echo("image/profil_fond.png");
                }
                ?> class = "imgprofil">
            </div>
            <h2><?= $_GET["pseudo"]?></h2>
        </div>

        <div class = "boitebio" id = "boitebio">
            <div class = "bio">
                <p class = "pbio"><?php 
                if(!empty($_GET["bio"])){
                    echo($_GET["bio"]);
                }
                else{
                    echo("Pas de bio");
                }
                
                ?></p>
            </div>
        </div>

        <div class = "boiteinfo" id = "boiteinfo">
            <p class = "supinfo">Infos supplémentaires: </p>
            <br>
            <div class = "info">
                <p class = "parainfo">Situation amoureuse: </p>
                <p class = "reponse"><?php
                    if(!empty($_GET["situ_amour"])){
                        echo($_GET["situ_amour"]);
                    }
                    else{
                        echo("Aucun renseignement");
                    }
                ?></p>
                <div></div>
            </div>

            <div class = "info">
                <p class = "parainfo">Profession: </p>
                <p class = "reponse"><?php 
                    if(!empty($_GET["situ_prof"])){
                        echo($_GET["situ_prof"]);
                    }
                    else{
                        echo("Aucun renseignement");
                    }
                ?></p>
                <div></div>
            </div>

            <div class = "info">
                <p class = "parainfo">Centre d'intéret:  </p>
                <p class = "reponse"><?php 
                    if(!empty($_GET["centre"])){
                        echo($_GET["centre"]);
                    }
                    else{
                        echo("Aucun renseignement");
                    }
                ?></p>
                <div></div>
            </div>
        </div>
    </body>
    <script>
        function retour(){
            window.history.back();
        }
    </script>
</html>