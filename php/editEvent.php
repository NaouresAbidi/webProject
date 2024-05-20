<?php

// use function PHPSTORM_META\type;

// require_once('Connexion.php');

// if(isset($_GET['idEV'])){
//     $id = $_GET['idEV'];
// }



//     // ------ A D D -- E V E N T ------------------
//     // $req = "UPDATE event SET NAME_EV=$NAME_EV, DATE_EV=$DATE_EV, T_START=$T_START, T_END=$T_END, LOC=$LOC, DESC_EV=$DESC_EV, PRICE=$PRICE, BANNER=$uploadFile, TAGS_EV=$TAGS_EV, NB_PLACES=$NB_PLACES WHERE ID_EV=$ID_EV";
    
// // } else{
//     // $req = "UPDATE event SET NAME_EV=$NAME_EV, DATE_EV=$DATE_EV, T_START=$T_START, T_END=$T_END, LOC=$LOC, DESC_EV=$DESC_EV, PRICE=$PRICE, TAGS_EV=$TAGS_EV, NB_PLACES=$NB_PLACES WHERE ID_EV=$ID_EV";
//     $req = "UPDATE event SET NAME_EV=$NAME_EV WHERE ID_EV=$ID_EV";
// // }

// $result = $connexion->exec($req);

// if($result)
//     echo "<hr>Event edited successfully";
// else
//     echo "<hr>Failed to edit event";

?>


<?php

// require_once('Connexion.php');

// // Check if the necessary data is received via POST
// if(isset($_POST['idEV'], $_POST['eventName'], $_POST['eventDate'], $_POST['eventStartT'], $_POST['eventEndT'], $_POST['eventLocation'], $_POST['eventDesc'], $_POST['eventPrice'], $_POST['eventNBplaces'])) {
//     // Sanitize and retrieve form data
//     $ID_EV = $_POST['idEV'];
//     $NAME_EV = $connexion->quote($_POST['eventName']); // Sanitize and quote the string
//     $DATE_EV = $_POST['eventDate'];
//     $T_START = $_POST['eventStartT'];
//     $T_END = $_POST['eventEndT'];
//     $LOC = $connexion->quote($_POST['eventLocation']); // Sanitize and quote the string
//     $DESC_EV = $connexion->quote($_POST['eventDesc']); // Sanitize and quote the string
//     $PRICE = $_POST['eventPrice'];
//     $TAGS_EV = 'No tags selected'; // You may handle tags separately
//     $NB_PLACES = $_POST['eventNBplaces'];

//     if (isset($_POST['tags'])) {
//         $TAGS_EV = $_POST['tags'][0];
    
//         for ($i = 1; $i < count($_POST['tags']); $i++) {
//             $TAGS_EV .= '|' . $_POST['tags'][$i];
//         } 
//     }

//     if(isset($_FILES['eventBanner'])) {
//         $uploadDir = 'Uploads/'; 

//         if($_FILES['eventBanner']['name']==''){
//             $req = "UPDATE event SET NAME_EV=$NAME_EV, DATE_EV='$DATE_EV', T_START='$T_START', T_END='$T_END', LOC=$LOC, DESC_EV=$DESC_EV, PRICE=$PRICE, TAGS_EV='$TAGS_EV', NB_PLACES=$NB_PLACES WHERE ID_EV=$ID_EV";

                    

//         } else{
//             $uploadFile = $uploadDir . basename($_FILES['eventBanner']['name']);
        
//             $result = move_uploaded_file($_FILES["eventBanner"]["tmp_name"], $uploadFile);
    
//             if($result==TRUE) {
//                 echo "<hr><b>Le transfert d'image est réalisé !</b>";
//             } 
//             else {
//                 echo "<hr> Erreur de transfert d'image n˚",$_FILES["eventBanner"]["error"];
//             }

//             $req = "UPDATE event SET NAME_EV=$NAME_EV, DATE_EV='$DATE_EV', T_START='$T_START', T_END='$T_END', LOC=$LOC, DESC_EV=$DESC_EV, PRICE=$PRICE, TAGS_EV='$TAGS_EV', NB_PLACES=$NB_PLACES, BANNER=$uploadFile WHERE ID_EV=$ID_EV";


//         }
       

//         // echo $uploadFile;
//     }

//     $req = "UPDATE event SET NAME_EV=$NAME_EV, DATE_EV='$DATE_EV', T_START='$T_START', T_END='$T_END', LOC=$LOC, DESC_EV=$DESC_EV, PRICE=$PRICE, TAGS_EV='$TAGS_EV', NB_PLACES=$NB_PLACES WHERE ID_EV=$ID_EV";

//     $result = $connexion->exec($req);

//     if($result !== false) {
//         echo "<hr>Event edited successfully";
//     } else {
//         echo "<hr>Failed to edit event";
//     }
// } else {
//     echo "<hr>Required data not received";
// }
?>

<?php

require_once('Connexion.php');

if(isset($_POST['idEV'], $_POST['eventName'], $_POST['eventDate'], $_POST['eventStartT'], $_POST['eventEndT'], $_POST['eventLocation'], $_POST['eventDesc'], $_POST['eventPrice'], $_POST['eventNBplaces'])) {
    $ID_EV = $_POST['idEV'];
    $NAME_EV = $connexion->quote($_POST['eventName']); // Sanitize and quote the string
    $DATE_EV = $_POST['eventDate'];
    $T_START = $_POST['eventStartT'];
    $T_END = $_POST['eventEndT'];
    $LOC = $connexion->quote($_POST['eventLocation']); 
    $DESC_EV = $connexion->quote($_POST['eventDesc']);
    $PRICE = $_POST['eventPrice'];
    $TAGS_EV = 'No tags selected'; 
    $NB_PLACES = $_POST['eventNBplaces'];

    if (isset($_POST['tags'])) {
        $TAGS_EV = implode('|', $_POST['tags']);
    }

    if(isset($_FILES['eventBanner']) && !empty($_FILES['eventBanner']['name'])) {
        $uploadDir = 'Uploads/'; 
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

    $result = $connexion->exec($req);

    if($result !== false) {
        // $_SESSION['edit_event_message'] = "Event edited successfully";

        echo "<hr>Event edited successfully";
    } else {
        echo "<hr>Failed to edit event";
        // $_SESSION['edit_event_message'] = "Failed to edit event";

    }
    // header("Location: ../editEventPage.php");

} else {
    echo "<hr>Required data not received";
}
?>
