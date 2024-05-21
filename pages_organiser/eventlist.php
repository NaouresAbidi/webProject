<?php
require_once('../db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: ../pages_website_connexion/signin.php');
  exit;
} 

$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="../styles/eventlist.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
        <section class="home">
            <div class="text">Event List</div>

            <h3>Upcoming Art events</h3>


            <div class="slider-container">
                <div class="arrow left">&lt;</div>

                <div class="cards">
                <?php
                  $statement = $pdo->query("SELECT * FROM event WHERE TAGS_EV LIKE '%Art%';");
                  $result = $statement->fetchAll();
                
                  foreach($result as $event)
                  {
                  ?>

                  <div class="card">
                  <img src="../<?php echo $event['BANNER'];?>" alt="Image">
                      <div class="card-content">
                        <h3><?php echo $event['NAME_EV'];?></h3>
                        <p>Date: <?php echo $event['DATE_EV'];?></p>
                        <a href="../pages_user/buy-ticket.php?event_id=<?php echo htmlspecialchars($event['ID_EV']); ?>">
                            <button class="btn">Book now</button>
                        </a>
                        <a href="Event.php?id=<?php echo $event['ID_EV'];?>"><button class="btn">View</button></a>
                      </div>
                  </div>
                  <?php
                  }   
                ?>
                </div>

              <div class="arrow right">&gt;</div>
              </div>
              <h3>Upcoming Festivals</h3>
              <div class="slider-container">
                <div class="arrow left">&lt;</div>

                <div class="cards">
                <?php
                  $statement = $pdo->query("SELECT * FROM event WHERE TAGS_EV LIKE '%Festival%';");
                  $result = $statement->fetchAll();
                
                  foreach($result as $event)
                  {
                  ?>
                  <div class="card">
                  <img src="../<?php echo $event['BANNER'];?>" alt="Image 1">
                      <div class="card-content">
                        <h3><?php echo $event['NAME_EV'];?></h3>
                        <p>Date: <?php echo $event['DATE_EV'];?></p>
                        <a href="../pages_user/buy-ticket.php?event_id=<?php echo htmlspecialchars($event['ID_EV']); ?>">
                            <button class="btn">Book now</button>
                        </a>
                        <a href="Event.php?id=<?php echo $event['ID_EV'];?>"><button class="btn">View</button></a>

                      </div>
                  </div>
                  <?php
                  }   
                ?>
                </div>
                <div class="arrow right">&gt;</div>
              </div>
              <h3>Upcoming Sport events</h3>
              <div class="slider-container">
                <div class="arrow left">&lt;</div>
              
                <div class="cards">
                <?php
                  $statement = $pdo->query("SELECT * FROM event WHERE TAGS_EV LIKE '%Sport%';");
                  $result = $statement->fetchAll();
                
                    foreach($result as $event)
                    {
                    ?>

                    <div class="card">
                    <img src="../<?php echo $event['BANNER'];?>" alt="Image">
                        <div class="card-content">
                            <h3><?php echo $event['NAME_EV'];?></h3>
                            <p>Date: <?php echo $event['DATE_EV'];?></p>
                            <a href="../pages_user/buy-ticket.php?event_id=<?php echo htmlspecialchars($event['ID_EV']); ?>">
                                <button class="btn">Book now</button>
                            </a>
                            <button class="btn">View</button>
                        </div>
                    </div>
                    <?php
                    }   
                ?>
                </div>


                <div class="arrow right">&gt;</div>
              </div>
              <h3>Upcoming Tech events</h3>
              <div class="slider-container">
                <div class="arrow left">&lt;</div>
                <div class="cards">
                <?php
                  $statement = $pdo->query("SELECT * FROM event WHERE TAGS_EV LIKE '%Tech%';");
                  $result = $statement->fetchAll();
                
                    foreach($result as $event)
                    {
                    ?>

                    <div class="card">
                    <img src="../<?php echo $event['BANNER'];?>" alt="Image">
                        <div class="card-content">
                            <h3><?php echo $event['NAME_EV'];?></h3>
                            <p>Date: <?php echo $event['DATE_EV'];?></p>
                            <a href="../pages_user/buy-ticket.php?event_id=<?php echo htmlspecialchars($event['ID_EV']); ?>">
                                <button class="btn">Book now</button>
                            </a>
                            <button class="btn">View</button>
                        </div>
                    </div>
                    <?php
                    }   
                ?>
                </div>
                <div class="arrow right">&gt;</div>
              </div>
              <h3>Upcoming Music events</h3>
              <div class="slider-container">
                <div class="arrow left">&lt;</div>
                <div class="cards">
                <?php
                  $statement = $pdo->query("SELECT * FROM event WHERE TAGS_EV LIKE '%Music%';");
                  $result = $statement->fetchAll();
                
                  foreach($result as $event)
                  {
                  ?>
                  <div class="card">
                  <img src="../<?php echo $event['BANNER'];?>" alt="Image 1">
                      <div class="card-content">
                        <h3><?php echo $event['NAME_EV'];?></h3>
                        <p>Date: <?php echo $event['DATE_EV'];?></p>
                        <a href="../pages_user/buy-ticket.php?event_id=<?php echo htmlspecialchars($event['ID_EV']); ?>">
                            <button class="btn">Book now</button>
                        </a>
                        <a href="Event.php?id=<?php echo $event['ID_EV'];?>"><button class="btn">View</button></a>

                      </div>
                  </div>
                  <?php
                  }   
                ?>
                </div>
                <div class="arrow right">&gt;</div>
              </div>

        </section>
        <script src="../js/scriptevent.js">
        </script>
    </body>
</html>