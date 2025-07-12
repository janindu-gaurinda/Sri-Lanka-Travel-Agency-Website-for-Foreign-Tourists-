<?php
require_once 'models/User.php';  // Example model
require_once 'BaseController.php';


class UserController extends BaseController
{
    public function index()
    {
        $Usermodel = new User();
        $get_user = $Usermodel->get_user();
        $get_user = $this->get_user;

        require_once 'views/css.php';
        require_once 'views/user/User_dashboard.php';
        require_once 'views/js.php';
    }
    // ======================================================================
    public function upload_profile_pic()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $user_id = trim($_POST['user_id'] ?? '');
        $old_profile_pic = trim($_POST['old_profile_pic'] ?? '');
        $errors = [];

        if (!isset($_FILES['profile_pic']) || $_FILES['profile_pic']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "Image is required and must be uploaded successfully.";
        }
        if (!$user_id) {
            $errors[] = "User ID is required.";
        }

        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: index.php?controller=User&action=index');
            exit;
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 2 * 1024 * 1024; // 2 MB

        $fileTmpPath = $_FILES['profile_pic']['tmp_name'];
        $fileSize = $_FILES['profile_pic']['size'];
        $fileType = mime_content_type($fileTmpPath);

        if (!in_array($fileType, $allowedTypes)) {
            $errors[] = "Only JPG, PNG, and GIF files are allowed.";
        }

        if ($fileSize > $maxFileSize) {
            $errors[] = "File size must be less than 2 MB.";
        }

        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: index.php?controller=User&action=index');
            exit;
        }

        $imgName = uniqid() . "_" . basename($_FILES['profile_pic']['name']);
        $targetDir = "public/img/user/";
        $targetFile = $targetDir . $imgName;

        if (!move_uploaded_file($fileTmpPath, $targetFile)) {
            $_SESSION['errors'] = ["Failed to upload image."];
            header('Location: index.php?controller=User&action=index');
            exit;
        }

        // Delete old image if exists
        if (!empty($old_profile_pic)) {
            $oldFilePath = $targetDir . $old_profile_pic;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        // Update DB
        $Insert_user_Model = new User();
        $Insert_user_Model->update_profile_pic($imgName, $user_id);

        // ✅ Update session profile picture only
        $_SESSION['user']['profile_pic'] = $imgName;

        $_SESSION['success'] = "Profile picture updated successfully!";
        header('Location: index.php?controller=User&action=index');
        exit;
    }
    // ======================================================================
    public function delete_profile_pic()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $user_id = trim($_POST['user_id'] ?? '');

        if (empty($user_id)) {
            $_SESSION['errors'] = ["User ID is required."];
            header("Location: index.php?controller=User&action=index");
            exit;
        }

        $Delete_propic_Model = new User();

        if ($Delete_propic_Model->deletepropic($user_id)) {
            $_SESSION['success'] = "Profile picture deleted successfully!";
        } else {
            $_SESSION['errors'] = ["Failed to delete profile picture."];
        }

        header("Location: index.php?controller=User&action=index");
        exit;
    }

    // ======================================================================
    public function update_user()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $user_id = intval($_POST['user_id'] ?? 0);
        $full_name = trim($_POST['full_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');

        $errors = [];
        if (!$user_id) $errors[] = "Invalid User ID.";
        if (!$full_name) $errors[] = "Full name is required.";
        if (!$email) $errors[] = "Email is required.";
        if (!$phone) $errors[] = "Phone is required.";

        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: index.php?controller=User&action=index');
            exit;
        }

        $Update_user_Model = new User();
        $result = $Update_user_Model->update_user($user_id, $full_name, $email, $phone);

        if ($result) {
            $_SESSION['success'] = "User data updated successfully!";
        } else {
            $_SESSION['errors'] = ["Email already exists."];
        }
        header('Location: index.php?controller=User&action=index');
        exit;
    }

    // ======================================================================
    public function update_user_password()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $user_id = intval($_POST['user_id'] ?? 0);
        $new_password = trim($_POST['new_password'] ?? '');




        $errors = [];
        if (!$user_id) $errors[] = "Invalid User ID.";
        if (!$new_password) $errors[] = "new_password is required.";
        if (strlen($new_password) < 6) $errors[] = "Password must be at least 6 characters long.";

        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: index.php?controller=User&action=index');
            exit;
        }

        $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);
        // Save to DB
        $Update_user_Model = new User();
        $Update_user_Model->update_user_password($user_id, $hashedPassword);

        $_SESSION['success'] = "new_password updated successfully!";
        header('Location: index.php?controller=User&action=index');
        exit;
    }
    // ======================================================================
}
