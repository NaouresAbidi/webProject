<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}
$userId = $_SESSION['user_id'];

$userStmt = $pdo->prepare("SELECT * FROM users WHERE ID_U = ?");
$userStmt->execute([$userId]);
$user = $userStmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('User not found');
}

$eventId = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;

if ($eventId === 0) {
    die('Invalid event ID');
}

$stmt = $pdo->prepare("SELECT * FROM event WHERE ID_EV = ?");
$stmt->execute([$eventId]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    die('Event not found');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy your ticket</title>
    <link rel="stylesheet" href="styles/styles-buy-ticket.css">
</head>
<body>
    <div class="title">
        <h1 style="color: white;">BUY YOUR TICKETS FOR THE</h1>
        <h1 style="color: white;">UPCOMING</h1>
        <h3 style="color: white;" id="event-name"><?php echo htmlspecialchars($event['NAME_EV']); ?></h3>
        <p style="color: white;" id="event-info"><?php echo htmlspecialchars($event['DATE_EV']); ?> | <?php echo htmlspecialchars($event['T_START']); ?> | <?php echo htmlspecialchars($event['LOC']); ?></p>
    </div>
    <div class="form-container">
        <div class="info">
            <div class="left">
                <h2>TICKET INFORMATION</h2>
                <hr>
                <table class="ticket-info-t">
                    <tr>
                        <td><b>REMAINING TICKETS</b></td>
                        <td><?php echo htmlspecialchars($event['NB_PLACES']); ?> tickets</td>
                    </tr>
                    <tr>
                        <td><b>TICKET PRICE</b></td>
                        <td>$ <?php echo htmlspecialchars($event['PRICE']); ?></td>
                    </tr>
                </table>
            </div>
            <div class="right">
                <img src="php/<?php echo htmlspecialchars($event['BANNER']); ?>" alt="Event Flyer">
            </div>
        </div>

        <h2>ATTENDEE INFORMATION</h2>
        <hr>
        <form action="process-ticket-purchase.php" method="post">
            <input type="hidden" name="event_id" value="<?php echo $eventId; ?>">
            <table class="invoice-t">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" id="name-in" value="<?php echo htmlspecialchars($user['FIRSTNAME_U']); ?>" required></td>
                </tr>
                <tr>
                    <td>Surname</td>
                    <td><input type="text" name="surname" id="surname-in" value="<?php echo htmlspecialchars($user['LASTNAME_U']); ?>" required></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><input type="tel" name="phone" id="phone-in" value="<?php echo htmlspecialchars($user['TEL_U']); ?>" required></td>
                </tr>
                <tr>
                    <td>N° of tickets</td>
                    <td><input type="number" name="nb_tickets" id="nbticket-in" value="1" required></td>
                </tr>
            </table>
            <div class="payment">
                <div class="paid-am">
                    <h2>PRICE</h2>
                    <hr>
                    <br>
                    <table class="paid-amount">
                        <tr>
                            <td>Sub total</td>
                            <td>$</td>
                            <td id="sub-total"><?php echo htmlspecialchars($event['PRICE']); ?></td>
                        </tr>
                        <tr>
                            <td>Tax rate</td>
                            <td>%</td>
                            <td id="tax-rate">5</td>
                        </tr>
                        <tr>
                            <td>Tax amount</td>
                            <td>$</td>
                            <td id="tax-amount">0.00</td>
                        </tr>
                        <tr>
                            <td>TOTAL AMOUNT</td>
                            <td>$</td>
                            <td id="total-price">0.00</td>
                        </tr>
                    </table>
                    <input type="hidden" id="total-amount-input" name="total_amount" value="">
                </div>
                <div class="pay-card-container">
                    <h2>SELECT YOUR PAYMENT METHOD</h2>
                    <hr>
                    <br>
                    <div class="pay-card-content">
                        <label class="pay-card">
                            <input type="radio" name="pay_method" value="paypal" required>
                            <img src="Media/PayPal.png" alt="PayPal">
                        </label>
                        <label class="pay-card">
                            <input type="radio" name="pay_method" value="visa" required>
                            <img src="Media/Visa.png" alt="Visa">
                        </label>
                    </div>
                    <div class="pay-card-content">
                        <label class="pay-card">
                            <input type="radio" name="pay_method" value="bank transfer" required>
                            <img src="Media/Bank Transfer.png" alt="Bank Transfer">
                        </label>
                        <label class="pay-card">
                            <input type="radio" name="pay_method" value="mastercard" required>
                            <img src="Media/Mastercard.png" alt="Mastercard">
                        </label>
                    </div>
                </div>
            </div>

            <div class="btns">
                <input type="submit" id="confirm-payment-btn" class="btn" value="CONFIRM PURCHASE">
            </div>
        </form>
    </div>
    <script src="js/script-buy-tickets.js"></script>
</body>
</html>