<?php global $conn;
session_start();
include ('./connector.php');
include ('./functions.php');

$login = true;
$login_email = "";
$login_pass = "";
$reg_username = "";
$reg_email = "";
$reg_pass = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['btn-login'])) {
        $login_email = $_POST['login_email'];
        $login_pass = $_POST['login_pass'];
    }
    if(isset($_POST['btn-reg'])) {
        $reg_username = $_POST['reg_username'];
        $reg_email = $_POST['reg_email'];
        $reg_pass = $_POST['reg_pass'];
    }

    
    if (!empty($login_email) && !empty($login_pass) && empty($reg_username) && empty($reg_email) && empty($reg_pass)){
        do {

            $sql = /** @lang text */
                "SELECT * FROM auth WHERE Email = '$login_email' LIMIT 1";

            try {
                $result = $conn->query($sql);
            }
            catch (Exception $e) {
                $errorMessage = "Invalid Query";
                break;
            }

            if ($result && mysqli_num_rows($result) > 0){
                $user_data = $result->fetch_assoc();
                if ($user_data['Password'] == $login_pass){
                    $_SESSION['Username'] = $user_data["Username"];
                    $successMessage = "Logged In Successfully";
                    if ($user_data['Role'] == "USER") {
                        header("location: /user/menu.php");
                        exit;
                    }
                    elseif ($user_data['Role'] == "ADMIN"){
                        header("location: /admin/product-dashboard.php");
                        exit;
                    }
                }
                else {
                    $errorMessage = "Username or Password is Incorrect";
                    break;
                }
            }


        } while (false);
    }
    
    if (empty($login_email) && empty($login_pass) && !empty($reg_username) && !empty($reg_email) && !empty($reg_pass)){
        do {

            $sql = /** @lang text */
                "INSERT INTO auth (Username, Role, Email, Password)".
                "VALUES ('$reg_username', 'USER', '$reg_email', '$reg_pass')";;

            try {
                $result = $conn->query($sql);
            }
            catch (Exception $e) {
                $errorMessage = "Invalid data";
                $details = $conn->error;
                break;
            }

            $successMessage = "User Added Successfully";

            $reg_username = "";
            $reg_email = "";
            $reg_pass = "";
        } while (false);
    }
    

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signature Cuisine</title>
    <link rel="stylesheet" href="styles/common.css">
    <link rel="stylesheet" href="styles/admin.css">

</head>

<body>
<header>
    <h2 class="logo">Signature Cuisine</h2>
    <nav class="navigation">
<!--        <a href="home.php">Home</a>-->
<!--        <a href="#">About</a>-->
<!--        <a href="#">Services</a>-->
<!--        <a href="#">Contact</a>-->
<!--        <button class="btnLogin-popup" onclick="window.location.href='login.php'">Login</button>-->
    </nav>
</header>
<?php

echo "

<div class='wrapper login'>
    <div class='form-box login'>
        <h2>Login</h2>
        <form method='post'>
            <div class='input-box'>
                <span class='icon'><ion-icon name='mail-outline'></ion-icon></span>
                <input type='email' name='login_email' required>
                <label>Email</label>
            </div>
            <div class='input-box'>
                <span class='icon'><ion-icon name='lock-closed-outline'></ion-icon></span>
                <input type='password' name='login_pass' required>
                <label>Password</label>
            </div>
<!--            <div class='remember-forgot'>-->
<!--                <label><input type='checkbox'>Remember me</label>-->
<!--                <a href='#'>Forgot Password?</a>-->
<!--            </div>-->
            <input type='submit' class='btn' name='btn-login' value='Login'>
            <div class='login-register'>
                <p>Don't have an account?
                <a href='#' class='register-link'>Register</a></p>
            </div>
        </form>".
        (empty($errorMessage)? "" : "<p class='err-msg'>$errorMessage</p>" ) .
    "</div>
    <div class='form-box register'>
        <h2>Register</h2>
        <form method='post'>
            <div class='input-box'>
                <span class='icon'><ion-icon name='person-outline'></ion-icon></span>
                <input type='text' name='reg_username' required>
                <label>Username</label>
            </div>
            <div class='input-box'>
                <span class='icon'><ion-icon name='mail-outline'></ion-icon></span>
                <input type='email' name='reg_email' required>
                <label>Email</label>
            </div>
            <div class='input-box'>
                <span class='icon'><ion-icon name='lock-closed-outline'></ion-icon></span>
                <input type='password' name='reg_pass' required>
                <label>Password</label>
            </div>
<!--            <div class='remember-forgot'>-->
<!--                <label><input type='checkbox'>I agree to terms and conditions</label>-->
<!--            </div>-->
            <input type='submit' class='btn' name='btn-reg' value='Register'>
            <div class='login-register'>
                <p>Already have an account?
                <a href='#' class='login-link'>Login</a></p>
            </div>
        </form>
    </div>
</div>
"
?>
<script src="login.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
