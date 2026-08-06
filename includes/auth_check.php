<?php
// Include at the top of any page — after session_start() — that only a
// signed-in monitor should be able to reach. None of the equivalent pages
// in the uploaded template (admin_list.php, admin_update.php, admin_delete.php)
// actually checked this, so this file exists to make the check
// impossible to forget: one include instead of one copy-pasted `if`.
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}
