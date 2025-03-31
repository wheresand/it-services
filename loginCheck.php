<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php'; // Fixed path

use App\class\Users;

session_start(); // Start session

// Validate CSRF Token
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
    $_SESSION['error'] = 'Invalid session. Please try again.';
    header("Location: login");
    exit();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $recaptchaResponse = $_POST['g-recaptcha-response'] ?? ''; // reCAPTCHA response

    // Validate input fields
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Username and password are required.';
        header("Location: login");
        exit();
    }

    // Verify reCAPTCHA v2
    $recaptchaSecret = '6LdRhAUrAAAAACKYCnVNU8oxWP-1mGP5ZmR754hD'; // Replace with your actual secret key
    $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';

    $response = file_get_contents("$recaptchaUrl?secret=$recaptchaSecret&response=$recaptchaResponse");
    if (!$response) {
        $_SESSION['error'] = 'Error contacting reCAPTCHA server.';
        header("Location: login");
        exit();
    }

    $recaptchaResponseKeys = json_decode($response, true);
    
    if (!$recaptchaResponseKeys['success']) { // For reCAPTCHA v2, just check 'success'
        $_SESSION['error'] = 'reCAPTCHA verification failed. Please try again.';
        header("Location: login");
        exit();
    }

    // Proceed with login check
    $result = Users::userCheck($username, $password);

    if ($result['status'] === 'success') {
        // Store user data in session
        $_SESSION['user'] = $result['user_data'];

        // Redirect to dashboard
        header("Location: dashBoard");
        exit();
    } else {
        $_SESSION['error'] = 'Invalid username or password.';
        header("Location: login");
        exit();
    }
}
