<?php
session_start(); // Start the session

// Destroy all session variables to log the user out
session_unset(); 

// Destroy the session
session_destroy(); 

// Clear session cookie (if session cookies are used)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}


// Redirect to index.php and refresh the page
header("Location: index.php"); 
exit(); // Ensure no further code is executed after redirection
?>
