<?php
include "config.php";

if($_SESSION["user_role"]=='0'){
    header("Location:http://localhost/news-template/admin/post.php");
  }

$userid = $_GET['id'];

$sql = "DELETE FROM user WHERE user_id = {$userid}";

if (mysqli_query($conn, $sql)) {
    header("Location: ${hostname}/admin/users.php");
} else {
    echo "<p> cant delet</p>";
}

mysqli_close($conn);