<?php 
    include "connect_base.php";
    session_start();

    if(isset($_COOKIE["pseudo"]) == null){
        header("Location: inscription.php");
        exit();
    }

    $voir = $db->prepare("SELECT * FROM message WHERE id_destinataire = :id_destinataire AND id_auteur = :id_auteur OR id_destinataire = :id_des AND id_auteur = :id_aut");
    $voir -> execute([
        "id_destinataire" => $_COOKIE["pseudo"],
        "id_auteur" => $_SESSION["pseudo"],
        "id_des" => $_SESSION["pseudo"],
        "id_aut" => $_COOKIE["pseudo"]
    ]);
    while($mess = $voir->fetch()){
        if($mess["id_auteur"] == $_COOKIE["pseudo"]){
            ?>
                <div class = "message">
                    <div class = "moi">
                        <p><?= htmlspecialchars($mess["message"])?></p>
                    </div>
                </div>
            <?php
        }
        else{
            ?>
                <div class = "message">
                    <div class = "toi">
                        <p><?= htmlspecialchars($mess["message"])?></p>
                    </div>
                </div>
            <?php
        }
    }
?>
