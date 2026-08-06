<?php
// Start session
session_start();

// Protect page from unauthorized access
require('includes/auth_check.php');

// Declare page title variable
$page_title = "Control panel | Gear Out";

// Call header and navigation files
include('includes/header.php');
include('includes/nav.php');
?>
<p class="text-end me-5 mt-2 fs-4">Signed in: <?php echo htmlspecialchars($_SESSION['firstname'] . ' ' . $_SESSION['lastname']); ?></p>

<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            <h2 class="pb-4">Welcome back, <?php echo htmlspecialchars($_SESSION['firstname']); ?></h2>
            <a href="borrow.php"><button class="btn btn-danger btn-lg m-2">Log a new loan</button></a>
            <a href="manage_loans.php"><button class="btn btn-primary btn-lg m-2">Manage loans</button></a>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>

<?php
// Call footer
include('includes/footer.php');
?>
