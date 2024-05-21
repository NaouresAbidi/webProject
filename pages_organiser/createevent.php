<?php
session_start();
include('../db.php'); // Ensure this file contains your PDO connection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orgID = $_SESSION['user_id'];
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $eventStartT = $_POST['eventStartT'];
    $eventEndT = $_POST['eventEndT'];
    $eventLocation = $_POST['eventLocation'];
    $eventDesc = $_POST['eventDesc'];
    $eventNBplaces = $_POST['eventNBplaces'];
    $eventPrice = $_POST['eventPrice'];
    $tagsArray = isset($_POST['tags']) ? $_POST['tags'] : [];
    $tags = implode(',', $tagsArray);
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["eventBanner"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if(getimagesize($_FILES["eventBanner"]["tmp_name"])){
        $check = getimagesize($_FILES["eventBanner"]["tmp_name"]);
    } else{
        $check = false;
    }

    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    if ($_FILES["eventBanner"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["eventBanner"]["tmp_name"], $targetFile)) {
            echo "The file ". htmlspecialchars(basename($_FILES["eventBanner"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    // Insert data into database using prepared statement
    $sql = "INSERT INTO event (ID_ORG, NAME_EV, DATE_EV, T_START, T_END, LOC, DESC_EV, PRICE, BANNER, TAGS_EV, NB_PLACES)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt) {
        $stmt->execute([$orgID, $eventName, $eventDate, $eventStartT, $eventEndT, $eventLocation, $eventDesc, $eventPrice, $targetFile, $tags, $eventNBplaces]);
        // Check for errors
        if ($stmt->errorCode() !== "00000") {
            $errors = $stmt->errorInfo();
            echo "Error: " . $errors[2];
        } else {
            echo "Event created successfully.";
        }
    } else {
        echo "Error preparing statement.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Event</title>
    <style>
       
    </style>
    <link rel="stylesheet" href="../styles/styles-createevent.css">
</head>
<body>
<div class="new-modal-box">
    <span class="close" id="close">&times;</span>
    <form action="createevent.php" method="post" enctype="multipart/form-data">
            <h2>New event</h2>
            <div class="modal-tab">
                <div class="modal-tab-row">
                    <div class="modal-tab-column">
                        <label for="eventName">Name:</label><br>
                        <input type="text" name="eventName" id="eventName" required value="test name"><br>
                        <label for="eventDate">Date:</label><br>
                        <input type="date" name="eventDate" id="eventDate" required value="<?php echo isset($event['DATE_EV']) ? $event['DATE_EV'] : '2024-09-15'; ?>"><br>
                        
                        <div class="event-time-tab">
                            <label for="eventStartT">Starting time:</label><br>
                            <input type="time" name="eventStartT" id="eventStartT" required value="<?php echo isset($event['START_TIME']) ? $event['START_TIME'] : '19:00'; ?>"><br>
                            <label for="eventEndT">Ending time:</label><br>
                            <input type="time" name="eventEndT" id="eventEndT" required value="<?php echo isset($event['END_TIME']) ? $event['END_TIME'] : '22:00'; ?>"><br>
                        </div>
                        
                        <label for="eventLocation">Location:</label><br>
                        <input type="text" name="eventLocation" id="eventLocation" required value="<?php echo isset($event['LOCATION']) ? $event['LOCATION'] : 'locT'; ?>"><br><br>
                        
                        <label for="eventDesc">Description:</label><br>
                        <textarea name="eventDesc" id="eventDesc" rows="7" required><?php echo isset($event['DESCRIPTION']) ? $event['DESCRIPTION'] : 'Lorem ipsum dolor sit amet consectetur...'; ?></textarea>
                    </div>

                    <div class="modal-tab-column">
                        <label for="eventNBplaces">Number of places:</label><br>
                        <input type="number" name="eventNBplaces" id="eventNBplaces" required value="<?php echo isset($event['NB_PLACES']) ? $event['NB_PLACES'] : '100'; ?>"><br><br>

                        <label for="eventPrice">Price:</label><br>
                        <input type="number" name="eventPrice" id="eventPrice" required value="<?php echo isset($event['PRICE']) ? $event['PRICE'] : '20'; ?>"><br><br>

                        <label>Tags:</label><br>
                        <div class="tags-tab">
                        <input type="checkbox" name="tags[]" value="Exposition" <?php echo isset($event['TAGS']) && in_array('Exposition', explode(',', $event['TAGS'])) ? 'checked' : ''; ?>>Exposition<br>
                        <input type="checkbox" name="tags[]" value="Concert" <?php echo isset($event['TAGS']) && in_array('Concert', explode(',', $event['TAGS'])) ? 'checked' : ''; ?>>Concert<br>
                        <input type="checkbox" name ="tags[]" value="Art" <?php echo isset($event['TAGS']) && in_array('Art', explode(',', $event['TAGS'])) ? 'checked' : ''; ?>>Art<br>
                        <input type="checkbox" name ="tags[]" value="Festival" <?php echo isset($event['TAGS']) && in_array('Festival', explode(',', $event['TAGS'])) ? 'checked' : ''; ?>>Festival<br>
                        <input type="checkbox" name="tags[]" value="Music" <?php echo isset($event['TAGS']) && in_array('Music', explode(',', $event['TAGS'])) ? 'checked' : ''; ?>>Music<br>
                        <input type="checkbox" name="tags[]" value="Sport" <?php echo isset($event['TAGS']) && in_array('Sport', explode(',', $event['TAGS'])) ? 'checked' : ''; ?>>Sport<br>
                        </div>
                        <br>

                        <input type="hidden" name="MAX_FILE_SIZE" value="31457280" >

                        <label for="eventBanner">Banner:</label><br>
                        <input type="file" name="eventBanner" id="eventBanner" accept=".png, .jpg, .jpeg" required>
                        <img id="previewBanner" src="<?php echo isset($event['BANNER']) ? $event['BANNER'] : ''; ?>"/>
                    </div>
                </div>
            </div>
            <input type="submit" name="addBtn" id="addBtn" value="Add" class="btn">
        </form>
</div>
</body>
</html>