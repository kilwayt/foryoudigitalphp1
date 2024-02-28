<?php
require_once 'database.php';

$error_message = "";
$name = $link = $email = $phone = $platform = "";

// Check if client ID is provided in the URL for updating
if (isset($_GET['client_id']) && !empty($_GET['client_id'])) {
    $client_id = $_GET['client_id'];

    // Fetch client data from the database based on the client ID
    $database = new Database();
    $client = $database->getClientById($client_id);

    // Check if client data is retrieved successfully
    if ($client) {
        // Assign client data to variables
        $name = $client['name'];
        $link = $client['link'];
        $email = $client['email'];
        $phone = $client['phone'];
        $platform = $client['id_platform'];
    } else {
        // Handle case where client data is not found
        echo "Error: Client not found.";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $link = $_POST["link"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $platform = $_POST["platform"];

    // Check if client ID is provided in the form data for updating
    if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {
        $client_id = $_POST['client_id'];

        // Update client data
        $database = new Database();
        try {
            $database->updateClient($client_id, $name, $link, $email, $phone, $platform);

            // Redirect to client list page
            header("Location: client_table.php");
            exit();
        } catch (PDOException $e) {
            $error_message = "Failed to update data: " . $e->getMessage();
        }
    } else {
        // Insert new client data
        $database = new Database();
        try {
            $database->insertClient($name, $link, $email, $phone, $platform);

            // Redirect to client list page
            header("Location: client_table.php");
            exit();
        } catch (PDOException $e) {
            $error_message = "Failed to insert data: " . $e->getMessage();
        }
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
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/logo1.png" />
</head>
<body>
<?php include 'sidebar.php'; ?>

<div class="col-10 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h2 class="text-center h1 text-primary">Clients</h2>
            <p class="h3 text-center fs-1">Saisir Les Clients</p>
            <!-- FORM -->
            <form class="forms-sample" method="POST" action="">
                <?php if (isset($client_id) && !empty($client_id)) : ?>
                    <!-- If client ID is provided, it's an update -->
                    <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
                <?php endif; ?>
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Name" value="<?php echo $name; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputLink">Link</label>
                    <input type="text" class="form-control" id="exampleInputLink" name="link" placeholder="Link" value="<?php echo $link; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail3" name="email" placeholder="Email" value="<?php echo $email; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPhone">Phone</label>
                    <input type="text" class="form-control" id="exampleInputPhone" name="phone" placeholder="Phone" value="<?php echo $phone; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleSelectPlatform">Platform</label>
                    <select class="form-control" id="exampleSelectPlatform" name="platform">
                        <option value="1" <?php echo ($platform == 1) ? 'selected' : ''; ?>>WhatsApp</option>
                        <option value="2" <?php echo ($platform == 2) ? 'selected' : ''; ?>>TikTok</option>
                        <option value="3" <?php echo ($platform == 3) ? 'selected' : ''; ?>>Facebook</option>
                        <option value="4" <?php echo ($platform == 4) ? 'selected' : ''; ?>>Instagram</option>
                        <option value="5" <?php echo ($platform == 5) ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="client_table.php" class="btn btn-light">Cancel</a>
                <?php if (!empty($error_message)) : ?>
                    <p class="text-danger mt-3"><?php echo $error_message; ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<!-- Custom scripts -->
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
</body>
</html>
