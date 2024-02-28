<?php
require_once 'database.php';

// Fetch product details if editing existing product
$product_id = $_GET['product_id'] ?? null;
$product = null;
if ($product_id) {
    $database = new Database();
    $product = $database->getProduitById($product_id); // Corrected method name here
}

$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categorie = $_POST["categorie"];
    $periode = $_POST["periode"];
    $description = $_POST["description"];
    $prix = $_POST["prix"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    // Instantiate the Database class
    $database = new Database();

    try {
        if ($product) {
            // Update existing product
            $database->updateProduct($product_id, $categorie, $periode, $description, $prix, $start_date, $end_date);
        } else {
            // Insert new product
            $database->insertProduct($categorie, $periode, $description, $prix, $start_date, $end_date);
        }

        // Redirect to a success page or do something else
        header("Location: produit_table.php");
        exit();
    } catch (PDOException $e) {
        $error_message = "Failed to update product: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Product Form</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>
<body>
<?php include 'sidebar.php'; ?>

<div class="col-10 grid-margin stretch-card"> 
    <div class="card">
        <div class="card-body">
            <h2 class="text-center h1 text-primary">Produit</h2>
            <p class="h3 text-center fs-1"> Saisir Votre Produit </p>
            <!-- FORM -->
            <form class="forms-sample" method="POST" action="">
                <input type="hidden" name="product_id" value="<?php echo $product['id'] ?? ''; ?>">
                <div class="form-group">
                    <label for="exampleInputName1">Categorie</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="categorie" placeholder="Categorie" value="<?php echo $product['categorie'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputLink">Periode</label>
                    <input type="text" class="form-control" id="exampleInputLink" name="periode" placeholder="Periode" value="<?php echo $product['periode'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputLink">Description</label>
                    <input type="text" class="form-control" id="exampleInputLink" name="description" placeholder="Description" value="<?php echo $product['description'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Prix</label>
                    <input type="text" class="form-control" id="exampleInputEmail3" name="prix" placeholder="Prix" value="<?php echo $product['prix'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPhone">Start Date</label>
                    <input type="date" class="form-control" id="exampleInputPhone" name="start_date" placeholder="Start Date" value="<?php echo $product['start_date'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPhone">End Date</label>
                    <input type="date" class="form-control" id="exampleInputPhone" name="end_date" placeholder="End Date" value="<?php echo $product['end_date'] ?? ''; ?>">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
            <?php
            // Display error message if insertion failed
            if (!empty($error_message)) {
                echo '<div class="alert alert-danger mt-3" role="alert">' . $error_message . '</div>';
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
