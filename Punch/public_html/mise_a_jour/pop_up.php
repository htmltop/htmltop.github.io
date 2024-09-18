<html lang = "fr">
<head>
    <meta charset="UTF-8">
    <title><?php
        if($_GET["type"] == "erreur"){
            echo("Erreur");
        }
        else{
            echo("Bienvenue");
        }
    ?></title>
    <link rel = "icon" href = "image/logo.png">
</head>
<style>
    body, html{
        height: 100%;
        background-color: #101728;

    }
    .principale1{
       height: 100%;
       width: 100%;
       display: flex;
       align-items: center;
       justify-content: center;
    }
    
    .error1{
       background-color: blueviolet;
       height: 40%;
       width: 80%;
       border-radius: 50px;
    }

    .croix1{
        height: 50%;
        width: 100%;
        margin-right: 8%;
        margin-top: 2%;
    }
    .fermeture1{
        width: 100%;
        height: 25%;
        display: flex;
        justify-content: flex-end;
    }
    .button1{
        cursor: pointer;
        border: none;
        background: transparent;
        margin-right: 4.5%;
    }

    .croixrouge1{
        height: 30%;
        width: 30%;
        max-height: 7rem;
        max-width: 7rem;
    }

    .divcroix1{
        display: flex;
    }

    .texte1{
        margin-left: 4rem;
        height:25%;
    }
    .para{
        color: white;
        font-size: 2.5rem;
    }
    .h1{
        font-size: 3rem;
    }
</style>
<body>
    <div class="principale1">
     <div class="error1">
        <div class="fermeture1">
            <button onclick = "fermeture()" class = "button1">
                <img class="croix1" src="image/croix.png">
            </button>
        </div>
        <div class="divcroix1">
            <img class="croixrouge1" src=<?php 
                if($_GET["type"] == "erreur"){
                    echo("image/image.png");
                }
                else{
                    echo("image/verif.png");
                }
            ?>>
         <h1 class="h1"><?php               
            if($_GET["type"] == "erreur"){
                    echo("Erreur !");
                }
                else{
                    echo("Bienvenue !");
                }
            ?></h1>
         </div> 
         <div class="texte1"> <p class = "para"><?= $_GET["erreur"]?></p> </div>     
        </div>
     </div>
    </div>
</body>
<script>
function fermeture() {
    <?php 
    if (isset($_GET["retour"])) {
        $location = "";
        if ($_GET["retour"] == "ins") {
            $location = "inscription.php";
        } else if ($_GET["retour"] == "pro") {
            $location = "profil.php";
        }
        echo 'window.location.href = ' . json_encode($location) . ';';
    }
    ?>
}
</script>
</html>