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
$user_data = $stmt->fetch();

$user_type = $user_data['USER_TYPE'];

if ($user_type == 'organizer') {
    $events_query = "SELECT * FROM event WHERE ID_ORG = ?";
    $stmt = $pdo->prepare($events_query);
    $stmt->execute([$user_id]);
} else {
    $events_query = "
    SELECT event.*, users.FIRSTNAME_U, users.LASTNAME_U, users.TEL_U, users.ADDRESS, bookings.NB_TICKETS, bookings.PAY_METHOD, bookings.TOTAL_PRICE
    FROM bookings 
    JOIN event ON bookings.ID_EV = event.ID_EV
    JOIN users ON bookings.ID_U = users.ID_U
    WHERE bookings.ID_U = ?
    ";
    $stmt = $pdo->prepare($events_query);
    $stmt->execute([$user_id]);
}

$events_result = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../styles/styles-profile2.css">

    <style>
        
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Your profile</title>
</head>
<body>
    <nav class="sidebar close">
            <header>
                <div class="image-text">
                    <span class="image">
                        <a href="../pages_user/home.php"><i class="fa-solid fa-hippo"></i></a>
                    </span>
                    <div class="text header-text">
                        <span class="name">HippoBooking</span>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-right toggle"></i>
            </header>
            <div class="menu-bar">
                <div class="menu">
                    <li class="search-box">
                        <a href="#">
                            <i class="fa-solid fa-magnifying-glass icon"></i>
                            <input type="text" placeholder="    Search...">
                    </a>
                    </li>
                    <ul class="menu-links">
                        <li class="nav-link">
                            <a href="../pages_user/home.php"><i class="fa-solid fa-house icon"></i>
                                <span class="text nav-text">Home</span>                            
                        </a>
                        </li>
                        <li class="nav-link">
                            <a href="../pages_user/profile.php"><i class="fa-solid fa-user icon"></i>
                                <span class="text nav-text">Profile</span>                            
                        </a>
                        </li>
                        <li class="nav-link">
                            <a href="../pages_organiser/eventlist.php"><i class="fa-solid fa-house icon"></i>
                                <span class="text nav-text">Events</span>                            
                        </a>
                        </li>
                        
                    </ul>

                </div>
                <div class="bottom-content">
                    <li class="">
                        <a href="../pages_website_connexion/Signin.php"><i class="fa-solid fa-right-from-bracket icon"></i>
                            <span class="text nav-text">Logout</span>                            
                    </a>
                    </li>
                    <li class="mode">
                        <div class="moon-sun">
                            <i class="fa-solid fa-moon icon moon"></i>
                            <i class="fa-solid fa-sun icon sun"></i>
                        </div>     
                         <span class="mode-text text">Dark Mode</span>
                          <div class="toggle-switch">
                            <span class="switch"></span>
                          </div>                 
                    </a>
                    </li>
                </div>
            </div>

    </nav>
    
    <div class="top">
        <button class="btn" id="editBtn">
            <img src="../Media/Icon Edit.png">
            Edit profile
        </button>
        <img id="profilePic" class="profile-pic" src="../Media/coolcat.jpg" src="<?php echo 'uploads/' . htmlspecialchars($user_data['PFP_U']); ?>" alt="Profile picture">
        <div class="main-info">
            <br>
            <h2 id="userName"><?php echo htmlspecialchars($user_data['FIRSTNAME_U']); ?></h2>
            <h2 id="userSurname"><?php echo htmlspecialchars($user_data['LASTNAME_U']); ?></h2>
            <p id="userEmail"><?php echo htmlspecialchars($user_data['EMAIL_U']); ?></p>
        </div>
    </div>
    <div class="main">
    <h2>Personal Information</h2><br>
    <hr>

    <table class="info">
    <tr>
            <td width="40px"><img class="icon" src="../Media/Icon Address.png"></td>
            <td width="200px"><h4>Address</h4></td>
            <td id="userAddress"><?php echo htmlspecialchars($user_data['ADDRESS']); ?></td>
        </tr>
        <tr>
            <td><img class="icon" src="../Media/Icon Birthday.png"></td>
            <td><h4>Birthday</h4></td>
            <td id="userBirthday"><?php echo htmlspecialchars($user_data['BIRTHDAY']); ?></td>
        </tr>
        <tr>
            <td><img class="icon" src="../Media/Icon Phone.png"></td>
            <td><h4>Phone Number</h4></td>
            <td id="userPhone"><?php echo htmlspecialchars($user_data['TEL_U']); ?></td>
        </tr>
    </table>
    <?php if ($user_type == 'organizer'): ?>
            <h2>Previous Events</h2><br>
            <div class="prev-purch">
                <?php foreach ($events_result as $event): ?>
                    <div class="purch-card">
                        <img src="../<?php echo htmlspecialchars($event['BANNER']); ?>" alt="Event banner">
                        <p><?php echo htmlspecialchars($event['NAME_EV']); ?></p>
                        <p><?php echo htmlspecialchars($event['DATE_EV']); ?></p>
                        <p><b>Total: <?php echo htmlspecialchars($event['PRICE']); ?> $</b></p>
                        <div class="prev-purch-btns">
                            <button class="invoice-btn">VIEW DETAILS</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <h2>Previous Purchases</h2><br>
            <hr>
            <div class="prev-purch">
                <?php foreach ($events_result as $event): ?>
                    <div class="purch-card">
                        <img src="../<?php echo htmlspecialchars($event['BANNER']); ?>" alt="Event banner">
                        <p><?php echo htmlspecialchars($event['NAME_EV']); ?></p>
                        <p><b>Total: <?php echo htmlspecialchars($event['TOTAL_PRICE']); ?> $</b></p>
                        <div class="prev-purch-btns">
                        <button class="invoice-btn" onclick="redirectToInvoice(<?php echo htmlspecialchars($event['ID_EV']); ?>)">VIEW INVOICE</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <br><br><br><br>

        <script src="../js/scriptevent.js">
        </script>
        <script>
        function redirectToInvoice(eventId) {
            window.location.href = 'invoice.php?event_id=' + eventId;
        }
        document.getElementById('editBtn').addEventListener('click', function() {
            const userId = <?php echo json_encode($user_id); ?>;
            window.location.href = 'editprofilepage.php?user_id=' + userId;
        });
        </script>
    </body>
</html>