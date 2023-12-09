<?php
    include('login.php');
    // Clear session data
    $_SESSION = [];

    // Clean session ID
    session_destroy();

    header('Location: login.php');
    exit();

?>