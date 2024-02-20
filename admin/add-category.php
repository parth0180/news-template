<?php 
include "header.php";

if($_SESSION["user_role"]=='0'){
    header("Location:http://localhost/news-template/admin/post.php");
  }




if (isset($_POST['submit'])) {
    include "config.php";
    
    $caname = mysqli_real_escape_string($conn, $_POST['cat']);
    $post = mysqli_real_escape_string($conn, $_POST['post']);

    // Check if the category already exists
    $sql_check = "SELECT category_name FROM category WHERE category_name = '{$caname}'";
    $result_check = mysqli_query($conn, $sql_check) or die("Query failed.");
    
    if (mysqli_num_rows($result_check) > 0) {
        echo "<p style ='color :red;text-align:center;margin : 10px 0;'>Category already exists.</p>";
    } else {
        // Insert the new category
        $sql_insert = "INSERT INTO category(category_name, post) VALUES ('{$caname}', '{$post}')";
        if (mysqli_query($conn, $sql_insert)) {
            echo "<p style ='color :green;text-align:center;margin : 10px 0;'>Category added successfully.</p>";
        } else {
            echo "<p style ='color :red;text-align:center;margin : 10px 0;'>Error: " . mysqli_error($conn) . "</p>";
        }
    }
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                    </div>

                    <div class="form-group">
                        <label>Post</label>
                        <input type="text" name="post" class="form-control" placeholder="Post" required>
                    </div>

                    <input type="submit" name="submit" class="btn btn-primary" value="Save">
                </form>
                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
