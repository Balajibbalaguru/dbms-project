<?php
session_start();
require('connection.php');
?>

<?php include('../layouts/admin_header.php'); ?>
<div class="container mt-5 pt-5">
        <!-- Your dashboard content goes here -->
        <h1>Welcome to the Admin Dashboard</h1>
        <p>This is where you can manage your products and view site analytics.</p>
    </div>

<div class="container mt-5">
    <h2>Product List</h2>
    <?php
    if (isset($_GET['message'])) {
        echo '<div class="alert alert-success">' . htmlspecialchars($_GET['message']) . '</div>';
    }

    $result = $conn->query("SELECT * FROM products");
    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['description'] . '</td>
                    <td>' . $row['price'] . '</td>
                    <td>' . $row['created_at'] . '</td>
                    <td>
                        <a href="edit_product.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_product.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</a>
                    </td>
                  </tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<div class="alert alert-info">No products found.</div>';
    }
    ?>
</div>

<?php include('../layouts/admin_footer.php'); ?>
