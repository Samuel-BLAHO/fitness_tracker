  <!-- client section -->

  <section class="client_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          What Says Our Customers
        </h2>
      </div>
<?php if (isset($reviews)) { ?>
      <div class="review_panel">
<?php if (!empty($success)) { ?>
      <div class="form_alert form_alert_success"><?php echo e($success); ?></div>
<?php } ?>
<?php foreach ($errors ?? [] as $error) { ?>
      <div class="form_alert form_alert_error"><?php echo e($error); ?></div>
<?php } ?>
<?php if (App\Core\Auth::memberCheck() || (App\Core\Auth::check() && !empty($reviewForm['id']))) { ?>
      <form class="review_form" action="customers.php" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
        <input type="hidden" name="action" value="<?php echo !empty($reviewForm['id']) ? 'update' : 'create'; ?>">
        <input type="hidden" name="review_id" value="<?php echo e((string) ($reviewForm['id'] ?? '')); ?>">
        <div class="review_form_grid">
          <div>
            <label for="title">Review Title</label>
            <input type="text" id="title" name="title" value="<?php echo e((string) ($reviewForm['title'] ?? '')); ?>" placeholder="Optional title">
          </div>
          <div>
            <label for="rating">Rating</label>
            <select id="rating" name="rating" required>
<?php for ($rating = 5; $rating >= 1; $rating--) { ?>
              <option value="<?php echo $rating; ?>" <?php echo (int) ($reviewForm['rating'] ?? 5) === $rating ? 'selected' : ''; ?>>
                <?php echo $rating; ?> star<?php echo $rating === 1 ? '' : 's'; ?>
              </option>
<?php } ?>
            </select>
          </div>
        </div>
        <div>
          <label for="review_text">Review</label>
          <textarea id="review_text" name="review_text" rows="5" required><?php echo e((string) ($reviewForm['review_text'] ?? '')); ?></textarea>
        </div>
        <div class="review_actions">
          <button type="submit"><?php echo !empty($reviewForm['id']) ? 'Save Review' : 'Submit Review'; ?></button>
<?php if (!empty($reviewForm['id'])) { ?>
          <a href="customers.php">Cancel</a>
<?php } ?>
        </div>
      </form>
<?php } elseif (!App\Core\Auth::check()) { ?>
      <div class="review_prompt">
        <p>Please <a href="login.php">log in</a> or <a href="register.php">create an account</a> to leave a review.</p>
      </div>
<?php } ?>
      <div class="review_list">
<?php if ($reviews === []) { ?>
        <div class="review_empty">
          No reviews have been posted yet.
        </div>
<?php } ?>
<?php foreach ($reviews as $review) { ?>
        <article class="review_card">
          <div class="review_card_header">
            <div>
              <h5><?php echo e($review['title'] ?: 'Customer Review'); ?></h5>
              <span><?php echo e($review['username']); ?></span>
            </div>
            <div class="review_rating" aria-label="<?php echo e((string) $review['rating']); ?> out of 5 stars">
              Rating <?php echo e((string) $review['rating']); ?>/5
            </div>
          </div>
          <p><?php echo nl2br(e($review['review_text'])); ?></p>
          <div class="review_meta">
            <span>Created <?php echo e(date('M j, Y', strtotime((string) $review['created_at']))); ?></span>
<?php if (!empty($review['updated_at']) && $review['updated_at'] !== $review['created_at']) { ?>
            <span>Updated <?php echo e(date('M j, Y', strtotime((string) $review['updated_at']))); ?></span>
<?php } ?>
          </div>
<?php if ($controller->canManage($review)) { ?>
          <div class="review_manage">
            <a href="customers.php?edit=<?php echo e((string) $review['id']); ?>">Edit</a>
            <form action="customers.php" method="post" onsubmit="return confirm('Delete this review?');">
              <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="review_id" value="<?php echo e((string) $review['id']); ?>">
              <button type="submit">Delete</button>
            </form>
          </div>
<?php } ?>
        </article>
<?php } ?>
      </div>
      </div>
<?php } else { ?>
      <div id="carouselExample2Indicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExample2Indicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExample2Indicators" data-slide-to="1"></li>
          <li data-target="#carouselExample2Indicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
<?php for ($i = 0; $i < 3; $i++) { ?>
          <div class="carousel-item<?php echo $i === 0 ? ' active' : ''; ?>">
            <div class="box">
              <div class="img-box">
                <img src="images/client.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Consectetur
                </h5>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                  dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                </p>
              </div>
            </div>
          </div>
<?php } ?>
        </div>
      </div>
<?php } ?>

    </div>
  </section>

  <!-- end client section -->
