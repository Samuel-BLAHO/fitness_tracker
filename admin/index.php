<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Auth;

Auth::requireLogin();

$page_title = 'Admin Dashboard | Energym';
$active_page = 'login';
$body_class = 'sub_page admin_page';
$base_path = '../';
require __DIR__ . '/../includes/header.php';
?>
  <section class="admin_section layout_padding">
    <div class="container">
      <div class="admin_header">
        <div>
          <h2>Admin Dashboard</h2>
          <p>Welcome, <?php echo e(Auth::userName()); ?>. Manage the dynamic content used by the website.</p>
        </div>
        <div class="admin_header_actions">
          <a href="services.php">Manage Services</a>
          <a href="logout.php" class="secondary">Logout</a>
        </div>
      </div>
    </div>
  </section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
