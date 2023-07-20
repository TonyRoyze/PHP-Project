<?php global $conn;
session_start();
include ('../connector.php');
include ('../functions.php');

$user_data = checkLogin($conn);

$id = "";
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

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["id"])) {
        header("location: /admin/reservation-dashboard.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = /** @lang text */
        "SELECT * FROM reservations WHERE ID=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /admin/reservation-dashboard.php");
        exit;
    }

    $firstName = $row["First_Name"];
    $comments = $row["Comments"];
    $date = $row["Date"];
    $time = $row["Time"];
    $phone = $row["Phone_No"];
    $email = $row["Email"];
    $guests = $row["Guests"];
}
else {
    $id = $_POST["id"];
    $firstName = $_POST["firstName"];
    $comments = $_POST["comments"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $guests = (int) $_POST["guests"];

    do {
        $sql = /** @lang text */
            "UPDATE reservations ".
            "SET First_Name = '$firstName', Comments = '$comments', Date = '$date', Time = '$time', Email = '$email', Phone_No = '$phone', Guests = $guests ".
            "WHERE ID = $id";
        $result = $conn->query($sql);
        try {
            $result = $conn->query($sql);
        }
        catch (Exception $e) {
            $errorMessage = "Invalid query";
            $details = $conn->error;
            break;
        }

        $successMessage = "Reservation Updated Successfully";

        header("location: /admin/reservation-dashboard.php");
        exit;
    } while (false);
}
?>

<?php
include ('./admin-header.php');
echo "
    <div class='wrapper large'>
        <div class='form-box'>
            <h2>Make Reservasation</h2>
            <form method='post'>
                <input type='hidden' name='id' value='$id'>
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