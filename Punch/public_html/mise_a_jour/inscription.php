<?php
    session_start();
    include "connect_base.php";

    if (isset($_POST["connection"])){
        $pseudoc = $_POST["pseudoc"];
        $mpc = $_POST["mpc"];
        
        $veri = $db -> prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
        $veri -> execute(["pseudo" => $pseudoc]);
        $verif = $veri -> fetch();

        if($veri){
            if(password_verify($mpc, $verif["mp"])){
                $time = 3 * 30 * 24 * 3600;
                setcookie("pseudo", $verif["pseudo"], time() + $time);
                setcookie("mp", $mpc, time() + $time);
                setcookie("id", $verif["id"], time() + $time);
                setcookie("bio", $verif["bio"], time() + $time);
                setcookie("situation_amoureuse", $verif["situation_amoureuse"], time() + $time);
                setcookie("proffessions", $verif["proffessions"]);
                setcookie("centre_interet", $verif["centre_interet"], time() + $time);
                setcookie("profil", $verif["profil"], time() + $time);
                header("Location: profil.php");
                exit();
            }
            else{
                ?>
                    <script>
                        window.location.href = "pop_up.php?type=erreur&erreur=Mot de passe ou pseudo incorrecte&retour=ins";
                    </script>
                <?php
            }
        }
        else{
            ?>
                <script>
                    window.location.href = "pop_up.php?type=erreur&erreur=Votre pseudo est déja inscrit &retour=ins";
                </script>
            <?php
        }
    }
