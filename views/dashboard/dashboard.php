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
            alert('Access denied. You are not an admin.');
            window.location.href = 'index.php?controller=Home&action=index';
        </script>";
    exit;
}

if ($_SESSION['user']['role'] !== 'admin') {
    // User is logged in but not admin → force redirect, no page content shown
    echo "<script>
            alert('Access denied. You are not an admin.');
            window.location.href = 'index.php?controller=Home&action=index';
        </script>";
    exit;
    // header("Location: index.php?controller=Home&action=index");
    // exit;
}
?>
<style>
    #feedbackChart,
    #activeUsersChart {
        width: 100% !important;
        height: 100% !important;
    }
</style>


<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php 
        // include __DIR__ . '/../sidebar.php';
        include __DIR__ . '/../admin_nav.php';
         ?>
        <!-- Main content -->
        <!-- <div class="col offset-1"> -->
        <div class="col">
            <div class="container py-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <h1 class="h3 fw-bold ">Dashboard</h1>
                </div>

                <!-- Filter Section -->
                <form id="filterForm" class="row g-2 align-items-end bg-light p-3 rounded shadow-sm mb-4">
                    <div class="col-md-3">
                        <label class="form-label">From</label>
                        <input type="date" class="form-control form-control-sm" name="date_from">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">To</label>
                        <input type="date" class="form-control form-control-sm" name="date_to">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select class="form-select form-select-sm" name="status">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-sm w-100">Filter</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm w-100" onclick="document.getElementById('filterForm').reset()">Reset</button>
                    </div>
                </form>
                <!-- Summary Cards -->
                <div class="row g-4">
                    <div class="col-12 col-md-3">
                        <div class="card text-center shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="fw-bold text-success">Total Users</h5>
                                <p class="display-6 fw-bold" id="totalUsers">1,250</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card text-center shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="fw-bold text-primary">Feedback</h5>
                                <p class="display-6 fw-bold" id="feedbackCount">340</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card text-center shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="fw-bold text-warning">Pending Approvals</h5>
                                <p class="display-6 fw-bold" id="pendingApprovals">27</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card text-center shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="fw-bold text-info">Total Bookings</h5>
                                <p class="display-6 fw-bold" id="totalBookings">1,030</p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Chart Section -->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-lg-4">
                        <div class="card shadow border-0 h-100">
                            <div class="card-header bg-primary text-white d-flex align-items-center">
                                <i class="bi bi-bar-chart-fill me-2"></i> Feedback Overview
                            </div>
                            <div class="card-body bg-light" style="height: 300px; position: relative;">
                                <canvas id="feedbackChart" style="height: auto;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card shadow border-0 h-100">
                            <div class="card-header bg-success text-white d-flex align-items-center">
                                <i class="bi bi-graph-up-arrow me-2"></i> Active Users
                            </div>
                            <div class="card-body bg-light" style="height: 300px; position: relative;">
                                <canvas id="activeUsersChart" style="height: 250px;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card shadow border-0 h-100">
                            <div class="card-header bg-warning text-white d-flex align-items-center">
                                <i class="bi bi-pie-chart-fill me-2"></i> Status Distribution
                            </div>
                            <div class="card-body bg-light">
                                <canvas id="statusDistributionChart" style="height: 250px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Monthly Booking Chart -->
                <div class="row g-4 mb-4">
                    <div class="col-12">
                        <div class="card shadow border-0">
                            <div class="card-header bg-info text-white d-flex align-items-center">
                                <i class="bi bi-calendar-check-fill me-2"></i> Bookings (Last 12 Months)
                            </div>
                            <div class="card-body bg-light">
                                <canvas id="bookingsChart" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Chart.js scripts (example) -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Example chart data
                const bookingsData = {
                    labels: ['Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Bookings',
                        backgroundColor: '#0dcaf0',
                        borderColor: '#0dcaf0',
                        data: [90, 80, 120, 150, 180, 160, 140, 170, 200, 190, 220, 210],
                    }]
                };

                new Chart(document.getElementById('bookingsChart'), {
                    type: 'line',
                    data: bookingsData,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });

                // Add your other charts here similarly
            </script>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.6.2/countUp.umd.js"></script>

<script>
    // Example data — replace with your dynamic data
    new Chart(document.getElementById('feedbackChart'), {
        type: 'bar',
        data: {
            labels: ['Positive', 'Neutral', 'Negative'],
            datasets: [{
                data: [100, 40, 15],
                backgroundColor: ['#198754', '#ffc107', '#dc3545']
            }]
        }
    });

    new Chart(document.getElementById('activeUsersChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr'],
            datasets: [{
                label: 'Users',
                data: [50, 75, 110, 90],
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                fill: true,
                tension: 0.3
            }]
        }
    });

    new Chart(document.getElementById('statusDistributionChart'), {
        type: 'doughnut',
        data: {
            labels: ['Active', 'Pending', 'Inactive'],
            datasets: [{
                data: [120, 50, 30],
                backgroundColor: ['#198754', '#ffc107', '#6c757d']
            }]
        }
    });
</script>


<script>
  document.addEventListener("DOMContentLoaded", () => {
    const options = { duration: 2 };

    new countUp.CountUp('totalUsers', 1250, options).start();
    new countUp.CountUp('feedbackCount', 340, options).start();
    new countUp.CountUp('pendingApprovals', 27, options).start();
    new countUp.CountUp('totalBookings', 1030, options).start();
  });
</script>
