<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT ID_U, PASS_U, USER_TYPE, status FROM users WHERE EMAIL_U = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    

    if ($user && password_verify($password, $user['PASS_U'])) {
        $id_u = $user['ID_U'];

        setcookie('id_u', $id_u, time() + (86400 * 30), "/"); 
        session_start();
        $_SESSION['user_id'] = $id_u;
        $_SESSION['user_type'] = $user['USER_TYPE'];
        if ($user['USER_TYPE'] === 'organizer' && is_null($user['status'])) {
            header("Location: under_review.php");
            exit();
        }

        switch ($user['USER_TYPE']) {
            case 'admin':
                header("Location: ../pages_admin/Dashboard_admin.php");
                break;
            case 'organizer':
                header("Location: ../pages_organiser/Dashboard_orga.php");
                break;
            case 'simpleUser':
                header("Location: ../pages_organiser/eventlist.php");
                break;
            default:
                echo "Invalid user type.";
                exit();
        }
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>