?>
<html lang = "fr">
    <head>
        <title>Incription/Connexion</title>
        <meta charset = "utf-8">
        <link rel= "icon" href="image/logo.png">
    </head>
    <style>
        body,html{
            height: 100%;
        }
        body{
            background-color: #101728;
        }

        header{
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
            height: 120px;
        }
        img.logo{
            height: 150px;
            width: 150px;
            float: left;
        }
        h1{
            font-size: 50px;
            color: #D72EDB;
        }
        p.inscrnombre{
            font-size: 25px;
            color: white;

        }
        p.nombre{
            color: #9340FF;
            font-size: 25px;
        }
        div.divnombre{
            display: flex;
            justify-content: right;
            margin-right: 10%;
            line-height: 3px;
        }

        div.inscrire{
            height:20%;
            width: 30%;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: flex-start ;
            margin-left: 25%;
            line-height: 35px;
        }
        div.connecter{
            height:20%;
            width: 30%;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: flex-start ;
            margin-left: 10%;
            line-height: 55px;
        }
        label{
            color: #BA8AF8;
            font-size: 31px;
            font-weight: bold;
        }
        input{
            height: 30px;
            width: 200px;
            border-radius: 50px;
            border: none;
        }

        form{
            display: flex;
            justify-content: space-around;

        }
        .but{
            border-radius: 30px;
            height: 50px;
            width: 200px;
            background: linear-gradient(to right, rgb(132, 0, 255), rgb(255, 0, 255));
            font-size: 21px;
            border: none;
            cursor: pointer;
        }
        .erreur{
            text-align: center;
            font-size: 1rem;

        }

        .ver{
            background-size: 100%;
            background: rgba(33, 35, 82);
            width: 30px;
            height: 28px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ligne{
            display: flex;
            justify-content: space-between;
        }

        .image{
            width: 30px;
            height: 28px;
            
        }
        .info{
            height: 20%;
            width: 70%;
            margin-left: 15%;
            margin-top: 10%;
            background-color: #CF85FF;
            border-radius: 50px;
        }
        .h1info{
            color: white;
            margin-left: 3%;
            font-size: 2.5rem;
        }
        .parainf{
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: -3rem;
        }
        .info{
            color: #6500A6;
            font-size: 2rem;
        }
    </style>
    <body>
        <div id = "pop_up">
            <img class = "logo" src = "image/logo.png">
            <div class = "divnombre">
                <p class = "inscrnombre"><strong>nombre d'inscription: </strong></p>
                <?php
                    $compte = $db-> query("SELECT COUNT(*) AS total FROM utilisateur");
                    $compte1 = $compte->fetch();

                    $nomb = $compte1["total"];
                ?>
                <p class = "nombre"><?= $nomb ?></p>
            </div>
            <header>
                <h1>S'inscrire: </h1>
                <h1>Se connecter: </h1>
            </header>

            <form method="post">
                <div class = "inscrire">
                    <label class = "pseudo">Pseudo: </label>
                    <input type = "text" name ="pseuin">
                    <br>

                    <label class = "email">Email :</label>
                    <input type = "email" name = "emailin">
                    <br>

                    <label class = "mp">Mot de passe: </label>
                    <div class = "ligne">
                        <input type = "password" name = "mpin" id = "mpij">
                        <button class = "ver" type = "button" onclick = "yeux()">
                            <img src = "image/fermer.png" id = "image" class = "image">
                        </button>
                    </div>
                    <br>

                    <label>Confirmer le mot de passe: </label>
                    <div class = "ligne">
                        <input type = "password" name = "conf" id = "conf">
                        <button class = "ver" type = "button" onclick = "yeux1()">
                            <img src = "image/fermer.png" id = "image1" class = "image">
                        </button>
                    </div>
                    <br>
                    <input type = "submit" value = "Inscription" class = "but" name = "inscription">
                </div>


                <div class = "connecter">
                    <label class = "pseudo">Pseudo: </label>
                    <input type = "text" name = "pseudoc" value = <?php 
                    if(isset($_COOKIE["pseudo"])){
                        echo ($_COOKIE["pseudo"]);
                    }
                    else{
                        echo("");
                    }
                    ?>>
                    <br>

                    <label class = "mp">Mot de passe: </label>
                    <div class = "ligne">
                        <input type = "password" id = "mpc" name = "mpc" value = <?php
                        if(isset($_COOKIE["pseudo"])){
                            echo ($_COOKIE["pseudo"]);
                        }
                        else{
                            echo("");
                        }
                        ?>>
                        <button class = "ver" type = "button" onclick = "yeux2()">
                            <img src = "image/fermer.png" id = "image2" class = "image">
                        </button>
                    </div>
                    <br>
                    <input type = "submit" value = "Connexion" class = "but" name = "connection">
                </div>
            </form>

            <div class = "info">
                <h1 class ="h1info">Infos: </h1>
                <div class = "parainf">
                    <p class = "infos">Bienvenue à tous ! <br>Mise à jour des notifications à venir...</p>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    if(isset($_POST["inscription"])){

        $pseudoi = $_POST["pseuin"];
        $emaili = $_POST["emailin"];
        $mpi = $_POST["mpin"];
        $conf = $_POST["conf"];

        $hach = password_hash($mpi, PASSWORD_BCRYPT);
        
        $sel = $db -> prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
        $sel -> execute([
            "pseudo" => $pseudoi
        ]);
        $selr = $sel -> fetch();

        $sele = $db -> prepare("SELECT * FROM utilisateur WHERE email = :email");
        $sele -> execute([
            "email" => $emaili
        ]);
        $selre = $sele -> fetch();

        $caract = 13;
        
        if(strpos($mpi, " ") == false){
            if($pseudoi == "" OR $emaili == "" OR $mpi == ""){
                ?>
                    <script>
                        window.location.href = "pop_up.php?type=erreur&erreur=Tout les champs ne sont pas remplis&retour=ins";
                    </script>
                <?php
            }
            else{
                if($selr){
                    ?>
                    <script>
                        window.location.href = "pop_up.php?type=erreur&erreur=Le pseudo est déjà pris&retour=ins";
                    </script>
                    <?php
                }
                else if($selre){
                    ?>
                    <script>
                        window.location.href = "pop_up.php?type=erreur&erreur=L'email est déjà pris&retour=ins";
                    </script>
                    <?php
                }
                else if(strlen($pseudoi) > $caract){
                    ?>
                        <script>
                            window.location.href = "pop_up.php?type=erreur&erreur=Trop de caractére dans le pseudo &retour=ins";
                        </script>
                    <?php
                }
                else if($mpi == $conf){
                    $insert = $db -> prepare("INSERT INTO utilisateur (pseudo, email, mp, ligne) VALUE (:pseudo, :email, :mp, :ligne)");
                    $insert->execute([
                        "pseudo" => $pseudoi,
                        "email" => $emaili,
                        "mp" => $hach,
                        "ligne" => 0
                    ]);
                    ?>
                        <script>
                            window.location.href = "action.php?action=cookie&pseu=<?=$pseudoi?>";
                        </script>
                    <?php
                }
                else{
                    ?>
                    <script>
                        window.location.href = "pop_up.php?type=erreur&erreur=La confirmation du mot de passe n'est pas correcte&retour=ins";
                    </script>
                    <?php
                }
            }
        }
        else{
            ?>
                    <script>
                        window.location.href = "pop_up.php?type=erreur&erreur=Il y a un espace dans le mot de passe&retour=ins";
                    </script>
            <?php
        }
    }
?>
<html>
    <script>
        let image = document.getElementById("image");
        let input = document.getElementById("mpij");

        let image1 = document.getElementById("image1");
        let conf = document.getElementById("conf");

        let image2 = document.getElementById("image2");
        let mpc = document.getElementById("mpc");

        function yeux(){
            if(input.type === "password"){
                input.type = "text";
                image.src = "image/ouvert.png";
            }
            else{
                input.type = "password";
                image.src = "image/fermer.png";
            }
        }
        function yeux1(){
            if(conf.type === "password"){
                conf.type = "text";
                image1.src = "image/ouvert.png";
            }
            else{
                conf.type = "password";
                image1.src = "image/fermer.png";
            }
        }
        function yeux2(){
            if(mpc.type === "password"){
                mpc.type = "text";
                image2.src = "image/ouvert.png";
            }
            else{
                mpc.type = "password";
                image2.src = "image/fermer.png";
            }
        }

        if(mpc.value !== ""){
            window.location.href = "profil.php";
        }
    </script>
</html>
