<?php
require_once 'models/Login.php';  // Example model

class LoginController
{
    public function index()
    {
        require_once 'views/header.php';
        require_once 'views/login.php';
        require_once 'views/footer.php';
    }
    public function signin()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        $full_name = trim($_POST['full_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $errors = [];

        if (!$full_name) $errors[] = "Full name is required.";
        if (!$email) $errors[] = "Email is required.";
        if (!$password) $errors[] = "Password is required.";

        $loginModel = new Login();

        // ✅ Check if user with this email already exists
        if ($email && $loginModel->checkUserExists($email)) {
            $errors[] = "This email is already registered. try to Forget password or Sign in.";
        }

        if ($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = compact('full_name', 'email');
            header('Location: index.php?controller=Login&action=index');
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $loginModel->sign_in($full_name, $email, $hashedPassword);

        $_SESSION['success'] = "User registered successfully!";
        header('Location: index.php?controller=Login&action=index');
        exit;
    }
    // ==============================================================================================
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        session_start();

        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $errors = [];

        if (!$email) $errors[] = "Email is required.";
        if (!$password) $errors[] = "Password is required.";

        $loginModel = new Login();
        $user = $loginModel->getUserByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $errors[] = "Invalid email or password.";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = ['email' => $email];
            header("Location: index.php?controller=Login&action=index");
            exit;
        }

        // ✅ Save user session details (e.g., user_id, name, role, etc.)
        $_SESSION['user'] = [
            'id' => $user['user_id'],
            'name' => $user['full_name'],
            'email' => $user['email'],
            'profile_pic' => $user['profile_pic'],
            'role' => $user['user_type'] // optional if you have roles
        ];

        $_SESSION['success'] = "Login successful!";
        header("Location: index.php?controller=Home&action=index"); // redirect to dashboard or home
        exit;
    }
    // ==============================================================================================
    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: index.php?controller=Home&action=index");
        exit;
    }
}
