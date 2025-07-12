<div class="container my-5" data-aos="fade-up" data-aos-delay="200">
    <a href="javascript:history.back()" class="btn btn-outline-primary mb-4">← Go Back</a>

    <div class="card shadow border-0 bg-light p-4">
        <div class="row g-4 align-items-center">
            <div class="col-md-6">
                <img src="public/img/blog/<?php echo htmlspecialchars($blog['thumbnail']); ?>"
                    alt="<?php echo htmlspecialchars($blog['title']); ?>"
                    class="img-fluid rounded w-100"
                    style="object-fit: cover; max-height: 350px;">
            </div>
            <div class="col-md-6">
                <h3 class="fw-bold"><?php echo htmlspecialchars($blog['title']); ?></h3>
                <p class="text-muted"><?php echo htmlspecialchars($blog['excerpt']); ?></p>
            </div>
        </div>

        <div class="mt-4">
            <p class="card-text" style="line-height: 1.7;"><?php echo nl2br(htmlspecialchars($blog['content'])); ?></p>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 d-flex align-items-center">
                <?php
                $picture = !empty($blog['profile_pic']) ? $blog['profile_pic'] : "useer.png";
                ?>
                <img class="rounded-circle me-3" width="60" height="60" style="object-fit: cover;" src="public/img/user/<?php echo htmlspecialchars($picture); ?>" alt="Author">
                <div>
                    <p class="fw-bold mb-0"><?php echo htmlspecialchars($blog['full_name']); ?></p>
                    <small class="text-muted">Published on <?php echo htmlspecialchars($blog['created_at']); ?></small>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="javascript:history.back()" class="btn btn-outline-primary">← Go Back</a>
        </div>
    </div>
</div>
