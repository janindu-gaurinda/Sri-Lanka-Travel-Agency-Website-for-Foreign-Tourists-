<?php
require_once 'config/config.php';

class Pakage
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }


    // }=========================================================

    public function insertpkg($img, $title, $duration, $price, $short_description)
    {
        $user = $_SESSION['user']['id'];
        $status = "active";

        $stmt = $this->pdo->prepare("
    INSERT INTO packages (title, duration, price, short_description, image_path, status, created_at)
    VALUES (:title, :duration, :price, :short_description, :image_path,  :status, NOW())
");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':short_description', $short_description);
        $stmt->bindParam(':image_path', $img);  // Now this matches the placeholder!
        $stmt->bindParam(':status', $status);
        $stmt->execute();
    }
    // ===================================================
    public function getAll_pkg()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM packages ORDER BY `title` DESC"); // Adjust table name
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // ===================================================
    // Get limited packages (pagination)
    public function get_pkg_paginated($limit, $offset)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM packages where status= 'active' ORDER BY package_id DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===================================================
    // Count all packages
    public function count_pkgs()
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM packages");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // ===================================================
    public function getAll_pkg_top3()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM packages where status= 'active' ORDER BY package_id DESC LIMIT 3"); // Adjust table name
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // ===================================================
    public function update_pkg($id, $img, $title, $duration, $price, $short_description, $status)
    {
        $stmt = $this->pdo->prepare("
        UPDATE packages 
        SET title = :title,
            duration = :duration,
            price = :price,
            short_description = :short_description,
            status = :status,
            image_path = :image_path,
            updated_at = NOW()
        WHERE package_id = :id
    ");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':short_description', $short_description);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':image_path', $img);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // ===================================================
    public function deletepkg($package_id)
    {
        // First, get the file name so we can delete it from the server
        $stmt = $this->pdo->prepare("SELECT image_path FROM packages WHERE package_id = :package_id");
        $stmt->bindParam(':package_id', $package_id, PDO::PARAM_INT);
        $stmt->execute();
        $image = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($image) {
            $filePath = 'public/img/pkgz/' . $image['image_path'];
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }

            // Now delete from database
            $stmt = $this->pdo->prepare("DELETE FROM packages WHERE package_id = :package_id");
            $stmt->bindParam(':package_id', $package_id, PDO::PARAM_INT);
            return $stmt->execute();
        }

        return false; // Image not found
    }
}
