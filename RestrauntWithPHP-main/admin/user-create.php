<?php global $conn;
include ('../connector.php');

$username = "";
$role = "";
$email = "";
$pass = "";
$errorMessage = "";
$details = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"];
    $role = $_POST["role"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    do {

        $sql =/** @lang text */
            "INSERT INTO auth (Username, Role, Email, Password)".
            "VALUES ('$username', '$role', '$email', '$pass')";

        try {
            $result = $conn->query($sql);
        }
        catch (Exception $e) {
            $errorMessage = "Invalid query";
            $details = $conn->error;
            break;
        }

        $successMessage = "User Added Successfully";

        $username = "";
        $role = "";
        $email = "";
        $pass = "";
    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signature Cuisine</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/create.css">
    <link rel="stylesheet" href="../styles/homepage.css">


</head>


<body>
<header>
    <h2 class="logo">Signature Cuisine</h2>
    <nav class="navigation">
        <a href="user-dashboard.php">Users</a>
        <a href="category-dashboard.php">Categories</a>
        <a href="product-dashboard.php">Products</a>
        <button class="btnLogin-popup">Logout</button>
    </nav>

</header>
<?php
echo "
    <div class='wrapper user'>
        <div class='form-box'>
            <h2>New Product</h2>
            <form method='post'>
                <div class='form-container user'>
                    <div class='input-box'>
                        <input type='text' name='username' value='$username' required>
                        <label>Username</label>
                    </div>
                    <div class='input-box'>
                        <input type='text' name='role' value='$role' required>
                        <label>Role</label>
                    </div>
                    <div class='input-box'>
                        <input type='email' name='email' value='$email' required>
                        <label>Email</label>
                    </div>
                    <div class='input-box'>
                        <input type='password' name='pass' value='$pass' required>
                        <label>Password</label>
                    </div>
                </div>
                <div class='footer'>
                    <button type='submit' class='btn'>Add</button>
                    <a class='btn' href='user-dashboard.php'>Cancel</a>
                </div>
            </form>" .
            (empty($errorMessage)? "" : "<p title='$details' class='err-msg'>$errorMessage</p>" ) .
            (empty($successMessage)? "" : "<p class='suc-msg'>$successMessage</p>") .
        "</div>
    </div>
"
?>

</body>