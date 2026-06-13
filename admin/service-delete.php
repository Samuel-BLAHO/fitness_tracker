<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Controllers\ServiceController;
use App\Core\Auth;
use App\Core\Csrf;

Auth::requireLogin();

$controller = new ServiceController();
$id = (int) ($_GET['id'] ?? 0);
$service = $controller->find($id);

if (!$service) {
    header('Location: services.php');
    exit;
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Csrf::verify($_POST['csrf_token'] ?? null)) {
        $error = 'Invalid form token. Please try again.';
    } elseif ($controller->delete($id)) {
        header('Location: services.php');
        exit;
    }
}

$page_title = 'Delete Service | Energym';
$active_page = 'login';
$body_class = 'sub_page admin_page';
$base_path = '../';
require __DIR__ . '/../includes/header.php';
?>
  <section class="admin_section layout_padding">
    <div class="container">
      <div class="admin_header">
        <div>
          <h2>Delete Service</h2>
          <p>Confirm that you want to delete this service.</p>
        </div>
      </div>
<?php if ($error) { ?>
      <div class="form_alert form_alert_error"><?php echo e($error); ?></div>
<?php } ?>
      <div class="admin_confirm">
        <h3><?php echo e($service['title']); ?></h3>
        <p><?php echo e($service['description']); ?></p>
        <form action="" method="post" class="admin_actions">
          <input type="hidden" name="csrf_token" value="<?php echo e(Csrf::token()); ?>">
          <button type="submit" class="danger">Delete</button>
          <a href="services.php">Cancel</a>
        </form>
      </div>
    </div>
  </section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
