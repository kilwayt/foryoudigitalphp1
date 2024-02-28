<?php
require_once 'database.php';

// Fetch fournisseur IDs and names from the database
$database = new Database();
$fournisseurs = $database->getAllFournisseurs();

$error_message = "";

// Check if the form is submitted for updating an existing achat
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_update'])) {
    $achatId = $_POST["achat_id"];
    $fournisseur_id = $_POST["fournisseur_id"];
    $produit_id = $_POST["produit_id"];
    $date_achat = $_POST["date_achat"];

    // Instantiate the Database class
    $database = new Database();

    try {
        // Update achat data
        $database->updateAchat($achatId, $fournisseur_id, $produit_id, $date_achat);

        // Redirect to a success page or do something else
        header("Location: achats_table.php"); // Update this if needed
        exit();
    } catch (PDOException $e) {
        $error_message = "Failed to update achat data: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connect Plus</title>
    <!-- CSS styles -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- End CSS styles -->
    <!-- Plugin CSS for this page -->
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin CSS for this page -->
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End custom CSS -->
    <link rel="shortcut icon" href="assets/images/logo1.png" />
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="col-10 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h2 class="text-center h1 text-primary">Achats</h2>
            <p class="h3 text-center fs-1"> Saisir Votre Achats </p>
            <!-- FORM -->
            <form class="forms-sample" method="POST" action="">
                <div class="form-group">
                    <label for="fournisseur_id">Fournisseur</label>
                    <select class="form-control" id="fournisseur_id" name="fournisseur_id">
                        <?php foreach ($fournisseurs as $fournisseur): ?>
                            <option value="<?php echo $fournisseur['id']; ?>">
                                <?php echo $fournisseur['id'] . ' - ' . (isset($fournisseur['name_fournisseur']) ? $fournisseur['name_fournisseur'] : 'Unknown'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="produit_id">Produit</label>
                    <!-- Add select input for produits -->
                    <select class="form-control" id="produit_id" name="produit_id">
                        <?php 
                        $produits = $database->getAllProduits();
                        foreach ($produits as $produit): ?>
                            <option value="<?php echo $produit['id']; ?>">
                                <?php echo $produit['id'] . ' - ' . $produit['categorie'] . ' (' . $produit['Periode'] . ')'; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_achat">Date d'Achat</label>
                    <input type="date" class="form-control" id="date_achat" name="date_achat">
                </div>
                <input type="hidden" name="achat_id" value="<?php echo isset($_GET['achat_id']) ? $_GET['achat_id'] : ''; ?>">
                <button type="submit" class="btn btn-primary mr-2" name="submit_update">Update</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
<!-- JavaScript scripts -->
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<!-- End JavaScript scripts -->
<!-- Plugin JavaScript for this page -->
<script src="assets/vendors/select2/select2.min.js"></script>
<script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
<!-- End plugin JavaScript for this page -->
<!-- Custom JavaScript -->
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<script src="assets/js/file-upload.js"></script>
<script src="assets/js/typeahead.js"></script>
<script src="assets/js/select2.js"></script>
<!-- End custom JavaScript -->
</body>
</html>
