<?php global $conn;
include ('../connector.php');

$title = "";
$featured = "";
$active = "";
$img_name = "";
$errorMessage = "";
$details = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST["title"];
    $featured = $_POST["featured"];
    $active = $_POST["active"];
    $img_name = $_POST["img_name"];

    do {

        $sql = /** @lang text */
            "INSERT INTO category (Title, Featured, Active, Image_Name)".
            "VALUES ('$title', '$featured', '$active', '$img_name')";

        try {
            $result = $conn->query($sql);
        }
        catch (Exception $e) {
            $errorMessage = "Invalid query";
            $details = $conn->error;
            break;
        }

        $successMessage = "Category Added Successfully";

        $title = "";
        $featured = "";
        $active = "";
        $img_name = "";
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
    <div class='wrapper user'>
        <div class='form-box'>
            <h2>New Category</h2>
            <form method='post'>
                <div class='form-container user'>
                    <div class='input-box'>
                        <input type='text' name='title' value='$title' required>
                        <label>Title</label>
                    </div>
                    <div class='input-box'>
                        <input type='text' name='img_name' value='$img_name' required>
                        <label>Image Name</label>
                    </div>
                    <div class='input-box'>
                        <input type='text' name='featured' value='$featured' required>
                        <label>Featured</label>
                    </div>
                    <div class='input-box'>
                        <input type='text' name='active' value='$active' required>
                        <label>Active</label>
                    </div>
                </div>
                <div class='footer'>
                    <button type='submit' class='btn'>Add</button>
                    <a class='btn' href='category-dashboard.php'>Cancel</a>
                </div>
            </form>" .
    (empty($errorMessage)? "" : "<p title='$details' class='err-msg'>$errorMessage</p>" ) .
    (empty($successMessage)? "" : "<p class='suc-msg'>$successMessage</p>") .
    "</div>
    </div>
"
?>

</body>