<?php
    include "connect_base.php";
    session_start();

    if(isset($_COOKIE["pseudo"]) == null){
        header("Location: inscription.php");
        exit();
    }

    $caracbio = 250;
    $carac = 35;

    if(isset($_POST["resultbio"])){
        $resultbio = $_POST["resultbio"];
        if (strlen($resultbio) < $caracbio){
            if(isset($_POST["biod"]) + isset($resultbio)){
                $ajoutbio = $db -> prepare("UPDATE utilisateur SET bio = :bio WHERE pseudo = :pseudo");
                $ajoutbio -> execute(["pseudo" => $_COOKIE["pseudo"], "bio" => $resultbio]);
                header("Location: action.php?action=bio");
                exit();
            }
        }
        else{
            ?>
                <script>
                    window.location.href = "pop_up.php?type=erreur&erreur=Il y a trop de carractère &retour=pro";
                </script>
            <?php
        }
    }


    if(isset($_POST["amour"])){
        $amour = $_POST["amour"];
        if (strlen($amour) < $caracbio){
            if(isset($_POST["situamour"]) + isset($amour)){
                $ajoutbio = $db -> prepare("UPDATE utilisateur SET situation_amoureuse = :situation_amoureuse WHERE pseudo = :pseudo");
                $ajoutbio -> execute(["pseudo" => $_COOKIE["pseudo"], "situation_amoureuse" => $amour]);
                header("Location: action.php?action=amour");
                exit();
            };
        }
        else{
            ?>
                <script>
                    window.location.href = "pop_up.php?type=erreur&erreur=Il y a trop de carractère &retour=pro";
                </script>
            <?php
        }
    }


    if(isset($_POST["prof"])){
        $prof = $_POST["prof"];
        if (strlen($prof) < $carac){
            if(isset($_POST["situprof"]) + isset($prof)){
                $ajoutbio = $db -> prepare("UPDATE utilisateur SET proffessions = :proffessions WHERE pseudo = :pseudo");
                $ajoutbio -> execute(["pseudo" => $_COOKIE["pseudo"], "proffessions" => $prof]);
                header("Location: action.php?action=prof");
                exit();
            }
            else{
                echo(" ");
            }
        }
        else{
            ?>
                <script>
                    window.location.href = "pop_up.php?type=erreur&erreur=Il y a trop de carractère &retour=pro";
                </script>
            <?php
        }
    }




    if(isset($_POST["inter"])){
        $inter = $_POST["inter"];
        if (strlen($inter) < $carac){
            if(isset($_POST["situinter"]) + isset($inter)){
                $ajoutbio = $db -> prepare("UPDATE utilisateur SET  centre_interet= :centre_interet WHERE pseudo = :pseudo");
                $ajoutbio -> execute(["pseudo" => $_COOKIE["pseudo"], "centre_interet" => $inter]);
                header("Location: action.php?action=inter");
                exit();
            }
            else{
                echo(" ");
            }
        }
        else{
            ?>
                <script>
                    window.location.href = "pop_up.php?type=erreur&erreur=Il y a trop de carractère &retour=pro";
                </script>
            <?php
        }
    }


/* input type ="file" = resultprofil
   input type = "submit" = envoiprofil*/ 

    if(isset($_POST["envoiprofil"]) && isset($_FILES["resultprofil"])){
        //dire ou placer l'image
        $debfichier = "profil_image/";
        $fichier = $debfichier.basename($_FILES["resultprofil"]["name"]);

        //crée une variable qui regarde l'extension
        $typefichier = strtolower(pathinfo($fichier,PATHINFO_EXTENSION));

        //verifier si c'est une image
        $check = getimagesize($_FILES["resultprofil"]["tmp_name"]);
        if($check === false){
            ?>
                <script>
                    window.location.href = "pop_up.php?type=erreur&erreur=Le fichier n'est pas une image valide &retour=pro";
                </script>
        <?php
        }
        else{
            //verifier si le fichier existe deja dans le dossier
            if(file_exists($fichier)){
                ?>
                <script>
                    window.location.href = "pop_up.php?type=erreur&erreur=Le fichier existe déjà &retour=pro";
                </script>
            <?php
            }
            else{
                //verifier si le fichier n'est pas trop gros
                if($_FILES["resultprofil"]["size"] > 50000000){
                    ?>
                    <script>
                        window.location.href = "pop_up.php?type=erreur&erreur=Le fichier est trop gros &retour=pro";
                    </script>
                <?php
                }
                else{
                    //autoriser uniquement quelque format de fichier
                    if($typefichier != "jpg" && $typefichier != "png" && $typefichier != "jpeg" && $typefichier != "gif"){
                        ?>
                        <script>
                            window.location.href = "pop_up.php?type=erreur&erreur=Mauvais format de fichier &retour=pro";
                        </script>
                    <?php
                    }
                    else{
                        $sup = $db->prepare("SELECT profil FROM utilisateur WHERE pseudo = :pseudo");
                        $sup->execute(["pseudo" => $_COOKIE["pseudo"]]);
                        $sup = $sup->fetch();

                        $ancien = $sup["profil"];
                        unlink($ancien);

                        if(move_uploaded_file($_FILES["resultprofil"]["tmp_name"], $fichier)){
                            $ajprofil = $db -> prepare("UPDATE utilisateur SET profil = :profil WHERE pseudo = :pseudo");
                            $ajprofil -> execute(["profil" => $fichier, "pseudo" => $_COOKIE["pseudo"]]);

                            header("Location: action.php?action=profil");
                            exit();
                        }
                        else{
                            ?>
                                <script>
                                    window.location.href = "pop_up.php?type=erreur&erreur=une erreur inconnue s'est produite &retour=pro";
                                </script>
                        <?php
                        }
                    }
                }
            }
        }
    }

