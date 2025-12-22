<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مكة اون لاين - بوابتك الرقمية لمكة المكرمة</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        :root {
            --primary-color: #0077be; /* سماوي أساسي */
            --primary-dark: #0066a5; /* سماوي غامق */
            --primary-light: #e8f4fc; /* سماوي فاتح */
            --secondary-color: #000000; /* أسود */
            --light-color: #ffffff; /* أبيض */
            --gray-color: #f8f9fa;
            --gray-dark: #e9ecef;
            --text-color: #333333;
            --text-light: #666666;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Cairo', sans-serif;
            color: var(--text-color);
            line-height: 1.7;
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5 {
            font-weight: 800;
            line-height: 1.3;
        }
        
        p {
            margin-bottom: 1rem;
        }
        
        .lead {
            font-size: 1.25rem;
            font-weight: 400;
        }
        
        /* Navigation */
        .navbar {
            background-color: var(--light-color);
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            padding: 15px 0;
            transition: all 0.4s ease;
        }
        
        .navbar-scrolled {
            padding: 10px 0;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.9rem;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
                        margin-left: 45px;


        }
        
        .navbar-brand i {
            margin-left: 8px;
            font-size: 1.8rem;

        }
        
        .nav-link {
            color: var(--text-color) !important;
            font-weight: 600;
            margin: 0 5px;
            transition: all 0.3s ease;
            position: relative;
            padding: 8px 12px !important;
        }
        
        .nav-link:after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 12px;
            width: 0;
            height: 3px;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover:after,
        .nav-link.active:after {
            width: calc(100% - 24px);
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 119, 190, 0.9), rgba(0, 119, 190, 0.95)), url('https://fajerweb.org/uploaded/essaysimages/small/20250528115353.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: var(--light-color);
            padding: 150px 0 120px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section:before {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M1200 120L0 16.48 0 0 1200 0 1200 120z' fill='%23ffffff'%3E%3C/path%3E%3C/svg%3E");
            background-size: 100% 100%;
        }
        
        .hero-title {
            font-size: 3.5rem;
            margin-bottom: 25px;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.2);
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 35px;
            opacity: 0.95;
            max-width: 800px;
            margin-right: auto;
            margin-left: auto;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 14px 40px;
            font-weight: 700;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 1.1rem;
            box-shadow: 0 5px 15px rgba(0, 119, 190, 0.3);
            
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 119, 190, 0.4);
        }
        
        .btn-outline-light {
            border: 2px solid var(--light-color);
            padding: 12px 38px;
            font-weight: 700;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }
        
        .btn-outline-light:hover {
            background-color: rgba(255,255,255,0.1);
            transform: translateY(-5px);
        }
        
        /* Section Styling */
        .section-title {
            position: relative;
            margin-bottom: 60px;
            padding-bottom: 20px;
            text-align: center;
            color: var(--secondary-color);
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 50%;
            transform: translateX(50%);
            width: 100px;
            height: 5px;
            background-color: var(--primary-color);
            border-radius: 3px;
        }
        
        .section-padding {
            padding: 100px 0;
        }
        
        .bg-light {
            background-color: var(--gray-color) !important;
        }
        
        /* Services */
        .service-card {
            background-color: var(--light-color);
            border-radius: 12px;
            padding: 35px 25px;
            height: 100%;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
            transition: all 0.4s ease;
            border-top: 5px solid var(--primary-color);
            text-align: center;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .service-card:before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary-light), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
        }
        
        .service-card:hover:before {
            opacity: 1;
        }
        
        .service-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .service-icon {
            font-size: 2.8rem;
            color: var(--primary-color);
            margin-bottom: 25px;
            height: 90px;
            width: 90px;
            line-height: 90px;
            background-color: rgba(0, 119, 190, 0.1);
            border-radius: 50%;
            margin: 0 auto 25px;
            transition: all 0.4s ease;
        }
        
        .service-card:hover .service-icon {
            background-color: var(--primary-color);
            color: var(--light-color);
            transform: scale(1.1);
        }
        
        .service-card h4 {
            margin-bottom: 15px;
            color: var(--secondary-color);
        }
        
        /* Pricing */
        .pricing-card {
            background-color: var(--light-color);
            border-radius: 12px;
            padding: 45px 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            text-align: center;
            position: relative;
            overflow: hidden;
            height: 100%;
            border: 2px solid transparent;
        }
        
        .pricing-card.featured {
            border-color: var(--primary-color);
            transform: scale(1.03);
        }
        
        .pricing-card.featured:before {
            content: 'مميزة';
            position: absolute;
            top: 20px;
            left: -35px;
            background-color: var(--primary-color);
            color: var(--light-color);
            padding: 8px 40px;
            transform: rotate(-45deg);
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }
        
        .pricing-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }
        
        .pricing-card.featured:hover {
            transform: scale(1.03) translateY(-15px);
        }
        
        .price {
            font-size: 3.2rem;
            font-weight: 800;
            color: var(--primary-color);
            margin: 25px 0;
        }
        
        .price span {
            font-size: 1.2rem;
            color: var(--text-light);
            font-weight: 600;
        }
        
        .pricing-feature {
            padding: 12px 0;
            border-bottom: 1px solid var(--gray-dark);
            text-align: right;
        }
        
        .pricing-feature i {
            color: var(--primary-color);
            margin-left: 10px;
            font-size: 1.1rem;
        }
        
        .pricing-feature .fa-times {
            color: #cccccc;
        }
        
        /* Features */
        .feature-box {
            padding: 30px 25px;
            text-align: center;
            margin-bottom: 30px;
            background-color: var(--light-color);
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
            transition: all 0.4s ease;
            height: 100%;
        }
        
        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .feature-icon {
            font-size: 2.8rem;
            color: var(--primary-color);
            margin-bottom: 25px;
            height: 90px;
            width: 90px;
            line-height: 90px;
            background-color: rgba(0, 119, 190, 0.1);
            border-radius: 50%;
            margin: 0 auto 25px;
            transition: all 0.4s ease;
        }
        
        .feature-box:hover .feature-icon {
            background-color: var(--primary-color);
            color: var(--light-color);
            transform: rotateY(180deg);
        }
        
        .feature-box h4 {
            margin-bottom: 15px;
            color: var(--secondary-color);
        }
        
        /* Contact Form */
        .contact-form .form-control,
        .contact-form .form-select {
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 1rem;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        
        .contact-form .form-control:focus,
        .contact-form .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(0, 119, 190, 0.25);
        }
        
        /* Footer */
        .footer {
            background-color: #1a1a1a;
            color: #f0f0f0;
            padding: 80px 0 30px;
        }
        
        .footer-title {
            color: var(--light-color);
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
            font-size: 1.5rem;
        }
        
        .footer-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 60px;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }
        
        .footer-links a {
            color: #aaa;
            display: block;
            margin-bottom: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .footer-links a:hover {
            color: var(--primary-color);
            padding-right: 8px;
        }
        
        .footer-contact p {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }
        
        .footer-contact i {
            color: var(--primary-color);
            margin-left: 10px;
            margin-top: 5px;
        }
        
        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background-color: rgba(255,255,255,0.08);
            color: #f0f0f0;
            border-radius: 50%;
            margin-left: 10px;
            transition: all 0.3s ease;
        }
        
        .social-icons a:hover {
            background-color: var(--primary-color);
            transform: translateY(-5px);
        }
        
        .copyright {
            border-top: 1px solid #333;
            padding-top: 25px;
            margin-top: 50px;
            text-align: center;
            color: #aaa;
            font-size: 0.9rem;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.8rem;
            }
            
            .hero-subtitle {
                font-size: 1.3rem;
            }
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.3rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .section-padding {
                padding: 70px 0;
            }
            
            .pricing-card.featured {
                transform: scale(1);
            }
            
            .pricing-card.featured:hover {
                transform: translateY(-15px);
            }
            
            .navbar-brand {
                font-size: 1.6rem;
            }
        }
        
        @media (max-width: 576px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-section {
                padding: 120px 0 90px;
            }
            
            .btn-primary, .btn-outline-light {
                padding: 12px 30px;
                font-size: 1rem;
                display: block;
                width: 90%;
                margin: 0px auto;
                margin-bottom: 15px;
            }
        }
        
        /* Animation Classes */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        
        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Stats Counter */
        .stats-counter {
            background-color: var(--primary-color);
            color: white;
            padding: 70px 0;
        }
        
        .stat-item {
            text-align: center;
            padding: 20px;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 10px;
        }
        
        .stat-text {
            font-size: 1.2rem;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <i class="fas fa-kaaba"></i>
                مكة اون لاين
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">الخدمات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">المميزات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">الباقات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">اتصل بنا</a>
                    </li>
                </ul>
                <a href="#pricing" class="btn btn-primary me-3 animate__animated animate__pulse animate__infinite" style="animation-duration: 2s;">اشترك الآن</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9 text-center">
                    <h1 class="hero-title animate__animated animate__fadeInDown">بوابتك الرقمية الشاملة لأنشطة مكة المكرمة</h1>
                    <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">
                        نقدم منصة متكاملة لعرض جميع الخدمات والأنشطة التجارية في مكة المكرمة، حيث نتيح لأي نشاط تجاري إنشاء بروفايل احترافي وجذب المزيد من العملاء من خلال منصتنا المتخصصة.
                    </p>
                    <div class="mt-5 animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="#pricing" class="btn btn-primary btn-lg me-3">اشترك في باقاتنا</a>
                        <a href="#services" class="btn btn-outline-light btn-lg">اكتشف خدماتنا</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section-padding" id="services">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-10 col-xl-8 mx-auto text-center">
                    <h2 class="section-title animate-on-scroll">الخدمات والأنشطة المتاحة</h2>
                    <p class="lead animate-on-scroll" style="transition-delay: 0.2s">
                        نغطي جميع المجالات والأنشطة التجارية والخدمية في مكة المكرمة، مما يوفر للمستخدمين تجربة شاملة لاكتشاف كل ما يحتاجونه في المدينة المقدسة.
                    </p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="service-card animate-on-scroll">
                        <div class="service-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h4>الفنادق والإقامة</h4>
                        <p>عرض وتفاصيل الفنادق والشقق المفروشة وبيوت الضيافة في جميع مناطق مكة المكرمة مع إمكانية الحجز المباشر.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card animate-on-scroll" style="transition-delay: 0.1s">
                        <div class="service-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h4>المطاعم والكافيهات</h4>
                        <p>دليل شامل للمطاعم والمقاهي والمأكولات بمختلف أنواعها في مكة المكرمة مع تقييمات ووسم جغرافي.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card animate-on-scroll" style="transition-delay: 0.2s">
                        <div class="service-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <h4>تأجير السيارات</h4>
                        <p>خدمات تأجير السيارات بجميع أنواعها مع تفاصيل الأسعار والعروض المتاحة وطرق الحجز المباشر.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card animate-on-scroll" style="transition-delay: 0.3s">
                        <div class="service-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h4>محلات البصريات</h4>
                        <p>دليل محلات النظارات الطبية والعدسات اللاصقة ومراكز العيون في مكة مع تفاصيل الخدمات والأسعار.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card animate-on-scroll" style="transition-delay: 0.4s">
                        <div class="service-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h4>المصاعد والصيانة</h4>
                        <p>شركات تركيب وصيانة المصاعد والسلالم المتحركة في المباني والمنشآت مع تفاصيل الخدمات وطرق التواصل.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card animate-on-scroll" style="transition-delay: 0.5s">
                        <div class="service-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <h4>المعارض والتجارة</h4>
                        <p>معارض الأثاث، الأجهزة الكهربائية، السيارات، والملابس في مكة المكرمة مع عروض حصرية للمشتركين.</p>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <p class="h5 animate-on-scroll" style="transition-delay: 0.6s">
                        وغيرها الكثير من الخدمات والأنشطة التجارية في مكة المكرمة
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-counter">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stat-item animate-on-scroll">
                        <div class="stat-number" data-count="50">0</div>
                        <div class="stat-text">خدمة متنوعة</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item animate-on-scroll" style="transition-delay: 0.1s">
                        <div class="stat-number" data-count="250">0</div>
                        <div class="stat-text">نشاط تجاري</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item animate-on-scroll" style="transition-delay: 0.2s">
                        <div class="stat-number" data-count="5000">0</div>
                        <div class="stat-text">زائر شهرياً</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item animate-on-scroll" style="transition-delay: 0.3s">
                        <div class="stat-number" data-count="98">0</div>
                        <div class="stat-text">رضا العملاء</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section-padding bg-light" id="features">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-10 col-xl-8 mx-auto text-center">
                    <h2 class="section-title animate-on-scroll">مميزات الانضمام إلى مكة اون لاين</h2>
                    <p class="lead animate-on-scroll" style="transition-delay: 0.2s">
                        لماذا يجب أن يكون نشاطك التجاري جزءًا من منصتنا الرقمية المتخصصة في أنشطة مكة المكرمة
                    </p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h4>وجودك الرقمي</h4>
                        <p>ننشئ لك موقع ويب متكامل (بروفايل) يعرض نشاطك التجاري باحترافية عالية مع تصميم متجاوب يناسب جميع الأجهزة.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box animate-on-scroll" style="transition-delay: 0.1s">
                        <div class="feature-icon">
                            <i class="fas fa-share-alt"></i>
                        </div>
                        <h4>رابط خاص للنشر</h4>
                        <p>احصل على رابط خاص بنشاطك يمكنك مشاركته عبر وسائل التواصل الاجتماعي والبريد الإلكتروني والرسائل النصية.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box animate-on-scroll" style="transition-delay: 0.2s">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>زيادة العملاء</h4>
                        <p>مع كثرة الخدمات على منصتنا، نزيد من فرص وصول العملاء إليك من خلال ظهورك في نتائج البحث الداخلية.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box animate-on-scroll" style="transition-delay: 0.3s">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>تحسين الظهور</h4>
                        <p>نضمن وصول أفضل لنشاطك التجاري من خلال منصتنا المتخصصة في أنشطة مكة المكرمة فقط، مما يعني جمهوراً مستهدفاً.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box animate-on-scroll" style="transition-delay: 0.4s">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4>تصميم متجاوب</h4>
                        <p>جميع البروفايلات تتوافق مع جميع الأجهزة (جوال، تابلت، كمبيوتر) مع سرعة تحميل عالية وتجربة مستخدم متميزة.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box animate-on-scroll" style="transition-delay: 0.5s">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h4>دعم فني مستمر</h4>
                        <p>نقدم لك الدعم الفني والتحديثات المستمرة لبروفايل نشاطك التجاري مع تحديث المعلومات والصور حسب طلبك.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="section-padding" id="pricing">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-10 col-xl-8 mx-auto text-center">
                    <h2 class="section-title animate-on-scroll">باقاتنا السنوية</h2>
                    <p class="lead animate-on-scroll" style="transition-delay: 0.2s">
                        اختر الباقة المناسبة لنشاطك التجاري في مكة المكرمة واستمتع بجميع مزايا منصتنا المتكاملة
                    </p>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6 mb-4">
                    <div class="pricing-card h-100 animate-on-scroll">
                        <h3 class="mb-3">الباقة الأساسية</h3>
                        <div class="price">500 <span>ريال/سنوي</span></div>
                        <p class="text-muted mb-4">مناسبة للأنشطة التجارية الصغيرة والمتوسطة</p>
                        
                        <div class="text-start mb-4">
                            <div class="pricing-feature"><i class="fas fa-check"></i> بروفايل متكامل على المنصة</div>
                            <div class="pricing-feature"><i class="fas fa-check"></i> عرض المعلومات الأساسية للنشاط</div>
                            <div class="pricing-feature"><i class="fas fa-check"></i> صور للنشاط (حتى 10 صور)</div>
                            <div class="pricing-feature"><i class="fas fa-check"></i> رابط خاص يمكن مشاركته</div>
                            <div class="pricing-feature"><i class="fas fa-check"></i> ظهور في نتائج البحث الداخلية</div>
                            <div class="pricing-feature"><i class="fas fa-check"></i> تحديث المعلومات مرتين سنوياً</div>
                            <div class="pricing-feature"><i class="fas fa-times"></i> دعم فني متقدم</div>
                            <div class="pricing-feature"><i class="fas fa-times"></i> ظهور مميز في الصفحة الرئيسية</div>
                        </div>
                        
                        <a href="#contact" class="btn btn-primary w-100">اشترك الآن</a>
                    </div>
                </div>
                
                <div class="col-lg-5 col-md-6 mb-4">
                    <div class="pricing-card featured h-100 animate-on-scroll" style="transition-delay: 0.2s">
                        <h3 class="mb-3">الباقة المميزة</h3>
                        <div class="price">1000 <span>ريال/سنوي</span></div>
                        <p class="text-muted mb-4">مناسبة للأنشطة الكبيرة وذات الظهور المتميز</p>
                        
                        <div class="text-start mb-4">
                            <div class="pricing-feature"><i class="fas fa-check"></i> كل مزايا الباقة الأساسية</div>
                            <div class="pricing-feature"><i class="fas fa-check"></i> بروفايل متقدم بتصميم خاص</div>
                            <div class="pricing-feature"><i class="fas fa-check"></i> صور للنشاط (حتى 25 صورة)</div>
                            <div class="pricing-feature"><i class="fas fa-check"></i> رابط خاص مع اسم مخصص</div>
                            <div class="pricing-feature"><i class="fas fa-check"></i> ظهور في مقدمة نتائج البحث</div>
                            <div class="pricing-feature"><i class="fas fa-check"></i> تحديث المعلومات شهرياً</div>
                            <div class="pricing-feature"><i class="fas fa-check"></i> دعم فني متقدم على مدار الساعة</div>
                            <div class="pricing-feature"><i class="fas fa-check"></i> ظهور مميز في الصفحة الرئيسية</div>
                            <div class="pricing-feature"><i class="fas fa-check"></i> إحصائيات زوار البروفايل</div>
                        </div>
                        
                        <a href="#contact" class="btn btn-primary w-100">اشترك الآن</a>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto text-center">
                    <p class="lead animate-on-scroll" style="transition-delay: 0.4s">
                        للاستفسار عن باقات مخصصة لأنشطتك التجارية، تواصل معنا وسنقدم لك الحل الأنسب
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section-padding bg-light" id="contact">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-10 col-xl-8 mx-auto text-center">
                    <h2 class="section-title animate-on-scroll">انضم إلينا الآن</h2>
                    <p class="lead animate-on-scroll" style="transition-delay: 0.2s">
                        سجل نشاطك التجاري في مكة المكرمة وكن جزءاً من أكبر منصة رقمية متخصصة في أنشطة مكة
                    </p>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="card h-100 border-0 shadow-sm animate-on-scroll">
                                <div class="card-body p-4 p-md-5">
                                    <h4 class="mb-4">معلومات التواصل</h4>
                                    <div class="footer-contact mb-4">
                                        <p><i class="fas fa-phone"></i> ٠٥٥-١٢٣-٤٥٦٧</p>
                                        <p><i class="fas fa-envelope"></i> info@makkahonline.com</p>
                                        <p><i class="fas fa-map-marker-alt"></i> مكة المكرمة، المملكة العربية السعودية</p>
                                    </div>
                                    
                                    <h5 class="mb-3">تابعنا على</h5>
                                    <div class="social-icons">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="card h-100 border-0 shadow-sm animate-on-scroll" style="transition-delay: 0.2s">
                                <div class="card-body p-4 p-md-5">
                                    <h4 class="mb-4">سجل معنا الآن</h4>
                                    <form class="contact-form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" placeholder="اسم النشاط التجاري" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" placeholder="اسم المسؤول" required>
                                            </div>
                                        </div>
                                        <input type="tel" class="form-control" placeholder="رقم الجوال" required>
                                        <input type="email" class="form-control" placeholder="البريد الإلكتروني" required>
                                        <select class="form-select" required>
                                            <option value="" selected disabled>اختر نوع النشاط</option>
                                            <option>فندق / إقامة</option>
                                            <option>مطعم / مقهى</option>
                                            <option>تأجير سيارات</option>
                                            <option>بصريات</option>
                                            <option>مصاعد / صيانة</option>
                                            <option>معارض تجارية</option>
                                            <option>خدمات سياحية</option>
                                            <option>أنشطة أخرى</option>
                                        </select>
                                        <select class="form-select" required>
                                            <option value="" selected disabled>اختر الباقة المطلوبة</option>
                                            <option>الباقة الأساسية - 500 ريال سنوياً</option>
                                            <option>الباقة المميزة - 1000 ريال سنوياً</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary w-100">إرسال طلب الانضمام</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h4 class="footer-title"><i class="fas fa-kaaba me-2"></i>مكة اون لاين</h4>
                    <p class="mb-4">
                        المنصة الرقمية الشاملة لأنشطة وخدمات مكة المكرمة. نوفر لك وصولاً أوسع لعملائك وزيادة في ظهور نشاطك التجاري من خلال منصتنا المتخصصة.
                    </p>
                    <p>جميع الحقوق محفوظة © 2023</p>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h4 class="footer-title">روابط سريعة</h4>
                    <div class="footer-links">
                        <a href="#home">الرئيسية</a>
                        <a href="#services">الخدمات</a>
                        <a href="#features">المميزات</a>
                        <a href="#pricing">الباقات</a>
                        <a href="#contact">اتصل بنا</a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <h4 class="footer-title">الخدمات الرئيسية</h4>
                    <div class="footer-links">
                        <a href="#services">الفنادق والإقامة</a>
                        <a href="#services">المطاعم والكافيهات</a>
                        <a href="#services">تأجير السيارات</a>
                        <a href="#services">محلات البصريات</a>
                        <a href="#services">المصاعد والصيانة</a>
                    </div>
                </div>
         
            </div>
            
            <div class="copyright">
                <p>مكة اون لاين - المنصة الرقمية المتخصصة في أنشطة مكة المكرمة | تم التصميم والبرمجة بدقة وعناية</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Update active nav link
                    document.querySelectorAll('.nav-link').forEach(link => {
                        link.classList.remove('active');
                    });
                    this.classList.add('active');
                }
            });
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
            
            // Update active nav link based on scroll position
            const sections = document.querySelectorAll('section[id]');
            const scrollPos = window.scrollY + 100;
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                const sectionId = section.getAttribute('id');
                
                if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                    document.querySelectorAll('.nav-link').forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${sectionId}`) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        });
        
        // Animation on scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.animate-on-scroll');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.2;
                
                if(elementPosition < screenPosition) {
                    element.classList.add('animated');
                }
            });
            
            // Animate counter
            const counters = document.querySelectorAll('.stat-number');
            const speed = 200;
            
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-count');
                const count = +counter.innerText;
                const increment = target / speed;
                
                if(count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(animateOnScroll, 1);
                } else {
                    counter.innerText = target;
                }
            });
        }
        
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
        
        // Form submission
        document.querySelector('.contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('تم إرسال طلب الانضمام بنجاح! سنتصل بك خلال 24 ساعة.');
            this.reset();
        });
    </script>
</body>
</html>