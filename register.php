
<?php
// Include the Database class
require_once 'database.php';

// Create an instance of the Database class
$db = new Database();

// Establish the database connection
$conn = $db->connect(); 

// Initialize error variable
$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username and password fields are not empty
    if (!empty($username) && !empty($password)) {
        // Check if the checkbox is checked
        if (isset($_POST['agree_terms']) && $_POST['agree_terms'] == 'on') {
            // Prepare and execute the query to insert data into the database
            $stmt = $conn->prepare("INSERT INTO login (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);

            // Execute the query
            if ($stmt->execute()) {
                // Registration successful
                echo "Registration successful!";
                header("Location: login.php"); // Redirect to index.php

            } else {
                // Registration failed
                $error = "Registration failed!";
            }
        } else {
            // Checkbox not checked, registration not allowed
            $error = "Please agree to the Terms & Conditions to register.";
        }
    } else {
        // Username or password fields are empty
        $error = "Please enter both username and password.";
    }
}
?>






<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign UP</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
   
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="style2.css">

    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/logo1.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
    <img src="assets/images/logo2.png" alt="Logo">
    <span >FOR U DIGITAL</span>
</div>
                <h4 class="text-center">New here?</h4>
                <h6 class="font-weight-light text-center">Signing up is easy. It only takes a few steps</h6>
                <form class="pt-3" method="post" action="register.php"> <!-- Change action attribute to point to register.php -->
    <div class="form-group">
    <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
    </div>
    <div class="form-group">
    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>">
    </div>
    <div class="mb-4">

    <div class="form-check">
    <label class="form-check-label text-muted">
        <input type="checkbox" class="form-check-input" name="agree_terms"> I agree to all Terms & Conditions
    </label>
    <?php if (!empty($error)) { ?>
    <div class="text-danger"><?php echo $error; ?></div>
<?php } ?>

</div>

    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
    </div>
    <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="login.php" class="text-primary">Login</a>
    </div>
</form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
   
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>