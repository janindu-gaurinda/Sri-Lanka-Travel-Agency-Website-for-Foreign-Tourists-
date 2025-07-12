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

<div class="">
    <!-- Sidebar -->
    <?php
    // include __DIR__ . '/../user_sidebard.php';
    include __DIR__ . '/../user_nav.php';

    ?>
    <!-- Main content -->
    <!-- <div class="col offset-1"> -->
    <div class="col ">
        <div class=" container py-4 py-xl-5">
            <h1>My Bookings</h1>

            <hr>
            <table id="user_bookings" class="table table-striped table-bordered text-center align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Full Name</th>
                        <th class="text-center">Package</th>
                        <th class="text-center">Start Date</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($Get_mybookings)) : ?>
                        <?php foreach ($Get_mybookings as $booking) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($booking['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($booking['package_title']); ?></td>
                                <td><?php echo htmlspecialchars($booking['start_date']); ?></td>
                                <?php
                                if ($booking['booking_status'] == 'Confirmed') {
                                    $color = 'success';
                                } elseif ($booking['booking_status'] == 'Pending') {
                                    $color = 'warning';
                                } elseif ($booking['booking_status'] == 'Cancelled') {
                                    $color = 'danger';
                                } else {
                                    $color = 'secondary';
                                }
                                ?>
                                <td class="text-<?php echo $color; ?>"><i class="bi bi-circle-fill"></i> <?php echo htmlspecialchars($booking['booking_status']); ?></td>

                                <td class="d-flex justify-content-center align-items-center gap-2">
                                    <!-- View Button -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $booking['booking_id']; ?>">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>

                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $booking['booking_id']; ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal<?php echo $booking['booking_id']; ?>" tabindex="-1" aria-labelledby="viewModalLabel<?php echo $booking['booking_id']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Booking Details - <?php echo htmlspecialchars($booking['full_name']); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <p><strong>Package:</strong> <?php echo htmlspecialchars($booking['package_title']); ?></p>
                                            <p><strong>Start Date:</strong> <?php echo htmlspecialchars($booking['start_date']); ?></p>
                                            <p><strong>Adults:</strong> <?php echo htmlspecialchars($booking['num_adults']); ?></p>
                                            <p><strong>Children:</strong> <?php echo htmlspecialchars($booking['num_children']); ?></p>
                                            <p><strong>Hotel:</strong> <?php echo htmlspecialchars($booking['hotel_category']); ?></p>
                                            <p><strong>Meal Plan:</strong> <?php echo htmlspecialchars($booking['meal_plan']); ?></p>
                                            <p><strong>Room Type:</strong> <?php echo htmlspecialchars($booking['room_type']); ?></p>
                                            <p><strong>Status:</strong> <?php echo htmlspecialchars($booking['booking_status']); ?></p>
                                            <p><strong>Special Requests:</strong><br><?php echo nl2br(htmlspecialchars($booking['special_requests'])); ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?php echo $booking['booking_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $booking['booking_id']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Booking - <?php echo htmlspecialchars($booking['full_name']); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="index.php?controller=booking&action=update_booking" method="post">
                                            <div class="modal-body text-start">
                                                <input type="hidden" name="booking_id" value="<?php echo $booking['booking_id']; ?>">

                                                <div class="mb-3">
                                                    <label for="special_requests" class="form-label">Special Requests</label>
                                                    <textarea class="form-control" name="special_requests" rows="3"><?php echo htmlspecialchars($booking['special_requests']); ?></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="booking_status" class="form-label">Booking Status</label>
                                                    <select class="form-select" name="booking_status" required>
                                                        <option value="Pending" <?php if ($booking['booking_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                                        <option value="Confirmed" <?php if ($booking['booking_status'] == 'Confirmed') echo 'selected'; ?>>Confirmed</option>
                                                        <option value="Cancelled" <?php if ($booking['booking_status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                                                        <option value="Completed" <?php if ($booking['booking_status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Booking</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center">No bookings found!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#blog_form').parsley();
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const lightbox = GLightbox({
            selector: '.glightbox',
            closeButton: true,
            loop: true,
            touchNavigation: true,
            keyboardNavigation: true
        });
        console.log(lightbox);
        console.log(document.querySelectorAll('.glightbox'));
    });
</script>