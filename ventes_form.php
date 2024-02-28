    <?php
    require_once 'database.php';

    // Fetch client IDs and names from the database
    $database = new Database();
    $clients = $database->gettwoClients();
    $products = $database->getAllProduits();

    $error_message = "";
    $vente = array();

    // Check if vente ID is provided in the URL for updating
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['vente_id'])) {
        $venteId = $_GET['vente_id'];
        $vente = $database->getVenteById($venteId);
        if (!$vente) {
            echo "Vente not found.";
            exit();
        }
    }

    // Check if form is submitted for updating vente
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $client_id = $_POST["client_id"];
        $id_produit = $_POST["id_produit"];
        $description = $_POST["description"];
        $prix = $_POST["prix"];
        $date_vente = $_POST["date_vente"];

        // Instantiate the Database class
        $database = new Database();

        try {
            // If vente ID is provided, update vente
            if (isset($_POST['vente_id'])) {
                $venteId = $_POST['vente_id'];
                $database->updateVente($venteId, $client_id, $id_produit, $description, $prix, $date_vente);
            } else {
                // Otherwise, insert new vente data
                $database->insertVente($client_id, $id_produit, $description, $prix, $date_vente);
            }

            // Redirect to a success page or do something else
            header("Location: ventes_table.php");
            exit();
        } catch (PDOException $e) {
            $error_message = "Failed to insert vente data: " . $e->getMessage();
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
        <!-- plugins:css -->
        <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
        <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="assets/images/logo1.png" />
    </head>
    <body>
    <?php include 'sidebar.php'; ?>
    <div class="col-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

            <h2 class=" text-center h1 text-primary">Ventes</h2>
                <p class="h3 text-center fs-1"> Saissir Votre Ventes </p>
                            <!-- FORM -->
                <form class="forms-sample" method="POST" action="">
                    <!-- If vente ID is provided, add it as a hidden field -->
                    <?php if (!empty($vente)): ?>
                    <input type="hidden" name="vente_id" value="<?php echo $vente['id']; ?>">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="client_id">Client</label>
                        <select class="form-control" id="client_id" name="client_id">
                        <?php foreach ($clients as $client): ?>
        <option value="<?php echo $client['id']; ?>" <?php if (!empty($vente) && $vente['client_id'] == $client['id']) echo "selected"; ?>>
            <?php echo $client['id'] . ' - ' . (isset($client['name']) ? $client['name'] : 'Unknown'); ?>
        </option>
    <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="form-group">
        <label for="id_produit">Produit</label>
        <select class="form-control" id="id_produit" name="id_produit">
            <?php foreach ($products as $product): ?>
                <option value="<?php echo $product['id']; ?>" <?php if (!empty($vente) && $vente['id_produit'] == $product['id']) echo "selected"; ?>>
                    <?php 
                    echo $product['id'] . ' - ' . $product['categorie'];
                    // Check if 'Periode' key exists and is not empty
                    if (array_key_exists('Periode', $product)) {
                        echo isset($product['Periode']) ? ' (' . $product['Periode'] . ')' : '';
                    }
                    ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>


                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php if (!empty($vente)) echo $vente['description']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" class="form-control" id="prix" name="prix" placeholder="Prix" value="<?php if (!empty($vente)) echo $vente['prix']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="date_vente">Date de Vente</label>
                        <input type="date" class="form-control" id="date_vente" name="date_vente" placeholder="Date de Vente" value="<?php if (!empty($vente)) echo $vente['date_vente']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/file-upload.js"></script>
    <script src="assets/js/typeahead.js"></script>
    <script src="assets/js/select2.js"></script>
    <!-- End custom js for this page -->
    </body>
    </html>
