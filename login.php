<?php
require_once __DIR__ . '/app/bootstrap.php';

use App\Controllers\AuthController;
use App\Core\Auth;
use App\Core\Csrf;

if (Auth::check()) {
    header('Location: admin/index.php');
    exit;
}

if (Auth::memberCheck()) {
    header('Location: index.php');
    exit;
}

$login_error = null;
$login_success = $_SESSION['flash_success'] ?? null;
$login_email = '';
unset($_SESSION['flash_success']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login_email = trim((string) ($_POST['email'] ?? ''));
    $login_error = (new AuthController())->login($_POST);
}

$csrfToken = Csrf::token();
$page_title = 'Login | Energym';
$active_page = 'login';
$body_class = 'sub_page login_page';
require 'includes/header.php';
require 'sections/login-section.php';
require 'includes/footer.php';
?>
