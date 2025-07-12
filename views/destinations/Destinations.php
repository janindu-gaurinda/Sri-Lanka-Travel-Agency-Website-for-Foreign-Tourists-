<div class="container py-5" data-aos="zoom-in-up" data-aos-delay="300">
    <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2 class="fw-bold text-primary">Explore Sri Lanka’s Beauty</h2>
            <p class="text-muted">From misty mountains to golden beaches, discover hand-picked unforgettable destinations across the island.</p>
        </div>
    </div>

    <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
        <?php if (!empty($Get_dest)) : ?>
            <?php foreach ($Get_dest as $dest) : ?>
                <div class="col">
                    <div class="card border-0 shadow-sm h-100">
                        <img class="card-img-top rounded-top img-fluid w-100" style="height: 220px; object-fit: cover;" src="public/img/destinations/<?php echo htmlspecialchars($dest['image_path']); ?>" alt="<?php echo htmlspecialchars($dest['name']); ?>">
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="fw-bold text-dark"><?php echo htmlspecialchars($dest['name']); ?></h5>
                            <p class="text-secondary flex-grow-1"><?php echo htmlspecialchars($dest['tagline']); ?>.</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="text-center">
                <h6>No Destinations Found!</h6>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($totalPages > 1): ?>
        <nav aria-label="Page navigation example" class="mt-5">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controller=destinations&action=index&page=<?php echo $page - 1; ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="index.php?controller=destinations&action=index&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controller=destinations&action=index&page=<?php echo $page + 1; ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>
