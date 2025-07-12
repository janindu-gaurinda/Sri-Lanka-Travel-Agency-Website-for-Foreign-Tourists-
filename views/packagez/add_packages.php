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
                <h1 class="mb-3">Add Packages</h1>
                <hr>
                <form class="row g-3" action="index.php?controller=Package&action=insert_package" method="post" id="myForm" enctype="multipart/form-data">

                    <div class="col-md-4">
                        <label for="inputtitle" class="form-label fw-bold">Title</label>
                        <input type="text" class="form-control" name="title" id="inputtitle" placeholder="Enter package title" required
                            data-parsley-required-message="Title is required"
                            data-parsley-minlength="3"
                            data-parsley-maxlength="100"
                            data-parsley-trigger="change">
                    </div>

                    <div class="col-md-4">
                        <label for="inputimg" class="form-label fw-bold">Image</label>
                        <input type="file" name="image_path" class="form-control" id="inputimg" required
                            data-parsley-required-message="Image is required"
                            data-parsley-filemimetypes="image/jpeg, image/png"
                            data-parsley-filemimetypes-message="Only JPEG or PNG images are allowed"
                            data-parsley-trigger="change">
                    </div>

                    <div class="col-md-4">
                        <label for="inputduration" class="form-label fw-bold">Duration</label>
                        <input type="text" name="duration" class="form-control" id="inputduration" placeholder="E.g., 3 Days" required
                            data-parsley-required-message="Duration is required"
                            data-parsley-minlength="1"
                            data-parsley-maxlength="50"
                            data-parsley-trigger="change">
                    </div>

                    <div class="col-md-4">
                        <label for="inputprice" class="form-label fw-bold">Price</label>
                        <input type="text" name="price" class="form-control" id="inputprice" placeholder="E.g., 30000" required
                            data-parsley-required-message="Price is required"
                            data-parsley-type="number"
                            data-parsley-min="0"
                            data-parsley-trigger="change">
                    </div>

                    <div class="col-md-8">
                        <label for="inputshort_description" class="form-label fw-bold">Short Description</label>
                        <textarea class="form-control" name="short_description" id="inputshort_description" placeholder="Write a short description (max 160 characters)" maxlength="160" required
                            data-parsley-required-message="Short Description is required"
                            data-parsley-minlength="10"
                            data-parsley-minlength-message="Short Description must be at least 10 characters"
                            data-parsley-maxlength="160"
                            data-parsley-maxlength-message="Short Description must be at most 160 characters"
                            data-parsley-trigger="keyup"></textarea>
                    </div>

                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn btn-primary fw-bold px-4 py-2 rounded-pill shadow-sm">Submit</button>
                    </div>
                </form>

                <hr>
                <table id="pkg_edit" class="table table-striped table-bordered text-center align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Duration</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($Get_pkg)) : ?>
                            <?php foreach ($Get_pkg as $pkg) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($pkg['title']); ?></td>
                                    <td><?php echo htmlspecialchars($pkg['duration']); ?></td>
                                    <td>LKR <?php echo number_format($pkg['price'], 2); ?></td>

                                    <?php
                                    $color = ($pkg['status'] == 'active') ? 'success' : 'danger';
                                    ?>
                                    <td class="text-<?php echo $color; ?>">
                                        <i class="bi bi-circle-fill"></i>
                                    </td>

                                    <td class="d-flex justify-content-center align-items-center gap-2">
                                        <!-- View Button -->
                                        <button type="button" class="btn btn-primary btn-sm" title="View" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo htmlspecialchars($pkg['package_id']); ?>">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>

                                        <!-- Edit Button -->
                                        <button type="button" class="btn btn-success btn-sm" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal<?php echo htmlspecialchars($pkg['package_id']); ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <!-- Delete Form -->
                                        <form action="index.php?controller=Package&action=delete_pkg" method="post" onsubmit="return confirm('Are you sure you want to delete this Package?')" class="m-0">
                                            <input type="hidden" name="package_id" value="<?php echo htmlspecialchars($pkg['package_id']); ?>">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>


                                <!-- view Modal (placed outside <tr>) -->
                                <div class="modal fade" id="exampleModal<?php echo htmlspecialchars($pkg['package_id']); ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo htmlspecialchars($pkg['package_id']); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel<?php echo htmlspecialchars($pkg['package_id']); ?>">
                                                    <?php echo htmlspecialchars($pkg['title']); ?>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <img src="public/img/pkgz/<?php echo htmlspecialchars($pkg['image_path']); ?>" alt="<?php echo htmlspecialchars($pkg['title']); ?>" class="img-fluid mb-3" style="max-height: 300px;">
                                                <p><strong>Duration:</strong> <?php echo htmlspecialchars($pkg['duration']); ?></p>
                                                <p><strong>Price:</strong> LKR <?php echo number_format($pkg['price'], 2); ?></p>
                                                <p><strong>Description:</strong> LKR <?php echo htmlspecialchars($pkg['short_description']); ?></p>
                                                <p><strong>Status:</strong><?php echo htmlspecialchars($pkg['status']); ?></p>
                                                <p><strong>created_at:</strong><?php echo htmlspecialchars($pkg['created_at']); ?></p>
                                                <p><strong>updated_at:</strong><?php echo htmlspecialchars($pkg['updated_at']); ?></p>
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
                                <div class="modal fade" id="editModal<?php echo htmlspecialchars($pkg['package_id']); ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo htmlspecialchars($pkg['package_id']); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel<?php echo htmlspecialchars($pkg['package_id']); ?>">
                                                    Edit: <?php echo htmlspecialchars($pkg['title']); ?>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="public/img/pkgz/<?php echo htmlspecialchars($pkg['image_path']); ?>" alt="<?php echo htmlspecialchars($pkg['title']); ?>" class="img-fluid mb-3" style="max-height: 100px;">
                                                <form class="row g-3" action="index.php?controller=Package&action=update_pkg" method="post" id="myupdateForm" enctype="multipart/form-data">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Image</span>
                                                        <input
                                                            type="file"
                                                            name="image_path"
                                                            class="form-control"
                                                            id="inputimg">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Title</span>
                                                        <input type="text" class="form-control" name="title" id="inputtitlec" required
                                                            data-parsley-required-message="Title is required"
                                                            data-parsley-minlength="3"
                                                            data-parsley-maxlength="100"
                                                            data-parsley-trigger="change"
                                                            value="<?php echo htmlspecialchars($pkg['title']); ?>">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Duration</span>
                                                        <input type="text" name="duration" class="form-control" id="inputdurationc" required
                                                            data-parsley-required-message="Duration is required"
                                                            data-parsley-minlength="1"
                                                            data-parsley-maxlength="50"
                                                            data-parsley-trigger="change"
                                                            value="<?php echo htmlspecialchars($pkg['duration']); ?>">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Price (LKR)</span>
                                                        <input type="text" name="price" class="form-control" id="inputpricec" required
                                                            data-parsley-required-message="Price is required"
                                                            data-parsley-type="number"
                                                            data-parsley-min="0"
                                                            data-parsley-trigger="change"
                                                            value="<?php echo htmlspecialchars($pkg['price']); ?>">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1x">Short Description</span>
                                                        <textarea
                                                            class="form-control"
                                                            name="short_description"
                                                            id="inputshort_description"
                                                            maxlength="160"
                                                            required
                                                            data-parsley-required-message="Short Description is required"
                                                            data-parsley-minlength="10"
                                                            data-parsley-minlength-message="Short Description must be at least 10 characters"
                                                            data-parsley-maxlength="160"
                                                            data-parsley-maxlength-message="Short Description must be at most 160 characters"
                                                            data-parsley-trigger="keyup"><?php echo htmlspecialchars($pkg['short_description']); ?></textarea>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Status</span>
                                                        <select class="form-select" name="status" aria-label="Default select example" required>
                                                            <option value="<?php echo htmlspecialchars($pkg['status']); ?>" selected><?php echo htmlspecialchars($pkg['status']); ?> !! SELECTED</option>
                                                            <option value="active">active</option>
                                                            <option value="inactive">inactive</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($pkg['package_id']); ?>">
                                                <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($pkg['image_path']); ?>">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#myupdateForm').parsley();
                                                    });
                                                </script>
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
    <!-- Parsley CSS (optional but recommended for default styles) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.3/parsley.css" integrity="sha512-gX3H8t9GZq6L1OPNfM2r3b0XtkMg3wWey0gf6rZmc5AA8ccO2yBxiymPG/AMU8UPd9MPMCI9T9fSyQld3GEExA==" crossorigin="anonymous" />

<!-- jQuery (must be included first) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Parsley JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.3/parsley.min.js" integrity="sha512-bAk1RSGPL3v8XvkskWoqA6QgeSNY3+eZOnXuqEO/vTrQOPN0BPf9cNs7UBGPGMBZ+ZlYyIVS2eoq6t6M1phsLQ==" crossorigin="anonymous"></script>

    <script>
        
        $(document).ready(function() {
            $('#myForm').parsley();
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
    