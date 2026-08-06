<?php
session_start();
require('includes/auth_check.php');

$page_title = "Log a loan | Gear Out";

// If save_loan.php redirected back here with errors, read them once.
$errors = $_SESSION['borrow_errors'] ?? [];
$old    = $_SESSION['borrow_old'] ?? [];
unset($_SESSION['borrow_errors'], $_SESSION['borrow_old']);

include('includes/header.php');
include('includes/nav.php');
?>
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h2 class="pt-5">Log a loan</h2>

            <?php if ($errors): ?>
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <form action="save_loan.php" method="POST">
                <div class="mb-3">
                    <label for="item_name" class="form-label">Item</label>
                    <input type="text" class="form-control" id="item_name" name="item_name"
                           value="<?= htmlspecialchars($old['item_name'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label for="borrower_name" class="form-label">Borrower</label>
                    <input type="text" class="form-control" id="borrower_name" name="borrower_name"
                           value="<?= htmlspecialchars($old['borrower_name'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label for="due_back" class="form-label">Due back</label>
                    <input type="date" class="form-control" id="due_back" name="due_back"
                           value="<?= htmlspecialchars($old['due_back'] ?? '') ?>">
                </div>
                <button type="submit" class="btn btn-primary">Log loan</button>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
