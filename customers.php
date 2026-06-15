<?php
require_once __DIR__ . '/app/bootstrap.php';

use App\Controllers\ReviewController;
use App\Core\Auth;
use App\Core\Csrf;

$controller = new ReviewController();
$errors = [];
$success = $_SESSION['flash_success'] ?? null;
unset($_SESSION['flash_success']);

$reviewForm = [
    'id' => '',
    'title' => '',
    'rating' => 5,
    'review_text' => '',
];
$editingReview = null;

if (isset($_GET['edit'])) {
    $editingReview = $controller->find((int) $_GET['edit']);

    if ($editingReview && $controller->canManage($editingReview)) {
        $reviewForm = [
            'id' => (string) $editingReview['id'],
            'title' => (string) $editingReview['title'],
            'rating' => (int) $editingReview['rating'],
            'review_text' => (string) $editingReview['review_text'],
        ];
    } else {
        $editingReview = null;
        $errors[] = 'You can only edit reviews that you created.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = (string) ($_POST['action'] ?? '');
    $reviewId = (int) ($_POST['review_id'] ?? 0);

    if (!Csrf::verify($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Invalid form token. Please try again.';
    }

    if ($action === 'create' || $action === 'update') {
        $reviewForm = [
            'id' => (string) $reviewId,
            'title' => trim((string) ($_POST['title'] ?? '')),
            'rating' => (int) ($_POST['rating'] ?? 0),
            'review_text' => trim((string) ($_POST['review_text'] ?? '')),
        ];
        $errors = array_merge($errors, $controller->validate($_POST));
    }

    if ($action === 'create' && !Auth::memberCheck()) {
        $errors[] = 'Please log in with a registered account to leave a review.';
    }

    if (($action === 'update' || $action === 'delete') && $reviewId > 0) {
        $review = $controller->find($reviewId);

        if (!$review || !$controller->canManage($review)) {
            $errors[] = 'You can only manage reviews that you created.';
        }
    } elseif ($action === 'update' || $action === 'delete') {
        $errors[] = 'Review not found.';
    }

    if ($errors === []) {
        if ($action === 'create' && $controller->create($_POST)) {
            $_SESSION['flash_success'] = 'Your review has been posted.';
            header('Location: customers.php');
            exit;
        }

        if ($action === 'update' && $controller->update($reviewId, $_POST)) {
            $_SESSION['flash_success'] = 'Your review has been updated.';
            header('Location: customers.php');
            exit;
        }

        if ($action === 'delete' && $controller->delete($reviewId)) {
            $_SESSION['flash_success'] = 'Your review has been deleted.';
            header('Location: customers.php');
            exit;
        }

        $errors[] = 'We could not save your changes. Please try again.';
    }
}

$reviews = $controller->all();
$csrfToken = Csrf::token();
$page_title = 'Energym Customers';
$active_page = 'customers';
$body_class = 'sub_page';
require 'includes/header.php';
require 'sections/customers-section.php';
require 'includes/footer.php';
?>
