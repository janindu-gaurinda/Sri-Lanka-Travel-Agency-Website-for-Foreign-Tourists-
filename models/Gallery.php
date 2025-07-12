<?php
require_once 'config/config.php';

class Gallery
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }


    // }=========================================================

    public function insertImage($img, $title, $description)
    {
        $user = $_SESSION['user']['id'];
        $status = "active";

        $stmt = $this->pdo->prepare("
    INSERT INTO gallery (title, description, file_path, uploaded_by, status, created_at)
    VALUES (:title, :description, :file_path, :user_id, :status, NOW())
");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':file_path', $img);  // Now this matches the placeholder!
        $stmt->bindParam(':user_id', $user);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
    }
    // ===================================================
    public function getAll_Images()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM gallery ORDER BY `gallery`.`created_at` DESC"); // Adjust table name
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // ===================================================
    public function deleteImage($id)
{
    // First, get the file name so we can delete it from the server
    $stmt = $this->pdo->prepare("SELECT file_path FROM gallery WHERE gallery_id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($image) {
        $filePath = 'public/img/gallery/' . $image['file_path'];
        if (file_exists($filePath)) {
            unlink($filePath); // Delete the file
        }

        // Now delete from database
        $stmt = $this->pdo->prepare("DELETE FROM gallery WHERE gallery_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    return false; // Image not found
}

}
