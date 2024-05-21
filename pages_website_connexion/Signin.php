<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Login & registration</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="..\styles\registration.css">
        </head>
        <body>
                <?php
                session_start();
                session_unset();
                session_destroy();
                ?>
        <div class="logo">
            <a href="#"><i class="fa-solid fa-hippo"></i></a>
            <h1>HippoBooking</h1>
        </div>
        <div class="wrapper">
            <div class="form-wrapper sign-in">
                <form action="login.php" method="post">
                    <h2>Sign In</h2>
                    <div class="input-group">
                        <input type="email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="remember">
                        <label><input type="checkbox"> Remember me </label>
                    </div>
                    <button type="submit"> Sign In</button>
                    <div class="sign-up-link">
                        <p>Don't have an account ? <a href="#">Sign Up</a></p>
                    </div>
                    <div class="social-platforms">
                        <p>Or sign in with </p>
                        <div class="social-icons">
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#"><i class="fa-brands fa-google"></i></a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="form-wrapper sign-up">
                <form action="signup.php" method="post">
                    <h2>Sign Up</h2>
                    <div class="input-group">
                        <input type="text" name="firstname" required>
                        <label for="firstname">First Name</label>
                    </div>
                    <div class="input-group">
                        <input type="text" name="lastname" required>
                        <label for="lastname">Last Name</label>
                    </div>
                    <div class="input-group">
                        <input type="text" name="tel" required>
                        <label for="tel">Telephone</label>
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" id="organizer" name="userType" value="organizer" required>
                        <label for="organizer">Organizer</label>
                        <input type="radio" id="simpleUser" name="userType" value="simpleUser" required>
                        <label for="simpleUser">Simple User</label>
                    </div>
                    <div class="remember">
                        <label><input type="checkbox" name="terms" required> I agree to the terms and conditions </label>
                    </div>
                    <button type="submit"> Sign Up</button>
                    <div class="sign-in-link">
                        <p>Already have an account ? <a href="#">Sign In</a></p>
                    </div>
                </form>
            </div>
        </div>
        <script src="../js/scriptreg.js">
        </script>
    </body>
</html>