<?php
session_start();
include('../db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages_website_connexion/signin.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user_query = "SELECT * FROM users WHERE ID_U = ?";
$stmt = $pdo->prepare($user_query);
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../styles/eventlist.css">

    <link rel="stylesheet" href="../styles/styles_dash_orga.css">
    <title>Dashboard</title>

    </head>
<body>
    <div class="page-flexbox">
    <div class="sidebar sidebar-space">
        <header>
            <div class="image-text">
                <span class="image">
                    <a href="#"><i class="fa-solid fa-hippo"></i></a>
                </span>
                <div class="text header-text">
                    <span class="name">HippoBooking</span>
                </div>
            </div>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <div class="profile-div">
                    <img src="../<?php echo $user['PFP_U'];?>" alt="Image">
                    <div class="profile-text">
                        <p><?php echo $user['FIRSTNAME_U'].' '.$user['LASTNAME_U'];?></p>
                        <a href="../pages_user/profile.php">
                            View profile
                            <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <hr>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="#"><i class="fa-solid fa-house icon"></i>
                            <span class="text nav-text">Dashboard</span>                            
                    </a>
                    </li>

                    <li class="nav-link">
                        <i class="fa-solid fa-file-invoice-dollar icon"></i>
                            <span class="text nav-text">Manage events</span>                            
                    </li>
                </ul>


                <ul class="manage-ev-list">
                    <li class="manage-ev">
                        <i class="fa-solid fa-pen-to-square fa-lg icon"></i>
                        Edit Event
                    </li>
                    <li class="manage-ev">
                        <i class="fa-solid fa-square-minus fa-lg icon"></i>
                        Cancel Event
                    </li>
                </ul>
                
                <ul class="logout">
                    <hr>
                    <li>
                        <a href="../pages_website_connexion/Signin.php"><i class="fa-solid fa-pen-to-square fa-lg icon"></i>
                            <span class="text nav-text">Log out</span>                            
                    </a>
                    </li>
                </ul>
            </div>
            
        </div>


    </div>

    <div class="main">
        <h1>Welcome, <?php echo $user['FIRSTNAME_U'].' '.$user['LASTNAME_U'];?></h1>
        <br><br>
        <a href="createevent.php" id="newEventBtn">
            <i class="fa-solid fa-square-plus fa-2xl icon" style="color: #29baba;"></i>
            <p>Create a new event</p>
        </a>
        <br><br><br>
        <div class="events-div">
    <div class="main-left">
        <h2>Your ongoing events</h2>
        <div class="events">
            <div class="box">
                <?php
                $statement2 = $pdo->prepare("SELECT * FROM event WHERE ID_ORG = :user_id AND DATE_EV >= CURDATE()");
                $statement2->bindParam(':user_id', $user_id);
                $statement2->execute();
                $events = $statement2->fetchAll();

                foreach ($events as $event) {
                ?>
                    <div class="event-card">
                        <img src="../<?php echo $event['BANNER']; ?>" alt="Image">
                        <div class="text">
                            <p><?php echo $event['NAME_EV']; ?></p>
                            <p><b><?php echo $event['DATE_EV']; ?></b></p>
                            <div class="event-btns">
                                <a href="Event.php?id=<?php echo $event['ID_EV']; ?>"><input type="button" value="Display"></a>
                                <a href="editEventPage.php?idEV=<?php echo $event['ID_EV']; ?>"><input type="button" value="Edit"></a>

                                <form action="delEvent.php">
                                    <input class="delBtn" type="button" value="Delete">
                                </form>
                            </div>
                        </div>

                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="main-right">
        <h2>Your previous events</h2>
        <div class="events">
            <div class="box">
                <?php
                $statement3 = $pdo->prepare("SELECT * FROM event WHERE ID_ORG = :user_id AND DATE_EV < CURDATE()");
                $statement3->bindParam(':user_id', $user_id);
                $statement3->execute();
                $prev_events = $statement3->fetchAll();

                foreach ($prev_events as $prevEvent) {
                ?>
                    <div class="event-card prev-event-card">
                        <img src="../<?php echo $prevEvent['BANNER']; ?>" alt="Image">
                        <div class="text">
                            <p><?php echo $prevEvent['NAME_EV']; ?></p>
                            <p><?php echo $prevEvent['DATE_EV']; ?></p>
                            <p><b><?php echo $prevEvent['DATE_EV']; ?></b></p>

                            <a href="Event.html"><input type="button" value="Display"></a>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
    </div>
    <script src="../js/script-dash-orga.js"></script>
</body>
</html>
