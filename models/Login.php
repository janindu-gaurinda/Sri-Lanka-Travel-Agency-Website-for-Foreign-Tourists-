<?php
require_once 'config/config.php';

class Login
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }
    // }=========================================================
    public function checkUserExists($email)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    // }=========================================================

    public function sign_in($full_name, $email, $password)
    {
        $user_type = "user";
        $status     = "active";
        $profile_pic     = "useer.png";
        $stmt = $this->pdo->prepare("INSERT INTO users (full_name, email, password, user_type, profile_pic, status, created_at) VALUES (:full_name, :email, :password, :user_type, :profile_pic, :status, NOW())");
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':user_type', $user_type);
        $stmt->bindParam(':profile_pic', $profile_pic);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
    }
    // }=========================================================
    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // returns associative array or false
    }
}
