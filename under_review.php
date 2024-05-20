<?php
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Under Review</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background: #f0f0f0;
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #ff6666;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            text-align: center;
        }
        .container {
            text-align: center;
            padding: 50px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .message {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .sad-face {
            font-size: 100px;
            animation: blink 1s infinite;
        }
        @keyframes blink {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
    </style>
</head>
<body>
    <form method="POST">
        <button type="submit" name="logout" class="logout-btn">Logout</button>
    </form>
    <div class="container">
        <div class="sad-face">😢</div>
        <div class="message">Your account is still under review.</div>
        <div class="message">We will contact you when you have your access.</div>
    </div>
</body>
</html>
