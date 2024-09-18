<?php
include "connect_base.php";
session_start();

if(isset($_COOKIE["pseudo"]) == null){
    header("Location: inscription.php");
    exit();
}

if ($_GET["action"] == "add") {
    $pseudo = $_COOKIE["pseudo"];
    $nom = $_GET["nom"];
    $ver = $db->prepare("SELECT * FROM friend WHERE 
                            (demandeur = :pseudo AND accepteur = :nom) OR 
                            (demandeur = :nom AND accepteur = :pseudo)");
    $ver->execute([
        "pseudo" => $pseudo,
        "nom" => $nom
    ]);
    $verif = $ver->fetch();
    if (!$verif) {
        $add = $db->prepare("INSERT INTO friend (demandeur, accepteur, etat) VALUES (:demandeur, :accepteur, :etat)");
        $add->execute([
            "demandeur" => $pseudo,
            "accepteur" => $nom,
            "etat" => 1 
        ]);
    }
    header("Location: ajout_profil.php");
    exit();
}



if ($_GET["action"] == "accept") {
    $pseudo = $_COOKIE["pseudo"];
    $nom = $_GET["nom"];
    $ver = $db->prepare("SELECT * FROM friend WHERE demandeur = :nom AND accepteur = :pseudo AND etat = 1");
    $ver->execute([
        "pseudo" => $pseudo,
        "nom" => $nom
    ]);
    $verif = $ver->fetch();
    if ($verif) {
        $ac = $db->prepare("UPDATE friend SET etat = 0 WHERE demandeur = :nom AND accepteur = :pseudo AND etat = 1");
        $ac->execute([
            "pseudo" => $pseudo,
            "nom" => $nom
        ]);
        $delete_pending = $db->prepare("DELETE FROM friend WHERE demandeur = :pseudo AND accepteur = :nom AND etat = 1");
        $delete_pending->execute([
            "pseudo" => $pseudo,
            "nom" => $nom
        ]);
    }
    header("Location: message.php");
    exit();
}


if ($_GET["action"] == "sup_dem") {
    $pseudo = $_COOKIE["pseudo"];
    $nom = $_GET["demande"];
    
    $sd = $db->prepare("DELETE FROM friend WHERE demandeur = :pseudo AND accepteur = :accept AND etat = 1");
    $sd->execute([
        "pseudo" => $pseudo,
        "accept" => $nom
    ]);
    header("Location: ajout_profil.php");
    exit();
}


if ($_GET["action"] == "message") {
    $pseudo = htmlspecialchars($_GET['pseudo'], ENT_QUOTES, 'UTF-8');
    $profil = htmlspecialchars($_GET['profil'], ENT_QUOTES, 'UTF-8');
    $url = "discution.php?pseudo=$pseudo&profil=$profil";
    header("Location: $url");
    exit();
}

if($_GET["action"] == "supfriend"){
    $name = $_GET["sup"];
    $bidule = $_GET["name"];
    $sup = $db->prepare("DELETE FROM friend WHERE (demandeur = :dem AND accepteur = :acc) OR (demandeur = :acc AND accepteur = :dem)");
    $sup->execute(["dem"=>$name, "acc" => $bidule]);
    header("Location: ajout_profil.php");
    exit();
}


if($_GET["action"] == "bio"){
    $cook = $db->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
    $cook->execute(["pseudo" => $_COOKIE["pseudo"]]);
    $cook1 = $cook->fetch();
    setcookie("bio", $cook1["bio"]);
    header("Location: profil.php");
    exit();
}

if($_GET["action"] == "amour"){
    $cook2 = $db->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
    $cook2->execute(["pseudo" => $_COOKIE["pseudo"]]);
    $cook3 = $cook2->fetch();
    setcookie("situation_amoureuse", $cook3["situation_amoureuse"]);
    header("Location: profil.php");
    exit();
}

if($_GET["action"] == "prof"){
    $cook4 = $db->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
    $cook4->execute(["pseudo" => $_COOKIE["pseudo"]]);
    $cook5 = $cook4->fetch();
    setcookie("proffessions", $cook5["proffessions"]);
    header("Location: profil.php");
    exit();
}

if($_GET["action"] == "inter"){
    $cook6 = $db->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
    $cook6->execute(["pseudo" => $_COOKIE["pseudo"]]);
    $cook7 = $cook6->fetch();
    setcookie("centre_interet", $cook7["centre_interet"]);
    header("Location: profil.php");
    exit();
}

if($_GET["action"] == "profil"){
    $cook8 = $db->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
    $cook8->execute(["pseudo" => $_COOKIE["pseudo"]]);
    $cook9 = $cook8->fetch();
    setcookie("profil", $cook9["profil"]);
    header("Location: profil.php");
    exit();
}

if($_GET["action"] == "cookie"){
    $dem1 = $db -> prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
    $dem1->execute(["pseudo" => $_GET["pseu"]]);
    $dem = $dem1->fetch();

    $time = 3 * 30 * 24 * 3600;
    setcookie("pseudo", $dem["pseudo"], time() + $time);
    setcookie("mp", $mpc, time() + $time);
    setcookie("id", $dem["id"], time() + $time);
    setcookie("bio", $dem["bio"], time() + $time);
    setcookie("situation_amoureuse", $dem["situation_amoureuse"], time() + $time);
    setcookie("proffessions", $dem["proffessions"], time() + $time);
    setcookie("centre_interet", $dem["centre_interet"], time() + $time);
    setcookie("profil", $dem["profil"], time() + $time);
    header("Location: profil.php");
    exit();
}

if ($_GET["action"] == "deco") {
    setcookie("pseudo", " ");
    setcookie("mp", "", time() - 3 * 30 * 24 * 3600, "/");
    setcookie("id", "", time() - 3 * 30 * 24 * 3600, "/");
    setcookie("bio", "", time() - 3 * 30 * 24 * 3600, "/");
    setcookie("situation_amoureuse", "", time() - 3 * 30 * 24 * 3600, "/");
    setcookie("proffessions", "", time() - 3 * 30 * 24 * 3600, "/");
    setcookie("centre_interet", "", time() - 3 * 30 * 24 * 3600, "/");
    setcookie("profil", "", time() - 3 * 30 * 24 * 3600, "/");

    header("Location: inscription.php");
    exit();
}


if($_GET["action"] == "sup_compte"){
    $sup = $db->prepare("DELETE FROM utilisateur WHERE pseudo = :pseudo");
    $sup->execute(["pseudo" => $_COOKIE["pseudo"]]);
    
    $fri = $db->prepare("DELETE FROM friend WHERE demandeur = :pseudo OR accepteur = :pseudo");
    $fri->execute(["pseudo" => $_COOKIE["pseudo"]]);
    
    $mes = $db->prepare("DELETE FROM message WHERE id_destinataire = :pseudo OR id_auteur = :pseudo");
    $mes->execute(["pseudo" => $_COOKIE["pseudo"]]);
    
    $supimg = $_COOKIE["profil"];
    unlink($supimg);
    
    setcookie("pseudo", " ");
    setcookie("mp", "", time() - 3 * 30 * 24 * 3600, "/");
    setcookie("id", "", time() - 3 * 30 * 24 * 3600, "/");
    setcookie("bio", "", time() - 3 * 30 * 24 * 3600, "/");
    setcookie("situation_amoureuse", "", time() - 3 * 30 * 24 * 3600, "/");
    setcookie("proffessions", "", time() - 3 * 30 * 24 * 3600, "/");
    setcookie("centre_interet", "", time() - 3 * 30 * 24 * 3600, "/");
    setcookie("profil", "", time() - 3 * 30 * 24 * 3600, "/");
    
    header("Location: index.html");
    exit();
}

?>
