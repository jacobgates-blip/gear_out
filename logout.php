<?php
// Start session
session_start();

// Delete session
session_unset();
session_destroy();

// Redirect user back to home page
header('Location: index.php');

// Stop script from running
exit();
