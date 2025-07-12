<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Sri Lanka</title>
    <!-- <link rel="stylesheet" href="public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/aos.min.css">
    <link rel="stylesheet" href="public/assets/css/animate.min.css">
    <link rel="stylesheet" href="public/assets/css/Articles-Cards-images.css">
    <link rel="stylesheet" href="public/assets/css/Navbar-Centered-Links-icons.css">
    <link rel="stylesheet" href="public/css/glightbox.min.css">
    <link rel="stylesheet" href="public/css/coustom.css">
    <link href="public/datatable/dataTables.bootstrap5.min.css" rel="stylesheet"> -->
    <?php
    // include 'css.php'; 
    ?>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-black fixed-top shadow-sm border-bottom">
        <div class="container-fluid">
            <!-- Brand Logo -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php?controller=Home&action=index">
                <img src="public/assets/img/Vintage and Retro Holiday Travel Agent Logo.png" alt="Logo" width="40" height="40" class="rounded-circle">
                <span class="fw-bold text-white d-none d-md-inline">Travel SL</span>
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nav Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-semibold">
                    <!-- <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=Home&action=index">Home</a>
                </li> -->
                    <!-- ========================================== -->
                    <?php
                    // if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'User') {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-danger" href="index.php?controller=User&action=index">User Dashboard</a>
                    </li>
                    <?php
                    // }
                    ?>
                    <!-- ========================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Bookings
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="index.php?controller=booking&action=index">Booking</a></li>
                            <hr class="dropdown-divider">
                            <li><a class="dropdown-item" href="index.php?controller=booking&action=my_booking">My Bookings</a></li>
                        </ul>
                    </li>

                    <!-- ========================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Feedback
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="index.php?controller=Feedback&action=index">Feedback</a></li>
                            <hr class="dropdown-divider">
                            <li><a class="dropdown-item" href="index.php?controller=Feedback&action=user_feedback">My Feedback</a></li>
                        </ul>
                    </li>
                    <!-- ========================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Travel Tips
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="index.php?controller=Blog&action=index">Travel Tips</a></li>
                            <hr class="dropdown-divider">
                            <li><a class="dropdown-item" href="index.php?controller=Blog&action=user_blog">My Travel Tips</a></li>
                        </ul>
                    </li>
                    <!-- ========================================== -->
                   

                </ul>

                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <a href="index.php?controller=User&action=index" class="d-flex align-items-center text-decoration-none">
                            <img src="public/img/user/<?php echo htmlspecialchars($_SESSION['user']['profile_pic']); ?>" alt="User" width="40" height="40" class="rounded-circle shadow-sm border border-2 border-primary me-2">
                            <span class="fw-semibold text-white d-none d-lg-inline">Hi, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></span>
                        </a>
                        <form action="index.php?controller=Login&action=logout" method="POST" class="m-0" onsubmit="return confirm('Are you sure you want to logout?')">
                            <button class="btn btn-outline-danger btn-sm" type="submit">Logout</button>
                        </form>
                    <?php } else { ?>
                        <form action="index.php?controller=Login&action=index" method="POST" class="m-0">
                            <button class="btn btn-outline-light btn-sm" type="submit">Login</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
    <br>
    <br>