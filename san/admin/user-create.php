<?php global $conn;
session_start();
include ('../connector.php');
include ('../functions.php');

$user_data = checkLogin($conn);

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

<?php
include ('./admin-header.php');
echo "
    <div class='wrapper medium'>
        <div class='form-box'>
            <h2>New Product</h2>
            <form method='post'>
                <div class='form-container medium'>
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