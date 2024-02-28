<?php
require_once 'database.php';

$error_message = ""; // Define an error message variable to handle exceptions

// Check if the product ID is provided for updating product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    // Extract data from POST request
    $product_id = $_POST['product_id'];
    $categorie = $_POST["categorie"];
    $periode = $_POST["periode"];
    $description = $_POST["description"];
    $prix = $_POST["prix"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    // Instantiate the Database class
    $database = new Database();

    try {
        // Update product data
        $database->updateProduct($product_id, $categorie, $periode, $description, $prix, $start_date, $end_date);
        // Redirect to the product table page
        header("Location: produit_table.php");
        exit();
    } catch (PDOException $e) {
        $error_message = "Failed to update product: " . $e->getMessage();
    }
} elseif (isset($_POST['update_fournisseur'])) {
    // Handling update for fournisseur
    $id = $_POST['id'];
    $name_fournisseur = $_POST['name_fournisseur'];
    $link_fournisseur = $_POST['link_fournisseur'];

    $db = new Database();
    $db->updateFournisseur($id, $name_fournisseur, $link_fournisseur);
    
    // Redirect to the page where you display the fournisseur table
    header("Location: fournisseur_table.php");
    exit();
} elseif (isset($_POST['client_id'])) {
    // Handling update for client
    $clientId = $_POST['client_id'];
    $name = $_POST['name'];
    $link = $_POST['link'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $platform = $_POST['platform'];

    // Instantiate the Database class
    $database = new Database();

    try {
        // Update client information in the database
        $database->updateClient($clientId, $name, $link, $email, $phone, $platform);

        // Redirect back to the client list page
        header("Location: client_table.php");
        exit();
    } catch (PDOException $e) {
        $error_message = "Failed to update client data: " . $e->getMessage();
    }
} elseif (isset($_POST['achat_id'])) {
    // Handling update for achat
    $achatId = $_POST["achat_id"];
    $fournisseurId = $_POST["fournisseur_id"];
    $produitId = $_POST["produit_id"];
    $dateAchat = $_POST["date_achat"];

    // Instantiate the Database class
    $database = new Database();

    try {
        // Update the achat data
        $database->updateAchat($achatId, $fournisseurId, $produitId, $dateAchat);

        // Redirect to the achats table page
        header("Location: achats_table.php");
        exit();
    } catch (PDOException $e) {
        $error_message = "Failed to update achat data: " . $e->getMessage();
    }
} else {
    $error_message = "Error: Invalid form submission.";
}

// Handle the case where form data is not provided or any other errors occur
if (!empty($error_message)) {
    echo $error_message;
}
?>
