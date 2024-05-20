<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizer Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center; 
        }
        h1 {
            margin-bottom: 20px; 
        }
        .info-container {
            text-align: left; 
            display: inline-block;
            margin-bottom: 20px;
        }
        .info-container p {
            margin: 10px 0;
        }
        .info-container p:not(:last-child) {
            border-bottom: 1px solid #ccc; 
            padding-bottom: 5px; 
        }
        .buttons-container {
            margin-top: 20px; 
        }
        .buttons-container form {
            display: inline-block; 
        }
        .buttons-container input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff; 
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s; 
            margin-right: 10px;
        }
        .buttons-container input[type="submit"]:hover {
            background-color: #0056b3; 
        }
    </style>
</head>
<body>
    <h1>Organizer Information</h1>
    
    <?php
    include 'db.php';
    if(isset($_POST['display_email'])) {
        $email = $_POST['display_email'];
        $sql = "SELECT * FROM users WHERE EMAIL_U = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $organizer = $stmt->fetch();

        if($organizer) {
            echo '<div class="info-container">';
            echo '<p>ID: ' . $organizer['ID_U'] . '</p>';
            echo '<p>First Name: ' . $organizer['FIRSTNAME_U'] . '</p>';
            echo '<p>Last Name: ' . $organizer['LASTNAME_U'] . '</p>';
            echo '<p>Telephone: ' . $organizer['TEL_U'] . '</p>';
            echo '<p>Email: ' . $organizer['EMAIL_U'] . '</p>';
            echo '<p>Birthday: ' . $organizer['BIRTHDAY'] . '</p>';
            echo '<p>Address: ' . $organizer['ADDRESS'] . '</p>';
            echo '<p>User Type: ' . $organizer['USER_TYPE'] . '</p>';
            echo '<p>Status: ' . $organizer['Status'] . '</p>';
            echo '</div>';

            echo '<div class="buttons-container">';
            echo '<form method="post">';
            echo '<input type="hidden" name="discard_email" value="' . $organizer['EMAIL_U'] . '">';
            echo '<input type="submit" value="Discard">';
            echo '</form>';
            
            echo '<form method="post">';
            echo '<input type="hidden" name="approve_email" value="' . $organizer['EMAIL_U'] . '">';
            echo '<input type="submit" value="Approve">';
            echo '</form>';
            echo '</div>';
        } else {
            echo '<p>No organizer found with the provided email.</p>';
        }
    } else {
        echo '<p>No email provided.</p>';
    }

    if (isset($_POST['approve_email'])) {
        $email = $_POST['approve_email'];
        $sql = "UPDATE users SET status = 'verified' WHERE EMAIL_U = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        echo '<script>alert("Organizer approved successfully.");</script>'; 
        header("Location: Dashboard_admin.php"); 
        exit;
    }

    if (isset($_POST['discard_email'])) {
        $email = $_POST['discard_email'];
        $sql = "DELETE FROM users WHERE EMAIL_U = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        echo '<script>alert("Organizer discarded successfully.");</script>'; 
        header("Location: Dashboard_admin.php"); /
        exit;
    }
    ?>

</body>
</html>


