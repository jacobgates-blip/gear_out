<?php
session_start();
// Declare variable
$page_title = "Gear Out | Home";
// Call files
include('includes/header.php');
include('includes/nav.php');
?>
<!-- Start of content 1 -->
<div class="container text-center pt-5">
    <div class="row align-items-start">
        <div class="col">
            <h1>Gear Out</h1>
            <p class="lead">Track lunchtime sports equipment — what's out, who has it, and when it's due back.</p>
        </div>
    </div>
</div>
<!-- Start of cards -->
<div class="container pt-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card text-center h-100">
                <div class="card-body d-flex flex-column">
                    <i class="fa-solid fa-circle-info fa-3x mb-3"></i>
                    <h5 class="card-title">How it works</h5>
                    <p class="card-text">Who Gear Out is for, and what problem it solves.</p>
                    <a class="mt-auto" href="how_it_works.php"><button type="button" class="btn btn-danger btn-lg">Learn more</button></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center h-100">
                <div class="card-body d-flex flex-column">
                    <i class="fa-solid fa-list-check fa-3x mb-3"></i>
                    <h5 class="card-title">Current loans</h5>
                    <p class="card-text">See what's borrowed right now, and what's overdue.</p>
                    <a class="mt-auto" href="view_loans.php"><button type="button" class="btn btn-danger btn-lg">View loans</button></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center h-100">
                <div class="card-body d-flex flex-column">
                    <i class="fa-solid fa-user-shield fa-3x mb-3"></i>
                    <h5 class="card-title"><?php echo isset($_SESSION['id']) ? 'Control panel' : 'Monitor login'; ?></h5>
                    <p class="card-text">Log a loan, or mark equipment as returned.</p>
                    <a class="mt-auto" href="<?php echo isset($_SESSION['id']) ? 'control_panel.php' : 'login.php'; ?>">
                        <button type="button" class="btn btn-danger btn-lg"><?php echo isset($_SESSION['id']) ? 'Open' : 'Log in'; ?></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Call footer
include('includes/footer.php');
?>
