<?php
session_start();
session_unset();
session_destroy();

// redirect to main index (adjust folder name if needed)
header("Location: index.php");
exit();
