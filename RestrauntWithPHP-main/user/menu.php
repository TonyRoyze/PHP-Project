<?php global $conn;
session_start();
include ('../connector.php');
include ('../functions.php');

$user_data = checkLogin($conn);
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
<div class="wrapper home">
    <div class="list">
        <?php

        $sql = /** @lang text */
            "SELECT * FROM food";
        $result = $conn->query($sql);

        if (!$result) {
            die("Invalid query" . $conn->connect_error);
        }

        while ($row = $result->fetch_assoc()) {
            echo "
                <div class='item'>
                    <img src='../images/$row[Image_Name]'>
                    <h3 class='title'>$row[Title]</h3>
                    <small class='description'>$row[Description]</small>
                    <small class='price'>$ $row[Price]</small>
                </div>
                ";
        }
        ?>

    </div>
</div>

<!--<script src="home.js"></script>-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
