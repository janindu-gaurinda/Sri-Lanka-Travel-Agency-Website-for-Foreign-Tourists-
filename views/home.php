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
<section>
    <div data-aos="zoom-in-up"
        style="height: 100vh; background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('public/assets/img/udara-karunarathna-PPGM2ZpCrzc-unsplash.jpg') center / cover no-repeat;">

        <div class="container h-100">
            <div class="row h-100">
                <div class="col-md-7 text-center text-md-start d-flex justify-content-center align-items-center" style="background: transparent;">
                    <div class="p-4 rounded-4" style="background: rgba(0, 0, 0, 0.4); max-width: 500px;">
                        <h1 class="text-uppercase fw-bold text-white mb-3" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">
                            Uncover the Wonders of Sri Lanka
                        </h1>
                        <p class="fw-medium text-white mb-4" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.7);">
                            From ancient temples to golden beaches and lush mountains, explore the heart of paradise with expertly guided tours designed just for you.
                        </p>
                        <div class="">
                            <a class="btn btn-primary px-4 py-2 me-2 rounded-pill shadow-sm mb-1 fw-bold" role="button" href="index.php?controller=Package&action=index">
                                Explore Packages
                            </a>
                            <a class="btn btn-warning px-4 py-2 rounded-pill shadow-sm mb-1 fw-bold" role="button" href="index.php?controller=Booking&action=index">
                                Booking
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container py-5" data-aos="zoom-in-up" data-aos-delay="250">
    <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2 class="fw-bold text-primary">Top Rated Packages</h2>
            <p class="text-muted">Discover our most popular experiences curated just for you.</p>
        </div>
    </div>
    <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
        <?php if (!empty($Get_pkg)) : ?>
            <?php foreach ($Get_pkg as $pkg) : ?>
                <div class="col">
                    <div class="card border-0 shadow-sm h-100">
                        <img class="card-img-top w-100 d-block fit-cover rounded-top" loading="lazy" style="height: 220px; object-fit: cover;" src="public/img/pkgz/<?php echo htmlspecialchars($pkg['image_path']); ?>" alt="<?php echo htmlspecialchars($pkg['title']); ?>">
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="fw-bold text-dark"><?php echo htmlspecialchars($pkg['title']); ?></h5>
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
    <div class="d-flex justify-content-center mt-5">
        <a href="index.php?controller=Package&action=index" class="btn btn-primary fw-bold px-4 py-2 rounded-pill shadow-sm">
            More Packages
        </a>
    </div>
</div>

<div class="container-fluid py-5" data-aos="zoom-in-up" data-aos-duration="600" style="background: #f8f9fa;">
    <h1 class="text-center fw-bold text-primary mb-5">Why Travel With Us</h1>
    <div class="row row-cols-1 row-cols-md-2 g-4 align-items-center">
        <div class="col order-md-1 order-2 d-flex flex-column justify-content-center p-4">
            <div class="mb-4">
                <h4 class="fw-bold">Expert Local Guides</h4>
                <p class="text-secondary">Discover hidden gems and cultural treasures with our passionate, knowledgeable local guides who bring Sri Lanka's history and heritage to life.</p>
                <a href="#" class="text-decoration-none fw-medium text-primary">Learn More&nbsp;<i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="mb-4">
                <h4 class="fw-bold">Affordable Prices</h4>
                <p class="text-secondary">Enjoy top-quality experiences without breaking the bank, with transparent and fair pricing on all our packages.</p>
                <a href="#" class="text-decoration-none fw-medium text-primary">Learn More&nbsp;<i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="mb-4">
                <h4 class="fw-bold">24/7 Customer Support</h4>
                <p class="text-secondary">Whether you’re planning your trip or already exploring, our friendly team is available anytime to assist you — day or night.</p>
                <a href="#" class="text-decoration-none fw-medium text-primary">Learn More&nbsp;<i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="mb-4">
                <h4 class="fw-bold">Trusted by Thousands</h4>
                <p class="text-secondary">Join thousands of happy travelers who trust us to deliver unforgettable journeys in Sri Lanka, every single time.</p>
                <a href="#" class="text-decoration-none fw-medium text-primary">Learn More&nbsp;<i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
        <div class="col order-md-2 order-1">
            <img class="rounded shadow w-100 h-100 fit-cover" data-aos="zoom-in" data-aos-duration="2000" style="min-height: 400px; object-fit: cover;" src="public/assets/img/lucija-ros-VC7P8p6dFIc-unsplash.jpg" alt="Why Travel With Us">
        </div>
    </div>
</div>

