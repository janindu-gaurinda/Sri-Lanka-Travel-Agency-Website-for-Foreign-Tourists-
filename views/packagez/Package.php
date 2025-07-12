<div class="container py-5" data-aos="zoom-in-up" data-aos-delay="250">
    <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2 class="fw-bold text-primary">Top Rated Packages</h2>
            <p class="text-muted">Explore our best-selling tours and discover your next adventure in Sri Lanka.</p>
        </div>
    </div>
    <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
        <?php if (!empty($Get_pkg)) : ?>
            <?php foreach ($Get_pkg as $pkg) : ?>
                <div class="col">
                    <div class="card border-0 shadow-sm h-100">
                        <img class="card-img-top w-100 d-block rounded-top" loading="lazy" style="height: 220px; object-fit: cover;" src="public/img/pkgz/<?php echo htmlspecialchars($pkg['image_path']); ?>" alt="<?php echo htmlspecialchars($pkg['title']); ?>">
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="fw-bold text-dark mb-1"><?php echo htmlspecialchars($pkg['title']); ?></h5>
                            <h6 class="text-muted mb-2">Duration: <?php echo htmlspecialchars($pkg['duration']); ?></h6>
                            <p class="flex-grow-1 text-secondary"><?php echo htmlspecialchars($pkg['short_description']); ?>.</p>
                            <h5 class="fw-bold text-success">LKR <?php echo number_format($pkg['price'], 2); ?></h5>
                            <div class="mt-3">
                                <a class="btn btn-warning btn-sm rounded-pill w-100" role="button" href="index.php?controller=Booking&action=index">Booking</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="text-center">
                <h6 class="text-center">No Packages Found!</h6>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($totalPages > 1): ?>
        <nav aria-label="Page navigation example" class="mt-5">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controller=Package&action=index&page=<?php echo $page - 1; ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="index.php?controller=Package&action=index&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controller=Package&action=index&page=<?php echo $page + 1; ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>
