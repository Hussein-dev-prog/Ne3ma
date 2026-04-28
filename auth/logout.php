<?php
session_start();
session_unset();
session_destroy();

header("Location: /ne3ma/index.php");
exit();
?>