<?php
require_once 'models/Feedback.php';  // Example model

class FeedbackController
{
    public function index()
    {
         $feedback_Model = new Feedback();

        $limit = 6; // Packages per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit;

        $Get_fb = $feedback_Model->get_fb_paginated($limit, $offset);
        $totalfb = $feedback_Model->count_fb();
        $totalPages = ceil($totalfb / $limit);

        
        require_once 'views/header.php';
        require_once 'views/feedback/feedback.php';
        require_once 'views/footer.php';
    }
    // ========================================================================
    public function write_feedback()
    {
        require_once 'views/header.php';
        require_once 'views/feedback/write_feedback.php';
        require_once 'views/js.php';
    }
    // =======================================================================
    public function user_feedback()
    {
        $feedback_Model = new Feedback();
        $Get_myfeedback = $feedback_Model->getAll_user_feedback();
        require_once 'views/css.php';
        require_once 'views/feedback/my_feedback.php';
        require_once 'views/js.php';
    }
    // =======================================================================
     public function curd_feedback()
    {
        $feedback_Model = new Feedback();
        $Get_feedback = $feedback_Model->getAll_feedback();
        // =================================================
        require_once 'views/css.php';
        require_once 'views/feedback/Crud_feedback.php';
        require_once 'views/js.php';
    }
    // =======================================================================
    public function insert_feedback()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $country = trim($_POST['country'] ?? '');
        $review_text = trim($_POST['review_text'] ?? '');
        $errors = [];


        if (!$country) $errors[] = "country is required.";
        if (!$review_text) $errors[] = "review_text is required.";

        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: index.php?controller=Feedback&action=write_feedback');
            exit;
        }

        // Save to DB
        $Insert_feedback_Model = new Feedback();
        $Insert_feedback_Model->insert_feedback_($country, $review_text);

        $_SESSION['success'] = "Feedback added successfully!";
        header('Location: index.php?controller=Feedback&action=write_feedback');
        exit;
    }
    // =======================================================================
    public function update_feedback()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $feedback_id = intval($_POST['feedback_id'] ?? 0);
        $country = trim($_POST['country'] ?? '');
        $review_text = trim($_POST['review_text'] ?? '');
        $link = $_POST['link'] ?? '';

        $errors = [];
        if (!$feedback_id) $errors[] = "Invalid feedback ID.";
        if (!$country) $errors[] = "country is required.";
        if (!$review_text) $errors[] = "review_text is required.";

        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: index.php?controller=Feedback&action=' . $link);
            exit;
        }

        // Save to DB
        $Update_feedback_Model = new Feedback();
        $Update_feedback_Model->update_feedback($feedback_id, $country, $review_text);

        $_SESSION['success'] = "Feedback updated successfully!";
        header('Location: index.php?controller=Feedback&action=' . $link);
        exit;
    }

    // =======================================================================
    public function update_feedback_admin()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $feedback_id = intval($_POST['feedback_id'] ?? 0);
        $country = trim($_POST['country'] ?? '');
        $review_text = trim($_POST['review_text'] ?? '');
        $status = trim($_POST['status'] ?? '');
        $link = $_POST['link'] ?? '';

        $errors = [];
        if (!$feedback_id) $errors[] = "Invalid feedback ID.";
        if (!$country) $errors[] = "country is required.";
        if (!$review_text) $errors[] = "review_text is required.";
        if (!$status) $errors[] = "status is required.";

        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: index.php?controller=Feedback&action=' . $link);
            exit;
        }

        // Save to DB
        $Update_feedback_Model = new Feedback();
        $Update_feedback_Model->update_feedback_admin($feedback_id, $country, $review_text, $status);

        $_SESSION['success'] = "Feedback updated successfully!";
        header('Location: index.php?controller=Feedback&action=' . $link);
        exit;
    }
    // =======================================================================
    public function delete_feedback()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $feedback_id = trim($_POST['feedback_id'] ?? '');
        $link = $_POST['link'] ?? '';



        $Delete_feedback_Model = new Feedback();

        if ($Delete_feedback_Model->delete_feedback($feedback_id)) {
            $_SESSION['success'] = "feedback deleted successfully!";
        } else {
            $_SESSION['errors'] = ["Failed to delete feedback."];
        }

        // Redirect back to Pakage index
        header('Location: index.php?controller=Feedback&action=' . $link);
        exit;
    }
    // =======================================================================

}
