<?php
session_start();
include('../db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages_website_connexion/signin.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user_query = "SELECT * FROM users WHERE ID_U = ?";
$stmt = $pdo->prepare($user_query);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$FIRSTNAME_U = $user['FIRSTNAME_U'];
$LASTNAME_U = $user['LASTNAME_U'];
$TEL_U = $user['TEL_U'];
$ADDRESS = $user['ADDRESS'];
$BIRTHDAY = $user['BIRTHDAY'];
$PFP_U = isset($user['PFP_U']) ? $user['PFP_U'] : 'default.jpg';

if (isset($_POST['nameEdit'], $_POST['surnameEdit'], $_POST['addressEdit'], $_POST['phoneEdit'], $_POST['birthEdit'])) {
    $FIRSTNAME_U = $_POST['nameEdit'];
    $LASTNAME_U = $_POST['surnameEdit'];
    $TEL_U = $_POST['phoneEdit'];
    $ADDRESS = $_POST['addressEdit'];
    $BIRTHDAY = $_POST['birthEdit'];

    $profilePic = $PFP_U;

    // Handle profile picture upload
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['profile_photo']['name']);
        
        if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $uploadFile)) {
            $profilePic = basename($_FILES['profile_photo']['name']);
        } else {
            echo "<hr>Error uploading profile picture";
        }
    }

    $req = "UPDATE users SET FIRSTNAME_U=:firstname, LASTNAME_U=:lastname, TEL_U=:tel, ADDRESS=:address, BIRTHDAY=:birthday, PFP_U=:profile_pic WHERE ID_U=:user_id";
    $stmt = $pdo->prepare($req);
    $result = $stmt->execute([
        ':firstname' => $FIRSTNAME_U,
        ':lastname' => $LASTNAME_U,
        ':tel' => $TEL_U,
        ':address' => $ADDRESS,
        ':birthday' => $BIRTHDAY,
        ':profile_pic' => $profilePic,
        ':user_id' => $user_id
    ]);

    if ($result) {
        echo "<hr>User edited successfully";
    } else {
        echo "<hr>Failed to edit user";
    }
}
?>
