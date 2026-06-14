<?php
$service = $service ?? [
    'title' => '',
    'description' => '',
    'image' => 'images/s-1.jpg',
    'sort_order' => 0,
    'is_active' => 1,
];
?>
        <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
        <div class="admin_form_grid">
          <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="<?php echo e($service['title']); ?>" required>
          </div>
          <div>
            <label for="image">Image path</label>
            <input type="text" id="image" name="image" value="<?php echo e($service['image']); ?>" required>
          </div>
          <div>
            <label for="sort_order">Sort order</label>
            <input type="number" id="sort_order" name="sort_order" value="<?php echo e((string) $service['sort_order']); ?>">
          </div>
          <label class="admin_checkbox">
            <input type="checkbox" name="is_active" <?php echo (int) $service['is_active'] === 1 ? 'checked' : ''; ?>>
            <span>Visible on public website</span>
          </label>
        </div>
        <div>
          <label for="description">Description</label>
          <textarea id="description" name="description" rows="5"><?php echo e($service['description']); ?></textarea>
        </div>
        <div class="admin_actions">
          <button type="submit"><?php echo e($buttonText); ?></button>
          <a href="services.php">Cancel</a>
        </div>

