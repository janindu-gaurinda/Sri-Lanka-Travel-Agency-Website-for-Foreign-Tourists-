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
    <?php include 'css.php'; ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top shadow-sm border-bottom">
        <div class="container-fluid">
            <!-- Brand Logo -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php?controller=Home&action=index">
                <img src="public/assets/img/Vintage and Retro Holiday Travel Agent Logo.png" alt="Logo" width="40" height="40" class="rounded-circle">
                <span class="fw-bold text-primary d-none d-md-inline">Travel SL</span>
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nav Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-semibold">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Home&action=index">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=About&action=index">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Package&action=index">Packages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Destinations&action=index">Destinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Blog&action=index">Travel Tips</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Feedback&action=index">Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Gallery&action=index">Gallery</a>
                    </li>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') { ?>
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-danger" href="index.php?controller=dashboard&action=index">Dashboard</a>
                        </li>
                    <?php } ?>
                </ul>

                <!-- Right-side user actions -->
                <div class="d-flex align-items-center gap-3">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <!-- Profile -->
                        <a href="index.php?controller=User&action=index" class="d-flex align-items-center text-decoration-none">
                            <img src="public/img/user/<?php echo htmlspecialchars($_SESSION['user']['profile_pic']); ?>" alt="User" width="40" height="40" class="rounded-circle shadow-sm me-2 border border-2 border-primary">
                            <span class="fw-semibold text-dark d-none d-lg-inline">Hi, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></span>
                        </a>

                        <!-- Logout -->
                        <form action="index.php?controller=Login&action=logout" method="POST" class="m-0">
                            <button class="btn btn-outline-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to logout?')">Logout</button>
                        </form>
                    <?php } else { ?>
                        <form action="index.php?controller=Login&action=index" method="POST" class="m-0">
                            <button class="btn btn-outline-primary btn-sm" type="submit">Login</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>

    <br>
    <br>