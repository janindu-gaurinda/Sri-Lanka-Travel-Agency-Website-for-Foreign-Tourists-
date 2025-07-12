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
        // include __DIR__ . '/../sidebar.php';
        include __DIR__ . '/../admin_nav.php';
        ?>
        <!-- Main content -->
        <!-- <div class="col offset-1"> -->
        <div class="col ">
            <div class=" container py-4 py-xl-5">
                <h1>Add Destinations</h1>
                <hr>
                <form class="row g-3" action="index.php?controller=Destinations&action=insert_desti" method="post" id="DestinationsForm" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <label for="inputname" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="inputname" required
                            placeholder="Enter destination name"
                            data-parsley-required-message="Name is required"
                            data-parsley-minlength="3"
                            data-parsley-maxlength="100"
                            data-parsley-trigger="change">
                    </div>

                    <div class="col-md-6">
                        <label for="inputimg" class="form-label">Image</label>
                        <input
                            type="file"
                            name="image_path"
                            class="form-control"
                            id="inputimg"
                            required
                            data-parsley-required-message="Image is required"
                            data-parsley-filemimetypes="image/jpeg, image/png"
                            data-parsley-filemimetypes-message="Only JPEG or PNG images are allowed"
                            data-parsley-trigger="change">
                    </div>

                    <div class="col-md-12">
                        <label for="inputtagline" class="form-label">Tagline</label>
                        <textarea
                            class="form-control"
                            name="tagline"
                            id="inputtagline"
                            maxlength="160"
                            required
                            placeholder="Enter a catchy tagline for the destination"
                            data-parsley-required-message="Tagline is required"
                            data-parsley-minlength="10"
                            data-parsley-minlength-message="Tagline must be at least 10 characters"
                            data-parsley-maxlength="160"
                            data-parsley-maxlength-message="Tagline must be at most 160 characters"
                            data-parsley-trigger="keyup"></textarea>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

                <hr>
                <table id="pkg_edit" class="table table-striped table-bordered text-center align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($desti)) : ?>
                            <?php foreach ($desti as $dest) : ?>
                                <tr>
                                    <!-- Image -->

                                    <!-- Package Info -->
                                    <td><?php echo htmlspecialchars($dest['name']); ?></td>
                                    <?php
                                    if ($dest['status'] == 'active') {
                                        $color = 'success';
                                    } else {
                                        $color = 'danger';
                                    }
                                    ?>
                                    <td class="text-<?php echo $color; ?>"><i class="bi bi-circle-fill"></i></td>

                                    <!-- Actions -->
                                    <td class="d-flex justify-content-center align-items-center gap-2">
                                        <!-- View Button -->
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo htmlspecialchars($dest['destination_id']); ?>">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>

                                        <!-- edit Button -->
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo htmlspecialchars($dest['destination_id']); ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <!-- Delete Form -->
                                        <form action="index.php?controller=destinations&action=delete_pkg" method="post" onsubmit="return confirm('Are you sure you want to delete this destination?')" style="margin: 0;">
                                            <input type="hidden" name="destination_id" value="<?php echo htmlspecialchars($dest['destination_id']); ?>">
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- view Modal (placed outside <tr>) -->
                                <div class="modal fade" id="exampleModal<?php echo htmlspecialchars($dest['destination_id']); ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo htmlspecialchars($dest['destination_id']); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel<?php echo htmlspecialchars($dest['destination_id']); ?>">
                                                    <?php echo htmlspecialchars($dest['name']); ?>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <img src="public/img/destinations/<?php echo htmlspecialchars($dest['image_path']); ?>" alt="<?php echo htmlspecialchars($dest['name']); ?>" class="img-fluid mb-3" style="max-height: 300px;">
                                                <p><strong>Tagline: </strong> <?php echo htmlspecialchars($dest['tagline']); ?></p>
                                                <p><strong>Status: </strong> <?php echo htmlspecialchars($dest['status']); ?></p>
                                                <p><strong>created_at: </strong> <?php echo htmlspecialchars($dest['created_at']); ?></p>
                                                <p><strong>updated_at: </strong> <?php echo htmlspecialchars($dest['updated_at']); ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ================================================================================= -->
                                <!-- edit Modal (placed outside <tr>) -->
                                <div class="modal fade" id="editModal<?php echo htmlspecialchars($dest['destination_id']); ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo htmlspecialchars($dest['destination_id']); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel<?php echo htmlspecialchars($dest['destination_id']); ?>">
                                                    Edit: <?php echo htmlspecialchars($dest['name']); ?>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="public/img/destinations/<?php echo htmlspecialchars($dest['image_path']); ?>" alt="<?php echo htmlspecialchars($dest['name']); ?>" class="img-fluid mb-3" style="max-height: 100px;">
                                                <form class="row g-3" action="index.php?controller=Destinations&action=update_dest" method="post" id="myupdateForm" enctype="multipart/form-data">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Image</span>
                                                        <input
                                                            type="file"
                                                            name="image_path"
                                                            class="form-control"
                                                            id="inputimg">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Name</span>
                                                        <input type="text" class="form-control" name="name" id="inputtitlec" required
                                                            data-parsley-required-message="Name is required"
                                                            data-parsley-minlength="3"
                                                            data-parsley-maxlength="100"
                                                            data-parsley-trigger="change"
                                                            value="<?php echo htmlspecialchars($dest['name']); ?>">
                                                    </div>


                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1x">Tagline</span>
                                                        <textarea
                                                            class="form-control"
                                                            name="tagline"
                                                            id="inputshort_description"
                                                            maxlength="160"
                                                            required
                                                            data-parsley-required-message="Short Description is required"
                                                            data-parsley-minlength="10"
                                                            data-parsley-minlength-message="Short Description must be at least 10 characters"
                                                            data-parsley-maxlength="160"
                                                            data-parsley-maxlength-message="Short Description must be at most 160 characters"
                                                            data-parsley-trigger="keyup"><?php echo htmlspecialchars($dest['tagline']); ?></textarea>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Status</span>
                                                        <select class="form-select" name="status" aria-label="Default select example" required>
                                                            <option value="<?php echo htmlspecialchars($dest['status']); ?>" selected><?php echo htmlspecialchars($dest['status']); ?> !! SELECTED</option>
                                                            <option value="active">active</option>
                                                            <option value="inactive">inactive</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="destination_id" value="<?php echo htmlspecialchars($dest['destination_id']); ?>">
                                                <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($dest['image_path']); ?>">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <!-- <tr> -->
                            <p colspan="4" class="text-center">No Photo Found!</p>
                            <!-- </tr> -->
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#DestinationsForm').parsley();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#myupdateForm').parsley();
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