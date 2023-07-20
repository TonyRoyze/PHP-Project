<?php global $conn;
session_start();
include ('../connector.php');
include ('../functions.php');

$user_data = checkLogin($conn);

if(isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql = /** @lang text */
        "DELETE FROM food WHERE ID = $id";
    $conn->query($sql);

    header("location: /admin/product-dashboard.php");
    exit;
}
