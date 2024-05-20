<?php
include 'db.php';
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
    <link rel="stylesheet" type="text/css" href="styles/styles-home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Outfit";
        }

        body {
            background-color: #7E9899;
        }

        a, button {
            cursor: pointer;
        }

        .body {
            color: #333;
            max-width: 1200px;
            margin: 50px 90px;
        }

        .btn:hover {
            background-color: #fef1a4cd;
        }

        .event-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .event-categories {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .category-btn {
            background: none;
            color: white; 
            border: none;
            padding: 10px 15px;
            position: relative;
            cursor: pointer;
            text-transform: uppercase;
            outline: none;
            text-decoration: none;
        }

        .category-btn::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: white; 
            left: 50%;
            bottom: 0;
            transition: width 0.3s, left 0.3s;
        }

        .category-btn:hover::after {
            width: 100%;
            left: 0;
        }

        .category-btn.active::after {
            width: 100%;
            left: 0;
        }

        .category-btn.active {
            font-weight: bold;
        }


        .event-card {
            width: 250px; 
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: #fff;
            margin: 10px;
        }

        .card-content {
            margin-bottom: 10px; 
        }
        .card-content p{
            margin-left: 20px;
            font-weight: bolder;
        }
        .card-content h2{
            margin-left: 20px;
        }
        .event-card img{
            margin-top: 0px;
            height:150px;
            width: 100%;
            border-radius: 5px;
        }
        .event-name {
            font-size: 1.2em;
            margin: 0 0 10px;
        }

        .event-price,
        .event-location,
        .event-places {
            font-size: 0.9em;
            margin: 5px 0;
        }


        .titleBox {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 50%, black 100%);
            content: '';
            width: 100%;
            height: 460px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            padding: 0 0 70px 90px;
            margin-top: auto;
        }

        .titleBox h1 {
            font-size: 53px;
            letter-spacing: 2px;
        }

        .titleBox p {
            font-size: 20px;
        }

        .titleBox h1, .titleBox p {
            width: 50%;
            text-align: center;
        }

        .titleBox * {
            margin-bottom: 20px;
        }

        .titleBox .btn {
            padding: 12px 70px;
        }

        .btns {
            display: flex;
            justify-content: space-between;
            text-align: center;
            width: 100%;
            overflow: hidden;
        }

        .btns a {
            width: 100%;
            text-decoration: none;
            overflow: hidden;}

        .btn {
            background-color: #ffd803;
            font-weight: 700;
            letter-spacing: 1px;
            border-radius: 8px;
            color: #272343;
            border: none;
            padding: 12px 20px;
            margin-right: 20px;
        }
        .mogged {
            display: flex; 
            flex-direction: row;
            position:absolute;
            top:20px;
            right: 25px;
            gap: 20px;
            
        }

    </style>
</head>
<body>
    <div class="title">
        <div class="titleBox">
            <div class="mogged">
            <?php if (!$isLoggedIn): ?>
                <a href="Signin.php" style="margin-right: -75%;"><button class="btn">SIGN IN NOW !</button></a>
            <?php endif; ?>
            <?php if ($isLoggedIn): ?>
                <a href="profile.php" ><i style=" padding: 10px ; color: black ; background-color: #ffd803; font-size:  40px; border-radius: 50%;" class="fa-solid fa-user icon"></i></a>
                <a href="signin.php" ><i style=" padding: 10px ; color: black ; background-color: #ffd803; font-size:  40px; border-radius: 50%;" class="fa-solid fa-right-from-bracket icon"></i></a>
            <?php endif; ?>
            </div>
            <h1>HyppoBooking: Your Gateway to fun</h1>
            <p>Welcome to HyppoBooking, Your All-in-one Events discovering platform.</p>
            <br>
            <a href="eventlist.html"><button class="btn" id="discover-btn">DISCOVER</button></a>
        </div>
    </div>
    <div class="body">
        <h2 style="color: white;">Our latest event</h2>
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
                    <img src="php/<?php echo htmlspecialchars($event['BANNER']); ?>" alt="<?php echo htmlspecialchars($event['NAME_EV']); ?>" >
                    <div class="card-content">
                        <h2 class="event-name"><?php echo htmlspecialchars($event['NAME_EV']); ?></h2>
                        <p class="event-price">Price: <b>$<?php echo htmlspecialchars($event['PRICE']); ?></b></p>
                        <p class="event-location">Location: <?php echo htmlspecialchars($event['LOC']); ?></p>
                        <p class="event-places">Available spots: <?php echo htmlspecialchars($event['NB_PLACES']); ?></p>
                        <p class="event-places">Start Date: <?php echo htmlspecialchars($event['DATE_EV']); ?></p>
                    
                        <div class="btns">
                            <a href="Event.php?id=<?php echo htmlspecialchars($event['ID_EV']); ?>"><button class="btn">VIEW</button></a>
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

