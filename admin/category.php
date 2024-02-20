<?php 
    include "header.php"; 
    // Include your database connection file here if not included in header.php

    // Example of retrieving category data from the database
   
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to fetch category data
    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);

    // Close the database connection after fetching data
    mysqli_close($conn);
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">Add Category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Category Name</th>
                            <th>No. of Posts</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            // Display category data fetched from the database
                            if (mysqli_num_rows($result) > 0) {
                                $count = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $count++ . "</td>";
                                    echo "<td>" . $row['category_name'] . "</td>";
                                    // You can replace the number of posts with actual count from your database
                                    echo "<td>".$row['post']."</td>"; // Placeholder for number of posts
                                    echo "<td class='edit'><a href='update-category.php?id=" . $row['category_id'] . "'><i class='fa fa-edit'></i></a></td>";
                                    echo "<td class='delete'><a href='delete-category.php?id=" . $row['category_id'] . "'><i class='fa fa-trash-o'></i></a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No categories found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <!-- Pagination Links can be added here if necessary -->
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
