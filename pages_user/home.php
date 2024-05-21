<?php
include '../db.php';
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$category = isset($_GET['category']) ? $_GET['category'] : 'all';

if ($category === 'all') {
    $stmt = $pdo->query("SELECT * FROM event");
} else {
    $stmt = $pdo->prepare("SELECT * FROM event WHERE TAGS_EV LIKE ?");
    $stmt->execute(["%$category%"]);
}

$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../styles/styles-home2.css">

    <style>

    </style>
</head>
<body>
    <div class="title">
        <div class="titleBox">
            <div class="mogged">
            <?php if (!$isLoggedIn): ?>
                <a href="../pages_website_connexion/Signin.php" style="margin-right: -75%;"><button class="btn">SIGN IN NOW !</button></a>
            <?php endif; ?>
            <?php if ($isLoggedIn): ?>
                <a href="profile.php" ><i style=" padding: 10px ; color: black ; background-color: #ffd803; font-size:  40px; border-radius: 50%;" class="fa-solid fa-user icon"></i></a>
                <a href="../pages_website_connexion/Signin.php" ><i style=" padding: 10px ; color: black ; background-color: #ffd803; font-size:  40px; border-radius: 50%;" class="fa-solid fa-right-from-bracket icon"></i></a>
            <?php endif; ?>
            </div>
            <h1>HyppoBooking: Your Gateway to fun</h1>
            <p>Welcome to HyppoBooking, Your All-in-one Events discovering platform.</p>
            <br>
            <a href="eventlist.html"><button class="btn" id="discover-btn">DISCOVER</button></a>
        </div>
    </div>
    <div class="body">
        <br>
        <div class="event-categories" id="event-categories">
            <a href="?category=all" class="category-btn">All</a>
            <a href="?category=art" class="category-btn">Art</a>
            <a href="?category=food" class="category-btn">Food</a>
            <a href="?category=ethnic" class="category-btn">Ethnic</a>
            <a href="?category=tech" class="category-btn">Tech</a>
            <a href="?category=music" class="category-btn">Music</a>
            <a href="?category=sport" class="category-btn">Sport</a>
        </div>
        <br>
        <div class="event-cards" id="event-cards">
            <?php foreach ($events as $event): ?>
                <div class="event-card">
                    <img src="../<?php echo htmlspecialchars($event['BANNER']); ?>" alt="<?php echo htmlspecialchars($event['NAME_EV']); ?>" >
                    <div class="card-content">
                        <h2 class="event-name"><?php echo htmlspecialchars($event['NAME_EV']); ?></h2>
                        <p class="event-price">Price: <b>$<?php echo htmlspecialchars($event['PRICE']); ?></b></p>
                        <p class="event-location">Location: <?php echo htmlspecialchars($event['LOC']); ?></p>
                        <p class="event-places">Available spots: <?php echo htmlspecialchars($event['NB_PLACES']); ?></p>
                        <p class="event-places">Start Date: <?php echo htmlspecialchars($event['DATE_EV']); ?></p>
                    
                        <div class="btns">
                            <a href="../pages_organiser/Event.php?id=<?php echo htmlspecialchars($event['ID_EV']); ?>"><button class="btn">VIEW</button></a>
                            <a href="<?php echo $isLoggedIn ? 'buy-ticket.php?event_id=' . htmlspecialchars($event['ID_EV']) : 'signin.php'; ?>"><button class="btn">BOOK</button></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.href;
                history.pushState({}, '', url);

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newEvents = doc.querySelector('#event-cards').innerHTML;
                        document.querySelector('#event-cards').innerHTML = newEvents;

                        document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
                        this.classList.add('active');
                    })
                    .catch(err => console.error('Failed to fetch events:', err));
            });
        });

        window.addEventListener('popstate', () => {
            fetch(location.href)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newEvents = doc.querySelector('#event-cards').innerHTML;
                    document.querySelector('#event-cards').innerHTML = newEvents;
                })
                .catch(err => console.error('Failed to fetch events:', err));
        });
        document.getElementById('discover-btn').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('event-categories').scrollIntoView({ behavior: 'smooth' });
    });
    </script>
</body>
</html>

