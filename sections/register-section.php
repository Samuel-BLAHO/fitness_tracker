  <!-- register section -->

  <section class="login_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Create Account
        </h2>
      </div>
      <div class="login_box">
        <div class="login_detail">
          <h3>
            Start Training
          </h3>
          <p>
            Create your Energym account to prepare for workout tracking, progress reviews, and focused training goals.
          </p>
          <div class="login_stats">
            <div>
              <span>8+</span>
              <small>Password</small>
            </div>
            <div>
              <span>1</span>
              <small>Account</small>
            </div>
          </div>
        </div>
        <form class="login_form" action="" method="post" id="registerForm" novalidate>
          <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
<?php foreach ($errors as $error) { ?>
          <div class="form_alert form_alert_error">
            <?php echo e($error); ?>
          </div>
<?php } ?>
          <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Choose a username" value="<?php echo e($values['username']); ?>" required>
          </div>
          <div>
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo e($values['email']); ?>" required>
          </div>
          <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Create a password" minlength="8" required>
          </div>
          <div>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat your password" minlength="8" required>
          </div>
          <button type="submit">
            Register
          </button>
          <p class="signup_text">
            Already have an account? <a href="login.php">Login here</a>
          </p>
        </form>
      </div>
    </div>
  </section>

  <script>
    (function () {
      var form = document.getElementById('registerForm');
      var password = document.getElementById('password');
      var confirmPassword = document.getElementById('confirm_password');

      if (!form || !password || !confirmPassword) {
        return;
      }

      function validatePasswordMatch() {
        confirmPassword.setCustomValidity(
          password.value === confirmPassword.value ? '' : 'Passwords must match.'
        );
      }

      password.addEventListener('input', validatePasswordMatch);
      confirmPassword.addEventListener('input', validatePasswordMatch);
      form.addEventListener('submit', validatePasswordMatch);
    }());
  </script>

  <!-- end register section -->
