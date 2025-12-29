<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>القمة الرقمية | The Legend</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;800&family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    <style>
        :root {
            --primary: #6a11cb;
            --secondary: #2575fc;
            --accent: #ff4b1f;
            --dark: #0f172a;
            --light: #f8f9fa;
            --gradient-main: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            --gradient-hot: linear-gradient(135deg, #ff9a9e 0%, #fecfef 99%, #fecfef 100%);
            --glass: rgba(255, 255, 255, 0.1);
        }

        /* --- Global Setup --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
        }
        
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f0f2f5;
            position: relative;
        }
        
        h1, h2, h3, h4, h5 { 
            font-family: 'Tajawal', sans-serif; 
            line-height: 1.3;
        }

        /* --- Container fixes --- */
        .container, .container-fluid {
            padding-right: 15px;
            padding-left: 15px;
        }
        
        .row {
            margin-right: -15px;
            margin-left: -15px;
        }
        
        .col, [class*="col-"] {
            padding-right: 15px;
            padding-left: 15px;
        }

        /* --- Preloader --- */
        #preloader {
            position: fixed;
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%;
            background: var(--dark);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease;
        }
        
        .loader {
            width: 80px; 
            height: 80px;
            border: 5px solid #fff;
            border-bottom-color: var(--accent);
            border-radius: 50%;
            animation: rotation 1s linear infinite;
        }
        
        @keyframes rotation { 
            0% { transform: rotate(0deg); } 
            100% { transform: rotate(360deg); } 
        }

        /* --- Scrollbar --- */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: var(--dark); }
        ::-webkit-scrollbar-thumb { 
            background: var(--gradient-main); 
            border-radius: 6px; 
            border: 2px solid var(--dark); 
        }

        /* --- Navbar --- */
        .navbar {
            transition: all 0.4s ease;
            padding: 20px 0;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
        }
        
        .navbar.scrolled {
            padding: 12px 0;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .navbar.scrolled .nav-link { 
            color: var(--dark) !important; 
        }
        
        .navbar.scrolled .navbar-brand { 
            color: var(--primary) !important; 
        }
        
        .nav-link {
            color: #fff !important;
            font-weight: 700;
            margin: 0 8px;
            position: relative;
            font-size: 1rem;
        }
        
        .nav-link::after {
            content: ''; 
            position: absolute; 
            bottom: -5px; 
            right: 0; 
            width: 0; 
            height: 2px;
            background: var(--accent); 
            transition: 0.3s;
        }
        
        .nav-link:hover::after { width: 100%; }
        
        .navbar-brand {
            font-size: 1.8rem;
        }
        
        @media (max-width: 992px) {
            .navbar-brand {
                font-size: 1.5rem;
            }
            .nav-link {
                margin: 5px 0;
                text-align: right;
                padding-right: 10px;
            }
        }

        /* --- LEGENDARY CAROUSEL --- */
        .carousel-item {
            height: 100vh;
            min-height: 500px;
            position: relative;
            overflow: hidden;
            width: 100%;
        }
        
        .carousel-bg {
            position: absolute; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%;
            background-size: cover; 
            background-position: center;
            transform: scale(1);
            transition: transform 10s ease;
        }
        
        .carousel-item.active .carousel-bg {
            transform: scale(1.2);
        }
        
        .carousel-overlay {
            position: absolute; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%;
            background: linear-gradient(to right, rgba(10, 10, 30, 0.85), rgba(10, 10, 30, 0.4));
            z-index: 1;
        }
        
        .carousel-caption {
            z-index: 2;
            bottom: 30%;
            text-align: right;
            right: 10%;
            left: 10%;
            padding: 20px;
        }
        
        /* Text Responsive */
        .carousel-caption h5 {
            font-size: 3.5rem; 
            font-weight: 900;
            opacity: 0; 
            transform: translateY(50px);
            background: -webkit-linear-gradient(#fff, #aab7ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        
        .carousel-caption p {
            font-size: 1.3rem; 
            opacity: 0; 
            transform: translateY(50px);
            color: rgba(255,255,255,0.9);
            margin-bottom: 30px;
        }
        
        .carousel-caption .btn {
            opacity: 0; 
            transform: scale(0.8);
            font-size: 1.1rem;
            padding: 12px 30px;
        }
        
        @media (max-width: 1200px) {
            .carousel-caption h5 { font-size: 3rem; }
            .carousel-caption p { font-size: 1.2rem; }
        }
        
        @media (max-width: 992px) {
            .carousel-caption h5 { font-size: 2.5rem; }
            .carousel-caption p { font-size: 1.1rem; }
            .carousel-caption .btn { padding: 10px 25px; }
        }
        
        @media (max-width: 768px) {
            .carousel-item {
                height: 80vh;
                min-height: 400px;
            }
            .carousel-caption h5 { font-size: 2rem; }
            .carousel-caption p { font-size: 1rem; }
            .carousel-caption { 
                bottom: 20%; 
                right: 5%;
                left: 5%;
            }
            .carousel-caption .btn { 
                padding: 10px 20px; 
                font-size: 1rem;
            }
        }
        
        @media (max-width: 576px) {
            .carousel-item {
                height: 70vh;
                min-height: 350px;
            }
            .carousel-caption h5 { font-size: 1.8rem; }
            .carousel-caption p { font-size: 0.95rem; }
            .carousel-caption .btn { 
                padding: 8px 18px; 
                font-size: 0.95rem;
            }
        }
        
        @media (max-width: 400px) {
            .carousel-caption h5 { font-size: 1.5rem; }
            .carousel-caption p { font-size: 0.9rem; }
        }

        .carousel-item.active .carousel-caption h5 { 
            animation: slideUp 1s ease 0.5s forwards; 
        }
        
        .carousel-item.active .carousel-caption p { 
            animation: slideUp 1s ease 0.8s forwards; 
        }
        
        .carousel-item.active .carousel-caption .btn { 
            animation: popIn 0.8s ease 1.1s forwards; 
        }

        @keyframes slideUp { 
            to { 
                opacity: 1; 
                transform: translateY(0); 
            } 
        }
        
        @keyframes popIn { 
            to { 
                opacity: 1; 
                transform: scale(1); 
            } 
        }

        /* --- SVG Waves Separator --- */
        .wave-separator {
            position: absolute; 
            bottom: -1px; 
            left: 0; 
            width: 100%;
            overflow: hidden; 
            line-height: 0;
            z-index: 3;
        }
        
        .wave-separator svg {
            position: relative; 
            display: block; 
            width: calc(100% + 1.3px); 
            height: 120px;
        }
        
        .wave-separator .shape-fill { 
            fill: #f0f2f5; 
        }
        
        @media (max-width: 768px) {
            .wave-separator svg { 
                height: 80px; 
            }
        }

        /* --- Cards (Neumorphism + Glass) --- */
        .feature-box {
            background: #fff;
            padding: 35px 25px;
            border-radius: 25px;
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.1);
            transition: 0.4s;
            position: relative;
            overflow: hidden;
            z-index: 1;
            margin-bottom: 30px;
            height: 100%;
            width: 100%;
        }
        
        .feature-box::before {
            content: ''; 
            position: absolute; 
            top: 0; 
            right: 0; 
            width: 0; 
            height: 100%;
            background: var(--gradient-main);
            z-index: -1; 
            transition: 0.4s; 
            border-radius: 25px;
        }
        
        .feature-box:hover::before { 
            width: 100%; 
        }
        
        .feature-box:hover h3, 
        .feature-box:hover p { 
            color: #fff; 
        }
        
        .feature-box:hover .icon-box { 
            background: #fff; 
            color: var(--primary); 
        }
        
        .icon-box {
            width: 70px; 
            height: 70px; 
            line-height: 70px; 
            font-size: 30px;
            background: var(--light); 
            color: var(--primary);
            border-radius: 50%; 
            margin-bottom: 20px; 
            transition: 0.4s;
            display: inline-block;
        }
        
        @media (max-width: 768px) {
            .feature-box { 
                padding: 25px 20px; 
            }
            .icon-box {
                width: 60px; 
                height: 60px; 
                line-height: 60px; 
                font-size: 25px;
            }
        }

        /* --- Services Tabs Section --- */
        .services-tabs {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
            width: 100%;
        }
        
        .service-tab-nav {
            border: none;
            justify-content: center;
            margin-bottom: 40px;
            flex-wrap: wrap;
            width: 100%;
        }
        
        .service-tab-nav .nav-link {
            background: transparent;
            color: var(--dark);
            border: none;
            font-weight: 700;
            font-size: 1rem;
            padding: 12px 25px;
            margin: 5px 8px;
            border-radius: 50px;
            transition: all 0.3s;
            position: relative;
            border: 2px solid transparent;
            white-space: nowrap;
        }
        
        .service-tab-nav .nav-link.active {
            background: var(--gradient-main);
            color: white;
            border: 2px solid var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(106, 17, 203, 0.3);
        }
        
        .service-tab-nav .nav-link:hover:not(.active) {
            background: rgba(106, 17, 203, 0.1);
            border: 2px solid rgba(106, 17, 203, 0.2);
        }
        
        .service-tab-content {
            padding: 20px 0;
            width: 100%;
        }
        
        .service-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .service-gallery-item {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            height: 280px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            transition: all 0.4s;
        }
        
        .service-gallery-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .service-gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s;
        }
        
        .service-gallery-item:hover img {
            transform: scale(1.08);
        }
        
        .service-gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(to top, rgba(0,0,0,0.85), transparent);
            color: white;
            padding: 20px;
            transform: translateY(0);
            opacity: 1;
        }
        
        .service-gallery-overlay h4 {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }
        
        .service-gallery-overlay p {
            font-size: 0.85rem;
            opacity: 0.9;
            margin-bottom: 0;
        }
        
        @media (max-width: 992px) {
            .services-tabs { 
                padding: 60px 0; 
            }
            .service-tab-nav .nav-link {
                padding: 10px 20px;
                font-size: 0.95rem;
                margin: 3px 5px;
            }
            .service-gallery {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                gap: 15px;
            }
            .service-gallery-item { 
                height: 240px; 
            }
        }
        
        @media (max-width: 768px) {
            .service-tab-nav .nav-link {
                padding: 8px 16px;
                font-size: 0.9rem;
                margin: 2px 3px;
            }
            .service-gallery {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
            .service-gallery-item { 
                height: 220px; 
            }
            .service-gallery-overlay {
                padding: 15px;
            }
        }
        
        @media (max-width: 576px) {
            .service-tab-nav .nav-link {
                padding: 8px 14px;
                font-size: 0.85rem;
            }
            .service-gallery {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            .service-gallery-item { 
                height: 250px; 
            }
        }

        /* --- Gallery (Masonry Style) --- */
        .gallery-wrap { 
            padding: 70px 0; 
            background: #fff; 
            width: 100%;
        }
        
        .g-item {
            position: relative; 
            border-radius: 15px; 
            overflow: hidden; 
            margin-bottom: 25px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            width: 100%;
        }
        
        .g-item img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            transition: 0.6s; 
        }
        
        .g-overlay {
            position: absolute; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%;
            background: rgba(106, 17, 203, 0.85);
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center;
            opacity: 0; 
            transform: translateY(20px); 
            transition: 0.4s;
        }
        
        .g-item:hover img { 
            transform: scale(1.08); 
        }
        
        .g-item:hover .g-overlay { 
            opacity: 1; 
            transform: translateY(0); 
        }

        /* --- Dark Map Section --- */
        .contact-section { 
            position: relative; 
            background: var(--dark); 
            color: #fff; 
            overflow: hidden; 
            width: 100%;
        }
        
        .contact-card {
            background: rgba(255,255,255,0.05); 
            backdrop-filter: blur(10px);
            padding: 40px 30px; 
            border-radius: 25px; 
            border: 1px solid rgba(255,255,255,0.1);
            width: 100%;
        }
        
        .form-control {
            background: rgba(255,255,255,0.05); 
            border: none; 
            padding: 14px; 
            color: #fff;
            border-bottom: 2px solid rgba(255,255,255,0.2); 
            border-radius: 5px;
            font-size: 1rem;
        }
        
        .form-control:focus { 
            background: rgba(255,255,255,0.1); 
            color:#fff; 
            box-shadow: none; 
            border-color: var(--accent); 
        }
        
        @media (max-width: 768px) {
            .contact-card { 
                padding: 30px 20px; 
            }
            .form-control {
                padding: 12px;
            }
        }

        /* --- Stats Section --- */
        .stats-section {
            background: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), 
                        url('https://images.unsplash.com/photo-1519681393798-2f77f37d45e5?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            padding: 80px 0;
            color: white;
            width: 100%;
        }
        
        .stat-box {
            text-align: center;
            padding: 20px;
        }
        
        .stat-box h1 {
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 10px;
        }
        
        @media (max-width: 992px) {
            .stat-box h1 {
                font-size: 3rem;
            }
        }
        
        @media (max-width: 768px) {
            .stats-section {
                padding: 60px 0;
            }
            .stat-box h1 {
                font-size: 2.5rem;
            }
            .stat-box p {
                font-size: 0.9rem;
            }
        }

        /* --- Footer --- */
        footer { 
            background: #0b0f19; 
            color: #7a808d; 
            padding-top: 80px; 
            padding-bottom: 30px; 
            width: 100%;
        }
        
        .footer-widget h4 { 
            color: #fff; 
            margin-bottom: 20px; 
            font-weight: 700; 
            position: relative; 
            padding-bottom: 10px; 
            font-size: 1.3rem;
        }
        
        .footer-widget h4::after {
            content: ''; 
            position: absolute; 
            bottom: 0; 
            right: 0; 
            width: 40px; 
            height: 3px; 
            background: var(--accent);
        }
        
        .footer-widget ul {
            padding-right: 0;
        }
        
        .footer-widget ul li {
            margin-bottom: 10px;
        }
        
        .footer-widget ul li a {
            color: #7a808d;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-widget ul li a:hover {
            color: #fff;
            padding-right: 5px;
        }
        
        @media (max-width: 768px) {
            footer {
                padding-top: 60px;
            }
            .footer-widget {
                margin-bottom: 30px;
            }
            .footer-widget h4 {
                font-size: 1.2rem;
            }
        }

        /* --- Floating WA Button --- */
        .float-wa {
            position: fixed; 
            width: 55px; 
            height: 55px; 
            bottom: 25px; 
            left: 25px;
            background-color: #25d366; 
            color: #FFF; 
            border-radius: 50%; 
            text-align: center;
            font-size: 26px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.3); 
            z-index: 100; 
            display: flex;
            align-items: center; 
            justify-content: center; 
            transition: 0.3s;
            text-decoration: none;
        }
        
        .float-wa:hover { 
            transform: scale(1.1); 
            background-color: #20ba5a; 
            color: white;
        }
        
        @media (max-width: 768px) {
            .float-wa {
                width: 50px; 
                height: 50px; 
                font-size: 22px;
                bottom: 20px; 
                left: 20px;
            }
        }

        /* --- General Section Styling --- */
        section {
            width: 100%;
            position: relative;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .section-title h2 {
            font-size: 2.8rem;
            font-weight: 900;
            margin-bottom: 15px;
            color: var(--dark);
        }
        
        .section-title p {
            font-size: 1.1rem;
            color: #6c757d;
            max-width: 700px;
            margin: 0 auto;
        }
        
        @media (max-width: 992px) {
            .section-title h2 {
                font-size: 2.3rem;
            }
            .section-title p {
                font-size: 1rem;
                padding: 0 15px;
            }
        }
        
        @media (max-width: 768px) {
            .section-title h2 {
                font-size: 2rem;
            }
            .section-title {
                margin-bottom: 40px;
            }
        }
        
        @media (max-width: 576px) {
            .section-title h2 {
                font-size: 1.8rem;
            }
            .section-title p {
                font-size: 0.95rem;
            }
        }

        /* --- Button Styling --- */
        .btn-primary {
            background: var(--gradient-main);
            border: none;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 50px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(106, 17, 203, 0.3);
        }
        
        .btn-lg {
            padding: 14px 35px;
            font-size: 1.1rem;
        }
        
        /* --- Responsive Images --- */
        img {
            max-width: 100%;
            height: auto;
        }
        
        /* --- Fix for negative margins --- */
        .m-negative-fix {
            margin-left: 0;
            margin-right: 0;
        }
    </style>
</head>
<body onload="hideLoader()">

    <div id="preloader">
        <div class="loader"></div>
    </div>

    <a href="https://wa.me/966123456789" class="float-wa" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="#home">
                <i class="bi bi-infinity"></i> LEGEND
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="تبديل التنقل">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#home">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">من نحن</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">خدماتنا</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services-tabs">أقسامنا</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gallery">معرض الأعمال</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">اتصل بنا</a></li>
                </ul>
                <a href="#contact" class="btn btn-primary rounded-pill px-4 ms-3 fw-bold">ابدأ الآن</a>
            </div>
        </div>
    </nav>

    <section id="home">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-pause="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-bg" style="background-image: url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=2072&auto=format&fit=crop');"></div>
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption">
                        <h5>المستقبل يبدأ هنا</h5>
                        <p class="mb-4">تصميم يتجاوز حدود المألوف، وتقنية تسبق عصرها. نحن نبني الإمبراطوريات الرقمية.</p>
                        <a href="#about" class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary shadow-lg">اكتشف المزيد</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-bg" style="background-image: url('https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2070&auto=format&fit=crop');"></div>
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption">
                        <h5>إبداع لا نهائي</h5>
                        <p class="mb-4">كل بكسل في هذا التصميم تم وضعه بعناية فائقة ليعكس رؤيتك الطموحة.</p>
                        <a href="#contact" class="btn btn-outline-light btn-lg rounded-pill px-5 fw-bold">اتصل بنا</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-bg" style="background-image: url('https://images.unsplash.com/photo-1550745165-9bc0b252726f?q=80&w=2070&auto=format&fit=crop');"></div>
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption">
                        <h5>تكنولوجيا الغد</h5>
                        <p class="mb-4">نستخدم أحدث التقنيات لنضمن لك موقعاً سريعاً، آمناً، ومبهراً للأنظار.</p>
                        <a href="#gallery" class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary">شاهد أعمالنا</a>
                    </div>
                </div>
            </div>
            
            <div class="wave-separator">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
                </svg>
            </div>
        </div>
    </section>

    <section id="about" class="py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-left">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop" class="img-fluid rounded-4 shadow-lg" alt="من نحن" style="z-index: 2; position: relative;">
                        <div style="position: absolute; top: -20px; left: -20px; width: 80px; height: 80px; background: var(--accent); border-radius: 15px; z-index: 1; opacity: 0.2;"></div>
                        <div style="position: absolute; bottom: -20px; right: -20px; width: 120px; height: 120px; background: var(--primary); border-radius: 50%; z-index: 1; opacity: 0.2;"></div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-right">
                    <h6 class="text-primary fw-bold text-uppercase ls-2">من نحن</h6>
                    <h2 class="display-5 fw-bold mb-4">نحن لا نصمم مواقع<br><span class="text-primary">نحن نصنع تجارب</span></h2>
                    <p class="lead text-secondary mb-4">في عالم يضج بالتقليد، اخترنا أن نكون الاستثناء. فريقنا يجمع بين جنون الفنانين ودقة المهندسين.</p>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm">
                                <i class="bi bi-trophy-fill fs-2 text-warning me-3"></i>
                                <div>
                                    <h5 class="mb-0 fw-bold">جودة عالمية</h5>
                                    <small class="text-muted">معايير لا تقبل المساومة</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm">
                                <i class="bi bi-rocket-takeoff-fill fs-2 text-danger me-3"></i>
                                <div>
                                    <h5 class="mb-0 fw-bold">سرعة خرافية</h5>
                                    <small class="text-muted">أداء يسبق الزمن</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-5">
        <div class="container py-5">
            <div class="section-title">
                <h2>خدمات تفوق التوقعات</h2>
                <p>نقدم مجموعة متكاملة من الخدمات الرقمية التي تواكب أحدث التقنيات وتلبي احتياجات سوق اليوم</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-box text-center h-100">
                        <div class="icon-box"><i class="bi bi-code-square"></i></div>
                        <h3>تطوير الويب</h3>
                        <p class="text-muted">برمجة نظيفة، سريعة، ومتجاوبة تماماً مع جميع الأجهزة. نستخدم أحدث أطر العمل العالمية.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-box text-center h-100">
                        <div class="icon-box"><i class="bi bi-palette"></i></div>
                        <h3>تصميم UI/UX</h3>
                        <p class="text-muted">تصاميم تأسر العيون وتسهل رحلة المستخدم. ندمج الجمال مع سهولة الاستخدام.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-box text-center h-100">
                        <div class="icon-box"><i class="bi bi-bar-chart-line"></i></div>
                        <h3>التسويق الرقمي</h3>
                        <p class="text-muted">استراتيجيات ذكية لرفع مبيعاتك والوصول لعميلك المثالي في الوقت المناسب.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-box text-center h-100">
                        <div class="icon-box"><i class="bi bi-shield-lock"></i></div>
                        <h3>الأمن السيبراني</h3>
                        <p class="text-muted">حماية قصوى لبياناتك وبيانات عملائك ضد أي تهديدات محتملة.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-box text-center h-100">
                        <div class="icon-box"><i class="bi bi-phone"></i></div>
                        <h3>تطبيقات الجوال</h3>
                        <p class="text-muted">تطبيقات احترافية لنظامي iOS و Android بأداء سلس وتصميم عصري.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-box text-center h-100">
                        <div class="icon-box"><i class="bi bi-headset"></i></div>
                        <h3>الدعم الفني</h3>
                        <p class="text-muted">فريق دعم متواجد 24/7 لحل أي مشكلة تقنية قد تواجهك فوراً.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services-tabs" class="services-tabs">
        <div class="container">
            <div class="section-title">
                <h2>أقسامنا المتخصصة</h2>
                <p>اختر قسمًا لترى تفاصيل الخدمات وأعمالنا السابقة في هذا المجال</p>
            </div>

            <ul class="nav nav-pills service-tab-nav" id="serviceTabs" role="tablist" data-aos="fade-up">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="web-dev-tab" data-bs-toggle="pill" data-bs-target="#web-dev" type="button">تطوير الويب</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="mobile-app-tab" data-bs-toggle="pill" data-bs-target="#mobile-app" type="button">تطبيقات الجوال</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="ui-ux-tab" data-bs-toggle="pill" data-bs-target="#ui-ux" type="button">تصميم UI/UX</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="marketing-tab" data-bs-toggle="pill" data-bs-target="#marketing" type="button">التسويق الرقمي</button>
                </li>
            </ul>

            <div class="tab-content service-tab-content" id="serviceTabsContent">
                <!-- Web Development Tab -->
                <div class="tab-pane fade show active" id="web-dev" role="tabpanel" aria-labelledby="web-dev-tab">
                    <div class="row align-items-center">
                        <div class="col-lg-6" data-aos="fade-right">
                            <h3 class="fw-bold mb-4">تطوير مواقع احترافية</h3>
                            <p class="text-muted mb-4">نطور مواقع ويب سريعة وآمنة ومتجاوبة مع جميع الأجهزة، باستخدام أحدث التقنيات وأطر العمل الحديثة.</p>
                            <ul class="list-unstyled">
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> تصميم متجاوب يعمل على جميع الشاشات</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> تحسين محركات البحث (SEO)</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> تكامل مع أنظمة الدفع الإلكتروني</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> لوحة تحكم سهلة الاستخدام</li>
                            </ul>
                            <a href="#contact" class="btn btn-primary btn-lg rounded-pill px-5 mt-3">اطلب خدمة تطوير الويب</a>
                        </div>
                        <div class="col-lg-6" data-aos="fade-left">
                            <div class="service-gallery">
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=2072&auto=format&fit=crop" alt="Web Development">
                                    <div class="service-gallery-overlay">
                                        <h4>موقع تجارة إلكترونية</h4>
                                        <p>منصة بيع إلكتروني متكاملة</p>
                                    </div>
                                </div>
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop" alt="Web Design">
                                    <div class="service-gallery-overlay">
                                        <h4>موقع تعريفي للشركات</h4>
                                        <p>تصميم عصري يعكس هوية العلامة</p>
                                    </div>
                                </div>
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1512486130939-2c4f79935e4f?q=80&w=2080&auto=format&fit=crop" alt="Web App">
                                    <div class="service-gallery-overlay">
                                        <h4>تطبيق ويب متقدم</h4>
                                        <p>منصة إدارة أعمال متكاملة</p>
                                    </div>
                                </div>
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=2070&auto=format&fit=crop" alt="Web Portal">
                                    <div class="service-gallery-overlay">
                                        <h4>بوابة تعليمية</h4>
                                        <p>منصة للتعليم عن بعد</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Apps Tab -->
                <div class="tab-pane fade" id="mobile-app" role="tabpanel" aria-labelledby="mobile-app-tab">
                    <div class="row align-items-center">
                        <div class="col-lg-6" data-aos="fade-right">
                            <h3 class="fw-bold mb-4">تطبيقات جوال مبتكرة</h3>
                            <p class="text-muted mb-4">نصمم ونطور تطبيقات جوال مبتكرة لأنظمة iOS و Android باستخدام أحدث التقنيات لتقديم تجربة مستخدم فريدة.</p>
                            <ul class="list-unstyled">
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> تطوير تطبيقات هجينة (Cross-platform)</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> واجهات مستخدم جذابة وسهلة الاستخدام</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> تكامل مع الخدمات السحابية</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> اختبار شامل على مختلف الأجهزة</li>
                            </ul>
                            <a href="#contact" class="btn btn-primary btn-lg rounded-pill px-5 mt-3">اطلب خدمة تطبيقات الجوال</a>
                        </div>
                        <div class="col-lg-6" data-aos="fade-left">
                            <div class="service-gallery">
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?q=80&w=1974&auto=format&fit=crop" alt="Mobile App">
                                    <div class="service-gallery-overlay">
                                        <h4>تطبيق توصيل طعام</h4>
                                        <p>منصة طلبات وتوصيل متكاملة</p>
                                    </div>
                                </div>
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?q=80&w=2070&auto=format&fit=crop" alt="Mobile UI">
                                    <div class="service-gallery-overlay">
                                        <h4>تطبيق لياقة بدنية</h4>
                                        <p>منصة رياضية شخصية</p>
                                    </div>
                                </div>
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=2080&auto=format&fit=crop" alt="App Development">
                                    <div class="service-gallery-overlay">
                                        <h4>تطبيق مصرفي</h4>
                                        <p>منصة مصرفية آمنة</p>
                                    </div>
                                </div>
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?q=80&w=2076&auto=format&fit=crop" alt="Social App">
                                    <div class="service-gallery-overlay">
                                        <h4>تطبيق تواصل اجتماعي</h4>
                                        <p>منصة للتواصل والمشاركة</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- UI/UX Design Tab -->
                <div class="tab-pane fade" id="ui-ux" role="tabpanel" aria-labelledby="ui-ux-tab">
                    <div class="row align-items-center">
                        <div class="col-lg-6" data-aos="fade-right">
                            <h3 class="fw-bold mb-4">تصميم واجهات مستخدم متميزة</h3>
                            <p class="text-muted mb-4">نصمم واجهات مستخدم جذابة وسهلة الاستخدام تركز على تجربة المستخدم لتحقيق أعلى معدلات التفاعل والتحويل.</p>
                            <ul class="list-unstyled">
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> أبحاث مستخدمين وتحليل المنافسين</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> تصميم سير عمل المستخدم (User Flow)</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> إنشاء نماذج تفاعلية (Wireframes & Prototypes)</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> اختبارات قابلية الاستخدام (Usability Testing)</li>
                            </ul>
                            <a href="#contact" class="btn btn-primary btn-lg rounded-pill px-5 mt-3">اطلب خدمة تصميم UI/UX</a>
                        </div>
                        <div class="col-lg-6" data-aos="fade-left">
                            <div class="service-gallery">
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?q=80&w=2000&auto=format&fit=crop" alt="UI Design">
                                    <div class="service-gallery-overlay">
                                        <h4>تصميم تطبيق رياضي</h4>
                                        <p>واجهات مستخدم جذابة</p>
                                    </div>
                                </div>
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=2070&auto=format&fit=crop" alt="UX Research">
                                    <div class="service-gallery-overlay">
                                        <h4>تحليل تجربة المستخدم</h4>
                                        <p>أبحاث وتحليلات شاملة</p>
                                    </div>
                                </div>
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1558655146-364adaf1fcc9?q=80&w=2070&auto=format&fit=crop" alt="Design System">
                                    <div class="service-gallery-overlay">
                                        <h4>أنظمة تصميم متكاملة</h4>
                                        <p>بناء أنظمة تصميم قابلة للتوسع</p>
                                    </div>
                                </div>
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1567446537710-0e9b8d4d8c4d?q=80&w=2070&auto=format&fit=crop" alt="Prototyping">
                                    <div class="service-gallery-overlay">
                                        <h4>نماذج تفاعلية</h4>
                                        <p>تصميم نماذج أولية تفاعلية</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Digital Marketing Tab -->
                <div class="tab-pane fade" id="marketing" role="tabpanel" aria-labelledby="marketing-tab">
                    <div class="row align-items-center">
                        <div class="col-lg-6" data-aos="fade-right">
                            <h3 class="fw-bold mb-4">تسويق رقمي استراتيجي</h3>
                            <p class="text-muted mb-4">نطور استراتيجيات تسويقية ذكية لزيادة وصولك للجمهور المستهدف ورفع مبيعاتك عبر قنوات التسويق الرقمي المختلفة.</p>
                            <ul class="list-unstyled">
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> إدارة حملات وسائل التواصل الاجتماعي</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> تحسين محركات البحث (SEO)</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> تسويق بالمحتوى واستراتيجيات الإعلان</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> تحليلات وتقارير أداء مفصلة</li>
                            </ul>
                            <a href="#contact" class="btn btn-primary btn-lg rounded-pill px-5 mt-3">اطلب خدمة التسويق الرقمي</a>
                        </div>
                        <div class="col-lg-6" data-aos="fade-left">
                            <div class="service-gallery">
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?q=80&w=2074&auto=format&fit=crop" alt="Digital Marketing">
                                    <div class="service-gallery-overlay">
                                        <h4>حملات إعلانية</h4>
                                        <p>إعلانات مدفوعة على المنصات</p>
                                    </div>
                                </div>
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2070&auto=format&fit=crop" alt="Data Analytics">
                                    <div class="service-gallery-overlay">
                                        <h4>تحليل بيانات</h4>
                                        <p>تقارير أداء وتحليلات</p>
                                    </div>
                                </div>
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop" alt="Social Media">
                                    <div class="service-gallery-overlay">
                                        <h4>وسائل التواصل الاجتماعي</h4>
                                        <p>إدارة منصات التواصل</p>
                                    </div>
                                </div>
                                <div class="service-gallery-item">
                                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2070&auto=format&fit=crop" alt="Content Marketing">
                                    <div class="service-gallery-overlay">
                                        <h4>تسويق بالمحتوى</h4>
                                        <p>إنشاء محتوى تسويقي</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4" data-aos="zoom-in">
                    <div class="stat-box">
                        <h1 class="text-primary">500+</h1>
                        <p class="fs-5">مشروع مكتمل</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="stat-box">
                        <h1 class="text-danger">99%</h1>
                        <p class="fs-5">رضا العملاء</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="stat-box">
                        <h1 class="text-info">2M+</h1>
                        <p class="fs-5">سطر كود</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="stat-box">
                        <h1 class="text-warning">10</h1>
                        <p class="fs-5">سنوات خبرة</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="gallery" class="gallery-wrap">
        <div class="container">
            <div class="section-title">
                <h2>معرض أعمالنا</h2>
                <p>أعمال مميزة تبرز مهاراتنا وإبداعنا في مختلف المجالات الرقمية</p>
            </div>
            
            <div class="row">
                <div class="col-lg-6 mb-4" data-aos="fade-up">
                    <div class="g-item h-100" style="min-height: 350px;">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=2072&auto=format&fit=crop" alt="تطوير الويب">
                        <a href="https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=2072&auto=format&fit=crop" class="g-overlay glightbox">
                            <h3 class="text-white fw-bold">تطوير الويب</h3>
                            <p class="text-white-50">مشروع برمجي متكامل</p>
                            <i class="bi bi-arrows-fullscreen text-white fs-2 mt-3"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="g-item" style="height: 220px;">
                                <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?q=80&w=1974&auto=format&fit=crop" alt="تطبيقات الجوال">
                                <a href="https://images.unsplash.com/photo-1551650975-87deedd944c3?q=80&w=1974&auto=format&fit=crop" class="g-overlay glightbox">
                                    <h5 class="text-white">تطبيقات الجوال</h5>
                                    <i class="bi bi-plus-lg text-white fs-3"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="g-item" style="height: 220px;">
                                <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?q=80&w=2000&auto=format&fit=crop" alt="هوية بصرية">
                                <a href="https://images.unsplash.com/photo-1561070791-2526d30994b5?q=80&w=2000&auto=format&fit=crop" class="g-overlay glightbox">
                                    <h5 class="text-white">هوية بصرية</h5>
                                    <i class="bi bi-plus-lg text-white fs-3"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 mb-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="g-item" style="height: 220px;">
                                <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2070&auto=format&fit=crop" alt="تحليل بيانات">
                                <a href="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2070&auto=format&fit=crop" class="g-overlay glightbox">
                                    <h4 class="text-white">تحليل بيانات</h4>
                                    <i class="bi bi-plus-lg text-white fs-3"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="contact-section py-5">
        <div class="container py-5">
            <div class="section-title text-white">
                <h2 class="text-white">تواصل معنا</h2>
                <p class="text-white-50">نحن هنا لمساعدتك في تحقيق أهدافك الرقمية، تواصل معنا الآن</p>
            </div>
            
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-left">
                    <div class="contact-card">
                        <h2 class="fw-bold mb-4">لنتحدث عن مشروعك</h2>
                        <form>
                            <div class="mb-3">
                                <label class="form-label text-white-50">الاسم الكامل</label>
                                <input type="text" class="form-control" placeholder="أدخل اسمك">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white-50">البريد الإلكتروني</label>
                                <input type="email" class="form-control" placeholder="example@domain.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white-50">رقم الهاتف</label>
                                <input type="tel" class="form-control" placeholder="05XXXXXXXX">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white-50">الرسالة</label>
                                <textarea class="form-control" rows="4" placeholder="أخبرنا عن مشروعك"></textarea>
                            </div>
                            <button class="btn btn-primary w-100 py-3 fw-bold rounded-pill">إرسال الآن</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-right">
                    <div class="h-100 rounded-4 overflow-hidden shadow-lg border border-secondary" style="min-height: 450px;">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3624.6970891632766!2d46.67529531500366!3d24.71355178412356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489399%3A0xba974d1c98e79fd5!2sRiyadh%20Saudi%20Arabia!5e0!3m2!1sen!2seg!4v1625688463991!5m2!1sen!2seg" 
                            width="100%" height="100%" style="border:0; min-height: 450px;" allowfullscreen="" loading="lazy" title="موقعنا على الخريطة">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="wave-separator" style="bottom: auto; top: -1px; transform: rotate(180deg);">
             <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h2 class="text-white fw-bold mb-4"><i class="bi bi-infinity text-primary"></i> LEGEND</h2>
                    <p class="lh-lg">نحن نبني الجسور بين الخيال والواقع. شريكك الرقمي الموثوق لتحقيق النجاح في العصر الحديث.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6 footer-widget">
                    <h4>الروابط</h4>
                    <ul class="list-unstyled lh-lg">
                        <li><a href="#home" class="text-decoration-none text-secondary">الرئيسية</a></li>
                        <li><a href="#about" class="text-decoration-none text-secondary">عن الشركة</a></li>
                        <li><a href="#features" class="text-decoration-none text-secondary">خدماتنا</a></li>
                        <li><a href="#gallery" class="text-decoration-none text-secondary">المعرض</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 footer-widget">
                    <h4>الخدمات</h4>
                    <ul class="list-unstyled lh-lg">
                        <li><a href="#services-tabs" class="text-decoration-none text-secondary">تصميم ويب</a></li>
                        <li><a href="#services-tabs" class="text-decoration-none text-secondary">تسويق</a></li>
                        <li><a href="#services-tabs" class="text-decoration-none text-secondary">تطبيقات</a></li>
                        <li><a href="#services-tabs" class="text-decoration-none text-secondary">استشارات</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 footer-widget">
                    <h4>النشرة البريدية</h4>
                    <p>اشترك لتصلك آخر العروض الحصرية وأحدث الأخبار.</p>
                    <div class="input-group mt-3">
                        <input type="email" class="form-control bg-dark text-white border-secondary" placeholder="بريدك الإلكتروني">
                        <button class="btn btn-primary">اشتراك</button>
                    </div>
                </div>
            </div>
            <hr class="border-secondary mt-5">
            <div class="text-center pt-3">
                <p class="mb-0">© 2024 جميع الحقوق محفوظة | تصميم <span class="text-white fw-bold">الأسطورة</span></p>
                <p class="mt-2 text-white-50"><i class="bi bi-telephone me-2"></i> 00966 123 456 789 <i class="bi bi-envelope ms-3 me-2"></i> info@legend.com</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>

    <script>
        // Hide Preloader
        function hideLoader() {
            const preloader = document.getElementById('preloader');
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        }

        // Initialize AOS
        AOS.init({
            duration: 800,
            offset: 100,
            once: true
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').classList.add('scrolled');
            } else {
                document.querySelector('.navbar').classList.remove('scrolled');
            }
        });

        // Initialize Lightbox
        const lightbox = GLightbox({
            touchNavigation: true,
            loop: true,
            autoplayVideos: true
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Form submission handling
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('شكرًا لتواصلك معنا! سنرد عليك في أقرب وقت ممكن.');
            this.reset();
        });
    </script>
</body>
</html>