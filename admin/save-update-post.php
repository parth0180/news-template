<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and process form data only if it's a POST request

    $post_id = mysqli_real_escape_string($conn, $_POST["post_id"]);
    $post_title = mysqli_real_escape_string($conn, $_POST["post_title"]);
    $post_desc = mysqli_real_escape_string($conn, $_POST["postdesc"]);
    $category_id = mysqli_real_escape_string($conn, $_POST["category_id"]);

    if (empty($_FILES['new-image']['name'])) {
        $image = $_POST['old_image'];
    } else {
        $errors = [];

        $file_name = $_FILES['new-image']['name'];
        $file_size = $_FILES['new-image']['size'];
        $file_temp = $_FILES['new-image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $extensions = ["jpeg", "jpg", "png"];

        if (!in_array($file_ext, $extensions)) {
            $errors[] = "This extension is not allowed. Only JPG and PNG are allowed.";
        }

        if ($file_size > 2097152) {
            $errors[] = "File must be 2MB or lower.";
        }

        if (empty($errors)) {
            $upload_dir = "upload/";
            $image_path = $upload_dir . $file_name;
            if (move_uploaded_file($file_temp, $image_path)) {
                // File uploaded successfully, continue with the SQL update
                $sql = "UPDATE post SET title='$post_title', description='$post_desc', category='$category_id', post_img='$file_name' WHERE post_id='$post_id'";
             
              
                if (mysqli_query($conn, $sql)) {
                    echo "Post updated successfully";
                } else {
                    echo "Error updating post: " . mysqli_error($conn);
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }
    }
} else {
    // Redirect or display error message for unauthorized access
    echo "Unauthorized access.";
}
?>
