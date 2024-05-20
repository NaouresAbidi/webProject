<?php
require_once('db.php');
session_start();


if(isset($_GET['idEV'])){
    $id = $_GET['idEV'];
}

$statement = $connexion->query("SELECT * FROM event e, users u WHERE ID_EV=$id");
$ev = $statement->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="styles/eventlist.css">
    <link rel="stylesheet" href="styles/styles_dash_orga.css">
</head>
<body>
<div id="editModal" class="new-modal">
        <div class="new-modal-box">    
        <form action="php/editEvent.php" method="post" enctype="multipart/form-data">
                <h2>Edit event</h2>
                <table class="modal-tab">
                    <tr>
                        <td>
                            <input type="hidden" name="idEV" value="<?php echo $id?>">
                            <label for="eventName">Name : </label><br>
                            <input type="text" name="eventName" id="eventName" required value="<?php echo $ev['NAME_EV'];?>"><br>
                            <label for="eventDate">Date : </label><br>
                            <input type="date" name="eventDate" id="eventDate" required value="<?php echo $ev['DATE_EV'];?>"><br>
                            
                            <label for="eventStartT">Starting time: </label><br>
                            <input type="time" name="eventStartT" id="eventStartT" required value="<?php echo $ev['T_START'];?>"><br>
                            
                            <label for="eventEndT">Ending time : </label><br>
                            <input type="time" name="eventEndT" id="eventEndT" required value="<?php echo $ev['T_END'];?>"><br>
                            
                            <label for="eventLocation">Location : </label><br>
                            <input type="text" name="eventLocation" id="eventLocation" required value="<?php echo $ev['LOC'];?>"><br>
                            
                            <label for="eventDesc">Description : </label><br>
                            <textarea name="eventDesc" id="eventDesc" rows="7" required><?php echo $ev['DESC_EV'];?></textarea>
                        </td>
                        <td>
                            <label for="eventNBplaces">Number of places : </label><br>
                            <input type="number" name="eventNBplaces" id="eventNBplaces" required value="100"><br><br>

                            <label for="eventPrice">Price : </label><br>
                            <input type="number" name="eventPrice" id="eventPrice" required value="<?php echo $ev['PRICE'];?>"><br><br>

                            <table class="tags-tab" width="80%">
                                <tr>
                                    <td>
                                        <?php
                                        $eventTagsArray = explode('|', $ev['TAGS_EV']);
                                        $tagsColumn1 = array("Exposition", "Concert", "Festival");
                                        foreach ($tagsColumn1 as $tag) {
                                            $checked = in_array($tag, $eventTagsArray) ? "checked" : "";
                                            echo '<input type="checkbox" name="tags[]" value="' . $tag . '" ' . $checked . '>' . $tag . '<br>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $tagsColumn2 = array("Art", "Music", "Sport");

                                        foreach ($tagsColumn2 as $tag) {
                                            $checked = in_array($tag, $eventTagsArray) ? "checked" : "";
                                            echo '<input type="checkbox" name="tags[]" value="' . $tag . '" ' . $checked . '>' . $tag . '<br>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>

                            <br>
                            <input type="hidden" name="MAX_FILE_SIZE" value="7145728000" >

                            <label for="eventBanner">Banner : </label><br>
                            <input type="file" name="eventBanner" id="eventBanner" accept=".png, .jpg, .jpeg">
                            <img id="previewBanner" src="php/<?php echo $ev['BANNER'];?>"/>
                        </td>
                    </tr>
                </table>
                <input type="submit" name="editBtn" id="editBtn" value="E D I T" class="btn">

            </form>

            <?php
// // Start session
// // session_start();

// // Check if the session variable is set
// if(isset($_SESSION['edit_event_message'])) {
//     // Display the message
//     echo "<hr>" . $_SESSION['edit_event_message'];

//     // Unset or clear the session variable to prevent displaying the message multiple times
//     unset($_SESSION['edit_event_message']);
// }
?>


        </div>
    </div>
</body>
</html>

