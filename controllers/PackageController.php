<?php
require_once 'models/Pakage.php';  // Example model
require_once 'BaseController.php';

class PackageController extends BaseController
{
    public function index()
    {
        $pkg_Model = new Pakage();

        $limit = 6; // Packages per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit;

        $Get_pkg = $pkg_Model->get_pkg_paginated($limit, $offset);
        $totalPkgs = $pkg_Model->count_pkgs();
        $totalPages = ceil($totalPkgs / $limit);

        // ==============================================================
        $get_user = $this->get_user;
        // ==============================================================
        require_once 'views/header.php';
        require_once 'views/packagez/Package.php';
        require_once 'views/footer.php';
    }

    // ==================================
    public function add_pkg()
    {
        $pkg_Model = new Pakage();
        $Get_pkg = $pkg_Model->getAll_pkg();
        require_once 'views/css.php';
        require_once 'views/packagez/add_packages.php';
        require_once 'views/js.php';
    }
    // ==================================
    public function insert_package()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $title = trim($_POST['title'] ?? '');
        $duration = trim($_POST['duration'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $short_description = trim($_POST['short_description'] ?? '');
        $errors = [];

        if (!isset($_FILES['image_path']) || $_FILES['image_path']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "Image is required and must be uploaded successfully.";
        }
        if (!$title) $errors[] = "title is required.";
        if (!$duration) $errors[] = "duration is required.";
        if (!$price) $errors[] = "price is required.";
        if (!$short_description) $errors[] = "short_description is required.";

        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: index.php?controller=Package&action=add_pkg');
            exit;
        }

        // Handle file upload
        $imgName = uniqid() . "_" . basename($_FILES['image_path']['name']);
        // $targetDir = "uploads/"; // Make sure this directory exists and is writable
        $targetDir = "public\img\pkgz/"; // Make sure this directory exists and is writable
        $targetFile = $targetDir . $imgName;

        if (!move_uploaded_file($_FILES['image_path']['tmp_name'], $targetFile)) {
            $_SESSION['errors'] = ["Failed to upload image."];
            header('Location: index.php?controller=Package&action=add_pkg');
            exit;
        }

        // Save to DB
        $Insert_pkg_Model = new Pakage();
        $Insert_pkg_Model->insertpkg($imgName, $title, $duration, $price, $short_description);

        $_SESSION['success'] = "Image added successfully!";
        header('Location: index.php?controller=Package&action=add_pkg');
        exit;
    }
    // ===========================================================================================
    public function update_pkg()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $id = intval($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $duration = trim($_POST['duration'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $short_description = trim($_POST['short_description'] ?? '');
        $old_image = $_POST['old_image'] ?? '';
        $status = $_POST['status'] ?? '';

        $errors = [];
        if (!$id) $errors[] = "Invalid package ID.";
        if (!$title) $errors[] = "Title is required.";
        if (!$duration) $errors[] = "Duration is required.";
        if (!$price) $errors[] = "Price is required.";
        if (!$short_description) $errors[] = "Short description is required.";
        if (!$status) $errors[] = "status is required.";

        // Check if a new image is uploaded
        if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
            $imgName = uniqid() . "_" . basename($_FILES['image_path']['name']);
            $targetDir = "public/img/pkgz/";
            $targetFile = $targetDir . $imgName;

            if (!move_uploaded_file($_FILES['image_path']['tmp_name'], $targetFile)) {
                $errors[] = "Failed to upload new image.";
            }
            if ($old_image) {
                $filePath = 'public/img/pkgz/' . $old_image;
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
            header('Location: index.php?controller=Package&action=add_pkg');
            exit;
        }

        // Save to DB
        $Update_pkg_Model = new Pakage();
        $Update_pkg_Model->update_pkg($id, $imgName, $title, $duration, $price,  $short_description, $status);

        $_SESSION['success'] = "Package updated successfully!";
        header('Location: index.php?controller=Package&action=add_pkg');
        exit;
    }

    // ===========================================================================================
    public function delete_pkg()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $package_id = trim($_POST['package_id'] ?? '');

        if (empty($package_id)) {
            $_SESSION['errors'] = ["package ID is required."];
            header("Location: index.php?controller=Package&action=add_pkg");
            exit;
        }

        $Delete_pkg_Model = new Pakage();

        if ($Delete_pkg_Model->deletepkg($package_id)) {
            $_SESSION['success'] = "Package deleted successfully!";
        } else {
            $_SESSION['errors'] = ["Failed to delete package."];
        }

        // Redirect back to Pakage index
        header("Location: index.php?controller=Package&action=add_pkg");
        exit;
    }
}
