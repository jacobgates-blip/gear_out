<?php
session_start();
require('includes/auth_check.php');
require('includes/conn_1dt.php');

// The uploaded admin_delete.php built its query as
// "DELETE FROM admin_tbl WHERE id = $admin_id" — mysqli_real_escape_string()
// on $admin_id doesn't actually protect an unquoted numeric value dropped
// straight into the SQL string. Casting to (int) and using a bound
// parameter here closes that off properly.
$id = (int) ($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM loans WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: manage_loans.php?deleted=1');
exit;
