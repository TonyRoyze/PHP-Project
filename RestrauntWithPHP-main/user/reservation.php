<?php global $conn;
session_start();
include ('../connector.php');
include ('../functions.php');

$user_data = checkLogin($conn);

$firstName = "";
$phone = "";
$email = "";
$date = "";
$time = "";
$guests = "";
$comments = "";
$errorMessage = "";
$details = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST["firstName"];
    $comments = $_POST["comments"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $guests = (int) $_POST["guests"];

    do {

        $sql = /** @lang text */
            "INSERT INTO reservations (First_Name, Comments, Date, Time, Email, Phone_No, Guests)".
            "VALUES ('$firstName', '$comments', '$date', '$time', '$email', '$phone', $guests)";
        $result = $conn->query($sql);
        try {
            $result = $conn->query($sql);
        }
        catch (Exception $e) {
            $errorMessage = "Invalid query";
            $details = $conn->error;
            break;
        }

        $successMessage = "Reservation Added Successfully";

        $firstName = "";
        $comments = "";
        $date = "";
        $time = "";
        $phone = "";
        $email = "";
        $guests = "";
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
    <link rel="stylesheet" href="../styles/common.css">
    <link rel="stylesheet" href="../styles/homepage.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="stylesheet" href="../styles/reservation.css">

</head>


<body>
<header>
    <h2 class="logo">Signature Cuisine</h2>
    <nav class="navigation">
        <a class="link" href="menu.php">Menu</a>
        <a class="link" href="reservation.php">Make Reservation</a>
        <a class="link" href="contact.php">Contact Us</a>
        <a class="btnLogout" href="../logout.php">Logout</a>
    </nav>

</header>
<?php
echo "
    <div class='wrapper large'>
        <div class='form-box'>
            <h2>Make Reservasation</h2>
            <small>We recommend making reservations at least two days in advance. For walk-ins, we only seat parties on a first come, first served basis.</small>
            <form method='post'>
                <div class='form-container large'>
                    <div class='column'>
                        <div class='input-box'>
                            <input type='text' name='firstName' value='$firstName' required>
                            <label>First Name</label>
                        </div>
                        <div class='input-box'>
                            <input type='text' name='phone' value='$phone' required>
                            <label>Phone No.</label>
                        </div>
                        <div class='input-box'>
                            <input type='date' name='date' value='$date' required>
                            <label class='date'>Date</label>
                        </div>
                    </div>
                    <div class='column'>
                        <div class='input-box'>
                            <input type='email' name='email' value='$email' required>
                            <label>Email</label>
                        </div>
                        <div class='input-box'>
                            <input type='text' name='guests' value='$guests' required>
                            <label>No. of Guests</label>
                        </div>
                        <div class='input-box'>
                            <input type='time' name='time' value='$time' required>
                            <label class='time'>Time</label>
                        </div>
                    </div>
                </div>
                <div class='textarea-box'>
                    <label>Comments</label>
                    <textarea class='desc' name='comments' required>$comments</textarea>
                </div>
                <div class='footer'>
                    <button type='submit' class='btn'>Submit</button>
                    <a class='btn' href='product-dashboard.php'>Cancel</a>
                </div>
            </form>".
            (empty($errorMessage)? "" : "<p title='$details' class='err-msg'>$errorMessage</p>" ) .
            (empty($successMessage)? "" : "<p class='suc-msg'>$successMessage</p>") .
        "</div>
    </div>
"
?>

</body>