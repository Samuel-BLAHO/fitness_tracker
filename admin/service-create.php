<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Controllers\ServiceController;
use App\Core\Auth;
use App\Core\Csrf;

Auth::requireLogin();

$controller = new ServiceController();
$errors = [];
$service = [
    'title' => '',
    'description' => '',
    'image' => 'images/s-1.jpg',
    'sort_order' => 0,
    'is_active' => 1,
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service = array_merge($service, $_POST);
    $errors = $controller->validate($_POST);

    if (!Csrf::verify($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Invalid form token. Please try again.';
    }

    if ($errors === [] && $controller->create($_POST)) {
        header('Location: services.php');
        exit;
    }
}

$csrfToken = Csrf::token();
$buttonText = 'Create Service';
$page_title = 'Create Service | Energym';
$active_page = 'login';
$body_class = 'sub_page admin_page';
$base_path = '../';
require __DIR__ . '/../includes/header.php';
?>
  <section class="admin_section layout_padding">
    <div class="container">
      <div class="admin_header">
        <div>
          <h2>Create Service</h2>
          <p>Add a new training service to the public website.</p>
        </div>
      </div>
<?php foreach ($errors as $error) { ?>
      <div class="form_alert form_alert_error"><?php echo e($error); ?></div>
<?php } ?>
      <form class="admin_form" action="" method="post">
<?php require __DIR__ . '/../app/Views/admin/service-form.php'; ?>
      </form>
    </div>
  </section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
