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
                    <h3>Add New Image</h3>
                    <div class="container my-4">
                        <hr>
                        <form class="row g-3" action="index.php?controller=Gallery&action=insert_img" method="post" enctype="multipart/form-data" novalidate>
                            <div class="col-md-6">
                                <label for="input_img" class="form-label">Image</label>
                                <input
                                    type="file"
                                    name="img"
                                    class="form-control"
                                    id="input_img"
                                    accept="image/*"
                                    required
                                    aria-describedby="imgHelp">
                                <div id="imgHelp" class="form-text">Upload JPEG or PNG image.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="input_title" class="form-label">Title</label>
                                <input
                                    type="text"
                                    name="title"
                                    class="form-control"
                                    id="input_title"
                                    required
                                    minlength="3"
                                    maxlength="100"
                                    placeholder="Enter image title">
                            </div>
                            <div class="col-md-6">
                                <label for="input_description" class="form-label">Description</label>
                                <input
                                    type="text"
                                    name="description"
                                    class="form-control"
                                    id="input_description"
                                    required
                                    minlength="5"
                                    maxlength="255"
                                    placeholder="Enter image description">
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </div>
                        </form>
                    </div>

                    <hr>
                    <br>

                    <table id="gallery_edit" class="table table-striped table-bordered text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Image</th>
                                <th class="text-center">Name</th>

                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($Get_images)) : ?>
                                <?php foreach ($Get_images as $img) : ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <a href="public/img/gallery/<?php echo htmlspecialchars($img['file_path']); ?>" class="glightbox masonry-item" data-title="Image 6">
                                                <img src="public/img/gallery/<?php echo htmlspecialchars($img['file_path']); ?>" alt="Image 6" loading="lazy" style="height: 50px; width: 50px;">
                                            </a>
                                        </td>
                                        <td><?php echo htmlspecialchars($img['title']); ?></td>
                                        <td>
                                            <form action="index.php?controller=Gallery&action=delete_img" method="post" onclick="return confirm('Are you sure you want to delete this image?')">
                                                <button type="submit" name="gallery_id" class="btn btn-danger" value="<?php echo htmlspecialchars($img['gallery_id']); ?>">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p class="mb-4 text-center">No Photo Found!</p>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        hideOverlay();
    }, 5000);

    function hideOverlay() {
        const overlay = document.getElementById('overlay');
        if (overlay) {
            overlay.remove(); // or overlay.style.display = 'none';
        }
    }
</script>
<!-- Glightbox JS -->
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