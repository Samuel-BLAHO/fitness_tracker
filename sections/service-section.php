  <!-- service section -->
<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Controllers\ServiceController;

$services = (new ServiceController())->publicServices();
?>

  <section class="service_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Our Services
        </h2>
      </div>
      <div class="service_container">
<?php foreach ($services as $service) { ?>
        <div class="box">
          <img src="<?php echo e($service['image']); ?>" alt="<?php echo e($service['title']); ?>">
          <h6 class="visible_heading">
            <?php echo e($service['title']); ?>
          </h6>
          <div class="link_box">
            <a href="service.php">
              <img src="images/link.png" alt="">
            </a>
            <h6>
              <?php echo e($service['title']); ?>
            </h6>
            <p>
              <?php echo e($service['description']); ?>
            </p>
          </div>
        </div>
<?php } ?>
      </div>
    </div>
  </section>

  <!-- end service section -->
