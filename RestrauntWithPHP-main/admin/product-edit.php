<?php global $conn;
include ('../connector.php');

$id = "";
$title = "";
$desc = "";
$price = "";
$featured = "";
$active = "";
$img_name = "";
$cat_id = "";
$errorMessage = "";
$details = "";
$successMessage = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if(!isset($_GET["id"])) {
        header("location: /admin/product-dashboard.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = /** @lang text */
        "SELECT * FROM food WHERE ID=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /admin/product-dashboard.php");
        exit;
    }

    $title = $row["Title"];
    $desc = $row["Description"];
    $price = $row["Price"];
    $featured = $row["Featured"];
    $active = $row["Active"];
    $img_name = $row["Image_Name"];
    $cat_id = $row["Category_ID"];
}
else {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $desc = $_POST["desc"];
    $price = (double) $_POST["price"];
    $featured = $_POST["featured"];
    $active = $_POST["active"];
    $img_name = $_POST["img_name"];
    $cat_id = (int) $_POST["cat_id"];

    do {

        $sql = /** @lang text */
            "UPDATE food ".
            "SET Title = '$title', Description = '$desc', Price = $price, Featured = '$featured', Active = '$active', Image_Name = '$img_name', Category_ID = $cat_id ".
            "WHERE ID = $id";

        try {
            $result = $conn->query($sql);
        }
        catch (Exception $e) {
            $errorMessage = "Invalid query";
            $details = $conn->error;
            break;
        }

        $successMessage = "Product Updated Successfully";

        header("location: /admin/product-dashboard.php");
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
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/create.css">
    <link rel="stylesheet" href="../styles/homepage.css">


</head>


<body>
<header>
    <h2 class="logo">Signature Cuisine</h2>
    <nav class="navigation">
        <a href="user-dashboard.php">Users</a>
        <a href="category-dashboard.php">Categories</a>
        <a href="product-dashboard.php">Products</a>
        <button class="btnLogin-popup">Logout</button>
    </nav>

</header>
<?php
echo "
    <div class='wrapper product'>
        <div class='form-box'>
            <h2>Edit Product</h2>
            <form method='post'>
                <input type='hidden' name='id' value='$id'>
                <div class='form-container product'>
                    <div class='column'>
                        <div class='input-box'>
                            <input type='text' name='title' value='$title' required>
                            <label>Title</label>
                        </div>
                        <div class='input-box'>
                            <input type='text' name='price' value='$price' required>
                            <label>Price</label>
                        </div>
                        <div class='input-box'>
                            <input type='text' name='cat_id' value='$cat_id' required>
                            <label>Category ID</label>
                        </div>
                    </div>
                    <div class='column'>
                        <div class='input-box'>
                            <input type='text' name='featured' value='$featured' required>
                            <label>Featured</label>
                        </div>
                        <div class='input-box'>
                            <input type='text' name='active' value='$active' required>
                            <label>Active</label>
                        </div>
                        <div class='input-box'>
                            <input type='text' name='img_name' value='$img_name' required>
                            <label>Image Name</label>
                        </div>
                    </div>
                </div>
                <div class='textarea-box'>
                    <label>Description</label>
                    <textarea class='desc' name='desc' required>$desc</textarea>
                </div>
                <div class='footer'>
                    <button type='submit' class='btn'>Update</button>
                    <a class='btn' href='product-dashboard.php'>Cancel</a>
                </div>
            </form>" .
            (empty($errorMessage)? "" : "<p title='$details' class='err-msg'>$errorMessage</p>" ) .
        "</div>
    </div>
"
?>

</body>