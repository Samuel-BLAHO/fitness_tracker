<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Controllers\ServiceController;
use App\Core\Auth;

Auth::requireLogin();

$controller = new ServiceController();
$services = $controller->adminServices();

$page_title = 'Manage Services | Energym';
$active_page = 'login';
$body_class = 'sub_page admin_page';
$base_path = '../';
require __DIR__ . '/../includes/header.php';
?>
  <section class="admin_section layout_padding">
    <div class="container">
      <div class="admin_header">
        <div>
          <h2>Manage Services</h2>
          <p>Create, edit, and delete the services shown on the public Services page.</p>
        </div>
        <div class="admin_header_actions">
          <a href="service-create.php">Add Service</a>
          <a href="logout.php" class="secondary">Logout</a>
        </div>
      </div>

      <div class="admin_table_wrap">
        <table class="admin_table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Image</th>
              <th>Order</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
<?php foreach ($services as $service) { ?>
            <tr>
              <td><?php echo e($service['title']); ?></td>
              <td><?php echo e($service['image']); ?></td>
              <td><?php echo e((string) $service['sort_order']); ?></td>
              <td><?php echo (int) $service['is_active'] === 1 ? 'Visible' : 'Hidden'; ?></td>
              <td class="admin_table_actions">
                <a href="service-edit.php?id=<?php echo e((string) $service['id']); ?>">Edit</a>
                <a href="service-delete.php?id=<?php echo e((string) $service['id']); ?>" class="danger">Delete</a>
              </td>
            </tr>
<?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