?>
<html lang = "fr">
    <head>
        <meta charset = "utf-8">
        <title>Profil</title>
        <link rel = "icon" href = "image/logo.png">
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
        .ajoutprofil{
            display: flex;
            justify-content: center;
            align-items: flex-end;
            width: 40%;
            height: 100%;
        }
        .plus{
            position: relative;
            cursor: pointer;
            border: none;
            width: cover;
            height: 50%;
            background-color: #101728;

        }
        .plusimg{
            min-width: 90%;
            min-height: 40%;
            margin-right: 20px;
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
        .butajbio{
            cursor: pointer;
            background-color: #101728;
            width: 180%;
            height: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            border:none;
        }
        .imgajoutbio{
            width: 100%;
            height: cover;
        }

        .boiteinfo{
            width: 100%;
            height: 40%;
            display: flex;
            flex-direction: column;
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

        .butinfo{
            cursor: pointer;
            border: none;
            background-color:#101728;
        }

        .base{
            height: 60%;
            width: 100%;
            background-color: #1d2947;
            display: none;
        }
        .titre{
            font-size: 3rem;
            color:#5E17EB;
        }
        .textarea{
            max-width: 100%;
            max-height: 50%;
            width: 60%;
            height: 30%;
        }
        .envoi{
            border-radius: 30px;
            height: 50px;
            width: 200px;
            background: linear-gradient(to right, rgb(132, 0, 255), rgb(255, 0, 255));
            font-size: 21px;
            border: none;
            cursor: pointer;
        }
        .croix{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .butcroix{
            cursor: pointer;
            border-radius: 10px;
            width: 4rem;
            height: 4rem;
            display: flex;
            justify-content: center;
            align-items: center;
            border: none;
            background-color: #1d2947;
        }
        .imgcroix{
            width: 120%;
            height: 100%;
            border-radius: 30px;
        }

        input[type = "file"]{
            width: 100%;
            height: 7%;
            background-color: #101728;
            font-size: 2rem;
            text-align: center;
            border-radius: 10px;
            cursor: pointer;
            color: white;
        }

        .paraverif{
            color: #FF3A1B;
            font-size: 2rem; 
        }
        .logoprin{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .butregle{
            width: 15%;
            height: 100%;
            border: none;
            background: transparent;
        }
        .imgregle{
            height: 60%;
            width: 60%;
        }
        .bodyregle{
            height: 100%;
            width: 100%;
            display: none;
        }
        .imgfle{
            width: 100%;
            height: 4%;
        }
        .flre{
            cursor: pointer;
            background: transparent;
            border: none;
        }
        .hrefprin{
            width: 100%;
            height: 7%;
            border-bottom: 1px solid white;
            border-top: 1px solid white;
            background: transparent;
            display: flex;
            align-items: center;
        }
        .htruc{
            color: white;
            font-size: 3.5rem;
            margin-left: 7rem;
        }
        .ahref{
            text-decoration: none;
        }
    </style>
    <body>
        <div id = "pop_up">
            <div class = "logoprin">
                <div class = "logo">
                    <img src = "image/logo.png" class = "logoimg">
                    <h1 translate="no">Punch</h1>
                </div>
                
                <button onclick = "reglage()" class = "butregle">
                    <img src = "image/parametre.png" class = "imgregle">
                </button>
            </div>
            <br>
            <div class = "imgpseu" id = "pseu">
                <div class = "ajoutprofil">
                    <img src = <?php 
                    if(isset($_COOKIE["profil"])){
                        echo($_COOKIE["profil"]);
                    }
                    else{
                        echo("image/profil_fond.png");
                    }
                    ?> class = "imgprofil">
                    <button onclick = "ajoutimg()" class = "plus">
                        <img src = "image/ajout_profil.png" class = "plusimg">
                    </button>
                </div>
                <h2><?= $_COOKIE["pseudo"]?></h2>
            </div>

            <div class = "boitebio" id = "boitebio">
                <div class = "bio">
                    <p class = "pbio"><?php 


                    if(isset($_COOKIE["bio"])){
                        echo($_COOKIE["bio"]);
                    }
                    else{
                        echo("bio: ".$_COOKIE["pseudo"]);
                    }
                    
                    ?></p>
                </div>
                <div class = "butbio">
                    <button onclick = "ajoutbio()" class = "butajbio">
                        <img src = "image/ajout_bio.png" class = "imgajoutbio">
                    </button>
                </div>
            </div>

            <div class = "boiteinfo" id = "boiteinfo">
                <p class = "supinfo">Infos supplémentaires: </p>
                <br>
                <div class = "info">
                    <p class = "parainfo">Situation amoureuse: </p>
                    <p class = "reponse"><?php
                        if(isset($_COOKIE["situation_amoureuse"])){
                            echo($_COOKIE["situation_amoureuse"]);
                        }
                        else{
                            echo("");
                        }
                    ?></p>
                    <button onclick = "sitamour()" class = "butinfo">
                        <img src = "image/ajout_bio.png">
                    </button>
                </div>

                <div class = "info">
                    <p class = "parainfo">Profession: </p>
                    <p class = "reponse"><?php 
                        if(isset($_COOKIE["proffessions"])){
                            echo($_COOKIE["proffessions"]);
                        }
                        else{
                            echo("");
                        }
                    ?></p>
                    <button onclick = "sitprof()" class = "butinfo">
                        <img src = "image/ajout_bio.png">
                    </button>
                </div>

                <div class = "info">
                    <p class = "parainfo">Centre d'intéret:  </p>
                    <p class = "reponse"><?php 
                        if(isset($_COOKIE["centre_interet"])){
                            echo($_COOKIE["centre_interet"]);
                        }
                        else{
                            echo("");
                        }
                    ?></p>
                    <button onclick = "sitinteret()" class = "butinfo">
                        <img src = "image/ajout_bio.png">
                    </button>
                </div>
            </div>

            <div class = "base" id = "profil">
                <div class = "croix">
                    <p class = "titre">Modifier le profil:  </p>
                    <button onclick = "fermer()" class = "butcroix">
                        <img src = "image/croix.png" class = "imgcroix">
                    </button>
                </div>
                <br>
                <form method="post" enctype = "multipart/form-data">
                    <input type = "file" class = "file" name = "resultprofil" value = "Choisir une photos de profil">
                    <br><br><br><br>
                    <input type = "submit" value = "Enregistré" class = "envoi" name = "envoiprofil">
                </form>
                <br><br>
                <p class = "paraverif">Merci de bien vérifier que votre image soit carré !</p>
            </div>

            <?php 
                $secu = $db->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
                $secu->execute(["pseudo" => $_COOKIE["pseudo"]]);
                $secur = $secu->fetch();
            ?>

            <div class = "base" id = "bio">
                <div class = "croix">
                    <p class = "titre">Modifier la bio:  </p>
                    <button onclick = "fermer()" class = "butcroix">
                        <img src = "image/croix.png" class = "imgcroix">
                    </button>
                </div>
                <br>
                <form method="post">
                    <textarea type = "text" class = "textarea" name = "resultbio"><?php
                    if(isset($_COOKIE["bio"])){
                        echo($_COOKIE["bio"]);
                    }
                    else{
                        echo(" ");
                    }    
                    ?></textarea>
                    <br>
                    <input type = "submit" value = "Enregistré" class = "envoi" name = "biod">
                </form>
            </div>
            
            <div class = "base" id = "situamour">
                <div class = "croix">
                    <p class = "titre">Situation amoureuse: </p>
                    <button onclick = "fermer()" class = "butcroix">
                        <img src = "image/croix.png" class = "imgcroix">
                    </button>
                </div>
                <br>
                <form method="post">
                    <textarea type = "text" class = "textarea" name = "amour"><?php
                    if(isset($_COOKIE["situation_amoureuse"])){
                        echo($_COOKIE["situation_amoureuse"]);
                    }
                    else{
                        echo (" ");
                    }    
                    ?></textarea>
                    <br>
                    <input type = "submit" value = "Enregistré" class = "envoi" name = "situamour">
                </form>
            </div>

            <div class = "base" id = "situprof">
                <div class = "croix">
                    <p class = "titre">Proffessions:  </p>
                    <button onclick = "fermer()" class = "butcroix">
                        <img src = "image/croix.png" class = "imgcroix">
                    </button>
                </div>
                <br>
                <form method="post">
                    <textarea type = "text" class = "textarea" name = "prof"><?php
                    if(isset($_COOKIE["proffessions"])){
                        echo($_COOKIE["proffessions"]);
                    }
                    else{
                        echo(" ");
                    }
                    ?></textarea>
                    <br>
                    <input type = "submit" value = "Enregistré" class = "envoi" name = "situprof">
                </form>
            </div>

            <div class = "base" id = "situinter">
                <div class = "croix">
                    <p class = "titre">Centre d'intéret: </p>
                    <button onclick = "fermer()" class = "butcroix">
                        <img src = "image/croix.png" class = "imgcroix">
                    </button>
                </div>
                <br>
                <form method="post">
                    <textarea type = "text" class = "textarea" name = "inter"><?php 
                    if(isset($_COOKIE["centre_interet"])){
                        echo($_COOKIE["centre_interet"]);
                    }
                    else{
                        echo(" ");
                    }
                    ?></textarea>
                    <br>
                    <input type = "submit" value = "Enregistré" class = "envoi" name = "situinter">
                </form>
            </div>


            <div class = "bodyregle" id = "bodyregle">
                <button onclick = "reglefermer()" class = "flre">
                    <img src = "image/fleche.png" class = "imgfle">
                </button>
                <br>
                <a href = "action.php?action=deco" class = "ahref">
                    <div class = "hrefprin">
                        <label class = "htruc">Déconnexion</label>
                    </div>
                </a>
                
                <a href = "action.php?action=sup_compte" class = "ahref">
                    <div class = "hrefprin">
                        <label class = "htruc">Supprimer le compte</label>
                    </div>
                </a>
            </div>

            <div class = "footer">
                <button onclick = "message()" class = "butnav">
                    <img src = "image/message.png" class = "imgnav">
                </button>
                <button onclick = "profil()" class = "butnav">
                    <img src = "image/profil_bleu.png" class = "imgnav">
                </button>
                <button onclick = "ajout()" class = "butnav">
                    <img src = "image/ajout.png" class = "imgnav">
                </button>
            </div>
        </div>
    </body>
    <script>
        let boitebio = document.getElementById("boitebio");
        let boiteinfo = document.getElementById("boiteinfo");

        let bio = document.getElementById("bio");

        let situamour = document.getElementById("situamour");
        let situprof = document.getElementById("situprof");
        let situinter = document.getElementById("situinter");
        let profil = document.getElementById("profil");

        let pseu = document.getElementById("pseu")

        let corps = document.getElementById("pop_up");
        
        let bodyregle = document.getElementById("bodyregle");

        function nonedis(){
            boitebio.style.display = "none";
            boiteinfo.style.display = "none";
        }

        function fermer(){
            boitebio.style.display = "block";
            boitebio.style.display = "flex";
            boiteinfo.style.display = "block";
            situamour.style.display = "none";
            situprof.style.display = "none";
            situinter.style.display = "none";
            bio.style.display = "none";
            profil.style.display = "none";
        }

        function ajoutbio(){
            nonedis();
            bio.style.display = "block";
        }
        function sitamour(){
            nonedis();
            situamour.style.display = "block";
        }
        function sitprof(){
            nonedis();
            situprof.style.display = "block";
        }
        function sitinteret(){
            nonedis();
            situinter.style.display = "block";
        }
        function ajoutimg(){
            nonedis();
            profil.style.display = "block";
        }

        function message(){
            location.href = "message.php";
        }
        function ajout(){
            location.href = "ajout_profil.php";
        }

        function popf(){
            corps.style.display = "none";
        }
        function popo(){
            corps.style.display = "block";
        }
        
        function reglage(){
            boitebio.style.display = "none";
            boiteinfo.style.display = "none";
            pseu.style.display = "none";
            bodyregle.style.display = "block";
        }
        function reglefermer(){
            boitebio.style.display = "block";
            boitebio.style.display = "flex";
            boiteinfo.style.display = "block";
            pseu.style.display = "block";
            pseu.style.display = "flex" ;
            bodyregle.style.display = "none";
        }
    </script>
</html>