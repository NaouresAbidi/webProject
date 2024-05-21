<?php
session_start();
include('../db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages_website_connexion/signin.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$event_id = isset($_GET['id']) ? $_GET['id'] : null;  

if ($event_id) {
    $events_query = "SELECT event.*, users.FIRSTNAME_U, users.LASTNAME_U, users.PFP_U, users.EMAIL_U, users.TEL_U
                     FROM event 
                     JOIN users ON event.ID_EV= users.ID_U
                     WHERE event.ID_EV = ?";
    $stmt = $pdo->prepare($events_query);
    $stmt->execute([$event_id]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$event) {
        echo "Event not found.";
        exit;
    }
} else {
    echo "No event ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/styles-event.css">
    <style>
        .title {
            background-image: url("../<?php echo htmlspecialchars($event['BANNER']); ?>") !important;
        }
        .form-container {
            background-image: url("../<?php echo htmlspecialchars($event['BANNER']); ?>");
        }
    </style>
</head>
<body>
    <div class="title">
        <div class="test">
            <h1><?php echo htmlspecialchars($event['NAME_EV']); ?></h1>
        </div>
    </div>
    <div class="main-div">
        <div class="top-section">
            <div class="left-section">
                <div class="date-container">
                    <h2>DATE AND TIME</h2>
                    <hr>
                    <p><?php echo htmlspecialchars($event['DATE_EV']); ?></p>
                    <p><?php echo htmlspecialchars($event['T_START']); ?> - <?php echo htmlspecialchars($event['T_END']); ?></p>
                </div>
                <br><br>
                <div class="location">
                    <img class="icon" src="../Media/Icon Address.png">
                    <h2>LOCATION</h2>
                    <p><?php echo htmlspecialchars($event['LOC']); ?></p>
                </div>
            </div>
            <div class="right-section">
                <br><br><br>
                <p>Price: <?php echo htmlspecialchars($event['PRICE']); ?>$</p>
                <br>
                <a href="buy-ticket.php?event_id=<?php echo htmlspecialchars($event['ID_EV']); ?>">
                    <button class="btn">GET YOUR TICKET</button>
                </a>
            </div>
        </div>
        <h2>ABOUT THIS EVENT</h2>
        <br><br>
        <div class="event-desc-container">
            <?php echo nl2br(htmlspecialchars($event['DESC_EV'])); ?>
        </div>
        <br><br>
        <h2>TAGS</h2>
        <br><br>
        <div class="tags">
            <?php 
            $tags = explode("|", $event['TAGS_EV']);
            foreach($tags as $tag) {
                echo '<div class="tag">' . htmlspecialchars($tag) . '</div>';
            }
            ?>
        </div>
        <br><br><br>
        <h2>ORGANISED BY</h2>
        <br><br>
        <div class="organiser-container">
            <img src="../<?php echo htmlspecialchars($event['PFP_U']); ?>">
            <p><?php echo htmlspecialchars($event['FIRSTNAME_U'] . " " . $event['LASTNAME_U']); ?> </p>
        </div>
        <br><br><br>
        <div class="form-container">
            <div class="form-container-content">
                <h2>HAVE ANY QUESTIONS ABOUT THIS EVENT?</h2>
                <br>
                <p>Do not hesitate to contact us via our e-mail</p> 
                <p>or call us on our phone number: <?php echo htmlspecialchars($event['TEL_U']); ?></p>
                <a href="mailto:<?php echo htmlspecialchars($event['EMAIL_U']); ?>">
                    <button class="btn" id="modalBtn">SEND E-MAIL</button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>