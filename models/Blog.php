<?php
require_once 'config/config.php';

class Blog
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }
    // ===================================================
    public function getAll_blog()
    {
        //         SELECT blogs.*, users.full_name
        // FROM blogs
        // INNER JOIN users ON blogs.submitted_by=users.user_id;
        // $stmt = $this->pdo->prepare("SELECT * FROM blogs ORDER BY `title` DESC"); // Adjust table name
        $stmt = $this->pdo->prepare("SELECT blogs.*, users.full_name FROM blogs INNER JOIN users ON blogs.submitted_by=users.user_id where blogs.status != 'pending'"); // Adjust table name
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // }=========================================================
    // Get limited packages (pagination)
    public function get_blogs_paginated($limit, $offset)
    {
        //SELECT blogs.*, users.full_name, users.profile_pic
        // FROM blogs
        // INNER JOIN users ON blogs.submitted_by=users.user_id;
        // $stmt = $this->pdo->prepare("SELECT * FROM blogs where status= 'active' ORDER BY blog_id DESC LIMIT :limit OFFSET :offset");
        $stmt = $this->pdo->prepare("SELECT blogs.*, users.full_name, users.profile_pic
        FROM blogs
        INNER JOIN users ON blogs.submitted_by=users.user_id where blogs.status= 'active' ORDER BY blog_id DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===================================================
    // Count all packages
    public function count_blogs()
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM blogs");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // }=========================================================
    public function getAll_blog_top3()
    {
        $stmt = $this->pdo->prepare("SELECT blogs.*, users.full_name, users.profile_pic
        FROM blogs
        INNER JOIN users ON blogs.submitted_by=users.user_id where blogs.status= 'active' ORDER BY blog_id DESC LIMIT 3"); // Adjust table name
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // }=========================================================
    public function getAll_pending_blogs()
    {
        $stmt = $this->pdo->prepare("SELECT blogs.*, users.full_name, users.profile_pic
        FROM blogs
        INNER JOIN users ON blogs.submitted_by=users.user_id where blogs.status= 'pending' ORDER BY blog_id DESC"); // Adjust table name
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // }=========================================================
    public function getAll_user_blogs()
    {
        $user = $_SESSION['user']['id'];

        $stmt = $this->pdo->prepare("SELECT blogs.*, users.full_name, users.profile_pic
        FROM blogs
        INNER JOIN users ON blogs.submitted_by=users.user_id where blogs.submitted_by = :user_id ORDER BY blog_id DESC"); // Adjust table name
        $stmt->bindParam(':user_id', $user);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // }=========================================================


    public function insert_blog($imgName, $title, $excerpt, $content)
    {
        $user = $_SESSION['user']['id'];
        $status = "active";

        $stmt = $this->pdo->prepare("
    INSERT INTO blogs (title, excerpt, thumbnail, content, submitted_by, status, created_at)
    VALUES (:title, :excerpt, :thumbnail, :content, :submitted_by,  :status, NOW())
");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':excerpt', $excerpt);
        $stmt->bindParam(':thumbnail', $imgName);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':submitted_by', $user);  // Now this matches the placeholder!
        $stmt->bindParam(':status', $status);
        $stmt->execute();
    }
    // ===================================================
    public function update_blog($blog_id, $imgName, $title, $excerpt, $content, $status)
    {
        $stmt = $this->pdo->prepare("
        UPDATE blogs 
        SET title = :title,
            excerpt = :excerpt,
            thumbnail = :thumbnail,
            content = :content,
            status = :status,
            updated_at = NOW()
        WHERE blog_id = :blog_id
    ");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':excerpt', $excerpt);
        $stmt->bindParam(':thumbnail', $imgName);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':blog_id', $blog_id);
        $stmt->execute();
    }
    // ===================================================
    public function delete_blog($blog_id)
    {
        // First, get the file name so we can delete it from the server
        $stmt = $this->pdo->prepare("SELECT thumbnail FROM blogs WHERE blog_id = :blog_id");
        $stmt->bindParam(':blog_id', $blog_id, PDO::PARAM_INT);
        $stmt->execute();
        $image = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($image) {
            $filePath = 'public/img/blog/' . $image['thumbnail'];
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }

            // Now delete from database
            $stmt = $this->pdo->prepare("DELETE FROM blogs WHERE blog_id = :blog_id");
            $stmt->bindParam(':blog_id', $blog_id, PDO::PARAM_INT);
            return $stmt->execute();
        }

        return false; // Image not found
    }
    // ===================================================
    public function get_blog_by_id($blog_id)
    {
        $stmt = $this->pdo->prepare("SELECT blogs.*, users.full_name, users.profile_pic
        FROM blogs
        INNER JOIN users ON blogs.submitted_by=users.user_id WHERE blog_id = :blog_id AND blogs.status = 'active'");
        $stmt->bindValue(':blog_id', $blog_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ===================================================
    public function write_insert_blog($imgName, $title, $excerpt, $content)
    {
        $user = $_SESSION['user']['id'];
        $status = "pending";

        $stmt = $this->pdo->prepare("
    INSERT INTO blogs (title, excerpt, thumbnail, content, submitted_by, status, created_at)
    VALUES (:title, :excerpt, :thumbnail, :content, :submitted_by,  :status, NOW())
");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':excerpt', $excerpt);
        $stmt->bindParam(':thumbnail', $imgName);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':submitted_by', $user);  // Now this matches the placeholder!
        $stmt->bindParam(':status', $status);
        $stmt->execute();
    }
    // ===================================================

}
