<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit;
}

$user_id = $_GET['user_id'];

$user_query = "SELECT * FROM users WHERE ID_U = ?";
$stmt = $pdo->prepare($user_query);
$stmt->execute([$user_id]);
$user = $stmt->fetch();
$PFP_U = isset($user['PFP_U']) ? $user['PFP_U'] : 'default.jpg';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
  
<div class="edit-modal" id="editModal">
    <div class="edit-modal-box">
        <span class="close" id="editClose">&times;</span>
        <h2>Edit your profile information</h2>
        
        <form action="editProfile.php" class="edit-div" id="editForm" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="edit-left">
                    <br>
                    <table class="edit-tab">
                        <tr>
                            <td><label for="nameEdit">Name :</label></td>
                            <td><input type="text" name="nameEdit" id="nameEdit" value="<?php echo $user['FIRSTNAME_U'] ?>"><br></td>
                        </tr>
                        <tr>
                            <td><label for="surnameEdit">Surname :</label></td>
                            <td><input type="text" name="surnameEdit" id="surnameEdit" value="<?php echo $user['LASTNAME_U'] ?>"><br></td>
                        </tr>
                        <tr>
                            <td><label for="addressEdit">Address :</label></td>
                            <td><input type="text" name="addressEdit" id="addressEdit" value="<?php echo $user['ADDRESS'] ?>"><br></td>
                       </tr>
                        <tr>
                            <td><label for="birthEdit">Birthday :</label></td>
                            <td><input type="date" name="birthEdit" id="birthEdit" value="<?php echo $user['BIRTHDAY'] ?>"><br></td>
                        </tr>
                        <tr>
                            <td><label for="phoneEdit">Phone number :</label></td>
                            <td><input type="tel" name="phoneEdit" id="phoneEdit" value="<?php echo $user['TEL_U'] ?>"><br></td>
                        </tr>
                    </table>
                </div>
                <div class="edit-right">
                    <form action="editProfile.php" method="post" enctype="multipart/form-data">
                        <a id="changePic">
                            <img id="profileImgEdit" class="edit-img" src="uploads/<?php echo $PFP_U; ?>" alt="">
                            <div class="profilepic__content" id="profileHover">
                                <span class="profilepic__text">Change image</span>
                            </div>
                            <input id="imageUpload" type="file" name="profile_photo" capture>
                        </a>
                </div>
            </div>
            <div class="btns">        
                <input type="submit" class="btn" id="submitBtn">
                <button class="btn" id="cancelBtn">Cancel</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
