<?php global $conn;
include ('../connector.php');

if(isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql = /** @lang text */
        "DELETE FROM category WHERE ID = $id";
    $conn->query($sql);

    header("location: /admin/category-dashboard.php");
    exit;
}
