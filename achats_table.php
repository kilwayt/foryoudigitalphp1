<?php
// Include the database connection file
require_once 'database.php';

// Create a new instance of the Database class
$database = new Database();

// Fetch achat data from the database
$achats = $database->getAllAchats();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Achats List</title>
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
            <h4 class=" text-center text-primary">Achats List</h4>
            <p class=" text-center">List of Achats</p>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="bg-primary">
                        <th>ID</th>
                        <th>Fournisseur</th>
                        <th>Produit</th>
                        <th>Date d'Achat</th>
                        <th>Option</th>
                        <th>VISITE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($achats as $achat): ?>
                        <tr>
                            <td><?php echo $achat['id']; ?></td>
                            <td><?php echo $achat['name_fournisseur']; ?></td>
                            <td><?php echo $achat['categorie'] . ' (' . $achat['Periode'] . ')'; ?></td>
                            <td><?php echo $achat['date_achat']; ?></td>
                            <td>
                                <!-- Update button -->
                                <a href="achats_form.php?achat_id=<?php echo $achat['id']; ?>"> 
                                    <button class="btn btn-warning btn-sm">
                                        <i class="mdi mdi mdi-border-color text-black menu-icon"></i>
                                    </button>
                                </a>
                                <!-- Delete button -->
                                <button class="btn btn-danger btn-sm" onclick="deleteAchat(<?php echo $achat['id']; ?>)">
                                    <i class="mdi mdi mdi-popcorn black menu-icon"></i>
                                </button>
                            </td>
                            <td><a href="#">
    <button type="button" class="btn btn-success">FOURNISEUR LINK</button>
    </a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>
            
    </div>
    <div class="d-flex justify-content-center align-items-center" > <a href="achats_form.php">
    <button type="button" class="btn btn-success">AJOUTER UNE ACHATS </button>
    </a>
    </div>
        </div>
        
    </div>
    
</div>

<!-- JavaScript -->
<!-- JavaScript -->
<!-- JavaScript -->
<script>
    function deleteAchat(achatId) {
        if (confirm("Are you sure you want to delete this achat?")) {
            window.location.href = "delete_column.php?achat_id=" + achatId;
        }
    }
</script>




<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
</body>
</html>
