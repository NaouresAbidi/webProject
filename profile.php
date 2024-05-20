<?php
session_start();
include('db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
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
    <link rel="stylesheet" href="styles/styles.css">
    <style>
        .prev-purch {
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
        }

        .purch-card {
            background-color: #e6e6e8;
            margin-bottom: 30px;
            height:300px;
            padding: 25px;
            box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
        }

        
        .purch-card img {
            width: 100%;
            height: 150px;
            display: block;
            object-fit: cover;
            margin: 0 auto 20px auto;
        }

       
        .invoice-btn{
            background-color: #ffd803;
            font-weight: 700;
            letter-spacing: 1px;
            border-radius: 8px;
            color: #272343;
            height: 40px;
            border: none;
        }
        .invoice-btn:hover{
        background-color: #ffc403;
        cursor: pointer;
        }
        .invoice-btn:active{
        border: 1px solid #bb8f00;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Your profile</title>
</head>
<body>

    <div class="top">
        <button class="btn" id="editBtn">
            <img src="Media/Icon Edit.png">
            Edit profile
        </button>
        <img id="profilePic" class="profile-pic" src="Media/coolcat.jpg" alt="Profile picture">
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
            <td width="40px"><img class="icon" src="Media/Icon Address.png"></td>
            <td width="200px"><h4>Address</h4></td>
            <td id="userAddress"><?php echo htmlspecialchars($user_data['ADDRESS']); ?></td>
        </tr>
        <tr>
            <td><img class="icon" src="Media/Icon Birthday.png"></td>
            <td><h4>Birthday</h4></td>
            <td id="userBirthday"><?php echo htmlspecialchars($user_data['BIRTHDAY']); ?></td>
        </tr>
        <tr>
            <td><img class="icon" src="Media/Icon Phone.png"></td>
            <td><h4>Phone Number</h4></td>
            <td id="userPhone"><?php echo htmlspecialchars($user_data['TEL_U']); ?></td>
        </tr>
    </table>
    <?php if ($user_type == 'organizer'): ?>
            <h2>Previous Events</h2><br>
            <div class="prev-purch">
                <?php foreach ($events_result as $event): ?>
                    <div class="purch-card">
                        <img src="php/<?php echo htmlspecialchars($event['BANNER']); ?>" alt="Event banner">
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
                        <img src="php/<?php echo htmlspecialchars($event['BANNER']); ?>" alt="Event banner">
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
        <script>
        function redirectToInvoice(eventId) {
            window.location.href = 'invoice.php?event_id=' + eventId;
        }
    </script>
    </body>
</html>