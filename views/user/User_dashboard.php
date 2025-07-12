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
                <?php
                if (!empty($get_user)) {
                    $picture = $get_user['profile_pic'] ?: "useer.png"; // fallback if profile_pic is empty
                } else {
                    $picture = "useer.png";
                }
                ?>
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img src="public/img/user/<?php echo htmlspecialchars($picture); ?>"
                            alt="User Image"
                            width="60"
                            height="60"
                            class="rounded-circle shadow-sm">

                        <div class="d-flex align-items-center gap-2">
                            <h1 class="mb-0 fs-4 fw-bold">Welcome, <?php echo htmlspecialchars($get_user['full_name']); ?>!</h1>
                            <button type="button" class="btn btn-outline-success btn-md" data-bs-toggle="modal" data-bs-target="#exampleModal" title="Edit Profile">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>


                <!-- Modal =====================================================================-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered"> <!-- centered vertically -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?php echo htmlspecialchars($get_user['full_name']); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body d-flex flex-column align-items-center gap-3">
                                <!-- Profile Image -->
                                <img src="public/img/user/<?php echo htmlspecialchars($picture); ?>"
                                    alt="Profile image of <?php echo htmlspecialchars($get_user['full_name']); ?>"
                                    width="150" height="150"
                                    class="rounded-circle shadow-sm mb-3">

                                <!-- Upload form -->
                                <form action="index.php?controller=User&action=upload_profile_pic" method="post" enctype="multipart/form-data" class="w-100 d-flex gap-2 align-items-center">
                                    <input type="file" class="form-control" name="profile_pic" required aria-label="Choose profile picture">

                                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($get_user['user_id']); ?>">
                                    <input type="hidden" name="old_profile_pic" value="<?php echo htmlspecialchars($get_user['profile_pic']); ?>">

                                    <button class="btn btn-success" type="submit" title="Upload profile picture">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>

                                <!-- Delete form -->
                                <?php if ($get_user['profile_pic'] != 'useer.png'): ?>
                                    <form action="index.php?controller=User&action=delete_profile_pic" method="post" class="w-100 mt-2">
                                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($get_user['user_id']); ?>">
                                        <button class="btn btn-danger w-100" type="submit" onclick="return confirm('Are you sure you want to delete your profile picture?')">
                                            <i class="bi bi-trash-fill"></i> Remove Photo
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal =====================================================================-->

                <div class="col">
                    <div class="container">
                        <hr>
                        <form class="row g-3" id="myForm" action="index.php?controller=User&action=update_user" method="post">
                            <div class="col-md-4">
                                <label for="inputfullname" class="form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control" id="inputfullname" required
                                    data-parsley-required-message="Full Name is required"
                                    data-parsley-minlength="3"
                                    data-parsley-maxlength="100"
                                    data-parsley-trigger="change"
                                    value="<?php echo $get_user['full_name']; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="inputemail" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="inputemail" required
                                    data-parsley-required-message="Email is required"
                                    data-parsley-minlength="3"
                                    data-parsley-maxlength="100"
                                    data-parsley-trigger="change"
                                    value="<?php echo $get_user['email']; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="inputphone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" maxlength="10" id="inputphone"
                                    data-parsley-required-message="Phone is required"
                                    data-parsley-maxlength="10"
                                    data-parsley-minlength="10"
                                    data-parsley-type="digits"
                                    data-parsley-trigger="change"
                                    value="<?php echo $get_user['phone']; ?>">
                            </div>

                            <div class="col-12 text-center">
                                <input type="hidden" name="user_id" value="<?php echo $get_user['user_id']; ?>">
                                <button type="submit" class="btn btn-primary">Update Personal Details</button>
                            </div>
                        </form>
                        <hr>
                        <!-- ========================================================================= -->
                        <form class="row g-3" id="paswordmyForm" action="index.php?controller=User&action=update_user_password" method="post">
                            <div class="col-md-6">
                                <label for="inputnewpasword" class="form-label">New Password</label>
                                <input type="password" name="new_password" class="form-control" id="inputnewpasword" required value=""
                                    data-parsley-required-message="Password is required"
                                    data-parsley-minlength="6"
                                    data-parsley-minlength-message="Password must be at least 6 characters long.">
                                <input class="form-check-input" type="checkbox" id="np" onclick="toggleNewPassword()">
                                <label for="np">Show Password</label>
                            </div>
                            <div class="col-md-6">
                                <label for="inputcpassword" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" id="inputcpassword" value="" required
                                    data-parsley-required-message="Please re-enter password"
                                    data-parsley-equalto="#inputnewpasword"
                                    data-parsley-equalto-message="Passwords do not match">
                                <input class="form-check-input" type="checkbox" id="cp" onclick="toggleConfirmPassword()"><label for="cp">Show Password</label>
                            </div>
                            <div class="col-12 text-center">
                                <input type="hidden" name="user_id" value="<?php echo $get_user['user_id']; ?>">
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                        </form>
                        <hr>
                        <!-- ========================================================================= -->

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('#myForm').parsley();
    });
</script>
<script>
    $(document).ready(function() {
        $('#paswordmyForm').parsley();
    });

    function toggleNewPassword() {
        var x = document.getElementById("inputnewpasword");
        x.type = x.type === "password" ? "text" : "password";
    }

    function toggleConfirmPassword() {
        var x = document.getElementById("inputcpassword");
        x.type = x.type === "password" ? "text" : "password";
    }
</script>