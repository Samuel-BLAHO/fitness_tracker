<?php
require_once __DIR__ . '/app/bootstrap.php';

use App\Controllers\AuthController;
use App\Core\Auth;

if (Auth::check()) {
    header('Location: admin/index.php');
    exit;
}

$login_error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login_error = (new AuthController())->login($_POST);
}

$page_title = 'Login | Energym';
$active_page = 'login';
$body_class = 'sub_page login_page';
require 'includes/header.php';
require 'sections/login-section.php';
require 'includes/footer.php';
?>
