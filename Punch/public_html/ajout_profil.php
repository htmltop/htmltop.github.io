<?php
    include "connect_base.php";
    session_start();

    if(isset($_COOKIE["pseudo"]) == null){
        header("Location: inscription.php");
        exit();
    }
?>
<html>
    <head>
        <meta charset = "utf-8">
        <title>Ajout</title>
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

        .principale{
            height: 85%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .pseudo{
            width: 100%;
            height: 90%;
            background-color:#101728;
            overflow: auto;
        }
        .user{
            background-color: #101728;
            width: 100%;
            height: 14%;
            max-height: 17%;
            border-bottom: white solid 1.5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .imgprofil{
            width: 130%;
            height: 100%;
            border-radius: 100%;
            max-width: 150px;
            max-height: 150px;
        }

        .para{
            line-height: 22px;
            text-align: center;
        }
        .pseu{
            color: #613dd1;
            font-size: 4rem;
        }
        .bio{
            color: white;
            font-size: 2rem;
            max-width: 270px;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .recherche{
            width: 100%;
            height: 5%;
            border-radius: 50px;
            border: none;
            font-size: 2rem;
            margin-bottom: 3%;
        }


        .hidden{
            display: none;
        }

        .hajout{
            cursor: pointer;
            width: 21%;
            text-decoration:none;
            color: white;
        }
        .imgajout{
            width: 90%;
            height: 50%;
        }

        .amie{
            display: flex;
            justify-content: space-between;
        }

        .tout{
            width: 100%;
            height: 100%;
        }
        .principe{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .demande_att{
            margin-left: 10%;
            width: 110%;
            height: 40rem;
            max-height: 20%;
            overflow: auto;
            background-color: #101728;
            border-radius: 10px;
        }
        .tout{
            display: none;
        }
        .butfermer{
            border-radius: 100%;
            width: 5rem;
            height: 5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            float: right;
        }
        .imgcroix{
            width: 5rem;
            height: 5rem;
            border-radius: 100%;
        }
        p{
            color: white;
            font-size: 3.2rem;
        }
        .supde{
            /*margin-left: 25%;*/
            color: #85FF8E;
            text-decoration: none;
        }
        .hra{
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .imgpp{
            width: 7rem;
            height: 7rem;
            border-radius: 100%;
        }
        .supfriend{
            display: flex;
            align-items: center;
            justify-content: space-between;

            height: 10rem;
        }
        .rien{
            font-size: 2rem;
            /*margin-left: 25%;*/
            text-decoration: none;
        }

        .choix{
            width: 100%;
            height: 4%;
            display: flex;
            justify-content: space-around;
        }
        .butajoutf{
            border: none;
            background-color: #101728;
            cursor: pointer;
        }
        .butchoix{
            font-size: 2.5rem;
        }
        .butchoix1{
            font-size: 2.5rem;
            color: #7140dc;
        }

        .divajout{
            background-color: transparent;
            width: 100%;
            height: 90%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .pov{
            background: linear-gradient(to right, rgb(132, 0, 255), rgb(255, 0, 255));
            width: 90%;
            height: 40%;
            border-radius: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        h3{
            font-size: 2rem;
        }
        .principaleboite{
            background-color: transparent;
            width: 16rem;
            height: 98%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .boutonb{
            background: linear-gradient(to right, rgb(132, 0, 255), rgb(255, 0, 255));
            width: 85%;
            height: 58%;
            cursor: pointer;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        label{
            color: white;
            font-size: 2.5rem;
            text-decoration: none;
        }

        .deman{
            width: 100%;
            height: 10rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .ptnflm{
            display: flex;
            align-items: center;
        }
    </style>
    <body>
        <div class = "amie">
            <div class = "logo">
                <img src = "image/logo.png" class = "logoimg">
                <h1>Punch</h1>
            </div>
        </div>

        <div class = "choix">
            <button onclick = "fermer()" class = "butajoutf">
                <p class = "butchoix1" id = "pajoutfriend">Ajouter des amis</p>
            </button>

            <button onclick = "montrer()" class = "butajoutf">
                <p class = "butchoix" id = "pmyfriend">Mes amis</p>
            </button>
        </div>

        <br>
        <div class = "principale" id = "principale">
            <div class = "pseudo">
            <input type = "text" class = "recherche" placeholder = "Rechercher un utilisateur" id = "search">
                <?php 
                    function estAmi($db, $utilisateur1, $utilisateur2) {
                        $stmt = $db->prepare("
                            SELECT COUNT(*) FROM friend 
                            WHERE (demandeur = :utilisateur1 AND accepteur = :utilisateur2 AND etat = 0) 
                               OR (demandeur = :utilisateur2 AND accepteur = :utilisateur1 AND etat = 0)
                        ");
                        $stmt->execute([
                            'utilisateur1' => $utilisateur1,
                            'utilisateur2' => $utilisateur2
                        ]);
                        return $stmt->fetchColumn() > 0;
                    }
                    
                    $base = $db->query("SELECT * FROM utilisateur");
                    while ($user = $base->fetch()) {
                        if ($user["pseudo"] != $_COOKIE["pseudo"] && !estAmi($db, $_COOKIE["pseudo"], $user["pseudo"])) {
                    ?>
                    <div class="user">
                        <a href="profil_utilisateur.php?pseudo=<?= $user["pseudo"] ?>&bio=<?= $user["bio"] ?>&situ_amour=<?= $user["situation_amoureuse"] ?>&situ_prof=<?= $user["proffessions"] ?>&centre=<?= $user["centre_interet"] ?>&profil=<?= htmlspecialchars($user["profil"]) ?>">
                        <img src=<?= $user["profil"] ? $user["profil"] : "image/profil_fond.png" ?> class="imgprofil">
                    </a>
                    <div class="para">
                        <h1 class="pseu"><?= $user["pseudo"] ?></h1>
                        <p class="bio"><?= $user["bio"] ?></p>
                    </div>
                    <a href='action.php?action=add&nom=<?= $user["pseudo"] ?>' class="hajout">
                        <div class = "divajout">
                            <div class = "pov">
                                <h3>Ajouter</h3>
                            </div>
                        </div>
                    </a>
            </div>
            <?php
                    }
                    }
                ?>
            </div>
        </div>

        <div class = "tout" id = "tout">
            <div class = "principe">
                <h1>Demande en attente:</h1>
                <div class = "demande_att">
                    <?php
                        $select = $db->prepare("SELECT * FROM friend WHERE demandeur = :demandeur AND etat = 1");
                        $select->execute([
                            "demandeur" => $_COOKIE["pseudo"]
                        ]);
                    
                        while($demande = $select->fetch()){
                            $flm1 = $db->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
                            $flm1->execute(["pseudo" => $demande["accepteur"]]);
                            $flm = $flm1->fetch();
                            ?>
                                <div class = "deman">
                                    <div class = "ptnflm">
                                        <a href = "profil_utilisateur.php?pseudo=<?=$flm["pseudo"]?>&bio=<?=$flm["bio"]?>&situ_amour=<?=$flm["situation_amoureuse"]?>&situ_prof=<?=$flm["proffessions"]?>&centre=<?=$flm["centre_interet"]?>&profil=<?=htmlspecialchars($flm["profil"])?>">
                                        <img class = "imgpp" src = <?php
                                                if(!empty($flm["profil"])){
                                                    echo($flm["profil"]);
                                                }
                                                else{
                                                    echo("image/profil_fond.png");
                                                }
                                                ?> >
                                        </a>
                                        <a href = "profil_utilisateur.php?pseudo=<?=$flm["pseudo"]?>&bio=<?=$flm["bio"]?>&situ_amour=<?=$flm["situation_amoureuse"]?>&situ_prof=<?=$flm["proffessions"]?>&centre=<?=$flm["centre_interet"]?>&profil=<?=htmlspecialchars($flm["profil"])?>" class = "hra">
                                            <p><?=$demande["accepteur"]?></p>
                                        </a>
                                    </div>

                                    <a href = "action.php?action=sup_dem&demande=<?=$demande["accepteur"]?>" class = "supde">
                                        <div class = "principaleboite">
                                            <div class = "boutonb">
                                                <label>Suprimer</label>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                        }
                    ?>
                </div>

                <h1>Vos amis:</h1>
                <div class = "demande_att">
                    <?php
                        $select1 = $db->prepare("SELECT * FROM friend WHERE demandeur = :demandeur OR accepteur = :accepteur AND etat = :etat");
                        $select1->execute([
                            "demandeur" => $_COOKIE["pseudo"],
                            "accepteur" => $_COOKIE["pseudo"],
                            "etat" => 0
                        ]);
                        while($friend = $select1->fetch()){
                            if($friend["etat"] == 0){
                                if($_COOKIE["pseudo"] == $friend["demandeur"]){
                                    $prof = $db -> prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
                                    $prof->execute(["pseudo" => $friend["accepteur"]]);
                                    $prof1 = $prof->fetch();
                                    ?>
                                        <div class = "supfriend">
                                            <a href = "profil_utilisateur.php?pseudo=<?=$prof1["pseudo"]?>&bio=<?=$prof1["bio"]?>&situ_amour=<?=$prof1["situation_amoureuse"]?>&situ_prof=<?=$prof1["proffessions"]?>&centre=<?=$prof1["centre_interet"]?>&profil=<?=htmlspecialchars($prof1["profil"])?>" class = "hra">
                                                <img src = <?php
                                                if(!empty($prof1["profil"])){
                                                    echo($prof1["profil"]);
                                                }
                                                else{
                                                    echo("image/profil_fond.png");
                                                }
                                                ?> class = "imgpp">
                                                <p><?=$friend["accepteur"]?></p>
                                            </a>
                                            <a href = "action.php?action=supfriend&sup=<?=$prof1["pseudo"]?>&name=<?=$_COOKIE["pseudo"]?>" class = "rien">
                                                <div class = "principaleboite">
                                                    <div class = "boutonb">
                                                        <label>Suprimer</label>
                                                    </div>
                                                </div>
                                            </a>
                                            
                                        </div>
                                    <?php
                                }
                                else{
                                    $prof2 = $db -> prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
                                    $prof2->execute(["pseudo" => $friend["demandeur"]]);
                                    $prof3 = $prof2->fetch();
                                    ?>
                                        <div class = "supfriend">
                                            <a href = "profil_utilisateur.php?pseudo=<?=$prof3["pseudo"]?>&bio=<?=$prof3["bio"]?>&situ_amour=<?=$prof3["situation_amoureuse"]?>&situ_prof=<?=$prof3["proffessions"]?>&centre=<?=$prof3["centre_interet"]?>&profil=<?=htmlspecialchars($prof3["profil"])?>" class = "hra">
                                                <img src = <?php
                                                if(!empty($prof3["profil"])){
                                                    echo($prof3["profil"]);
                                                }
                                                else{
                                                    echo("image/profil_fond.png");
                                                }
                                                ?> class = "imgpp">
                                                <p><?=$friend["demandeur"]?></p>
                                            </a>
                                            <a href = "action.php?action=supfriend&pseudo=<?=$prof3["pseudo"]?>" class = "rien">
                                                <div class = "principaleboite">
                                                    <div class = "boutonb">
                                                        <label>Suprimer</label>
                                                    </div>
                                                </div>
                                            </a>
                                            
                                        </div>
                                    <?php
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>


        <div class = "footer">
            <button onclick = "message()" class = "butnav">
                <img src = "image/message.png" class = "imgnav">
            </button>
            <button onclick = "profil()" class = "butnav">
                <img src = "image/profil.png" class = "imgnav">
            </button>
            <button onclick = "ajout()" class = "butnav">
                <img src = "image/ajout_bleu.png" class = "imgnav">
            </button>
        </div>
    </body>
    <script>
        function profil(){
            location.href = "profil.php";
        }
        function message(){
            location.href = "message.php";
        }

        document.getElementById('search').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let users = document.querySelectorAll('.user');
            let found = false;

            users.forEach(function(user) {
                let pseudo = user.querySelector('.pseu').textContent.toLowerCase();
                if (pseudo.includes(filter)) {
                    user.classList.remove('hidden');
                    found = true;
                } else {
                    user.classList.add('hidden');
                }
            });
        });

        let principale = document.getElementById("principale");
        let tout = document.getElementById("tout");

        let pajoutfriend = document.getElementById("pajoutfriend");
        let pmyfriend = document.getElementById("pmyfriend");

        function montrer(){
            principale.style.display = "none";
            tout.style.display = "block";

            pajoutfriend.style.color = "white";
            pmyfriend.style.color = "#7140dc";
        }

        function fermer(){
            pajoutfriend.style.color = "#7140dc";
            pmyfriend.style.color = "white";

            principale.style.display = "block";
            principale.style.display = "flex";
            tout.style.display = "none";
        }
    </script>
</html>