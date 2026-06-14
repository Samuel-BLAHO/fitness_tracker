  <!-- info section -->

  <section class="info_section layout_padding2-top">
    <div class="container">
      <div class="info_form">
        <h4>
          Our Newsletter
        </h4>
        <form action="">
          <input type="text" placeholder="Enter your email">
          <div class="d-flex justify-content-end">
            <button>
              subscribe
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h6>
            About Energym
          </h6>
          <p>
            consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
            minim veniam, quis nostrud exercitation u
          </p>
        </div>
        <div class="col-md-2 offset-md-1">
          <h6>
            Menus
          </h6>
          <ul>
<?php foreach ($nav_items ?? [] as $item) { ?>
            <li class="<?php echo ($active_page ?? '') === $item['page'] ? ' active' : ''; ?>">
              <a class="" href="<?php echo e($item['url']); ?>">
                <?php echo e($item['label']); ?>
<?php if (($active_page ?? '') === $item['page']) { ?>
                <span class="sr-only">(current)</span>
<?php } ?>
              </a>
            </li>
<?php } ?>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>
            Useful Links
          </h6>
          <ul>
            <li>
              <a href="<?php echo e($base_path ?? ''); ?>why-us.php">
                Why Choose Us
              </a>
            </li>
            <li>
              <a href="<?php echo e($base_path ?? ''); ?>customers.php">
                Customers
              </a>
            </li>
            <li>
              <a href="<?php echo e($base_path ?? ''); ?>results.php">
                Results
              </a>
            </li>
            <li>
              <a href="<?php echo e($base_path ?? ''); ?>service.php">
                Training
              </a>
            </li>
            <li>
              <a href="<?php echo e($base_path ?? ''); ?>contact.php">
                Quote
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>
            Contact Us
          </h6>
          <div class="info_link-box">
            <a href="<?php echo e($base_path ?? ''); ?>contact.php">
              <img src="<?php echo e($base_path ?? ''); ?>images/location-white.png" alt="">
              <span> No.123, loram ipusm</span>
            </a>
            <a href="<?php echo e($base_path ?? ''); ?>contact.php">
              <img src="<?php echo e($base_path ?? ''); ?>images/call-white.png" alt="">
              <span>+01 12345678901</span>
            </a>
            <a href="<?php echo e($base_path ?? ''); ?>contact.php">
              <img src="<?php echo e($base_path ?? ''); ?>images/mail-white.png" alt="">
              <span> demo123@gmail.com</span>
            </a>
          </div>
          <div class="info_social">
            <div>
              <a href="">
                <img src="<?php echo e($base_path ?? ''); ?>images/facebook-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="<?php echo e($base_path ?? ''); ?>images/twitter-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="<?php echo e($base_path ?? ''); ?>images/linkedin.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="<?php echo e($base_path ?? ''); ?>images/instagram.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end info section -->


  <!-- footer section -->
  <section class="container-fluid footer_section ">
    <p>
      &copy; 2019 All Rights Reserved. Design by
      <a href="https://html.design/">Free Html Templates</a>
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="<?php echo e($base_path ?? ''); ?>js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="<?php echo e($base_path ?? ''); ?>js/bootstrap.js"></script>

  <script>
    function openNav() {
      document.getElementById("myNav").classList.toggle("menu_width");
      document
        .querySelector(".custom_menu-btn")
        .classList.toggle("menu_btn-style");
    }
  </script>
</body>

</html>
