<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Rosso Oro</title>


  <!-- Fuentes -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- CSS Vendor-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">

  <!-- CSS Principal-->
  <link href="/css/main.css" rel="stylesheet">

</head>

<body class="starter-page-page">

  <header id="header" class="header fixed-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:rossoro@gmail.com">rossoro@gmail.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+34 123 321 987</span></i>
        </div>
      </div>
    </div>
    <!-- Final Top Bar -->

    <div class="branding d-flex align-items-center">
      <div class="container position-relative d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
          <h1 class="sitename">Rosso Oro</h1>
        </a>

        <!-- Menú de navegación-->
        <nav id="navmenu" class="navmenu me-auto">
          <ul class="d-flex gap-3">
            <li><a href="#hero">Home</a></li>
            <li><a href="#why-us">Sobre Nosotros</a></li>
            <li><a href="#menu">Menú</a></li>
            <li><a href="#specials">Especiales</a></li>
            <li><a href="#contact">Contacto</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <div class="d-flex gap-2">
          <a class="btn-book-a-table d-none d-xl-block" href="#book-a-table">HAZ TU PEDIDO</a>
          <a class="btn-book-a-table d-none d-xl-block" href="{{ route('login') }}">INICIAR SESIÓN</a>

        </div>

      </div>
    </div>

  </header>
  <!-- Final Header -->

  <main class="main">

    <section id="hero" class="hero section dark-background">

      <img src="/images/fotoIntro.png" alt="" data-aos="fade-in">

      <div class="container">
        <div class="row">
          <div class="col-lg-8 d-flex flex-column align-items-center align-items-lg-start">
            <h2 data-aos="fade-up" data-aos-delay="100">Bienvenido a <span>Rosso Oro</span></h2>
            <p data-aos="fade-up" data-aos-delay="200">Auténtica cocina italiana con un toque de lujo</p>
            <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
              <a href="#book-a-table" class="cta-btn">Haz tu Pedido</a>
            </div>
          </div>
        </div>
      </div>

    </section>

    <!-- Sobre Nosotros -->
    <section id="why-us" class="why-us section">

      <div class="container section-title" data-aos="fade-up">
        <h2>POR QUÉ NOSOTROS</h2>
        <p>¿Por Qué Escoger Nuestro Restaurante?</p>
      </div>

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card-item">
              <span>01</span>
              <h4><a href="" class="stretched-link">Autenticidad Italiana</a></h4>
              <p>Cada plato está elaborado con ingredientes frescos y recetas tradicionales que capturan la esencia de Italia.</p>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card-item">
              <span>02</span>
              <h4><a href="" class="stretched-link">Experiencia Exclusiva</a></h4>
              <p>Un ambiente sofisticado y acogedor, perfecto para cenas románticas, celebraciones o simplemente disfrutar de la mejor gastronomía.</p>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card-item">
              <span>03</span>
              <h4><a href="" class="stretched-link">Pasión por la Calidad</a></h4>
              <p>Desde la selección de ingredientes hasta la presentación de cada plato, nuestro compromiso es ofrecer excelencia en cada detalle.</p>
            </div>
          </div>

        </div>

      </div>

    </section>
    <!-- Final Sobre Nosotros -->

    <!-- Seccion Menu -->
    <section id="menu" class="menu section">

      <div class="container section-title" data-aos="fade-up">
        <h2>MENÚ</h2>
        <p>Echa Un Vistazo A Nuestro Menú</p>
      </div>

      <div class="container isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

        <!-- Filtros Menú -->
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul class="menu-filters isotope-filters">
              <li data-filter="*" class="filter-active">Todos</li>
              <li data-filter=".filter-starters">Entrantes</li>
              <li data-filter=".filter-salads">Segundos</li>
              <li data-filter=".filter-specialty">Postres</li>
            </ul>
          </div>
        </div>

        <!-- Items Menú-->
        <div class="row isotope-container" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-6 menu-item isotope-item filter-starters">
            <img src="/images/menu/spinach-salad.jpg" class="menu-img" alt="">
            <div class="menu-content">
              <a href="#">Ensalada Gourmet de Pollo</a><span>10,95€</span>
            </div>
            <div class="menu-ingredients">
              Pollo, lechuga, remolacha
            </div>
          </div>

          <div class="col-lg-6 menu-item isotope-item filter-salads">
            <img src="/images/menu/spinach-salad.jpg" class="menu-img" alt="">
            <div class="menu-content">
              <a href="#">Ensalada Gourmet de Pollo</a><span>10,95€</span>
            </div>
            <div class="menu-ingredients">
              Pollo, lechuga, remolacha
            </div>
          </div>

          <div class="col-lg-6 menu-item isotope-item filter-specialty">
            <img src="/images/menu/spinach-salad.jpg"" class="menu-img" alt="">
            <div class="menu-content">
              <a href="#">Ensalada Gourmet de Pollo</a><span>10,95€</span>
            </div>
            <div class="menu-ingredients">
              Pollo, lechuga, remolacha
            </div>
          </div>

        </div>

      </div>

    </section>
    <!-- Sección Menú-->

  </main>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <!--<div id="preloader"></div>-->


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
  <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
  <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="/js/main.js"></script>

</body>

</html>
