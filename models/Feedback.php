<?php
require_once 'config/config.php';
// session_start();
class Feedback
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }


    // }=========================================================
    public function getAll_feedback()
    {
        $stmt = $this->pdo->prepare("SELECT feedback.*, users.user_id, users.full_name, users.profile_pic FROM feedback INNER JOIN users ON feedback.user_id = users.user_id ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // }=========================================================
    public function getAll_user_feedback()
    {
        $user = $_SESSION['user']['id'];
        $stmt = $this->pdo->prepare("SELECT feedback.*, users.* FROM feedback INNER JOIN users ON feedback.user_id = users.user_id WHERE feedback.user_id = :user_id");
        // $stmt = $this->pdo->prepare("SELECT feedback.*, users.* FROM feedback INNER JOIN users ON feedback.user_id = users.user_id");
        $stmt->bindParam(':user_id', $user, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // }=========================================================
    public function insert_feedback_($country, $review_text)
    {
        $user = $_SESSION['user']['id'];
        $status = "pending";

        $stmt = $this->pdo->prepare("
        INSERT INTO feedback (user_id, country, review_text, statusfeedback, created_at)
        VALUES (:user_id, :country, :review_text, :status,  NOW())
    ");
        $stmt->bindParam(':user_id', $user);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':review_text', $review_text);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
    }
    // }=========================================================

    public function update_feedback($feedback_id, $country, $review_text)
    {
        $status = "pending";
        $stmt = $this->pdo->prepare("
        UPDATE feedback 
        SET country = :country,
            review_text = :review_text,
            statusfeedback = :status,
            updated_at = NOW()
        WHERE feedback_id = :feedback_id
    ");
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':review_text', $review_text);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':feedback_id', $feedback_id);
        $stmt->execute();
    }
    // }=========================================================
    public function update_feedback_admin($feedback_id, $country, $review_text, $status)
    {
        // $status = "pending";
        $stmt = $this->pdo->prepare("
        UPDATE feedback 
        SET country = :country,
            review_text = :review_text,
            statusfeedback = :status,
            updated_at = NOW()
        WHERE feedback_id = :feedback_id
    ");
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':review_text', $review_text);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':feedback_id', $feedback_id);
        $stmt->execute();
    }
    // }=========================================================
    public function delete_feedback($feedback_id)
    {

        // Now delete from database
        $stmt = $this->pdo->prepare("DELETE FROM feedback WHERE feedback_id = :feedback_id");
        $stmt->bindParam(':feedback_id', $feedback_id, PDO::PARAM_INT);
        return $stmt->execute();


        // return false; // Image not found
    }
    // ===================================================
    public function getAll_feedbk_top3()
    {
        $stmt = $this->pdo->prepare("SELECT feedback.*, users.user_id, users.full_name, users.profile_pic
    FROM feedback
    INNER JOIN users ON feedback.user_id = users.user_id
    WHERE feedback.statusfeedback = 'active'
    ORDER BY feedback.feedback_id DESC
    LIMIT 3"); // Adjust table name
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // ===================================================
    // Get limited packages (pagination)
    public function get_fb_paginated($limit, $offset)
    {
        $stmt = $this->pdo->prepare("
    SELECT feedback.*, users.user_id, users.full_name, users.profile_pic
    FROM feedback
    INNER JOIN users ON feedback.user_id = users.user_id
    WHERE feedback.statusfeedback = 'active'
    ORDER BY feedback.feedback_id DESC
    LIMIT :limit OFFSET :offset
");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // ===================================================
    // Count all packages
    public function count_fb()
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM feedback where statusfeedback= 'active'");
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    // ===================================================

}
