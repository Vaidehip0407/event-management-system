<?php

// Function to sanitize user input
function sanitize($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

// Function to display a success message
function displaySuccessMessage($message) {
    return "<div class='message success'>" . htmlspecialchars($message) . "</div>";
}

// Function to display an error message
function displayErrorMessage($message) {
    return "<div class='message error'>" . htmlspecialchars($message) . "</div>";
}

// Function to check if a user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}

// Function to redirect to a specific page
function redirectTo($page) {
    header("Location: " . $page);
    exit();
}
?>