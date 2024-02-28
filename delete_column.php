<?php
// Include the database connection file
require_once 'database.php';

// Check if client ID, achat ID, or vente ID is provided in the URL
if (isset($_GET['client_id']) && !empty($_GET['client_id'])) {
    // Get the client ID from the URL parameter
    $clientId = $_GET['client_id'];

    // Create a new instance of the Database class
    $database = new Database();

    // Call the method to delete the client by ID
    $database->deleteClientById($clientId);

    // Redirect back to the client list page
    header("Location: client_table.php");
    exit();
} elseif (isset($_GET['achat_id']) && !empty($_GET['achat_id'])) {
    // Get the achat ID from the URL parameter
    $achatId = $_GET['achat_id'];

    // Create a new instance of the Database class
    $database = new Database();

    // Call the method to delete the achat by ID
    $database->deleteAchatById($achatId);

    // Redirect back to the achats list page
    header("Location: achats_table.php");
    exit();
} elseif (isset($_GET['vente_id']) && !empty($_GET['vente_id'])) {
    // Get the vente ID from the URL parameter
    $venteId = $_GET['vente_id'];

    // Create a new instance of the Database class
    $database = new Database();

    // Call the method to delete the vente by ID
    $database->deleteVenteById($venteId);

    // Redirect back to the ventes list page
    header("Location: ventes_table.php");
    exit();
} elseif (isset($_GET['fournisseur_id'])) {
    // Get fournisseur ID from the query parameters
    $fournisseurId = $_GET['fournisseur_id'];

    // Instantiate the Database class
    $database = new Database();

    try {
        // Delete the fournisseur from the database
        $database->deleteFournisseur($fournisseurId);

        // Redirect back to the fournisseur table page
        header("Location: fournisseur_table.php");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    } }elseif (isset($_GET['product_id'])) {
        // Get the product ID from the URL
        $productId = $_GET['product_id'];
    
        // Create a new instance of the Database class
        $database = new Database();
    
        try {
            // Delete the product with the specified ID
            $database->deleteProduit($productId);
    
            // Redirect back to the product list page
            header("Location: produit_table.php");
            exit();
        } catch (PDOException $e) {
            // Handle any errors that occur during deletion
            echo "Failed to delete product: " . $e->getMessage();}
        } else {
    // If product ID is not provided in the URL, show an error message
    echo "Product ID not provided";
}


?>
