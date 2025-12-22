<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مكة أون لاين - وجهتك الشاملة لكل خدمات مكة المكرمة</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Animate.css للأنيميشن -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --gold: #D4AF37;
            --dark-gold: #B8860B;
            --light-gold: #F5E8AA;
            --black: #121212;
            --white: #FFFFFF;
            --gray: #F8F9FA;
            --dark-gray: #6C757D;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--black);
            background-color: var(--white);
            line-height: 1.8;
        }
        
        /* تخصيص شريط التنقل */
        .navbar {
            background-color: var(--black);
            padding: 1rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: var(--gold) !important;
        }
        
        .navbar-nav .nav-link {
            color: var(--white) !important;
            margin: 0 5px;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .navbar-nav .nav-link:hover {
            color: var(--gold) !important;
        }
        
        /* قسم الهيرو */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1548013146-72479768bada?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80') center/cover no-repeat;
            color: var(--white);
            padding: 100px 0;
            text-align: center;
        }
        
        .hero-section h1 {
            font-size: 3.2rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }
        
        .hero-section p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 2rem;
        }
        
        .gold-text {
            color: var(--gold);
        }
        
        /* الأقسام العامة */
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            padding-bottom: 15px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--gold);
        }
        
        .section-padding {
            padding: 80px 0;
        }
        
        /* قسم الخدمات */
        .service-card {
            background: var(--white);
            border-radius: 10px;
            padding: 30px 20px;
            text-align: center;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid rgba(212, 175, 55, 0.1);
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(212, 175, 55, 0.15);
        }
        
        .service-icon {
            font-size: 3rem;
            color: var(--gold);
            margin-bottom: 1.5rem;
        }
        
        /* قسم الاشتراكات */
        .pricing-card {
            background: var(--white);
            border-radius: 10px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }
        
        .pricing-card.popular {
            border-color: var(--gold);
            transform: scale(1.05);
        }
        
        .pricing-card.popular:before {
            content: 'الأكثر طلباً';
            position: absolute;
            top: 20px;
            left: -30px;
            background: var(--gold);
            color: var(--black);
            padding: 5px 40px;
            transform: rotate(-45deg);
            font-weight: bold;
            font-size: 0.8rem;
        }
        
        .pricing-card:hover {
            box-shadow: 0 15px 40px rgba(212, 175, 55, 0.2);
        }
        
        .price {
            font-size: 3rem;
            font-weight: bold;
            color: var(--gold);
            margin: 20px 0;
        }
        
        .price span {
            font-size: 1.2rem;
            color: var(--dark-gray);
        }
        
        .features-list {
            list-style: none;
            padding: 0;
            margin: 30px 0;
        }
        
        .features-list li {
            padding: 10px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .features-list li:last-child {
            border-bottom: none;
        }
        
        .btn-gold {
            background-color: var(--gold);
            color: var(--black);
            padding: 12px 30px;
            font-weight: bold;
            border-radius: 5px;
            border: none;
            transition: all 0.3s;
        }
        
        .btn-gold:hover {
            background-color: var(--dark-gold);
            color: var(--white);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3);
        }
        
        /* قسم التسجيل */
        .register-section {
            background-color: var(--gray);
        }
        
        .register-form {
            background: var(--white);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .form-control {
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        
        .form-control:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
        }
        
        /* الفوتر */
        footer {
            background-color: var(--black);
            color: var(--white);
            padding: 60px 0 30px;
        }
        
        .footer-logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--gold);
            margin-bottom: 20px;
        }
        
        .footer-links h5 {
            color: var(--gold);
            margin-bottom: 20px;
            font-size: 1.2rem;
        }
        
        .footer-links ul {
            list-style: none;
            padding: 0;
        }
        
        .footer-links ul li {
            margin-bottom: 10px;
        }
        
        .footer-links ul li a {
            color: var(--white);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links ul li a:hover {
            color: var(--gold);
        }
        
        .copyright {
            text-align: center;
            padding-top: 30px;
            margin-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--dark-gray);
        }
        
        /* الأنيميشن */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s, transform 0.8s;
        }
        
        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* تصميم متجاوب */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }
            
            .section-padding {
                padding: 50px 0;
            }
            
            .pricing-card.popular {
                transform: scale(1);
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- شريط التنقل -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-building"></i> مكة أون لاين
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">الخدمات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">الباقات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#register">التسجيل</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">اتصل بنا</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- قسم الهيرو -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1 class="animate__animated animate__fadeInDown">
                        <span class="gold-text">مكة أون لاين</span> - وجهتك الشاملة لكل خدمات مكة المكرمة
                    </h1>
                    <p class="animate__animated animate__fadeInUp animate__delay-1s">
                        منصة متكاملة تقدم جميع الخدمات والأنشطة في مكة المكرمة. نوفر لك ملف تعريف إلكتروني متكامل لنشاطك التجاري يصل إلى آلاف الزوار يوميًا.
                    </p>
                    <a href="#pricing" class="btn btn-gold btn-lg animate__animated animate__fadeIn animate__delay-2s">
                        ابدأ الآن <i class="bi bi-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم الخدمات -->
    <section id="services" class="section-padding">
        <div class="container">
            <h2 class="section-title animate-on-scroll">خدماتنا المتكاملة</h2>
            <p class="text-center mb-5 animate-on-scroll">نقدم مجموعة شاملة من الخدمات التي تغطي جميع احتياجات الزوار والمقيمين في مكة المكرمة</p>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="service-card animate-on-scroll">
                        <div class="service-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <h4>الفنادق والإقامة</h4>
                        <p>دليل شامل لأفضل الفنادق والشقق الفندقية في مكة مع تفاصيل الأسعار والمرافق وتقييمات النزلاء.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="service-card animate-on-scroll">
                        <div class="service-icon">
                            <i class="bi bi-cup-hot"></i>
                        </div>
                        <h4>المطاعم والمقاهي</h4>
                        <p>أشهى المطاعم وأفضل المقاهي في مكة مع قوائم الطعام والأسعار والموقع وخدمات التوصيل.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="service-card animate-on-scroll">
                        <div class="service-icon">
                            <i class="bi bi-car-front"></i>
                        </div>
                        <h4>المواصلات والنقل</h4>
                        <p>خدمات النقل من والى المطارات، تأجير السيارات، وسائل النقل العام وخدمات التوصيل داخل مكة.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="service-card animate-on-scroll">
                        <div class="service-icon">
                            <i class="bi bi-bag-check"></i>
                        </div>
                        <h4>التسوق والمولات</h4>
                        <p>دليل شامل لأهم المراكز التجارية والمولات والأسواق الشعبية في مكة مع عروض وتخفيضات حصرية.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="service-card animate-on-scroll">
                        <div class="service-icon">
                            <i class="bi bi-heart-pulse"></i>
                        </div>
                        <h4>الخدمات الطبية</h4>
                        <p>دليل المستشفيات والعيادات والصيدليات وخدمات الطوارئ في مكة مع مواعيد العمل وخدمات الحجز.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="service-card animate-on-scroll">
                        <div class="service-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <h4>الأنشطة السياحية</h4>
                        <p>معالم مكة السياحية، البرامج الدينية، الرحلات والأنشطة الترفيهية المناسبة للعائلات والأفراد.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم الباقات -->
    <section id="pricing" class="section-padding bg-light">
        <div class="container">
            <h2 class="section-title animate-on-scroll">باقات الاشتراك السنوية</h2>
            <p class="text-center mb-5 animate-on-scroll">اختر الباقة المناسبة لنشاطك التجاري واستمتع بملف تعريف احترافي على منصتنا</p>
            
            <div class="row justify-content-center">
                <!-- الباقة الأساسية -->
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="pricing-card h-100 animate-on-scroll">
                        <h3>الباقة الأساسية</h3>
                        <div class="price">500 <span>ريال/سنوي</span></div>
                        <ul class="features-list">
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> ملف تعريف كامل للنشاط</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> إدراج في دليل الخدمات</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> عرض معلومات الاتصال والموقع</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> تقييمات ومراجعات العملاء</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> تحديث المحتوى شهرياً</li>
                            <li><i class="bi bi-x-circle-fill text-danger me-2"></i> عرض مميز في نتائج البحث</li>
                            <li><i class="bi bi-x-circle-fill text-danger me-2"></i> إعلانات ممولة داخل المنصة</li>
                        </ul>
                        <a href="#register" class="btn btn-gold w-100">اشترك الآن</a>
                    </div>
                </div>
                
                <!-- الباقة المميزة -->
                <div class="col-lg-5">
                    <div class="pricing-card popular h-100 animate-on-scroll">
                        <h3>الباقة المميزة</h3>
                        <div class="price">1000 <span>ريال/سنوي</span></div>
                        <ul class="features-list">
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> كل مزايا الباقة الأساسية</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> عرض مميز في نتائج البحث</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> إعلانات ممولة داخل المنصة</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> صفحة ويب مخصصة متطورة</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> تحديث المحتوى أسبوعياً</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> إحصائيات مفصلة عن الزوار</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> دعم فني متميز على مدار الساعة</li>
                        </ul>
                        <a href="#register" class="btn btn-gold w-100">اشترك الآن</a>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-12">
                    <div class="alert alert-info text-center animate-on-scroll">
                        <h5><i class="bi bi-info-circle me-2"></i> ملاحظة هامة</h5>
                        <p class="mb-0">جميع الباقات تشمل تصميم ملف تعريف احترافي، الاستضافة والصيانة الدورية، الظهور في محركات البحث، والتحديثات الأمنية.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم التسجيل -->
    <section id="register" class="section-padding register-section">
        <div class="container">
            <h2 class="section-title animate-on-scroll">سجل نشاطك التجاري الآن</h2>
            <p class="text-center mb-5 animate-on-scroll">املأ النموذج التالي وسنتصل بك خلال 24 ساعة لتفعيل اشتراكك</p>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="register-form animate-on-scroll">
                        <form id="registrationForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="اسم النشاط التجاري" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="اسم المسؤول" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="tel" class="form-control" placeholder="رقم الهاتف" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="البريد الإلكتروني" required>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" required>
                                        <option value="" disabled selected>اختر فئة النشاط</option>
                                        <option>فندق أو سكن</option>
                                        <option>مطعم أو مقهى</option>
                                        <option>مواصلات ونقل</option>
                                        <option>تسوق وتجزئة</option>
                                        <option>خدمات طبية</option>
                                        <option>أنشطة سياحية</option>
                                        <option>خدمات أخرى</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" required>
                                        <option value="" disabled selected>اختر باقة الاشتراك</option>
                                        <option>الباقة الأساسية (500 ريال/سنوي)</option>
                                        <option>الباقة المميزة (1000 ريال/سنوي)</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" rows="4" placeholder="وصف مختصر للنشاط (اختياري)"></textarea>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-gold btn-lg">
                                        <i class="bi bi-send me-2"></i> إرسال طلب التسجيل
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- الفوتر -->
    <footer id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="footer-logo">
                        <i class="bi bi-building"></i> مكة أون لاين
                    </div>
                    <p>المنصة الشاملة لكل الخدمات والأنشطة في مكة المكرمة. نوفر ملف تعريف إلكتروني متكامل لكل نشاط تجاري في مكة.</p>
                    <div class="mt-4">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter fs-4"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-whatsapp fs-4"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <div class="footer-links">
                        <h5>روابط سريعة</h5>
                        <ul>
                            <li><a href="#home">الرئيسية</a></li>
                            <li><a href="#services">الخدمات</a></li>
                            <li><a href="#pricing">الباقات</a></li>
                            <li><a href="#register">التسجيل</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                    <div class="footer-links">
                        <h5>خدماتنا</h5>
                        <ul>
                            <li><a href="#">الفنادق والإقامة</a></li>
                            <li><a href="#">المطاعم والمقاهي</a></li>
                            <li><a href="#">المواصلات والنقل</a></li>
                            <li><a href="#">التسوق والمولات</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4">
                    <div class="footer-links">
                        <h5>اتصل بنا</h5>
                        <ul>
                            <li><i class="bi bi-geo-alt me-2"></i> مكة المكرمة، المملكة العربية السعودية</li>
                            <li><i class="bi bi-telephone me-2"></i> 9200XXXXX</li>
                            <li><i class="bi bi-envelope me-2"></i> info@makkahonline.com</li>
                            <li><i class="bi bi-clock me-2"></i> الأحد - الخميس 8ص - 5م</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="copyright">
                <p>© 2023 مكة أون لاين. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS مع Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // كود لتفعيل الأنيميشن عند التمرير
        document.addEventListener('DOMContentLoaded', function() {
            // تنفيذ الأنيميشن عند التمرير
            const animateElements = document.querySelectorAll('.animate-on-scroll');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                    }
                });
            }, {
                threshold: 0.1
            });
            
            animateElements.forEach(element => {
                observer.observe(element);
            });
            
            // تنعيم التنقل بين الأقسام
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // معالجة نموذج التسجيل
            const registrationForm = document.getElementById('registrationForm');
            if (registrationForm) {
                registrationForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // هنا يمكن إضافة كود إرسال البيانات إلى الخادم
                    alert('تم استلام طلب التسجيل بنجاح! سوف نتصل بك خلال 24 ساعة.');
                    registrationForm.reset();
                    
                    // التمرير إلى الأعلى
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
            
            // إضافة تأثير على شريط التنقل عند التمرير
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 100) {
                    navbar.style.padding = '0.5rem 0';
                    navbar.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
                } else {
                    navbar.style.padding = '1rem 0';
                    navbar.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
                }
            });
        });
    </script>
</body>
</html>