<?php
require_once('Connexion.php');
session_start();

// if(isset($_GET['id'])){
//     $id = $_GET['id'];
// }

$id = $_POST['id'];

$req = "UPDATE users SET Status = 'verified' WHERE ID_U = $id";
$result = $connexion->exec($req);

header("Location: {$_SERVER['HTTP_REFERER']}");
exit();
?>