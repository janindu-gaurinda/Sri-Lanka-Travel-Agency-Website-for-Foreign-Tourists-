<?php
require_once 'config/config.php';

class User
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    // ===================================================
    public function get_user()
    {
        $user = $_SESSION['user']['id'];
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // single row
    }

    // ===================================================
    public function update_profile_pic($imgName, $user_id)
    {
        $stmt = $this->pdo->prepare("
        UPDATE users 
        SET profile_pic = :profile_pic
        WHERE user_id = :user_id
    ");
        $stmt->bindParam(':profile_pic', $imgName);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }
    // ===================================================
   public function deletepropic($user_id)
{
    // First, get the current file name from DB
    $stmt = $this->pdo->prepare("SELECT profile_pic FROM users WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($image) {
        $filePath = 'public/img/user/' . $image['profile_pic'];

        // Delete only if it's not the default image
        if (file_exists($filePath) && $image['profile_pic'] !== 'useer.png') {
            unlink($filePath);
        }

        // Set profile_pic field to default image name
        $defaultImage = 'useer.png';
        $stmt = $this->pdo->prepare("
            UPDATE users 
            SET profile_pic = :profile_pic
            WHERE user_id = :user_id
        ");
        $stmt->bindParam(':profile_pic', $defaultImage);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Update session value if needed
        if (isset($_SESSION['user']) && $_SESSION['user']['user_id'] == $user_id) {
            $_SESSION['user']['profile_pic'] = $defaultImage;
        }

        return true; // ✅ success
    }

    return false; // ❌ image not found or user not found
}


    // ===================================================
   public function update_user($user_id, $full_name, $email, $phone)
{
    $stmt = $this->pdo->prepare("
        UPDATE users 
        SET full_name = :full_name,
            email = :email,
            phone = :phone,
            updated_at = NOW()
        WHERE user_id = :user_id
    ");
    $stmt->bindParam(':full_name', $full_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':user_id', $user_id);

    return $stmt->execute(); // ✅ return true/false
}

    // ===================================================
    public function update_user_password($user_id, $hashedPassword)
    {
        $stmt = $this->pdo->prepare("
        UPDATE users 
        SET password = :password,
            updated_at = NOW()
        WHERE user_id = :user_id
    ");
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }
    // ===================================================


}
