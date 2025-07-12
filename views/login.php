<?php
$success = $_SESSION['success'] ?? '';
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['success'], $_SESSION['errors'], $_SESSION['old']);
?>
<div class="z-3 position-absolute pt-5 rounded-3" style="left: 50%; transform: translateX(-50%);">
    <?php if (!empty($success) || !empty($errors)): ?>
        <div id="overlay" class="overlay d-flex justify-content-center">
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
<div class="container py-5 text-dark">
  <div class="row gx-5 align-items-center">

    <!-- Left Image -->
    <div class="col-md-6 mb-4 mb-md-0 text-center">
      <img 
        src="public/assets/img/annie-spratt-qyAka7W5uMY-unsplash.jpg" 
        alt="Travel Image" 
        class="rounded shadow-lg img-fluid"
        style="max-height: 400px; object-fit: cover;"
        loading="lazy"
        data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="200" data-aos-once="true"
      >
    </div>

    <!-- Right Form Tabs -->
    <div class="col-md-6">
      <ul class="nav nav-tabs mb-4" id="authTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active fw-bold" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">
            Login
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link fw-bold" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup" type="button" role="tab" aria-controls="signup" aria-selected="false">
            Sign Up
          </button>
        </li>
      </ul>

      <div class="tab-content" id="authTabContent">

        <!-- Login Tab -->
        <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab" tabindex="0">
          <h2 class="mb-4 text-center">Log in</h2>

          <form action="index.php?controller=Login&action=login" method="post" class="needs-validation" novalidate>
            <div class="mb-3">
              <input type="email" name="email" class="form-control form-control-md" placeholder="Email" required>
              <div class="invalid-feedback">Please enter your email.</div>
            </div>

            <div class="mb-3 position-relative">
              <input type="password" name="password" id="loginPassword" value="1234567@abcABC" class="form-control form-control-md" placeholder="Password" required>
              <div class="invalid-feedback">Please enter your password.</div>
              <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="showLoginPassword" onclick="toggleLoginPassword()">
                <label class="form-check-label" for="showLoginPassword">Show Password</label>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">Login</button>
            <div class="text-center">
              <a href="#" class="text-decoration-none">Forgot your password?</a>
            </div>
          </form>
        </div>

        <!-- Sign Up Tab -->
        <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab" tabindex="0">
          <h2 class="mb-4 text-center">Sign Up</h2>

          <form action="index.php?controller=Login&action=signin" method="post" class="needs-validation" novalidate id="signupForm">
            <div class="mb-3">
              <input type="text" name="full_name" class="form-control form-control-md" placeholder="Full Name" required>
              <div class="invalid-feedback">Please enter your full name.</div>
            </div>

            <div class="mb-3">
              <input type="email" name="email" class="form-control form-control-md" placeholder="Email" required>
              <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>

            <div class="mb-3 position-relative">
              <input type="password" name="password" id="signupPassword" value="1234567@abcABC" class="form-control form-control-md" placeholder="Password" required minlength="6">
              <div class="invalid-feedback">Password must be at least 6 characters long.</div>
            </div>

            <div class="mb-3 position-relative">
              <input type="password" name="re_password" value="1234567@abcABC" id="signupRePassword" class="form-control form-control-md" placeholder="Confirm Password" required>
              <div class="invalid-feedback">Passwords must match.</div>

              <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="showSignupPassword" onclick="toggleSignupPassword()">
                <label class="form-check-label" for="showSignupPassword">Show Password</label>
              </div>
            </div>

            <button type="submit" class="btn btn-success btn-lg w-100">Sign Up</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- 
<script>
  // Toggle password visibility for login
  function toggleLoginPassword() {
    const pwd = document.getElementById('loginPassword');
    pwd.type = pwd.type === 'password' ? 'text' : 'password';
  }

  // Toggle password visibility for signup
  function toggleSignupPassword() {
    const pwd = document.getElementById('signupPassword');
    const repwd = document.getElementById('signupRePassword');
    pwd.type = pwd.type === 'password' ? 'text' : 'password';
    repwd.type = repwd.type === 'password' ? 'text' : 'password';
  }

  // Bootstrap 5 validation example
  (() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity() || (form.id === 'signupForm' && document.getElementById('signupPassword').value !== document.getElementById('signupRePassword').value)) {
          event.preventDefault();
          event.stopPropagation();
          if(form.id === 'signupForm') {
            document.getElementById('signupRePassword').setCustomValidity('Passwords do not match.');
          }
          form.classList.add('was-validated');
        } else {
          if(form.id === 'signupForm') {
            document.getElementById('signupRePassword').setCustomValidity('');
          }
        }
      }, false);
    });
  })()
</script> -->




<!-- ✅ jQuery (Required for Parsley.js) -->
<script src="public/js/jquery.min.js"></script>

<!-- ✅ Parsley.js -->
<script src="public/js/parsley.min.js"></script>
<!-- ✅ Initialize Parsley -->

<script>
    $(document).ready(function() {
        $('#myForm').parsley();
    });

    function toggleLoginPassword() {
        const input = document.getElementById("loginPassword");
        input.type = input.type === "password" ? "text" : "password";
    }

    function toggleSignupPassword() {
        const pwd = document.getElementById("signupPassword");
        const rePwd = document.getElementById("signupRePassword");
        const type = pwd.type === "password" ? "text" : "password";
        pwd.type = type;
        rePwd.type = type;
    }
</script>
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