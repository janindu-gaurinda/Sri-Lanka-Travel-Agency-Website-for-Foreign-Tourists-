<title>Dashboard</title>
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

<?php include 'css.php'; ?>
<div class="col-1 bg-dark d-flex flex-column justify-content-between position-fixed start-0 top-0 vh-100 p-0 ">
    <div class="nav flex-column text-left mt-2">

        <!-- ================================================================= -->
        <div class="btn-group dropup  my-2 ">
            <a class="nav-link dropdown-toggle linkh" data-bs-toggle="dropdown" href="index.php?controller=Home&action=index" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Home
            </a>
            <ul class="dropdown-menu dropdown-menu-dark ms-2 ms-2">
                <li><a class="nav-link active" aria-current="page" href="index.php?controller=Home&action=index">Home</a></li>
                <hr class="dropdown-divider">
                <li><a class="nav-link active" aria-current="page" href="index.php?controller=About&action=index">About Us</a></li>
                <hr class="dropdown-divider">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?controller=Package&action=index">Packages</a></li>
                <hr class="dropdown-divider">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?controller=Destinations&action=index">Top Destinations</a></li>
                <hr class="dropdown-divider">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?controller=Blog&action=index">Travel Tips</a></li>
                <hr class="dropdown-divider">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?controller=Feedback&action=index">Feedback</a></li>
                <hr class="dropdown-divider">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?controller=Gallery&action=index">Gallery</a></li>
                <hr class="dropdown-divider">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?controller=dashboard&action=index"><span class="fw-bold">! Dashboard</span></a></li>
            </ul>
        </div>
        <!-- ================================================================= -->
        <!-- ================================================================= -->
        <div class="btn-group dropup  my-2">
            <a class="nav-link dropdown-toggle linkh" data-bs-toggle="dropdown" href="index.php?controller=Home&action=index" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Packages
            </a>
            <ul class="dropdown-menu dropdown-menu-dark ms-2">
                <li><a class="dropdown-item" href="index.php?controller=Package&action=index">Packages</a></li>
                <hr class="dropdown-divider">
                <li><a class="dropdown-item" href="index.php?controller=Package&action=add_pkg">Add Packages</a></li>
            </ul>
        </div>
        <!-- ================================================================= -->
        <div class="btn-group dropup  my-2">
            <a class="nav-link dropdown-toggle linkh" data-bs-toggle="dropdown" href="index.php?controller=Home&action=index" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Destinat.
            </a>
            <ul class="dropdown-menu dropdown-menu-dark ms-2">
                <li><a class="dropdown-item" href="index.php?controller=Destinations&action=index">Destinations</a></li>
                <hr class="dropdown-divider">
                <li><a class="dropdown-item" href="index.php?controller=Destinations&action=edit_desti">Edit Destinations</a></li>
            </ul>
        </div>
        <!-- ================================================================= -->
        <!-- ================================================================= -->
        <div class="btn-group dropup  my-2">
            <a class="nav-link dropdown-toggle linkh" data-bs-toggle="dropdown" href="index.php?controller=Home&action=index" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Feedback
            </a>
            <ul class="dropdown-menu dropdown-menu-dark ms-2">
                <li><a class="dropdown-item" href="index.php?controller=Feedback&action=index">Feedback</a></li>
                <hr class="dropdown-divider">
                <li><a class="dropdown-item" href="index.php?controller=Feedback&action=curd_feedback">CURD Feedback</a></li>
            </ul>
        </div>
        <!-- ================================================================= -->
        <!-- ================================================================= -->
        <div class="btn-group dropup  my-2">
            <a class="nav-link dropdown-toggle linkh" data-bs-toggle="dropdown" href="index.php?controller=Home&action=index" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Travel Tips
            </a>
            <ul class="dropdown-menu dropdown-menu-dark ms-2">
                <li><a class="dropdown-item" href="index.php?controller=Blog&action=index">Travel Tips</a></li>
                <hr class="dropdown-divider">
                <li><a class="dropdown-item" href="index.php?controller=Blog&action=Crud_blog">CRUD Travel Tips</a></li>
                <hr class="dropdown-divider">
                <li><a class="dropdown-item" href="index.php?controller=Blog&action=pending_blog">User Pending Blogs</a></li>
            </ul>
        </div>
        <!-- ================================================================= -->
        <div class="btn-group dropup  my-2">
            <a class="nav-link dropdown-toggle linkh" data-bs-toggle="dropdown" href="index.php?controller=Gallery&action=addImg" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Gallery
            </a>
            <ul class="dropdown-menu dropdown-menu-dark ms-2">
                <li><a class="dropdown-item" href="index.php?controller=Gallery&action=index">Gallery</a></li>
                <hr class="dropdown-divider">
                <li><a class="dropdown-item" href="index.php?controller=Gallery&action=addImg">Add Gallery Img</a></li>
            </ul>

        </div>
        <!-- ================================================================= -->
        <div class="btn-group dropup  my-2">
            <a class="nav-link dropdown-toggle linkh" data-bs-toggle="dropdown" href="index.php?controller=Home&action=index" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                User
            </a>
            <ul class="dropdown-menu dropdown-menu-dark ms-2">
                <li><a class="dropdown-item" href="index.php?controller=Home&action=index">User</a></li>
                <hr class="dropdown-divider">
            </ul>
        </div>
        <!-- ================================================================= -->


    </div>
    <div class="text-center mb-2">
        <div class="m-3">
            <?php if (isset($_SESSION['user'])) { ?>
                <!-- Left: Image + Name -->
                <a href="#" class="d-flex align-items-center text-decoration-none">
                    <h6 class="mb-0 p-2"><?php echo $_SESSION['user']['name']; ?>!</h6>
                </a>
            <?php } ?>
            <!-- Right: Button -->
            <?php if (!isset($_SESSION['user'])) { ?>
                <form action="index.php?controller=Login&action=index" method="POST" class="d-flex">
                    <button class="btn btn-outline-primary my-2" type="submit">LOGIN</button>
                </form>
            <?php } else { ?>
                <form action="index.php?controller=Login&action=logout" method="POST" class="d-flex" onclick="return confirm('Are you sure you want to logout?')">
                    <button class="btn btn-outline-danger my-2" type="submit">LOGOUT</button>
                </form> <?php } ?>
        </div>
    </div>
</div>

<?php include 'js.php'; ?>