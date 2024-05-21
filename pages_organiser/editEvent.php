<?php

require_once('../db.php');

if(isset($_POST['idEV'], $_POST['eventName'], $_POST['eventDate'], $_POST['eventStartT'], $_POST['eventEndT'], $_POST['eventLocation'], $_POST['eventDesc'], $_POST['eventPrice'], $_POST['eventNBplaces'])) {
    $ID_EV = $_POST['idEV'];
    $NAME_EV = $pdo->quote($_POST['eventName']); // Sanitize and quote the string
    $DATE_EV = $_POST['eventDate'];
    $T_START = $_POST['eventStartT'];
    $T_END = $_POST['eventEndT'];
    $LOC = $pdo->quote($_POST['eventLocation']); 
    $DESC_EV = $pdo->quote($_POST['eventDesc']);
    $PRICE = $_POST['eventPrice'];
    $TAGS_EV = 'No tags selected'; 
    $NB_PLACES = $_POST['eventNBplaces'];

    if (isset($_POST['tags'])) {
        $TAGS_EV = implode('|', $_POST['tags']);
    }

    if(isset($_FILES['eventBanner']) && !empty($_FILES['eventBanner']['name'])) {
        $uploadDir = '../Uploads/'; 
        $uploadFile = $uploadDir . basename($_FILES['eventBanner']['name']);
    
        $result = move_uploaded_file($_FILES["eventBanner"]["tmp_name"], $uploadFile);
    
        if($result==TRUE) {
            echo "<hr><b>Le transfert d'image est réalisé !</b>";
            $req = "UPDATE event SET NAME_EV=$NAME_EV, DATE_EV='$DATE_EV', T_START='$T_START', T_END='$T_END', LOC=$LOC, DESC_EV=$DESC_EV, PRICE=$PRICE, TAGS_EV='$TAGS_EV', NB_PLACES=$NB_PLACES, BANNER='$uploadFile' WHERE ID_EV=$ID_EV";
        } else {
            echo "<hr> Erreur de transfert d'image n˚",$_FILES["eventBanner"]["error"];
            $req = "UPDATE event SET NAME_EV=$NAME_EV, DATE_EV='$DATE_EV', T_START='$T_START', T_END='$T_END', LOC=$LOC, DESC_EV=$DESC_EV, PRICE=$PRICE, TAGS_EV='$TAGS_EV', NB_PLACES=$NB_PLACES WHERE ID_EV=$ID_EV";
        }
    } else {
        $req = "UPDATE event SET NAME_EV=$NAME_EV, DATE_EV='$DATE_EV', T_START='$T_START', T_END='$T_END', LOC=$LOC, DESC_EV=$DESC_EV, PRICE=$PRICE, TAGS_EV='$TAGS_EV', NB_PLACES=$NB_PLACES WHERE ID_EV=$ID_EV";
    }

    $result = $pdo->exec($req);

    if($result !== false) {
        echo "<hr>Event edited successfully";
    } else {
        echo "<hr>Failed to edit event";
    }

}
?>
