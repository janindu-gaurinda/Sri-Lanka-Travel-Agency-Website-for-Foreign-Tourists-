<?php
$success = $_SESSION['success'] ?? '';
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['success'], $_SESSION['errors'], $_SESSION['old']);
?>
<div class="z-3 col-md-6 position-absolute pt-5 rounded-3" style="left: 50%; transform: translateX(-50%);">
    <?php if (!empty($success) || !empty($errors)): ?>
        <div id="overlay" class="overlay d-flex justify-content-center pt-1">
            <div class="alert <?= !empty($errors) ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show" role="alert" style="min-width: 300px; max-width: 90vw;">
                <?php if (!empty($errors)): ?>
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <h6><?= htmlspecialchars($error) ?></h6>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <?= htmlspecialchars($success) ?>
                <?php endif; ?>
                <button type="button" class="btn-close" aria-label="Close" onclick="hideOverlay()"></button>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php

if (!isset($_SESSION['user'])) {
    // No user logged in → redirect to login
    echo "<script>
            alert('You need to Login First !');
            window.location.href = 'index.php?controller=Home&action=index';
        </script>";
    exit;
}

?>
<div class="container mt-5">
    <form class="container my-5 p-4 border rounded-4 shadow bg-light" action="index.php?controller=booking&action=insert_booking" method="post" id="myForm" data-parsley-validate>

        <!-- Traveler Information -->
        <h4 class="mb-3">Traveler Information</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required
                    data-parsley-required-message="Full Name is required"
                    data-parsley-minlength="3"
                    data-parsley-maxlength="100">
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required
                    data-parsley-type="email"
                    data-parsley-required-message="Valid email is required">
            </div>
            <div class="col-md-6 mb-3">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" required
                    data-parsley-pattern="^\d+$"
                    data-parsley-pattern-message="Only numbers allowed"
                    data-parsley-minlength="7"
                    data-parsley-maxlength="20">
            </div>
            <div class="col-md-6 mb-3">
                <label for="nationality" class="form-label">Nationality</label>
                <input type="text" class="form-control" id="nationality" name="nationality" required
                    data-parsley-required-message="Nationality is required">
            </div>
            <div class="col-md-6 mb-3">
                <label for="passport_number" class="form-label">Passport Number</label>
                <input type="text" class="form-control" id="passport_number" name="passport_number" required
                    data-parsley-required-message="Passport Number is required">
            </div>
            <div class="col-md-6 mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" required
                    data-parsley-required-message="Date of Birth is required">
            </div>
            <div class="col-md-6 mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" id="gender" name="gender" required
                    data-parsley-required-message="Please select a gender">
                    <option value="">Select...</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
            </div>
        </div>

        <!-- Travel Details -->
        <h4 class="mt-4 mb-3">Travel Details</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="start_date" class="form-label">Preferred Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required
                    data-parsley-required-message="Start Date is required">
            </div>
            <div class="col-md-6 mb-3">
                <label for="alt_date" class="form-label">Alternative Date</label>
                <input type="date" class="form-control" id="alt_date" name="alt_date">
            </div>
            <div class="col-md-6 mb-3">
                <label for="num_adults" class="form-label">Number of Adults</label>
                <input type="number" class="form-control" id="num_adults" name="num_adults" value="1" min="1" required
                    data-parsley-type="number"
                    data-parsley-min="1"
                    data-parsley-required-message="Number of adults is required">
            </div>
            <div class="col-md-6 mb-3">
                <label for="num_children" class="form-label">Number of Children</label>
                <input type="number" class="form-control" id="num_children" name="num_children" value="0" min="0"
                    data-parsley-type="number"
                    data-parsley-min="0">
            </div>
            <div class="col-md-6 mb-3">
                <label for="hotel_category" class="form-label">Hotel Category</label>
                <select class="form-select" id="hotel_category" name="hotel_category" required
                    data-parsley-required-message="Please select a hotel category">
                    <option value="">Select...</option>
                    <option value="3-star">3-star</option>
                    <option value="4-star">4-star</option>
                    <option value="5-star">5-star</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="meal_plan" class="form-label">Meal Plan</label>
                <select class="form-select" id="meal_plan" name="meal_plan" required
                    data-parsley-required-message="Please select a meal plan">
                    <option value="">Select...</option>
                    <option value="Breakfast only">Breakfast only</option>
                    <option value="Half board">Half board</option>
                    <option value="Full board">Full board</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="room_type" class="form-label">Room Type</label>
                <select class="form-select" id="room_type" name="room_type" required
                    data-parsley-required-message="Please select a room type">
                    <option value="">Select...</option>
                    <option value="Single">Single</option>
                    <option value="Double">Double</option>
                    <option value="Triple">Triple</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="room_type" class="form-label">Package   <a class=""ref="index.php?controller=Package&action=index">Explore Our Packages</a></label>
                <select class="form-select" id="package_id" name="package_id" required
                    data-parsley-required-message="Please select a package">
                    <?php if (!empty($Get_pkg)) : ?>
                        <?php foreach ($Get_pkg as $pkg) : ?>
                            <option value="<?php echo htmlspecialchars($pkg['package_id']); ?>"><?php echo htmlspecialchars($pkg['title']); ?></option>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="text-center">
                            <option value="" disabled>No Packages Found!</option>
                        </div>
                    <?php endif; ?>
                </select>
            </div>
        </div>

        <!-- Special Requests -->
        <div class="mb-3">
            <label for="special_requests" class="form-label">Special Requests</label>
            <textarea class="form-control" id="special_requests" name="special_requests" rows="3"
                data-parsley-maxlength="500"></textarea>
        </div>

        <!-- Emergency Contact -->
        <h4 class="mt-4 mb-3">Emergency Contact</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="emergency_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="emergency_name" name="emergency_name" required
                    data-parsley-required-message="Emergency contact name is required">
            </div>
            <div class="col-md-6 mb-3">
                <label for="emergency_relation" class="form-label">Relation</label>
                <input type="text" class="form-control" id="emergency_relation" name="emergency_relation" required
                    data-parsley-required-message="Relation is required">
            </div>
            <div class="col-md-6 mb-3">
                <label for="emergency_phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="emergency_phone" name="emergency_phone" required
                    data-parsley-pattern="^\d+$"
                    data-parsley-pattern-message="Only numbers allowed"
                    data-parsley-required-message="Phone number is required"
                    data-parsley-minlength="7"
                    data-parsley-maxlength="20">
            </div>
            <div class="col-md-6 mb-3">
                <label for="emergency_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="emergency_email" name="emergency_email" required
                    data-parsley-type="email"
                    data-parsley-required-message="Valid email is required">
            </div>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary px-4 mt-3">Confirm & Book</button>
    </form>
</div>