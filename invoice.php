<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;

if (!$event_id) {
    header('Location: profile.php');
    exit;
}

$user_query = "SELECT * FROM users WHERE ID_U = ?";
$stmt = $pdo->prepare($user_query);
$stmt->execute([$user_id]);
$user_data = $stmt->fetch();
$events_query = "
SELECT event.*,  users.FIRSTNAME_U, users.LASTNAME_U, users.TEL_U, users.ADDRESS, bookings.NB_TICKETS, bookings.CR_DATE, bookings.PAY_METHOD, bookings.TOTAL_PRICE
FROM bookings 
JOIN event ON bookings.ID_EV = event.ID_EV
JOIN users ON bookings.ID_U = users.ID_U
WHERE bookings.ID_U = ? AND bookings.ID_EV = ?
";
$stmt = $pdo->prepare($events_query);
$stmt->execute([$user_id, $event_id]);

$event = $stmt->fetch();
if (!$event) {
    header('Location: profile.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .invoice-contain {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
        }
        .invoice {
            display: flex;
            flex-direction: column;
        }
        .invoice h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #4CAF50;
        }
        .invoice h3 {
            font-size: 18px;
            margin: 20px 0 10px;
        }
        .invoice-content {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .invoice-t {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-t td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .invoice-t tr:last-child td {
            border-bottom: none;
        }
        .paid-amount {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .paid-amount td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .paid-amount tr:last-child td {
            border-bottom: none;
        }
        .btns {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .btn {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="invoice-contain" id="modal">
    <div class="invoice">
        <span class="close" id="close">&times;</span>

        <div class="invoice-content">
        <h1>EVENT INVOICE</h1>
        <br>
        <table class="invoice-t">
            <tr>
                <td>RECEIPT N°</td>
                <td><p><?php echo htmlspecialchars($event['ID_EV']); ?> , <?php echo htmlspecialchars($_SESSION['user_id']); ?></p></td>
            </tr>
            <tr>
                <td>DATE</td>
                <td><?php  echo htmlspecialchars($event['CR_DATE']); ?></td>
            </tr>
        </table>

        <h3>EVENT INFORMATION</h3>

        <table class="invoice-t">
            <tr>
                <td>EVENT NAME</td>
                <td><?php echo htmlspecialchars($event['NAME_EV']); ?></td>
            </tr>
            <tr>
                <td>DATE</td>
                <td><?php echo htmlspecialchars($event['DATE_EV']); ?></td>
            </tr>
            <tr>
                <td>TIME</td>
                <td><?php echo htmlspecialchars($event['T_START']); ?></td>
            </tr>
        </table>

        <h3>ATTENDEE INFORMATION</h3>

        <table class="invoice-t">
            <tr>
                <td>NAME</td>
                <td><?php echo htmlspecialchars($user_data['FIRSTNAME_U']) . ' ' . htmlspecialchars($user_data['LASTNAME_U']); ?></td>
            </tr>
            <tr>
                <td>PHONE N°</td>
                <td><?php echo htmlspecialchars($user_data['TEL_U']); ?></td>
            </tr>
            <tr>
                <td>ADDRESS</td>
                <td><?php echo htmlspecialchars($user_data['ADDRESS']); ?></td>
            </tr>
            <tr>
                <td>NB OF TICKETS</td>
                <td><?php echo htmlspecialchars($event['NB_TICKETS']); ?></td>
            </tr>
        </table>

        <table class="paid-amount">
            <tr>
                <td>SUB TOTAL</td>
                <td>$ <?php echo htmlspecialchars($event['TOTAL_PRICE']); ?></td>
                <td></td>
                <td><b>PAYMENT METHOD</b></td>
            </tr>
            <tr>
                <td>TAX RATE</td>
                <td>% 5</td>
                <td></td>
                <td><?php echo htmlspecialchars($event['PAY_METHOD']); ?></td>
            </tr>
            <tr>
                <td>TAX AMOUNT</td>
                <td>$ <?php echo htmlspecialchars($event['TOTAL_PRICE']) * 0.05; ?></td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr>
                <td>TOTAL AMOUNT</td>
                <td>$ <?php echo htmlspecialchars($event['TOTAL_PRICE']) * 1.05; ?></td>
            </tr>
        </table>
    </div>
    </div>

    <br><br>

    <div class="btns">
        <button class="btn bttn" onclick="window.print()">PRINT</button>
    </div>
    <br><br><br><br>
</div>
</body>
</html>
