<div class="container py-4 py-xl-5" data-aos="zoom-in-up" data-aos-delay="250">
    <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2 class="fw-bold">What Our Travelers Say</h2>
        </div>
    </div>

    <div class="row gy-4 row-cols-1 row-cols-sm-2 row-cols-lg-3">
        <?php if (!empty($Get_fb)) : ?>
            <?php foreach ($Get_fb as $feedbk) : ?>
                <div class="col">
                    <div class="border rounded shadow-sm bg-white p-4 h-100 d-flex flex-column justify-content-between">
                        <p class="text-muted flex-grow-1 mb-3"><?php echo htmlspecialchars($feedbk['review_text']); ?></p>
                        <div class="d-flex align-items-center mt-3 pt-3 border-top">
                            <img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="50" height="50" src="public/img/user/<?php echo htmlspecialchars($feedbk['profile_pic']); ?>" alt="Reviewer">
                            <div>
                                <p class="fw-bold text-primary mb-1">
                                    <?php echo htmlspecialchars($feedbk['full_name'] ?? 'Anonymous'); ?>
                                </p>
                                <p class="text-muted mb-0">
                                    <?php
                                    include 'country.php';
                                    $code = strtolower($feedbk['country']);
                                    $codeUpper = strtoupper($feedbk['country']);

                                    if (isset($countryList[$codeUpper])) {
                                        $countryName = $countryList[$codeUpper]['name'];
                                        echo '<img src="https://flagcdn.com/24x18/' . $code . '.webp" alt="flag"> ' . htmlspecialchars($countryName);
                                    } else {
                                        echo '<span>' . htmlspecialchars($codeUpper) . '</span>';
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center">No feedback available.</p>
        <?php endif; ?>
    </div>

    <?php if ($totalPages > 1): ?>
        <nav aria-label="Page navigation example" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controller=feedback&action=index&page=<?php echo $page - 1; ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="index.php?controller=feedback&action=index&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controller=feedback&action=index&page=<?php echo $page + 1; ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>
