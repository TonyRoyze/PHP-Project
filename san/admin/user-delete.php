<?php global $conn;
session_start();
include ('../connector.php');
include ('../functions.php');

$user_data = checkLogin($conn);

if(isset($_GET["username"])) {

    $username = $_GET["username"];

    $sql = /** @lang text */
        "DELETE FROM auth WHERE Username = '$username'";
    $conn->query($sql);

    header("location: /admin/user-dashboard.php");
    exit;
}
