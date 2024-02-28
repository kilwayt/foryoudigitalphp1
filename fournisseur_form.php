<?php
require_once 'database.php';

// Create a new instance of the Database class
$database = new Database();

// Initialize $fournisseur variable
$fournisseur = [];

// Check if fournisseur ID is provided in the URL
if (isset($_GET['fournisseur_id'])) {
    $fournisseurId = $_GET['fournisseur_id'];
    // Fetch fournisseur information by ID
    $fournisseur = $database->getFournisseurById($fournisseurId);
    if (!$fournisseur) {
        // Fournisseur with the provided ID not found, redirect or show error message
        // You can redirect or display an error message here
    }
} else {
    // Fournisseur ID not provided, initialize empty fournisseur array
    $fournisseur = ['name_fournisseur' => '', 'link_fournisseur' => ''];
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission to update or insert fournisseur information
    $id = $_POST['id'];
    $name_fournisseur = $_POST['name_fournisseur'];
    $link_fournisseur = $_POST['link_fournisseur'];

    if ($id) {
        // Update existing fournisseur
        $database->updateFournisseur($id, $name_fournisseur, $link_fournisseur);
    } else {
        // Insert new fournisseur
        $database->insertFournisseur($name_fournisseur, $link_fournisseur);
    }
    
    // Redirect to the fournisseur table page
    header("Location: fournisseur_table.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fournisseur Form</title>
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
            <h4 class=" text-center text-primary">Fournisseur Form</h4>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo isset($fournisseur['id']) ? $fournisseur['id'] : ''; ?>">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" class="form-control" name="name_fournisseur" value="<?php echo isset($fournisseur['name_fournisseur']) ? $fournisseur['name_fournisseur'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Link:</label>
                    <input type="text" class="form-control" name="link_fournisseur" value="<?php echo isset($fournisseur['link_fournisseur']) ? $fournisseur['link_fournisseur'] : ''; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
