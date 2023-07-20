<?php global $conn;
session_start();
include ('../connector.php');
include ('../functions.php');

$user_data = checkLogin($conn);

$firstName = "";
$email = "";
$subject = "";
$phone = "";
$message = "";
$errorMessage = "";
$details = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST["firstName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    do {

        $sql = /** @lang text */
            "INSERT INTO inquiries (First_Name, Email, Phone_No, Subject, Message)".
            "VALUES ('$firstName', '$email', '$phone', '$subject', '$message')";

        try {
            $result = $conn->query($sql);
        }
        catch (Exception $e) {
            $errorMessage = "Invalid query";
            $details = $conn->error;
            break;
        }

        $successMessage = "Inquiry Sent Successfully";

        header("location: /user/menu.php");
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
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/home.css">
    <link rel="stylesheet" href="../styles/admins.css">
    <link rel="stylesheet" href="../styles/reservations.css">

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
    <div class='contactus'>
        <div class='column'>
            <p class='contact-info'>If you have any questions, we would love to hear from you. Please contact us using the form on the right.</p>
            <p class='contact-info'>50/2 Park Street</p>
            <p class='contact-info'>Colombo 00200</p>
            <p class='contact-info'>Sri Lanka</p>
            <img class='map' src='../images/map.png'  alt='location'>
        </div>
        <div class='column'>
            <form method='post'>
                <div class='input-box'>
                    <input type='text' name='firstName' value='$firstName' required>
                    <label>First Name</label>
                </div>
                <div class='input-box'>
                    <input type='text' name='phone' value='$phone' required>
                    <label>Phone No.</label>
                </div>
                <div class='input-box'>
                    <input type='email' name='email' value='$email' required>
                    <label>Email</label>
                </div>
                <div class='input-box'>
                    <input type='text' name='subject' value='$subject' required>
                    <label>Subject</label>
                </div>
                <div class='textarea-box'>
                    <label>Message</label>
                    <textarea class='desc' name='message' required>$message</textarea>
                </div>
                <div class='footer'>
                    <button type='submit' class='btn'>Submit</button>
                    <a class='btn' href='menu.php'>Cancel</a>
                </div>
            </form>
        </div>

    </div>
</div>
"?>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
