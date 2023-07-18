<?php

function checkLogin($conn){

    if (isset($_SESSION['Username'])){
        $username = $_SESSION['Username'];

        $sql = /** @lang text */
            "SELECT * FROM auth WHERE Username='$username' LIMIT 1";
        $result = $conn->query($sql);
        if ($result && mysqli_num_rows($result) > 0){
            return $result->fetch_assoc();
        }

    }

    header("location: /login.php");
    exit;
}