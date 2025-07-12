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
                <h1>Add Travel Tips & Stories</h1>
                <hr>
                <form class="row g-3" action="index.php?controller=Blog&action=insert_blog" method="post" id="blog_form" enctype="multipart/form-data">
                    <!-- Title -->
                    <div class="col-md-6">
                        <label for="inputtitle" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="inputtitle" required
                            placeholder="Enter blog title"
                            data-parsley-required-message="Title is required"
                            data-parsley-minlength="3"
                            data-parsley-maxlength="30"
                            data-parsley-trigger="change">
                    </div>

                    <!-- Image -->
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

                    <!-- Excerpt -->
                    <div class="col-md-12">
                        <label for="input_excerpt" class="form-label">Excerpt</label>
                        <textarea
                            class="form-control"
                            name="excerpt"
                            id="input_excerpt"
                            maxlength="600"
                            rows="4"
                            required
                            placeholder="Write a brief excerpt (10 to 160 characters)"
                            data-parsley-required-message="Excerpt is required"
                            data-parsley-minlength="10"
                            data-parsley-minlength-message="Excerpt must be at least 10 characters"
                            data-parsley-maxlength="160"
                            data-parsley-maxlength-message="Excerpt must be at most 160 characters"
                            data-parsley-trigger="keyup"></textarea>
                    </div>

                    <!-- Content -->
                    <div class="col-md-12">
                        <label for="input_content" class="form-label">Content</label>
                        <textarea
                            rows="4"
                            class="form-control"
                            name="content"
                            id="input_content"
                            maxlength="1600"
                            required
                            rows="4"
                            placeholder="Write detailed content (200 to 1600 characters)"
                            data-parsley-required-message="Content is required"
                            data-parsley-minlength="200"
                            data-parsley-minlength-message="Content must be at least 200 characters"
                            data-parsley-maxlength="1600"
                            data-parsley-maxlength-message="Content must be at most 1600 characters"
                            data-parsley-trigger="keyup"></textarea>
                    </div>

                    <!-- Submit button -->
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

                <hr>
                <table id="pkg_edit" class="table table-striped table-bordered text-center align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Submited by</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($Get_blog)) : ?>
                            <?php foreach ($Get_blog as $blog) : ?>
                                <tr>
                                    <!-- Image -->

                                    <!-- Package Info -->
                                    <td><?php echo htmlspecialchars($blog['title']); ?></td>
                                    <td><?php echo htmlspecialchars($blog['full_name']); ?></td>
                                    <?php
                                    if ($blog['status'] == 'active') {
                                        $color = 'success';
                                    } else {
                                        $color = 'danger';
                                    }
                                    ?>
                                    <td class="text-<?php echo $color; ?>"><i class="bi bi-circle-fill"></i></td>

                                    <!-- Actions -->
                                    <td class="d-flex justify-content-center align-items-center gap-2">
                                        <!-- View Button -->
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo htmlspecialchars($blog['blog_id']); ?>">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>

                                        <!-- edit Button -->
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo htmlspecialchars($blog['blog_id']); ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <!-- Delete Form -->
                                        <form action="index.php?controller=Blog&action=delete_blog" method="post" onsubmit="return confirm('Are you sure you want to delete this Package?')" style="margin: 0;">
                                            <input type="hidden" name="blog_id" value="<?php echo htmlspecialchars($blog['blog_id']); ?>">
                                            <input type="hidden" name="link" value="Crud_blog">
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- view Modal (placed outside <tr>) -->
                                <div class="modal fade" id="exampleModal<?php echo htmlspecialchars($blog['blog_id']); ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo htmlspecialchars($blog['blog_id']); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel<?php echo htmlspecialchars($blog['blog_id']); ?>">
                                                    <?php echo htmlspecialchars($blog['title']); ?>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <img src="public/img/blog/<?php echo htmlspecialchars($blog['thumbnail']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" class="img-fluid mb-3" style="max-height: 300px;">
                                                <p><strong>Title:</strong> <?php echo htmlspecialchars($blog['title']); ?></p>
                                                <p><strong>Excerpt:</strong> <?php echo htmlspecialchars($blog['excerpt']); ?></p>
                                                <p><strong>Content:</strong><?php echo nl2br(htmlspecialchars($blog['content'])); ?></p>
                                                <p><strong>submitted_by:</strong><?php echo htmlspecialchars($blog['full_name']); ?></p>
                                                <p><strong>Status:</strong><?php echo htmlspecialchars($blog['status']); ?></p>
                                                <p><strong>created_at:</strong><?php echo htmlspecialchars($blog['created_at']); ?></p>
                                                <p><strong>updated_at:</strong><?php echo htmlspecialchars($blog['updated_at']); ?></p>
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
                                <div class="modal fade" id="editModal<?php echo htmlspecialchars($blog['blog_id']); ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo htmlspecialchars($blog['blog_id']); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel<?php echo htmlspecialchars($blog['blog_id']); ?>">
                                                    Edit: <?php echo htmlspecialchars($blog['title']); ?>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="public/img/blog/<?php echo htmlspecialchars($blog['thumbnail']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" class="img-fluid mb-3" style="max-height: 100px;">
                                                <form class="row g-3" action="index.php?controller=blog&action=update_blog" method="post" id="myupdateForm" enctype="multipart/form-data">
                                                    <!-- <==================================================================--  -->

                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Image</span>
                                                        <input
                                                            type="file"
                                                            name="image_path"
                                                            class="form-control"
                                                            id="inputimg"

                                                            data-parsley-required-message="Image is required"
                                                            data-parsley-filemimetypes="image/jpeg, image/png"
                                                            data-parsley-filemimetypes-message="Only JPEG or PNG images are allowed"
                                                            data-parsley-trigger="change">
                                                    </div>
                                                    <!-- <==================================================================--  -->
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Title</span>
                                                        <input type="text" class="form-control" name="title" id="inputtitle" required
                                                            data-parsley-required-message="Title is required"
                                                            data-parsley-minlength="3"
                                                            data-parsley-maxlength="30"
                                                            data-parsley-trigger="change"
                                                            value="<?php echo htmlspecialchars($blog['title']); ?>">
                                                    </div>
                                                    <!-- <==================================================================--  -->
                                                    <div class="input-group mb-3">

                                                        <span class="input-group-text" id="basic-addon1">Excerpt</span>
                                                        <textarea
                                                            class="form-control"
                                                            name="excerpt"
                                                            id="input_excerpt"
                                                            rows="3"
                                                            maxlength="160"
                                                            required
                                                            data-parsley-required-message="Excerpt is required"
                                                            data-parsley-minlength="10"
                                                            data-parsley-minlength-message="Excerpt must be at least 10 characters"
                                                            data-parsley-maxlength="160"
                                                            data-parsley-maxlength-message="Excerpt must be at most 160 characters"
                                                            data-parsley-trigger="keyup"><?php echo htmlspecialchars($blog['excerpt']); ?></textarea>
                                                    </div>
                                                    <!-- <==================================================================--  -->
                                                    <div class="input-group mb-3">

                                                        <span class="input-group-text" id="basic-addon1">Content</span>
                                                        <textarea
                                                            class="form-control"
                                                            name="content"
                                                            id="input_content"
                                                            rows="4"
                                                            maxlength="1600"
                                                            required
                                                            data-parsley-required-message="Content is required"
                                                            data-parsley-minlength="200"
                                                            data-parsley-minlength-message="Content must be at least 200 characters"
                                                            data-parsley-maxlength="1600"
                                                            data-parsley-maxlength-message="Content must be at most 1600 characters"
                                                            data-parsley-trigger="keyup"><?php echo htmlspecialchars($blog['content']); ?></textarea>
                                                        <!-- <==================================================================--  -->
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Status</span>
                                                        <select class="form-select" name="status" aria-label="Default select example" required>
                                                            <option value="<?php echo htmlspecialchars($blog['status']); ?>" selected><?php echo htmlspecialchars($blog['status']); ?> !! SELECTED</option>
                                                            <option value="active">active</option>
                                                            <option value="inactive">inactive</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="blog_id" value="<?php echo htmlspecialchars($blog['blog_id']); ?>">
                                                <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($blog['thumbnail']); ?>">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <input type="hidden" name="link" value="Crud_blog">
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