<?php global $conn;
include ('../connector.php');

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST["title"];
    $desc = $_POST["desc"];
    $price = (double) $_POST["price"];
    $featured = $_POST["featured"];
    $active = $_POST["active"];
    $img_name = $_POST["img_name"];
    $cat_id = (int) $_POST["cat_id"];

    do {

        $sql = /** @lang text */
            "INSERT INTO food (Title, Description, Price, Featured, Active, Image_Name, Category_ID)".
            "VALUES ('$title', '$desc', $price, '$featured', '$active', '$img_name', $cat_id)";

        try {
            $result = $conn->query($sql);
        }
        catch (Exception $e) {
            $errorMessage = "Invalid query";
            $details = $conn->error;
            break;
        }

        $successMessage = "Product Added Successfully";

        $title = "";
        $desc = "";
        $price = "";
        $featured = "";
        $active = "";
        $img_name = "";
        $cat_id = "";
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
    <link rel="stylesheet" href="../styles/homepage.css">
    <link rel="stylesheet" href="../styles/create.css">

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
            <h2>New Product</h2>
            <form method='post'>
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
                    <button type='submit' class='btn'>Add</button>
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