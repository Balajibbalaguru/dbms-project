<?php
session_start();
require('connection.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM products WHERE id = $id");

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        header("Location: dashboard.php?message=Product+not+found");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['price']);

    $sql = "UPDATE products SET name='$name', description='$description', price='$price' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php?message=Product+updated+successfully");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php include('../layouts/admin_header.php'); ?>

<div class="container mt-5">
    <h2>Edit Product</h2>
    <form action="edit_product.php" method="POST" class="needs-validation" novalidate>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name:</label>
            <input type="text" name="name" class="form-control" id="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            <div class="invalid-feedback">
                Please provide a product name.
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" class="form-control" id="description" rows="5" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            <div class="invalid-feedback">
                Please provide a description.
            </div>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price:</label>
            <input type="text" name="price" class="form-control" id="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            <div class="invalid-feedback">
                Please provide a price.
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

<?php include('../layouts/admin_footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7/zEnb8PAFJ/XHjtP2h0VxFqXsdE3vUG9zHiRKnUPn6Z/iIOTu6mbJX7RoX4lMN8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGevVYgD1Anm/znrTvtLpW2f8A2kaelPkYB6a1l/o2K7N4p1gZQfNcJoM1X" crossorigin="anonymous"></script>
<script>
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
