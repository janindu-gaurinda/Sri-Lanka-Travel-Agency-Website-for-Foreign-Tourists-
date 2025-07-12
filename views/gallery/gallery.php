<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gallery Masonry</title>
  <!-- Glightbox CSS -->
  <style>
    .masonry {
      column-count: 3;
      column-gap: 1rem;
    }

    .masonry-item {
      break-inside: avoid;
      margin-bottom: 1rem;
      display: block;
    }

    .masonry-item img {
      width: 100%;
      height: auto;
      border-radius: 6px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    @media (max-width: 768px) {
      .masonry {
        column-count: 2;
      }
    }

    @media (max-width: 480px) {
      .masonry {
        column-count: 1;
      }
    }
  </style>
</head>

<body>

  <div class="container py-4" data-aos="zoom-in-up">
    <div class="masonry">
      <?php if (!empty($Get_images)) : ?>
        <?php foreach ($Get_images as $img) : ?>
          <a href="public/img/gallery/<?php echo htmlspecialchars($img['file_path']); ?>"
            data-aos="zoom-in-up"
            data-aos-delay="250"
            class="glightbox masonry-item"
            data-gallery="gallery1"
            data-title="<?php echo htmlspecialchars($img['title']); ?>">
            <img src="public/img/gallery/<?php echo htmlspecialchars($img['file_path']); ?>"
              alt="<?php echo htmlspecialchars($img['title']); ?>"
              loading="lazy">
          </a>
        <?php endforeach; ?>
      <?php else : ?>
        <p class="mb-4 text-center">No Photo Found!</p>
      <?php endif; ?>
    </div>

  </div>

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


</body>

</html>