<div class="container py-5" data-aos="zoom-in-up" data-aos-delay="300">
    <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2 class="fw-bold text-primary">Explore Sri Lanka’s Beauty</h2>
            <p class="text-muted">From misty mountains to golden beaches, discover the soul of our island with hand-picked, unforgettable destinations.</p>
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
    <div class="d-flex justify-content-center mt-5">
        <a href="index.php?controller=Destinations&action=index" class="btn btn-primary fw-bold px-4 py-2 rounded-pill shadow-sm text-decoration-none">
            More Destinations
        </a>
    </div>
</div>
<!-- =============================================================== -->
<div class="container-fluid py-5" data-aos="zoom-in-up" data-aos-delay="250" style="background: url('public/assets/img/j-a-neshan-paul-Qm8q-VUjLqs-unsplash.jpg') center / cover no-repeat; background-blend-mode: overlay; background-color: rgba(0,0,0,0.4);">
    <div class="row gy-4 gy-md-0 m-0">
        <div class="col-md-6 p-0">
            <div class="p-3 p-xl-5">
                <img class="rounded shadow img-fluid w-100" style="min-height: 300px; object-fit: cover;" src="public/assets/img/6158975565252643142.jpg" alt="Custom Trip">
            </div>
        </div>
        <div class="col-md-6 d-md-flex align-items-md-center p-0">
            <div class="text-white p-4" style="max-width: 450px;">
                <h2 class="text-uppercase fw-bold">Plan Your Custom Trip</h2>
                <p class="my-3"><strong>Design your perfect Sri Lankan adventure – your way.</strong><br>Whether you're dreaming of golden beaches, misty mountains, ancient temples, or wildlife safaris, we’ll tailor a unique itinerary just for you. Tell us what you love, and we’ll handle the rest.</p>
                <a class="btn btn-warning fw-bold px-4 py-2 rounded-pill shadow-sm text-decoration-none" role="button" href="#">
                    Start Planning
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================ -->
<div class="container py-5" data-aos="zoom-in-up" data-aos-delay="300">
    <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2 class="fw-bold text-primary">Travel Tips &amp; Stories</h2>
            <p class="text-muted">Get inspired with real travel stories, practical tips, and local secrets to make your Sri Lanka adventure truly unforgettable.</p>
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

    <div class="d-flex justify-content-center mt-5 gap-3">
        <a href="index.php?controller=Blog&action=write_blog"
            class="btn btn-primary fw-bold px-4 py-2 rounded-pill shadow-sm text-decoration-none">
            Write Your Own Travel Story
        </a>
        <a href="index.php?controller=Blog&action=index"
            class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow-sm text-decoration-none">
            More Travel Tips & Stories
        </a>
    </div>

</div>

<!-- =================================================================== -->
<div class="container py-4 py-xl-5" data-aos="zoom-in-up" data-aos-delay="250">
    <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2 class="fw-bold">What Our Travelers Say</h2>
        </div>
    </div>

    <div class="row gy-4 row-cols-1 row-cols-sm-2 row-cols-lg-3">
        <?php if (!empty($Get_fd)) : ?>
            <?php foreach ($Get_fd as $feedbk) : ?>
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
                                    include 'feedback/country.php';

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

  <div class="d-flex justify-content-center mt-5 gap-2">
    <a href="index.php?controller=Feedback&action=write_feedback" 
       class="btn btn-primary fw-bold px-4 py-2 rounded-pill shadow-sm text-decoration-none">
        Write Your Feedback
    </a>
    <a href="index.php?controller=Feedback&action=index" 
       class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow-sm text-decoration-none">
        More Reviews
    </a>
</div>

</div>

<!-- =============================================================== -->
<br>
<section class="position-relative py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="row g-0 shadow rounded overflow-hidden">
            <!-- Map -->
            <div class="col-md-6">
                <iframe
                    src="https://www.google.com/maps/place/Colombo/@6.922002,79.7738026,12z/data=!3m1!4b1!4m6!3m5!1s0x3ae253d10f7a7003:0x320b2e4d32d3838d!8m2!3d6.9270786!4d79.861243!16zL20vMGZuN3I?entry=ttu&g_ep=EgoyMDI1MDcwOC4wIKXMDSoASAFQAw%3D%3D"
                    width="100%"
                    height="100%"
                    style="border:0; min-height: 400px;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>

            <!-- Form -->
            <div class="col-md-6 bg-white p-4 p-lg-5 d-flex flex-column justify-content-center">
                <h3 class="mb-3">Contact Us</h3>
                <p class="text-muted mb-4">We’d love to hear your thoughts or help plan your next adventure.</p>
                <form method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Type your message..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- =============================================================== -->