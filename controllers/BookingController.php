<?php
require_once 'models/Booking.php';  // Example model
require_once 'models/Pakage.php';  // Example model

class bookingController
{
    public function index()
    {
        $pkg_Model = new Pakage();
        $Get_pkg = $pkg_Model->getAll_pkg();
        // -----------------------------------------
        require_once 'views/header.php';
        require_once 'views/booking/booking.php';
        require_once 'views/footer.php';
    }
    // ==================================
     public function my_booking()
    {
        $pkg_Model = new Pakage();
        $Get_pkg = $pkg_Model->getAll_pkg();
        // -----------------------------------------
        //   $user_id = $_SESSION['user']['user_id'];
        $Booking_Model = new Booking();
        $Get_mybookings = $Booking_Model->getAll_user_bookings();

        // -----------------------------------------
        require_once 'views/css.php';
        require_once 'views/booking/my_booking.php';
        require_once 'views/js.php';
    }
    // ==================================
    public function insert_booking()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request.";
            return;
        }

        // Collect form data
        $full_name = trim($_POST['full_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $contact_number = trim($_POST['contact_number'] ?? '');
        $nationality = trim($_POST['nationality'] ?? '');
        $passport_number = trim($_POST['passport_number'] ?? '');
        $dob = trim($_POST['dob'] ?? '');
        $gender = trim($_POST['gender'] ?? '');
        $start_date = trim($_POST['start_date'] ?? '');
        $alt_date = trim($_POST['alt_date'] ?? '');
        $num_adults = trim($_POST['num_adults'] ?? '');
        $num_children = trim($_POST['num_children'] ?? '');
        $hotel_category = trim($_POST['hotel_category'] ?? '');
        $meal_plan = trim($_POST['meal_plan'] ?? '');
        $room_type = trim($_POST['room_type'] ?? '');
        $package_id = trim($_POST['package_id'] ?? '');
        $special_requests = trim($_POST['special_requests'] ?? '');
        $emergency_name = trim($_POST['emergency_name'] ?? '');
        $emergency_relation = trim($_POST['emergency_relation'] ?? '');
        $emergency_phone = trim($_POST['emergency_phone'] ?? '');
        $emergency_email = trim($_POST['emergency_email'] ?? '');

        // Validate required fields
        $errors = [];

        if (!$full_name) $errors[] = "Full Name is required.";
        if (!$email) $errors[] = "Email is required.";
        if (!$contact_number) $errors[] = "Contact Number is required.";
        if (!$nationality) $errors[] = "Nationality is required.";
        if (!$passport_number) $errors[] = "Passport Number is required.";
        if (!$dob) $errors[] = "Date of Birth is required.";
        if (!$gender) $errors[] = "Gender is required.";
        if (!$start_date) $errors[] = "Preferred Start Date is required.";
        if (!$num_adults) $errors[] = "Number of Adults is required.";
        if (!$hotel_category) $errors[] = "Hotel Category is required.";
        if (!$meal_plan) $errors[] = "Meal Plan is required.";
        if (!$room_type) $errors[] = "Room Type is required.";
        if (!$package_id) $errors[] = "Package is required.";
        if (!$emergency_name) $errors[] = "Emergency contact name is required.";
        if (!$emergency_relation) $errors[] = "Emergency contact relation is required.";
        if (!$emergency_phone) $errors[] = "Emergency contact phone is required.";
        if (!$emergency_email) $errors[] = "Emergency contact email is required.";

        if (!empty($errors)) {
            // You can store errors in session or pass to view
            $_SESSION['errors'] = $errors;
            header("Location: index.php?controller=booking&action=index"); // adjust as needed
            exit;
        }

        // Insert into DB using model
        $BookingModel = new booking();

        $user_id = $_SESSION['user']['user_id'] ?? 1; // Example, or default 1

        $BookingModel->insert_booking_data(
            
            $package_id,
            $num_adults,
            $num_children,
            $start_date,
            $alt_date,
            $full_name,
            $email,
            $contact_number,
            $nationality,
            $passport_number,
            $dob,
            $gender,
            $hotel_category,
            $meal_plan,
            $room_type,
            $special_requests,
            $emergency_name,
            $emergency_relation,
            $emergency_phone,
            $emergency_email,
            null,             // payment_method
            'Pending',        // payment_status
            0.00,            // amount_paid
            'Pending'        // booking_status
        );

        $_SESSION['success'] = "Booking added successfully!";
        header("Location: index.php?controller=booking&action=index"); // adjust as needed
        exit;
    }

    // ===========================================================================================
}
