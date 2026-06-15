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

$errors = [];
$values = [
    'username' => '',
    'email' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values['username'] = trim((string) ($_POST['username'] ?? ''));
    $values['email'] = trim((string) ($_POST['email'] ?? ''));
    $errors = (new AuthController())->register($_POST);

    if ($errors === []) {
        $_SESSION['flash_success'] = 'Your account has been created. You can log in now.';
        header('Location: login.php');
        exit;
    }
}

$csrfToken = Csrf::token();
$page_title = 'Register | Energym';
$active_page = 'login';
$body_class = 'sub_page login_page';
require 'includes/header.php';
require 'sections/register-section.php';
require 'includes/footer.php';
?>
