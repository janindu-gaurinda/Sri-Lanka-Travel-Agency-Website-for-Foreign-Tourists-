<?php
require_once 'models/Destination.php';  // Example model

class DestinationsController
{
    public function index()
    {
        $pkg_Model = new Destination();

        $limit = 6; // Packages per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit;

        $Get_dest = $pkg_Model->get_dest_paginated($limit, $offset);
        $total_dest = $pkg_Model->destinations_count();
        $totalPages = ceil($total_dest / $limit);

        require_once 'views/header.php';
        require_once 'views/destinations/Destinations.php';
        require_once 'views/footer.php';
    }
    // ==================================
    public function edit_desti()
    {
        $destimodel = new Destination();
        $desti = $destimodel->getAll_desti();
        require_once 'views/css.php';
        require_once 'views/destinations/Edit_destinations.php';
        require_once 'views/js.php';
    }
    // ==================================
    public function insert_desti()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $tagline = trim($_POST['tagline'] ?? '');
        $errors = [];

        if (!isset($_FILES['image_path']) || $_FILES['image_path']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "Image is required and must be uploaded successfully.";
        }
        if (!$name) $errors[] = "name is required.";
        if (!$tagline) $errors[] = "tagline is required.";
        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: index.php?controller=destinations&action=edit_desti');
            exit;
        }

        // Handle file upload
        $imgName = uniqid() . "_" . basename($_FILES['image_path']['name']);
        // $targetDir = "uploads/"; // Make sure this directory exists and is writable
        $targetDir = "public\img\destinations/"; // Make sure this directory exists and is writable
        $targetFile = $targetDir . $imgName;

        if (!move_uploaded_file($_FILES['image_path']['tmp_name'], $targetFile)) {
            $_SESSION['errors'] = ["Failed to upload image."];
            header('Location: index.php?controller=destinations&action=edit_desti');
            exit;
        }

        // Save to DB
        $Insert_desti_Model = new Destination();
        $Insert_desti_Model->insert_desti($imgName, $name, $tagline);

        $_SESSION['success'] = "Destinations added successfully!";
        header('Location: index.php?controller=destinations&action=edit_desti');
        exit;
    }
    // ==================================
    public function update_dest()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $destination_id = intval($_POST['destination_id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $tagline = trim($_POST['tagline'] ?? '');

        $old_image = $_POST['old_image'] ?? '';
        $status = $_POST['status'] ?? '';

        $errors = [];
        if (!$destination_id) $errors[] = "Invalid package ID.";
        if (!$name) $errors[] = "name is required.";
        if (!$tagline) $errors[] = "tagline is required.";
        if (!$status) $errors[] = "status is required.";

        // Check if a new image is uploaded
        if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
            $imgName = uniqid() . "_" . basename($_FILES['image_path']['name']);
            $targetDir = "public/img/destinations/";
            $targetFile = $targetDir . $imgName;

            if (!move_uploaded_file($_FILES['image_path']['tmp_name'], $targetFile)) {
                $errors[] = "Failed to upload new image.";
            }
            if ($old_image) {
                $filePath = 'public/img/destinations/' . $old_image;
                if (file_exists($filePath)) {
                    unlink($filePath); // Delete old file
                }
            }
        } else {
            // No new image uploaded, use old image
            $imgName = $old_image;
        }

        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: index.php?controller=destinations&action=edit_desti');
            exit;
        }

        // Save to DB
        $Update_pkg_Model = new Destination();
        $Update_pkg_Model->update_dest($destination_id, $imgName, $name, $tagline, $status);

        $_SESSION['success'] = "Package updated successfully!";
        header('Location: index.php?controller=destinations&action=edit_desti');
        exit;
    }
    // ==================================
    public function delete_pkg()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $destination_id = trim($_POST['destination_id'] ?? '');

        if (empty($destination_id)) {
            $_SESSION['errors'] = ["destination ID is required."];
            header("Location: index.php?controller=destinations&action=edit_desti");
            exit;
        }

        $Delete_dest_Model = new Destination();

        if ($Delete_dest_Model->deletedest($destination_id)) {
            $_SESSION['success'] = "destination deleted successfully!";
        } else {
            $_SESSION['errors'] = ["Failed to delete destination."];
        }

        // Redirect back to Pakage index
        header("Location: index.php?controller=destinations&action=edit_desti");
        exit;
    }
    // ==================================
}
