<?php
require_once 'models/Blog.php';  // Example model
require_once 'BaseController.php';

class BlogController extends BaseController
{
    public function index()
    {
        $get_user = $this->get_user;
        // =================================================
        $blogs_Model = new Blog();

        $limit = 10; // Packages per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit;

        $Get_blogs = $blogs_Model->get_blogs_paginated($limit, $offset);
        $total_blogs = $blogs_Model->count_blogs();
        $totalPages = ceil($total_blogs / $limit);
        // =================================================
        require_once 'views/header.php';
        require_once 'views/blogs/blog.php';
        require_once 'views/footer.php';
    }
    // =================================================
    public function Crud_blog()
    {
        $blog_Model = new Blog();
        $Get_blog = $blog_Model->getAll_blog();
        // =================================================
        require_once 'views/css.php';
        require_once 'views/blogs/crud_blog.php';
        require_once 'views/js.php';
    }
    // =================================================
    public function write_blog()
    {
        $blog_Model = new Blog();
        $Get_blog = $blog_Model->getAll_blog();
        // =================================================
        // require_once 'views/css.php';
        require_once 'views/header.php';
        require_once 'views/blogs/write_blog.php';
        // require_once 'views/js.php';
        require_once 'views/footer.php';
    }
    // =================================================
    public function pending_blog()
    {
        $penidng_blog_Model = new Blog();
        $Get_blog = $penidng_blog_Model->getAll_pending_blogs();
        // =================================================
        require_once 'views/css.php';
        require_once 'views/blogs/pending_blogs.php';
        require_once 'views/js.php';
    }
    // =================================================
     public function user_blog()
    {
        $penidng_blog_Model = new Blog();
        $Get_blog = $penidng_blog_Model->getAll_user_blogs();
        // =================================================
        require_once 'views/css.php';
        require_once 'views/blogs/user_blog.php';
        require_once 'views/js.php';
    }
    // =================================================
    public function insert_blog()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $title = trim($_POST['title'] ?? '');
        $excerpt = trim($_POST['excerpt'] ?? '');
        $content = ($_POST['content'] ?? '');
        $errors = [];

        if (!isset($_FILES['image_path']) || $_FILES['image_path']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "Image is required and must be uploaded successfully.";
        }
        if (!$title) $errors[] = "title is required.";
        if (!$excerpt) $errors[] = "excerpt is required.";
        if (!$content) $errors[] = "content is required.";

        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: index.php?controller=Blog&action=Crud_blog');
            exit;
        }

        // Handle file upload
        $imgName = uniqid() . "_" . basename($_FILES['image_path']['name']);
        // $targetDir = "uploads/"; // Make sure this directory exists and is writable
        $targetDir = "public\img\blog/"; // Make sure this directory exists and is writable
        $targetFile = $targetDir . $imgName;

        if (!move_uploaded_file($_FILES['image_path']['tmp_name'], $targetFile)) {
            $_SESSION['errors'] = ["Failed to upload image."];
            header('Location: index.php?controller=Blog&action=Crud_blog');
            exit;
        }

        // Save to DB
        $Insert_blog_Model = new Blog();
        $Insert_blog_Model->insert_blog($imgName, $title, $excerpt, $content);

        $_SESSION['success'] = "BLog added successfully!";
        header('Location: index.php?controller=Blog&action=Crud_blog');
        exit;
    }
    // =================================================
    public function update_blog()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $blog_id = intval($_POST['blog_id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $excerpt = trim($_POST['excerpt'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $old_image = $_POST['old_image'] ?? '';
        $link = $_POST['link'] ?? '';
        $status = $_POST['status'] ?? '';

        $errors = [];
        if (!$blog_id) $errors[] = "Invalid package ID.";
        if (!$title) $errors[] = "title is required.";
        if (!$excerpt) $errors[] = "excerpt is required.";
        if (!$content) $errors[] = "content is required.";
        if (!$status) $errors[] = "status is required.";

        // Check if a new image is uploaded
        if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
            $imgName = uniqid() . "_" . basename($_FILES['image_path']['name']);
            $targetDir = "public/img/blog/";
            $targetFile = $targetDir . $imgName;

            if (!move_uploaded_file($_FILES['image_path']['tmp_name'], $targetFile)) {
                $errors[] = "Failed to upload new image.";
            }
            if ($old_image) {
                $filePath = 'public/img/blog/' . $old_image;
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
            header('Location: index.php?controller=Blog&action='.$link);
            exit;
        }

        // Save to DB
        $Update_blog_Model = new Blog();
        $Update_blog_Model->update_blog($blog_id, $imgName, $title, $excerpt, $content, $status);

        $_SESSION['success'] = "Blog updated successfully!";
        header('Location: index.php?controller=Blog&action='.$link);
        exit;
    }
    
    // =================================================
    public function delete_blog()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }
        
        $blog_id = trim($_POST['blog_id'] ?? '');
        $link = $_POST['link'] ?? '';
        
        
        if (empty($blog_id)) {
            $_SESSION['errors'] = ["blog_id is required."];
            // header("Location: index.php?controller=Blog&action='.$link");
            header('Location: index.php?controller=Blog&action='.$link);
            exit;
        }
        
        $Delete_blog_Model = new Blog();
        
        if ($Delete_blog_Model->delete_blog($blog_id)) {
            $_SESSION['success'] = "blog_id deleted successfully!";
        } else {
            $_SESSION['errors'] = ["Failed to delete blog_id."];
        }
        
        // Redirect back to Pakage index
        header('Location: index.php?controller=Blog&action='.$link);
        exit;
    }

    // =================================================
    public function view_blog()
    {
        $blog_id = isset($_GET['blog_id']) ? (int)$_GET['blog_id'] : 0;

        if ($blog_id < 1) {
            // Optionally redirect or show error
            die("Invalid blog ID");
        }

        $blogs_Model = new Blog();
        $blog = $blogs_Model->get_blog_by_id($blog_id);

        if (!$blog) {
            // Optionally handle not found
            die("Blog not found");
        }

        require_once 'views/header.php';
        require_once 'views/blogs/view_blog.php';
        require_once 'views/footer.php';
    }

    // =================================================
    public function write_blog_insert()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $title = trim($_POST['title'] ?? '');
        $excerpt = trim($_POST['excerpt'] ?? '');
        $content = ($_POST['content'] ?? '');
        $errors = [];

        if (!isset($_FILES['image_path']) || $_FILES['image_path']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "Image is required and must be uploaded successfully.";
        }
        if (!$title) $errors[] = "title is required.";
        if (!$excerpt) $errors[] = "excerpt is required.";
        if (!$content) $errors[] = "content is required.";

        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: index.php?controller=Blog&action=write_blog');
            exit;
        }

        // Handle file upload
        $imgName = uniqid() . "_" . basename($_FILES['image_path']['name']);
        // $targetDir = "uploads/"; // Make sure this directory exists and is writable
        $targetDir = "public\img\blog/"; // Make sure this directory exists and is writable
        $targetFile = $targetDir . $imgName;

        if (!move_uploaded_file($_FILES['image_path']['tmp_name'], $targetFile)) {
            $_SESSION['errors'] = ["Failed to upload image."];
            header('Location: index.php?controller=Blog&action=write_blog');
            exit;
        }

        // Save to DB
        $Insert_blog_Model = new Blog();
        $Insert_blog_Model->write_insert_blog($imgName, $title, $excerpt, $content);

        $_SESSION['success'] = "BLog added successfully!";
        header('Location: index.php?controller=Blog&action=write_blog');
        exit;
    }
    // =================================================
}
