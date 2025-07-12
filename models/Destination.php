<?php
require_once 'config/config.php';
// session_start();
class Destination
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }


    // }=========================================================

    public function insert_desti($imgName, $name, $tagline)
    {
        $user = $_SESSION['user']['user_id'];
        $status = "active";

        $stmt = $this->pdo->prepare("
        INSERT INTO destinations (name, image_path, tagline, status, entered_by, created_at)
        VALUES (:name, :image_path, :tagline, :status, :entered_by, NOW())
    ");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image_path', $imgName);
        $stmt->bindParam(':tagline', $tagline);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':entered_by', $user);
        $stmt->execute();
    }

    // ===================================================
    public function getAll_desti()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM destinations ORDER BY `destination_id` DESC"); // Adjust table name
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // ===================================================
    // Get limited packages (pagination)
    public function get_dest_paginated($limit, $offset)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM destinations where status= 'active' ORDER BY destination_id DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===================================================
    // Count all packages
    public function destinations_count()
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM destinations");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // ===================================================
    public function getAll_dest_top3()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM destinations where status= 'active' ORDER BY destination_id DESC LIMIT 3"); // Adjust table name
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // ===================================================
    public function update_dest($destination_id, $img, $name, $tagline,  $status)
    {
        $stmt = $this->pdo->prepare("
        UPDATE destinations 
        SET name = :name,
            image_path = :image_path,
            tagline = :tagline,
            status = :status,
            updated_at = NOW()
        WHERE destination_id = :destination_id
    ");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':tagline', $tagline);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':image_path', $img);
        $stmt->bindParam(':destination_id', $destination_id);
        $stmt->execute();
    }

    // ===================================================
    public function deletedest($destination_id)
    {
        // First, get the file name so we can delete it from the server
        $stmt = $this->pdo->prepare("SELECT image_path FROM destinations WHERE destination_id = :destination_id");
        $stmt->bindParam(':destination_id', $destination_id, PDO::PARAM_INT);
        $stmt->execute();
        $image = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($image) {
            $filePath = 'public/img/destinations/' . $image['image_path'];
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }

            // Now delete from database
            $stmt = $this->pdo->prepare("DELETE FROM destinations WHERE destination_id = :destination_id");
            $stmt->bindParam(':destination_id', $destination_id, PDO::PARAM_INT);
            return $stmt->execute();
        }

        return false; // Image not found
    }
}
