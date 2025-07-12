<?php
require_once 'config/config.php';

class Booking
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }


    // }=========================================================

    public function insert_booking_data(
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
        $date_of_birth,
        $gender,
        $hotel_category,
        $meal_plan,
        $room_type,
        $special_requests,
        $emergency_contact_name,
        $emergency_contact_relation,
        $emergency_contact_phone,
        $emergency_contact_email,
        $payment_method = null,
        $payment_status = 'Pending',
        $amount_paid = 0.00,
        $booking_status = 'Pending'
    ) {
        $sql = "INSERT INTO bookings (
        user_id, package_id, num_adults, num_children, start_date, alt_date,
        full_name, email, contact_number, nationality, passport_number, date_of_birth,
        gender, hotel_category, meal_plan, room_type, special_requests,
        emergency_contact_name, emergency_contact_relation, emergency_contact_phone, emergency_contact_email,
        payment_method, payment_status, amount_paid, booking_status
    ) VALUES (
        :user_id, :package_id, :num_adults, :num_children, :start_date, :alt_date,
        :full_name, :email, :contact_number, :nationality, :passport_number, :date_of_birth,
        :gender, :hotel_category, :meal_plan, :room_type, :special_requests,
        :emergency_contact_name, :emergency_contact_relation, :emergency_contact_phone, :emergency_contact_email,
        :payment_method, :payment_status, :amount_paid, :booking_status
    )";
        $user_id = $_SESSION['user']['id'];
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':package_id', $package_id);
        $stmt->bindParam(':num_adults', $num_adults);
        $stmt->bindParam(':num_children', $num_children);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':alt_date', $alt_date);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contact_number', $contact_number);
        $stmt->bindParam(':nationality', $nationality);
        $stmt->bindParam(':passport_number', $passport_number);
        $stmt->bindParam(':date_of_birth', $date_of_birth);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':hotel_category', $hotel_category);
        $stmt->bindParam(':meal_plan', $meal_plan);
        $stmt->bindParam(':room_type', $room_type);
        $stmt->bindParam(':special_requests', $special_requests);
        $stmt->bindParam(':emergency_contact_name', $emergency_contact_name);
        $stmt->bindParam(':emergency_contact_relation', $emergency_contact_relation);
        $stmt->bindParam(':emergency_contact_phone', $emergency_contact_phone);
        $stmt->bindParam(':emergency_contact_email', $emergency_contact_email);
        $stmt->bindParam(':payment_method', $payment_method);
        $stmt->bindParam(':payment_status', $payment_status);
        $stmt->bindParam(':amount_paid', $amount_paid);
        $stmt->bindParam(':booking_status', $booking_status);

        $stmt->execute();
    }

    // ===================================================
    public function getAll_user_bookings()
    {
        $user_id = $_SESSION['user']['id'];

        $stmt = $this->pdo->prepare("SELECT bookings.*, packages.title AS package_title
            FROM bookings
            INNER JOIN packages ON bookings.package_id = packages.package_id
            WHERE bookings.user_id = :user_id
            ORDER BY bookings.booking_id DESC");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // ===================================================

}
