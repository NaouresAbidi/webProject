<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $userType = $_POST['userType'];

    if (isset($_POST['terms'])) {
        $sql = "INSERT INTO users (FIRSTNAME_U, LASTNAME_U, TEL_U, EMAIL_U, PASS_U, USER_TYPE) 
                VALUES (:firstname, :lastname, :tel, :email, :password, :userType)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':tel' => $tel,
            ':email' => $email,
            ':password' => $password,
            ':userType' => $userType,
        ]);
       

        echo "<script>
                alert('Registration successful!, please press OK to login');
                window.location.href = 'signin.php?signup=success';
              </script>";
        exit();
    } else {
        echo "You must agree to the terms and conditions.";
    }
}
?>