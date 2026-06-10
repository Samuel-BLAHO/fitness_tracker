<?php
$page_title = $page_title ?? 'Energym';
$active_page = $active_page ?? 'home';
$body_class = $body_class ?? '';

function nav_active($page, $active_page) {
  return $page === $active_page ? ' active' : '';
}

$nav_items = [
  ['page' => 'home', 'label' => 'Home', 'url' => 'index.php'],
  ['page' => 'about', 'label' => 'About', 'url' => 'about.php'],
  ['page' => 'service', 'label' => 'Services', 'url' => 'service.php'],
  ['page' => 'why-us', 'label' => 'Why Us', 'url' => 'why-us.php'],
  ['page' => 'customers', 'label' => 'Customers', 'url' => 'customers.php'],
  ['page' => 'results', 'label' => 'Results', 'url' => 'results.php'],
  ['page' => 'contact', 'label' => 'Contact', 'url' => 'contact.php'],
  ['page' => 'login', 'label' => 'Login', 'url' => 'login.php'],
];
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title><?php echo htmlspecialchars($page_title); ?></title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap"
    rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body<?php echo $body_class ? ' class="' . htmlspecialchars($body_class) . '"' : ''; ?>>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" alt="" />
            <span>
              Energym
            </span>
          </a>
          <div class="contact_nav" id="">
            <ul class="navbar-nav ">
              <li class="nav-item">
                <a class="nav-link" href="contact.php">
                  <img src="images/location.png" alt="" />
                  <span>Location</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">
                  <img src="images/call.png" alt="" />
                  <span>Call : + 01 1234567890</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">
                  <img src="images/envelope.png" alt="" />
                  <span>demo@gmail.com</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>

    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section position-relative">
      <div class="container">
        <div class="custom_nav2">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="d-flex  flex-column flex-lg-row align-items-center">
                <ul class="navbar-nav">
<?php foreach ($nav_items as $item) { ?>
                  <li class="nav-item<?php echo nav_active($item['page'], $active_page); ?>">
                    <a class="nav-link" href="<?php echo htmlspecialchars($item['url']); ?>">
                      <?php echo htmlspecialchars($item['label']); ?>
<?php if ($active_page === $item['page']) { ?>
                      <span class="sr-only">(current)</span>
<?php } ?>
                    </a>
                  </li>
<?php } ?>
                </ul>
                <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                  <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
                </form>
              </div>
            </div>
          </nav>
        </div>
      </div>
<?php if ($active_page === 'home') { ?>
      <div class="slider_container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
<?php for ($i = 0; $i < 3; $i++) { ?>
            <div class="carousel-item<?php echo $i === 0 ? ' active' : ''; ?>">
              <div class="container">
                <div class="row">
                  <div class="col-lg-6 col-md-7 offset-md-6 offset-md-5">
                    <div class="detail-box">
                      <h2>
                        Get Your Body
                      </h2>
                      <h1>
                        Fitness Here
                      </h1>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam
                      </p>
                      <div class="btn-box">
                        <a href="about.php" class="btn-1">
                          Read More
                        </a>
                        <a href="contact.php" class="btn-2">
                          Get A Quote
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<?php } ?>
          </div>
        </div>
      </div>
<?php } ?>
    </section>
    <!-- end slider section -->
  </div>
