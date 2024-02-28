<?php
require_once 'database.php';

// Fetch product data from the database
$database = new Database();
$products = $database->getAllProduit();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Product List</title>
    <!-- CSS styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>
<body>
<?php include 'sidebar.php'; ?>

<div class="col-lg-10 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="text-center text-success">Product List</h4>
            <p class="text-center">List of Products</p>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="bg-success">
                        <th>ID</th>
                        <th>Categorie</th>
                        <th>Periode</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th> <!-- New column for buttons -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><?php echo $product['categorie']; ?></td>
                            <td><?php echo $product['periode']; ?></td>
                            <td><?php echo $product['description']; ?></td>
                            <td><?php echo $product['prix']; ?></td>
                            <td><?php echo $product['start_date']; ?></td>
                            <td><?php echo $product['end_date']; ?></td>
                            <td>
                                <!-- Update button -->
                                <a href="produit_form.php?product_id=<?php echo $product['id']; ?>">
                                    <button class="btn btn-warning btn-sm">
                                        <i class="mdi mdi mdi-border-color text-black menu-icon"></i>
                                    </button>
                                </a>
                                <!-- Delete button -->
                                <button class="btn btn-danger btn-sm" onclick="deleteProduct(<?php echo $product['id']; ?>)">
                                    <i class="mdi mdi mdi-delete black menu-icon"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <a href="produit_form.php">
                <button type="button" class="btn btn-success">Add Product</button>
            </a>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    function deleteProduct(productId) {
        if (confirm("Are you sure you want to delete this product?")) {
            window.location.href = "delete_column.php?product_id=" + productId;
        }
    }
</script>

<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
</body>
</html>
