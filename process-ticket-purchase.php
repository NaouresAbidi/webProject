<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo 'error: User not logged in';
    exit();
}

$userId = $_SESSION['user_id'];
$eventId = intval($_POST['event_id']);
$nb_tickets = intval($_POST['nb_tickets']);
$pay_method = htmlspecialchars($_POST['pay_method']);

if ($eventId === 0 || $nb_tickets <= 0 || empty($pay_method)) {
    echo 'error: Invalid form data';
    exit();
}

// Fetch event price from the database
$stmt = $pdo->prepare("SELECT PRICE FROM event WHERE ID_EV = ?");
$stmt->execute([$eventId]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    echo 'error: Event not found';
    exit();
}

$ticket_price = floatval($event['PRICE']);
$tax_rate = 0.05; // 5% tax rate
$total_subtotal = $ticket_price * $nb_tickets;
$tax_amount = $total_subtotal * $tax_rate;
$total_price = $total_subtotal + $tax_amount;

try {
    $stmt = $pdo->prepare("INSERT INTO bookings (ID_U, ID_EV, NB_TICKETS, PAY_METHOD, TOTAL_PRICE) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$userId, $eventId, $nb_tickets, $pay_method, $total_price]);
    echo "<script>alert('Success'); window.location.href = 'home.php';</script>";
} catch (PDOException $e) {
    echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href = 'buy-ticket.php';</script>";
}
?>
