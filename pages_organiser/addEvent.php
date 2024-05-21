<?php

use function PHPSTORM_META\type;

require_once('../db.php');

// ------ F O R M -- D A T A ------------------

    $ID_ORG = $_POST['orgID'];
    $NAME_EV = $_POST['eventName'];
    $DATE_EV = $_POST['eventDate'];
    $T_START = $_POST['eventStartT'];
    $T_END = $_POST['eventEndT'];
    $LOC = $_POST['eventLocation'];
    $DESC_EV = $_POST['eventDesc'];
    $PRICE = $_POST['eventPrice'];
    $TAGS_EV = 'No tags selected';
    $NB_PLACES = $_POST['eventNBplaces'];

    if (isset($_POST['tags'])) {
        $TAGS_EV = $_POST['tags'][0];

        for ($i = 1; $i < count($_POST['tags']); $i++) {
            $TAGS_EV .= '|' . $_POST['tags'][$i];
        } 
    }


if(isset($_FILES['eventBanner'])) {
    $uploadDir = '../Uploads/';
    $uploadFile = $uploadDir . basename($_FILES['eventBanner']['name']);
    
    $result = move_uploaded_file($_FILES["eventBanner"]["tmp_name"], $uploadFile);

    if($result==TRUE) {
        echo "<hr><b>Le transfert d'image est réalisé !</b>";
    } 
    else {
        echo "<hr> Erreur de transfert d'image n˚",$_FILES["eventBanner"]["error"];
    }

}


// ------ A D D -- E V E N T ------------------

$reqPrepare = $pdo->prepare("INSERT INTO event (ID_ORG, NAME_EV, DATE_EV, T_START, T_END, LOC, DESC_EV, PRICE, BANNER, TAGS_EV, NB_PLACES) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$tab = array($ID_ORG, $NAME_EV, $DATE_EV, $T_START, $T_END, $LOC, $DESC_EV, $PRICE, $uploadFile, $TAGS_EV, $NB_PLACES);
$result = $reqPrepare->execute($tab);

if($result)
    echo "<hr>Event added successfully";
else
    echo "<hr>Failed to add event";


?>