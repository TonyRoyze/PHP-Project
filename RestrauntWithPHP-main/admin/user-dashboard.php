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
    <link rel="stylesheet" href="../styles/product-dashboard.css">
    <link rel="stylesheet" href="../styles/homepage.css">


</head>

<body>
<header>
    <h2 class="logo">Signature Cuisine</h2>
    <nav class="navigation">
        <a class="link" href="user-dashboard.php">Users</a>
        <a class="link" href="reservation-dashboard.php">Reservations</a>
        <a class="link" href="category-dashboard.php">Categories</a>
        <a class="link" href="product-dashboard.php">Products</a>
        <a class="btnLogout" href="../logout.php">Logout</a>
    </nav>

</header>
<div class="dashboard">

    <div class="table-name">
        <h1>User Details</h1>
        <a class="btn-add" href="user-create.php" role="button">
            <ion-icon name="add-circle-outline"></ion-icon>
        </a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>User Name</th>
            <th>Role</th>
            <th>Email</th>
            <th>Password</th>
            <th>
                <a class='btn-actions'><ion-icon name="ellipsis-vertical-outline"></ion-icon></a>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = /** @lang text */
            "SELECT * FROM auth";
        $result = $conn->query($sql);

        if (!$result) {
            die("Invalid query" . $conn->connect_error);
        }

        while ($row = $result->fetch_assoc()) {
            $pass = substr($row["Password"], 0, 8).'...';
            echo "
                <tr>
                    <td>$row[Username]</td>
                    <td>$row[Role]</td>
                    <td>$row[Email]</td>
                    <td>$pass</td>
                    <td>
                        <a class='btn-edit' href='user-edit.php?username=$row[Username]' role='button'><ion-icon name='create-outline'></ion-icon></a>
                        <a class='btn-delete' href='user-delete.php?username=$row[Username]' role='button'><ion-icon name='trash-outline'></ion-icon></a>
                    </td>
                </tr>
                ";
        }
        ?>
        </tbody>
    </table>
</div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>