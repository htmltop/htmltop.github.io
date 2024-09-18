<?php
    include "connect_base.php";
    session_start();

    $flm = $db->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
    $flm->execute(["pseudo" => $_SESSION["pseudo"]]);
    $flmg = $flm->fetch();
    if($flmg["ligne"] == 1){
        ?>
            <img src = "image/point.png" class = "imgp">
        <?php
    }
?>