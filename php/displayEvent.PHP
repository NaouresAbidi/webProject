<?php
require_once('Connexion.php');

$statement = $connexion->query("SELECT * FROM event");
$result = $statement->fetchAll();

?>



<div class="cards">
<?php
    foreach($result as $event)
    {
    ?>

    <div class="card">
    <img src="<?php echo $event['BANNER'];?>" alt="Image 1">
        <div class="card-content">
            <h3><?php echo $event['NAME_EV'];?></h3>
            
            <p>Date: <?php echo $event['DATE_EV'];?></p>
            <button class="btn">Book now</button>
            <button class="btn">View</button>
        </div>
    </div>
    <?php
    }   
?>




    
</div>