<?php
session_start();
$page_title = "Monitor login | Gear Out";
include('includes/header.php');
include('includes/nav.php');
?>
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h2 class="pt-5">Monitor login</h2>
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php if ($_GET['error'] === 'invalid_credentials'): ?>
                        Incorrect email or password.
                    <?php elseif ($_GET['error'] === 'empty_fields'): ?>
                        Please fill in both fields.
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <form action="includes/login_inc.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pwd" name="pwd">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="login_btn">Log in</button>
                </div>
            </form>
            <p class="text-muted">Demo account: monitor@school.nz / password123</p>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
