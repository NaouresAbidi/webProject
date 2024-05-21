<?php
require_once('../db.php');
session_start();

$id = $_POST['id'];

$req = "UPDATE users SET Status = 'verified' WHERE ID_U = $id";
$result = $pdo->exec($req);

header("Location: {$_SERVER['HTTP_REFERER']}");
exit();
?>