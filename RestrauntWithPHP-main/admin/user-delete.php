<?php global $conn;
include ('../connector.php');

if(isset($_GET["username"])) {

    $username = $_GET["username"];

    $sql = /** @lang text */
        "DELETE FROM auth WHERE Username = '$username'";
    $conn->query($sql);

    header("location: /admin/user-dashboard.php");
    exit;
}
