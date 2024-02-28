<?php
// Include the database connection file
require_once 'database.php';

// Create a new instance of the Database class
$database = new Database();

// Fetch vente data from the database
$ventes = $database->getAllVentes();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ventes List</title>
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
            <h4 class="text-center text-primary">Ventes List</h4>
            <p class="text-center">List of Ventes</p>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="bg-primary">
                        <th>ID</th>
                        <th>Client</th>
                        <th>Produit</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Date de Vente</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventes as $vente): ?>
                        <tr>
                            <td><?php echo $vente['id']; ?></td>
                            <td>
                                <?php
                                // Fetch client information based on the client ID
                                $client = $database->getClientById($vente['client_id']);
                                if ($client) {
                                    echo $client['name'];
                                } else {
                                    echo "Client not found";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                // Fetch product information based on the product ID
                                $produit = $database->getProduitById($vente['id_produit']);
                                if ($produit) {
                                    echo $produit['categorie'];
                                    if (isset($produit['Periode'])) {
                                        echo ' (' . $produit['Periode'] . ')';
                                    }
                                } else {
                                    echo "Product not found";
                                }
                                ?>
                            </td>
                            <td><?php echo $vente['description']; ?></td>
                            <td><?php echo $vente['prix']; ?></td>
                            <td><?php echo $vente['date_vente']; ?></td>
                            <td>
                                <!-- Update button -->
                                <a href="ventes_form.php?vente_id=<?php echo $vente['id']; ?>"> 
                                    <button class="btn btn-warning btn-sm">
                                        <i class="mdi mdi mdi-border-color text-black menu-icon"></i>
                                    </button>
                                </a>
                                <!-- Delete button -->
                                <button class="btn btn-danger btn-sm" onclick="deleteVente(<?php echo $vente['id']; ?>)">
                                    <i class="mdi mdi mdi-popcorn black menu-icon"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <a href="ventes_form.php">
                <button type="button" class="btn btn-success">AJOUTER UNE VENTE</button>
            </a>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    function deleteVente(venteId) {
        if (confirm("Are you sure you want to delete this vente?")) {
            window.location.href = "delete_column.php?vente_id=" + venteId;
        }
    }
</script>

<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
</body>
</html>
