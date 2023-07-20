<?php global $conn;
session_start();
include ('../connector.php');
include ('../functions.php');

$user_data = checkLogin($conn);

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

<?php
include ('./admin-header.php');
echo "
    <div class='wrapper medium'>
        <div class='form-box'>
            <h2>New Category</h2>
            <form method='post'>
                <div class='form-container medium'>
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