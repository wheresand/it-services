<?php

namespace App\class;

use PDO;
use PDOException;
use Exception;

class Users {
    const ROLE_USER = 2;
    const ROLE_ADMIN = 1;
    const ROLE_BLOCKED = 0;

    public static function userCheck($username, $password)
    {
        try {
            $db = Database::db(); // Connect to the database
    
            // Check if the user exists by username
            $stmt = $db->prepare("SELECT * FROM `users` WHERE `username` = :username");
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user_data) {
                // Verify password
                if (password_verify($password, $user_data['password'])) {
                    // Check if account is blocked
                    if ($user_data['role'] == self::ROLE_BLOCKED) {
                        return ['status' => 'error', 'message' => 'Your account is blocked!'];
                    }
    
                    // Return user data and login status
                    return [
                        'status' => 'success',
                        'message' => 'Login successful',
                        'user_data' => $user_data  // Return the full user data
                    ];
                } else {
                    return ['status' => 'error', 'message' => 'Invalid username or password'];
                }
            } else {
                return ['status' => 'error', 'message' => 'Invalid username or password'];
            }
        } catch (\Exception $e) {
            // Handle any exceptions
            error_log($e->getMessage());
            return ['status' => 'error', 'message' => 'An error occurred. Please try again later.'];
        }
    }
}