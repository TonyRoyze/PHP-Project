<?php global $conn;
include ('../connector.php');

if(isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql = /** @lang text */
        "DELETE FROM food WHERE ID = $id";
    $conn->query($sql);

    header("location: /admin/product-dashboard.php");
    exit;
}
