<?php
require_once 'models/Gallery.php';  // Example model

class GalleryController
{
    public function index()
    {
        $Images_Model = new Gallery();
        $Get_images = $Images_Model->getAll_Images();

        require_once 'views/header.php';
        require_once 'views/gallery/gallery.php';
        require_once 'views/footer.php';
    }
    // ===================================================
    public function addImg()
    {
        $Images_Model = new Gallery();
        $Get_images = $Images_Model->getAll_Images();

        require_once 'views/css.php';
        require_once 'views/gallery/add_gallery.php';
        require_once 'views/js.php';
    }
    // ===================================================

    public function insert_img()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $errors = [];

        if (!isset($_FILES['img']) || $_FILES['img']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "Image is required and must be uploaded successfully.";
        }
        if (!$title) $errors[] = "Title is required.";
        if (!$description) $errors[] = "Description is required.";

        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: index.php?controller=Gallery&action=addImg');
            exit;
        }

        // Handle file upload
        $imgName = uniqid() . "_" . basename($_FILES['img']['name']);
        // $targetDir = "uploads/"; // Make sure this directory exists and is writable
        $targetDir = "public\img\gallery/"; // Make sure this directory exists and is writable
        $targetFile = $targetDir . $imgName;

        if (!move_uploaded_file($_FILES['img']['tmp_name'], $targetFile)) {
            $_SESSION['errors'] = ["Failed to upload image."];
            header('Location: index.php?controller=Gallery&action=addImg');
            exit;
        }

        // Save to DB
        $Insert_img_Model = new Gallery();
        $Insert_img_Model->insertImage($imgName, $title, $description);

        $_SESSION['success'] = "Image added successfully!";
        header('Location: index.php?controller=Gallery&action=addImg');
        exit;
    }

    // ===================================================
    public function delete_img()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $gallery_id = trim($_POST['gallery_id'] ?? '');

        if (empty($gallery_id)) {
            $_SESSION['errors'] = ["Gallery ID is required."];
            header("Location: index.php?controller=Gallery&action=addImg");
            exit;
        }

        $Delete_img_Model = new Gallery();

        if ($Delete_img_Model->deleteImage($gallery_id)) {
            $_SESSION['success'] = "Image deleted successfully!";
        } else {
            $_SESSION['errors'] = ["Failed to delete image."];
        }

        // Redirect back to gallery index
        header("Location: index.php?controller=Gallery&action=addImg");
        exit;
    }
}
