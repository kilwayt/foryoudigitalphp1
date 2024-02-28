        <?php
        // Include the database connection file
        require_once 'database.php';

        // Create a new instance of the Database class
        $database = new Database();

        // Fetch client data from the database
        $clients = $database->getAllClients();

        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>Client List</title>
            <!-- CSS styles -->
            <link rel="stylesheet" href="assets/css/style.css">
            <!-- End layout styles -->
            <link rel="shortcut icon" href="assets/images/favicon.png" />
        </head>
        <body>
        <?php include 'sidebar.php'; ?>
        <style>
            /* Custom CSS for green border */
            .table-bordered tbody tr {
                border: 2px solid #28a745; /* Green color */
            }
        </style>

        <div class="col-lg-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class=" text-center text-success">Client List</h4>
                    <p class=" text-center">List of Clients</p>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="bg-success">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Link</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Platform</th>
                                <th>Actions</th> <!-- New column for buttons -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clients as $client): ?>
                                <tr>
                                    <td><?php echo $client['id']; ?></td>
                                    <td><?php echo $client['name']; ?></td>
                                    <td><?php echo $client['link']; ?></td>
                                    <td><?php echo $client['email']; ?></td>
                                    <td><?php echo $client['phone']; ?></td>
                                    <td><?php echo isset($client['platform_name']) ? $client['platform_name'] : ''; ?></td>
                                    <td>
                                        <!-- Update button -->
    <!-- Update button -->
    <a href="ventes_form.php?vente_id=<?php echo $vente['id']; ?>"> 
        <button class="btn btn-warning btn-sm">
            <i class="mdi mdi mdi-border-color text-black menu-icon"></i>
        </button>
    </a>
                                        <!-- Delete button -->
                                        <button class="btn btn-danger btn-sm" onclick="deleteClient(<?php echo $client['id']; ?>)">
                                            <i class="mdi mdi mdi-popcorn black menu-icon"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        </div>
        <div class="d-flex justify-content-center align-items-center" > <a href="client_form.php">
        <button type="button" class="btn btn-success">AJOUTER UN CLIENT</button>
        </a>
        </div>       
        </div>
            
        </div>


        <!-- JavaScript -->
        <script>
            function deleteClient(clientId) {
                if (confirm("Are you sure you want to delete this client?")) {
                    window.location.href = "delete_column.php?client_id=" + clientId;
                }
            }
        </script>

        <script src="assets/js/off-canvas.js"></script>
        <script src="assets/js/hoverable-collapse.js"></script>
        <script src="assets/js/misc.js"></script>
        </body>
        </html>
