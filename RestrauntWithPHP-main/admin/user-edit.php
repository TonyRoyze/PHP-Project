<?php global $conn;
include ('../connector.php');

$username = "";
$name = "";
$role = "";
$email = "";
$pass = "";
$errorMessage = "";
$details = "";
$successMessage = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if(!isset($_GET["username"])) {
        header("location: /admin/user-dashboard.php");
        exit;
    }

    $username = $_GET["username"];

    $sql = /** @lang text */
        "SELECT * FROM auth WHERE Username='$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /admin/user-dashboard.php");
        exit;
    }

    $name = $row["Username"];
    $role = $row["Role"];
    $email = $row["Email"];
    $pass = $row["Password"];
}
else {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $role = $_POST["role"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    do {

        $sql = /** @lang text */
            "UPDATE auth ".
            "SET Username = '$name', Role = '$role', Email = '$email', Password = '$pass'".
            "WHERE Username = '$username'";
        $result = $conn->query($sql);

        try {
            $result = $conn->query($sql);
        }
        catch (Exception $e) {
            $errorMessage = "Invalid query";
            $details = $conn->error;
            break;
        }

        $successMessage = "User Updated Successfully";

        header("location: /admin/product-dashboard.php");
        exit;
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
            <h2>Edit User</h2>
            <form method='post'>
                <input type='hidden' name='username' value='$username'>
                <div class='form-container user'>
                    <div class='input-box'>
                        <input type='text' name='name' value='$name' required>
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
                    <button type='submit' class='btn'>Update</button>
                    <a class='btn' href='user-dashboard.php'>Cancel</a>
                </div>
            </form>" .
            (empty($errorMessage)? "" : "<p title='$details' class='err-msg'>$errorMessage</p>" ) .
        "</div>
    </div>
"
?>

</body>