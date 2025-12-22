<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اللهم صل على سيدنا محمد - تجربة روحانية فاخرة</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;700&family=Amiri:wght@400;700&family=Reem+Kufi:wght@400;700&display=swap" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    
    <style>
        :root {
            --gold-primary: #FFD700;
            --gold-secondary: #FFA500;
            --gold-light: #FFF9C4;
            --gold-dark: #B8860B;
            
            --green-primary: #0a5c36;
            --green-secondary: #1a472a;
            --green-light: #2E8B57;
            --green-lime: #32CD32;
            
            --blue-primary: #1e3c72;
            --blue-secondary: #2a5298;
            --blue-light: #4169E1;
            
            --purple-primary: #4A235A;
            --purple-secondary: #6C3483;
            
            --cream-light: #FFF8E1;
            --cream-dark: #F5E6CA;
            
            --dark-bg: #0a1929;
            --dark-card: #1a2b3c;
            
            --text-light: #f8f9fa;
            --text-gold: #FFD700;
            
            --shadow-lg: 0 20px 50px rgba(0, 0, 0, 0.3);
            --shadow-xl: 0 30px 60px rgba(0, 0, 0, 0.4);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Noto Naskh Arabic', 'Amiri', serif;
            background: linear-gradient(135deg, #0a1929 0%, #1a2b3c 100%);
            color: var(--text-light);
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
        }
        
        /* خلفية الجسيمات المتحركة */
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -2;
        }
        
        /* تأثير الإضاءة الذهبية */
        .golden-glow {
            position: fixed;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 30%, rgba(255, 215, 0, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(255, 165, 0, 0.12) 0%, transparent 40%),
                radial-gradient(circle at 40% 80%, rgba(10, 92, 54, 0.1) 0%, transparent 40%);
            z-index: -1;
            pointer-events: none;
        }
        
        /* شريط التنقل الفاخر */
        .navbar-majestic {
            background: rgba(10, 25, 41, 0.95);
            backdrop-filter: blur(15px);
            border-bottom: 2px solid var(--gold-primary);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            padding: 15px 0;
            transition: all 0.5s ease;
            z-index: 1000;
        }
        
        .navbar-majestic.scrolled {
            padding: 10px 0;
            background: rgba(26, 43, 60, 0.98);
            border-bottom: 2px solid var(--green-light);
        }
        
        .nav-logo {
            font-family: 'Reem Kufi', sans-serif;
            font-size: 1.8rem;
            background: linear-gradient(to right, var(--gold-primary), var(--gold-light));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(255, 215, 0, 0.3);
        }
        
        .nav-icon {
            color: var(--gold-primary);
            margin-left: 8px;
            font-size: 1.5rem;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }
        
        /* القسم الرئيسي */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 100px 20px 50px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-content {
            max-width: 1200px;
            text-align: center;
            z-index: 10;
        }
        
        .main-prayer-container {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.03));
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 60px 40px;
            margin: 40px auto;
            border: 2px solid rgba(255, 215, 0, 0.3);
            box-shadow: 
                var(--shadow-xl), 
                inset 0 0 60px rgba(255, 215, 0, 0.1),
                0 0 40px rgba(10, 92, 54, 0.2);
            position: relative;
            overflow: hidden;
            max-width: 900px;
        }
        
        .main-prayer-container::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, 
                var(--gold-primary), 
                var(--green-light), 
                var(--blue-light), 
                var(--gold-primary));
            z-index: -1;
            border-radius: 32px;
            animation: rotate-border 8s linear infinite;
            opacity: 0.7;
        }
        
        .main-prayer-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, 
                rgba(255, 215, 0, 0.05) 0%, 
                rgba(10, 92, 54, 0.1) 50%, 
                rgba(30, 60, 114, 0.05) 100%);
            z-index: -1;
            border-radius: 30px;
        }
        
        @keyframes rotate-border {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .main-prayer-text {
            font-size: 3.8rem;
            font-weight: 700;
            line-height: 1.4;
            background: linear-gradient(to right, 
                var(--gold-primary) 0%, 
                var(--gold-light) 30%, 
                var(--green-lime) 70%, 
                var(--gold-primary) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
            margin-bottom: 30px;
            position: relative;
            animation: float 6s ease-in-out infinite;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.5));
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        .prayer-subtitle {
            font-size: 1.5rem;
            color: var(--cream-light);
            margin-bottom: 40px;
            max-width: 700px;
            margin-right: auto;
            margin-left: auto;
            line-height: 1.8;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }
        
        /* أزرار تفاعلية */
        .btn-golden {
            background: linear-gradient(135deg, var(--gold-primary) 0%, var(--gold-dark) 100%);
            color: #000;
            border: none;
            padding: 18px 45px;
            font-size: 1.3rem;
            font-weight: 700;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 
                0 10px 25px rgba(255, 215, 0, 0.4),
                inset 0 1px 1px rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
            z-index: 1;
            margin: 10px;
            border: 1px solid rgba(255, 215, 0, 0.5);
        }
        
        .btn-golden::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.3) 0%, rgba(255, 255, 255, 0.1) 100%);
            transition: all 0.5s ease;
            z-index: -1;
        }
        
        .btn-golden:hover::before {
            width: 100%;
        }
        
        .btn-golden:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 
                0 15px 35px rgba(255, 215, 0, 0.6),
                inset 0 1px 1px rgba(255, 255, 255, 0.5);
            color: #000;
        }
        
        .btn-green {
            background: linear-gradient(135deg, var(--green-light) 0%, var(--green-primary) 100%);
            color: white;
            border: none;
            padding: 18px 45px;
            font-size: 1.3rem;
            font-weight: 700;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 
                0 10px 25px rgba(10, 92, 54, 0.4),
                inset 0 1px 1px rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
            z-index: 1;
            margin: 10px;
            border: 1px solid rgba(46, 139, 87, 0.5);
        }
        
        .btn-green:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 
                0 15px 35px rgba(10, 92, 54, 0.6),
                inset 0 1px 1px rgba(255, 255, 255, 0.5);
            color: white;
        }
        
        /* تأثيرات الشرر */
        .sparkle-effect {
            position: absolute;
            pointer-events: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            overflow: hidden;
        }
        
        .spark {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--gold-primary);
            border-radius: 50%;
            box-shadow: 
                0 0 10px 2px var(--gold-primary),
                0 0 20px 4px var(--gold-light);
            animation: sparkle 1.5s infinite alternate;
        }
        
        .spark-green {
            background: var(--green-lime);
            box-shadow: 
                0 0 10px 2px var(--green-lime),
                0 0 20px 4px rgba(50, 205, 50, 0.5);
        }
        
        @keyframes sparkle {
            0% { opacity: 0; transform: scale(0.5); }
            50% { opacity: 1; }
            100% { opacity: 0; transform: scale(1.5) translateY(-50px); }
        }
        
        /* العدادات */
        .counter-container {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.03));
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            margin: 30px auto;
            border: 1px solid rgba(255, 215, 0, 0.2);
            box-shadow: 
                var(--shadow-lg),
                inset 0 0 30px rgba(10, 92, 54, 0.1);
            max-width: 800px;
        }
        
        .counter-box {
            text-align: center;
            padding: 25px;
            border-radius: 15px;
            background: linear-gradient(145deg, rgba(26, 43, 60, 0.8), rgba(10, 25, 41, 0.8));
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 215, 0, 0.1);
            box-shadow: 
                0 5px 15px rgba(0, 0, 0, 0.2),
                inset 0 1px 1px rgba(255, 255, 255, 0.1);
        }
        
        .counter-box:hover {
            transform: translateY(-10px);
            border-color: rgba(255, 215, 0, 0.3);
            box-shadow: 
                0 15px 30px rgba(255, 215, 0, 0.1),
                inset 0 1px 1px rgba(255, 255, 255, 0.2);
        }
        
        .counter-number {
            font-size: 4rem;
            font-weight: 700;
            background: linear-gradient(to right, var(--gold-primary), var(--green-lime));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            line-height: 1;
            margin: 15px 0;
            filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.3));
        }
        
        /* تقدم المهام */
        .progress-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.03));
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 215, 0, 0.2);
            box-shadow: 
                var(--shadow-lg),
                inset 0 0 30px rgba(30, 60, 114, 0.1);
        }
        
        .progress-bar-gold {
            height: 25px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
            overflow: hidden;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, 
                var(--gold-primary) 0%, 
                var(--green-lime) 50%, 
                var(--blue-light) 100%);
            border-radius: 15px;
            transition: width 1s ease-in-out;
            position: relative;
            overflow: hidden;
            box-shadow: 
                0 0 10px rgba(255, 215, 0, 0.5),
                inset 0 1px 1px rgba(255, 255, 255, 0.3);
        }
        
        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background-image: linear-gradient(
                -45deg, 
                rgba(255, 255, 255, 0.2) 25%, 
                transparent 25%, 
                transparent 50%, 
                rgba(255, 255, 255, 0.2) 50%, 
                rgba(255, 255, 255, 0.2) 75%, 
                transparent 75%, 
                transparent
            );
            background-size: 50px 50px;
            animation: move-stripes 2s linear infinite;
        }
        
        @keyframes move-stripes {
            0% { background-position: 0 0; }
            100% { background-position: 50px 0; }
        }
        
        /* الأقسام */
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 40px;
            position: relative;
            padding-bottom: 20px;
            background: linear-gradient(to right, var(--gold-primary), var(--green-light));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 50%;
            transform: translateX(50%);
            width: 150px;
            height: 4px;
            background: linear-gradient(to right, var(--gold-primary), var(--green-light));
            border-radius: 2px;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }
        
        .virtue-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.03));
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            border: 1px solid rgba(255, 215, 0, 0.1);
            transition: all 0.4s ease;
            height: 100%;
            box-shadow: 
                0 5px 15px rgba(0, 0, 0, 0.1),
                inset 0 1px 1px rgba(255, 255, 255, 0.05);
        }
        
        .virtue-card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: rgba(255, 215, 0, 0.3);
            box-shadow: 
                0 15px 30px rgba(255, 215, 0, 0.15),
                inset 0 1px 1px rgba(255, 255, 255, 0.1);
        }
        
        .virtue-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            background: linear-gradient(to right, var(--gold-primary), var(--green-light));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            filter: drop-shadow(0 3px 5px rgba(0, 0, 0, 0.3));
        }
        
        /* التأثيرات الصوتية والمرئية */
        .visual-effects {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 5;
        }
        
        .prayer-flower {
            position: absolute;
            font-size: 2rem;
            opacity: 0;
            animation: flower-fall linear forwards;
            filter: drop-shadow(0 5px 5px rgba(0, 0, 0, 0.5));
        }
        
        @keyframes flower-fall {
            0% {
                opacity: 1;
                transform: translateY(-100px) rotate(0deg);
            }
            100% {
                opacity: 0;
                transform: translateY(100vh) rotate(360deg);
            }
        }
        
        /* المؤثرات الصوتية */
        .audio-controls {
            position: fixed;
            bottom: 30px;
            left: 30px;
            z-index: 100;
        }
        
        .audio-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-dark));
            color: #000;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 
                0 10px 20px rgba(0, 0, 0, 0.3),
                0 0 15px rgba(255, 215, 0, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 215, 0, 0.5);
        }
        
        .audio-btn:hover {
            transform: scale(1.1);
            box-shadow: 
                0 15px 25px rgba(0, 0, 0, 0.4),
                0 0 20px rgba(255, 215, 0, 0.7);
        }
        
        /* التذييل */
        .footer-majestic {
            background: linear-gradient(to top, rgba(10, 25, 41, 0.95), rgba(26, 43, 60, 0.95));
            backdrop-filter: blur(10px);
            border-top: 2px solid rgba(255, 215, 0, 0.3);
            padding: 50px 0 20px;
            margin-top: 80px;
            box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.3);
        }
        
        .footer-title {
            background: linear-gradient(to right, var(--gold-primary), var(--cream-light));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        /* التكيف مع الأجهزة المحمولة */
        @media (max-width: 768px) {
            .main-prayer-text {
                font-size: 2.5rem;
            }
            
            .hero-section {
                padding: 80px 15px 30px;
            }
            
            .main-prayer-container {
                padding: 40px 20px;
            }
            
            .counter-number {
                font-size: 3rem;
            }
            
            .btn-golden, .btn-green {
                padding: 15px 30px;
                font-size: 1.1rem;
                margin: 5px;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
        
        /* تأثيرات إضافية */
        .glowing-text {
            text-shadow: 
                0 0 10px rgba(255, 215, 0, 0.7),
                0 0 20px rgba(255, 215, 0, 0.5),
                0 0 30px rgba(255, 215, 0, 0.3);
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(255, 215, 0, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(255, 215, 0, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 215, 0, 0); }
        }
    </style>
</head>
<body>
    <!-- خلفية الجسيمات المتحركة -->
    <div id="particles-js"></div>
    <div class="golden-glow"></div>
    
    <!-- شريط التنقل -->
    <nav class="navbar navbar-expand-lg navbar-majestic fixed-top">
        <div class="container">
            <a class="navbar-brand nav-logo" href="#">
                <i class="fas fa-star-and-crescent nav-icon"></i> نور المصطفى
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars" style="color: var(--gold-primary);"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home" style="color: var(--cream-light);">
                            <i class="fas fa-home" style="color: var(--gold-primary);"></i> الرئيسية
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#virtues" style="color: var(--cream-light);">
                            <i class="fas fa-crown" style="color: var(--gold-primary);"></i> فضائل الصلاة
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#counter" style="color: var(--cream-light);">
                            <i class="fas fa-trophy" style="color: var(--gold-primary);"></i> الإنجازات
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about" style="color: var(--cream-light);">
                            <i class="fas fa-info-circle" style="color: var(--gold-primary);"></i> عن المشروع
                        </a>
                    </li>
                </ul>
                <div class="d-flex">
                    <span class="navbar-text me-3 glowing-text" style="color: var(--gold-light);">
                        <i class="fas fa-pray" style="color: var(--gold-primary);"></i> صلّوا على الحبيب
                    </span>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- القسم الرئيسي -->
    <section id="home" class="hero-section">
        <div class="hero-content">
            <div class="main-prayer-container">
                <div class="sparkle-effect" id="sparkle-effect"></div>
                <h1 class="main-prayer-text" id="main-prayer-text">
                    اَللَّهُمَّ صَلِّ عَلَى سَيِّدِنَا مُحَمَّدٍ وَعَلَى آلِ سَيِّدِنَا مُحَمَّدٍ
                </h1>
                <p class="prayer-subtitle">
                    "مَن صَلَّى عَلَيَّ صَلَاةً صَلَّى اللَّهُ عَلَيْهِ بِهَا عَشْرًا" - رواه مسلم
                </p>
                
                <div class="text-center mt-4">
                    <button class="btn-golden pulse-animation" id="pray-btn">
                        <i class="fas fa-hands-praying"></i> صلّ على النبي الآن
                    </button>
                    <button class="btn-green" id="auto-pray-btn">
                        <i class="fas fa-play-circle"></i> التشغيل التلقائي
                    </button>
                    <button class="btn-golden" id="flower-effect-btn">
                        <i class="fas fa-feather-alt"></i> تأثير الزهور
                    </button>
                </div>
                
                <div class="counter-container mt-5">
                    <div class="row text-center">
                        <div class="col-md-4 mb-4">
                            <div class="counter-box">
                                <h4 style="color: var(--cream-light);"><i class="fas fa-clock" style="color: var(--gold-primary);"></i> الصلوات اليوم</h4>
                                <div class="counter-number" id="daily-counter">0</div>
                                <p style="color: var(--cream-light);">عدد صلواتك اليوم</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="counter-box">
                                <h4 style="color: var(--cream-light);"><i class="fas fa-chart-line" style="color: var(--green-lime);"></i> الإجمالي</h4>
                                <div class="counter-number" id="total-counter">0</div>
                                <p style="color: var(--cream-light);">إجمالي صلواتك</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="counter-box">
                                <h4 style="color: var(--cream-light);"><i class="fas fa-medal" style="color: var(--gold-primary);"></i> أعلى معدل</h4>
                                <div class="counter-number" id="record-counter">0</div>
                                <p style="color: var(--cream-light);">أعلى عدد في يوم</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- فضائل الصلاة -->
    <section id="virtues" class="py-5" style="background: linear-gradient(to bottom, rgba(10, 25, 41, 0.5), rgba(26, 43, 60, 0.8));">
        <div class="container">
            <h2 class="section-title">فضائل الصلاة على النبي ﷺ</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="virtue-card">
                        <div class="virtue-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h4 style="color: var(--gold-light);">طاعة لله تعالى</h4>
                        <p style="color: var(--cream-light);">الصلاة على النبي ﷺ من أعظم الطاعات وأحبها إلى الله تعالى، وهي امتثال لأمره في القرآن الكريم.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="virtue-card">
                        <div class="virtue-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4 style="color: var(--gold-light);">مغفرة الذنوب</h4>
                        <p style="color: var(--cream-light);">كل صلاة على النبي ﷺ تمحو بها الخطايا وترفع بها الدرجات عند الله تعالى.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="virtue-card">
                        <div class="virtue-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h4 style="color: var(--gold-light);">سبب للشفاعة</h4>
                        <p style="color: var(--cream-light);">من أكثر من الصلاة على النبي ﷺ كان أحق الناس بشفاعته يوم القيامة.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="virtue-card">
                        <div class="virtue-icon">
                            <i class="fas fa-gem"></i>
                        </div>
                        <h4 style="color: var(--gold-light);">قضاء الحوائج</h4>
                        <p style="color: var(--cream-light);">من كانت له حاجة فليكثر من الصلاة على النبي ﷺ، فإنها سبب لقضاء الحوائج وتفريج الكروب.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="virtue-card">
                        <div class="virtue-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <h4 style="color: var(--gold-light);">رفعة الدرجات</h4>
                        <p style="color: var(--cream-light);">البخيل من ذُكر النبي عنده فلم يصل عليه، والمكثر من الصلاة عليه من أعلى الناس درجة عند الله.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="virtue-card">
                        <div class="virtue-icon">
                            <i class="fas fa-scale-balanced"></i>
                        </div>
                        <h4 style="color: var(--gold-light);">تثقل الميزان</h4>
                        <p style="color: var(--cream-light);">الصلاة على النبي ﷺ من الأعمال التي تثقل ميزان الحسنات يوم القيامة.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- تقدم المهام -->
    <section id="counter" class="py-5">
        <div class="container">
            <h2 class="section-title">تقدمك نحو الأهداف</h2>
            <div class="progress-container">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h4 style="color: var(--cream-light);">الهدف اليومي: 100 صلاة على النبي</h4>
                    </div>
                    <div class="col-md-4 text-left">
                        <span id="progress-percent" style="color: var(--gold-primary); font-weight: bold; font-size: 1.2rem;">0%</span>
                    </div>
                </div>
                <div class="progress-bar-gold">
                    <div class="progress-fill" id="progress-fill" style="width: 0%"></div>
                </div>
                
                <div class="row mt-5">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="counter-box">
                            <h5 style="color: var(--cream-light);">100 صلاة</h5>
                            <div class="counter-number small">🎯</div>
                            <small style="color: var(--cream-light);">الهدف الأول</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="counter-box">
                            <h5 style="color: var(--cream-light);">1000 صلاة</h5>
                            <div class="counter-number small">🏆</div>
                            <small style="color: var(--cream-light);">مستوى متقدم</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="counter-box">
                            <h5 style="color: var(--cream-light);">10000 صلاة</h5>
                            <div class="counter-number small">👑</div>
                            <small style="color: var(--cream-light);">مستوى متميز</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="counter-box">
                            <h5 style="color: var(--cream-light);">70000 صلاة</h5>
                            <div class="counter-number small">🕌</div>
                            <small style="color: var(--cream-light);">درجة الوفاء</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- المؤثرات المرئية -->
    <div class="visual-effects" id="visual-effects"></div>
    
    <!-- التحكم الصوتي -->
    <div class="audio-controls">
        <button class="audio-btn" id="audio-toggle">
            <i class="fas fa-volume-up"></i>
        </button>
    </div>
    
    <!-- التذييل -->
    <footer class="footer-majestic">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h3 class="footer-title mb-3">نور المصطفى</h3>
                    <p style="color: var(--cream-light);">مشروع مخصص للصلاة على النبي محمد ﷺ بأفضل الصور وأجمل العبارات، لنشر محبة الحبيب المصطفى.</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h4 class="mb-3" style="color: var(--gold-light);">روابط سريعة</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#home" class="text-light text-decoration-none"><i class="fas fa-arrow-left me-2" style="color: var(--gold-primary);"></i>الرئيسية</a></li>
                        <li class="mb-2"><a href="#virtues" class="text-light text-decoration-none"><i class="fas fa-arrow-left me-2" style="color: var(--gold-primary);"></i>فضائل الصلاة</a></li>
                        <li class="mb-2"><a href="#counter" class="text-light text-decoration-none"><i class="fas fa-arrow-left me-2" style="color: var(--gold-primary);"></i>تتبع التقدم</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h4 class="mb-3" style="color: var(--gold-light);">آيات وأحاديث</h4>
                    <p class="fst-italic" style="color: var(--cream-light);">"إِنَّ اللَّهَ وَمَلَائِكَتَهُ يُصَلُّونَ عَلَى النَّبِيِّ يَا أَيُّهَا الَّذِينَ آمَنُوا صَلُّوا عَلَيْهِ وَسَلِّمُوا تَسْلِيمًا"</p>
                    <p class="text-end" style="color: var(--gold-primary);">سورة الأحزاب: ٥٦</p>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255, 215, 0, 0.2);">
            <div class="text-center">
                <p style="color: var(--cream-light);">© <span id="current-year">2023</span> - جميع الحقوق محفوظة | صنع بحب وبركة الصلاة على النبي ﷺ</p>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // تهيئة الجسيمات المتحركة في الخلفية
        document.addEventListener('DOMContentLoaded', function() {
            // تهيئة نظام الجسيمات
            particlesJS("particles-js", {
                particles: {
                    number: { value: 100, density: { enable: true, value_area: 800 } },
                    color: { value: ["#FFD700", "#0a5c36", "#1e3c72"] },
                    shape: { type: "circle" },
                    opacity: { value: 0.6, random: true },
                    size: { value: 3, random: true },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: "#FFD700",
                        opacity: 0.2,
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 2,
                        direction: "none",
                        random: true,
                        straight: false,
                        out_mode: "out",
                        bounce: false
                    }
                },
                interactivity: {
                    detect_on: "canvas",
                    events: {
                        onhover: { enable: true, mode: "repulse" },
                        onclick: { enable: true, mode: "push" },
                        resize: true
                    }
                },
                retina_detect: true
            });
            
            // تهيئة السنة الحالية
            document.getElementById('current-year').textContent = new Date().getFullYear();
            
            // تهيئة العدادات من localStorage
            initializeCounters();
            
            // تحديث شريط التقدم
            updateProgressBar();
            
            // إضافة تأثيرات للشريط عند التمرير
            window.addEventListener('scroll', handleScroll);
        });
        
        // تهيئة العدادات
        function initializeCounters() {
            // الحصول على التاريخ الحالي
            const today = new Date().toDateString();
            
            // محاولة تحميل البيانات من localStorage
            const savedDate = localStorage.getItem('prayerDate');
            const savedDaily = localStorage.getItem('dailyCounter');
            const savedTotal = localStorage.getItem('totalCounter');
            const savedRecord = localStorage.getItem('recordCounter');
            
            // إذا كان التاريخ مختلفًا، نعيد العداد اليومي
            if (savedDate !== today) {
                localStorage.setItem('prayerDate', today);
                localStorage.setItem('dailyCounter', '0');
                document.getElementById('daily-counter').textContent = '0';
            } else {
                document.getElementById('daily-counter').textContent = savedDaily || '0';
            }
            
            // تعيين القيم الإجمالية والسجل
            document.getElementById('total-counter').textContent = savedTotal || '0';
            document.getElementById('record-counter').textContent = savedRecord || '0';
        }
        
        // التعامل مع حدث التمرير
        function handleScroll() {
            const navbar = document.querySelector('.navbar-majestic');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            
            // إضافة تأثيرات للعناصر عند ظهورها
            animateOnScroll();
        }
        
        // إضافة تأثيرات للعناصر عند التمرير
        function animateOnScroll() {
            const elements = document.querySelectorAll('.virtue-card, .counter-box');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.2;
                
                if (elementPosition < screenPosition) {
                    element.classList.add('animate__animated', 'animate__fadeInUp');
                }
            });
        }
        
        // زر الصلاة على النبي
        document.getElementById('pray-btn').addEventListener('click', function() {
            // زيادة العدادات
            increaseCounters();
            
            // إنشاء تأثيرات بصرية
            createSparkles();
            animatePrayerText();
            
            // تشغيل التأثير الصوتي
            playPrayerSound();
            
            // تحديث شريط التقدم
            updateProgressBar();
            
            // عرض رسالة عشوائية
            showRandomMessage();
        });
        
        // زيادة العدادات
        function increaseCounters() {
            // زيادة العداد اليومي
            let dailyCount = parseInt(document.getElementById('daily-counter').textContent);
            dailyCount++;
            document.getElementById('daily-counter').textContent = dailyCount;
            localStorage.setItem('dailyCounter', dailyCount.toString());
            
            // زيادة العداد الإجمالي
            let totalCount = parseInt(document.getElementById('total-counter').textContent);
            totalCount++;
            document.getElementById('total-counter').textContent = totalCount;
            localStorage.setItem('totalCounter', totalCount.toString());
            
            // تحديث سجل الأعلى
            let recordCount = parseInt(document.getElementById('record-counter').textContent);
            if (dailyCount > recordCount) {
                document.getElementById('record-counter').textContent = dailyCount;
                localStorage.setItem('recordCounter', dailyCount.toString());
            }
        }
        
        // إنشاء تأثير الشرر
        function createSparkles() {
            const sparkleContainer = document.getElementById('sparkle-effect');
            const prayerContainer = document.querySelector('.main-prayer-container');
            
            // إنشاء 25 شررة
            for (let i = 0; i < 25; i++) {
                const spark = document.createElement('div');
                spark.classList.add('spark');
                
                // 30% فرصة لشررة خضراء
                if (Math.random() < 0.3) {
                    spark.classList.add('spark-green');
                }
                
                // وضع عشوائي داخل الحاوية
                const left = Math.random() * 100;
                const top = Math.random() * 100;
                const delay = Math.random() * 2;
                const duration = 0.5 + Math.random() * 1;
                const size = 3 + Math.random() * 5;
                
                spark.style.left = `${left}%`;
                spark.style.top = `${top}%`;
                spark.style.animationDelay = `${delay}s`;
                spark.style.animationDuration = `${duration}s`;
                spark.style.width = `${size}px`;
                spark.style.height = `${size}px`;
                
                sparkleContainer.appendChild(spark);
                
                // إزالة الشررة بعد انتهاء التأثير
                setTimeout(() => {
                    if (spark.parentNode) {
                        spark.remove();
                    }
                }, (delay + duration) * 1000);
            }
        }
        
        // تحريك نص الصلاة
        function animatePrayerText() {
            const text = document.getElementById('main-prayer-text');
            text.classList.add('animate__animated', 'animate__pulse');
            
            setTimeout(() => {
                text.classList.remove('animate__animated', 'animate__pulse');
            }, 1000);
        }
        
        // تشغيل صوت الصلاة
        function playPrayerSound() {
            // إنشاء صوت باستخدام Web Audio API
            try {
                const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();
                
                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);
                
                oscillator.type = 'sine';
                oscillator.frequency.setValueAtTime(440, audioContext.currentTime);
                
                gainNode.gain.setValueAtTime(0.1, audioContext.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);
                
                oscillator.start();
                oscillator.stop(audioContext.currentTime + 0.5);
            } catch (e) {
                console.log("Web Audio API not supported in this browser");
            }
        }
        
        // تحديث شريط التقدم
        function updateProgressBar() {
            const dailyCount = parseInt(document.getElementById('daily-counter').textContent);
            const progressPercent = Math.min((dailyCount / 100) * 100, 100);
            
            const progressFill = document.getElementById('progress-fill');
            const progressPercentText = document.getElementById('progress-percent');
            
            progressFill.style.width = `${progressPercent}%`;
            progressPercentText.textContent = `${Math.round(progressPercent)}%`;
            
            // تغيير اللون حسب التقدم
            if (progressPercent >= 100) {
                progressFill.style.background = "linear-gradient(90deg, #00FF00 0%, #32CD32 100%)";
                progressFill.style.boxShadow = "0 0 15px rgba(0, 255, 0, 0.7), inset 0 1px 1px rgba(255, 255, 255, 0.3)";
            } else if (progressPercent >= 70) {
                progressFill.style.background = "linear-gradient(90deg, #4169E1 0%, #1e3c72 100%)";
                progressFill.style.boxShadow = "0 0 15px rgba(65, 105, 225, 0.7), inset 0 1px 1px rgba(255, 255, 255, 0.3)";
            }
        }
        
        // عرض رسالة عشوائية
        function showRandomMessage() {
            const messages = [
                "جزاك الله خيراً! كل صلاة ترفع بها درجة في الجنة",
                "صلى الله عليه وسلم تسليماً كثيراً!",
                "اللهم ارزقنا شفاعة الحبيب المصطفى",
                "بركة الصلاة على النبي تدوم في حياتك",
                "أكثروا من الصلاة على النبي تُفتح لكم أبواب الرحمة"
            ];
            
            const randomIndex = Math.floor(Math.random() * messages.length);
            const message = messages[randomIndex];
            
            // إنشاء عنصر للرسالة
            const messageElement = document.createElement('div');
            messageElement.className = 'alert alert-success alert-dismissible fade show position-fixed';
            messageElement.style.cssText = 'top: 100px; left: 50%; transform: translateX(-50%); z-index: 9999; background: linear-gradient(135deg, rgba(10, 92, 54, 0.9), rgba(26, 71, 42, 0.9)); border: 1px solid rgba(255, 215, 0, 0.5); color: var(--cream-light);';
            messageElement.innerHTML = `
                <i class="fas fa-check-circle me-2" style="color: var(--gold-primary);"></i> ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" style="filter: invert(1);"></button>
            `;
            
            document.body.appendChild(messageElement);
            
            // إزالة الرسالة بعد 5 ثوان
            setTimeout(() => {
                if (messageElement.parentNode) {
                    messageElement.remove();
                }
            }, 5000);
        }
        
        // زر التشغيل التلقائي
        let autoPrayInterval;
        document.getElementById('auto-pray-btn').addEventListener('click', function() {
            const button = this;
            const icon = button.querySelector('i');
            
            if (button.classList.contains('active')) {
                // إيقاف التشغيل التلقائي
                button.classList.remove('active');
                icon.className = 'fas fa-play-circle';
                button.innerHTML = '<i class="fas fa-play-circle"></i> التشغيل التلقائي';
                clearInterval(autoPrayInterval);
                
                // عرض رسالة
                showAlert('تم إيقاف الصلاة التلقائية', 'info');
            } else {
                // بدء التشغيل التلقائي
                button.classList.add('active');
                icon.className = 'fas fa-stop-circle';
                button.innerHTML = '<i class="fas fa-stop-circle"></i> إيقاف التشغيل';
                
                // عرض رسالة
                showAlert('بدأت الصلاة التلقائية. سيتم الصلاة كل 3 ثوانٍ', 'success');
                
                // بدء الفاصل الزمني
                autoPrayInterval = setInterval(() => {
                    document.getElementById('pray-btn').click();
                }, 3000);
            }
        });
        
        // زر تأثير الزهور
        document.getElementById('flower-effect-btn').addEventListener('click', function() {
            createFlowerEffect();
            showAlert('تم تفعيل تأثير الزهور الروحانية', 'info');
        });
        
        // إنشاء تأثير الزهور
        function createFlowerEffect() {
            const effectsContainer = document.getElementById('visual-effects');
            const flowers = ['🕌', '✨', '🌟', '🕋', '📿', '☪️', '🌙', '⭐'];
            
            for (let i = 0; i < 25; i++) {
                const flower = document.createElement('div');
                flower.className = 'prayer-flower';
                flower.textContent = flowers[Math.floor(Math.random() * flowers.length)];
                
                // خصائص عشوائية
                const left = Math.random() * 100;
                const duration = 5 + Math.random() * 5;
                const delay = Math.random() * 2;
                const size = 20 + Math.random() * 30;
                
                flower.style.left = `${left}%`;
                flower.style.fontSize = `${size}px`;
                flower.style.animationDuration = `${duration}s`;
                flower.style.animationDelay = `${delay}s`;
                
                // لون عشوائي
                const colors = ['#FFD700', '#FFA500', '#32CD32', '#4169E1', '#FFFFFF'];
                flower.style.color = colors[Math.floor(Math.random() * colors.length)];
                
                effectsContainer.appendChild(flower);
                
                // إزالة الزهرة بعد انتهاء التأثير
                setTimeout(() => {
                    if (flower.parentNode) {
                        flower.remove();
                    }
                }, (duration + delay) * 1000);
            }
        }
        
        // زر التحكم الصوتي
        document.getElementById('audio-toggle').addEventListener('click', function() {
            const icon = this.querySelector('i');
            
            if (icon.classList.contains('fa-volume-up')) {
                icon.className = 'fas fa-volume-mute';
                showAlert('تم كتم الصوت', 'warning');
            } else {
                icon.className = 'fas fa-volume-up';
                showAlert('تم تشغيل الصوت', 'success');
            }
        });
        
        // دالة مساعدة لعرض التنبيهات
        function showAlert(message, type) {
            const alertClass = type === 'success' ? 'success' : 
                              type === 'info' ? 'info' : 
                              type === 'warning' ? 'warning' : 'secondary';
            
            const alertElement = document.createElement('div');
            alertElement.className = `alert alert-${alertClass} alert-dismissible fade show position-fixed`;
            alertElement.style.cssText = 'top: 80px; left: 50%; transform: translateX(-50%); z-index: 9999; background: linear-gradient(135deg, rgba(26, 43, 60, 0.9), rgba(10, 25, 41, 0.9)); border: 1px solid rgba(255, 215, 0, 0.5); color: var(--cream-light);';
            alertElement.innerHTML = `
                <button type="button" class="btn-close" data-bs-dismiss="alert" style="filter: invert(1);"></button>
                ${message}
            `;
            
            document.body.appendChild(alertElement);
            
            setTimeout(() => {
                if (alertElement.parentNode) {
                    alertElement.remove();
                }
            }, 3000);
        }
    </script>
</body>
</html>