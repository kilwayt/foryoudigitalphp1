<?php
require_once 'database.php';

// Fetch fournisseur data from the database
$database = new Database();
$fournisseurs = $database->getAllFournisseurs();

// Check if the form is submitted for updating fournisseur
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Get fournisseur ID and other information from the form
    $id = $_POST['id'];
    $name_fournisseur = $_POST['name_fournisseur'];
    $link_fournisseur = $_POST['link_fournisseur'];

    // Update the fournisseur information in the database
    $database->updateFournisseur($id, $name_fournisseur, $link_fournisseur);
    
    // Redirect to the page where you display the fournisseur table
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
    <title>Fournisseurs List</title>
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
            <h4 class=" text-center text-primary">Fournisseurs List</h4>
            <p class=" text-center">List of Fournisseurs</p>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="bg-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Link</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fournisseurs as $fournisseur): ?>
                        <tr>
                            <td><?php echo $fournisseur['id']; ?></td>
                            <td><?php echo $fournisseur['name_fournisseur']; ?></td>
                            <td><?php echo isset($fournisseur['link_fournisseur']) ? $fournisseur['link_fournisseur'] : ''; ?></td>
                            <td>
                                <!-- Update button -->
                                <a href="fournisseur_form.php?fournisseur_id=<?php echo $fournisseur['id']; ?>"> 
                                    <button class="btn btn-warning btn-sm">Update</button>
                                </a>
                                <!-- Delete button -->
                                <button class="btn btn-danger btn-sm" onclick="deleteFournisseur(<?php echo $fournisseur['id']; ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-center align-items-center">
            <a href="fournisseur_form.php">
                <button type="button" class="btn btn-success">Add fournisseur</button>
            </a>
        </div>
        </div>
        
    </div>
</div>

<!-- Your deleteFournisseur function goes here -->

</body>
</html>
