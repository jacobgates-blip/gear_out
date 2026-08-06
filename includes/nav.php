<!-- Start of Nav bar -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Gear Out</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="how_it_works.php">How it works</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_loans.php">Current loans</a>
                </li>
                <?php if (isset($_SESSION['id'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="control_panel.php">Control panel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Monitor login</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
