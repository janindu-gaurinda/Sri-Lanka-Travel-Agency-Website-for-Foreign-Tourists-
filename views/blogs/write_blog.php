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


?>
<div class="container py-5" data-aos="zoom-in-up" data-aos-delay="300">
    <div class="row mb-1">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2 class="fw-bold mb-3 text-primary">Write Your Own Travel Story</h2>
            <p class="text-muted fs-6">Share your unforgettable experience with us. Your story might inspire thousands of future travelers!</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 p-4 bg-white rounded-4">
                <form action="index.php?controller=Blog&action=write_blog_insert" method="post" id="writ_blog_form" enctype="multipart/form-data" novalidate>

                    <!-- Story Title -->
                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold fs-6">Story Title</label>
                        <input
                            type="text" name="title" id="title"
                            class="form-control border-primary"
                            placeholder="E.g., My Magical Train Ride to Ella"
                            required minlength="3" maxlength="30">
                    </div>

                    <!-- Short Introduction -->
                    <div class="mb-4">
                        <label for="excerpt" class="form-label fw-semibold fs-6">Short Introduction</label>
                        <textarea
                            name="excerpt" id="excerpt"
                            class="form-control border-primary" rows="3"
                            placeholder="A quick introduction or summary..."
                            maxlength="160" required minlength="10"></textarea>
                        <div class="form-text">Max 160 characters.</div>
                    </div>

                    <!-- Cover Image -->
                    <div class="mb-4">
                        <label for="image_path" class="form-label fw-semibold fs-6">Cover Image</label>
                        <input
                            type="file" name="image_path" id="image_path"
                            class="form-control border-primary"
                            accept="image/jpeg, image/png" required>
                        <div class="form-text">Only JPEG or PNG images allowed.</div>
                    </div>

                    <!-- Full Story -->
                    <div class="mb-5">
                        <label for="content" class="form-label fw-semibold fs-6">Full Story</label>
                        <textarea
                            name="content" id="content"
                            class="form-control border-primary" rows="7"
                            placeholder="Write your full travel story here..."
                            required minlength="200" maxlength="1600"></textarea>
                        <div class="form-text">Between 200 and 1600 characters.</div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-lg">Submit My Story</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>