<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../styles/styles_dash_admin.css">
    
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
                    <hr>
                    <ul class="menu-links">
                        <li class="nav-link">
                            <a href="#"><i class="fa-solid fa-house icon"></i>
                                <span class="text">Dashboard</span>                            
                            </a>
                        </li>
                    </ul>
                    <ul class="logout">
                        <hr>
                        <li>
                            <a href="../pages_website_connexion/Signin.php"><i class="fa-solid fa-pen-to-square fa-lg icon"></i>
                                <span class="text nav-text" >Log out</span>                            
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main">
            <div class="main-left">
                <h1>Welcome, Admin</h1>
                <br><br>
                <br><br><br>
                <h2>Requests</h2> 
                <div class="events">
                    <?php
                    include '../db.php';
                    if (isset($_POST['approve_email'])) {
                        $email = $_POST['approve_email'];
                    
                        $sql = "UPDATE users SET status = 'verified' WHERE EMAIL_U = ?";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$email]);
                    }
                    
                    if (isset($_POST['discard_email'])) {
                        $email = $_POST['discard_email'];
                    
                        $sql = "DELETE FROM users WHERE EMAIL_U = ?";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$email]);
                    }
                    $sql = "SELECT * FROM users WHERE USER_TYPE = 'organizer' AND (status <> 'verified' OR status IS NULL)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $organizers = $stmt->fetchAll();

                    foreach ($organizers as $organizer) {
                        echo '<div class="event-card">';
                        echo '<img src="../Media/Banner - Abstract Art Small.png">';
                        echo '<div class="userinfo">';
                        echo '<p>' . htmlspecialchars($organizer['FIRSTNAME_U']) . '</p>';
                        echo '<p>' . htmlspecialchars($organizer['EMAIL_U']) . '</p>';
                        echo '</div>';
                        echo '<div class="event-btns">';
                        echo '<form method="post" action="orga_form.php">';
                        echo '<input type="hidden" name="display_email" value="' . htmlspecialchars($organizer['EMAIL_U']) . '">';
                        echo '<input type="submit" value="Display">';
                        echo '</form>';
                        echo '<form method="post">';
                        echo '<input type="hidden" name="approve_email" value="' . htmlspecialchars($organizer['EMAIL_U']) . '">';
                        echo '<input class="approveBtn" type="submit" value="Approve">';
                        echo '</form>';
                        echo '<form method="post">';
                        echo '<input type="hidden" name="discard_email" value="' . htmlspecialchars($organizer['EMAIL_U']) . '">';
                        echo '<input class="delBtn" type="submit" value="Discard">';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                
                </div>
            </div>
            <div class="main-right">
                <br><br><br>
                <h2>Your verified Organizers</h2>
                <div class="events">
                    
                        <?php
                        // Fetch organizers with non-null status
                        $sql = "SELECT * FROM users WHERE USER_TYPE = 'organizer' AND status IS NOT NULL";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $verifiedOrganizers = $stmt->fetchAll();

                        foreach ($verifiedOrganizers as $organizer) {
                            echo '<div class="event-card">';
                            echo '<img src="../'.$organizer['PFP_U'].'">';
                            echo '<p>' . htmlspecialchars($organizer['FIRSTNAME_U']) . '</p>'; // Assuming 'name' is a column
                            echo '<div class="event-btns">';
                            echo '<a href="mailto:' . htmlspecialchars($organizer['EMAIL_U']) . '" type="button">Email</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                   
                </div>
            </div>
        </div>
    </div>


</body>
</html>
