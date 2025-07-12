<div class="container py-4 py-xl-5" data-aos="zoom-in-up" data-aos-delay="300">
    <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2 class="fw-bold mb-3">Travel Tips &amp; Stories</h2>
            <p class="w-lg-50 mx-auto text-muted">Get inspired with real travel stories, practical tips, and local secrets to make your Sri Lanka adventure truly unforgettable.</p>
        </div>
    </div>

    <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
        <?php if (!empty($Get_blogs)) : ?>
            <?php foreach ($Get_blogs as $blog) : ?>
                <div class="col" data-bss-hover-animate="bounce">
                    <div class="p-4 border rounded shadow-sm h-100 d-flex flex-column">
                        <span class="badge rounded-pill bg-primary mb-3 align-self-start">Article</span>
                        <h4 class="mb-2"><?php echo htmlspecialchars($blog['title']); ?></h4>
                        <p class="flex-grow-1"><?php echo htmlspecialchars($blog['excerpt']); ?></p>

                        <?php
                        $picture = !empty($blog['profile_pic']) ? $blog['profile_pic'] : "useer.png";
                        ?>

                        <div class="d-flex align-items-center mt-3 pt-3 border-top">
                            <img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="50" height="50" src="public/img/user/<?php echo htmlspecialchars($picture); ?>" alt="Profile Picture">
                            <div>
                                <p class="fw-bold mb-1 mb-sm-0"><?php echo htmlspecialchars($blog['full_name']); ?></p>
                                <a class="btn btn-sm btn-outline-primary" href="index.php?controller=Blog&action=view_blog&blog_id=<?php echo $blog['blog_id']; ?>">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="text-center">
                <h6>No Blogs Found!</h6>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($totalPages > 1): ?>
        <nav aria-label="Page navigation example" class="mt-5">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controller=Blog&action=index&page=<?php echo $page - 1; ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="index.php?controller=Blog&action=index&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controller=Blog&action=index&page=<?php echo $page + 1; ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>
